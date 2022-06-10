<html>
    <head>
    <!-- türkçe karakter destegi ayari -->
    <meta http-equiv="Content-Type"content="text/html; charset=UTF-8" />
    <title> | Yazar Ekleme | </title> 
    <link rel="stylesheet" type="text/css" href="yazar.css"/>

    </head>
<body>
<div class="form">
<form action="<?php $_PHP_SELF ?>" method="POST">
        <h1> Yazar Bilgileri </h1>
        Adı: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="YazarlarAdi" /> <br/>
        Soyadı:&nbsp;
        <input type="text" name="YazarlarSoyad" /> <br/>
        <br><br>
<input type="submit" class="button" value="KAYDET" />
</form>
<br><a href='_uyesayfasi.php'class="btn" > Geri Dön</a> <br>
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
//mysql baglanti kodunu ekleme
include("mysqlbaglan.php");

//degiskenleri formdan aliyoruz
if (isset($_POST["YazarlarAdi"],$_POST["YazarlarSoyad"])) {
    
    $YazarlarAdi=$_POST["YazarlarAdi"];
    $YazarlarSoyad=$_POST["YazarlarSoyad"];

    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
    //Yazar ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO Yazarlar".
            "(YazarlarAdi,YazarlarSoyad)". 
            "VALUES ('".$YazarlarAdi."','".$YazarlarSoyad."')"; 
      
    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);
 
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }if ($cevap) {
        echo "<h1 class = 'h_1'>Veritabanına eklendi.</h1>";
    }
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>