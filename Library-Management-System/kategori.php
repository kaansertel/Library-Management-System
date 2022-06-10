
<html>
    <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
            <title>| Kategori Oluşturma|</title>
            <link rel="stylesheet" type="text/css" href="kategori.css"/>
    </head>     

    <body>
        <div class="form">
            <h2>Kategori Ekleme</h2>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                Kategori Adı:    
                <input type="text" name="KategoriAdi" > <br /><br />
                <input class ="button" type="submit" value="KAYDET"/> <br /> <br />
                <a class ="btn" href="_uyesayfasi.php" > Geri Dön </a> 
                    <!-- <a href="_login.php">[Kullanici Girişi] </a> -->

            </form>
        </div>    

    </body>
</html>

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
            if (!empty($_POST['KategoriAdi'])) {
                $KategoriAdi=$_POST["KategoriAdi"];

            $sql = "INSERT INTO Kategoriler".
            "(KategoriAdi)". 
            "VALUES ('$KategoriAdi')";

            $cevap = mysqli_query($baglanti,$sql);

            if ($cevap) {
                echo "<h1> Kategori Oluşturuldu. </h1>";
            }else {
                echo  "<h1>Kategori Oluşturulamadı! </h1>";
            } 
            }
        ?>
