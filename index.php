<?php
if(isset($_POST['longURL'])) {
    
    $servername = "xxx";
    $username = "xxx";
    $password = "xxx";
    $dbname = "xxx";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT code FROM associations WHERE link='".$_POST['longURL']."'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($result);

    if($row){

        $result = mysqli_fetch_assoc($result);
        
        mysqli_close($conn);
        header("Location: https://xx.xx/sl/result?code=" . $result["code"]);
    }
    else{
        function generateRandomCode($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        do{
            $code = generateRandomCode();
            $sql = "SELECT link FROM associations WHERE code='".$code."'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_num_rows($result);
        }
        while($row);
        $sql = "INSERT INTO associations (code, link)
        VALUES ('".$code."', '".$_POST['longURL']."')";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header("Location: https://xx.xx/sl/result?code=" . $code);
        } else {
            echo "Error:<br>" . mysqli_error($conn);
        }

    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Shorter Links</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post">
        <span class="label-text">Long Url:</span>
        <input name="longURL" type="url" placeholder="https://ed0ardo.com/#dev" minlength="22" required/>
        <p class="tip">Press Enter</p>
    </form>
    <a href="https://github.com/Ed0ardo/ShorterLinks/"><button class="github">SOURCE CODE<i class="fa fa-github"></i></button></a>
</body>

</html>