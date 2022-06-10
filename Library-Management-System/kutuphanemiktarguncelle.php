<html>
    <head>

       <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
       <title> | Miktar Güncelleme | </title>
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
        .buton{
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

            if (($_POST['Miktar'] >= 0)) {
                // degiskenleri formdan alma
                if (isset($_POST["Miktar"])) {
                
                    $Miktar=$_POST["Miktar"];
                
                    //sorgu hazirlama
                    $sql = "UPDATE KutuphaneKitap SET Miktar='$Miktar' WHERE Kutuphane_Kitap_Gecis_Id=".$_GET['id'];

                    //Veritabanina sorgu gönderme
                    $cevap = mysqli_query($baglanti,$sql);
                
                    echo "<html>";
                    //türkçe karakter destegi ayari
                    echo "<meta http-equiv='Content-Type' "; 
                    echo "content='text/html; charset=UTF-8'/>";

                    if ( (!$cevap)) {
                        echo '<br>Hata:' . mysqli_error($baglanti);
                        echo "<br>";
                        echo "<a class ='buton' href='kutuphanekitaplistele.php'>Geri Dön</a>\n </p>";
                    }else {
                        echo "<p class='h_1'> Kayıt Güncellendi!</br> <a class ='buton'href='kutuphanekitaplistele.php'>Listele</a>\n </p>";

                    //  echo "<a href='_uyesayfasi.php'>Listele</a>\n";
                    }
                    echo "</html>";
                    //veritabani baglantisi kapatma
                    mysqli_close($baglanti);

            }
            }else {
                echo  "<h1 class ='h_1'>Veritabanı Güncellenemedi!!! <br /> Miktarın belirtilmesi zorunludur! </h1>";
                echo  "<a class ='buton'href='kutuphanekitaplistele.php'>Geri Dön</a>\n";
        
               
            }

        ?>
    </body>

</html>
