<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel ="stylesheet"  type="text/css" href="gnclkydt.css"/>
    <title>| Üye Güncelleme |</title>
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
                
                //sorgu hazirlama
                $sql = "UPDATE Uyeler SET UyeAdi='$UyeAdi', UyeSoyad='$UyeSoyad', UyeTelefon='$UyeTelefon', UyeEposta='$UyeEposta' WHERE UyeNo=".$_GET['id'];


                $sql2 = "UPDATE Adresler SET Ulke='$Ulke', Sehir='$Sehir', PostaKodu='$PostaKodu', Cadde='$Cadde', Mahalle='$Mahalle' WHERE AdresNo=".$_GET['no'];

                

                //Veritabanina sorgu gönderme
                $cevap = mysqli_query($baglanti,$sql);
                $cevap2 = mysqli_query($baglanti,$sql2);

                echo "<html>";
                //türkçe karakter destegi ayari
                echo "<meta http-equiv='Content-Type' "; 
                echo "content='text/html; charset=UTF-8'/>";

                if ( (!$cevap) && (!$cevap2)) {
                   echo '<br>Hata:' . mysqli_error($baglanti);
                  
                }else {
                    echo "<p class='msg'> Kayıt Güncellendi!</br> <a class ='button'href='silmelistesi.php'>Listele</a>\n </p>";

                //  echo "<a href='_uyesayfasi.php'>Listele</a>\n";
                }
                echo "</html>";
                //veritabani baglantisi kapatma
                mysqli_close($baglanti);

            }

        ?>
    </body>

</html>
