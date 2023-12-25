<template>
    <div class="py-[18px] mb-[2px]">
        <div class="footer-main text-white md:grid md:grid-cols-4">
            <div class="md:py-[0px] py-[12px]">
                <div class="uppercase">
                    Danh sách sản phẩm
                </div>
                <div>
                    <Link :href="route('user.home')" class="block mt-[4px]">
                        - Điện thoại
                    </Link>
                    <Link :href="route('user.home')" class="block mt-[4px]">
                        - Máy tính bảng
                    </Link>
                    <Link :href="route('user.home')" class="block mt-[4px]">
                        - Laptop
                    </Link>
                    <Link :href="route('user.home')" class="block mt-[4px]">
                        - Phụ kiện điện thoại
                    </Link>
                    <Link :href="route('user.home')" class="block mt-[4px]">
                        - Phụ kiện máy tính
                    </Link>
                </div>
            </div>
            <div class="md:py-[0px] py-[12px]">
                <Link :href="route('user.home')" class="block md:mb-[8px] mb-[4px]">
                    Thông tin về công ty
                </Link>
                <Link :href="route('user.home')" class="block md:mb-[8px] mb-[4px]">
                    Tuyển dụng
                </Link>
                <Link :href="route('user.home')" class="block md:mb-[8px] mb-[4px]">
                    Gửi góp ý, liên hệ
                </Link>
                <Link :href="route('user.home')" class="block md:mb-[8px] mb-[4px]">
                    Chính sách đổi trả
                </Link>
                <Link :href="route('user.home')" class="block md:mb-[8px] mb-[4px]">
                    Chính sách bảo mật
                </Link>
            </div>
            <div class="md:py-[0px] py-[12px]">
                <div class="md:mb-[8px] mb-[4px]">
                    Tổng đài hỗ trợ (Miễn phí gọi)
                </div>
                <div class="md:mb-[8px] mb-[4px]">
                    Gọi mua: 1800.1060 (7:30 - 22:00)
                </div>
                <div class="md:mb-[8px] mb-[4px]">
                    Khiếu nại: 800.1062 (8:00 - 21:30)
                </div>
                <div class="md:mb-[8px] mb-[4px]">
                    Bảo hành: 1800.1064 (8:00 - 21:00)
                </div>
            </div>
            <div class="md:py-[0px] py-[12px]">
                <div class="md:mb-[8px] mb-[4px]">
                    Nền tảng mạng xã hội
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    },
    data() {
        return {
        }
    },
}
</script>