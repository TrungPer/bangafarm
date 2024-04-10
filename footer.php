
<style>
    #top-up {
    font-size: 2rem;
    cursor: pointer;
    position: fixed;
    z-index: 9999;
    color: rgb(52, 152, 219);
    bottom: 20px;
    right: 15px;
    display: none;
}

#top-up:hover {
    color: #333
}



footer {
    position: relative;
    display: grid;
    grid-template-columns: 400px repeat(3, 1fr);
    gap: 2rem;
    border-bottom: 1px solid #f5f5f5;
}

footer .column .logo {
    max-width: 100px;
    margin-bottom: 2rem;

}

footer .column .socials {
    display: flex;
    align-items: center;
    gap: 1rem;
}

footer .column h4 {
    color: blue;
    margin-bottom: 2rem;
    font-size: 1.2rem;
    font-weight: 500;
}

footer .column>a {
    display: block;
    color: black;
    margin-bottom: 1rem;
    transition: all 0.2s ease;
}
footer .column>a:hover{
    color: aqua;
}
</style>
<footer class="container">
        <div class="column">
            <div class="logo">
                <img width="100px" src="images/logofarm1.png">
            </div>
            <p>
                Trang Đăng tin và Tìm kiếm thông tin về <a href="index1.php" style = "color: blue">mua bán</a> nông sản.
                Chúng tôi kết nối dễ dàng giữa người Mua và người Bán. Đồng thời cung
                cấp những bộ lọc tìm kiếm thông minh, giúp dễ dàng trong việc tìm kiếm
                các thông tin nông sản sản phù hợp với nhu cầu của mỗi người.

            </p>
            <div class="socials">
                <a href="#"><img width="40px" src="images/t.png" ></i></a>
                <a href="#"><img width="40px" src="images/youtube.png" ></a>
                <a href="#"><img width="40px" src="images/facebook.png" ></a>
            </div>
        </div>
        <div class="column">
            <h4>Công ty</h4>
            <a href="#">Kinh doanh</a>
            <a href="https://www.youtube.com/channel/UCcBTwGffVjcz3dlXEaLnToQ">kênh truyền hình</a>
            <a href="https://www.facebook.com/trung.per08">Nhà tài trợ</a>
        </div>

        <div class="column">
            <h4>Về chúng tôi</h4>
            <a href="#">Tính thông dụng</a>
            <a href="https://www.facebook.com/tuitenper">Quan hệ đối tác</a>
            <a href="https://www.facebook.com/trung.per08">Nhà phát triển</a>
        </div>

        <div class="column">
            <h4>Liên hệ</h4>
            <a href="https://myaccount.google.com/?tab=kk">Liên hệ chung tôi</a>
            <a href="https://thuvienphapluat.vn/van-ban/Cong-nghe-thong-tin/Luat-an-ninh-mang-2018-351416.aspx">Chính
                sách quyền riêng tư</a>
            <a
                href="https://icontract.com.vn/tin-tuc/cac-quy-dinh-ve-dieu-khoan-bao-mat-thong-tin-trong-hop-dong#:~:text=%C4%90i%E1%BB%81u%20kho%E1%BA%A3n%20b%E1%BA%A3o%20m%E1%BA%ADt%20(confidentiality,m%E1%BA%ADt%20nh%E1%BB%AFng%20th%C3%B4ng%20tin%20%C4%91%C3%B3.">Điều
                khoản và điều kiện</a>
        </div>

        <p style="color: black;">
            Hotline: 1900 3333 <br>
            Mr.Group 8
        </p>
        <script src=" script.js"></script>
    </footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/carouseller.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="libs/fancybox/jquery.fancybox.min.js"></script>
<script>
    $(".quick-buy-form").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: './process_cart.php?action=add',
            data: $(this).serializeArray(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 0) { //Có lỗi
                    alert(response.message);
                } else { //Mua thành công
                    alert(response.message);
                    //                                    location.reload();
                }
            }
        });
    });
</script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

    <script>
    var offset = 400;
    var duration = 750;
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > offset)
                $('#top-up').fadeIn(duration);
            else
                $('#top-up').fadeOut(duration);
        });
        $('#top-up').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, duration);
        });
    });
    </script>
    <div title="Về đầu trang" id="top-up">
        <i class="fas fa-arrow-circle-up"></i>
    </div>
<script type="text/javascript">
    $(function () {
        $('#product-slide').carouseller();
    });
</script>
</body>
</html>
