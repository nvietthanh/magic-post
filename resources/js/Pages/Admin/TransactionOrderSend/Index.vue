<template>
    <Head title="Quản lý điểm giao dịch" />
    <AppLayout>
        <template v-slot:main>
            <div class="flex h-[56px] items-center w-full px-2 bg-[white] border-b-[2px]">
                <h1 class="bold text-[20px] font-bold">Danh sách đơn gửi đi</h1>
                <div class="flex float-right ml-auto">
                    <el-button v-if="!checkRoles(['master-admin'])" class="text-white" color="#0082BE" @click="openCreateForm">
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
                    <template v-if="!checkRoles(['master-admin'])" #action="{ row }">
                        <div v-if="row?.status_number == 0">
                            <el-button v-if="checkHidden(row)" type="danger" @click="openDeleteItem(row)">Xóa bỏ</el-button>
                            <el-button v-if="checkHidden(row)" type="success" @click="openEditForm(row)">Sửa</el-button>
                            <el-button type="info" @click="showDetail(row)">Chi tiết</el-button>
                        </div>
                        <div v-else class="flex justify-center gap-1">
                            <el-button type="info" @click="showDetailDes(row)">Chi tiết</el-button>
                        </div>
                    </template>
                </DataTable>
            </div>
            <FormInput ref="transactionForm" @change-data="fetchData" :guides="guides"/>
            <ShowTransaction ref="showTransaction" @change-data="fetchData"/>
            <ShowTransactionDes ref="showTransactionDes" @change-data="fetchData"/>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import FormInput from './Dialog/Form.vue'
import ShowTransaction from './Dialog/ShowTransaction.vue'
import ShowTransactionDes from './Dialog/ShowTransactionDes.vue'
import { ElMessageBox } from 'element-plus'
import { PENDING_APPROVAL } from '@/Store/Consts/oderStatus'

export default {
    components: { Head, Link, AppLayout, DataTable, FormInput, ShowTransaction, ShowTransactionDes },
    props: {
        guides: {
            type: Object || Array,
            default: () => {},
        },
    },
    data: function () {
        return {
            loadingForm: false,
            paginate: [],
            transactionOrders: [],
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
                { key: 'action', label: 'Thao tác', width: 280, align: 'center', headerAlign: 'center', fixed: 'right' },
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
            axios.get(route('admin.api.transaction-order-send.index', this.filter))
                .then(({ data }) => {
                    this.transactionOrders = data.data
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
        checkHidden(row) {
            if (row?.status) {
                for (let item of row.status) {
                    if (item.type != PENDING_APPROVAL) {
                        return false
                    }
                }
            }
            return true
        },
        openCreateForm() {
            this.$refs.transactionForm.open()
        },
        openEditForm(row) {
            this.$refs.transactionForm.open(row)
        },
        showDetail(row) {
            this.$refs.showTransaction.open(row)
        },
        showDetailDes(row) {
            this.$refs.showTransactionDes.open(row)
        },
        openDeleteItem(row) {
            ElMessageBox.confirm(
                'Bạn có muốn xóa giao dịch này không?',
                'Thông báo',
                {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Hủy bỏ',
                    type: 'warning',
                }
            )
            .then(() => {
                axios.delete(route('admin.api.transaction-order-send.destroy', row.id)).then(({data}) => {
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