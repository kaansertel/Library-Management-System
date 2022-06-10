<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <link rel ="stylesheet"  type="text/css" href="gncll.css"/>
    <title> | Üye Bilgilerini Güncelle | </title>
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
                $sql = "SELECT * FROM Uyeler WHERE UyeNo=".$_GET['id'];
                $sql2 = "SELECT * FROM Adresler WHERE AdresNo=".$_GET['no'];

                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);
                $cevap2 = mysqli_query($baglanti,$sql2);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap) && (!$cevap2) ) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }

                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);
                $gelen2=mysqli_fetch_array($cevap2);

                $id=(int)$_GET['id'];
                $no=(int)$_GET['no'];

                echo "<html>";
                echo "<form class= 'form' action='guncelkaydet.php?id=$id&no=$no'";
                //echo $_GET['id'];
                //echo " &no=";
                //echo $_GET['no'];
                echo " method='POST'>";
                echo "<br> Adı: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
                echo "<input type='text' class='inpt' ";
                echo "name='UyeAdi'";
                echo "value=";
                echo $gelen['UyeAdi'];
                echo " />";
                echo "<br />";
                echo "Soyad: &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
                echo "<input type='text' class='inpt'";
                echo "name='UyeSoyad'";
                echo "value=";
                echo $gelen['UyeSoyad'];
                echo " />";
                echo "<br />";
                echo "Telefon Numarasi:&nbsp; ";
                echo "<input type='text' class='inpt' ";
                echo "name='UyeTelefon'";
                echo "value=";
                echo $gelen['UyeTelefon'];
                echo " />";
                echo "<br />";
                echo "E-Posta: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
                echo "<input type='text' class='inpt' ";
                echo "name='UyeEposta'";
                echo "value=";
                echo $gelen['UyeEposta'];
                echo " />";
                echo "<br />";
                echo "Ulke: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ";
                echo "<input type='text' class='inpt' ";
                echo "name='Ulke'";
                echo "value=";
                echo $gelen2['Ulke'];
                echo " />";
                echo "<br />";
                echo "Sehir: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
                echo "<input type='text' class='inpt' ";
                echo "name='Sehir'";
                echo "value=";
                echo $gelen2['Sehir'];
                echo " />";
                echo "<br />";
                echo "Posta Kodu: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ";
                echo "<input type='text' class='inpt'";
                echo "name='PostaKodu'";
                echo "value=";
                echo $gelen2['PostaKodu'];
                echo " />";
                echo "<br />";
                echo "Cadde:&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
                echo "<input type='text' class='inpt' ";
                echo "name='Cadde'";
                echo "value=";
                echo $gelen2['Cadde'];
                echo " />";
                echo "<br />";
                echo "Mahalle:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
                echo "<input type='text' class='inpt'";
                echo "name='Mahalle'";
                echo "value=";
                echo $gelen2['Mahalle'];
                echo " />";
                echo "<br />";
                echo "<br />";
                echo "<input type='submit' class='button' ";
                echo "value='KAYDET'";
                echo " />";
                echo "&nbsp; &nbsp;";
                echo "<a class='btn' href= 'silmelistesi.php'>İPTAL</a>";
                echo "</form>";
                echo "</html>";

                ?>
    </body>

</html>    




