<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="admin-account-product"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">
                {{ title }}
            </div>
        </template>
        <div>
            <el-form ref="form" :model="formData" :rules="rule" label-position="top">
                <el-form-item label="Tên loại hàng" prop="name"
                    :error="getError('name')" :inline-message="hasError('name')">
                    <el-input v-model="formData.name" placeholder="Nhập tên loại hàng" />
                </el-form-item>
                <div class="flex gap-[32px]">
                    <el-form-item label="Số lượng" class="w-full" prop="quanlity"
                        :error="getError('quanlity')" :inline-message="hasError('quanlity')">
                        <el-input type="number" v-model="formData.quanlity" placeholder="Nhập số lượng" />
                    </el-form-item>
                    <el-form-item label="Giá tiền" class="w-full" prop="price"
                        :error="getError('price')" :inline-message="hasError('price')">
                        <el-input type="number" v-model="formData.price" placeholder="Nhập giá tiền" />
                    </el-form-item>
                </div>
                <el-form-item label="Khối lượng" prop="weight"
                    :error="getError('weight')" :inline-message="hasError('weight')">
                    <el-input type="number" v-model="formData.weight" placeholder="Nhập khối lượng hàng" />
                </el-form-item>
                <el-form-item label="Chú thích" class="w-full" prop="note"
                    :error="getError('note')" :inline-message="hasError('note')">
                    <el-input type="textarea" v-model="formData.note" :rows="2" placeholder="Nhập chú thích (nếu có)" />
                </el-form-item>
            </el-form>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div class="flex gap-2">
                    <el-button color="#0082BE" :loading="loadingForm" class="text-sm" @click="doSubmit">Xác nhận</el-button>
                </div>
            </span>
        </template>
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import form from '@/Mixins/form'
import DataTable from '@/Components/DataTable.vue'

export default {
    components: { Head, DataTable },
    props: {
        guides: {
            type: Object || Array,
            default: () => {},
        },
    },
    mixins: [form],
    data: function () {
        return {
            isShowForm: false,
            title: 'Thêm sản phẩm trong đơn hàng',
            loadingForm: false,
            formData: {
                name: '',
                quanlity: '',
                price: '',
                note: '',
                weight: ''
            },
            rule: {
                name: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                quanlity: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                price: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                weight: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            type: ''
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.formData = {}
                this.$refs.form.resetFields()
            }
        }
    },
    methods: {
        async open(type, data) {
            this.isShowForm = true
            this.loading = true
            this.type = type
            if (data) {
                this.title = 'Cập nhật sản phẩm trong đơn hàng'
                this.formData = {...data}
            } else {
                this.title = 'Thêm sản phẩm trong đơn hàng'   
            }
            this.loading = false
        },
        async submit() {
            this.$emit('change-data-product', this.formData)
            this.isShowForm = false
        },
    }
}
</script>
<style>
#admin-account-product {
    width: 700px;
}
#admin-account-product .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
</style>