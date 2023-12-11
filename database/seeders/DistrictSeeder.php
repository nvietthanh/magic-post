<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->insert(array(
            0 => array (
                'id' => 1,
                'name' => 'Quận Ba Đình',
                'province_id' => 1,
            ),
            1 => array (
                'id' => 2,
                'name' => 'Quận Hoàn Kiếm',
                'province_id' => 1,
            ),
            2 => array (
                'id' => 3,
                'name' => 'Quận Tây Hồ',
                'province_id' => 1,
            ),
            3 => array (
                'id' => 4,
                'name' => 'Quận Long Biên',
                'province_id' => 1,
            ),
            4 => array (
                'id' => 5,
                'name' => 'Quận Cầu Giấy',
                'province_id' => 1,
            ),
            5 => array (
                'id' => 6,
                'name' => 'Quận Đống Đa',
                'province_id' => 1,
            ),
            6 => array (
                'id' => 7,
                'name' => 'Quận Hai Bà Trưng',
                'province_id' => 1,
            ),
            7 => array (
                'id' => 8,
                'name' => 'Quận Hoàng Mai',
                'province_id' => 1,
            ),
            8 => array (
                'id' => 9,
                'name' => 'Quận Thanh Xuân',
                'province_id' => 1,
            ),
            9 => array (
                'id' => 10,
                'name' => 'Huyện Sóc Sơn',
                'province_id' => 1,
            ),
            10 => array (
                'id' => 11,
                'name' => 'Huyện Đông Anh',
                'province_id' => 1,
            ),
            11 => array (
                'id' => 12,
                'name' => 'Huyện Gia Lâm',
                'province_id' => 1,
            ),
            12 => array (
                'id' => 13,
                'name' => 'Quận Nam Từ Liêm',
                'province_id' => 1,
            ),
            13 => array (
                'id' => 14,
                'name' => 'Huyện Thanh Trì',
                'province_id' => 1,
            ),
            14 => array (
                'id' => 15,
                'name' => 'Quận Bắc Từ Liêm',
                'province_id' => 1,
            ),
            15 => array (
                'id' => 16,
                'name' => 'Huyện Mê Linh',
                'province_id' => 1,
            ),
            16 => array (
                'id' => 17,
                'name' => 'Quận Hà Đông',
                'province_id' => 1,
            ),
            17 => array (
                'id' => 18,
                'name' => 'Thị xã Sơn Tây',
                'province_id' => 1,
            ),
            18 => array (
                'id' => 19,
                'name' => 'Huyện Ba Vì',
                'province_id' => 1,
            ),
            19 => array (
                'id' => 20,
                'name' => 'Huyện Phúc Thọ',
                'province_id' => 1,
            ),
            20 => array (
                'id' => 21,
                'name' => 'Huyện Đan Phượng',
                'province_id' => 1,
            ),
            21 => array (
                'id' => 22,
                'name' => 'Huyện Hoài Đức',
                'province_id' => 1,
            ),
            22 => array (
                'id' => 23,
                'name' => 'Huyện Quốc Oai',
                'province_id' => 1,
            ),
            23 => array (
                'id' => 24,
                'name' => 'Huyện Thạch Thất',
                'province_id' => 1,
            ),
            24 => array (
                'id' => 25,
                'name' => 'Huyện Chương Mỹ',
                'province_id' => 1,
            ),
            25 => array (
                'id' => 26,
                'name' => 'Huyện Thanh Oai',
                'province_id' => 1,
            ),
            26 => array (
                'id' => 27,
                'name' => 'Huyện Thường Tín',
                'province_id' => 1,
            ),
            27 => array (
                'id' => 28,
                'name' => 'Huyện Phú Xuyên',
                'province_id' => 1,
            ),
            28 => array (
                'id' => 29,
                'name' => 'Huyện Ứng Hòa',
                'province_id' => 1,
            ),
            29 => array (
                'id' => 30,
                'name' => 'Huyện Mỹ Đức',
                'province_id' => 1,
            ),
            30 => array (
                'id' => 31,
                'name' => 'Thành phố Hà Giang',
                'province_id' => 2,
            ),
            31 => array (
                'id' => 32,
                'name' => 'Huyện Đồng Văn',
                'province_id' => 2,
            ),
            32 => array (
                'id' => 33,
                'name' => 'Huyện Mèo Vạc',
                'province_id' => 2,
            ),
            33 => array (
                'id' => 34,
                'name' => 'Huyện Yên Minh',
                'province_id' => 2,
            ),
            34 => array (
                'id' => 35,
                'name' => 'Huyện Quản Bạ',
                'province_id' => 2,
            ),
            35 => array (
                'id' => 36,
                'name' => 'Huyện Vị Xuyên',
                'province_id' => 2,
            ),
            36 => array (
                'id' => 37,
                'name' => 'Huyện Bắc Mê',
                'province_id' => 2,
            ),
            37 => array (
                'id' => 38,
                'name' => 'Huyện Hoàng Su Phì',
                'province_id' => 2,
            ),
            38 => array (
                'id' => 39,
                'name' => 'Huyện Xín Mần',
                'province_id' => 2,
            ),
            39 => array (
                'id' => 40,
                'name' => 'Huyện Bắc Quang',
                'province_id' => 2,
            ),
            40 => array (
                'id' => 41,
                'name' => 'Huyện Quang Bình',
                'province_id' => 2,
            ),
            41 => array (
                'id' => 42,
                'name' => 'Thành phố Cao Bằng',
                'province_id' => 3,
            ),
            42 => array (
                'id' => 43,
                'name' => 'Huyện Bảo Lâm',
                'province_id' => 3,
            ),
            43 => array (
                'id' => 44,
                'name' => 'Huyện Bảo Lạc',
                'province_id' => 3,
            ),
            44 => array (
                'id' => 45,
                'name' => 'Huyện Hà Quảng',
                'province_id' => 3,
            ),
            45 => array (
                'id' => 46,
                'name' => 'Huyện Trùng Khánh',
                'province_id' => 3,
            ),
            46 => array (
                'id' => 47,
                'name' => 'Huyện Hạ Lang',
                'province_id' => 3,
            ),
            47 => array (
                'id' => 48,
                'name' => 'Huyện Quảng Hòa',
                'province_id' => 3,
            ),
            48 => array (
                'id' => 49,
                'name' => 'Huyện Hoà An',
                'province_id' => 3,
            ),
            49 => array (
                'id' => 50,
                'name' => 'Huyện Nguyên Bình',
                'province_id' => 3,
            ),
            50 => array (
                'id' => 51,
                'name' => 'Huyện Thạch An',
                'province_id' => 3,
            ),
            51 => array (
                'id' => 52,
                'name' => 'Thành Phố Bắc Kạn',
                'province_id' => 4,
            ),
            52 => array (
                'id' => 53,
                'name' => 'Huyện Pác Nặm',
                'province_id' => 4,
            ),
            53 => array (
                'id' => 54,
                'name' => 'Huyện Ba Bể',
                'province_id' => 4,
            ),
            54 => array (
                'id' => 55,
                'name' => 'Huyện Ngân Sơn',
                'province_id' => 4,
            ),
            55 => array (
                'id' => 56,
                'name' => 'Huyện Bạch Thông',
                'province_id' => 4,
            ),
            56 => array (
                'id' => 57,
                'name' => 'Huyện Chợ Đồn',
                'province_id' => 4,
            ),
            57 => array (
                'id' => 58,
                'name' => 'Huyện Chợ Mới',
                'province_id' => 4,
            ),
            58 => array (
                'id' => 59,
                'name' => 'Huyện Na Rì',
                'province_id' => 4,
            ),
            59 => array (
                'id' => 60,
                'name' => 'Thành phố Tuyên Quang',
                'province_id' => 5,
            ),
            60 => array (
                'id' => 61,
                'name' => 'Huyện Lâm Bình',
                'province_id' => 5,
            ),
            61 => array (
                'id' => 62,
                'name' => 'Huyện Na Hang',
                'province_id' => 5,
            ),
            62 => array (
                'id' => 63,
                'name' => 'Huyện Chiêm Hóa',
                'province_id' => 5,
            ),
            63 => array (
                'id' => 64,
                'name' => 'Huyện Hàm Yên',
                'province_id' => 5,
            ),
            64 => array (
                'id' => 65,
                'name' => 'Huyện Yên Sơn',
                'province_id' => 5,
            ),
            65 => array (
                'id' => 66,
                'name' => 'Huyện Sơn Dương',
                'province_id' => 5,
            ),
            66 => array (
                'id' => 67,
                'name' => 'Thành phố Lào Cai',
                'province_id' => 6,
            ),
            67 => array (
                'id' => 68,
                'name' => 'Huyện Bát Xát',
                'province_id' => 6,
            ),
            68 => array (
                'id' => 69,
                'name' => 'Huyện Mường Khương',
                'province_id' => 6,
            ),
            69 => array (
                'id' => 70,
                'name' => 'Huyện Si Ma Cai',
                'province_id' => 6,
            ),
            70 => array (
                'id' => 71,
                'name' => 'Huyện Bắc Hà',
                'province_id' => 6,
            ),
            71 => array (
                'id' => 72,
                'name' => 'Huyện Bảo Thắng',
                'province_id' => 6,
            ),
            72 => array (
                'id' => 73,
                'name' => 'Huyện Bảo Yên',
                'province_id' => 6,
            ),
            73 => array (
                'id' => 74,
                'name' => 'Thị xã Sa Pa',
                'province_id' => 6,
            ),
            74 => array (
                'id' => 75,
                'name' => 'Huyện Văn Bàn',
                'province_id' => 6,
            ),
            75 => array (
                'id' => 76,
                'name' => 'Thành phố Điện Biên Phủ',
                'province_id' => 7,
            ),
            76 => array (
                'id' => 77,
                'name' => 'Thị Xã Mường Lay',
                'province_id' => 7,
            ),
            77 => array (
                'id' => 78,
                'name' => 'Huyện Mường Nhé',
                'province_id' => 7,
            ),
            78 => array (
                'id' => 79,
                'name' => 'Huyện Mường Chà',
                'province_id' => 7,
            ),
            79 => array (
                'id' => 80,
                'name' => 'Huyện Tủa Chùa',
                'province_id' => 7,
            ),
            80 => array (
                'id' => 81,
                'name' => 'Huyện Tuần Giáo',
                'province_id' => 7,
            ),
            81 => array (
                'id' => 82,
                'name' => 'Huyện Điện Biên',
                'province_id' => 7,
            ),
            82 => array (
                'id' => 83,
                'name' => 'Huyện Điện Biên Đông',
                'province_id' => 7,
            ),
            83 => array (
                'id' => 84,
                'name' => 'Huyện Mường Ảng',
                'province_id' => 7,
            ),
            84 => array (
                'id' => 85,
                'name' => 'Huyện Nậm Pồ',
                'province_id' => 7,
            ),
            85 => array (
                'id' => 86,
                'name' => 'Thành phố Lai Châu',
                'province_id' => 8,
            ),
            86 => array (
                'id' => 87,
                'name' => 'Huyện Tam Đường',
                'province_id' => 8,
            ),
            87 => array (
                'id' => 88,
                'name' => 'Huyện Mường Tè',
                'province_id' => 8,
            ),
            88 => array (
                'id' => 89,
                'name' => 'Huyện Sìn Hồ',
                'province_id' => 8,
            ),
            89 => array (
                'id' => 90,
                'name' => 'Huyện Phong Thổ',
                'province_id' => 8,
            ),
            90 => array (
                'id' => 91,
                'name' => 'Huyện Than Uyên',
                'province_id' => 8,
            ),
            91 => array (
                'id' => 92,
                'name' => 'Huyện Tân Uyên',
                'province_id' => 8,
            ),
            92 => array (
                'id' => 93,
                'name' => 'Huyện Nậm Nhùn',
                'province_id' => 8,
            ),
            93 => array (
                'id' => 94,
                'name' => 'Thành phố Sơn La',
                'province_id' => 9,
            ),
            94 => array (
                'id' => 95,
                'name' => 'Huyện Quỳnh Nhai',
                'province_id' => 9,
            ),
            95 => array (
                'id' => 96,
                'name' => 'Huyện Thuận Châu',
                'province_id' => 9,
            ),
            96 => array (
                'id' => 97,
                'name' => 'Huyện Mường La',
                'province_id' => 9,
            ),
            97 => array (
                'id' => 98,
                'name' => 'Huyện Bắc Yên',
                'province_id' => 9,
            ),
            98 => array (
                'id' => 99,
                'name' => 'Huyện Phù Yên',
                'province_id' => 9,
            ),
            99 => array (
                'id' => 100,
                'name' => 'Huyện Mộc Châu',
                'province_id' => 9,
            ),
            100 => array (
                'id' => 101,
                'name' => 'Huyện Yên Châu',
                'province_id' => 9,
            ),
            101 => array (
                'id' => 102,
                'name' => 'Huyện Mai Sơn',
                'province_id' => 9,
            ),
            102 => array (
                'id' => 103,
                'name' => 'Huyện Sông Mã',
                'province_id' => 9,
            ),
            103 => array (
                'id' => 104,
                'name' => 'Huyện Sốp Cộp',
                'province_id' => 9,
            ),
            104 => array (
                'id' => 105,
                'name' => 'Huyện Vân Hồ',
                'province_id' => 9,
            ),
            105 => array (
                'id' => 106,
                'name' => 'Thành phố Yên Bái',
                'province_id' => 10,
            ),
            106 => array (
                'id' => 107,
                'name' => 'Thị xã Nghĩa Lộ',
                'province_id' => 10,
            ),
            107 => array (
                'id' => 108,
                'name' => 'Huyện Lục Yên',
                'province_id' => 10,
            ),
            108 => array (
                'id' => 109,
                'name' => 'Huyện Văn Yên',
                'province_id' => 10,
            ),
            109 => array (
                'id' => 110,
                'name' => 'Huyện Mù Căng Chải',
                'province_id' => 10,
            ),
            110 => array (
                'id' => 111,
                'name' => 'Huyện Trấn Yên',
                'province_id' => 10,
            ),
            111 => array (
                'id' => 112,
                'name' => 'Huyện Trạm Tấu',
                'province_id' => 10,
            ),
            112 => array (
                'id' => 113,
                'name' => 'Huyện Văn Chấn',
                'province_id' => 10,
            ),
            113 => array (
                'id' => 114,
                'name' => 'Huyện Yên Bình',
                'province_id' => 10,
            ),
            114 => array (
                'id' => 115,
                'name' => 'Thành phố Hòa Bình',
                'province_id' => 11,
            ),
            115 => array (
                'id' => 116,
                'name' => 'Huyện Đà Bắc',
                'province_id' => 11,
            ),
            116 => array (
                'id' => 117,
                'name' => 'Huyện Lương Sơn',
                'province_id' => 11,
            ),
            117 => array (
                'id' => 118,
                'name' => 'Huyện Kim Bôi',
                'province_id' => 11,
            ),
            118 => array (
                'id' => 119,
                'name' => 'Huyện Cao Phong',
                'province_id' => 11,
            ),
            119 => array (
                'id' => 120,
                'name' => 'Huyện Tân Lạc',
                'province_id' => 11,
            ),
            120 => array (
                'id' => 121,
                'name' => 'Huyện Mai Châu',
                'province_id' => 11,
            ),
            121 => array (
                'id' => 122,
                'name' => 'Huyện Lạc Sơn',
                'province_id' => 11,
            ),
            122 => array (
                'id' => 123,
                'name' => 'Huyện Yên Thủy',
                'province_id' => 11,
            ),
            123 => array (
                'id' => 124,
                'name' => 'Huyện Lạc Thủy',
                'province_id' => 11,
            ),
            124 => array (
                'id' => 125,
                'name' => 'Thành phố Thái Nguyên',
                'province_id' => 12,
            ),
            125 => array (
                'id' => 126,
                'name' => 'Thành phố Sông Công',
                'province_id' => 12,
            ),
            126 => array (
                'id' => 127,
                'name' => 'Huyện Định Hóa',
                'province_id' => 12,
            ),
            127 => array (
                'id' => 128,
                'name' => 'Huyện Phú Lương',
                'province_id' => 12,
            ),
            128 => array (
                'id' => 129,
                'name' => 'Huyện Đồng Hỷ',
                'province_id' => 12,
            ),
            129 => array (
                'id' => 130,
                'name' => 'Huyện Võ Nhai',
                'province_id' => 12,
            ),
            130 => array (
                'id' => 131,
                'name' => 'Huyện Đại Từ',
                'province_id' => 12,
            ),
            131 => array (
                'id' => 132,
                'name' => 'Thị xã Phổ Yên',
                'province_id' => 12,
            ),
            132 => array (
                'id' => 133,
                'name' => 'Huyện Phú Bình',
                'province_id' => 12,
            ),
            133 => array (
                'id' => 134,
                'name' => 'Thành phố Lạng Sơn',
                'province_id' => 13,
            ),
            134 => array (
                'id' => 135,
                'name' => 'Huyện Tràng Định',
                'province_id' => 13,
            ),
            135 => array (
                'id' => 136,
                'name' => 'Huyện Bình Gia',
                'province_id' => 13,
            ),
            136 => array (
                'id' => 137,
                'name' => 'Huyện Văn Lãng',
                'province_id' => 13,
            ),
            137 => array (
                'id' => 138,
                'name' => 'Huyện Cao Lộc',
                'province_id' => 13,
            ),
            138 => array (
                'id' => 139,
                'name' => 'Huyện Văn Quan',
                'province_id' => 13,
            ),
            139 => array (
                'id' => 140,
                'name' => 'Huyện Bắc Sơn',
                'province_id' => 13,
            ),
            140 => array (
                'id' => 141,
                'name' => 'Huyện Hữu Lũng',
                'province_id' => 13,
            ),
            141 => array (
                'id' => 142,
                'name' => 'Huyện Chi Lăng',
                'province_id' => 13,
            ),
            142 => array (
                'id' => 143,
                'name' => 'Huyện Lộc Bình',
                'province_id' => 13,
            ),
            143 => array (
                'id' => 144,
                'name' => 'Huyện Đình Lập',
                'province_id' => 13,
            ),
            144 => array (
                'id' => 145,
                'name' => 'Thành phố Hạ Long',
                'province_id' => 14,
            ),
            145 => array (
                'id' => 146,
                'name' => 'Thành phố Móng Cái',
                'province_id' => 14,
            ),
            146 => array (
                'id' => 147,
                'name' => 'Thành phố Cẩm Phả',
                'province_id' => 14,
            ),
            147 => array (
                'id' => 148,
                'name' => 'Thành phố Uông Bí',
                'province_id' => 14,
            ),
            148 => array (
                'id' => 149,
                'name' => 'Huyện Bình Liêu',
                'province_id' => 14,
            ),
            149 => array (
                'id' => 150,
                'name' => 'Huyện Tiên Yên',
                'province_id' => 14,
            ),
            150 => array (
                'id' => 151,
                'name' => 'Huyện Đầm Hà',
                'province_id' => 14,
            ),
            151 => array (
                'id' => 152,
                'name' => 'Huyện Hải Hà',
                'province_id' => 14,
            ),
            152 => array (
                'id' => 153,
                'name' => 'Huyện Ba Chẽ',
                'province_id' => 14,
            ),
            153 => array (
                'id' => 154,
                'name' => 'Huyện Vân Đồn',
                'province_id' => 14,
            ),
            154 => array (
                'id' => 155,
                'name' => 'Thị xã Đông Triều',
                'province_id' => 14,
            ),
            155 => array (
                'id' => 156,
                'name' => 'Thị xã Quảng Yên',
                'province_id' => 14,
            ),
            156 => array (
                'id' => 157,
                'name' => 'Huyện Cô Tô',
                'province_id' => 14,
            ),
            157 => array (
                'id' => 158,
                'name' => 'Thành phố Bắc Giang',
                'province_id' => 15,
            ),
            158 => array (
                'id' => 159,
                'name' => 'Huyện Yên Thế',
                'province_id' => 15,
            ),
            159 => array (
                'id' => 160,
                'name' => 'Huyện Tân Yên',
                'province_id' => 15,
            ),
            160 => array (
                'id' => 161,
                'name' => 'Huyện Lạng Giang',
                'province_id' => 15,
            ),
            161 => array (
                'id' => 162,
                'name' => 'Huyện Lục Nam',
                'province_id' => 15,
            ),
            162 => array (
                'id' => 163,
                'name' => 'Huyện Lục Ngạn',
                'province_id' => 15,
            ),
            163 => array (
                'id' => 164,
                'name' => 'Huyện Sơn Động',
                'province_id' => 15,
            ),
            164 => array (
                'id' => 165,
                'name' => 'Huyện Yên Dũng',
                'province_id' => 15,
            ),
            165 => array (
                'id' => 166,
                'name' => 'Huyện Việt Yên',
                'province_id' => 15,
            ),
            166 => array (
                'id' => 167,
                'name' => 'Huyện Hiệp Hòa',
                'province_id' => 15,
            ),
            167 => array (
                'id' => 168,
                'name' => 'Thành phố Việt Trì',
                'province_id' => 16,
            ),
            168 => array (
                'id' => 169,
                'name' => 'Thị xã Phú Thọ',
                'province_id' => 16,
            ),
            169 => array (
                'id' => 170,
                'name' => 'Huyện Đoan Hùng',
                'province_id' => 16,
            ),
            170 => array (
                'id' => 171,
                'name' => 'Huyện Hạ Hoà',
                'province_id' => 16,
            ),
            171 => array (
                'id' => 172,
                'name' => 'Huyện Thanh Ba',
                'province_id' => 16,
            ),
            172 => array (
                'id' => 173,
                'name' => 'Huyện Phù Ninh',
                'province_id' => 16,
            ),
            173 => array (
                'id' => 174,
                'name' => 'Huyện Yên Lập',
                'province_id' => 16,
            ),
            174 => array (
                'id' => 175,
                'name' => 'Huyện Cẩm Khê',
                'province_id' => 16,
            ),
            175 => array (
                'id' => 176,
                'name' => 'Huyện Tam Nông',
                'province_id' => 16,
            ),
            176 => array (
                'id' => 177,
                'name' => 'Huyện Lâm Thao',
                'province_id' => 16,
            ),
            177 => array (
                'id' => 178,
                'name' => 'Huyện Thanh Sơn',
                'province_id' => 16,
            ),
            178 => array (
                'id' => 179,
                'name' => 'Huyện Thanh Thuỷ',
                'province_id' => 16,
            ),
            179 => array (
                'id' => 180,
                'name' => 'Huyện Tân Sơn',
                'province_id' => 16,
            ),
            180 => array (
                'id' => 181,
                'name' => 'Thành phố Vĩnh Yên',
                'province_id' => 17,
            ),
            181 => array (
                'id' => 182,
                'name' => 'Thành phố Phúc Yên',
                'province_id' => 17,
            ),
            182 => array (
                'id' => 183,
                'name' => 'Huyện Lập Thạch',
                'province_id' => 17,
            ),
            183 => array (
                'id' => 184,
                'name' => 'Huyện Tam Dương',
                'province_id' => 17,
            ),
            184 => array (
                'id' => 185,
                'name' => 'Huyện Tam Đảo',
                'province_id' => 17,
            ),
            185 => array (
                'id' => 186,
                'name' => 'Huyện Bình Xuyên',
                'province_id' => 17,
            ),
            186 => array (
                'id' => 187,
                'name' => 'Huyện Yên Lạc',
                'province_id' => 17,
            ),
            187 => array (
                'id' => 188,
                'name' => 'Huyện Vĩnh Tường',
                'province_id' => 17,
            ),
            188 => array (
                'id' => 189,
                'name' => 'Huyện Sông Lô',
                'province_id' => 17,
            ),
            189 => array (
                'id' => 190,
                'name' => 'Thành phố Bắc Ninh',
                'province_id' => 18,
            ),
            190 => array (
                'id' => 191,
                'name' => 'Huyện Yên Phong',
                'province_id' => 18,
            ),
            191 => array (
                'id' => 192,
                'name' => 'Huyện Quế Võ',
                'province_id' => 18,
            ),
            192 => array (
                'id' => 193,
                'name' => 'Huyện Tiên Du',
                'province_id' => 18,
            ),
            193 => array (
                'id' => 194,
                'name' => 'Thị xã Từ Sơn',
                'province_id' => 18,
            ),
            194 => array (
                'id' => 195,
                'name' => 'Huyện Thuận Thành',
                'province_id' => 18,
            ),
            195 => array (
                'id' => 196,
                'name' => 'Huyện Gia Bình',
                'province_id' => 18,
            ),
            196 => array (
                'id' => 197,
                'name' => 'Huyện Lương Tài',
                'province_id' => 18,
            ),
            197 => array (
                'id' => 198,
                'name' => 'Thành phố Hải Dương',
                'province_id' => 19,
            ),
            198 => array (
                'id' => 199,
                'name' => 'Thành phố Chí Linh',
                'province_id' => 19,
            ),
            199 => array (
                'id' => 200,
                'name' => 'Huyện Nam Sách',
                'province_id' => 19,
            ),
            200 => array (
                'id' => 201,
                'name' => 'Thị xã Kinh Môn',
                'province_id' => 19,
            ),
            201 => array (
                'id' => 202,
                'name' => 'Huyện Kim Thành',
                'province_id' => 19,
            ),
            202 => array (
                'id' => 203,
                'name' => 'Huyện Thanh Hà',
                'province_id' => 19,
            ),
            203 => array (
                'id' => 204,
                'name' => 'Huyện Cẩm Giàng',
                'province_id' => 19,
            ),
            204 => array (
                'id' => 205,
                'name' => 'Huyện Bình Giang',
                'province_id' => 19,
            ),
            205 => array (
                'id' => 206,
                'name' => 'Huyện Gia Lộc',
                'province_id' => 19,
            ),
            206 => array (
                'id' => 207,
                'name' => 'Huyện Tứ Kỳ',
                'province_id' => 19,
            ),
            207 => array (
                'id' => 208,
                'name' => 'Huyện Ninh Giang',
                'province_id' => 19,
            ),
            208 => array (
                'id' => 209,
                'name' => 'Huyện Thanh Miện',
                'province_id' => 19,
            ),
            209 => array (
                'id' => 210,
                'name' => 'Quận Hồng Bàng',
                'province_id' => 20,
            ),
            210 => array (
                'id' => 211,
                'name' => 'Quận Ngô Quyền',
                'province_id' => 20,
            ),
            211 => array (
                'id' => 212,
                'name' => 'Quận Lê Chân',
                'province_id' => 20,
            ),
            212 => array (
                'id' => 213,
                'name' => 'Quận Hải An',
                'province_id' => 20,
            ),
            213 => array (
                'id' => 214,
                'name' => 'Quận Kiến An',
                'province_id' => 20,
            ),
            214 => array (
                'id' => 215,
                'name' => 'Quận Đồ Sơn',
                'province_id' => 20,
            ),
            215 => array (
                'id' => 216,
                'name' => 'Quận Dương Kinh',
                'province_id' => 20,
            ),
            216 => array (
                'id' => 217,
                'name' => 'Huyện Thuỷ Nguyên',
                'province_id' => 20,
            ),
            217 => array (
                'id' => 218,
                'name' => 'Huyện An Dương',
                'province_id' => 20,
            ),
            218 => array (
                'id' => 219,
                'name' => 'Huyện An Lão',
                'province_id' => 20,
            ),
            219 => array (
                'id' => 220,
                'name' => 'Huyện Kiến Thuỵ',
                'province_id' => 20,
            ),
            220 => array (
                'id' => 221,
                'name' => 'Huyện Tiên Lãng',
                'province_id' => 20,
            ),
            221 => array (
                'id' => 222,
                'name' => 'Huyện Vĩnh Bảo',
                'province_id' => 20,
            ),
            222 => array (
                'id' => 223,
                'name' => 'Huyện Cát Hải',
                'province_id' => 20,
            ),
            223 => array (
                'id' => 224,
                'name' => 'Thành phố Hưng Yên',
                'province_id' => 21,
            ),
            224 => array (
                'id' => 225,
                'name' => 'Huyện Văn Lâm',
                'province_id' => 21,
            ),
            225 => array (
                'id' => 226,
                'name' => 'Huyện Văn Giang',
                'province_id' => 21,
            ),
            226 => array (
                'id' => 227,
                'name' => 'Huyện Yên Mỹ',
                'province_id' => 21,
            ),
            227 => array (
                'id' => 228,
                'name' => 'Thị xã Mỹ Hào',
                'province_id' => 21,
            ),
            228 => array (
                'id' => 229,
                'name' => 'Huyện Ân Thi',
                'province_id' => 21,
            ),
            229 => array (
                'id' => 230,
                'name' => 'Huyện Khoái Châu',
                'province_id' => 21,
            ),
            230 => array (
                'id' => 231,
                'name' => 'Huyện Kim Động',
                'province_id' => 21,
            ),
            231 => array (
                'id' => 232,
                'name' => 'Huyện Tiên Lữ',
                'province_id' => 21,
            ),
            232 => array (
                'id' => 233,
                'name' => 'Huyện Phù Cừ',
                'province_id' => 21,
            ),
            233 => array (
                'id' => 234,
                'name' => 'Thành phố Thái Bình',
                'province_id' => 22,
            ),
            234 => array (
                'id' => 235,
                'name' => 'Huyện Quỳnh Phụ',
                'province_id' => 22,
            ),
            235 => array (
                'id' => 236,
                'name' => 'Huyện Hưng Hà',
                'province_id' => 22,
            ),
            236 => array (
                'id' => 237,
                'name' => 'Huyện Đông Hưng',
                'province_id' => 22,
            ),
            237 => array (
                'id' => 238,
                'name' => 'Huyện Thái Thụy',
                'province_id' => 22,
            ),
            238 => array (
                'id' => 239,
                'name' => 'Huyện Tiền Hải',
                'province_id' => 22,
            ),
            239 => array (
                'id' => 240,
                'name' => 'Huyện Kiến Xương',
                'province_id' => 22,
            ),
            240 => array (
                'id' => 241,
                'name' => 'Huyện Vũ Thư',
                'province_id' => 22,
            ),
            241 => array (
                'id' => 242,
                'name' => 'Thành phố Phủ Lý',
                'province_id' => 23,
            ),
            242 => array (
                'id' => 243,
                'name' => 'Thị xã Duy Tiên',
                'province_id' => 23,
            ),
            243 => array (
                'id' => 244,
                'name' => 'Huyện Kim Bảng',
                'province_id' => 23,
            ),
            244 => array (
                'id' => 245,
                'name' => 'Huyện Thanh Liêm',
                'province_id' => 23,
            ),
            245 => array (
                'id' => 246,
                'name' => 'Huyện Bình Lục',
                'province_id' => 23,
            ),
            246 => array (
                'id' => 247,
                'name' => 'Huyện Lý Nhân',
                'province_id' => 23,
            ),
            247 => array (
                'id' => 248,
                'name' => 'Thành phố Nam Định',
                'province_id' => 24,
            ),
            248 => array (
                'id' => 249,
                'name' => 'Huyện Mỹ Lộc',
                'province_id' => 24,
            ),
            249 => array (
                'id' => 250,
                'name' => 'Huyện Vụ Bản',
                'province_id' => 24,
            ),
            250 => array (
                'id' => 251,
                'name' => 'Huyện Ý Yên',
                'province_id' => 24,
            ),
            251 => array (
                'id' => 252,
                'name' => 'Huyện Nghĩa Hưng',
                'province_id' => 24,
            ),
            252 => array (
                'id' => 253,
                'name' => 'Huyện Nam Trực',
                'province_id' => 24,
            ),
            253 => array (
                'id' => 254,
                'name' => 'Huyện Trực Ninh',
                'province_id' => 24,
            ),
            254 => array (
                'id' => 255,
                'name' => 'Huyện Xuân Trường',
                'province_id' => 24,
            ),
            255 => array (
                'id' => 256,
                'name' => 'Huyện Giao Thủy',
                'province_id' => 24,
            ),
            256 => array (
                'id' => 257,
                'name' => 'Huyện Hải Hậu',
                'province_id' => 24,
            ),
            257 => array (
                'id' => 258,
                'name' => 'Thành phố Ninh Bình',
                'province_id' => 25,
            ),
            258 => array (
                'id' => 259,
                'name' => 'Thành phố Tam Điệp',
                'province_id' => 25,
            ),
            259 => array (
                'id' => 260,
                'name' => 'Huyện Nho Quan',
                'province_id' => 25,
            ),
            260 => array (
                'id' => 261,
                'name' => 'Huyện Gia Viễn',
                'province_id' => 25,
            ),
            261 => array (
                'id' => 262,
                'name' => 'Huyện Hoa Lư',
                'province_id' => 25,
            ),
            262 => array (
                'id' => 263,
                'name' => 'Huyện Yên Khánh',
                'province_id' => 25,
            ),
            263 => array (
                'id' => 264,
                'name' => 'Huyện Kim Sơn',
                'province_id' => 25,
            ),
            264 => array (
                'id' => 265,
                'name' => 'Huyện Yên Mô',
                'province_id' => 25,
            ),
            265 => array (
                'id' => 266,
                'name' => 'Thành phố Thanh Hóa',
                'province_id' => 26,
            ),
            266 => array (
                'id' => 267,
                'name' => 'Thị xã Bỉm Sơn',
                'province_id' => 26,
            ),
            267 => array (
                'id' => 268,
                'name' => 'Thành phố Sầm Sơn',
                'province_id' => 26,
            ),
            268 => array (
                'id' => 269,
                'name' => 'Huyện Mường Lát',
                'province_id' => 26,
            ),
            269 => array (
                'id' => 270,
                'name' => 'Huyện Quan Hóa',
                'province_id' => 26,
            ),
            270 => array (
                'id' => 271,
                'name' => 'Huyện Bá Thước',
                'province_id' => 26,
            ),
            271 => array (
                'id' => 272,
                'name' => 'Huyện Quan Sơn',
                'province_id' => 26,
            ),
            272 => array (
                'id' => 273,
                'name' => 'Huyện Lang Chánh',
                'province_id' => 26,
            ),
            273 => array (
                'id' => 274,
                'name' => 'Huyện Ngọc Lặc',
                'province_id' => 26,
            ),
            274 => array (
                'id' => 275,
                'name' => 'Huyện Cẩm Thủy',
                'province_id' => 26,
            ),
            275 => array (
                'id' => 276,
                'name' => 'Huyện Thạch Thành',
                'province_id' => 26,
            ),
            276 => array (
                'id' => 277,
                'name' => 'Huyện Hà Trung',
                'province_id' => 26,
            ),
            277 => array (
                'id' => 278,
                'name' => 'Huyện Vĩnh Lộc',
                'province_id' => 26,
            ),
            278 => array (
                'id' => 279,
                'name' => 'Huyện Yên Định',
                'province_id' => 26,
            ),
            279 => array (
                'id' => 280,
                'name' => 'Huyện Thọ Xuân',
                'province_id' => 26,
            ),
            280 => array (
                'id' => 281,
                'name' => 'Huyện Thường Xuân',
                'province_id' => 26,
            ),
            281 => array (
                'id' => 282,
                'name' => 'Huyện Triệu Sơn',
                'province_id' => 26,
            ),
            282 => array (
                'id' => 283,
                'name' => 'Huyện Thiệu Hóa',
                'province_id' => 26,
            ),
            283 => array (
                'id' => 284,
                'name' => 'Huyện Hoằng Hóa',
                'province_id' => 26,
            ),
            284 => array (
                'id' => 285,
                'name' => 'Huyện Hậu Lộc',
                'province_id' => 26,
            ),
            285 => array (
                'id' => 286,
                'name' => 'Huyện Nga Sơn',
                'province_id' => 26,
            ),
            286 => array (
                'id' => 287,
                'name' => 'Huyện Như Xuân',
                'province_id' => 26,
            ),
            287 => array (
                'id' => 288,
                'name' => 'Huyện Như Thanh',
                'province_id' => 26,
            ),
            288 => array (
                'id' => 289,
                'name' => 'Huyện Nông Cống',
                'province_id' => 26,
            ),
            289 => array (
                'id' => 290,
                'name' => 'Huyện Đông Sơn',
                'province_id' => 26,
            ),
            290 => array (
                'id' => 291,
                'name' => 'Huyện Quảng Xương',
                'province_id' => 26,
            ),
            291 => array (
                'id' => 292,
                'name' => 'Thị xã Nghi Sơn',
                'province_id' => 26,
            ),
            292 => array (
                'id' => 293,
                'name' => 'Thành phố Vinh',
                'province_id' => 27,
            ),
            293 => array (
                'id' => 294,
                'name' => 'Thị xã Cửa Lò',
                'province_id' => 27,
            ),
            294 => array (
                'id' => 295,
                'name' => 'Thị xã Thái Hoà',
                'province_id' => 27,
            ),
            295 => array (
                'id' => 296,
                'name' => 'Huyện Quế Phong',
                'province_id' => 27,
            ),
            296 => array (
                'id' => 297,
                'name' => 'Huyện Quỳ Châu',
                'province_id' => 27,
            ),
            297 => array (
                'id' => 298,
                'name' => 'Huyện Kỳ Sơn',
                'province_id' => 27,
            ),
            298 => array (
                'id' => 299,
                'name' => 'Huyện Tương Dương',
                'province_id' => 27,
            ),
            299 => array (
                'id' => 300,
                'name' => 'Huyện Nghĩa Đàn',
                'province_id' => 27,
            ),
            300 => array (
                'id' => 301,
                'name' => 'Huyện Quỳ Hợp',
                'province_id' => 27,
            ),
            301 => array (
                'id' => 302,
                'name' => 'Huyện Quỳnh Lưu',
                'province_id' => 27,
            ),
            302 => array (
                'id' => 303,
                'name' => 'Huyện Con Cuông',
                'province_id' => 27,
            ),
            303 => array (
                'id' => 304,
                'name' => 'Huyện Tân Kỳ',
                'province_id' => 27,
            ),
            304 => array (
                'id' => 305,
                'name' => 'Huyện Anh Sơn',
                'province_id' => 27,
            ),
            305 => array (
                'id' => 306,
                'name' => 'Huyện Diễn Châu',
                'province_id' => 27,
            ),
            306 => array (
                'id' => 307,
                'name' => 'Huyện Yên Thành',
                'province_id' => 27,
            ),
            307 => array (
                'id' => 308,
                'name' => 'Huyện Đô Lương',
                'province_id' => 27,
            ),
            308 => array (
                'id' => 309,
                'name' => 'Huyện Thanh Chương',
                'province_id' => 27,
            ),
            309 => array (
                'id' => 310,
                'name' => 'Huyện Nghi Lộc',
                'province_id' => 27,
            ),
            310 => array (
                'id' => 311,
                'name' => 'Huyện Nam Đàn',
                'province_id' => 27,
            ),
            311 => array (
                'id' => 312,
                'name' => 'Huyện Hưng Nguyên',
                'province_id' => 27,
            ),
            312 => array (
                'id' => 313,
                'name' => 'Thị xã Hoàng Mai',
                'province_id' => 27,
            ),
            313 => array (
                'id' => 314,
                'name' => 'Thành phố Hà Tĩnh',
                'province_id' => 28,
            ),
            314 => array (
                'id' => 315,
                'name' => 'Thị xã Hồng Lĩnh',
                'province_id' => 28,
            ),
            315 => array (
                'id' => 316,
                'name' => 'Huyện Hương Sơn',
                'province_id' => 28,
            ),
            316 => array (
                'id' => 317,
                'name' => 'Huyện Đức Thọ',
                'province_id' => 28,
            ),
            317 => array (
                'id' => 318,
                'name' => 'Huyện Vũ Quang',
                'province_id' => 28,
            ),
            318 => array (
                'id' => 319,
                'name' => 'Huyện Nghi Xuân',
                'province_id' => 28,
            ),
            319 => array (
                'id' => 320,
                'name' => 'Huyện Can Lộc',
                'province_id' => 28,
            ),
            320 => array (
                'id' => 321,
                'name' => 'Huyện Hương Khê',
                'province_id' => 28,
            ),
            321 => array (
                'id' => 322,
                'name' => 'Huyện Thạch Hà',
                'province_id' => 28,
            ),
            322 => array (
                'id' => 323,
                'name' => 'Huyện Cẩm Xuyên',
                'province_id' => 28,
            ),
            323 => array (
                'id' => 324,
                'name' => 'Huyện Kỳ Anh',
                'province_id' => 28,
            ),
            324 => array (
                'id' => 325,
                'name' => 'Huyện Lộc Hà',
                'province_id' => 28,
            ),
            325 => array (
                'id' => 326,
                'name' => 'Thị xã Kỳ Anh',
                'province_id' => 28,
            ),
            326 => array (
                'id' => 327,
                'name' => 'Thành Phố Đồng Hới',
                'province_id' => 29,
            ),
            327 => array (
                'id' => 328,
                'name' => 'Huyện Minh Hóa',
                'province_id' => 29,
            ),
            328 => array (
                'id' => 329,
                'name' => 'Huyện Tuyên Hóa',
                'province_id' => 29,
            ),
            329 => array (
                'id' => 330,
                'name' => 'Huyện Quảng Trạch',
                'province_id' => 29,
            ),
            330 => array (
                'id' => 331,
                'name' => 'Huyện Bố Trạch',
                'province_id' => 29,
            ),
            331 => array (
                'id' => 332,
                'name' => 'Huyện Quảng Ninh',
                'province_id' => 29,
            ),
            332 => array (
                'id' => 333,
                'name' => 'Huyện Lệ Thủy',
                'province_id' => 29,
            ),
            333 => array (
                'id' => 334,
                'name' => 'Thị xã Ba Đồn',
                'province_id' => 29,
            ),
            334 => array (
                'id' => 335,
                'name' => 'Thành phố Đông Hà',
                'province_id' => 30,
            ),
            335 => array (
                'id' => 336,
                'name' => 'Thị xã Quảng Trị',
                'province_id' => 30,
            ),
            336 => array (
                'id' => 337,
                'name' => 'Huyện Vĩnh Linh',
                'province_id' => 30,
            ),
            337 => array (
                'id' => 338,
                'name' => 'Huyện Hướng Hóa',
                'province_id' => 30,
            ),
            338 => array (
                'id' => 339,
                'name' => 'Huyện Gio Linh',
                'province_id' => 30,
            ),
            339 => array (
                'id' => 340,
                'name' => 'Huyện Đa Krông',
                'province_id' => 30,
            ),
            340 => array (
                'id' => 341,
                'name' => 'Huyện Cam Lộ',
                'province_id' => 30,
            ),
            341 => array (
                'id' => 342,
                'name' => 'Huyện Triệu Phong',
                'province_id' => 30,
            ),
            342 => array (
                'id' => 343,
                'name' => 'Huyện Hải Lăng',
                'province_id' => 30,
            ),
            343 => array (
                'id' => 344,
                'name' => 'Thành phố Huế',
                'province_id' => 31,
            ),
            344 => array (
                'id' => 345,
                'name' => 'Huyện Phong Điền',
                'province_id' => 31,
            ),
            345 => array (
                'id' => 346,
                'name' => 'Huyện Quảng Điền',
                'province_id' => 31,
            ),
            346 => array (
                'id' => 347,
                'name' => 'Huyện Phú Vang',
                'province_id' => 31,
            ),
            347 => array (
                'id' => 348,
                'name' => 'Thị xã Hương Thủy',
                'province_id' => 31,
            ),
            348 => array (
                'id' => 349,
                'name' => 'Thị xã Hương Trà',
                'province_id' => 31,
            ),
            349 => array (
                'id' => 350,
                'name' => 'Huyện A Lưới',
                'province_id' => 31,
            ),
            350 => array (
                'id' => 351,
                'name' => 'Huyện Phú Lộc',
                'province_id' => 31,
            ),
            351 => array (
                'id' => 352,
                'name' => 'Huyện Nam Đông',
                'province_id' => 31,
            ),
            352 => array (
                'id' => 353,
                'name' => 'Quận Liên Chiểu',
                'province_id' => 32,
            ),
            353 => array (
                'id' => 354,
                'name' => 'Quận Thanh Khê',
                'province_id' => 32,
            ),
            354 => array (
                'id' => 355,
                'name' => 'Quận Hải Châu',
                'province_id' => 32,
            ),
            355 => array (
                'id' => 356,
                'name' => 'Quận Sơn Trà',
                'province_id' => 32,
            ),
            356 => array (
                'id' => 357,
                'name' => 'Quận Ngũ Hành Sơn',
                'province_id' => 32,
            ),
            357 => array (
                'id' => 358,
                'name' => 'Quận Cẩm Lệ',
                'province_id' => 32,
            ),
            358 => array (
                'id' => 359,
                'name' => 'Huyện Hòa Vang',
                'province_id' => 32,
            ),
            359 => array (
                'id' => 360,
                'name' => 'Thành phố Tam Kỳ',
                'province_id' => 33,
            ),
            360 => array (
                'id' => 361,
                'name' => 'Thành phố Hội An',
                'province_id' => 33,
            ),
            361 => array (
                'id' => 362,
                'name' => 'Huyện Tây Giang',
                'province_id' => 33,
            ),
            362 => array (
                'id' => 363,
                'name' => 'Huyện Đông Giang',
                'province_id' => 33,
            ),
            363 => array (
                'id' => 364,
                'name' => 'Huyện Đại Lộc',
                'province_id' => 33,
            ),
            364 => array (
                'id' => 365,
                'name' => 'Thị xã Điện Bàn',
                'province_id' => 33,
            ),
            365 => array (
                'id' => 366,
                'name' => 'Huyện Duy Xuyên',
                'province_id' => 33,
            ),
            366 => array (
                'id' => 367,
                'name' => 'Huyện Quế Sơn',
                'province_id' => 33,
            ),
            367 => array (
                'id' => 368,
                'name' => 'Huyện Nam Giang',
                'province_id' => 33,
            ),
            368 => array (
                'id' => 369,
                'name' => 'Huyện Phước Sơn',
                'province_id' => 33,
            ),
            369 => array (
                'id' => 370,
                'name' => 'Huyện Hiệp Đức',
                'province_id' => 33,
            ),
            370 => array (
                'id' => 371,
                'name' => 'Huyện Thăng Bình',
                'province_id' => 33,
            ),
            371 => array (
                'id' => 372,
                'name' => 'Huyện Tiên Phước',
                'province_id' => 33,
            ),
            372 => array (
                'id' => 373,
                'name' => 'Huyện Bắc Trà My',
                'province_id' => 33,
            ),
            373 => array (
                'id' => 374,
                'name' => 'Huyện Nam Trà My',
                'province_id' => 33,
            ),
            374 => array (
                'id' => 375,
                'name' => 'Huyện Núi Thành',
                'province_id' => 33,
            ),
            375 => array (
                'id' => 376,
                'name' => 'Huyện Phú Ninh',
                'province_id' => 33,
            ),
            376 => array (
                'id' => 377,
                'name' => 'Huyện Nông Sơn',
                'province_id' => 33,
            ),
            377 => array (
                'id' => 378,
                'name' => 'Thành phố Quảng Ngãi',
                'province_id' => 34,
            ),
            378 => array (
                'id' => 379,
                'name' => 'Huyện Bình Sơn',
                'province_id' => 34,
            ),
            379 => array (
                'id' => 380,
                'name' => 'Huyện Trà Bồng',
                'province_id' => 34,
            ),
            380 => array (
                'id' => 381,
                'name' => 'Huyện Sơn Tịnh',
                'province_id' => 34,
            ),
            381 => array (
                'id' => 382,
                'name' => 'Huyện Tư Nghĩa',
                'province_id' => 34,
            ),
            382 => array (
                'id' => 383,
                'name' => 'Huyện Sơn Hà',
                'province_id' => 34,
            ),
            383 => array (
                'id' => 384,
                'name' => 'Huyện Sơn Tây',
                'province_id' => 34,
            ),
            384 => array (
                'id' => 385,
                'name' => 'Huyện Minh Long',
                'province_id' => 34,
            ),
            385 => array (
                'id' => 386,
                'name' => 'Huyện Nghĩa Hành',
                'province_id' => 34,
            ),
            386 => array (
                'id' => 387,
                'name' => 'Huyện Mộ Đức',
                'province_id' => 34,
            ),
            387 => array (
                'id' => 388,
                'name' => 'Thị xã Đức Phổ',
                'province_id' => 34,
            ),
            388 => array (
                'id' => 389,
                'name' => 'Huyện Ba Tơ',
                'province_id' => 34,
            ),
            389 => array (
                'id' => 390,
                'name' => 'Thành phố Qui Nhơn',
                'province_id' => 35,
            ),
            390 => array (
                'id' => 391,
                'name' => 'Huyện An Lão',
                'province_id' => 35,
            ),
            391 => array (
                'id' => 392,
                'name' => 'Thị xã Hoài Nhơn',
                'province_id' => 35,
            ),
            392 => array (
                'id' => 393,
                'name' => 'Huyện Hoài Ân',
                'province_id' => 35,
            ),
            393 => array (
                'id' => 394,
                'name' => 'Huyện Phù Mỹ',
                'province_id' => 35,
            ),
            394 => array (
                'id' => 395,
                'name' => 'Huyện Vĩnh Thạnh',
                'province_id' => 35,
            ),
            395 => array (
                'id' => 396,
                'name' => 'Huyện Tây Sơn',
                'province_id' => 35,
            ),
            396 => array (
                'id' => 397,
                'name' => 'Huyện Phù Cát',
                'province_id' => 35,
            ),
            397 => array (
                'id' => 398,
                'name' => 'Thị xã An Nhơn',
                'province_id' => 35,
            ),
            398 => array (
                'id' => 399,
                'name' => 'Huyện Tuy Phước',
                'province_id' => 35,
            ),
            399 => array (
                'id' => 400,
                'name' => 'Huyện Vân Canh',
                'province_id' => 35,
            ),
            400 => array (
                'id' => 401,
                'name' => 'Thành phố Tuy Hoà',
                'province_id' => 36,
            ),
            401 => array (
                'id' => 402,
                'name' => 'Thị xã Sông Cầu',
                'province_id' => 36,
            ),
            402 => array (
                'id' => 403,
                'name' => 'Huyện Đồng Xuân',
                'province_id' => 36,
            ),
            403 => array (
                'id' => 404,
                'name' => 'Huyện Tuy An',
                'province_id' => 36,
            ),
            404 => array (
                'id' => 405,
                'name' => 'Huyện Sơn Hòa',
                'province_id' => 36,
            ),
            405 => array (
                'id' => 406,
                'name' => 'Huyện Sông Hinh',
                'province_id' => 36,
            ),
            406 => array (
                'id' => 407,
                'name' => 'Huyện Tây Hoà',
                'province_id' => 36,
            ),
            407 => array (
                'id' => 408,
                'name' => 'Huyện Phú Hoà',
                'province_id' => 36,
            ),
            408 => array (
                'id' => 409,
                'name' => 'Thị xã Đông Hòa',
                'province_id' => 36,
            ),
            409 => array (
                'id' => 410,
                'name' => 'Thành phố Nha Trang',
                'province_id' => 37,
            ),
            410 => array (
                'id' => 411,
                'name' => 'Thành phố Cam Ranh',
                'province_id' => 37,
            ),
            411 => array (
                'id' => 412,
                'name' => 'Huyện Cam Lâm',
                'province_id' => 37,
            ),
            412 => array (
                'id' => 413,
                'name' => 'Huyện Vạn Ninh',
                'province_id' => 37,
            ),
            413 => array (
                'id' => 414,
                'name' => 'Thị xã Ninh Hòa',
                'province_id' => 37,
            ),
            414 => array (
                'id' => 415,
                'name' => 'Huyện Khánh Vĩnh',
                'province_id' => 37,
            ),
            415 => array (
                'id' => 416,
                'name' => 'Huyện Diên Khánh',
                'province_id' => 37,
            ),
            416 => array (
                'id' => 417,
                'name' => 'Huyện Khánh Sơn',
                'province_id' => 37,
            ),
            417 => array (
                'id' => 418,
                'name' => 'Huyện Trường Sa',
                'province_id' => 37,
            ),
            418 => array (
                'id' => 419,
                'name' => 'Thành phố Phan Rang-Tháp Chàm',
                'province_id' => 38,
            ),
            419 => array (
                'id' => 420,
                'name' => 'Huyện Bác Ái',
                'province_id' => 38,
            ),
            420 => array (
                'id' => 421,
                'name' => 'Huyện Ninh Sơn',
                'province_id' => 38,
            ),
            421 => array (
                'id' => 422,
                'name' => 'Huyện Ninh Hải',
                'province_id' => 38,
            ),
            422 => array (
                'id' => 423,
                'name' => 'Huyện Ninh Phước',
                'province_id' => 38,
            ),
            423 => array (
                'id' => 424,
                'name' => 'Huyện Thuận Bắc',
                'province_id' => 38,
            ),
            424 => array (
                'id' => 425,
                'name' => 'Huyện Thuận Nam',
                'province_id' => 38,
            ),
            425 => array (
                'id' => 426,
                'name' => 'Thành phố Phan Thiết',
                'province_id' => 39,
            ),
            426 => array (
                'id' => 427,
                'name' => 'Thị xã La Gi',
                'province_id' => 39,
            ),
            427 => array (
                'id' => 428,
                'name' => 'Huyện Tuy Phong',
                'province_id' => 39,
            ),
            428 => array (
                'id' => 429,
                'name' => 'Huyện Bắc Bình',
                'province_id' => 39,
            ),
            429 => array (
                'id' => 430,
                'name' => 'Huyện Hàm Thuận Bắc',
                'province_id' => 39,
            ),
            430 => array (
                'id' => 431,
                'name' => 'Huyện Hàm Thuận Nam',
                'province_id' => 39,
            ),
            431 => array (
                'id' => 432,
                'name' => 'Huyện Tánh Linh',
                'province_id' => 39,
            ),
            432 => array (
                'id' => 433,
                'name' => 'Huyện Đức Linh',
                'province_id' => 39,
            ),
            433 => array (
                'id' => 434,
                'name' => 'Huyện Hàm Tân',
                'province_id' => 39,
            ),
            434 => array (
                'id' => 435,
                'name' => 'Huyện Phú Quí',
                'province_id' => 39,
            ),
            435 => array (
                'id' => 436,
                'name' => 'Thành phố Kon Tum',
                'province_id' => 40,
            ),
            436 => array (
                'id' => 437,
                'name' => 'Huyện Đắk Glei',
                'province_id' => 40,
            ),
            437 => array (
                'id' => 438,
                'name' => 'Huyện Ngọc Hồi',
                'province_id' => 40,
            ),
            438 => array (
                'id' => 439,
                'name' => 'Huyện Đắk Tô',
                'province_id' => 40,
            ),
            439 => array (
                'id' => 440,
                'name' => 'Huyện Kon Plông',
                'province_id' => 40,
            ),
            440 => array (
                'id' => 441,
                'name' => 'Huyện Kon Rẫy',
                'province_id' => 40,
            ),
            441 => array (
                'id' => 442,
                'name' => 'Huyện Đắk Hà',
                'province_id' => 40,
            ),
            442 => array (
                'id' => 443,
                'name' => 'Huyện Sa Thầy',
                'province_id' => 40,
            ),
            443 => array (
                'id' => 444,
                'name' => 'Huyện Tu Mơ Rông',
                'province_id' => 40,
            ),
            444 => array (
                'id' => 445,
                'name' => 'Huyện Ia H\' Drai',
                'province_id' => 40,
            ),
            445 => array (
                'id' => 446,
                'name' => 'Thành phố Pleiku',
                'province_id' => 41,
            ),
            446 => array (
                'id' => 447,
                'name' => 'Thị xã An Khê',
                'province_id' => 41,
            ),
            447 => array (
                'id' => 448,
                'name' => 'Thị xã Ayun Pa',
                'province_id' => 41,
            ),
            448 => array (
                'id' => 449,
                'name' => 'Huyện KBang',
                'province_id' => 41,
            ),
            449 => array (
                'id' => 450,
                'name' => 'Huyện Đăk Đoa',
                'province_id' => 41,
            ),
            450 => array (
                'id' => 451,
                'name' => 'Huyện Chư Păh',
                'province_id' => 41,
            ),
            451 => array (
                'id' => 452,
                'name' => 'Huyện Ia Grai',
                'province_id' => 41,
            ),
            452 => array (
                'id' => 453,
                'name' => 'Huyện Mang Yang',
                'province_id' => 41,
            ),
            453 => array (
                'id' => 454,
                'name' => 'Huyện Kông Chro',
                'province_id' => 41,
            ),
            454 => array (
                'id' => 455,
                'name' => 'Huyện Đức Cơ',
                'province_id' => 41,
            ),
            455 => array (
                'id' => 456,
                'name' => 'Huyện Chư Prông',
                'province_id' => 41,
            ),
            456 => array (
                'id' => 457,
                'name' => 'Huyện Chư Sê',
                'province_id' => 41,
            ),
            457 => array (
                'id' => 458,
                'name' => 'Huyện Đăk Pơ',
                'province_id' => 41,
            ),
            458 => array (
                'id' => 459,
                'name' => 'Huyện Ia Pa',
                'province_id' => 41,
            ),
            459 => array (
                'id' => 460,
                'name' => 'Huyện Krông Pa',
                'province_id' => 41,
            ),
            460 => array (
                'id' => 461,
                'name' => 'Huyện Phú Thiện',
                'province_id' => 41,
            ),
            461 => array (
                'id' => 462,
                'name' => 'Huyện Chư Pưh',
                'province_id' => 41,
            ),
            462 => array (
                'id' => 463,
                'name' => 'Thành phố Buôn Ma Thuột',
                'province_id' => 42,
            ),
            463 => array (
                'id' => 464,
                'name' => 'Thị Xã Buôn Hồ',
                'province_id' => 42,
            ),
            464 => array (
                'id' => 465,
                'name' => 'Huyện Ea H\'leo',
                'province_id' => 42,
            ),
            465 => array (
                'id' => 466,
                'name' => 'Huyện Ea Súp',
                'province_id' => 42,
            ),
            466 => array (
                'id' => 467,
                'name' => 'Huyện Buôn Đôn',
                'province_id' => 42,
            ),
            467 => array (
                'id' => 468,
                'name' => 'Huyện Cư M\'gar',
                'province_id' => 42,
            ),
            468 => array (
                'id' => 469,
                'name' => 'Huyện Krông Búk',
                'province_id' => 42,
            ),
            469 => array (
                'id' => 470,
                'name' => 'Huyện Krông Năng',
                'province_id' => 42,
            ),
            470 => array (
                'id' => 471,
                'name' => 'Huyện Ea Kar',
                'province_id' => 42,
            ),
            471 => array (
                'id' => 472,
                'name' => 'Huyện M\'Đrắk',
                'province_id' => 42,
            ),
            472 => array (
                'id' => 473,
                'name' => 'Huyện Krông Bông',
                'province_id' => 42,
            ),
            473 => array (
                'id' => 474,
                'name' => 'Huyện Krông Pắc',
                'province_id' => 42,
            ),
            474 => array (
                'id' => 475,
                'name' => 'Huyện Krông A Na',
                'province_id' => 42,
            ),
            475 => array (
                'id' => 476,
                'name' => 'Huyện Lắk',
                'province_id' => 42,
            ),
            476 => array (
                'id' => 477,
                'name' => 'Huyện Cư Kuin',
                'province_id' => 42,
            ),
            477 => array (
                'id' => 478,
                'name' => 'Thành phố Gia Nghĩa',
                'province_id' => 43,
            ),
            478 => array (
                'id' => 479,
                'name' => 'Huyện Đăk Glong',
                'province_id' => 43,
            ),
            479 => array (
                'id' => 480,
                'name' => 'Huyện Cư Jút',
                'province_id' => 43,
            ),
            480 => array (
                'id' => 481,
                'name' => 'Huyện Đắk Mil',
                'province_id' => 43,
            ),
            481 => array (
                'id' => 482,
                'name' => 'Huyện Krông Nô',
                'province_id' => 43,
            ),
            482 => array (
                'id' => 483,
                'name' => 'Huyện Đắk Song',
                'province_id' => 43,
            ),
            483 => array (
                'id' => 484,
                'name' => 'Huyện Đắk R\'Lấp',
                'province_id' => 43,
            ),
            484 => array (
                'id' => 485,
                'name' => 'Huyện Tuy Đức',
                'province_id' => 43,
            ),
            485 => array (
                'id' => 486,
                'name' => 'Thành phố Đà Lạt',
                'province_id' => 44,
            ),
            486 => array (
                'id' => 487,
                'name' => 'Thành phố Bảo Lộc',
                'province_id' => 44,
            ),
            487 => array (
                'id' => 488,
                'name' => 'Huyện Đam Rông',
                'province_id' => 44,
            ),
            488 => array (
                'id' => 489,
                'name' => 'Huyện Lạc Dương',
                'province_id' => 44,
            ),
            489 => array (
                'id' => 490,
                'name' => 'Huyện Lâm Hà',
                'province_id' => 44,
            ),
            490 => array (
                'id' => 491,
                'name' => 'Huyện Đơn Dương',
                'province_id' => 44,
            ),
            491 => array (
                'id' => 492,
                'name' => 'Huyện Đức Trọng',
                'province_id' => 44,
            ),
            492 => array (
                'id' => 493,
                'name' => 'Huyện Di Linh',
                'province_id' => 44,
            ),
            493 => array (
                'id' => 494,
                'name' => 'Huyện Bảo Lâm',
                'province_id' => 44,
            ),
            494 => array (
                'id' => 495,
                'name' => 'Huyện Đạ Huoai',
                'province_id' => 44,
            ),
            495 => array (
                'id' => 496,
                'name' => 'Huyện Đạ Tẻh',
                'province_id' => 44,
            ),
            496 => array (
                'id' => 497,
                'name' => 'Huyện Cát Tiên',
                'province_id' => 44,
            ),
            497 => array (
                'id' => 498,
                'name' => 'Thị xã Phước Long',
                'province_id' => 45,
            ),
            498 => array (
                'id' => 499,
                'name' => 'Thành phố Đồng Xoài',
                'province_id' => 45,
            ),
            499 => array (
                'id' => 500,
                'name' => 'Thị xã Bình Long',
                'province_id' => 45,
            ),
        ));

        DB::table('districts')->insert(array (
            0 => array (
                'id' => 501,
                'name' => 'Huyện Bù Gia Mập',
                'province_id' => 45,
            ),
            1 => array (
                'id' => 502,
                'name' => 'Huyện Lộc Ninh',
                'province_id' => 45,
            ),
            2 => array (
                'id' => 503,
                'name' => 'Huyện Bù Đốp',
                'province_id' => 45,
            ),
            3 => array (
                'id' => 504,
                'name' => 'Huyện Hớn Quản',
                'province_id' => 45,
            ),
            4 => array (
                'id' => 505,
                'name' => 'Huyện Đồng Phú',
                'province_id' => 45,
            ),
            5 => array (
                'id' => 506,
                'name' => 'Huyện Bù Đăng',
                'province_id' => 45,
            ),
            6 => array (
                'id' => 507,
                'name' => 'Huyện Chơn Thành',
                'province_id' => 45,
            ),
            7 => array (
                'id' => 508,
                'name' => 'Huyện Phú Riềng',
                'province_id' => 45,
            ),
            8 => array (
                'id' => 509,
                'name' => 'Thành phố Tây Ninh',
                'province_id' => 46,
            ),
            9 => array (
                'id' => 510,
                'name' => 'Huyện Tân Biên',
                'province_id' => 46,
            ),
            10 => array (
                'id' => 511,
                'name' => 'Huyện Tân Châu',
                'province_id' => 46,
            ),
            11 => array (
                'id' => 512,
                'name' => 'Huyện Dương Minh Châu',
                'province_id' => 46,
            ),
            12 => array (
                'id' => 513,
                'name' => 'Huyện Châu Thành',
                'province_id' => 46,
            ),
            13 => array (
                'id' => 514,
                'name' => 'Thị xã Hòa Thành',
                'province_id' => 46,
            ),
            14 => array (
                'id' => 515,
                'name' => 'Huyện Gò Dầu',
                'province_id' => 46,
            ),
            15 => array (
                'id' => 516,
                'name' => 'Huyện Bến Cầu',
                'province_id' => 46,
            ),
            16 => array (
                'id' => 517,
                'name' => 'Thị xã Trảng Bàng',
                'province_id' => 46,
            ),
            17 => array (
                'id' => 518,
                'name' => 'Thành phố Thủ Dầu Một',
                'province_id' => 47,
            ),
            18 => array (
                'id' => 519,
                'name' => 'Huyện Bàu Bàng',
                'province_id' => 47,
            ),
            19 => array (
                'id' => 520,
                'name' => 'Huyện Dầu Tiếng',
                'province_id' => 47,
            ),
            20 => array (
                'id' => 521,
                'name' => 'Thị xã Bến Cát',
                'province_id' => 47,
            ),
            21 => array (
                'id' => 522,
                'name' => 'Huyện Phú Giáo',
                'province_id' => 47,
            ),
            22 => array (
                'id' => 523,
                'name' => 'Thị xã Tân Uyên',
                'province_id' => 47,
            ),
            23 => array (
                'id' => 524,
                'name' => 'Thành phố Dĩ An',
                'province_id' => 47,
            ),
            24 => array (
                'id' => 525,
                'name' => 'Thành phố Thuận An',
                'province_id' => 47,
            ),
            25 => array (
                'id' => 526,
                'name' => 'Huyện Bắc Tân Uyên',
                'province_id' => 47,
            ),
            26 => array (
                'id' => 527,
                'name' => 'Thành phố Biên Hòa',
                'province_id' => 48,
            ),
            27 => array (
                'id' => 528,
                'name' => 'Thành phố Long Khánh',
                'province_id' => 48,
            ),
            28 => array (
                'id' => 529,
                'name' => 'Huyện Tân Phú',
                'province_id' => 48,
            ),
            29 => array (
                'id' => 530,
                'name' => 'Huyện Vĩnh Cửu',
                'province_id' => 48,
            ),
            30 => array (
                'id' => 531,
                'name' => 'Huyện Định Quán',
                'province_id' => 48,
            ),
            31 => array (
                'id' => 532,
                'name' => 'Huyện Trảng Bom',
                'province_id' => 48,
            ),
            32 => array (
                'id' => 533,
                'name' => 'Huyện Thống Nhất',
                'province_id' => 48,
            ),
            33 => array (
                'id' => 534,
                'name' => 'Huyện Cẩm Mỹ',
                'province_id' => 48,
            ),
            34 => array (
                'id' => 535,
                'name' => 'Huyện Long Thành',
                'province_id' => 48,
            ),
            35 => array (
                'id' => 536,
                'name' => 'Huyện Xuân Lộc',
                'province_id' => 48,
            ),
            36 => array (
                'id' => 537,
                'name' => 'Huyện Nhơn Trạch',
                'province_id' => 48,
            ),
            37 => array (
                'id' => 538,
                'name' => 'Thành phố Vũng Tàu',
                'province_id' => 49,
            ),
            38 => array (
                'id' => 539,
                'name' => 'Thành phố Bà Rịa',
                'province_id' => 49,
            ),
            39 => array (
                'id' => 540,
                'name' => 'Huyện Châu Đức',
                'province_id' => 49,
            ),
            40 => array (
                'id' => 541,
                'name' => 'Huyện Xuyên Mộc',
                'province_id' => 49,
            ),
            41 => array (
                'id' => 542,
                'name' => 'Huyện Long Điền',
                'province_id' => 49,
            ),
            42 => array (
                'id' => 543,
                'name' => 'Huyện Đất Đỏ',
                'province_id' => 49,
            ),
            43 => array (
                'id' => 544,
                'name' => 'Thị xã Phú Mỹ',
                'province_id' => 49,
            ),
            44 => array (
                'id' => 545,
                'name' => 'Quận 1',
                'province_id' => 50,
            ),
            45 => array (
                'id' => 546,
                'name' => 'Quận 12',
                'province_id' => 50,
            ),
            46 => array (
                'id' => 547,
                'name' => 'Quận Thủ Đức',
                'province_id' => 50,
            ),
            47 => array (
                'id' => 548,
                'name' => 'Quận 9',
                'province_id' => 50,
            ),
            48 => array (
                'id' => 549,
                'name' => 'Quận Gò Vấp',
                'province_id' => 50,
            ),
            49 => array (
                'id' => 550,
                'name' => 'Quận Bình Thạnh',
                'province_id' => 50,
            ),
            50 => array (
                'id' => 551,
                'name' => 'Quận Tân Bình',
                'province_id' => 50,
            ),
            51 => array (
                'id' => 552,
                'name' => 'Quận Tân Phú',
                'province_id' => 50,
            ),
            52 => array (
                'id' => 553,
                'name' => 'Quận Phú Nhuận',
                'province_id' => 50,
            ),
            53 => array (
                'id' => 554,
                'name' => 'Quận 2',
                'province_id' => 50,
            ),
            54 => array (
                'id' => 555,
                'name' => 'Quận 3',
                'province_id' => 50,
            ),
            55 => array (
                'id' => 556,
                'name' => 'Quận 10',
                'province_id' => 50,
            ),
            56 => array (
                'id' => 557,
                'name' => 'Quận 11',
                'province_id' => 50,
            ),
            57 => array (
                'id' => 558,
                'name' => 'Quận 4',
                'province_id' => 50,
            ),
            58 => array (
                'id' => 559,
                'name' => 'Quận 5',
                'province_id' => 50,
            ),
            59 => array (
                'id' => 560,
                'name' => 'Quận 6',
                'province_id' => 50,
            ),
            60 => array (
                'id' => 561,
                'name' => 'Quận 8',
                'province_id' => 50,
            ),
            61 => array (
                'id' => 562,
                'name' => 'Quận Bình Tân',
                'province_id' => 50,
            ),
            62 => array (
                'id' => 563,
                'name' => 'Quận 7',
                'province_id' => 50,
            ),
            63 => array (
                'id' => 564,
                'name' => 'Huyện Củ Chi',
                'province_id' => 50,
            ),
            64 => array (
                'id' => 565,
                'name' => 'Huyện Hóc Môn',
                'province_id' => 50,
            ),
            65 => array (
                'id' => 566,
                'name' => 'Huyện Bình Chánh',
                'province_id' => 50,
            ),
            66 => array (
                'id' => 567,
                'name' => 'Huyện Nhà Bè',
                'province_id' => 50,
            ),
            67 => array (
                'id' => 568,
                'name' => 'Huyện Cần Giờ',
                'province_id' => 50,
            ),
            68 => array (
                'id' => 569,
                'name' => 'Thành phố Tân An',
                'province_id' => 51,
            ),
            69 => array (
                'id' => 570,
                'name' => 'Thị xã Kiến Tường',
                'province_id' => 51,
            ),
            70 => array (
                'id' => 571,
                'name' => 'Huyện Tân Hưng',
                'province_id' => 51,
            ),
            71 => array (
                'id' => 572,
                'name' => 'Huyện Vĩnh Hưng',
                'province_id' => 51,
            ),
            72 => array (
                'id' => 573,
                'name' => 'Huyện Mộc Hóa',
                'province_id' => 51,
            ),
            73 => array (
                'id' => 574,
                'name' => 'Huyện Tân Thạnh',
                'province_id' => 51,
            ),
            74 => array (
                'id' => 575,
                'name' => 'Huyện Thạnh Hóa',
                'province_id' => 51,
            ),
            75 => array (
                'id' => 576,
                'name' => 'Huyện Đức Huệ',
                'province_id' => 51,
            ),
            76 => array (
                'id' => 577,
                'name' => 'Huyện Đức Hòa',
                'province_id' => 51,
            ),
            77 => array (
                'id' => 578,
                'name' => 'Huyện Bến Lức',
                'province_id' => 51,
            ),
            78 => array (
                'id' => 579,
                'name' => 'Huyện Thủ Thừa',
                'province_id' => 51,
            ),
            79 => array (
                'id' => 580,
                'name' => 'Huyện Tân Trụ',
                'province_id' => 51,
            ),
            80 => array (
                'id' => 581,
                'name' => 'Huyện Cần Đước',
                'province_id' => 51,
            ),
            81 => array (
                'id' => 582,
                'name' => 'Huyện Cần Giuộc',
                'province_id' => 51,
            ),
            82 => array (
                'id' => 583,
                'name' => 'Huyện Châu Thành',
                'province_id' => 51,
            ),
            83 => array (
                'id' => 584,
                'name' => 'Thành phố Mỹ Tho',
                'province_id' => 52,
            ),
            84 => array (
                'id' => 585,
                'name' => 'Thị xã Gò Công',
                'province_id' => 52,
            ),
            85 => array (
                'id' => 586,
                'name' => 'Thị xã Cai Lậy',
                'province_id' => 52,
            ),
            86 => array (
                'id' => 587,
                'name' => 'Huyện Tân Phước',
                'province_id' => 52,
            ),
            87 => array (
                'id' => 588,
                'name' => 'Huyện Cái Bè',
                'province_id' => 52,
            ),
            88 => array (
                'id' => 589,
                'name' => 'Huyện Cai Lậy',
                'province_id' => 52,
            ),
            89 => array (
                'id' => 590,
                'name' => 'Huyện Châu Thành',
                'province_id' => 52,
            ),
            90 => array (
                'id' => 591,
                'name' => 'Huyện Chợ Gạo',
                'province_id' => 52,
            ),
            91 => array (
                'id' => 592,
                'name' => 'Huyện Gò Công Tây',
                'province_id' => 52,
            ),
            92 => array (
                'id' => 593,
                'name' => 'Huyện Gò Công Đông',
                'province_id' => 52,
            ),
            93 => array (
                'id' => 594,
                'name' => 'Huyện Tân Phú Đông',
                'province_id' => 52,
            ),
            94 => array (
                'id' => 595,
                'name' => 'Thành phố Bến Tre',
                'province_id' => 53,
            ),
            95 => array (
                'id' => 596,
                'name' => 'Huyện Châu Thành',
                'province_id' => 53,
            ),
            96 => array (
                'id' => 597,
                'name' => 'Huyện Chợ Lách',
                'province_id' => 53,
            ),
            97 => array (
                'id' => 598,
                'name' => 'Huyện Mỏ Cày Nam',
                'province_id' => 53,
            ),
            98 => array (
                'id' => 599,
                'name' => 'Huyện Giồng Trôm',
                'province_id' => 53,
            ),
            99 => array (
                'id' => 600,
                'name' => 'Huyện Bình Đại',
                'province_id' => 53,
            ),
            100 => array (
                'id' => 601,
                'name' => 'Huyện Ba Tri',
                'province_id' => 53,
            ),
            101 => array (
                'id' => 602,
                'name' => 'Huyện Thạnh Phú',
                'province_id' => 53,
            ),
            102 => array (
                'id' => 603,
                'name' => 'Huyện Mỏ Cày Bắc',
                'province_id' => 53,
            ),
            103 => array (
                'id' => 604,
                'name' => 'Thành phố Trà Vinh',
                'province_id' => 54,
            ),
            104 => array (
                'id' => 605,
                'name' => 'Huyện Càng Long',
                'province_id' => 54,
            ),
            105 => array (
                'id' => 606,
                'name' => 'Huyện Cầu Kè',
                'province_id' => 54,
            ),
            106 => array (
                'id' => 607,
                'name' => 'Huyện Tiểu Cần',
                'province_id' => 54,
            ),
            107 => array (
                'id' => 608,
                'name' => 'Huyện Châu Thành',
                'province_id' => 54,
            ),
            108 => array (
                'id' => 609,
                'name' => 'Huyện Cầu Ngang',
                'province_id' => 54,
            ),
            109 => array (
                'id' => 610,
                'name' => 'Huyện Trà Cú',
                'province_id' => 54,
            ),
            110 => array (
                'id' => 611,
                'name' => 'Huyện Duyên Hải',
                'province_id' => 54,
            ),
            111 => array (
                'id' => 612,
                'name' => 'Thị xã Duyên Hải',
                'province_id' => 54,
            ),
            112 => array (
                'id' => 613,
                'name' => 'Thành phố Vĩnh Long',
                'province_id' => 55,
            ),
            113 => array (
                'id' => 614,
                'name' => 'Huyện Long Hồ',
                'province_id' => 55,
            ),
            114 => array (
                'id' => 615,
                'name' => 'Huyện Mang Thít',
                'province_id' => 55,
            ),
            115 => array (
                'id' => 616,
                'name' => 'Huyện  Vũng Liêm',
                'province_id' => 55,
            ),
            116 => array (
                'id' => 617,
                'name' => 'Huyện Tam Bình',
                'province_id' => 55,
            ),
            117 => array (
                'id' => 618,
                'name' => 'Thị xã Bình Minh',
                'province_id' => 55,
            ),
            118 => array (
                'id' => 619,
                'name' => 'Huyện Trà Ôn',
                'province_id' => 55,
            ),
            119 => array (
                'id' => 620,
                'name' => 'Huyện Bình Tân',
                'province_id' => 55,
            ),
            120 => array (
                'id' => 621,
                'name' => 'Thành phố Cao Lãnh',
                'province_id' => 56,
            ),
            121 => array (
                'id' => 622,
                'name' => 'Thành phố Sa Đéc',
                'province_id' => 56,
            ),
            122 => array (
                'id' => 623,
                'name' => 'Thị xã Hồng Ngự',
                'province_id' => 56,
            ),
            123 => array (
                'id' => 624,
                'name' => 'Huyện Tân Hồng',
                'province_id' => 56,
            ),
            124 => array (
                'id' => 625,
                'name' => 'Huyện Hồng Ngự',
                'province_id' => 56,
            ),
            125 => array (
                'id' => 626,
                'name' => 'Huyện Tam Nông',
                'province_id' => 56,
            ),
            126 => array (
                'id' => 627,
                'name' => 'Huyện Tháp Mười',
                'province_id' => 56,
            ),
            127 => array (
                'id' => 628,
                'name' => 'Huyện Cao Lãnh',
                'province_id' => 56,
            ),
            128 => array (
                'id' => 629,
                'name' => 'Huyện Thanh Bình',
                'province_id' => 56,
            ),
            129 => array (
                'id' => 630,
                'name' => 'Huyện Lấp Vò',
                'province_id' => 56,
            ),
            130 => array (
                'id' => 631,
                'name' => 'Huyện Lai Vung',
                'province_id' => 56,
            ),
            131 => array (
                'id' => 632,
                'name' => 'Huyện Châu Thành',
                'province_id' => 56,
            ),
            132 => array (
                'id' => 633,
                'name' => 'Thành phố Long Xuyên',
                'province_id' => 57,
            ),
            133 => array (
                'id' => 634,
                'name' => 'Thành phố Châu Đốc',
                'province_id' => 57,
            ),
            134 => array (
                'id' => 635,
                'name' => 'Huyện An Phú',
                'province_id' => 57,
            ),
            135 => array (
                'id' => 636,
                'name' => 'Thị xã Tân Châu',
                'province_id' => 57,
            ),
            136 => array (
                'id' => 637,
                'name' => 'Huyện Phú Tân',
                'province_id' => 57,
            ),
            137 => array (
                'id' => 638,
                'name' => 'Huyện Châu Phú',
                'province_id' => 57,
            ),
            138 => array (
                'id' => 639,
                'name' => 'Huyện Tịnh Biên',
                'province_id' => 57,
            ),
            139 => array (
                'id' => 640,
                'name' => 'Huyện Tri Tôn',
                'province_id' => 57,
            ),
            140 => array (
                'id' => 641,
                'name' => 'Huyện Châu Thành',
                'province_id' => 57,
            ),
            141 => array (
                'id' => 642,
                'name' => 'Huyện Chợ Mới',
                'province_id' => 57,
            ),
            142 => array (
                'id' => 643,
                'name' => 'Huyện Thoại Sơn',
                'province_id' => 57,
            ),
            143 => array (
                'id' => 644,
                'name' => 'Thành phố Rạch Giá',
                'province_id' => 58,
            ),
            144 => array (
                'id' => 645,
                'name' => 'Thành phố Hà Tiên',
                'province_id' => 58,
            ),
            145 => array (
                'id' => 646,
                'name' => 'Huyện Kiên Lương',
                'province_id' => 58,
            ),
            146 => array (
                'id' => 647,
                'name' => 'Huyện Hòn Đất',
                'province_id' => 58,
            ),
            147 => array (
                'id' => 648,
                'name' => 'Huyện Tân Hiệp',
                'province_id' => 58,
            ),
            148 => array (
                'id' => 649,
                'name' => 'Huyện Châu Thành',
                'province_id' => 58,
            ),
            149 => array (
                'id' => 650,
                'name' => 'Huyện Giồng Riềng',
                'province_id' => 58,
            ),
            150 => array (
                'id' => 651,
                'name' => 'Huyện Gò Quao',
                'province_id' => 58,
            ),
            151 => array (
                'id' => 652,
                'name' => 'Huyện An Biên',
                'province_id' => 58,
            ),
            152 => array (
                'id' => 653,
                'name' => 'Huyện An Minh',
                'province_id' => 58,
            ),
            153 => array (
                'id' => 654,
                'name' => 'Huyện Vĩnh Thuận',
                'province_id' => 58,
            ),
            154 => array (
                'id' => 655,
                'name' => 'Huyện Phú Quốc',
                'province_id' => 58,
            ),
            155 => array (
                'id' => 656,
                'name' => 'Huyện Kiên Hải',
                'province_id' => 58,
            ),
            156 => array (
                'id' => 657,
                'name' => 'Huyện U Minh Thượng',
                'province_id' => 58,
            ),
            157 => array (
                'id' => 658,
                'name' => 'Huyện Giang Thành',
                'province_id' => 58,
            ),
            158 => array (
                'id' => 659,
                'name' => 'Quận Ninh Kiều',
                'province_id' => 59,
            ),
            159 => array (
                'id' => 660,
                'name' => 'Quận Ô Môn',
                'province_id' => 59,
            ),
            160 => array (
                'id' => 661,
                'name' => 'Quận Bình Thuỷ',
                'province_id' => 59,
            ),
            161 => array (
                'id' => 662,
                'name' => 'Quận Cái Răng',
                'province_id' => 59,
            ),
            162 => array (
                'id' => 663,
                'name' => 'Quận Thốt Nốt',
                'province_id' => 59,
            ),
            163 => array (
                'id' => 664,
                'name' => 'Huyện Vĩnh Thạnh',
                'province_id' => 59,
            ),
            164 => array (
                'id' => 665,
                'name' => 'Huyện Cờ Đỏ',
                'province_id' => 59,
            ),
            165 => array (
                'id' => 666,
                'name' => 'Huyện Phong Điền',
                'province_id' => 59,
            ),
            166 => array (
                'id' => 667,
                'name' => 'Huyện Thới Lai',
                'province_id' => 59,
            ),
            167 => array (
                'id' => 668,
                'name' => 'Thành phố Vị Thanh',
                'province_id' => 60,
            ),
            168 => array (
                'id' => 669,
                'name' => 'Thành phố Ngã Bảy',
                'province_id' => 60,
            ),
            169 => array (
                'id' => 670,
                'name' => 'Huyện Châu Thành A',
                'province_id' => 60,
            ),
            170 => array (
                'id' => 671,
                'name' => 'Huyện Châu Thành',
                'province_id' => 60,
            ),
            171 => array (
                'id' => 672,
                'name' => 'Huyện Phụng Hiệp',
                'province_id' => 60,
            ),
            172 => array (
                'id' => 673,
                'name' => 'Huyện Vị Thuỷ',
                'province_id' => 60,
            ),
            173 => array (
                'id' => 674,
                'name' => 'Huyện Long Mỹ',
                'province_id' => 60,
            ),
            174 => array (
                'id' => 675,
                'name' => 'Thị xã Long Mỹ',
                'province_id' => 60,
            ),
            175 => array (
                'id' => 676,
                'name' => 'Thành phố Sóc Trăng',
                'province_id' => 61,
            ),
            176 => array (
                'id' => 677,
                'name' => 'Huyện Châu Thành',
                'province_id' => 61,
            ),
            177 => array (
                'id' => 678,
                'name' => 'Huyện Kế Sách',
                'province_id' => 61,
            ),
            178 => array (
                'id' => 679,
                'name' => 'Huyện Mỹ Tú',
                'province_id' => 61,
            ),
            179 => array (
                'id' => 680,
                'name' => 'Huyện Cù Lao Dung',
                'province_id' => 61,
            ),
            180 => array (
                'id' => 681,
                'name' => 'Huyện Long Phú',
                'province_id' => 61,
            ),
            181 => array (
                'id' => 682,
                'name' => 'Huyện Mỹ Xuyên',
                'province_id' => 61,
            ),
            182 => array (
                'id' => 683,
                'name' => 'Thị xã Ngã Năm',
                'province_id' => 61,
            ),
            183 => array (
                'id' => 684,
                'name' => 'Huyện Thạnh Trị',
                'province_id' => 61,
            ),
            184 => array (
                'id' => 685,
                'name' => 'Thị xã Vĩnh Châu',
                'province_id' => 61,
            ),
            185 => array (
                'id' => 686,
                'name' => 'Huyện Trần Đề',
                'province_id' => 61,
            ),
            186 => array (
                'id' => 687,
                'name' => 'Thành phố Bạc Liêu',
                'province_id' => 62,
            ),
            187 => array (
                'id' => 688,
                'name' => 'Huyện Hồng Dân',
                'province_id' => 62,
            ),
            188 => array (
                'id' => 689,
                'name' => 'Huyện Phước Long',
                'province_id' => 62,
            ),
            189 => array (
                'id' => 690,
                'name' => 'Huyện Vĩnh Lợi',
                'province_id' => 62,
            ),
            190 => array (
                'id' => 691,
                'name' => 'Thị xã Giá Rai',
                'province_id' => 62,
            ),
            191 => array (
                'id' => 692,
                'name' => 'Huyện Đông Hải',
                'province_id' => 62,
            ),
            192 => array (
                'id' => 693,
                'name' => 'Huyện Hoà Bình',
                'province_id' => 62,
            ),
            193 => array (
                'id' => 694,
                'name' => 'Thành phố Cà Mau',
                'province_id' => 63,
            ),
            194 => array (
                'id' => 695,
                'name' => 'Huyện U Minh',
                'province_id' => 63,
            ),
            195 => array (
                'id' => 696,
                'name' => 'Huyện Thới Bình',
                'province_id' => 63,
            ),
            196 => array (
                'id' => 697,
                'name' => 'Huyện Trần Văn Thời',
                'province_id' => 63,
            ),
            197 => array (
                'id' => 698,
                'name' => 'Huyện Cái Nước',
                'province_id' => 63,
            ),
            198 => array (
                'id' => 699,
                'name' => 'Huyện Đầm Dơi',
                'province_id' => 63,
            ),
            199 => array (
                'id' => 700,
                'name' => 'Huyện Năm Căn',
                'province_id' => 63,
            ),
            200 => array (
                'id' => 701,
                'name' => 'Huyện Phú Tân',
                'province_id' => 63,
            ),
            201 => array (
                'id' => 702,
                'name' => 'Huyện Ngọc Hiển',
                'province_id' => 63,
            ),
        ));
    }
}
