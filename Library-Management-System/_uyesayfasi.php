<?php
// oturumu baslat
session_start();
//eger username adli oturum degiskeni yok ise login sayfasina yönlendir
if (!isset($_SESSION['username'])) {
    header("location:_login.php");
    exit();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
        <link rel="stylesheet" type="text/css" href="uyesayfasi.css"/>
        <title>| Anasayfa |</title>
    </head>

<body>

    <ul>
        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Admin İşlemleri</h3> </a>
                <div class="dropdown-content">
                    <a href= '_register.php'> Admin Oluşturma</a> 
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Üye İşlemleri</h3> </a>
                <div class="dropdown-content">
                    <a href= 'kayitformu.php'> Üye Ekleme</a> <br />
                    <a href= 'listele.php'> Üye Bilgileri</a> <br />
                    <a href= 'silmelistesi.php'> Üye Silme Ve Güncelleme</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Kütüphane İşlemleri</h3> </a>
                <div class="dropdown-content">
                    <a href= 'kutuphane.php'> Kütüphane Ekleme</a> <br />
                    <a href= 'kutuphanelistele.php'> Kütüphane Bilgileri</a> <br />
                    <a href= 'kutuphaneislem.php'> Kütüphane Silme Ve Güncelleme</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Kategori İşlemleri</h3> </a>
                <div class="dropdown-content">
                    <a href= 'kategori.php'> Kategori Ekleme</a> <br />
                    <a href= 'kategorislem.php'> Kategori Silme Ve Güncelleme</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Yazar İşlemleri</h3></a>
                <div class="dropdown-content">
                    <a href= 'yazar.php'> Yazar Ekleme</a> <br />
                    <a href= 'yazarlistele.php'> Yazar Bilgileri</a> <br />
                    <a href= 'yazarislem.php'> Yazar Güncelleme</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Kitap İşlemleri</h3> </a>
                <div class="dropdown-content">
                    <a href= 'kitap.php'> Kitap Oluşturma</a> <br />
                    <a href= 'kitaplistele.php'> Kitap Bilgileri</a> <br />
                    <a href= 'kutuphanekitap.php'> Kütüphaneye Kitap Ekleme</a> <br />
                    <a href= 'kitapislem.php'> Kitap Silme Ve Güncelleme</a> <br />
                    <a href= 'kutuphanekitaplistele.php'> Kütüphane Kitap Bilgileri</a> <br />
                </div>
        </li>

        <li class="dropdown"> 
            <a href="javascript:void(0)" class="dropbtn"> <h3>Kitap Ödünç Alma İşlemleri</h3></a>
                <div class="dropdown-content">
                    <a href= 'emanet.php'> Kitap Ödünç Alma</a> <br />
                    <a href= 'emanetlistele.php'> Kitap Ödünç Bilgileri</a> <br />
                </div>
        </li>

        <li class="dropdown" style="float:right;"> 
                    <a href= '_logout.php'> <h3>Oturumu Kapat </h3> </a>
                
        </li>

        
    </ul>    
</body>
</html>