
<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel ="stylesheet"  type="text/css" href="kitap.css"/>
        <title> | Kitap Yazar Ekle | </title>        
    </head>

    <body>
        
        <div class="form">
            <form action="kitapyazar.php" method="POST">
                    <h2> Kitap Yazar Ekleme </h2>

                    Kitap: &nbsp; &nbsp; &nbsp; &nbsp;
                <?php
                //mysql baglanti kodunu ekleme
                include("mysqlbaglan.php");

                //sorguyu yaziyoruz
                $sql6 = "SELECT * FROM Kitaplar";
                
                //sorguyu veritabanina gonderme
                $cevap6 = mysqli_query($baglanti,$sql6);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap6) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }

                echo "<select name='ISBN'>";
                while($gelen6=mysqli_fetch_array($cevap6)){
                echo "<option ";
                echo "value=";
                echo $gelen6['ISBN'];
                echo ">";
                echo $gelen6['ISBN'];
                echo "-";
                echo $gelen6['KitapAdi'];
                echo "</option>";
                }
                echo "</select>";
                echo "<br /> <br />";

                echo "Yazar: &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;";

                //sorguyu yaziyoruz
                $sql7 = "SELECT * FROM Yazarlar";
                
                //sorguyu veritabanina gonderme
                $cevap7 = mysqli_query($baglanti,$sql7);

                // eger cevap FAlSE ise HATA yazdiriyoruz
                if (!$cevap7) {
                echo '<br>Hata:' . mysqli_error($baglanti);
                }
                echo "<select name='YazarNo'>";
                while($gelen7=mysqli_fetch_array($cevap7)){
                echo "<option ";
                echo "value=";
                echo $gelen7['YazarNo'];
                echo ">";
                echo $gelen7['YazarlarAdi'];
                echo " ";
                echo $gelen7['YazarlarSoyad'];
                echo "</option>";
                }
                echo "</select>";
                echo "<br>";

                //veritabani baglantisini kapama
                mysqli_close($baglanti);
                
                ?>
                <br>
                <input type="submit" class="button" value="KAYDET" />
                <a href='kitap.php' class="btn"> Geri Dön </a>
                </form>
        </div>
                     
        
            
    </body>

</html>