<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel ="stylesheet"  type="text/css" href="kitapguncelle.css"/> 
        <title> | Kitap Güncelle | </title>  

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
                $sql2 = "SELECT * FROM KitapKategori WHERE Kitap_Kategori_Gecis_Id=".$_GET['KategoriNo'];
                $sql3 = "SELECT * FROM KitapYazar WHERE Kitap_Yazar_Gecis_Id=".$_GET['YazarNo'];

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
                $Kitap_Kategori_Gecis_Id=(int)$_GET['KategoriNo'];
                $Kitap_Yazar_Gecis_Id=(int)$_GET['YazarNo'];

                echo "<html>";
                echo "<h1 class ='baslik'>Kitap Bilgileri</h1>";
                echo "<form class= 'form' action='kitapguncelkaydet.php?id=$ISBN&no=$Kitap_Kategori_Gecis_Id&no2=$Kitap_Yazar_Gecis_Id'";
                echo " method='POST'>";
                echo "Kitap Adı: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
                $dizi = $gelen['KitapAdi'];
                $dizi2 = explode(" ",$dizi);
                $uzunluk = count($dizi2);
                $i = 0;
                echo "<input type='text' class='inpt'";
                echo "name='KitapAdi'";
                echo " placeholder=";
                while ($i < $uzunluk) {
                    echo $dizi2[$i];
                    $i += 1;
                }
                echo " />";
                echo " &nbsp; *Doldurulması zorunludur.";
                echo "<br /> <br />";
                echo "Yayın Tarihi:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;";
                echo "<input type='date' class='inpt' ";
                echo "name='KitapYayinTarihi'";
                echo "value=";
                echo $gelen['KitapYayinTarihi'];
                echo " />";
                echo "<br /> <br />";
                echo "Yazar: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
                //sorguyu yaziyoruz
                $sql4 = "SELECT * FROM Yazarlar";
                
                //sorguyu veritabanina gonderme
                $cevap4 = mysqli_query($baglanti,$sql4);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap4) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }
                echo "<select name='YazarNo'>";
                while($gelen4=mysqli_fetch_array($cevap4)){
                    if ($gelen4['YazarNo'] == $gelen3['Yazarlar_YazarNo']) {
                        echo "<option ";
                        echo "value=";
                        echo $gelen4['YazarNo'];
                        echo " selected>";
                        echo $gelen4['YazarlarAdi'];
                        echo " ";
                        echo $gelen4['YazarlarSoyad'];
                        echo "</option>";
                    }else {
                        echo "<option ";
                        echo "value=";
                        echo $gelen4['YazarNo'];
                        echo ">";
                        echo $gelen4['YazarlarAdi'];
                        echo " ";
                        echo $gelen4['YazarlarSoyad'];
                        echo "</option>";
                    }
                }
                echo "</select>";
                echo "<br /> <br />";
                echo "Kategori: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ";
                
                //sorguyu yaziyoruz
                $sql5 = "SELECT * FROM Kategoriler";
                
                //sorguyu veritabanina gonderme
                $cevap5 = mysqli_query($baglanti,$sql5);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap5) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }
                echo "<select name='KategoriNo'>";
                while($gelen5=mysqli_fetch_array($cevap5)){
                    if ($gelen5['KategoriNo'] == $gelen2['Kategoriler_KategoriNo']) {
                        echo "<option ";
                        echo "value=";
                        echo $gelen5['KategoriNo'];
                        echo " selected>";
                        echo $gelen5['KategoriAdi'];
                        echo "</option>";
                    }else {
                        echo "<option ";
                        echo "value=";
                        echo $gelen5['KategoriNo'];
                        echo ">";
                        echo $gelen5['KategoriAdi'];
                        echo "</option>";
                    }
                }
                echo "</select>";
                echo "<br />";
                echo "<br />";
                echo "<input type='submit' class='button' ";
                echo "value='KAYDET'";
                echo " />";
                echo "&nbsp; &nbsp;";
                echo "<a class='btn' href= 'kitapislem.php'>İPTAL</a>";
                echo "</form>";
                echo "</html>";

                ?>

      
         
    </body>

</html>    




