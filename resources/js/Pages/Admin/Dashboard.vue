<template>
    <Head title="Trang thống kê" />
    <AppLayout>
        <template v-slot:main>
            a
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/Admin/AdminLayout.vue';
// import Paginate from '@/Components/Pagination/Paginate.vue';

export default {
    components: {
        Head,
        Link,
        AppLayout,
    },
    async created() {
    },
    data: function () {
        return {
            openMenuMobile: false,
            cartNumber: 1,
            errors: [],
            paginate: [],
            filter: {
                limit: 15,
                page: 1,
                sort: 'default',
                sub_category: [],
                price: {
                    min: '',
                    max: ''
                },
                vote: '',
            },
        }
    },
    methods: {
        searchProduct() {
            console.log(this.filter)
            this.openMenuMobile = false
        },
        handleCurrentPage(value) {
            this.filter.page = value
        },
    }
}
</script>
<style>
[type='text']:focus {
    --tw-ring-color: #000;
}
</style>