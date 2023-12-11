<template>
    <Head title="Quản lý tài khoản người dùng" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Danh sách tài khoản người dùng</h1>
                <div class="flex float-right ml-auto">
                    <el-button class="text-white" color="#0082BE" @click="openCreateForm">
                        Thêm mới
                    </el-button>
                </div>
            </div>
            <div>
                <div class="mx-[4px] mb-4">
                    <div class="grid grid-cols-4 gap-[32px] pb-[18px]">
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Họ tên</span>
                            <el-input v-model="filter.name" class="w-full" placeholder="Nhập họ tên"></el-input>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Email</span>
                            <el-input v-model="filter.email" class="w-full" placeholder="Nhập email"></el-input>
                        </div>
                        <div class="flex flex-col">
                            <span class="my-1 font-bold">Số điện thoại</span>
                            <el-input v-model="filter.phone" class="w-full" placeholder="Nhập số điện thoại"></el-input>
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
                    <template #role="{ row }">
                        <span>{{ getRoleName(row?.role) }}</span>
                    </template>
                    <template #gender="{ row }">
                        <span>{{ row?.gender == 1 ? 'Name' : 'Nữ' }}</span>
                    </template>
                    <template #status="{ row }">
                        {{ row?.status ? 'Active' : 'Deactive' }}
                    </template>
                    <template #action="{ row }">
                        <div class="flex justify-center gap-1">
                            <el-button type="danger" @click="openDeleteItem(row)">Xóa bỏ</el-button>
                            <el-button type="success" @click="openEditForm(row)">Sửa</el-button>
                            <el-button type="info" @click="showDetail(row.id)">Chi tiết</el-button>
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
import form from '@/Mixins/form';

export default {
    components: { Head, Link, AppLayout, DataTable, CreateForm },
    async created() {
    },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            listAccount: [],
            fields: [
                { key: 'uuid', label: 'Mã NV', width: 100, align: 'center', headerAlign: 'center' },
                { key: 'full_name', label: 'Họ tên', minWidth: 180, align: 'left', headerAlign: 'left   ' },
                { key: 'email', label: 'Email', minWidth: 220, align: 'center', headerAlign: 'center' },
                { key: 'phone', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'address', label: 'Địa chỉ', width: 150, align: 'left', headerAlign: 'left' },
                { key: 'status', label: 'Trạng thái', width: 100, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 260, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            filter: {
                name: '',
                email: '',
                phone: '',
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
            axios.get(route('admin.api.user.index', this.filter))
                .then(({ data }) => {
                    this.listAccount = data.data
                    this.paginate = data?.meta
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
                axios.delete(route('admin.api.user.destroy', row.id)).then(({data}) => {
                    this.$message({ message: data?.message, type: 'success'})
                    this.fetchData()
                })
            })
        },
        showDetail(id) {
            this.$inertia.visit(route('admin.user.show', id))
        },
        changePage(value) {
            this.filter.page = value
            this.fetchData()
        }
    }
}
</script>