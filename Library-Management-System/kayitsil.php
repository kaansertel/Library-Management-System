<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel ="stylesheet"  type="text/css" href="kytsil.css"/>
        <title> | Kayıt Sil | </title>
        
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
            //mysql baglanti kodu
            include("mysqlbaglan.php");

            // sorgu yazma
            $sql = "DELETE FROM Uyeler WHERE UyeNo=".$_GET['id'];
            $sql2 = "DELETE FROM Adresler WHERE AdresNo=".$_GET['no'];
            $sql3 = "DELETE FROM UyeAdres WHERE Uye_Adres_Gecis_Id=".$_GET['id'];

            // sorguyu veritabanina gönderme
            $cevap3 = mysqli_query($baglanti,$sql3);
            $cevap = mysqli_query($baglanti,$sql);
            $cevap2 = mysqli_query($baglanti,$sql2);



            echo "<html>";
            //türkçe karakter destegi ayari
            echo "<meta http-equiv='Content-Type' "; 
            echo "content='text/html; charset=UTF-8'/>";

            if ( (!$cevap) && (!$cevap2) && (!$cevap3) ) {
                echo '<br>Hata:' . mysqli_error($baglanti);
            }else {
                echo "<p class='msg'> Kayıt silindi!</br> <a class ='button'href='silmelistesi.php'>Listele</a>\n </p>";

              //  echo "<a class='button' href='silmelistesi.php'>Listele</a>\n";
            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);
            ?>

    </body>

</html>
