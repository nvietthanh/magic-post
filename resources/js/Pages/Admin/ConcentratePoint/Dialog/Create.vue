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
        <div class="overflow-scroll">
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
                            @change="getDistrict"
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
            provinces: [],
            districts: [],
            formData: {
                name: '',
                province_id: '',
                district_id: '',
            },
            rules: {
                name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                province_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                district_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
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
            if (data) {
                this.title = 'Cập nhật điểm giao dịch'
                this.formData = {...data}
            } else {
                this.title = 'Thêm điểm giao dịch'   
            }
            await this.getProvice()
            await this.getDistrict()
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
    width: 600px;
    margin-top: 70px;
}
</style>