<template>
    <div class="py-[12px] w-full" id="slider">
        <template v-for="(menu, index) in menus" :key="index">
            <div
                v-if="checkRoles(menu.roles)"
                class="menu-item cursor-pointer px-[18px] mb-[4px] h-[56px] flex items-center gap-[12px]"
                :class="checkActive(menu.pathActive) ? 'active' : ''"
                @click="clickMenuItem(menu.route)"
            >
                <i class="bi" :class="menu.icon" style="font-size: 24px;"></i>
                <span>{{ menu.label }}</span>
            </div>
        </template>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { isArray, isEmpty } from 'lodash'
import { MENUS } from '@/Store/Consts/menu'

export default {
    components: {
        Link
    },
    data() {
        return {
            menus: MENUS,
            user: this.$page?.props?.auth.user
        }
    },
    created() {
        this.getCurrentUrl()
    },
    methods: {
        getCurrentUrl() {
            const pathname = window.location.pathname.split('/')
            const menus = MENUS.map(item => item.pathActive)
            let currentUrl = pathname.filter(element => menus.includes(element)).toString()
            if (currentUrl == 'topic-forums') {
                currentUrl = 'forums'
            }
            this.defaultActive = currentUrl || 'dashboard'
            this.pathSubmenu = window.location.pathname.split('/')
            this.pathSubmenuItem = window.location.pathname
                ?.split('/')
                ?.slice(0, 4)
                .join('/')
        },

        checkActive(pathActive) {
            if (isArray(pathActive) && !isEmpty(pathActive)) {
                return pathActive.includes(this.pathSubmenu[2])
            }

            return pathActive == this.pathSubmenu[2]
        },

        clickMenuItem(routePath) {
            this.$inertia.visit(route(routePath))
        }
    }
}
</script>
<style>
#slider .menu-item:not(.active) {
    margin-left: 5px;
}

#slider .menu-item.active {
    border-left: 6px solid #0082be;
    color: #0082be;
    background-color: #d3f5ff;
}
</style>