<?php 
session_start();
require ('_mysqlbaglan.php');

if (isset($_POST['username']) and isset($_POST['password'])) {
    extract($_POST);

    $password=hash('sha256', $password);
    $sql = "SELECT * FROM kullanicilar WHERE kullaniciadi='$username' and sifre='$password'";
    
    $cevap = mysqli_query($baglanti,$sql);
    // eger cevap FALSE ise HATA yazdiriyoruz.
    if (!$cevap) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }
    //veritabanindan dönen satir sayisini bulma
    $say = mysqli_num_rows($cevap);
    if ($say == 1) {
        $_SESSION['username'] = $username;
    }else{
        $mesaj="<h1>Hatali kullanici adi veya şifre! </h1>";
    }
    
} 

if (isset($_SESSION['username'])) {
    header("location:_uyesayfasi.php");
}else {
    //Oturum yok ise giris ekrani görüntülenir
} 
?>

<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8";/>
    <title> Admin | Giriş Paneli </title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
   
</head>
    
<body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
    
<?php
if (isset($mesaj)) {
echo $mesaj;
}
?>
    
        <div class= "form">
            <h2>Admin Giriş Paneli</h2>
            <input type="text" name="username" placeholder="Kullanıcı adınızı giriniz">  
            <br /> <br />
             <input type="password" name="password" placeholder="Şifrenizi giriniz">   
            <br /> <br /> <br />
            <input type="submit" class="buton" value="Giriş Yap"/> <br /> <br />

        </div>

<!-- <a href="_register.php"> [Kayit Ol] </a> -->
    </form>
</body>
</html>