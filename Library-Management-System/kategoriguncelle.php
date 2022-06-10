<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="kategoriguncelle.css"/>
        <title> | Kategori Güncelle | </title>
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
                $sql = "SELECT * FROM Kategoriler WHERE KategoriNo=".$_GET['id'];

                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap) ) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }

                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);


                $id=(int)$_GET['id'];


                echo "<html>";
                echo "<form class= 'form' action='kategoriguncellekaydet.php?id=$id'";
                echo " method='POST'>";
                echo "<br> Kategori Adı: &nbsp;";
                echo "<input type='text' class='inpt' ";
                echo "name='KategoriAdi'";
                echo "value=";
                echo $gelen['KategoriAdi'];
                echo " />";
                echo "<br />";
                echo "<br />";
                echo "<input type='submit' class='button' ";
                echo "value='KAYDET'";
                echo " />";
                echo "&nbsp; &nbsp;";
                echo "<a class='btn' href= 'kategorislem.php'>İPTAL</a>";
                echo "</form>";
                echo "</html>";

                ?>
    </body>

</html>    




