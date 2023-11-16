<?php
$data = mysqli_connect('localhost', 'root', '', 'arduino');  
$cun = mysqli_select_db($data, 'arduino');

$get_data = "SELECT * FROM customer";
$query = mysqli_query($data, $get_data);

$fech = mysqli_fetch_object($query);

$password = $fech->password;
$id = $fech->id;
$sqs = "";

if (isset($_GET['send'])) {
    $enteredId = $_GET['idinput'];
    $enteredPassword = $_GET['passwordinput'];

    if ($id == $enteredId && $password == $enteredPassword) {
        $sqs = "tree.php";
        header("Location: $sqs");  
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
   
<div class="container">
    <div class="blur">
        <div class="card">
            <form method="GET" >
                <input type="number" placeholder="Enter your id" name="idinput" required>
                <input type="text" placeholder="Enter your password" name="passwordinput" required>
                <button type="submit" name="send">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
