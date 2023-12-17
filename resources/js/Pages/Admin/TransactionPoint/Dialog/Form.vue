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
                <el-form-item label="Tên điểm giao dịch" class="w-full" prop="name"
                    :error="getError('name')" :inline-message="hasError('name')">
                    <el-input type="text" v-model="formData.name" placeholder="Nhập tên điểm giao dịch" />
                </el-form-item>
                <div class="flex gap-[32px]">
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
                    <el-form-item label="Huyện" class="w-[200px]" prop="district_id"
                        :error="getError('district_id')" :inline-message="hasError('district_id')">
                        <el-select v-model="formData.district_id" class="w-full" placeholder="Chọn huyện">
                            <el-option 
                                v-for="item in districts" 
                                :key="item.id" :label="item.name" :value="item.id" 
                            />
                        </el-select>
                    </el-form-item>
                </div>
                <el-form-item label="Địa chỉ" prop="address"
                    :error="getError('address')" :inline-message="hasError('address')">
                    <el-input type="textarea" v-model="formData.address" 
                        placeholder="Nhập địa chỉ cụ thể  (Số nhà, ngõ, thôn, xã/phường)" />
                </el-form-item>
                <div class="flex gap-[32px]">
                    <el-form-item label="Trưởng điểm giao dịch" class="w-full" prop="admin_head_id"
                        :error="getError('admin_head_id')" :inline-message="hasError('admin_head_id')">
                        <el-select v-model="formData.admin_head_id" class="w-full"
                            placeholder="Chọn trưởng nhân viên"
                        >
                            <el-option 
                                v-for="item in headAdmins" 
                                :key="item.id" :label="item.admin_profile.full_name" :value="item.id" 
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Chọn nhân viên" class="w-full" prop="manager_ids"
                        :error="getError('manager_ids')" :inline-message="hasError('manager_ids')">
                        <el-select v-model="formData.manager_ids" class="w-full" placeholder="Chọn nhân viên" multiple>
                            <el-option 
                                v-for="item in managerAdmins" 
                                :key="item.id" :label="item.admin_profile.full_name" :value="item.id" 
                            />
                        </el-select>
                    </el-form-item>
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
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import form from '@/Mixins/form'

export default {
    components: { Head, },
    mixins: [form],
    async created() {
    },
    data: function () {
        return {
            isShowForm: false,
            title: 'Thêm điểm giao dịch',
            loading: false,
            loadingForm: false,
            provinces: [],
            districts: [],
            headAdmins: [],
            managerAdmins: [],
            formData: {
                name: '',
                province_id: '',
                district_id: '',
                address: '',
                admin_head_id: '',
                manager_ids: []
            },
            rules: {
                name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                province_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                district_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.formData = {}
                this.headAdmins = []
                this.districts = []
                this.$refs.form.resetFields()
            }
        }
    },
    methods: {
        async getDistrict() {
            this.districts = []
            if (this.formData.province_id) {
                let params = {
                    'province_id': this.formData.province_id,
                    'transaction_id': this.formData.id
                }
                await axios.get(route('admin.api.transaction-point.get-district', params))
                    .then(({ data }) => {
                        this.districts = data.data
                    })
            }
        },
        async getAdmin() {
            let params = {
                id: this.formData.id
            }
            await axios.get(route('admin.api.transaction-point.get-admin', params))
                .then(({ data }) => {
                    this.headAdmins = data.data.head_admins
                    this.managerAdmins = data.data.manager_admins
                })
        },
        async open(provinces, data) {
            this.isShowForm = true
            this.loading = true
            this.provinces = provinces
            if (data) {
                this.title = 'Cập nhật điểm giao dịch'
                this.formData = {...data}
            } else {
                this.title = 'Thêm điểm giao dịch'   
            }
            await this.getAdmin()
            await this.getDistrict()
            this.loading = false
        },
        changeProvince() {
            this.formData.district_id = ''
            this.getDistrict()
        },
        cancelForm() {
            this.isShowForm = false
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
                    ? route('admin.api.transactioin-point.update', this.formData?.id)
                    : route('admin.api.transactioin-point.store'),
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
    width: 700px;
    margin-top: 70px;
}
</style>