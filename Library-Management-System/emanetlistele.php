<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title>| Emanet Listele |</title>


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
                 font-weight:bold;

            }
            #tablo tr:nth-child(even){background-color: #e9ddcfd5;}

            #tablo tr:hover {
                 background-color: #2ecc71;
                 color:#fff;
                 font-weight:bold;
            }

            #tablo th {
                 padding-top: 12px;
                 padding-bottom: 12px;
                 text-align: left;
                background-color: #a08562;
                 color: white;
                 font-weight:bold;
                
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
        <h3>Lütfen Ödünç Alma Bilgilerinin Listeleneceği Kütüphaneyi Seçiniz!!!</h3>
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
                $sql = "SELECT Emanet.EmanetNo, Emanet.Uyeler_UyeNo, Uyeler.UyeAdi, Uyeler.UyeSoyad, Uyeler.UyeTelefon, Kutuphane.KutuphaneAdi, Kitaplar.ISBN, Kitaplar.KitapAdi, Emanet.EmanetTarihi, Emanet.TeslimTarihi
                FROM (((Emanet
                INNER JOIN Kitaplar ON Kitaplar.ISBN = Emanet.Kitaplar_ISBN)
                INNER JOIN Kutuphane ON Emanet.Kutuphane_KutuphaneNo = Kutuphane.KutuphaneNo)
                INNER JOIN Uyeler ON Uyeler.UyeNo = Emanet.Uyeler_UyeNo)
                WHERE KutuphaneNo='$No' ORDER BY EmanetNo";
            

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

                echo "<h1>Ödünç Alma Bilgileri</h1>";

                echo "<table border =1px id='tablo'>";
                echo "<tr >";
                echo "<th>Emanet No</th>";
                echo "<th>Üye No</th>";
                echo "<th>Üye Adı</th>";
                echo "<th>Üye Soyadı</th>";
                echo "<th>Üye Telefon Numarası</th>";
                echo "<th>Kütüphane</th>";
                echo "<th>ISBN</th>";
                echo "<th>Kitap Adı</th>";
                echo "<th>Emanet Tarihi</th>";
                echo "<th>Teslim Tarihi</th>";
                echo "</tr>";

                while($gelen=mysqli_fetch_array($cevap)){
                    // veritabanindan gelen değerler ile tablo satirlari olusturalim
                    echo "<tr><td class='tablo'>".$gelen['EmanetNo']." </td>";
                    echo "<td>".$gelen['Uyeler_UyeNo']."</td>";
                    echo "<td>".$gelen['UyeAdi']."</td>";
                    echo "<td>".$gelen['UyeSoyad']."</td>";
                    echo "<td>".$gelen['UyeTelefon']."</td>";
                    echo "<td>".$gelen['KutuphaneAdi']."</td>";
                    echo "<td>".$gelen['ISBN']."</td>";
                    echo "<td>".$gelen['KitapAdi']."</td>";
                    echo "<td>".$gelen['EmanetTarihi']."</td>";
                    echo "<td>".$gelen['TeslimTarihi']."</td>";

                    // sil linki olusturma
                    echo "<td><a class='button' href=emanetsil.php?id=";
                    echo $gelen['EmanetNo'];
                    echo ">Sil</a></td>";

                    // Guncellestirme
                    echo "<td><a class='button' href=emanetguncelle.php?id=";
                    echo $gelen['EmanetNo'];
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