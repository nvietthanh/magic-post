<template>
    <Head title="Quản lý điểm giao dịch" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Danh sách đơn tiếp nhận</h1>
            </div>
            <div>
                <div class="mx-[4px] mb-4">
                    <div class="grid grid-cols-4 gap-[32px] pb-[18px]">
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Tên điểm</span>
                            <el-input v-model="filter.name" class="w-full" placeholder="Nhập tên điểm"></el-input>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Thành phố</span>
                            <el-select v-model="filter.province_id" class="w-full"
                                placeholder="Chọn thành phố" clearable
                                @change="getDistrict"
                            >
                                <el-option 
                                    v-for="item in provinces" :key="item.id"
                                    :label="item.name" :value="item.id" 
                                />
                            </el-select>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Huyện</span>
                            <el-select v-model="filter.district_id" class="w-full" placeholder="Chọn huyện" clearable>
                                <el-option 
                                    v-for="item in districts" :key="item.id"
                                    :label="item.name" :value="item.id" 
                                />
                            </el-select>
                        </div>
                    </div>
                    <div class="flex w-full items-center justify-between">
                        <div class="flex">
                            <el-button type="info" class="text-sm" @click="cancelFilter">Xóa bỏ</el-button>
                            <el-button color="#0082BE" class="text-sm" @click="searchFilter">Tìm kiếm</el-button>
                        </div>
                    </div>
                </div>
                <DataTable
                    v-loading="loadingForm"
                    :fields="fields" :items="transactionPoints" 
                    :paginate="paginate" footer-center 
                    paginate-background @page-change="changePage"
                >
                    <template #type="{ row }">
                        <div>{{ row?.type == 1 ? 'Tài liệu' : 'Hàng hóa' }}</div>
                    </template>
                    <template #status_text="{ row }">
                        <div>{{ row?.status_text }}</div>
                        <div>({{ row?.status_process }})</div>
                    </template>
                    <template #action="{ row }">
                        <div class="flex justify-center gap-1">
                            <el-button type="info" @click="showDetail(row)">Chi tiết</el-button>
                        </div>
                    </template>
                </DataTable>
            </div>
            <ShowConcentrate ref="showConcentrate" @change-data="fetchData"/>
            <ShowConcentrateDestination ref="showConcentrateDes" @change-data="fetchData"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import ShowConcentrate from './Dialog/ShowConcentrate.vue'
import ShowConcentrateDestination from './Dialog/ShowConcentrateDestination.vue'
import { TRANSIT_TO_CONCENTRATE_RECEIVE } from '@/Store/Consts/oderStatus'

export default {
    components: { Head, Link, AppLayout, DataTable, ShowConcentrate, ShowConcentrateDestination },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            transactionPoints: [],
            provinces: [],
            districts: [],
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'user_name', label: 'Người gửi', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'status_text', label: 'Trạng thái', width: 260, align: 'center', headerAlign: 'center' },
                { key: 'created_at', label: 'Ngày tạo', width: 100, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 100, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            filter: {
                name: '',
                province_id: '',
                district_id: '',
                page: 1,
            }
        }
    },
    created() {
        this.fetchData()
        this.getProvice()
        this.getDistrict()
    },
    methods: {
        getProvice() {
            axios.get(route('admin.api.region.province-all'))
                .then(({ data }) => {
                    this.provinces = data.data
                })
        },
        getDistrict() {
            this.districts = []
            if (this.filter.province_id) {
                axios.get(route('admin.api.region.get-district', this.filter.province_id))
                    .then(({ data }) => {
                        this.districts = data.data
                    })
            }
        },
        fetchData() {
            this.loadingForm = true
            axios.get(route('admin.api.concentrate-order-send.index', this.filter))
                .then(({ data }) => {
                    this.transactionPoints = data.data
                    this.paginate = data?.meta
                    this.loadingForm = false
                })
        },
        searchFilter() {
            this.fetchData()
        },
        cancelFilter() {
            this.filter = {}
            this.page = 1
            this.fetchData()
        },
        showDetail(row) {
            if (row.status_number == TRANSIT_TO_CONCENTRATE_RECEIVE) {
                this.$refs.showConcentrate.open(row)
            } else {
                this.$refs.showConcentrateDes.open(row)
            }
        },
        changePage(value) {
            this.filter.page = value
            this.fetchData()
        }
    }
}
</script>