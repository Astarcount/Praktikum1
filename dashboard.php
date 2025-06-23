<?php
session_start();
if (!isset($_SESSION['username'])) {
     
    header("Location: login.php");
        exit();

}

$username = $_SESSION['username'];

$file = "login_count_{$username}.txt";

if (file_exists($file)) {
    $count = (int)file_get_contents($file);
} else {
    $count = 0;
}

$count++;

file_put_contents($file, $count);

if(!isset($_SESSION["daftar"])){
    $_SESSION["daftar"] = [];
}

if(isset($_POST["nama"]) && isset($_POST["umur"])){
    $daftar = [
        "nama" => $_POST["nama"],
        "umur" => $_POST["umur"]
    ];
    $_SESSION["daftar"][] = $daftar;
}


?>
<html>
    <head>
        <title>::Login Page::</title>
        <style type="text/css">
            body{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-size: cover;
                background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
            }
            table{
                background-color: white;
                border: 3px solid grey;
                padding: 20px;
                border-radius: 10px;
                font-family:Arial, Helvetica, sans-serif;
                cursor: pointer;
            }
            td{
                padding: 5px;
            }
            button{
                background-color: greenyellow;
                padding: 10px;
                border-radius: 5px;
            }
            #logout{
                background-color: red;
                cursor: pointer;

            }
        </style>
    </head>
    <body>
        <h1>
        <form action="dashboard.php" method="post">
         <table>
            <tr>
                <td colspan="2" style="text-align: center;" >DAFTAR</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" /></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><input type="number" name="umur" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" >SUBMIT</button>
                    <a href="logout.php">
                        <button id="logout" type="button" >LOGOUT</button>
                    </a>
                </td>
            </tr>
        </table>
        <table border="1"> 
            <tr>
                <td>Nama</td>
                <td>Umur</td>
                <td>Keterangan</td>
                <td>Aksi</td>
            </tr>
                <?php foreach($_SESSION["daftar"] as $index => $daftar_item): ?>
            <tr>
                <td><?php echo $daftar_item["nama"] ?></td>
                <td><?php echo $daftar_item["umur"] ?></td>
                <td>
                    <?php
                    switch (true) {
                    case ($daftar_item["umur"] >= 0 && $daftar_item["umur"] <= 13):
                    echo "Anak-anak";
                    break;
                    case ($daftar_item["umur"] >= 14 && $daftar_item["umur"] <= 25):
                    echo "Remaja";
                    break;
                    case ($daftar_item["umur"] > 25 && $daftar_item["umur"] <= 40):
                    echo "Dewasa";
                    break;
                    case ($daftar_item["umur"] > 40 && $daftar_item["umur"] <= 60):
                    echo "Tua";
                    break;
                    case ($daftar_item["umur"] > 60):
                    echo "Lansia";
                    break;
                    }
                    ?>
                </td>
                <td>
                    <a href="hapus.php?kunci=<?php echo $index; ?>">hapus</a>
                </td>
            </tr>
                 <?php endforeach; ?>
        </table>
        </form>    
        <?php echo "Selamat datang " . $username . " ke-" . $count  ; ?>
        </h1>`
    </body>
</html>