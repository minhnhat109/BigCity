<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở table đó
        DB::table('blogs')->delete();

        // Reset id về lại 1
        DB::table('blogs')->truncate();

        // 2. Ta sẽ thêm mới phim bằng lệnh create
        DB::table('blogs')->insert([
            [
                'title'          => "CÙNG BIGCITI HỌC CÁCH “KÍCH HOẠT” NĂNG LƯỢNG HẠNH PHÚC CHO BẢN THÂN!",
                'short_description'       => "Nếu yêu thích series CÙNG BIGCITI HỌC CÁCH “KÍCH HOẠT” NĂNG LƯỢNG HẠNH PHÚC CHO BẢN THÂN!, các bạn không nên bỏ lỡ bài viết dưới đây đâu nhé, chắc chắn sẽ mang đến những điều hay ho chưa ai kể bạn nghe đâu!",
                'content'         => "
                1. Động lực

                Cảm giác hài lòng khi bạn đạt được một mục tiêu nào đó!

                Bằng cách:

                Thử hoàn thành 1 task nhỏ
                Giúp đỡ mọi người
                Ăn mừng thành tích của bản thân,…
                2. Tình yêu

                Cảm giác yêu và được yêu thương

                Bằng cách:

                Cưng nựng các bé cún, mèo
                Trò chuyện cùng bạn thân, gia đình, đồng nghiệp;..
                3. Chữa lành

                Cảm giác giúp bạn xoa dịu những cơn đau, chữa lành tổn thương.

                Bằng cách:

                Tập thể dục 30 phút mỗi ngày
                Cười nhiều hơn
                Xem các bộ phim hài hước,..
                4.Cân bằng cảm xúc

                Giúp bản thân điều tiết tâm trạng, điều tiết cảm xúc

                Bằng cách:

                Đi bộ thể dục
                Tắm nắng sớm
                Nghe một bản nhạc hoặc đọc cuốn sách bạn yêu thích
                Tập thiền
                Hãy lưu lại bài viết này vì nó cực kỳ hữu ích để bạn duy trì năng lượng sống tích cực mỗi ngày! ",
                'img'         => "https://bizcitivietnam.vn/wp-content/uploads/2023/04/230412_WEBSITE_KICH-HOAT-HANH-PHUC.png",
                'is_open'          => 1,
            ],

            [
                'title'          => "BIGCITI LOTTE CĂN HỘ CAO CẤP NGAY KHU “NHÀ PHỐ” ĐẮT GIÁ NHẤT QUẬN HẢI CHÂU",
                'short_description'       => "BIGCITI LOTTE CĂN HỘ CAO CẤP NGAY KHU “NHÀ PHỐ” ĐẮT GIÁ NHẤT QUẬN HẢI CHÂU.",
                'content'         => "Khu dân cư Nại Nam, một trong những khu dân cư đắt giá hàng đầu thành phố Đà Nẵng (TP. Đà Nẵng). Nằm ở nút giao thông thuận tiện di chuyển đến các địa điểm trung tâm thành phố. Trên khu phố sầm uất hàng đầu thành phố Đà Nẵng với nhiều địa điểm du lịch nổi tiếng thu hút hàng ngàn lượt khách du lịch trên khắp thế giới mỗi tuần: Chợ đêm Helio, Cung văn hóa thể thao Tuyên Sơn, Công viên Châu Á, Siêu thị Lotte,… ",
                'img'         => "https://quocbaobds.com/wp-content/uploads/2020/12/khu-do-thi-la-gi.jpg",
                'is_open'          => 1,
            ],

            [
                'title'          => "GIẢI MÃ SỨC HÚT CỦA BIGCITI CHƯƠNG DƯƠNG",
                'short_description'       => "GIẢI MÃ SỨC HÚT CỦA BIGCITI CHƯƠNG DƯƠNG.",
                'content'         => "Bigciti Chương Dương là Tòa căn hộ nhận tư vấn công năng từ Bizciti. Thiết kế lối đi riêng tận dụng được không gian. Gia tăng thêm giá trị của Bất động sản với hai mặt bằng văn phòng cho thuê và 16 căn hộ cao cấp.
                Đối với căn hộ cho thuê, không gian phòng studio được thiết kế linh hoạt. Khu vực bếp với tủ bếp hiện đại, đa dụng, khu vực làm việc và sinh hoạt tích hợp với không gian phòng ngủ nhưng vô cùng thoải mái. Bố trí không gian hợp lý giữa các tầng tạo thêm không gian lối đi hành lang rộng rãi. Ưu tiên lối đi hành lang với nhiều cửa sổ đáp ứng tiêu chuẩn Phòng cháy chữa cháy.
                Với thiết kế thông minh cùng loạt công năng ưu việt, Tòa Bizciti Chương Dương giúp khách hàng có trải nghiệm sống lý tưởng. Vừa học tập, làm việc và sinh hoạt trong một không gian nhưng vô cùng thoải mái.
                Kinh doanh căn hộ cho thuê được ưu tiên lựa chọn đối với thành phố phát triển như Đà Nẵng. Tuy nhiên, để có thể vận hành có hiệu quả Tòa căn hộ giúp gia tăng giá trị Bất động sản là điều không dễ. Bởi đây cũng là một thị trường đầy tính cạnh tranh, Chủ đầu tư cần nhận tư vấn từ các chuyên gia để giúp Tòa căn hộ của mình được vận hành một cách có hiệu quả. ",
                'img'         => "https://blog.rever.vn/hubfs/Blog%20images/LinhNTD/VGR.jpg",
                'is_open'          => 1,
            ],

            [
                'title'          => "GIẢI MÃ NỖI LO KHI KINH DOANH TÒA NHÀ CHO THUÊ.",
                'short_description'       => "GIẢI MÃ NỖI LO KHI KINH DOANH TÒA NHÀ CHO THUÊ.",
                'content'         => "Khi kinh doanh tòa nhà cho thuê Chủ đầu tư tòa nhà thường gặp phải nhiều khó khăn, vướng mắc (Kỹ thuật, an ninh, nhân sự phụ trách,.. )  khiến Chủ đầu tư mất rất nhiều thời gian, chi phí để “giải quyết vấn đề”.

                Tuy nhiên, đó chỉ là “phần nổi trong tảng băng chìm”. Bởi lẽ, khi đi vào vận hành tòa nhà sẽ còn rất nhiều vấn đề phức tạp mà Chủ đầu tư phải đối mặt (Nhu cầu thị trường, pháp lý, quản lý vận hành,…). Tất cả những vấn đề ấy cần phải có một đội ngũ “chuyên gia” am hiểu, có kinh nghiệm trong việc khai thác và quản lý vận hành hiệu quả toà nhà.

                Đến với Bizciti, Toà nhà của Chủ đầu tư sẽ được khai thác quản lý vận hành bởi hệ thống dịch vụ chuyên nghiệp, cụ thể:

                Cung cấp dịch vụ gắn liền với nhu cầu của những người sử dụng tòa nhà.

                Mang đến sự an toàn yên tâm cho những chủ căn hộ, người sử dụng tòa nhà, đặc biệt tất cả dịch vụ quản lý và vận hành tòa nhà luôn chú trọng hàng đầu đến hệ thống an ninh, hệ thống phòng cháy chữa cháy,… theo đúng tiêu chuẩn từ an toàn trong quản lý và vận hành tòa nhà.

                Giải quyết, khắc phục nhanh chóng mọi vấn đề của tòa nhà nhà gặp phải như: vấn đề điện nước, vệ sinh, thẩm mỹ,…

                Việc quản lý tòa nhà sẽ giúp giải quyết mọi khiếu nại của khách hàng, người sử dụng tòa nhà nhanh chóng nhất.

                Tăng giá trị tài sản của cả chủ sở hữu đến chủ đầu tư bằng việc không ngừng nâng cao các dịch vụ của tòa nhà bằng việc áp dụng máy móc, thiết bị tiên tiến.

                -…

                Với kinh nghiệm quản lý hơn 70 tòa nhà quy mô lớn nhỏ khác nhau (Căn hộ, mặt bằng kinh doanh, văn phòng, khách sạn, villa…) Chủ đầu tư có thể hoàn toàn yên tâm khi sử dụng dịch vụ quản lý vận hành toà nhà của Bizciti. Bizciti cam kết sẽ thay Chủ đầu tư hoàn thành mọi vấn đề của toà nhà một cách hoàn hảo nhất! ",
                'img'         => "https://images2.thanhnien.vn/Uploaded/quochung-qc/2022_03_23/tra-vinh-1-3934.jpg",
                'is_open'          => 1,
            ],

            [
                'title'          => "CĂN HỘ STUDIO LÀ GÌ? LÝ DO BẠN NÊN THUÊ CĂN HỘ STUDIO!",
                'short_description'       => "CĂN HỘ STUDIO LÀ GÌ? LÝ DO BẠN NÊN THUÊ CĂN HỘ STUDIO!.",
                'content'         => "1. Căn hộ studio là mô hình căn hộ cho thuê hiện đại với không gian sống tối ưu, tích hợp giữa phòng khách, phòng ngủ và nhà bếp trong cùng một không gian.
                2. Lý do bạn nên thuê căn hộ studio!

                Căn hộ studio được yêu thích bởi sự tiết kiệm và tối giản trong không gian nhưng lại mang đến trải nghiệm sống vô cùng lý tưởng.

                Đa số căn hộ studio đều được lắp đặt nội thất đầy đủ, tiện nghi, giúp bạn gói gọn hành lý chỉ bằng 1 chiếc vali!.

                Các căn hộ studio luôn có mức giá thuê vô cùng hợp lý. Phù hợp với sinh viên và nhân viên văn phòng.
                Bizciti – Hệ thống khai thác, quản lý và vận hành cho thuê căn hộ dịch vụ hàng đầu Việt Nam

Bizciti – Đơn vị chuyên khai thác khép kín các tòa nhà cho thuê căn hộ dịch vụ, quản lý vận hành và cam kết tỷ lệ lấp đầy với Chủ đầu tư.

Dần khẳng định được sự tin tưởng về vị thế của doanh nghiệp trên thị trường khi hiện nay, Bizciti đang cùng với các Chủ đầu tư khai thác quản lý, vận hành cho thuê căn hộ và cam kết tỷ lệ lấp đầy gần 70 căn hộ ở thị trường Đà Nẵng.

",
                'img'         => "https://thietkenoithatatz.com/wp-content/uploads/2020/11/thiet-ke-can-ho-studio-8.jpg",
                'is_open'          => 1,
            ],

            [
                'title'          => "TOP CĂN HỘ CHO THUÊ ƯU ĐÃI GIÁ TỐT NHẤT XUÂN QUÝ MÃO 2023",
                'short_description'       => "TOP CĂN HỘ CHO THUÊ ƯU ĐÃI GIÁ TỐT NHẤT XUÂN QUÝ MÃO 2023.",
                'content'         => "1. Căn hộ cao cấp Bizciti Lê Thạch:

                Tòa Bizciti Lê Thạch (Địa chỉ: 205 Lê Thạch, P. Hòa An, Q. Cẩm Lệ, TP. Đà Nẵng)  Tòa căn hộ cho thuê xây mới hoàn toàn, thiết kế hiện đại, linh hoạt. Đảm bảo mang đến không gian sống hoàn hảo nhất cho khách hàng.
                Cùng Bizciti điểm qua một số ưu điểm nổi bật giúp Bizciti Lê Thạch trở thành Tòa căn hộ cho thuê cao cấp hàng đầu Chuỗi căn hộ dịch vụ Bizciti nhé!
                *Tiện ích chung:
                 Lối đi riêng thoải mái, giờ giấc tự quản lý, không chung chủ.
                 Nhà để xe rộng rãi, an ninh bởi hệ thống camera giám sát liên tục.
                 Khóa cửa chính vân tay hiện đại, bảo mật cao.
                 Thang máy cao cấp, tối ưu.
                 Tuyến đường giao thông thuận lợi di chuyển đến các khu vực nội thành TP. Đà Nẵng.
                 Chỉ mất 2 phút đi đến Bến xe Trung tâm TP. Đà Nẵng.
                 Khu vực sầm uất, đông dân cư.
                *Tiện ích căn hộ:
                 Căn hộ rộng rãi, thiết kế tối ưu, nhiều sự lựa chọn với mức giá hợp lý.
                 Phòng mới xây, nội thất thay mới hoàn toàn.
                 Tất cả các phòng đều có ban công, cửa sổ view thoáng đãng.
                 Căn hộ trang bị đầy đủ thiết bị: Máy lạnh, máy giặt, vòi tắm nóng lạnh,… là những thiết bị lắp đặt mới, hiện đại, chất lượng cao.
                2. Căn hộ Bizciti Vũ Đình Long:
                Tòa Bizciti Vũ Đình Long  Địa chỉ: Số 34 Vũ Đình Long, P. Thọ Quang, Q. Sơn Trà, TP. Đà Nẵng.
                *Tiện ích chung:
                 Cách Vinmart: 250m.
                 Cách cầu Thuận Phước: 10 phút đi xe.
                 Cách biển: 3 phút đi xe.
                 Cách trường Mẫu Giáo: 200m.
                 Cách trường tiểu học, THCS, THPT: 3 phút đi xe.
                *Tiện ích căn hộ:
                 Đầy đủ nội thất, chỉ cần đến ở mà không phải mua bất cứ thứ gì.

                 Không gian thoáng mát, cực sang trọng tạo cho bạn cảm giác thoải mái, thư giãn.

                 Có thang máy hỗ trợ thuận lợi việc di chuyển trong tòa nhà.
                 Khoá thông minh đảm bảo an ninh tuyệt đối cho bạn yên tâm ra ngoài.
                 Căn hộ ở ngay tại trung tâm, thuận tiện cho việc đi lại.
                3. Căn hộ Bizciti Phan Châu Trinh:
                Tòa Bizciti Phan Châu Trinh  Địa chỉ: Số 351 Phan Châu Trinh, P. Bình Hiên , Q. Hải Châu, TP. Đà Nẵng.
                *Tiện ích chung:
                Tòa căn hộ cao cấp, hiện đại hai mặt tiền tuyến đường trung tâm TP. Đà Nẵng.
                 Nhà để xe rộng rãi, thoải mái.
                 Gần chợ, trường học, siêu thị, cửa hàng tiện lợi.
                 Khu vực sầm uất.
                *Tiện ích căn hộ:
                 Không gian sống thoải mái, tiện nghi.
                 Lắp đặt nội thất cao cấp, đầy đủ.
                 Không gian sinh hoạt hiện đại.
                 Hệ thống trang thiết bị tối ưu.",
                'img'         => "https://www.batdongsanhungphat.vn/wp-content/uploads/2021/10/top-cac-khu-do-thi-moi-dang-song.jpg",
                'is_open'          => 1,
            ],

        ]);

    }
}
