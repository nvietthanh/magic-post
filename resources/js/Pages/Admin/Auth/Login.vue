<template>
    <Head title="Đăng nhập"/>
    <main>
        <div class="h-screen flex justify-center items-center bg-[#ededed]">
            <div class="m-auto form-login w-10/12">
                <div class="border-b-[2px] border-[#00000029] px-[30px] py-[18px] text-center text-[#0082be] font-bold text-[20px]">
                    ĐĂNG NHẬP
                </div>
                <div class="px-[30px] pt-[24px] pb-[32px]">
                    <el-form ref="form" :model="formData" :rules="rules" label-position="top" 
                    @keyup.enter.prevent="doSubmit">
                        <el-form-item label="Email" :inline-message="hasError('email')" :error="getError('email')"
                        >
                            <el-input v-model="formData.email" placeholder="Nhập email đăng nhập" />
                        </el-form-item>
                        <el-form-item label="Mật khẩu" :inline-message="hasError('password')" :error="getError('password')"
                        >
                            <el-input v-model="formData.password" type="password" placeholder="Nhập email đăng nhập" 
                                show-password/>
                        </el-form-item>
                        <div class="flex justify-center mt-[32px]">
                            <el-button type="primary" color="#0082BE" :loading="loadingForm" @click="doSubmit">
                                Đăng nhập
                            </el-button>  
                        </div>
                    </el-form>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import form from '@/Mixins/form'
import axios from 'axios';

export default {
    name: 'AdminLogin',
    components: { Head, Link,},
    mixins: [form],
    data: function () {
        return {
            loadingForm: false,
            formData: {
                email: '',
                password: ''
            },
            rules: {
                email: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
                password: [{ required: true, message: 'Trường này là bắt buộc', trigger: ['change', 'blur'] }],
            },

        }
    },
    methods: {
        async submit() {
            this.loadingForm = true
            const { data, status } = await axios.post(route('admin.store-login'), this.formData)
            if (status == 200) {
                this.$message({ message: data?.message, type: status === 200 ? 'success' : 'error' })
                this.loadingForm = false
                this.$inertia.visit(route('admin.dashboard'))
            }
        },
    }
}
</script>
<style>
.form-login {
    border-radius: 5px;
    opacity: 1;
    padding: 2px;
    max-width: 450px;
    background: #fff;
    box-shadow: 0px 3px 6px #00000029;
}

</style>