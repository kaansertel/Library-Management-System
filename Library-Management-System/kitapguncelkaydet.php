<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel ="stylesheet"  type="text/css" href="kitapguncelkaydet.css"/>
        <title> | Kitap Güncel Kaydet |  </title>
        
    </head>

    <body>
        <?php
            // oturumu baslat
            session_start();
            //eger username adli oturum degiskeni yok ise login sayfasina yönlendir
            if (!isset($_SESSION['username'])) {
                header("location:_login.php");
                exit();
            }
            // mysql baglanma
            include("mysqlbaglan.php");

            if (!empty($_POST['KitapAdi'])) {
                // degiskenleri formdan alma
                if (isset($_POST["KitapAdi"],$_POST["KitapYayinTarihi"],$_POST["YazarNo"],
                $_POST["KategoriNo"])) {
                
                    $KitapAdi=$_POST["KitapAdi"];
                    $KitapYayinTarihi=$_POST["KitapYayinTarihi"];
                    $YazarNo=$_POST["YazarNo"];
                    $KategoriNo=$_POST["KategoriNo"];
                
                    //sorgu hazirlama
                    $sql = "UPDATE Kitaplar SET KitapAdi='$KitapAdi', KitapYayinTarihi='$KitapYayinTarihi' WHERE ISBN=".$_GET['id'];

                    $sql2 = "UPDATE KitapKategori SET Kategoriler_KategoriNo='$KategoriNo' WHERE Kitap_Kategori_Gecis_Id=".$_GET['no'];

                    $sql3 = "UPDATE KitapYazar SET Yazarlar_YazarNo='$YazarNo' WHERE Kitap_Yazar_Gecis_Id=".$_GET['no2'];

                    //Veritabanina sorgu gönderme
                    $cevap = mysqli_query($baglanti,$sql);
                    $cevap2 = mysqli_query($baglanti,$sql2);
                    $cevap3 = mysqli_query($baglanti,$sql3);
                
                    echo "<html>";
                    //türkçe karakter destegi ayari
                    echo "<meta http-equiv='Content-Type' "; 
                    echo "content='text/html; charset=UTF-8'/>";

                    if ( (!$cevap)) {
                        echo '<br>Hata:' . mysqli_error($baglanti);
                    }else {
                        echo "<p class='h_1'> Kayıt Güncellendi!</br> <a class ='btn'href='kitapislem.php'>Listele</a>\n </p>";

                    //  echo "<a href='_uyesayfasi.php'>Listele</a>\n";
                    }
                    echo "</html>";
                    //veritabani baglantisi kapatma
                    mysqli_close($baglanti);

            }
            }else {
                echo  "<p class='h_1'>Veritabanı Güncellenemedi!!! <br /> Kitap adının doldurulması zorunludur! <br /><a class ='buton'href='kitapislem.php'>Geri Dön</a>\n </p>";
            }

        ?>
    </body>

</html>
