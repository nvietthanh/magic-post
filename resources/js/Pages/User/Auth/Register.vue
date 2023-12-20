<template>
    <Head title="Đăng ký tài khoản"/>
    <div class="sm:pt-[70px] pt-[30px] pb-[80px] flex justify-center items-center">
        <div class="m-auto form-register w-11/12">
            <div class="border-b-[2px] border-[#00000029] px-[30px] py-[18px] text-center text-[#0082be] font-bold text-[20px]">
                ĐĂNG KÝ TÀI KHOẢN
            </div>
            <div class="w-[100%] px-[30px] pt-[24px] pb-[32px]">
                <el-form ref="form" :model="formData" :rules="rules" label-position="top" 
                    @keyup.enter.prevent="doSubmit">
                    <div class="grid grid-cols-2 gap-6">
                        <el-form-item label="Họ" prop="first_name" :inline-message="hasError('first_name')" :error="getError('first_name')">
                            <el-input v-model="formData.first_name" placeholder="Nhập họ"/>
                        </el-form-item>
                        <el-form-item label="Tên" prop="last_name" :inline-message="hasError('last_name')" :error="getError('last_name')">
                            <el-input v-model="formData.last_name" placeholder="Nhập tên"/>
                        </el-form-item>
                    </div>
                    <div class="md:flex block gap-6">
                        <el-form-item label="Giới tính" prop="gender" :inline-message="hasError('gender')" :error="getError('gender')">
                            <el-select v-model="formData.gender" placeholder="Chọn giới tính">
                                <el-option key="1" label="Nam" value="1"/>
                                <el-option key="2" label="Nữ" value="2"/>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Ngày sinh" prop="birthday" :inline-message="hasError('birthday')" :error="getError('birthday')">
                            <el-date-picker
                                v-model="formData.birthday"
                                type="date"
                                value-format="YYYY-MM-DD"
                                placeholder="Nhập ngày sinh"
                            />
                        </el-form-item>
                    </div>
                    <div class="md:flex block gap-6">
                        <el-form-item label="Email" prop="email" :inline-message="hasError('email')" :error="getError('email')">
                            <el-input v-model="formData.email" placeholder="Nhập email"/>
                        </el-form-item>
                        <el-form-item label="Số điện thoại" prop="phone" :inline-message="hasError('phone')" :error="getError('phone')">
                            <el-input v-model="formData.phone" placeholder="Nhập số điện thoại"/>
                        </el-form-item>
                    </div>
                    <el-form-item label="Địa chỉ" prop="address" :inline-message="hasError('address')" :error="getError('address')">
                        <el-input type="textarea" v-model="formData.address" placeholder="Nhập địa chỉ"/>
                    </el-form-item>
                    <el-form-item label="Mật khẩu" prop="password" :inline-message="hasError('password')" :error="getError('password')">
                        <el-input v-model="formData.password" type="password" placeholder="Nhập mật khẩu" show-password/>
                    </el-form-item>
                    <el-form-item label="Xác nhận mật khẩu" prop="password_confirmation" :inline-message="hasError('password_confirmation')" :error="getError('password_confirmation')">
                        <el-input v-model="formData.password_confirmation" type="password" placeholder="Nhập mật khẩu xác nhận" show-password/>
                    </el-form-item>
                    <div class="flex justify-center">
                        <el-button type="primary" :loading="loadingForm" @click="doSubmit">Đăng ký</el-button>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import form from '@/Mixins/form'

export default {
    components: { Head, Link },
    mixins: [form],
    data: function () {
        return {
            loadingForm: false,
            formData: {
                first_name: '',
                last_name: '',
                address: '',
                gender: '',
                birth_day: '',
                email: '',
                phone_number: '',
                password: '',
                password_confirmation: '',
            },
            rules: {
                first_name: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                last_name: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                address: [{ required: false, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                gender: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                email: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                birthday: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                phone: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                password: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                password_confirmation: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
            },
        }
    },
    methods: {
        async submit() {
            this.loadingForm = true
            const { data, status } = await axios.post(route('auth.register-store'), this.formData)
            if (status == 200) {
                this.$message({ message: data?.message, type: status === 200 ? 'success' : 'error' })
                this.loadingForm = false
                this.$inertia.visit(route('user.home'))
            }
        },
    }
}
</script>
<style>
.form-register {
    border-radius: 5px;
    opacity: 1;
    padding: 2px;
    max-width: 500px;
    background: #fff;
    box-shadow: 0px 3px 6px #00000029;
}

</style>