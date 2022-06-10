<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel ="stylesheet"  type="text/css" href="kitap.css"/>
        <title> | Kategori Ekle | </title> 

    </head>

    <body>
        
        <div class="form ">
            <form action="kitapkategori.php" method="POST">
                            <h2> Kitap Kategorisi Ekleme </h2>

                            Kitap: &nbsp; &nbsp; &nbsp; &nbsp; 
                        <?php
                        //mysql baglanti kodunu ekleme
                        include("mysqlbaglan.php");

                        //sorguyu yaziyoruz
                        $sql4 = "SELECT * FROM Kitaplar";

                        //sorguyu veritabanina gonderme
                        $cevap4 = mysqli_query($baglanti,$sql4);

                        // eger cevap FAlSE ise HATA yazdiriyoruz
                        if (!$cevap4) {
                        echo '<br>Hata:' . mysqli_error($baglanti);
                        }
                    
                        echo "<select name='ISBN'>";
                        while($gelen4=mysqli_fetch_array($cevap4)){
                        echo "<option ";
                        echo "value=";
                        echo $gelen4['ISBN'];
                        echo ">";
                        echo $gelen4['ISBN'];
                        echo "-";
                        echo $gelen4['KitapAdi'];
                        echo "</option>";
                        }
                        echo "</select>";
                        echo "<br /> <br /> ";
                    
                        echo "Kategori: &nbsp; &nbsp;";
                    
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
                        echo "<option ";
                        echo "value=";
                        echo $gelen5['KategoriNo'];
                        echo ">";
                        echo $gelen5['KategoriAdi'];
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
