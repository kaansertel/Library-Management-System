<html>
    <head>
        <link rel="stylesheet" type="text/css" href="register.css"/>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Admin Ekleme | </title>
    </head>

    <body>
        <?php
            //oturumu baslat
            session_start();
            //eger username adli oturum degiskeni yoksa login sayfasina yönlendir
            if (!isset($_SESSION['username'])) {
                header("location:_login.php");
                exit();
            }
            require ('_mysqlbaglan.php');

            //Kullanici adi ve sifresinin bos veya dolu oldugunu kontrol etme
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
            extract($_POST);

            $password=$_POST['password'];
            $password=hash('sha256', $password);
            
            $sql = "INSERT INTO kullanicilar".
            "(kullaniciadi,sifre)". 
            "VALUES ('$username','$password')";

            $cevap = mysqli_query($baglanti,$sql);

            if ($cevap) {
                echo "<h1> Kullanıcı Oluşturuldu. </h1>";
            }else {
                echo  "<h1>Kullanıcı Oluşturulamadı! </h1>";
            } 
            } else {
                echo "<h1> Kullanıcı Oluşturulamadı!</h1>";
            }
            echo "<a class='btn' href='_register.php'>Geri Dön</a>";
        ?>


    </body>
</html>



