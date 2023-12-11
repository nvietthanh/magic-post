<template>
    <header v-if="isHeader" class="relative" style="z-index: 100;">
        <Header />
    </header>
    <main>
        <div class="main min-h-[90vh]">
            <div class="main-menu">
                <SideBar />
            </div>
            <slot name="main"/>
        </div>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import Header from '@/Layouts/Admin/Header.vue'
import SideBar from '@/Layouts/Admin/SideBar.vue'

export default {
    components: {
        Link, Header, SideBar
    },
    props: {
        isHeader: { type: Boolean, default: true },
    },
    data() {
        return {
        }
    },
}
</script>

<style>
body {
    background-color: #ededed;
}
.header-main {
    height: 100%;
    padding: 0 12px;
    display: flex;
    justify-content: space-between;
}
#header .header-main input[type="text"] {
    --tw-ring-color: none;
}
main .main {
    margin-top: 60px;
    margin-left: calc(270px + 15px);
    margin-right: 15px;
    background-color: #fff;
    padding: 0 18px;
}
main .main .main-menu {
    position: fixed;
    top: 60px;
    left: 0;
    bottom: 0;
    background-color: #fff;
    width: 270px;
    border: 1px solid #d0d0d0;
}
.el-dropdown-menu__item {
    height: 36px !important;
}
footer .footer-search,
footer .footer-main {
    margin: 0 auto;
    width: 1100px;
    max-width: 1100px;
    margin-bottom: 12px;
}
.el-drawer__body {
    padding: 8px 18px;
    overflow-y: scroll;
}
</style>