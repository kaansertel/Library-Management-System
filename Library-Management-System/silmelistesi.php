<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
       <title> | Üye Bilgileri | </title>

   <style>
       body{
    background-color: #ddc08bb0;
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
    color: black;
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
            $sql = " SELECT Uyeler.UyeNo, Uyeler.UyeAdi, Uyeler.UyeSoyad, Uyeler.UyeTelefon, Uyeler.UyeEposta, Adresler.AdresNo, Adresler.Ulke, Adresler.Sehir, Adresler.PostaKodu, Adresler.Cadde, Adresler.Mahalle
            FROM ((Uyeler
            INNER JOIN UyeAdres ON Uyeler.UyeNo = UyeAdres.Uyeler_UyeNo)
            INNER JOIN Adresler ON UyeAdres.Adresler_AdresNo = Adresler.AdresNo)";

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

            echo "<h1>Üye Bilgileri</h1>";

            echo "<table border=1 id='tablo'>";
            echo "<tr>";
            echo "<th>Üye No</th>";
            echo "<th>Üye Adı</th>";
            echo "<th>Üye Soyadı</th>";
            echo "<th>Üye Telefon Numarası</th>";
            echo "<th>Üye E-posta</th>";
            echo "<th>Üye AdresNo</th>";
            echo "<th> Ülke </th>";
            echo "<th> Şehir </th>";
            echo "<th>PostaKodu</th>";
            echo "<th>Cadde</th>";
            echo "<th>Mahalle</th>";
            echo "</tr>";

            while($gelen=mysqli_fetch_array($cevap)){
                // veritabanindan gelen değerler ile tablo satirlari olusturalim
                echo "<tr><td>".$gelen['UyeNo']." </td>";
                echo "<td>".$gelen['UyeAdi']."</td>";
                echo "<td>".$gelen['UyeSoyad']."</td>";
                echo "<td>".$gelen['UyeTelefon']."</td>";
                echo "<td>".$gelen['UyeEposta']."</td>";
                echo "<td>".$gelen['AdresNo']."</td>";
                echo "<td>".$gelen['Ulke']."</td>";
                echo "<td>".$gelen['Sehir']."</td>";
                echo "<td>".$gelen['PostaKodu']."</td>";
                echo "<td>".$gelen['Cadde']."</td>";
                echo "<td>".$gelen['Mahalle']."</td>";
                // sil linki olusturma
                echo "<td><a class='button' href=kayitsil.php?id=";
                echo $gelen['UyeNo'];
                echo "&no=";
                echo $gelen['AdresNo'];
                echo ">Sil</a></td>";
                // Guncellestirme
                echo "<td><a class='button' href=guncelle.php?id=";
                echo $gelen['UyeNo'];
                echo "&no=";
                echo $gelen['AdresNo'];
                echo ">Güncelle</a></td></tr>";
            }
            //tablo kodunu bitirme
            echo "</table>";
            echo "<br/><a class='bttn' href='_uyesayfasi.php'>Geri Dön </a>";
            echo "</html>";

            //veritabani baglantisini kapama
            mysqli_close($baglanti);
            ?>
    </body>

</html>
