<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel ="stylesheet"  type="text/css" href="emanetguncelkaydet.css"/>
    <title>| Emanet Güncelleme |</title>
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
                if (isset($_POST["EmanetTarihi"],$_POST["TeslimTarihi"])) {
                
                    $EmanetTarihi=$_POST["EmanetTarihi"];
                    $TeslimTarihi=$_POST["TeslimTarihi"];
                
                    //sorgu hazirlama
                    $sql = "UPDATE Emanet SET EmanetTarihi='$EmanetTarihi', TeslimTarihi='$TeslimTarihi' WHERE EmanetNo=".$_GET['id'];

                    //Veritabanina sorgu gönderme
                    $cevap = mysqli_query($baglanti,$sql);
                
                    echo "<html>";
                    //türkçe karakter destegi ayari
                    echo "<meta http-equiv='Content-Type' "; 
                    echo "content='text/html; charset=UTF-8'/>";

                    if ( (!$cevap)) {
                        echo '<br>Hata:' . mysqli_error($baglanti);
                    }else {
                        echo "<p align ='center' class='h_1'> Kayıt Güncellendi!</br> <br /><a class ='btn'href='emanetlistele.php'>Listele</a>\n </p>";

                    //  echo "<a href='_uyesayfasi.php'>Listele</a>\n";
                    }
                    echo "</html>";
                    //veritabani baglantisi kapatma
                    mysqli_close($baglanti);

            }

        ?>
    </body>

</html>
