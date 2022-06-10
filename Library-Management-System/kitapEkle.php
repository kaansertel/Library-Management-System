<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Kitap Ekleme |</title>
        <link rel ="stylesheet"  type="text/css" href="kitap.css"/>

    </head>    

<body>
    <div class="form ">
              <form action="<?php $_PHP_SELF ?>" method="POST">
                    <h2> Kitap Bilgileri </h2>
                    ISBN: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="text" name="ISBN" /> <br/><br />
                    Kitap Adı: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="KitapAdi" /> <br/><br /> 
                    Yayın Tarihi:&nbsp; &nbsp; &nbsp; <input type="date" name="KitapYayinTarihi" /> <br/><br/>
                    Kategori: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                <?php
                //mysql baglanti kodunu ekleme
                include("mysqlbaglan.php");

                //sorguyu yaziyoruz
                $sql = "SELECT * FROM Kategoriler";
                
                //sorguyu veritabanina gonderme
                $cevap = mysqli_query($baglanti,$sql);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }

                echo "<select name='KategoriNo'>";
                while($gelen=mysqli_fetch_array($cevap)){
                echo "<option ";
                echo "value=";
                echo $gelen['KategoriNo'];
                echo ">";
                echo $gelen['KategoriAdi']; 
                echo "</option>";
                }
                echo "</select>";
                echo "<br /> <br /> ";

                echo "Yazarı: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";

                //sorguyu yaziyoruz
                $sql3 = "SELECT * FROM Yazarlar";
                
                //sorguyu veritabanina gonderme
                $cevap3 = mysqli_query($baglanti,$sql3);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap3) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }
                echo "<select name='YazarNo'>";
                while($gelen3=mysqli_fetch_array($cevap3)){
                echo "<option ";
                echo "value=";
                echo $gelen3['YazarNo'];
                echo ">";
                echo $gelen3['YazarlarAdi'];
                echo " ";
                echo $gelen3['YazarlarSoyad'];
                echo "</option>";
                }
                echo "</select>";
                echo "<br>";

                //veritabani baglantisini kapama
                mysqli_close($baglanti);
                
                ?>
                <br> <br /> 
                <input type="submit" class="button" value="KAYDET" />
                <a href='kitap.php' class="btn"> Geri Dön </a>
                </form>

        </div>    

        

    </body>
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
if (isset($_POST["ISBN"],$_POST["KitapAdi"],$_POST["KitapYayinTarihi"],$_POST["KategoriNo"],$_POST["YazarNo"])) {
    
    $ISBN=$_POST["ISBN"];
    $KitapAdi=$_POST["KitapAdi"];
    $KitapYayinTarihi=$_POST["KitapYayinTarihi"];
    $KategoriNo=$_POST["KategoriNo"];
    $YazarNo=$_POST["YazarNo"];

    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
        
    //Kitap ekleme sorgusunu hazirliyoruz
    $sql = "INSERT INTO Kitaplar".
            "(ISBN,KitapAdi,KitapYayinTarihi)". 
            "VALUES ('$ISBN','$KitapAdi','$KitapYayinTarihi')"; 

    //Sorgulari veritabanina gönderiyoruz
    $cevap = mysqli_query($baglanti,$sql);

    
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }if ($cevap) {

        //KitapKategori ekleme sorgusunu hazirliyoruz      
        $sql2=  "INSERT INTO KitapKategori". 
                "(Kitaplar_ISBN,Kategoriler_KategoriNo)". 
                "VALUES ('$ISBN','$KategoriNo')";

        $cevap2= mysqli_query($baglanti,$sql2);

        //KitapYazar ekleme sorgusunu hazirliyoruz      
        $sql3=  "INSERT INTO KitapYazar". 
                "(Kitaplar_ISBN,Yazarlar_YazarNo)". 
                "VALUES ('$ISBN','$YazarNo')";

        $cevap3= mysqli_query($baglanti,$sql3);
        
        //Eger cevap FALSE ise HATA yazdiriyoruz
        if ((!$cevap2) && (!$cevap3)) {
            echo '<br>Hata:' . mysqli_error($baglanti);
        }
        if ($cevap2 && $cevap3) {
            echo "<h1 class='h1'> Kitap Bilgileri Veritabanına Eklendi.</h1>";
        }

    }
    
    echo "</html>";

    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>


</html>

