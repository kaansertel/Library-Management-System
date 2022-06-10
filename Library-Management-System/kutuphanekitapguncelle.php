<html>
    <head>
        <link rel ="stylesheet"  type="text/css" href="kutuphanekitapguncelle.css"/>
        <title> | Kütüphane Kitap Güncelle | </title>
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
                // mysql baglantisi
                include("mysqlbaglan.php");

                // sorgu yazma
                $sql = "SELECT * FROM Kitaplar WHERE ISBN=".$_GET['id'];
                $sql2 = "SELECT * FROM Kutuphane WHERE KutuphaneNo=".$_GET['KutuphaneNo'];
                $sql3 = "SELECT * FROM KutuphaneKitap WHERE Kutuphane_Kitap_Gecis_Id=".$_GET['GecisId'];

                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);
                $cevap2 = mysqli_query($baglanti,$sql2);
                $cevap3 = mysqli_query($baglanti,$sql3);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap) && (!$cevap2) && (!$cevap3) ) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }

                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);
                $gelen2=mysqli_fetch_array($cevap2);
                $gelen3=mysqli_fetch_array($cevap3);

                $ISBN=(int)$_GET['id'];
                $KutuphaneNo=(int)$_GET['KutuphaneNo'];
                $Kutuphane_Kitap_Gecis_Id=(int)$_GET['GecisId'];

                echo "<html>";
                echo "<h1>Kitap Bilgileri</h1>";
                echo "<form class= 'form' action='kutuphanemiktarguncelle.php?id=$Kutuphane_Kitap_Gecis_Id'";
                echo " method='POST'>";
                echo "ISBN: ";
                echo $gelen['ISBN'];
                echo "<br />";
                echo "Kitap Adı:&nbsp;";
                echo $gelen['KitapAdi'];
                echo "<br />";
                echo "Kitap Yayın Tarihi:&nbsp;";
                echo $gelen['KitapYayinTarihi'];
                echo "<br>";
                echo "Kütüphane Adı: &nbsp;";
                echo $gelen2['KutuphaneAdi'];
                echo "<br />";
                echo "Miktar:&nbsp;";
                echo "<input type='text' class='inpt' ";
                echo "name='Miktar'";
                echo "value=";
                echo $gelen3['Miktar'];
                echo " />";
                echo "<br />";
                echo "<br />";
                echo "<input type='submit' class='button' ";
                echo "value='KAYDET'";
                echo " />";
                echo "&nbsp; &nbsp;";
                echo "<a class='btn' href= 'kutuphanekitaplistele.php'>İPTAL</a>";
                echo "</form>";
                echo "</html>";

                ?>
    </body>

</html>