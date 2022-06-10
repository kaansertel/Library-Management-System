<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Emanet Sil |</title>
        <link rel ="stylesheet"  type="text/css" href="emanetsil.css"/>
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
            $sql = "DELETE FROM Emanet WHERE EmanetNo=".$_GET['id'];

            // sorguyu veritabanina gönderme
            $cevap = mysqli_query($baglanti,$sql);

            echo "<html>";
            //türkçe karakter destegi ayari
            echo "<meta http-equiv='Content-Type' "; 
            echo "content='text/html; charset=UTF-8'/>";

            if ( (!$cevap)) {
                echo '<br>Hata:' . mysqli_error($baglanti);
            }else {
                echo "<p align ='center' class='h_1'> Kayıt silindi!</br> <br /><a class ='btn'href='emanetlistele.php'>Listele</a>\n </p>";

              //  echo "<a class='button' href='silmelistesi.php'>Listele</a>\n";
            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);
            ?>

    </body>

</html>
