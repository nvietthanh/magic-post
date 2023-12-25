i,8<template>
    <div id="header" class="fixed top-0 left-[0px] right-[0px] bg-[#0082be] text-[#fff] border-b-[2px] border-b-[#fff]">
        <div class="h-[58px] md:h-[60px]">
            <div class="header-main">
                <div class="w-full flex justify-between items-center">
                    <Link :href="route('user.home')">
                        <div class="flex justify-between items-center">
                            <div class="uppercase text-[18px]">
                                MAGIC POST
                            </div>
                        </div>
                    </Link>
                    <div class="ml-3 flex items-center mr-5">
                        <template v-if="!user">
                            <div class="flex gap-4">
                                <Link :href="route('auth.login')">
                                    Đăng nhập
                                </Link>
                                <Link :href="route('auth.register')">
                                    Đăng ký
                                </Link>
                            </div>
                        </template>
                        <template v-else>
                            <el-dropdown trigger="click" class="h-full">
                                <div class="el-dropdown-link flex items-center justify-center text-white gap-[4px]">
                                    <el-image :src="user.avatar" class="w-[28px] h-[28px] rounded-[50%]"/>
                                    <div class="text-[18px]">{{ user.full_name }}</div>
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
                                        <div @click="checkOrderStatus()">
                                            <el-dropdown-item>
                                                <div class="flex items-center gap-[4px]">
                                                    <i class="bi bi-bag-plus text-[20px]"></i>
                                                    <span class="whitespace-nowrap">Tra cứu đơn hàng</span>
                                                </div>
                                            </el-dropdown-item>
                                        </div>
                                        <div @click="logOut()">
                                            <el-dropdown-item>
                                                <div class="flex items-center gap-[5px]">
                                                    <i class="bi bi-box-arrow-right text-[20px]"></i>
                                                    <span class="whitespace-nowrap">Đăng xuất</span>
                                                </div>
                                            </el-dropdown-item>
                                        </div>
                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>
                        </template>
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
import ChangePassword from '@/Components/User/Profile/ChangePassword.vue'
import ProfileForm from '@/Components/User/Profile/ProfileForm.vue'

export default {
    components: { Link, ChangePassword, ProfileForm },
    data() {
        return {
            user: this.$page?.props?.auth?.user,
        }
    },
    methods: {
        openChangeProfile() {
            this.$refs.profileForm.open()
        },
        changePassword() {
            this.$refs.changePassword.open()
        },
        checkOrderStatus() {
            this.$inertia.visit(route('user.order.index'))
        },
        logOut() {
            axios.post(route('user.api.logout'))
                .then(({ data }) => {
                    this.$message({ message: data?.message, type: 'success' })
                    this.$inertia.visit(route('user.home'))
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