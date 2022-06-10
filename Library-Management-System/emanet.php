<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title> | Kitap Ödünç Alma |</title>
        <link rel ="stylesheet"  type="text/css" href="emanet.css"/>
    </head>   
    
    <body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <h3>Lütfen Görevli Olduğunuz Kütüphaneyi Seçiniz!!!</h3>
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
                <input type="submit" class="listele" value="Listele" />
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

       

        echo "<html>";
        echo "<meta http-equiv='Content-Type' ";
        echo "content='text/html; charset=UTF-8' />";
        echo "<body>";
        
        if (!empty($_POST["KutuphaneNo"])) {
            $No=$_POST["KutuphaneNo"];
            echo "<form action='emanetekle.php?id=$No'";
            echo " ";
            echo "method=";
            echo "POST";
            echo ">";
            echo"<div class='form1'>";
            echo "Üye No:&nbsp;";
            echo "<input type='text' class='inpt' ";
            echo " ";
            echo "name=";
            echo "UyeNo";
            echo " ";
            echo "/>";
            echo "<br>";
            echo "Emanet Tarihi:&nbsp;";
            echo "<input type='date' class='inpt'";
            echo " ";
            echo "name=";
            echo "EmanetTarihi";
            echo " ";
            echo "/>";
            echo "<br>";
            echo "Teslim Tarihi:&nbsp;";
            echo "<input type='date' class='inpt' ";
            echo " ";
            echo "name=";
            echo "TeslimTarihi";
            echo " ";
            echo "/>";
            echo "<br>";
            
            //sorguyu yaziyoruz
            $sql = "SELECT Kitaplar_ISBN FROM KutuphaneKitap WHERE Kutuphane_KutuphaneNo='$No'ORDER BY Kitaplar_ISBN";
                
            //sorguyu veritabanina gonderme
            $cevap = mysqli_query($baglanti,$sql);

            // eger cevap FAlSE ise HATA yazdiriyoruz
            if (!$cevap) {
            echo '<br>Hata:' . mysqli_error($baglanti);
            }
            echo "Kitap:&nbsp;&nbsp;&nbsp;";
            echo "<select name='ISBN' >";
            while ($gelen=mysqli_fetch_array($cevap)) {
                $No2 = $gelen['Kitaplar_ISBN'];
                $sql2 = "SELECT * FROM Kitaplar WHERE ISBN='$No2'";
                //sorguyu veritabanina gonderme
                $cevap2 = mysqli_query($baglanti,$sql2);
                while($gelen2=mysqli_fetch_array($cevap2)){
                    echo "<option ";
                    echo "value=";
                    echo $gelen2['ISBN'];
                    echo ">";
                    echo $gelen2['ISBN'];
                    echo "-";
                    echo $gelen2['KitapAdi'];
                    echo "</option>";
                    }
            }
            echo "</select>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<input type='submit' class='button'";
            echo " ";
            echo "value=";
            echo "KAYDET";
            echo " ";
            echo "/>";
            echo "</form>";
            echo"</div>";
        }

        echo "</body>";
        echo "<br/><a href='_uyesayfasi.php' class='btn'>Geri Dön </a>";
        echo "</html>";
        
        //veritabani baglantisini kapama
        mysqli_close($baglanti);
    ?>