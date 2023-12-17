<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="admin-account"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">
                {{ title }}
            </div>
        </template>
        <div v-loading="loading">
            <el-form ref="form" :model="formData" :rules="rules" label-position="top">
                <div class="flex gap-[32px]">
                    <el-form-item label="Loại đơn hàng" prop="type"
                        :error="getError('type')" :inline-message="hasError('type')">
                        <el-select v-model="formData.type" class="w-[200px]" placeholder="Chọn loại đơn hàng">
                            <el-option label="Tài liệu" value="1" />
                            <el-option label="Hàng hóa" value="2" />
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Họ tên người nhận" class="w-full" prop="full_name"
                        :error="getError('full_name')" :inline-message="hasError('full_name')">
                        <el-input type="text" v-model="formData.full_name" placeholder="Nhập họ tên người nhận" />
                    </el-form-item>
                    <el-form-item label="Số điện thoại người nhận" class="w-full" prop="phone_number"
                        :error="getError('phone_number')" :inline-message="hasError('phone_number')">
                        <el-input type="text" v-model="formData.phone_number" placeholder="Nhập số điện thoại người nhận" />
                    </el-form-item>
                </div>
                <div class="w-full border px-4 py-2 mb-2 mt-1 el-form-item is-required">
                    <span class="el-form-item__label">Chọn địa chỉ giao hàng</span>
                    <div class="flex items-start gap-[32px] mb-4">
                        <div>
                            <el-form-item label="Thành phố" class="w-[200px]" prop="province_id"
                                :error="getError('province_id')" :inline-message="hasError('province_id')">
                                <el-select v-model="formData.province_id" class="w-full"
                                    placeholder="Chọn thành phố"
                                    @change="changeProvince"
                                >
                                    <el-option 
                                        v-for="item in provinces" 
                                        :key="item.id" :label="item.name" :value="item.id" 
                                    />
                                </el-select>
                            </el-form-item>
                            <el-form-item label="Huyện" class="w-[200px] mt-4" prop="delivery_district_id"
                                :error="getError('delivery_district_id')" :inline-message="hasError('delivery_district_id')">
                                <el-select v-model="formData.delivery_district_id" class="w-full" placeholder="Chọn huyện">
                                    <el-option 
                                        v-for="item in districts" 
                                        :key="item.id" :label="item.name" :value="item.id" 
                                    />
                                </el-select>
                            </el-form-item>
                        </div>
                        <el-form-item label="Địa chỉ" prop="address" class="w-full"
                            :error="getError('address')" :inline-message="hasError('address')">
                            <el-input type="textarea" v-model="formData.address" :rows="4"
                                placeholder="Nhập địa chỉ cụ thể  (Số nhà, ngõ, thôn, xã/phường)" />
                        </el-form-item>
                    </div>
                </div>
                <div class="flex gap-[32px]">
                    <el-form-item label="Người gửi khi gửi hàng thành công" prop="guide"
                        :error="getError('guide')" :inline-message="hasError('guide')">
                        <el-select v-model="formData.guide" class="w-[250px]" placeholder="Chọn phương thức" clearable>
                            <el-option 
                                v-for="item in guides" 
                                :key="item.value" :label="item.label" :value="item.value" 
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Ghi chú" class="w-full" prop="note"
                        :error="getError('note')" :inline-message="hasError('note')">
                        <el-input type="textarea" v-model="formData.note" :rows="2" placeholder="Nhập chú thích (nếu có)" />
                    </el-form-item>
                </div>
                <div class="w-full mb-3">
                    <div class="flex justify-between">
                        <span class="el-form-item__label">Thông tin sản phẩm đơn hàng</span>
                        <el-button color="#0082BE" @click="addProduct">Thêm mới</el-button>
                    </div>
                    <div class="mt-[8px]">
                        <DataTable
                        :fields="fields" :items="formData.products" 
                        footer-center :tableHeight="250" :emtyDefault="true"
                        paginate-background
                    >
                        <template #action="{ row }">
                            <div class="flex justify-center gap-1">
                                <el-button type="danger" @click="deleteProduct(row)"> 
                                    Xóa bỏ
                                </el-button>
                                <el-button type="info" @click="editProduct(row)"> 
                                    Sửa
                                </el-button>
                            </div>
                        </template>
                    </DataTable>
                    </div>
                </div>
            </el-form>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div class="flex gap-2">
                    <el-button type="info" class="text-sm" @click="cancelForm">Hủy bỏ</el-button>
                    <el-button color="#0082BE" :loading="loadingForm" class="text-sm" @click="doSubmit">Xác nhận</el-button>
                </div>
            </span>
        </template>
        <ProductForm ref="productForm" @change-data-product="changeProduct"/>
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import form from '@/Mixins/form'
import DataTable from '@/Components/DataTable.vue'
import ProductForm from '../Dialog/ProductForm.vue'

export default {
    components: { Head, DataTable, ProductForm },
    props: {
        guides: {
            type: Object || Array,
            default: () => {},
        },
    },
    mixins: [form],
    data: function () {
        return {
            isShowForm: false,
            title: 'Thêm đơn hàng gửi đi',
            loading: false,
            loadingForm: false,
            isProductForm: false,
            provinces: [],
            districts: [],
            formData: {
                type: '',
                full_name: '',
                phone_number: '',
                province_id: '',
                delivery_district_id: '',
                address: '',
                note: '',
                guide: '',
                products: []
            },
            fields: [
                { key: 'name', label: 'Tên hàng', minWidth: 170, align: 'left', headerAlign: 'left' },
                { key: 'quanlity', label: 'Số lượng', minWidth: 100, align: 'left', headerAlign: 'left' },
                { key: 'price', label: 'Giá', minWidth: 140, align: 'left', headerAlign: 'left' },
                { key: 'note', label: 'Note', minWidth: 170, align: 'left', headerAlign: 'left' },
                { key: 'action', label: 'Thao tác', width: 160, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            rules: {
                type: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                full_name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                phone_number: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                province_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                delivery_district_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                guide: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            paginate: [],
            productIndex: 1,
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.formData = {}
                this.provinces = []
                this.districts = []
                this.$refs.form.resetFields()
            }
        }
    },
    methods: {
        async getProvice() {
            await axios.get(route('admin.api.region.province-all'))
                .then(({ data }) => {
                    this.provinces = data.data
                })
        },
        async getDistrict() {
            this.districts = []
            if (this.formData.province_id) {
                await axios.get(route('admin.api.region.get-district', this.formData.province_id))
                    .then(({ data }) => {
                        this.districts = data.data
                    })
            }
        },
        async open(data) {
            this.isShowForm = true
            this.loading = true
            if (data) {
                this.title = 'Cập nhật đơn hàng gửi đi'
                this.formData = {...data}
            } else {
                this.title = 'Thêm đơn hàng gửi đi'   
            }
            await this.getProvice()
            await this.getDistrict()
            this.loading = false
        },
        changeProvince() {
            this.formData.delivery_district_id = ''
            this.getDistrict()
        },
        cancelForm() {
            this.isShowForm = false
        },
        addProduct() {
            this.$refs.productForm.open()
        },
        editProduct(row) {
            this.$refs.productForm.open(row)
        },
        deleteProduct(row) {
            let productIndex = row.id
                ? this.formData.products.findIndex(c => c.id === row.id)
                : this.formData.products.findIndex(c => c.index === row.index)
            
            this.formData.products.splice(productIndex, 1);
        },
        changeProduct(data) {
            let newProduct = { ...data }
            if (newProduct.id || newProduct.index) {
                let productIndex = newProduct.id
                    ? this.formData.products.findIndex(c => c.id === newProduct.id)
                    : this.formData.products.findIndex(c => c.index === newProduct.index)

                this.formData.products[productIndex] = newProduct
            } else {
                newProduct.index = this.productIndex
                this.formData.products.push(newProduct)
                this.productIndex += 1
            }
        },
        async submit() {
            this.loadingForm = true
            let { action, formData } = this.prepareForSubmit()
            const { data, status } = await axios.post(action, formData)
            if (status == 200) {
                this.$message({ message: data?.message, type: status === 200 ? 'success' : 'error' })
                this.loadingForm = false
                this.isShowForm = false
                this.$emit('change-data')
            }
        },
        prepareForSubmit() {
            let formDataReady = {...this.formData}
            if (this.formData?.id) {
                formDataReady.id = this.formData.id
                formDataReady._method = 'PUT'
            }
            return {
                action: this.formData?.id
                    ? route('admin.api.transaction-order-send.update', this.formData?.id)
                    : route('admin.api.transaction-order-send.store'),
                formData: formDataReady,
            }
        }
    }
}
</script>
<style>
#admin-account .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
#admin-account {
    width: 900px;
    margin-top: 10px;
}
#admin-account-product {
    width: 700px;
}
#admin-account-product .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
</style>