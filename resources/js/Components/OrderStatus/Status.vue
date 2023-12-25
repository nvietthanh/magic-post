<template>
    <div>
        <div v-for="(itemGroup, index) in orderGroup" :key="index">
            <template v-if="checkHiddenOrder(itemGroup.value)">
                <div class="py-2 flex flex-row items-center gap-2">
                    <div class="w-6 h-6 bg-sky-600 rounded-full border-8 border-cyan-100"></div>
                    <div class="text-neutral-800 text-base font-medium">{{ itemGroup.label }}</div>
                </div>
                <div class="w-full px-2 py-2 bg-slate-100 rounded gap-x-[32px] grid sm:grid-cols-2 grid-cols-1">
                    <template v-for="(group, index) in getListOrderGroup(itemGroup.group)" :key="index">
                        <div class="w-full py-1 rounded flex">
                            <div class="w-full flex justify-start items-center gap-[15px]">
                                <div class="flex-1 text-stone-500 text-sm font-medium flex items-center gap-[4px]">
                                    <i class="bi bi-check-lg text-[18px]"></i>
                                    <span>{{ group.text }}</span>
                                </div>
                                <div class="sm:w-auto w-[100px] text-center">{{ findOrderTime(group.value) }}</div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import { All, GROUP } from '@/Store/Consts/oderStatus'

export default {
    props: {
        data: {
            type: Object || Array,
            default: () => {},
        },
    },
    data: function () {
        return {
            orderGroup: GROUP,
            orderStatus: All,
        }
    },
    methods: {
        getListOrderGroup(groupID) {
            return this.orderStatus.filter(element => element.group === groupID);
        },
        findOrderTime(value) {
            let orderFind = this.data.find(element => element.type === value)

            return orderFind?.created_at
        },
        checkHiddenOrder(value) {
            if (!this.data) return false;

            let orderFind = this.data.find(element => value.includes(element.type))
            
            return orderFind ? true : false
        }
    }
}
</script>