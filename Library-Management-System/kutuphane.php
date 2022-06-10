
<html>
<head>
<!-- türkçe karakter destegi ayari -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel ="stylesheet"  type="text/css" href="kutuphane.css"/>
    <title> | Kütüphane Ekleme | </title>
</head>

<body>
<div class="form">
<form action="<?php $_PHP_SELF ?>" method="POST">
        <h1> Kütüphane Bilgileri </h1>
        Adı: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
        <input type="text" class="inpt" name="KutuphaneAdi" /> <br/>
        <br><br>
        <h1> Kütüphane Adres Bilgileri </h1>
        Ulke: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" class="inpt" name="Ulke" /> <br/>
        Şehir: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
        <input type="text" class="inpt" name="Sehir" /> <br/>
        Posta Kodu: &nbsp;
        <input type="text" class="inpt" name="PostaKodu" /> <br/>
        Cadde: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
        <input type="text" class="inpt" name="Cadde" /> <br/>
        Mahalle: &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
        <input type="text" class="inpt" name="Mahalle" /> <br/> <br>

       <input type="submit" class="button" value="KAYDET" />
    </form>
     <br><a href='_uyesayfasi.php' class="btn"> Geri Dön</a>
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
if (isset($_POST["KutuphaneAdi"],$_POST["Ulke"],$_POST["Sehir"],$_POST["PostaKodu"],$_POST["Cadde"],$_POST["Mahalle"])) {
    
    $KutuphaneAdi=$_POST["KutuphaneAdi"];
    $Ulke=$_POST["Ulke"];
    $Sehir=$_POST["Sehir"];
    $PostaKodu=$_POST["PostaKodu"];
    $Cadde=$_POST["Cadde"];
    $Mahalle=$_POST["Mahalle"];

    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
    //Uye ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO Kutuphane".
            "(KutuphaneAdi)". 
            "VALUES ('$KutuphaneAdi')"; 
    
    //Adres ekleme sorgusunu hazirliyoruz      
    $sql2= "INSERT INTO Adresler". 
            "(Ulke,Sehir,PostaKodu,Cadde,Mahalle)". 
            "VALUES ('".$Ulke."','".$Sehir."','".$PostaKodu."','".$Cadde."','".$Mahalle."')";
    
    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);
    $cevap2= mysqli_query($baglanti,$sql2);
    
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap) && (!$cevap2)) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }if ($cevap && $cevap2) {
        $sql3 = "SELECT KutuphaneNo FROM Kutuphane WHERE KutuphaneAdi='$KutuphaneAdi'";
        $cevap3 = mysqli_query($baglanti,$sql3);
        $sql4 = "SELECT AdresNo FROM Adresler WHERE Ulke='$Ulke' AND Sehir='$Sehir' AND PostaKodu='$PostaKodu' AND Cadde='$Cadde' AND Mahalle='$Mahalle'";
        $cevap4 = mysqli_query($baglanti,$sql4);
        //veritabanindan gelen degerleri satir satir alma
        $gelen=mysqli_fetch_array($cevap3);
        $No=(int)$gelen['KutuphaneNo'];
        
        $gelen2=mysqli_fetch_array($cevap4);
        $Adres=(int)$gelen2['AdresNo'];

        $sql5 = "INSERT INTO KutuphaneAdres". 
                "(Adresler_AdresNo,Kutuphane_KutuphaneNo)". 
                "VALUES ($Adres,$No)";

        $cevap5 = mysqli_query($baglanti,$sql5);
        echo "<h2 class ='h2' >Veritabanına eklendi.</h2>";
    }
    
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>