<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="admin-account-show"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">Thông tin chi tiết đơn hàng</div>
        </template>
        <div>
            <div class="grid grid-cols-3 gap-[32px]">
                <div class="flex gap-[12px]">
                    <div class="font-bold">Loại đơn hàng:</div>
                    <div>{{ formData.type == 1 ? 'Tài liệu' : 'Hàng hóa' }}</div>
                </div>
                <div class="flex gap-[12px]">
                    <div class="font-bold">Họ tên người gửi:</div>
                    <div>{{ formData.user_name }}</div>
                </div>
                <div class="flex gap-[12px]">
                    <div class="font-bold">Email:</div>
                    <div>{{ formData.email }}</div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-[32px] mt-3">
                <div class="flex gap-[12px]">
                    <div class="font-bold">Họ tên người nhận:</div>
                    <div>{{ formData.full_name }}</div>
                </div>
                <div class="flex gap-[12px]">
                    <div class="font-bold">Số điện thoại người nhận:</div>
                    <div>{{ formData.phone_number }}</div>
                </div>
            </div>
            <div class="w-full border px-4 pt-2 pb-4 mt-3">
                <div class="w-full">
                    <span class="uppercase font-bold">Địa chỉ giao hàng</span>
                </div>
                <div class="px-4 mt-[8px]">
                    <div class="grid grid-cols-2 gap-[12px]">
                        <div class="flex gap-[12px]">
                            <div class="font-bold">Điểm tiếp nhận:</div>
                            <div>{{ formData.receive_district_name }}</div>
                        </div>
                        <div class="flex gap-[12px]">
                            <div class="font-bold">Điểm giao hàng:</div>
                            <div>{{ formData.delivery_district_name }}</div>
                        </div>
                    </div>
                    <div class="flex gap-[12px] mt-[8px]">
                        <div class="font-bold">Địa chỉ cụ thể giao hàng:</div>
                        <div>{{ formData.address }}</div>
                    </div>
                </div>
            </div>
            <div class="flex gap-[12px] mt-2">
                <div class="font-bold">Người gửi khi gửi hàng thành công:</div>
                <div>{{ formData.guide_text }}</div>
            </div>
            <div class="flex gap-[12px] mt-2">
                <div class="font-bold">Ghi chú (nếu có):</div>
                <div>{{ formData.note }}</div>
            </div>
            <div class="w-full mb-3 mt-2">
                <div class="flex justify-between">
                    <span class="font-bold">Thông tin sản phẩm đơn hàng:</span>
                </div>
                <div class="mt-[8px]">
                    <DataTable
                    :fields="fields" :items="formData.products" 
                    footer-center :tableHeight="250" :emtyDefault="true"
                    paginate-background
                >
                </DataTable>
                </div>
            </div>
            <el-form v-if="!hiddenForm" 
                ref="form" :model="formDataChange" :rules="rules" label-position="top"
            >
                <div class="flex gap-[32px]">
                    <div>
                        <div class="flex justify-between">
                            <span class="font-bold">Xác nhận tiếp nhận đến điểm giao dịch đích:</span>
                        </div>
                        <el-switch size="large" v-model="formDataChange.statusOrder" :disabled="disableStatus" @change="this.formDataChange.concentrate_point_id = ''"/>
                    </div>
                </div>
            </el-form>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div class="flex gap-2">
                    <el-button type="info" class="text-sm" @click="cancelForm">Hủy bỏ</el-button>
                    <template v-if="!hiddenForm">
                        <el-button v-if="!disableStatus" type="primary" :loading="loadingForm" @click="doSubmit">
                            Xác nhận
                        </el-button>
                    </template>
                </div>
            </span>
        </template>
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import DataTable from '@/Components/DataTable.vue'
import { TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE, RETURN_TO_TRANSACTION } from '@/Store/Consts/oderStatus'
import form from '@/Mixins/form'

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
            loadingForm: false,
            formData: {},
            fields: [
                { key: 'name', label: 'Tên hàng', minWidth: 170, align: 'left', headerAlign: 'left' },
                { key: 'quanlity', label: 'Số lượng', minWidth: 100, align: 'left', headerAlign: 'left' },
                { key: 'price', label: 'Giá', minWidth: 140, align: 'left', headerAlign: 'left' },
                { key: 'note', label: 'Note', minWidth: 170, align: 'left', headerAlign: 'left' },
            ],
            paginate: [],
            disableStatus: false,
            hiddenForm: false,
            formDataChange: {
                statusOrder: false,
            },
            rules: {
                statusOrder: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
        }
    },
    watch: {
        isShowForm(val) {
            if (val == false) {
                this.loadingForm = false
                this.formData = {}
            }
        }
    },
    methods: {
        async open(data) {
            this.isShowForm = true
            this.disableStatus = false
            this.formDataChange.statusOrder = false
            this.formData = { ...data }
            for (let item of this.formData.status) {
                if (item.type == TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE) {
                    this.formDataChange.statusOrder = true
                }
                if (item.type > TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE) {
                    this.disableStatus = true
                }
            }
            if (this.formData.status_number == RETURN_TO_TRANSACTION) {
                this.hiddenForm = true
            }
        },
        cancelForm() {
            this.isShowForm = false
        },
        submit() {
            this.loadingForm = true
            let params = {
                id: this.formData.id,
                status: this.formDataChange.statusOrder
            }
            axios.get(route('admin.api.transaction-order-receive.change-transaction-receive', params))
                .then(({ data }) => {
                    this.$message({ message: data?.message, type: 'success' })
                    this.loadingForm = false
                    this.isShowForm = false
                    this.$emit('change-data')
                })
        }
    }
}
</script>
<style>
#admin-account-show .el-dialog__header {
    border-bottom: 1px solid #ccc;
    margin-right: 0 !important;
}
#admin-account-show {
    width: 900px;
    margin-top: 30px;
}
</style>