<template>
    <Head title="Trang chủ" />
    <AppLayout>
        <template v-slot:main>
            <div class="w-full">
                <el-carousel trigger="click" arrow="always" height="600px">
                    <el-carousel-item v-for="(item, index) in slideImage" :key="index">
                        <img :src="item" alt="" class="w-full h-full object-cover">
                    </el-carousel-item>
                </el-carousel>
            </div>
            <div class="pt-[12px]">
                <div class="max-w-[100%] overflow-scroll">
                    <div class="flex gap-1">
                        <div class="text-center min-w-[150px] py-[12px] rounded-[4px] cursor-pointer border-[1px] border-[#0082be]" 
                            :class="{'bg-[#0082be] text-white' : tabSelect == 1, 'text-[#0082be]' : tabSelect != 1}"
                            @click="tabSelect = 1"
                        >
                            Tra cứu cước phí
                        </div>
                        <div class="text-center min-w-[150px] py-[12px] rounded-[4px] cursor-pointer border-[1px]"
                            :class="{'bg-[#0082be] text-white' : tabSelect == 2, 'text-[#0082be]' : tabSelect != 2}"
                            @click="tabSelect = 2"
                        >
                            Tra cứu vận đơn
                        </div>
                        <div class="text-center min-w-[200px] py-[12px] rounded-[4px] cursor-pointer border-[1px]"
                            :class="{'bg-[#0082be] text-white' : tabSelect == 3, 'text-[#0082be]' : tabSelect != 3}"
                            @click="tabSelect = 3"
                        >
                            Hàng từ chối vận chuyển
                        </div>
                    </div>
                </div>
                <div class="w-full px-[18px] py-[12px] min-h-[100px] border-[1px] bg-[#f0f0f0]">
                    <div v-show="tabSelect == 1" class="sm:p-7 p-[0px]">
                        <el-form ref="form" :model="formData" :rules="orderRules" label-position="top">
                            <span class="mb-4 inline-block font-bold">Gửi từ: <span class="text-red-500"> * </span></span>
                            <div class="flex flex-col md:flex-row sm:gap-[24px] gap-[0] items-between">
                                <div class="w-full md:w-1/3 flex flex-col" data-select2-id="select2-data-224-pp6l">
                                    <el-form-item label="Tỉnh/ Thành phố" prop="province_from_id"
                                        :error="getError('province_from_id')" :inline-message="hasError('province_from_id')">
                                          <el-select v-model="formData.province_from_id" class="w-full"
                                            placeholder="Chọn tỉnh/thành phố gửi đi" filterable
                                            @change="changeProvince('province_from')"
                                        >
                                            <el-option v-for="item in provinces" :key="item.id" :label="item.name" :value="item.id" />
                                        </el-select>
                                    </el-form-item>
                                </div>
                                <div class="w-full md:w-1/3 flex flex-col">
                                    <el-form-item label="Quận/ Huyện" prop="district_from_id"
                                        :error="getError('district_from_id')" :inline-message="hasError('district_from_id')">
                                        <el-select v-model="formData.district_from_id" class="w-full"
                                            placeholder="Chọn quận/huyện gửi đi" filterable
                                        >
                                            <el-option v-for="item in districtFrom" :key="item.id" :label="item.name" :value="item.id" />
                                        </el-select>
                                    </el-form-item>
                                </div>
                                <div class="w-full md:w-1/3 flex flex-col">
                                    <el-form-item label="Địa chỉ" prop="address_from"
                                        :error="getError('address_from')" :inline-message="hasError('address_from')">
                                        <el-input type="textarea" v-model="formData.address_from" placeholder="Nhập địa chỉ cụ thể  (Số nhà, ngõ, thôn)" />
                                    </el-form-item>
                                </div>
                            </div>
                            <div data-select2-id="select2-data-317-t1ik">
                                <div class="mt-[18px]">
                                    <div data-select2-id="select2-data-315-xhn1">
                                        <span class="mb-[16px] inline-block font-bold">
                                            Gửi đến:<span class="text-red-500">*</span>
                                        </span>
                                        <div class="flex flex-col md:flex-row sm:gap-[24px] items-between" data-select2-id="select2-data-314-ezwn">
                                            <div class="w-full md:w-1/3 flex flex-col" data-select2-id="select2-data-328-09ko">
                                                <el-form-item label="Tỉnh/ Thành phố" prop="province_to_id"
                                                    :error="getError('province_to_id')" :inline-message="hasError('province_to_id')">
                                                    <el-select v-model="formData.province_to_id" class="w-full"
                                                        placeholder="Chọn tỉnh/thành phố nhận hàng" filterable
                                                        @change="changeProvince('province_to')"
                                                    >
                                                        <el-option v-for="item in provinces" :key="item.id" :label="item.name" :value="item.id" />
                                                    </el-select>
                                                </el-form-item>
                                            </div>
                                            <div class="w-full md:w-1/3 flex flex-col">
                                                <el-form-item label="Quận/ Huyện" prop="district_to_id"
                                                    :error="getError('district_to_id')" :inline-message="hasError('district_to_id')">
                                                    <el-select v-model="formData.district_to_id" class="w-full"
                                                        placeholder="Chọn quận/huyện nhận hàng" filterable
                                                    >
                                                        <el-option v-for="item in districtTo" :key="item.id" :label="item.name" :value="item.id" />
                                                    </el-select>
                                                </el-form-item>
                                            </div>
                                            <div class="w-full md:w-1/3 flex flex-col">
                                                <el-form-item label="Địa chỉ" prop="address_to"
                                                    :error="getError('address_to')" :inline-message="hasError('address_to')">
                                                    <el-input type="textarea" v-model="formData.address_to" placeholder="Nhập địa chỉ cụ thể  (Số nhà, ngõ, thôn)" />
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-[24px]">
                                            <el-form-item label="Weight" prop="weight"
                                                :error="getError('number')" :inline-message="hasError('number')">
                                                <el-input type="number" v-model="formData.weight" placeholder="KG" />
                                            </el-form-item>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center sm:mt-[32px] mt-[18px]">
                                <button type="button" @click="doSubmit()" class="text-white bg-[#0082be] rounded-[2px] sm:min-h-[55px] min-h-[45px] w-full font-bold">
                                    Tra cứu cước vận chuyển
                                </button>
                            </div>
                            <div v-if="orderCalculader.length > 0" class="mt-4">
                                <DataTable
                                    :fields="orderFields"
                                    :items="orderCalculader" 
                                    footer-center 
                                    paginate-background
                                >
                                </DataTable>
                            </div>
                        </el-form>
                    </div>
                    <div v-show="tabSelect == 2" class="sm:p-7 p-[0px]">
                        <el-form ref="form-order" label-position="top">
                            <el-form-item label="Mã vận đơn" class="is-required">
                                <el-input type="text" v-model="orderFilter.order_code" placeholder="Ví dụ: 841000072647,840000598444" />
                            </el-form-item>
                            <el-form-item label="Số điện thoại" class="is-required">
                                <el-input type="text" v-model="orderFilter.phone" placeholder="Ví dụ: 055xxxxxx" />
                            </el-form-item>
                            <span class="text-[#161D25] block my-[24px]">
                                Nhập mã vận đơn của bạn chính xác.
                            </span>
                            <button type="button" @click="searchOrder()" class="w-full bg-[#0082be] h-[55px] rounded-[2px] text-white font-semibold">
                                Tra cứu vận đơn
                            </button>
                        </el-form>
                        <div v-if="itemSearch" class="mt-4">
                            <div v-if="itemSearch.length > 0">
                                <DataTable
                                    :fields="fields" 
                                    :items="itemSearch" 
                                    :paginate="paginate" 
                                    footer-center 
                                    paginate-background
                                    @page-change="changePage"
                                >
                                </DataTable>
                            </div>
                            <el-empty v-else description="Không có kết quả tìm kiếm" :image-size="100"/>
                        </div>
                    </div>
                    <div v-show="tabSelect == 3" class="block w-full overflow-x-auto lg:px-[28px]">
                        <div class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0">
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/618/1f2/c3d/6181f2c3d5dfd015796068.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            1. Vũ khí và công cụ hỗ trợ
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Vũ khí quân dụng (súng cầm tay, bom, mìn, lựu đạn,…); trang thiết bị
                            kỹ thuật quân sự, quân trang; súng săn; vũ khí thô sơ (dao, kiếm,
                            giáo, mác, mã tấu, cung, nổ, phi tiêu, …); vũ khí thể thao (súng hơi,
                            súng thể thao bắn đạn sơn, súng bắn đĩa bay, …); công cụ hỗ trợ (bình
                            xịt hơi cay, dùi cui điện, súng bắn điện, …).</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/618/1f3/cf4/6181f3cf44386080763394.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            2. Vật liệu hoặc chất dễ gây cháy nổ
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Pháo nổ, pháo hoa, pháo sáng, thuốc nổ, thuốc pháo hoa, xăng dầu, khí
                            đốt, pin, bình ắc qui,…</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/618/1f3/f69/6181f3f69e678618973993.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            3. Văn hóa phẩm cấm lưu hành
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Văn hóa phẩm trái đạo đức xã hội, trái thuần phong mỹ tục của Việt
                            Nam hoặc nội dung kích động gây mất an ninh, phá hoại đoàn kết dân
                            tộc, chống phá Nhà nước.</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/618/1f4/115/6181f4115f60a876141163.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            4. Ma túy
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Các chất ma túy, chất kích thích thần kinh (bao gồm cả tiền chất,
                            nguyên vật liệu chế tạo ra ma túy, chất kích thích).</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20b/818/64b20b81880fd365318684.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            5. Thuốc lá
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Thuốc lá, xì gà, thuốc lá điện tử, các dạng thành phẩm khác và các
                            nguyên liệu sản xuất thuốc lá.</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20c/d23/64b20cd238733332418112.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            6. Thuốc thú y hoặc thuốc bảo vệ thực vật bị cấm hoặc chưa được cấp
                            phép
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Thuốc thú y, thuốc bảo vệ thực vật hoặc nguyên liệu sản xuất thuốc
                            thú y, thuốc bảo vệ thực vật thuộc đối tượng bị cấm hoặc chưa được
                            phép lưu hành tại Việt Nam.</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20c/230/64b20c230352d309690183.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            7. Phân bón chưa được cấp phép
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Phân bón không có trong danh mục được phép sản xuất, kinh doanh và sử
                            dụng tại Việt Nam</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20c/f37/64b20cf372aa0832094406.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            8. Trang thiết bị y tế và thuốc chữa bệnh cho người chưa được cấp phép
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Các loại trang thiết bị y tế chưa được phép sử dụng tại Việt Nam; Các
                            loại thuốc chữa bệnh cho người, các loại vắc xin, sinh phẩm y tế, mỹ
                            phẩm, hóa chất và chế phẩm diệt côn trùng, diệt khuẩn trong lĩnh vực
                            gia dụng và y tế chưa được phép sử dụng tại Việt Nam.</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20d/6f9/64b20d6f9faf4934454815.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            9. Phụ gia thực phẩm chưa được cấp phép
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Phụ gia thực phẩm, chất hỗ trợ chế biến thực phẩm, vi chất dinh
                            dưỡng, thực phẩm chức năng, thực phẩm có nguy cơ cao, thực phẩm được
                            bảo quản bằng phương pháp chiếu xạ, thực phẩm có gen đã bị biến đổi
                            chưa được phép sử dụng tại Việt Nam.</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20d/9fc/64b20d9fc3574072546554.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            10. Sinh vật
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Thực vật, động vật nguy cấp, quý, hiếm cần được bảo vệ (bất luận ở
                            trạng thái nào).</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20d/d42/64b20dd42d0ee224020386.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            11. Tiền, các loại kim khí quý và di vật, cổ vật, bảo vật
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            ><ul class="pl-6">
                                <li>Tiền (tiền Việt Nam, ngoại tệ);</li>
                                <li>
                                Các loại kim khí quý (vàng, bạc, bạch kim…), các loại đá quý hoặc
                                các sản phẩm khác được chế biến từ kim khí quý, đá quý;
                                </li>
                                <li>Di vật, cổ vật, bảo vật quốc gia.</li>
                            </ul></span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/20f/fb1/64b20ffb13239753244195.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            12. Đồ chơi nguy hiểm
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            >Đồ chơi nguy hiểm, đồ chơi có hại tới giáo dục nhân cách và sức khỏe
                            của trẻ em hoặc tới an ninh, trật tự, an toàn xã hội</span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/210/0c5/64b2100c58f6a667757427.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            13. Các hóa chất và khoáng vật cấm kinh doanh
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"></span>
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/1fe/40e/64b1fe40efc1b214634449.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            14. Bưu gửi chứa nhiều bưu gửi, gửi nhiều địa chỉ nhận; thư trong bưu
                            gửi; thư có chứa vật phẩm hoặc hàng hóa
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"></span>
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/210/e47/64b210e47262f605344509.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            15. Vật phẩm, hàng hóa khác cấm xuất khẩu, nhập khẩu hoặc cấm kinh
                            doanh
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"
                            ><ul class="pl-6">
                                <li>Tiền giả;</li>
                                <li>Bộ phận cơ thể người, hài cốt, xá lợi;</li>
                                <li>Sản phẩm, vật liệu có chứa amilăng thuộc nhóm amphibole;</li>
                                <li>Phế liệu nhập khẩu gây ô nhiễm môi trường;</li>
                                <li>Ấn phẩm, học phẩm người mù;</li>
                                <li>
                                Các vật phẩm, hàng hóa khác mà pháp luật của Việt Nam quy định cấm
                                lưu thông, xuất khẩu, nhập khẩu, kinh doanh; cấm vận chuyển bằng
                                đường bưu chính theo quy định của pháp luật Việt Nam, điều ước
                                quốc tế mà Cộng hòa xã hội chủ nghĩa Việt Nam là thành viên tại
                                từng thời điểm.
                                </li>
                            </ul></span
                            >
                        </div>
                        </div>
                        <div
                        class="flex items-start gap-x-[12px] lg:gap-x-[24px] pt-[30px] border-b border-[#f2f2f2] lg:border-0"
                        >
                        <img
                            class="w-[56px] h-[56px] lg:w-[94px] lg:h-[94px] object-cover"
                            src="https://jtexpress.vn/storage/app/uploads/public/64b/210/c40/64b210c406808188974306.png"
                            alt="J&amp;T Express Việt Nam - Các mặt hàng cấm gửi"
                        />
                        <div class="lg:border-b lg:border-[#f2f2f2] pb-[30px] flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[20px] text-[#FF0000] Montserrat-Bold"
                            >
                            16. Hàng hóa kinh doanh không có đủ hóa đơn, chứng từ theo quy định
                            pháp luật
                            </h5>
                            <span class="text-[14px] lg:text-[16px]"></span>
                        </div>
                        </div>
                        <div class="flex items-start gap-x-[24px] mt-[32px]">
                        <div class="w-[94px] h-[94px] hidden lg:block"></div>
                        <div class="flex-1">
                            <h5
                            class="mb-[9px] text-[14px] lg:text-[16px] text-[#000000] Montserrat-Bold"
                            >
                            * Khách hàng hiểu và đồng ý rằng, dù là trước khi tiếp nhận, trong quá
                            trình vận chuyển hoặc sau khi bàn giao hàng hóa, nếu J&amp;T Express
                            có cơ sở nghi ngờ hoặc phát hiện bưu gửi thuộc Danh mục hàng hóa từ
                            chối vận chuyển nêu trên hoặc vi phạm quy định pháp luật thì J&amp;T
                            Express có quyền kiểm tra, từ chối cung cấp dịch vụ, xử lý bưu gửi
                            hoặc trình báo với cơ quan nhà nước có thẩm quyền và được miễn trừ
                            toàn bộ các khiếu nại, thiệt hại phát sinh từ hành vi không tuân thủ
                            của Khách hàng.
                            </h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/User/UserLayout.vue';
import DataTable from '@/Components/DataTable.vue'
import form from '@/Mixins/form'

export default {
    components: { Head, Link, AppLayout, DataTable },
    mixins: [form],
    data: function () {
        return {
            loadingForm: false,
            tabSelect: 1,
            slideImage: [
                '/images/slide/giao-hang-nhanh-4.webp',
                '/images/slide/giao-hang-nhanh-3.png',
                '/images/slide/giao-hang-nhanh-1.jpg',
                '/images/slide/giao-hang-nhanh-2.png',
            ],
            orderFilter: {
                'order_code': ''
            },
            fields: [
                { key: 'order_code', label: 'Mã vận đơn', width: 100, align: 'left', headerAlign: 'left' },
                { key: 'full_name', label: 'Người nhận', minWidth: 100, align: 'left', headerAlign: 'left' },
                { key: 'phone_number', label: 'Số điện thoại', width: 120, align: 'left', headerAlign: 'left' },
                { key: 'receive_district_name', label: 'Điểm gửi', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'delivery_district_name', label: 'Điểm nhận', width: 190, align: 'left', headerAlign: 'left' },
                { key: 'status_text', label: 'Trạng thái', minWidth: 180, align: 'center', headerAlign: 'center' },
                { key: 'created_at', label: 'Ngày tạo', width: 140, align: 'center', headerAlign: 'center' },
            ],
            itemSearch: null,
            formData: {
                province_from_id: null,
                district_from_id: null,
                address_from: null,
                province_to_id: null,
                district_to_id: null,
                address_to: null,
                weight: null,
            },
            orderRules: {
                province_from_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                district_from_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address_from: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                province_to_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                district_to_id: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                address_to: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
                weight: { required: true, message: 'Trường này là bắt buộc', trigger: ['change'] },
            },
            orderFields: [
                { key: 'address_from', label: 'Điểm gửi hàng', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'address_to', label: 'Điểm nhận hàng', minWidth: 150, align: 'left', headerAlign: 'left' },
                { key: 'weight', label: 'Khối lượng', width: 100, align: 'center', headerAlign: 'center' },
                { key: 'sum_price', label: 'Thành tiền', width: 120, align: 'left', headerAlign: 'left' },
            ],
            provinces: [],
            districtFrom: [],
            districtTo: [],
            orderCalculader: [],
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            axios.get(route('user.region.province-all'))
                .then(({ data }) => {
                    this.provinces = data.data
                })
        },
        changeProvince(type) {
            if (type == 'province_from') {
                axios.get(route('user.region.get-district', this.formData.province_from_id))
                    .then(({ data }) => {
                        this.districtFrom = data.data
                    })
            } else {
                axios.get(route('user.region.get-district', this.formData.province_to_id))
                    .then(({ data }) => {
                        this.districtTo = data.data
                    })
            }
        },
        async submit() {
            let self = this
            if (this.formData.district_from_id && this.formData.district_to_id) {
                let districtFromName = self.districtFrom.find(item => item.id == self.formData.district_from_id)?.name
                let provinceFromName = self.provinces.find(item => item.id == self.formData.province_from_id)?.name
                let districtToName = self.districtTo.find(item => item.id == self.formData.district_to_id)?.name
                let provinceToName = self.provinces.find(item => item.id == self.formData.province_to_id)?.name
                let origin = `${self.formData.address_from}, ${districtFromName}, ${provinceFromName}, Việt Nam`
                let destination = `${self.formData.address_to}, ${districtToName}, ${provinceToName}, Việt Nam`

                var directionsService = new google.maps.DirectionsService();
    
                directionsService.route({
                        origin: origin,
                        destination: destination,
                        travelMode: 'WALKING'
                    },
                    function(response, status) {
                        if (status === 'OK') {
                            var route = response.routes[0];
                            var distance = 0;
    
                            for (var i = 0; i < route.legs.length; i++) {
                                distance += route.legs[i].distance.value;
                            }
                            distance = distance / 1000

                            const formatter = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            const formattedMoney = formatter.format(Number(self.formData.weight)*distance*1500);
    
                            self.orderCalculader.push({
                                address_from: origin,
                                address_to: destination,
                                weight: self.formData.weight,
                                sum_price: formattedMoney
                            })
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    }
                );
            }
        },
        searchOrder() {
            axios.get(route('user.order.search', this.orderFilter))
                .then(({ data }) => {
                    this.itemSearch = data.data
                })
        }
    }
}
</script>