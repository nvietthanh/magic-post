<template>
    <header v-if="isHeader" class="relative" style="z-index: 100;">
        <Header />
    </header>
    <main>
        <div class="main min-h-[90vh]">
            <slot name="main"/>
        </div>
    </main>
    <footer v-if="isFooter" class="bg-[#0082be]">
        <Footer />
    </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import Header from '@/Layouts/User/Header.vue'
import Footer from '@/Layouts/User/Footer.vue'

export default {
    components: {
        Link, Header, Footer
    },
    props: {
        isHeader: { type: Boolean, default: true },
        isFooter: { type: Boolean, default: true },
    },
    data() {
        return {
        }
    },
}
</script>

<style>
.header-main {
    height: 100%;
    width: 1100px;
    max-width: 1100px;
    margin: auto;
    padding: 0 12px;
    display: flex;
    justify-content: space-between;
}
header > #header {
    box-shadow: 4px 4px 4px #1f1f1f1f;
}
.header-menu {
    width: 1100px;
    max-width: 1100px;
    margin: 0 auto;
    padding: 4px 12px 0 18px;
}
.header-main input[type="text"] {
    --tw-ring-color: none;
}
main .main {
    width: 1100px;
    max-width: 1100px;
    margin: 0 auto;
    margin-top: 60px;
    border: 1px solid #e7e7e7;
    padding: 12px 18px;
    box-shadow: 0 4px 4px 2px #e7e7e7;
    margin-bottom: 30px;
    margin-top: 64px;
}
footer .footer-search,
footer .footer-main {
    margin: 0 auto;
    width: 1100px;
    max-width: 1100px;
    margin-bottom: 12px;
}
@media only screen and (max-width: 1024px) {
    .header-menu,
    .header-main,
    .main,
    .footer-search,
    .footer-main{
        padding: 0 12px 0 8px;
        width: 100% !important;
    }
    .header-menu {
        padding-top: 8px;
    }
    .main{
        padding: 0 8px;
    }
}
@media only screen and (max-width: 576px) {
    #header-menu:hover #list-menu{
        display: none;
    }
    main .main {
        padding: 12px;
        margin-top: 54px;
    }
}
</style>