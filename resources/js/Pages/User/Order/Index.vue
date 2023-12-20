<template>
    <Head title="Danh sách đơn hàng" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex items-center border-b-[2px] pt-[12px] pb-[18px]">
                <span class="font-bold text-[16px]">
                    <Link :href="route('user.home')">Trang chủ</Link>
                </span>
                <span class="mx-[4px]">
                    <i class="bi bi-chevron-right text-[14px]"></i>
                </span>
                <span class="text-[15px]">Danh sách đơn hàng</span>
            </div>
            <div class="mt-[12px]">
                <div class="mx-[4px]">
                    <div class="grid sm:grid-cols-4 grid-cols-2 sm:gap-x-[32px] gap-x-[12px] gap-y-[4px] pb-[18px]">
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Mã vận đơn</span>
                            <el-input v-model="filter.order_code" class="w-full" placeholder="Nhập mã vận đơn"></el-input>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Người nhận</span>
                            <el-input v-model="filter.name" class="w-full" placeholder="Nhập họ tên"></el-input>
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
                    :fields="fields" 
                    :items="listAccount" 
                    :paginate="paginate" 
                    footer-center 
                    paginate-background
                    @page-change="changePage"
                >
                    <template #action="{ row }">
                        <div class="flex justify-center gap-1">
                            <el-button type="info" @click="openDetail(row)">Chi tiết</el-button>
                        </div>
                    </template>
                </DataTable>
            </div>
            <OrderDetail ref="accountOrderDetail"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/User/UserLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import OrderDetail from './Dialog/OrderDetail.vue'

export default {
    components: { Head, Link, AppLayout, DataTable, OrderDetail },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            listAccount: [],
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 100, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'status_text', label: 'Trạng thái', minWidth: 180, align: 'center', headerAlign: 'center' },
                { key: 'created_at', label: 'Ngày tạo', width: 140, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 100, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            filter: {
                name: '',
                order_code: '',
                page: 1,
            }
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            this.loadingForm = true
            axios.get(route('user.api.order.index', this.filter))
                .then(({ data }) => {
                    this.listAccount = data.data
                    this.paginate = data?.meta
                    this.loadingForm = false
                })
        },
        searchFilter() {
            this.page = 1
            this.fetchData()
        },
        cancelFilter() {
            this.filter= {}
            this.page = 1
            this.fetchData()
        },
        openDetail(row) {
            this.$refs.accountOrderDetail.open(row)
        },
        changePage(value) {
            this.filter.page = value
            this.fetchData()
        }
    }
}
</script>