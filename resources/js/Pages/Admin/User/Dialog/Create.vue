<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="user-account"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">
                {{ title }}
            </div>
        </template>
        <div class="overflow-scroll">
            <el-form ref="form" :model="formData" :rules="rules" label-position="top">
                <div class="flex gap-8">
                    <el-form-item label="Họ" class="w-full" prop="first_name"
                        :error="getError('first_name')" :inline-message="hasError('first_name')">
                        <el-input v-model="formData.first_name" placeholder="Nhập họ"/>
                    </el-form-item>
                    <el-form-item label="Tên" class="w-full" prop="last_name"
                        :error="getError('last_name')" :inline-message="hasError('last_name')">
                        <el-input v-model="formData.last_name" placeholder="Nhập tên" />
                    </el-form-item>
                </div>
                <div class="flex gap-8">
                    <el-form-item label="Email" class="w-[60%]" prop="email"
                        :error="getError('email')" :inline-message="hasError('email')">
                        <el-input v-model="formData.email" placeholder="Nhập email" />
                    </el-form-item>
                    <el-form-item label="Trạng thái" prop="status"
                        :error="getError('status')" :inline-message="hasError('status')">
                        <el-switch 
                            v-model="formData.status"
                            active-text="Active"
                            inactive-text="Deactive"/>
                    </el-form-item>
                </div>
                <div class="flex gap-8 w-[80%]">
                    <el-form-item label="Giới tính" class="w-full" prop="gender"
                        :error="getError('gender')" :inline-message="hasError('gender')">
                        <el-select v-model="formData.gender" class="w-full" placeholder="Chọn giới tính">
                            <el-option label="Nam" value="1" />
                            <el-option label="Nữ" value="2" />
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Số điện thoại" class="w-full" prop="phone"
                        :error="getError('phone')" :inline-message="hasError('phone')">
                        <el-input v-model="formData.phone" placeholder="Nhập số điện thoại" />
                    </el-form-item>
                </div>
                <el-form-item label="Địa chỉ thường trú" class="w-full" prop="address"
                    :error="getError('address')" :inline-message="hasError('address')">
                    <el-input type="textarea" v-model="formData.address" placeholder="Nhập địa chỉ thường trú" />
                </el-form-item>
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
            title: 'Thêm tài khoản',
            rules: {
                first_name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                last_name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                email: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                gender: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                phone: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            formData: {
                email: '',
                gender: '',
                first_name: '',
                last_name: '',
                phone: '',
                address: '',
                status: true,
            },
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.formData = {}
                this.formData.status = true
                this.$refs.form.resetFields()
            }
        }
    },
    methods: {
        open(data) {
            this.isShowForm = true
            if (data) {
                this.title = 'Cập nhật tài khoản'
                this.formData = {...data}
            } else {
                this.title = 'Thêm tài khoản'   
            }
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
                    ? route('admin.api.user.update', this.formData?.id)
                    : route('admin.api.user.store'),
                formData: formDataReady,
            }
        }
    }
}
</script>
<style>
#user-account .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
#user-account {
    width: 600px;
}
</style>