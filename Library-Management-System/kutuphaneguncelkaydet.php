<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Kütüphane Güncelleme | </title>
        <style>
             body{
        
                 background-color: #ddc08bb0 ;
             }
             .h_1{
                 border: 2px solid rgb(19, 17, 17);
                 background-color:#a08562;
                 width: 450px;
                 margin: auto;
                 margin-top:40px;
                 padding: 20px;
                 font-size: 20px;
                 font-weight: bold;
                 border-radius: 15px;
                 text-align:center;

             }
             .btn{
                 color: #4d1403; 
                 padding: 10px;
                 text-decoration: none;
                 margin-top: 10px;
                 margin-left: 10px;
                 font-weight: bold;
                 font-size: 18px;
             }
        </style>
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
        if (isset($_POST["KutuphaneAdi"],$_POST["Ulke"],$_POST["Sehir"],$_POST["PostaKodu"],$_POST["Cadde"],$_POST["Mahalle"])) {

            $KutuphaneAdi=$_POST["KutuphaneAdi"];
            $Ulke=$_POST["Ulke"];
            $Sehir=$_POST["Sehir"];
            $PostaKodu=$_POST["PostaKodu"];
            $Cadde=$_POST["Cadde"];
            $Mahalle=$_POST["Mahalle"];

            //sorgu hazirlama
            $sql = "UPDATE Kutuphane SET KutuphaneAdi='$KutuphaneAdi' WHERE KutuphaneNo=".$_GET['id'];
        
        
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
            echo "<p class ='h_1' > Kayıt Güncellendi!</br> <a class ='btn' href='kutuphaneislem.php'>Listele</a>\n </p>";
            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);
        
        }

        ?>
    </body>
</html>