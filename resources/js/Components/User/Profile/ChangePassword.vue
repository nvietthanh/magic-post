<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="change-password"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">Thay đổi mật khẩu</div>
        </template>
        <div class="overflow-scroll">
            <el-form ref="form" :model="formData" :rules="rules" label-position="top">
                <el-form-item label="Mật khẩu cũ" class="w-full" prop="old_password"
                    :error="getError('old_password')" :inline-message="hasError('old_password')">
                    <el-input v-model="formData.old_password" type="password" placeholder="Nhập mật khẩu cũ" show-password/>
                </el-form-item>
                <el-form-item label="Mật khẩu" class="w-full" prop="password"
                    :error="getError('password')" :inline-message="hasError('password')">
                    <el-input v-model="formData.password" type="password" placeholder="Nhập mật khẩu mới" show-password/>
                </el-form-item>
                <el-form-item label="Xác nhận mật khẩu" class="w-full" prop="password_confirmation"
                    :error="getError('password_confirmation')" :inline-message="hasError('password_confirmation')">
                    <el-input v-model="formData.password_confirmation" type="password" placeholder="Nhập mật khẩu xác nhận" show-password/>
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
    data: function () {
        return {
            isShowForm: false,
            rules: {
                old_password: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                password: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                password_confirmation: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            formData: {
                old_password: '',
                password: '',
                password_confirmation: ''
            },
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.formData = {}
                this.$refs.form.resetFields()
            }
        }
    },
    methods: {
        open() {
            this.isShowForm = true
        },
        cancelForm() {
            this.isShowForm = false
        },
        async submit() {
            this.loadingForm = true
            const { data, status } = await axios.post(route('user.api.change-password'), this.formData)
            if (status == 200) {
                this.$message({ message: data?.message, type: status === 200 ? 'success' : 'error' })
                this.loadingForm = false
                this.isShowForm = false
            }
        },
    }
}
</script>
<style>
#change-password .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
#change-password {
    width: 500px;
    margin-top: 70px;
}
@media only screen and (max-width: 576px) {
    #change-password {
        width: calc(100% - 16px);
    }
}
</style>