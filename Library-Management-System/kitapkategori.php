<?php
//oturumu baslat
session_start();
//eger username adli oturum degiskeni yoksa login sayfasina yönlendir
if (!isset($_SESSION['username'])) {
    header("location:_login.php");
    exit();
}
//mysql baglanti kodunu ekleme
include("mysqlbaglan.php");

//degiskenleri formdan aliyoruz
if (isset($_POST["ISBN"],$_POST["KategoriNo"])) {
    
    $ISBN=$_POST["ISBN"];
    $KategoriNo=$_POST["KategoriNo"];


    echo "<html>";
    //türkçe karakterleri düzgün görüntüleyebilmek için eklenmiştir.
    echo "<meta http-equiv='Content-Type' ";
    echo "content='text/html; charset=UTF-8' />";
    
        
    //KitapKategori ekleme sorgusunu hazirliyoruz      
    $sql=  "INSERT INTO KitapKategori". 
            "(Kitaplar_ISBN,Kategoriler_KategoriNo)". 
            "VALUES ('$ISBN','$KategoriNo')";

    //Sorgulari veritabanina gönderiyoruz
    $cevap= mysqli_query($baglanti,$sql);
    
    //Eger cevap FALSE ise HATA yazdiriyoruz
    if ((!$cevap)) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }if ($cevap) {
        echo "<h1 class='h_1'> Kitap  Kategori Bilgileri Veritabanına Eklendi.<br /> <br /> <br /><a class = 'btn' href= '_uyesayfasi.php'> Ana Sayfa</a>
        <a class = 'btn' href= 'kitap.php'> Geri dön </a> <br /></h1>";
    }
    
    echo "</html>";

    //VeriTabani baglantisini kapatiyoruz.
    mysqli_close($baglanti);
}
?>

<html>
<!-- türkçe karakter destegi ayari -->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <title> | Kategori Oluşturma| </title>
        <style>
            body{
                background-color: #ddc08bb0;
            }
            .btn{
                background-color:#deb887;
                border: solid thin ;
                color: #8b4513;
                padding: 10px;
                text-decoration: none;
              /*  margin-top: 10px;*/
                font-weight: bold;
                font-size: 18px;
                
            }
            
            .h_1{
                background-color:#a08562;
                width: 450px;
                margin: auto;
                margin-top:40px;
                padding: 20px;
                font-size: 20px;
                font-weight: bold;
                border-radius: 15px;
                border: solid thin #000; 
                text-align: center;
            }
        </style>

    </head>    

    <body>
       
    
    </body>
</html>