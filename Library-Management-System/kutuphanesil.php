<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
       <title> | Kütüphane Sil | </title>
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
                    color:#000;
                
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
            //mysql baglanti kodu
            include("mysqlbaglan.php");

            // sorgu yazma
            $sql = "DELETE FROM Kutuphane WHERE KutuphaneNo=".$_GET['id'];
            $sql2 = "DELETE FROM Adresler WHERE AdresNo=".$_GET['no'];
            $sql3 = "DELETE FROM KutuphaneAdres WHERE Kutuphane_Adres_Gecis_Id=".$_GET['id'];

            // sorguyu veritabanina gönderme
            $cevap3 = mysqli_query($baglanti,$sql3);
            $cevap = mysqli_query($baglanti,$sql);
            $cevap2 = mysqli_query($baglanti,$sql2);



            echo "<html>";
            //türkçe karakter destegi ayari
            echo "<meta http-equiv='Content-Type' "; 
            echo "content='text/html; charset=UTF-8'/>";

            if ( (!$cevap) && (!$cevap2) && (!$cevap3) ) {
                echo '<br>Hata:' . mysqli_error($baglanti);
            }else {
                echo "<h1 class='h_1' >  Kayıt silindi! </br><br /> <a class ='btn' href='kutuphaneislem.php'>Listele</a>\n </h1>";

            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);
        ?>

    </body>          
    </html>  



