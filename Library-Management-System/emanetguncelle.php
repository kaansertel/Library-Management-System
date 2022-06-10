<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Emanet Bilgilerini Güncelle |</title>
        <link rel ="stylesheet"  type="text/css" href="emanetguncelle.css"/>

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
                $sql = "SELECT * FROM Emanet WHERE EmanetNo=".$_GET['id'];


                //sorguyu veritabanina gönderme
                $cevap = mysqli_query($baglanti,$sql);

                //Eger cevap FALSE ise HATA yazidrma
                if ( (!$cevap) ) {
                    echo '<br>Hata:' . mysqli_error($baglanti);
                }

                //veritabanindan gelen cevabi alma
                $gelen=mysqli_fetch_array($cevap);

                $EmanetNo=(int)$_GET['id'];

                echo "<html>";
                echo "<h1 class='baslik'>Ödünç Tarihi Bilgileri</h1>";
                echo "<form class= 'form' action='emanetguncelkaydet.php?id=$EmanetNo'";
                echo " method='POST'>";
                echo "<br> Emanet Tarihi: &nbsp;";
                echo "<input type='text' class='inpt' ";
                echo "name='EmanetTarihi'";
                echo "value=";
                echo $gelen['EmanetTarihi'];
                echo " />";
                echo "<br /> <br />";
                echo "Teslim Tarihi: &nbsp; &nbsp;";
                echo "<input type='date'";
                echo " ";
                echo "name=";
                echo "TeslimTarihi";
                echo " ";
                echo "/>";
                echo "<br>";
                echo "<br />";
                echo "<br />";
                echo "<input type='submit' class='button' ";
                echo "value='KAYDET'";
                echo " />";
                echo "&nbsp; &nbsp;";
                echo "<a class='btn' href= 'emanetlistele.php'>İPTAL</a>";
                echo "</form>";
                echo "</html>";

                ?>
    </body>

</html>    




