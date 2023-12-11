<template>
    <div id="header" class="fixed top-0 left-[0px] right-[0px] bg-[#0082be] text-[#fff] border-b-[2px] border-b-[#fff]">
        <div class="h-[50px] md:h-[60px]">
            <div class="header-main">
                <div class="w-full flex justify-between items-center">
                    <Link :href="route('admin.dashboard')" class="hidden md:block">
                        <div class="flex justify-between items-center">
                            <div class="lg:block hidden uppercase text-[18px]">
                                MAGIC POST
                            </div>
                        </div>
                    </Link>
                    <div class="ml-3 flex items-center mr-5">
                        <el-dropdown trigger="click" class="h-full">
                            <div class="el-dropdown-link flex items-center justify-center text-white gap-[4px]">
                                <el-image :src="user.avatar" class="w-[32px] h-[32px] rounded-[50%]"/>
                                <div>
                                    <div class="text-[18px]">{{ user.full_name }}</div>
                                    <div class="text-[12px] text-center mt-[4px]">{{ getRoleName(user.role) }}</div>
                                </div>
                            </div>
                            <template #dropdown>
                                <el-dropdown-menu class="w-48">
                                    <div @click="openChangeProfile()">
                                        <el-dropdown-item command="profile">
                                            <div class="flex items-center gap-[4px]">
                                                <i class="bi bi-person-circle text-[18px]"></i>
                                                <span class="whitespace-nowrap">Thông tin cá nhân</span>
                                            </div>
                                        </el-dropdown-item>
                                    </div>
                                    <div @click="changePassword()">
                                        <el-dropdown-item>
                                            <div class="flex items-center gap-[4px]">
                                                <i class="bi bi-key-fill text-[20px]"></i>
                                                <span class="whitespace-nowrap">Đổi mật khẩu</span>
                                            </div>
                                        </el-dropdown-item>
                                    </div>
                                    <div @click="logOut()">
                                        <el-dropdown-item>
                                            <div class="flex items-center gap-[5px]">
                                                <i class="bi bi-box-arrow-right text-[18px]"></i>
                                                <span class="whitespace-nowrap">Đăng xuất</span>
                                            </div>
                                        </el-dropdown-item>
                                    </div>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ChangePassword ref="changePassword"/>
    <ProfileForm ref="profileForm" @change-data="changeDataProfile"/>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import ChangePassword from '@/Components/Admin/Profile/ChangePassword.vue'
import ProfileForm from '@/Components/Admin/Profile/ProfileForm.vue'

export default {
    components: { Link, ChangePassword, ProfileForm },
    data() {
        return {
            user: this.$page?.props?.auth.user,
        }
    },
    methods: {
        openChangeProfile() {
            this.$refs.profileForm.open()
        },
        changePassword() {
            this.$refs.changePassword.open()
        },
        logOut() {
            axios.post(route('admin.api.logout'))
                .then(({ data }) => {
                    this.$message({ message: data?.message, type: 'success' })
                    this.$inertia.visit(route('admin.login'))
                })
                .catch((error) => {
                    this.$message({ message: error?.message, type: 'error' })
                })
        },
        changeDataProfile(data) {
            window.location.reload()
        }
    }
}
</script>