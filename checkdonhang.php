





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylecheckdonhang.css">
    <title>Kiểm tra thông tin đơn hàng</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <header>Kiểm tra thông tin đơn hàng </header>
            <form action="xulycheck.php" method="post">
                <div class="field input">
                    <input type="text" name="email" id="email" placeholder="Email (bắt buộc)" required> <br>
                    <input type="text" name="madonhang" id="madohang" placeholder="Mã đơn hàng (bắt buộc)" required>
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Kiểm tra" required>
                </div>
            </form>
        </div>
    

    </div>
</body>

</html>
