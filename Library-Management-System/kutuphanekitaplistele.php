<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title>| Kütüphane Kitap Listele |</title>

      <style>
 body{
    background-color: #ddc08bb0;;
}

#tablo{
                 border-collapse: collapse;
                 width: 100%;
                 
            }
            #tablo td, #tablo th{
                 border: 1px solid black;
                 padding: 8px;
                 font-weight: bold;
                

            }
            #tablo tr:nth-child(even){background-color: #e9ddcfd5;}

            #tablo tr:hover {
                 background-color: #2ecc71;
                 color:#fff;
                 font-weight: bold;
            }

            #tablo th {
                 padding-top: 12px;
                 padding-bottom: 12px;
                 text-align: left;
                background-color: #a08562;
                 color: white;
                 font-weight: bold;
                
            }

.button{
    width :130px;
    color :blue;
    font-weight: bold;
    font-size: 15px;
    text-decoration: none;
    font-family:cursive;
}

.bttn{
    background-color:#deb887;
    border: solid thin ;
    color: #8b4513;
    padding: 10px;
    text-decoration: none;
    display: inline-block;
    margin-top: 100px;
    font-weight: bold;
    font-size: 18px;
                
}

     </style>

    </head>   
    
    <body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <h1>Kütüphaneler</h1>
        <h3>Lütfen Kitap Bilgilerinin Listeleneceği Kütüphaneyi Seçiniz!!!</h3>
        <?php
                //mysql baglanti kodunu ekleme
                include("mysqlbaglan.php");

                //sorguyu yaziyoruz
                $sql = "SELECT * FROM Kutuphane";
                
                //sorguyu veritabanina gonderme
                $cevap = mysqli_query($baglanti,$sql);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }


                while($gelen=mysqli_fetch_array($cevap)){
                    echo "<input ";
                    echo "type='radio' ";
                    echo "name=";
                    echo "KutuphaneNo";
                    echo " ";
                    echo "value=";
                    echo $gelen['KutuphaneNo'];
                    echo " />";
                    echo $gelen['KutuphaneAdi'];
                    echo " ";
                }


                //veritabani baglantisini kapama
                mysqli_close($baglanti);
                
                ?>

                <br>
                <br>
                <input type="submit" class="button" value="Listele" />
            </form>

    </body>    
</html>    


<?php
        // oturumu baslat
        session_start();
        //eger username adli oturum degiskeni yok ise login sayfasina yönlendir
        if (!isset($_SESSION['username'])) {
            header("location:_login.php");
            exit();
        }
        //mysql baglanti kodunu ekliyoruz
        include("mysqlbaglan.php");


        if (!empty($_POST["KutuphaneNo"])) {

            $No=$_POST["KutuphaneNo"];


                //sorguyu yaziyoruz
                $sql = 	"SELECT Kitaplar.ISBN, Kitaplar.KitapAdi, Kitaplar.KitapYayinTarihi, Kutuphane.KutuphaneAdi, KutuphaneKitap.Miktar, KutuphaneKitap.Kutuphane_Kitap_Gecis_Id
                FROM ((Kitaplar
                INNER JOIN KutuphaneKitap ON Kitaplar.ISBN = KutuphaneKitap.Kitaplar_ISBN)
                INNER JOIN Kutuphane ON KutuphaneKitap.Kutuphane_KutuphaneNo = Kutuphane.KutuphaneNo)
                WHERE KutuphaneNo='$No'";

                //sorguyu veritabanina gonderme
                $cevap = mysqli_query($baglanti,$sql);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }

                //sorgudan gelen tüm kayitlari tablo icinde yazdirma
                // tablo basliklari olusturma

                echo "<html>";


                //türkçe karakter destegi ayari
                echo "<meta http-equiv='Content-Type' "; 
                echo "content='text/html; charset=UTF-8'/>";

                echo "<h1>Kitap Bilgileri</h1>";

                echo "<table border =1px id='tablo'>";
                echo "<tr >";
                echo "<th>ISBN</th>";
                echo "<th>Kitap Adı</th>";
                echo "<th>Kitap Yayın Tarihi</th>";
                echo "<th>Kütüphane Adı</th>";
                echo "<th>Kitap Miktarı</th>";
                echo "</tr>";

                while($gelen=mysqli_fetch_array($cevap)){
                    // veritabanindan gelen değerler ile tablo satirlari olusturalim
                    echo "<tr><td>".$gelen['ISBN']." </td>";
                    echo "<td>".$gelen['KitapAdi']."</td>";
                    echo "<td>".$gelen['KitapYayinTarihi']."</td>";
                    echo "<td>".$gelen['KutuphaneAdi']."</td>";
                    echo "<td>".$gelen['Miktar']."</td>";

                    // sil linki olusturma
                    echo "<td><a class='button' href=kutuphanekitapsil.php?id=";
                    echo $gelen['ISBN'];
                    echo "&KutuphaneNo=";
                    echo $No;
                    echo "&GecisId=";
                    echo $gelen['Kutuphane_Kitap_Gecis_Id'];
                    echo ">Sil</a></td>";

                    // Guncellestirme
                    echo "<td><a class='button' href=kutuphanekitapguncelle.php?id=";
                    echo $gelen['ISBN'];
                    echo "&KutuphaneNo=";
                    echo $No;
                    echo "&GecisId=";
                    echo $gelen['Kutuphane_Kitap_Gecis_Id'];
                    echo ">Güncelle</a></td></tr>";
                }
                //tablo kodunu bitirme
                echo "</table>";

        }
        echo "<br/><a href='_uyesayfasi.php' class='bttn'>Geri Dön </a>";
        echo "</html>";

        //veritabani baglantisini kapama
        mysqli_close($baglanti);
        ?>