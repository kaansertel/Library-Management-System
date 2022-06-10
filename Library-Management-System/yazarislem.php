<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
            <title>| Yazar İşlem |</title>
        
         <style>
body{
    background-color: #ddc08bb0;;
}

#tablo{
                 border-collapse: collapse;
                 width: 50%;
                 
            }
            #tablo td, #tablo th{
                 border: 1px solid black;
                 padding: 8px;
                 font-weight: bold;
                

            }
            #tablo tr:nth-child(even){background-color: #e9ddcfd5;}

            #tablo tr:hover {
                 background-color: #2ecc71;
                 color:#fff;
                 font-weight: bold;
            }

            #tablo th {
                 padding-top: 12px;
                 padding-bottom: 12px;
                 text-align: left;
                background-color: #a08562;
                 color: white;
                 font-weight: bold;
                
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
$sql = " SELECT * FROM Yazarlar";

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

echo "<h1>Yazar Bilgileri</h1>";

echo "<table border=1 id ='tablo'>";
echo "<tr>";
echo "<th>Yazar No</th>";
echo "<th>Yazar Adı</th>";
echo "<th>Yazar Soyadı</th>";
echo "</tr>";

while($gelen=mysqli_fetch_array($cevap)){
    // veritabanindan gelen değerler ile tablo satirlari olusturalim
    echo "<tr><td>".$gelen['YazarNo']." </td>";
    echo "<td>".$gelen['YazarlarAdi']."</td>";
    echo "<td>".$gelen['YazarlarSoyad']."</td>";
    // Guncellestirme
    echo "<td><a class = 'button' href=yazarguncelle.php?id=";
    echo $gelen['YazarNo'];
    echo ">Güncelle</a></td></tr>";
}
//tablo kodunu bitirme
echo "</table>";
echo "<br/><a class = 'bttn' href='_uyesayfasi.php'>Geri Dön </a>";
echo "</html>";

//veritabani baglantisini kapama
mysqli_close($baglanti);
?>

</body>
</html>