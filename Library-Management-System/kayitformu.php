
<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Üye Kayıt Formu |</title>
        <link rel ="stylesheet"  type="text/css" href="kytformu.css"/>

    </head>    

<body>
        <div class="form">
              <form action="<?php $_PHP_SELF ?>" method="POST">
                    <h2> Üye Bilgileri </h2>
                    Adı:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <input type="text" class="inpt" name="UyeAdi" /> <br/>
                    Soyadı: &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="text" class="inpt" name="UyeSoyad" /> <br/>
                    Telefon Numarası:
                    <input type="text" class="inpt" name="UyeTelefon" /> <br/>
                    E-Posta: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    <input type="text" class="inpt" name="UyeEposta" /> <br/><br />
                    <h2> Üye Adres Bilgileri </h2>
                    Ülke:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <input type="text" class="inpt" name="Ulke" /> <br/>
                    Şehir: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="text" class="inpt" name="Sehir" /> <br/>
                    Posta Kodu: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <input type="text" class="inpt" name="PostaKodu" /> <br/>
                    Cadde: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="text" class="inpt" name="Cadde" /> <br/>
                    Mahalle:&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="text" class="inpt" name="Mahalle" /> <br/><br /><br />

                    <input type="submit" class="button" value="KAYDET" />
                </form>
                <br><a href='_uyesayfasi.php' class="btn"> Geri Dön </a>
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
if (isset($_POST["UyeAdi"],$_POST["UyeSoyad"],$_POST["UyeTelefon"],$_POST["UyeEposta"],
$_POST["Ulke"],$_POST["Sehir"],$_POST["PostaKodu"],$_POST["Cadde"],$_POST["Mahalle"])) {
    
    $UyeAdi=$_POST["UyeAdi"];
    $UyeSoyad=$_POST["UyeSoyad"];
    $UyeTelefon=$_POST["UyeTelefon"];
    $UyeEposta=$_POST["UyeEposta"];
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
    $sql = "INSERT INTO Uyeler".
            "(UyeAdi,UyeSoyad,UyeTelefon,UyeEposta)". 
            "VALUES ('$UyeAdi','$UyeSoyad','$UyeTelefon','$UyeEposta')"; 
    
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
        $sql3 = "SELECT UyeNo FROM Uyeler WHERE UyeAdi='$UyeAdi' AND UyeSoyad='$UyeSoyad' AND UyeTelefon='$UyeTelefon' AND UyeEposta='$UyeEposta'";
        $cevap3 = mysqli_query($baglanti,$sql3);
        $sql4 = "SELECT AdresNo FROM Adresler WHERE Ulke='$Ulke' AND Sehir='$Sehir' AND PostaKodu='$PostaKodu' AND Cadde='$Cadde' AND Mahalle='$Mahalle'";
        $cevap4 = mysqli_query($baglanti,$sql4);
        //veritabanindan gelen degerleri satir satir alma
        $gelen=mysqli_fetch_array($cevap3);
        $No=(int)$gelen['UyeNo'];
        
        $gelen2=mysqli_fetch_array($cevap4);
        $Adres=(int)$gelen2['AdresNo'];

        $sql5 = "INSERT INTO UyeAdres". 
                "(Adresler_AdresNo,Uyeler_UyeNo)". 
                "VALUES ($Adres,$No)";

        $cevap5 = mysqli_query($baglanti,$sql5);
        echo "<h1> Üye Bilgileri Veritabanına Eklendi.</h1>";
    }
    
    echo "</html>";
    
    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>