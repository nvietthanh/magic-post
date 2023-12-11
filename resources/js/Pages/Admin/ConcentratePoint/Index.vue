<template>
    <Head title="Quản lý điểm tiếp nhận" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Danh sách điểm tiếp nhận</h1>
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
                    :fields="fields" :items="concentratePoints" 
                    :paginate="paginate" footer-center 
                    paginate-background @page-change="changePage"
                >
                    <template #action="{ row }">
                        <div class="flex justify-center gap-1">
                            <el-button type="danger" @click="openDeleteItem(row)"> 
                                Xóa bỏ
                            </el-button>
                            <el-button type="info" @click="openEditForm(row)"> 
                                Sửa
                            </el-button>
                        </div>
                    </template>
                </DataTable>
            </div>
            <CreateForm ref="createConcentrateForm" @change-data="fetchData"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import CreateForm from './Dialog/Create.vue'
import { ElMessageBox } from 'element-plus'

export default {
    components: { Head, Link, AppLayout, DataTable, CreateForm },
    async created() {
    },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            concentratePoints: [],
            provinces: [],
            districts: [],
            fields: [
                { key: 'name', label: 'Tên điểm', minWidth: 180, align: 'left', headerAlign: 'left   ' },
                { key: 'district_name', label: 'Huyện', width: 170, align: 'left', headerAlign: 'left' },
                { key: 'province_name', label: 'Thành phố', width: 170, align: 'left', headerAlign: 'left' },
                { key: 'created_at', label: 'Ngày tạo', width: 200, align: 'left', headerAlign: 'left' },
                { key: 'updated_at', label: 'Ngày cập nhật', width: 200, align: 'left', headerAlign: 'left' },
                { key: 'action', label: 'Thao tác', width: 160, align: 'center', headerAlign: 'center', fixed: 'right' },
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
            axios.get(route('admin.api.concentrate-point.index', this.filter))
                .then(({ data }) => {
                    this.concentratePoints = data.data
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
        openCreateForm() {
            this.$refs.createConcentrateForm.open()
        },
        openEditForm(row) {
            this.$refs.createConcentrateForm.open(row)
        },
        openDeleteItem(row) {
            ElMessageBox.confirm(
                'Bạn có muốn xóa điểm tiếp nhận này?',
                'Thông báo',
                {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Hủy bỏ',
                    type: 'warning',
                }
            )
            .then(() => {
                axios.delete(route('admin.api.transactioin-point.destroy', row.id)).then(({data}) => {
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