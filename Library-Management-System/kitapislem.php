<html>
    <head>
  <!--  <link href="listele.css" rel="stylesheet" type="text/css" /> -->
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
            <title>| Kitap İşlem |</title>

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
        $sql = "SELECT Kitaplar.ISBN, Kitaplar.KitapAdi, Kitaplar.KitapYayinTarihi, Yazarlar.YazarlarAdi, Yazarlar.YazarlarSoyad, Kategoriler.KategoriAdi, KitapKategori.Kitap_Kategori_Gecis_Id, KitapYazar.Kitap_Yazar_Gecis_Id 
		        FROM ((((Kitaplar
                INNER JOIN KitapYazar ON Kitaplar.ISBN = KitapYazar.Kitaplar_ISBN) 
                INNER JOIN Yazarlar ON KitapYazar.Yazarlar_YazarNo = Yazarlar.YazarNo)
                INNER JOIN KitapKategori ON Kitaplar.ISBN = KitapKategori.Kitaplar_ISBN)
                INNER JOIN Kategoriler ON KitapKategori.Kategoriler_KategoriNo = Kategoriler.KategoriNo)
                ORDER BY ISBN";

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

        echo "<h1>Kitap Bilgileri</h1>";

        echo "<table border =1px id='tablo'>";
        echo "<tr >";
        echo "<th>ISBN</th>";
        echo "<th>Kitap Adı</th>";
        echo "<th>Kitap Yayın Tarihi</th>";
        echo "<th>Yazar Adı</th>";
        echo "<th>Yazar Soyadı</th>";
        echo "<th>Kategori</th>";
        echo "</tr>";

        while($gelen=mysqli_fetch_array($cevap)){
            // veritabanindan gelen değerler ile tablo satirlari olusturalim
            echo "<tr><td>".$gelen['ISBN']." </td>";
            echo "<td>".$gelen['KitapAdi']."</td>";
            echo "<td>".$gelen['KitapYayinTarihi']."</td>";
            echo "<td>".$gelen['YazarlarAdi']."</td>";
            echo "<td>".$gelen['YazarlarSoyad']."</td>";
            echo "<td>".$gelen['KategoriAdi']."</td>";

            // sil linki olusturma
            echo "<td><a class='button' href=kitapsil.php?id=";
            echo $gelen['ISBN'];
            echo "&KategoriNo=";
            echo $gelen['Kitap_Kategori_Gecis_Id'];
            echo "&YazarNo=";
            echo $gelen['Kitap_Yazar_Gecis_Id'];
            echo ">Sil</a></td>";

            // Guncellestirme
            echo "<td><a class='button' href=kitapguncelle.php?id=";
            echo $gelen['ISBN'];
            echo "&KategoriNo=";
            echo $gelen['Kitap_Kategori_Gecis_Id'];
            echo "&YazarNo=";
            echo $gelen['Kitap_Yazar_Gecis_Id'];
            echo ">Güncelle</a></td></tr>";
        }
        //tablo kodunu bitirme
        echo "</table>";
        echo "<br/><a href='_uyesayfasi.php' class='bttn'>Geri Dön </a>";
        echo "</html>";

        //veritabani baglantisini kapama
        mysqli_close($baglanti);
        ?>

    </body>    
</html>