<html>

    <head>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Emanet Ekle |</title>
        <link rel ="stylesheet"  type="text/css" href="emanetEkle.css"/>
    </head>

    <body>

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
            if (isset($_POST["UyeNo"],$_POST["EmanetTarihi"],$_POST["TeslimTarihi"],$_POST["ISBN"])) {

                $UyeNo=$_POST["UyeNo"];
                $EmanetTarihi=$_POST["EmanetTarihi"];
                $TeslimTarihi=$_POST["TeslimTarihi"];
                $ISBN=$_POST["ISBN"];
                $KutuphaneNo=(int)$_GET['id'];
            
                echo "<html>";
                //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
                echo "<meta http-equiv='Content-Type' ";
                echo "content='text/html; charset=UTF-8' />";
                echo "<body>";
            
                //Uye ekleme sorgusunu hazirliyoruz
                $sql = "INSERT INTO Emanet".
                        "(EmanetTarihi,TeslimTarihi,Kitaplar_ISBN,Uyeler_UyeNo,Kutuphane_KutuphaneNo)". 
                        "VALUES ('$EmanetTarihi','$TeslimTarihi','$ISBN','$UyeNo','$KutuphaneNo')"; 

                //Sorgulari veritabanina gönderiyoruz
                $cevap = mysqli_query($baglanti,$sql);

                //Eger cevap FALSE ise HATA yazdiriyoruz
                if (!$cevap) {
                   /* echo '<br>Hata:' . mysqli_error($baglanti);*/
                    echo "<h1 class ='h_1' >Ödünç Alma Bilgileri Veritabanına Eklenemedi!!! <br /><br /> <a class = 'btn' href='_uyesayfasi.php'>Geri Dön </a></h1>";
                }else {
                    echo "<h1 class='h_1' >Ödünç Alma Bilgileri Veritabanına Eklendi. <br /><br /> <a class = 'btn' href='_uyesayfasi.php'>Geri Dön </a></h1>";
                }
            
                
            }
            echo "</body>";
            echo "</html>";

            //VeriTabani baglantisini kapatiyoruz.
            mysqli_close($baglanti);
            ?>
    </body>


</html>
