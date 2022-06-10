<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Kitap Ekle |</title>
        <link rel ="stylesheet"  type="text/css" href="kutuphanekitap.css"/>

    </head>    

<body>
        <div class="form">
              <form action="<?php $_PHP_SELF ?>" method="POST">
                    <h2> Kütüphaneye Eklenecek Kitaplar </h2>
                    Kütüphane: &nbsp; &nbsp; &nbsp; &nbsp;
                <?php
                //mysql baglanti kodunu ekleme
                include("mysqlbaglan.php");

                //sorguyu yaziyoruz
                $sql = "SELECT * FROM Kutuphane";
                
                //sorguyu veritabanina gonderme
                $cevap = mysqli_query($baglanti,$sql);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }

                echo "<select name='KutuphaneNo'>";
                while($gelen=mysqli_fetch_array($cevap)){
                echo "<option ";
                echo "value=";
                echo $gelen['KutuphaneNo'];
                echo ">";
                echo $gelen['KutuphaneAdi'];
                echo "</option>";
                }
                echo "</select>";
                echo "<br /> <br />";

                echo "Kitap: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";

                //sorguyu yaziyoruz
                $sql2 = "SELECT * FROM Kitaplar";
                
                //sorguyu veritabanina gonderme
                $cevap2 = mysqli_query($baglanti,$sql2);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap2) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }

                echo "<select name='ISBN'>";
                while($gelen2=mysqli_fetch_array($cevap2)){
                echo "<option ";
                echo "value=";
                echo $gelen2['ISBN'];
                echo ">";
                echo $gelen2['ISBN'];
                echo "-";
                echo $gelen2['KitapAdi'];
                echo "</option>";
                }
                echo "</select>";
                echo "<br> <br />";

                //veritabani baglantisini kapama
                mysqli_close($baglanti);
                
                ?>
                Miktar: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<input type="text" name="Miktar" /> <br/>
                <br>
                <input type="submit" class="button" value="KAYDET" />
                <a href='_uyesayfasi.php' class="btn"> Geri Dön </a>
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
//mysql baglanti kodunu ekleme
include("mysqlbaglan.php");

//degiskenleri formdan aliyoruz
if (isset($_POST["ISBN"],$_POST["KutuphaneNo"],$_POST["Miktar"])) {
    
    $ISBN=$_POST["ISBN"];
    $KutuphaneNo=$_POST["KutuphaneNo"];
    $Miktar=$_POST["Miktar"];


    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
        
    //Kitap ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO KutuphaneKitap".
            "(Kitaplar_ISBN,Kutuphane_KutuphaneNo,Miktar)". 
            "VALUES ('$ISBN','$KutuphaneNo','$Miktar')"; 

    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);

    
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }if ($cevap) {
        echo "<h1 class='h1'> Kitaplar Kütüphane Veritabanına Eklendi.</h1>";
    }
    
    echo "</html>";

    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>