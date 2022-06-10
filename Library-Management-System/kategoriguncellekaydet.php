<html>
    <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
            <link rel ="stylesheet"  type="text/css" href="kategoriguncellekaydet.css"/>
            <title> | Kategori Güncelleme | </title>
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

            // degiskenleri formdan alma
            if (isset($_POST["KategoriAdi"])) {
                
                $KategoriAdi=$_POST["KategoriAdi"];
                
                //sorgu hazirlama
                $sql = "UPDATE Kategoriler SET KategoriAdi='$KategoriAdi' WHERE KategoriNo=".$_GET['id'];
        
                //Veritabanina sorgu gönderme
                $cevap = mysqli_query($baglanti,$sql);

                echo "<html>";
                //türkçe karakter destegi ayari
                echo "<meta http-equiv='Content-Type' "; 
                echo "content='text/html; charset=UTF-8'/>";

                if ( (!$cevap)) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }else {
                    echo "<p class='msg'> Kayıt Güncellendi!</br> <a class ='button'href='kategorislem.php'>Listele</a>\n </p>";

                //  echo "<a href='_uyesayfasi.php'>Listele</a>\n";
                }
                echo "</html>";
                //veritabani baglantisi kapatma
                mysqli_close($baglanti);

            }

        ?>
    </body>

</html>