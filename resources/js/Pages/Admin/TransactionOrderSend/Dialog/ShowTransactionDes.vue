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
                <div class="mt-[12px] flex items-center gap-[32px]">
                    <div class="font-bold">Thành tiền:</div>
                    <div>{{ getSumPrice(formData.sum_price) }}</div>
                </div>
            </div>
            <el-form ref="form" :model="formDataChange" label-position="top">
                <div class="flex gap-[32px]">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">Xác nhận gửi khách hàng:</span>
                        </div>
                        <el-select v-model="formDataChange.statusOrder" 
                            class="w-[300px]" placeholder="Chọn điểm tập kết"
                            :disabled="disableStatus"
                        >
                            <el-option label="Đang gửi đến khách hàng" :value="7" />
                            <el-option label="Đã gửi tới khách hàng" :value="8" />
                            <el-option label="Hoàn lại điểm giao dịch" :value="9" />
                        </el-select>                        
                    </div>
                </div>
            </el-form>
        </div>
        <template #footer>
            <span class="flex justify-end items-center mb-2">
                <div class="flex gap-2">
                    <el-button type="info" class="text-sm" @click="cancelForm">Hủy bỏ</el-button>
                    <el-button v-if="!disableStatus" type="primary" :loading="loadingForm" @click="doSubmit">
                        Xác nhận
                    </el-button>
                </div>
            </span>
        </template>
    </el-dialog>
</template>
<script>
import { Head, Link } from '@inertiajs/vue3'
import DataTable from '@/Components/DataTable.vue'
import { DELIVERED_TO_CUSTOMER_SEND, DELIVERED_TO_CUSTOMER_RECEIVE, RETURN_TO_TRANSACTION } from '@/Store/Consts/oderStatus'
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
                { key: 'weight', label: 'Khối lượng', minWidth: 120, align: 'left', headerAlign: 'left' },
                { key: 'note', label: 'Note', minWidth: 170, align: 'left', headerAlign: 'left' },
            ],
            paginate: [],
            disableStatus: false,
            concentratePoints: [],
            formDataChange: {
                statusOrder: 7,
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
            this.formDataChange.statusOrder = 7
            this.formData = { ...data }
            for (let item of this.formData.status) {
                if (item.type >= DELIVERED_TO_CUSTOMER_SEND) {
                    this.formDataChange.statusOrder = item.type
                    if (item.type != DELIVERED_TO_CUSTOMER_SEND) {
                        this.disableStatus = true
                    }
                }
            }
        },
        cancelForm() {
            this.isShowForm = false
        },
        getSumPrice(sumPrice) {
            const formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
    
            return formatter.format(sumPrice);
        },
        submit() {
            this.loadingForm = true
            let params = {
                id: this.formData.id,
                status: this.formDataChange.statusOrder,
            }
            axios.get(route('admin.api.transaction-order-send.change-transaction-des-send', params))
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