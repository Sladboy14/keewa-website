<?php
    session_start();
    if($_SESSION['login']==false){
        header('location: login.php');
    }
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["Kategori.html"];
        echo "Halo, $Kategori!";
    }
?>