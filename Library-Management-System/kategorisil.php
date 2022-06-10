<html>
    <head>
          <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
          <title> | Kategori Sil |</title>
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
            //mysql baglanti kodu
            include("mysqlbaglan.php");

            // sorgu yazma
            $sql = "DELETE FROM Kategoriler WHERE KategoriNo=".$_GET['id'];

            // sorguyu veritabanina gönderme
            $cevap = mysqli_query($baglanti,$sql);

            echo "<html>";
            //türkçe karakter destegi ayari
            echo "<meta http-equiv='Content-Type' "; 
            echo "content='text/html; charset=UTF-8'/>";

            if ( (!$cevap)) {
                echo '<br>Hata:' . mysqli_error($baglanti);
            }else {
                echo "<p class='h_1'> Kayıt silindi!</br> <a class ='btn'href='kategorislem.php'>Listele</a>\n </p>";

              //  echo "<a class='button' href='silmelistesi.php'>Listele</a>\n";
            }
            echo "</html>";
            //veritabani baglantisi kapatma
            mysqli_close($baglanti);
            ?>

    </body>

</html>
