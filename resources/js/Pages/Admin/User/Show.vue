<template>
    <Head title="Quản lý tài khoản admin" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[90px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <div class="flex gap-20">
                    <div class="justify-start items-center gap-[12px] flex">
                        <el-image :src="user?.avatar" class="w-[64px] h-[64px] rounded-[5px] border-[1px]"></el-image>
                        <div class="flex-col justify-start items-start gap-[5px] inline-flex">
                            <div class="font-bold">
                                {{ user?.full_name }}
                            </div>
                            <div class="text-stone-500 text-sm leading-[21px]">
                                Mã KH: {{ user?.uuid }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="py-[12px]">
                        <h1 class="text-[18px] font-bold">Danh sách đơn hàng</h1>
                    </div>
                    <div class="mx-[4px]">
                        <div class="grid grid-cols-3 gap-[32px] pb-[18px]">
                            <div class="flex flex-col">
                                <span class="my-1 font-bold">Mã đơn hàng</span>
                                <el-input v-model="filter.order_code" class="w-full" placeholder="Nhập mã đơn hàng"></el-input>
                            </div>
                            <div class="flex flex-col">
                                <span class="my-1 font-bold">Địa chỉ</span>
                                <el-input v-model="filter.adress" class="w-full" placeholder="Nhập địa chỉ giao hàng"></el-input>
                            </div>
                            <div class="flex flex-col">
                                <span class="my-1 font-bold">Họ tên người nhận</span>
                                <el-input v-model="filter.full_name" class="w-full" placeholder="Nhập họ tên người nhận"></el-input>
                            </div>
                        </div>
                        <div class="flex w-full items-center justify-between">
                            <div class="flex">
                                <el-button type="info" class="text-sm" @click="cancelFilter">Xóa bỏ</el-button>
                                <el-button color="#0082BE" class="text-sm" @click="searchFilter">Tìm kiếm</el-button>
                            </div>
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
                            <el-button type="info" @click="openEditForm(row)">Chi tiết</el-button>
                        </div>
                    </template>
                </DataTable>
            </div>
            <CreateForm ref="createAccountForm" @change-data="fetchData"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
// import Paginate from '@/Components/Pagination/Paginate.vue';
import DataTable from '@/Components/DataTable.vue'
import CreateForm from './Dialog/Create.vue'
import { ElMessageBox } from 'element-plus'

export default {
    components: { Head, Link, AppLayout, DataTable, CreateForm },
    props: {
        user: {
            type: Object || Array,
            default: () => { },
        },
        id: {
            type: String,
            required: true
        }
    },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            listAccount: [],
            fields: [
                { key: 'order_code', label: 'Mã đơn', width: 120, align: 'center', headerAlign: 'center' },
                { key: 'full_name', label: 'Họ tên người nhận', minWidth: 180, align: 'left', headerAlign: 'left   ' },
                { key: 'phone', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'address', label: 'Địa chỉ', width: 150, align: 'left', headerAlign: 'left' },
                { key: 'status', label: 'Trạng thái', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'creator', label: 'Người tạo', minWidth: 180, align: 'left', headerAlign: 'left   ' },
                { key: 'action', label: 'Thao tác', width: 120, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            filter: {
                order_code: '',
                address: '',
                full_name: '',
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
            let pagram = {
                id: this.id,
                ...this.filter
            }
            axios.get(route('admin.api.user.show', pagram))
                .then(({ data }) => {
                    this.listAccount = data.data
                    this.paginate = data.meta
                    this.loadingForm = false
                })
        },
        searchFilter() {
            this.fetchData()
        },
        cancelFilter() {
            this.filter.name = ''
            this.filter.email  = ''
            this.filter.gender = ''
            this.page = 1
        },
        openCreateForm() {
            this.$refs.createAccountForm.open()
        },
        openEditForm(row) {
            this.$refs.createAccountForm.open(row)
        },
        openDeleteItem(row) {
            ElMessageBox.confirm(
                'Bạn có muốn xóa tài khoản này?',
                'Thông báo',
                {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Hủy bỏ',
                    type: 'warning',
                }
            )
            .then(() => {
                axios.delete(route('admin.api.account.destroy', row.id)).then(({data}) => {
                    this.$message({ message: data?.message, type: 'success'})
                    this.fetchData()
                })
            })
        },
        changePage(value) {
            this.filter.page = value
            this.fetchData()
        }
    }
}
</script>