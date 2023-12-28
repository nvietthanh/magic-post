<template>
    <Head title="Trang thống kê" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Thống kê</h1>
            </div>
            <div>
                <div class="mx-[4px] mb-[12px] pb-[48px]">
                    <div class="flex gap-[32px] pb-[18px]">
                        <div class="flex flex-col h-[62px]">
                            <span class="my-1 font-bold">Khoảng thời gian</span>
                            <el-date-picker
                                v-model="filter.daterange"
                                type="daterange"
                                start-placeholder="Ngày bắt đầu"
                                end-placeholder="Ngày kết thúc"
                                format="DD/MM/YYYY"
                                value-format="DD-MM-YYYY"
                                class="w-full"
                            />
                        </div>
                        <div v-if="checkRoles(['master-admin'])" class="flex flex-col w-[300px]">
                            <span class="my-1 font-bold">Trạng thái đơn hàng</span>
                            <el-select v-model="filter.type_status" class="w-full"
                                placeholder="Chọn trạng thái đơn hàng" clearable multiple
                            >
                                <el-option 
                                    v-for="item in orderStatusAll" :key="item.value"
                                    :label="item.text" :value="item.value" 
                                />
                            </el-select>
                        </div>
                        <div v-if="checkRoles(['master-admin'])" class="flex flex-col w-[300px]">
                            <span class="my-1 font-bold">Điểm giao dịch</span>
                            <el-select v-model="filter.receive_district_ids" class="w-full"
                                placeholder="Chọn điểm giao dịch" clearable multiple
                            >
                                <el-option 
                                    v-for="item in transactionPoints" :key="item.id"
                                    :label="item.name" :value="item.id" 
                                >
                                    <div class="flex justify-between gap-[32px]">
                                        <div>{{ item?.name }}</div>
                                        <div style="color: var(--el-text-color-secondary)">
                                            {{ item.district_name }}, {{ item.province_name }}
                                        </div>
                                    </div>
                                </el-option>
                            </el-select>
                        </div>
                        <div v-if="checkRoles(['master-admin'])" class="flex flex-col w-[300px]">
                            <span class="my-1 font-bold">Điểm tập kết</span>
                            <el-select v-model="filter.delivery_district_ids" class="w-full"
                                placeholder="Chọn điểm tập kết" clearable multiple
                            >
                                <el-option 
                                    v-for="item in concentratePoints" :key="item.id"
                                    :label="item.name" :value="item.id" 
                                >
                                    <div class="flex justify-between gap-[32px]">
                                        <div>{{ item?.name }}</div>
                                        <div style="color: var(--el-text-color-secondary)">
                                            {{ item.district_name }}, {{ item.province_name }}
                                        </div>
                                    </div>
                                </el-option>
                            </el-select>
                        </div>
                    </div>
                    <div class="flex w-full items-center justify-between">
                        <div class="flex">
                            <el-button type="info" class="text-sm" @click="cancelFilter">Xóa bỏ</el-button>
                            <el-button color="#0082BE" class="text-sm" @click="searchFilter">Tìm kiếm</el-button>
                        </div>
                    </div>
                    <div v-loading="loadingForm" class="mt-[32px]">
                        <Bar
                            v-if="loaded"
                            :options="accountChartOptions"
                            :data="accountChartData"
                            height="120"
                        />
                        <div class="mt-[16px]">
                            <DataTable
                                v-if="this.listOrders.length > 0"
                                :fields="fields" :items="listOrders"
                                footer-center 
                                paginate-background
                            >
                                <template #type="{ row }">
                                    <div>{{ row?.type == 1 ? 'Tài liệu' : 'Hàng hóa' }}</div>
                                </template>
                                <template #status_text="{ row }">
                                    <div>{{ row?.status_text }}</div>
                                    <div>({{ row?.status_process }})</div>
                                </template>
                                <template #action="{ row }">
                                    <el-button type="info" @click="showDetail(row)">Chi tiết</el-button>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
            <ShowDetail ref="showDetail" />
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import ShowDetail from './Dialog/OrderDetail.vue'
import { All } from '@/Store/Consts/oderStatus'
import { Bar, Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)

export default {
    components: {
        Head, Link, AppLayout, DataTable, ShowDetail, Bar, Pie,
    },
    data: function () {
        return {
            orderStatusAll: All,
            loaded: false,
            loadingForm: false,
            filter: {
                daterange: null,
                type_status: null,
                receive_district_ids: null,
                delivery_district_id: null,
            },
            accountChartOptions: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                    },
                    y: {
                        min: 0,
                        max: 1,
                    }
                },
                onClick: (event, element) => {
                    if(element.length > 0) {
                        this.showTable = true
                        const row = element[0].datasetIndex
                        const column = element[0].index
                        this.listOrders = this.accountChartData.dataValue[row][column]
                    }
                }
            },
            accountChartData: {
                labels: [
                ],
                datasets: [
                ],
                dataValue: []
            },
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'user_name', label: 'Người gửi', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'created_at', label: 'Ngày tạo', width: 140, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 110, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            listOrders: [],
            listColors: [
                "#EC342D", "#FCA7A5", "#609881", "#1E1E52", "#BB1141",
                "#cf2aba", "#0EBBCD", "#fef84c", "#3CC4FF"
            ],
            transactionPoints: [],
            concentratePoints: []
        }
    },
    created() {
        this.fetchData()
        if (this.$page?.props?.auth?.user.role == 'master-admin') {
            this.fetchPoint()
        }
    },
    methods: {
        fetchPoint() {
            axios.get(route('admin.api.transactioin-point.get-all'))
                .then(({ data })=> {
                    this.transactionPoints = data.data
                })
            axios.get(route('admin.api.concentrate-point.get-all'))
                .then(({ data })=> {
                    this.concentratePoints = data.data
                })
        },
        fetchData() {
            this.loadingForm = true
            this.loaded = false
            this.accountChartData.datasets = []
            axios.get(route('admin.api.dashboard', this.filter))
                .then(({ data })=> {
                    let indexLabel = 0;
                    for (let index = 0; index < this.orderStatusAll.length - 1; index ++) {
                        let itemOrder = data[this.orderStatusAll[index]['slug']]
                        if (itemOrder) {
                            this.accountChartData.datasets[indexLabel] = {
                                label: this.orderStatusAll[index]['text'],
                                pointBackgroundColor: "white",
                                pointBorderColor: "white",
                                borderWidth: 1,
                                backgroundColor: this.listColors[index],
                                data: []
                            }
                            indexLabel++
                        }
                    }
                    let indexData = 0;
                    for (let index = 0; index < this.orderStatusAll.length - 1; index ++) {
                        let itemOrder = data[this.orderStatusAll[index]['slug']]
                        if (itemOrder) {
                            this.accountChartData.datasets[indexData].data = itemOrder.dataPeriod
                            this.accountChartData.dataValue[indexData] = itemOrder.formData
                            this.accountChartData.labels = itemOrder.titleBottomChart
                            indexData++
                        }
                    }
                    this.accountChartOptions.scales.y.max = data.count_data.sum
                    this.loaded = true
                    this.loadingForm = false
                })
        },
        showDetail(row  ) {
            this.$refs.showDetail.open(row)
        },
        searchFilter() {
            this.fetchData()
        },
        cancelFilter() {
            this.filter = {}
            this.fetchData()
        },
        randomColor() {
            const letters = '0123456789ABCDEF';
            let color;

            do {
                color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
            } while (this.accountChartData.datasets.find(item => item.backgroundColor == color));

            return color;
        },
    }
}
</script>
<style>
[type='text']:focus {
    --tw-ring-color: #000;
}
.el-date-editor--daterange {
    width: 100% !important;
    max-height: 34px !important;
}
.el-date-editor--daterange input:focus{
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}
</style>