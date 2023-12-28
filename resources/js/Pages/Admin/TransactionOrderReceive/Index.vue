<template>
    <Head title="Quản lý điểm giao dịch" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Danh sách đơn gửi đi</h1>
            </div>
            <div>
                <div class="mx-[4px] mb-4">
                    <div class="grid grid-cols-4 gap-[32px] pb-[18px]">
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Mã vận đơn</span>
                            <el-input v-model="filter.order_code" class="w-full" placeholder="Nhập mã vận đơn "></el-input>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Người gửi</span>
                            <el-select v-model="filter.user_from" class="w-full"
                                placeholder="Chọn người gửi" clearable multiple
                            >
                                <el-option 
                                    v-for="item in userFrom" :key="item.id"
                                    :label="item.full_name" :value="item.id" 
                                />
                            </el-select>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Người nhận</span>
                            <el-input v-model="filter.user_to" class="w-full" placeholder="Nhập người nhận"></el-input>
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
                    :fields="fields" :items="transactionOrders" 
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
            <ShowTransaction ref="showTransaction" @change-data="fetchData"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import ShowTransaction from './Dialog/ShowTransaction.vue'
import { ElMessageBox } from 'element-plus'
import { PENDING_APPROVAL } from '@/Store/Consts/oderStatus'

export default {
    components: { Head, Link, AppLayout, DataTable, ShowTransaction },
    props: {
        guides: {
            type: Object || Array,
            default: () => {},
        },
    },
    data: function () {
        return {
            pedingStatus: PENDING_APPROVAL,
            loadingForm: false,
            paginate: [],
            transactionOrders: [],
            userFrom: [],
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'user_name', label: 'Người gửi', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'status_text', label: 'Trạng thái', width: 260, align: 'center', headerAlign: 'center' },
                { key: 'created_at', label: 'Ngày tạo', width: 100, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 110, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            filter: {
                order_code: '',
                user_from: '',
                user_to: '',
                page: 1,
            }
        }
    },
    created() {
        this.fetchData()
        this.getUser()
    },
    methods: {
        getUser() {
            axios.get(route('admin.api.user.get-all'))
                .then(({ data }) => {
                    this.userFrom = data.data
                })
        },
        fetchData() {
            this.loadingForm = true
            axios.get(route('admin.api.transaction-order-receive.index', this.filter))
                .then(({ data }) => {
                    this.transactionOrders = data.data
                    for (let item of this.transactionOrders) {
                        
                    }
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
            this.$refs.showTransaction.open(row)
        },
        changePage(value) {
            this.filter.page = value
            this.fetchData()
        }
    }
}
</script>