<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="profile-form"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">{{ title }}</div>
        </template>
        <div class="my-[12px]">
            <div v-show="!isChangeProfile" class="flex gap-[32px]">
                <div>
                    <el-image :src="user.avatar_default" class="w-[150px] h-[150px]"/>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <div class="flex gap-2">
                        <div class="font-bold">Mã NV: </div>
                        <div>{{ user.uuid }}</div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class="font-bold">Điểm quản lý: </div>
                        <div>{{ user.point_name }}</div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class="font-bold">Email: </div>
                        <div>{{ user.email }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="w-full flex gap-2">
                            <div class="font-bold">Họ tên: </div>
                            <div>{{ user.full_name }}</div>
                        </div>
                        <div class="w-full flex gap-2">
                            <div class="font-bold">Giới tính: </div>
                            <div>{{ user.gender == 1 ? 'Nam' : 'Nữ' }}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="w-full flex gap-2">
                            <div class="font-bold">Số điện thoại: </div>
                            <div>{{ user.phone }}</div>
                        </div>
                        <div class="w-full flex gap-2">
                            <div class="font-bold">Ngày sinh: </div>
                            <div>{{ user.birthday }}</div>
                        </div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class="font-bold">Địa chỉ: </div>
                        <div>{{ user.address }}</div>
                    </div>
                </div>
            </div>
            <el-form v-show="isChangeProfile" ref="form" :model="formData" :rules="rules" label-position="top">
                <div class="flex gap-[32px]">
                    <div class="relative w-[150px] h-[150px]">
                        <el-image :src="formData.avatar"
                            class="w-[150px] h-[150px] border-[1px] rounded-[6px] mt-[12px]"
                        />
                        <div class="absolute top-[100%] right-[28%] flex gap-[4px]">
                            <input @change="changeFileImage" type="file" ref="fileImage" accept=".png, .jpg, .jpeg, .svg" hidden>
                            <div class="w-[30px] h-[30px] flex justify-center items-center bg-[#fff]
                                border-[1px] border-[#c0c4cc] text-[#B0B0B0] rounded-[50%] cursor-pointer"
                                @click="$refs.fileImage.click()"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div class="w-[30px] h-[30px] flex justify-center items-center bg-[#fff]
                                border-[1px] border-[#c0c4cc] text-[#B0B0B0] rounded-[50%] cursor-pointer"
                                @click="deleteImage"
                            >
                                <i class="bi bi-x-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="flex gap-4">
                            <el-form-item label="Họ" class="w-full" prop="first_name"
                                :error="getError('first_name')" :inline-message="hasError('first_name')">
                                <el-input v-model="formData.first_name" placeholder="Nhập họ"/>
                            </el-form-item>
                            <el-form-item label="Tên" class="w-full" prop="last_name"
                                :error="getError('last_name')" :inline-message="hasError('last_name')">
                                <el-input v-model="formData.last_name" placeholder="Nhập tên"/>
                            </el-form-item>
                        </div>
                        <div class="flex gap-4">
                            <el-form-item label="Số điện thoại" class="w-full" prop="phone"
                                :error="getError('phone')" :inline-message="hasError('phone')">
                                <el-input v-model="formData.phone" placeholder="Nhập số điện thoại"/>
                            </el-form-item>
                            <el-form-item label="Giới tính" class="w-full" prop="gender"
                                :error="getError('gender')" :inline-message="hasError('gender')">
                                <el-select v-model="formData.gender" class="w-full" placeholder="Chọn giới tính">
                                    <el-option label="Nam" value="1" />
                                    <el-option label="Nữ" value="2" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <el-form-item label="Ngày sinh" class="w-full" prop="birthday"
                            :error="getError('birthday')" :inline-message="hasError('birthday')">
                            <el-date-picker
                                v-model="formData.birthday"
                                type="date"
                                value-format="YYYY-MM-DD"
                                placeholder="Nhập ngày sinh"
                            />
                        </el-form-item>
                        <el-form-item label="Địa chỉ" class="w-full" prop="address"
                            :error="getError('address')" :inline-message="hasError('address')">
                            <el-input v-model="formData.address" type="textarea" placeholder="Nhập địa chỉ"/>
                        </el-form-item>
                    </div>
                </div>
            </el-form>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div v-if="!isChangeProfile">
                    <el-button color="#0082BE" @click="changeProfile">Thay đổi</el-button>
                </div>
                <div v-else class="flex gap-2">
                    <el-button type="info" @click="changeProfile">Hủy bỏ</el-button>
                    <el-button color="#0082BE" :loading="loadingForm" @click="doSubmit">Xác nhận</el-button>
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
            title: 'Thông tin cá nhân',
            isChangeProfile: false,
            rules: {
                first_name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                last_name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                gender: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                birthday: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                phone: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            user: {},
            formData: {
                first_name: '',
                last_name: '',
                gender: '',
                phone: '',
                address: '',
                is_delete_avatar: false,
            },
            fileImage: ''
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.isChangeProfile = false
                this.$refs.form.resetFields()
                this.formData = {}
                this.user = {}
                this.fileImage = null
            }
        }
    },
    methods: {
        open() {
            this.isShowForm = true
            axios.get(route('admin.api.get-profile'))
                .then(({data}) => {
                    this.user = data.data
                    this.formData = { ...data.data }
                })
        },
        cancelForm() {
            this.isShowForm = false
        },
        changeProfile() {
            this.isChangeProfile = !this.isChangeProfile
            if (this.isChangeProfile) {
                this.title = 'Cập nhật thông tin cá nhân'
            } else {
                this.title = 'Thông tin cá nhân'
            }
        },
        changeFileImage(event) {
            if (event.target.files && event.target.files[0]) {
                let file = event.target.files[0]
                this.fileImage = file
                this.formData.avatar = URL.createObjectURL(file)
                this.formData.is_delete_avatar = false
            }
        },
        deleteImage() {
            this.formData.avatar = null
            this.fileImage = null
            this.formData.is_delete_avatar = true
        },
        prepareForSubmit() {
            let formDataReady = {...this.formData}
            if (this.fileImage) {
                formDataReady.file_image = this.fileImage
            }
            formDataReady.is_delete_avatar = this.formData.is_delete_avatar ? 1 : 0
            
            return {
                action: route('admin.api.update-profile'),
                formData: formDataReady,
            }
        },
        async submit() {
            this.loadingForm = true
            let { action, formData } = this.prepareForSubmit()
            const { data, status } = await axios.post(action, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
            if (status == 200) {
                this.$message({ message: data?.message, type: status === 200 ? 'success' : 'error' })
                this.isShowForm = false
                this.loadingForm = false
                setTimeout(() => {
                    this.$emit('change-data', data.data)
                }, 1000);
            }
        },
    }
}
</script>
<style>
#profile-form .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
#profile-form {
    width: 750px;
    margin-top: 70px;
}
</style>