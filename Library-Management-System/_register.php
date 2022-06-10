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
            <title>| Admin Ekleme |</title>
            <link rel ="stylesheet"  type="text/css" href="register.css"/>
    </head>     

    <body>
        <div class="form">
            <h2>Admin Ekleme Formu</h2>
            <form action="register.php" method="POST">
                Kullanıcı Adı:    
                <input type="text" name="username" class="inpt"> <br /><br />
                Şifre: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                <input type="password" name="password" class="inpt"> <br /><br /><br />

                <input type="submit" class="button" value="KAYDET"/> <br /> <br />
                <a href="_uyesayfasi.php" class="btn"> Geri Dön </a> 
                    <!-- <a href="_login.php">[Kullanici Girişi] </a> -->

            </form>
        </div>    

    </body>
</html>