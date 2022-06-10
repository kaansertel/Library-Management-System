<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Yazar Güncelle |</title>
        <link rel ="stylesheet"  type="text/css" href="yazarguncelle.css"/>

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
$sql = "SELECT * FROM Yazarlar WHERE YazarNo=".$_GET['id'];


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
echo "<form class='form' action='yazarguncelkaydet.php?id=$id'";
//echo $_GET['id'];
//echo " &no=";
//echo $_GET['no'];
echo " method='POST'>";
echo "<br> Adı: ";
echo "<input type=' text' class='inpt' ";
echo "name='YazarlarAdi'";
echo "value=";
echo $gelen['YazarlarAdi'];
echo " />";
echo "<br />";
echo "Soyadı: ";
echo "<input type='text' class='inpt'";
echo "name='YazarlarSoyad'";
echo "value=";
echo $gelen['YazarlarSoyad'];
echo " />";
echo "<br />";
echo "<br />";
echo "<input type='submit' class='button'";
echo "value='KAYDET'";
echo " />";
echo "&nbsp; &nbsp;";
echo "<a href= 'yazarislem.php' class='btn' >IPTAL</a>";
echo "</form>";
echo "</html>";

?>

</body>
</html>
