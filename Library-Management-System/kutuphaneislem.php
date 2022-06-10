<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Kütüphane İşlem | </title>
    <style>

body{
    background-color: #ddc08bb0;;
}

#tablo{
                 border-collapse: collapse;
                 width: 100%;
                 
            }
            #tablo td, #tablo th{
                 border: 1px solid black;
                 padding: 8px;
                 font-weight:bold;
                

            }
            #tablo tr:nth-child(even){background-color: #e9ddcfd5;}

            #tablo tr:hover {
                 background-color: #2ecc71;
                 color:#fff;
                 font-weight:bold;
            }

            #tablo th {
                 padding-top: 12px;
                 padding-bottom: 12px;
                 text-align: left;
                background-color: #a08562;
                 color: white;
                 font-weight:bold;
                
            }

.button{
    width :130px;
    color :red;
    font-weight: bold;
    font-size: 15px;
    text-decoration: none;
    font-family:cursive;
}

.bttn{
    background-color:#deb887;
    border: solid thin ;
    color: #8b4513;
    padding: 10px;
    text-decoration: none;
    display: inline-block;
    margin-top: 100px;
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
//mysql baglanti kodunu ekliyoruz
include("mysqlbaglan.php");

//sorguyu yaziyoruz
$sql = " SELECT Kutuphane.KutuphaneNo, Kutuphane.KutuphaneAdi, Adresler.AdresNo, Adresler.Ulke, Adresler.Sehir, Adresler.PostaKodu, Adresler.Cadde, Adresler.Mahalle
FROM ((Kutuphane
INNER JOIN KutuphaneAdres ON Kutuphane.KutuphaneNo = KutuphaneAdres.Kutuphane_KutuphaneNo)
INNER JOIN Adresler ON KutuphaneAdres.Adresler_AdresNo = Adresler.AdresNo);";



//sorguyu veritabanina gonderme
$cevap = mysqli_query($baglanti,$sql);

// eger cevap FAlSE ise HATA yazdiriyoruz
if (!$cevap) {
    echo '<br>Hata:' . mysqli_error($baglanti);
}

//sorgudan gelen tüm kayitlari tablo icinde yazdirma
// tablo basliklari olusturma

echo "<html>";
//türkçe karakter destegi ayari
echo "<meta http-equiv='Content-Type' "; 
echo "content='text/html; charset=UTF-8'/>";

echo "<h1>Kütüphane Bilgileri</h1>";

echo "<table border=1 id ='tablo'>";
echo "<tr>";
echo "<th>Kütüphane No</th>";
echo "<th>Kütüphane Adı</th>";
echo "<th>Kütüphane Adres No</th>";
echo "<th> Ülke </th>";
echo "<th> Şehir </th>";
echo "<th>Posta Kodu</th>";
echo "<th>Cadde</th>";
echo "<th>Mahalle</th>";
echo "</tr>";

while($gelen=mysqli_fetch_array($cevap)){
    // veritabanindan gelen değerler ile tablo satirlari olusturalim
    echo "<tr><td>".$gelen['KutuphaneNo']." </td>";
    echo "<td>".$gelen['KutuphaneAdi']."</td>";
    echo "<td>".$gelen['AdresNo']."</td>";
    echo "<td>".$gelen['Ulke']."</td>";
    echo "<td>".$gelen['Sehir']."</td>";
    echo "<td>".$gelen['PostaKodu']."</td>";
    echo "<td>".$gelen['Cadde']."</td>";
    echo "<td>".$gelen['Mahalle']."</td>";
    // sil linki olusturma
    echo "<td><a class ='button' href=kutuphanesil.php?id=";
    echo $gelen['KutuphaneNo'];
    echo "&no=";
    echo $gelen['AdresNo'];
    echo ">Sil</a></td>";
    // Guncellestirme
    echo "<td><a class ='button' href=kutuphaneguncelle.php?id=";
    echo $gelen['KutuphaneNo'];
    echo "&no=";
    echo $gelen['AdresNo'];
    echo ">Güncelle</a></td></tr>";
}
//tablo kodunu bitirme
echo "</table>";
echo "<br/><a class ='bttn' href='_uyesayfasi.php'>Geri Dön </a>";
echo "</html>";

//veritabani baglantisini kapama
mysqli_close($baglanti);
?>
    </body>
</html>
