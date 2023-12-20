<template>
    <el-dialog v-model="isShowForm" 
        :close-on-click-modal="false" 
        id="admin-account-show"
        class="bg-[#f4f1f8]"
    >
        <template #header>
            <div class="text-center font-bold text-[18px]">Thông tin chi tiết đơn hàng</div>
        </template>
        <div class="mb-3 flex gap-1">
            <div class="px-[14px] py-[6px] rounded-[4px] cursor-pointer border-[1px] border-[#0082be]" 
                :class="{'bg-[#0082be] text-white' : tabSelect == 1, 'text-[#0082be]' : tabSelect != 1}"
                @click="tabSelect = 1"
            >
                Thông tin đơn hàng
            </div>
            <div class="px-[14px] py-[6px] rounded-[4px] cursor-pointer border-[1px]"
            :class="{'bg-[#0082be] text-white' : tabSelect == 2, 'text-[#0082be]' : tabSelect != 2}"
                @click="tabSelect = 2"
            >
                Thông tin giao hàng
            </div>
        </div>
        <div class="sm:px-[18px] px-[12px] py-[12px] border-[1px] max-h-[500px] overflow-y-scroll">
            <template v-if="tabSelect == 1">
                <div class="grid sm:grid-cols-3 grid-cols-1 gap-x-[32px] gap-y-[8px]">
                    <div class="flex gap-[12px]">
                        <div class="font-bold">Loại đơn hàng:</div>
                        <div>{{ formData.type == 1 ? 'Tài liệu' : 'Hàng hóa' }}</div>
                    </div>
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
                    <div class="sm:px-4 px-[4px] mt-[8px]">
                        <div class="grid sm:grid-cols-2 grid-cols-1 gap-[12px]">
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
                <div class="flex items-center gap-[12px] mt-2">
                    <div class="font-bold sm:w-full w-[180px]">Người gửi khi gửi hàng thành công:</div>
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
            </template>
            <template v-else>
                <OrderStatusDetail :data="this.formData.status" />
            </template>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div class="flex gap-2">
                    <el-button type="info" class="text-sm" @click="cancelForm">Hủy bỏ</el-button>
                </div>
            </span>
        </template>
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import DataTable from '@/Components/DataTable.vue'
import OrderStatusDetail from '@/Components/OrderStatus/Status.vue'
import form from '@/Mixins/form'

export default {
    components: { Head, DataTable, OrderStatusDetail },
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
            tabSelect: 1,
            formData: {},
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 100, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'status_text', label: 'Trạng thái', minWidth: 180, align: 'center', headerAlign: 'center' },
                { key: 'created_at', label: 'Ngày tạo', width: 140, align: 'center', headerAlign: 'center' },
                { key: 'action', label: 'Thao tác', width: 100, align: 'center', headerAlign: 'center', fixed: 'right' },
            ],
            paginate: [],
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
            this.tabSelect = 1
            this.formData = { ...data }
        },
        cancelForm() {
            this.isShowForm = false
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
@media only screen and (max-width: 576px) {
    #admin-account-show {
        width: calc(100% - 16px);
    }
}
</style>