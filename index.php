<?php
if(isset($_POST['longURL']) && filter_var($_POST['longURL'], FILTER_VALIDATE_URL)) {
    
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

    function get_result( $Statement ) {
        $RESULT = array();
        $Statement->store_result();
        for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
            $Metadata = $Statement->result_metadata();
            $PARAMS = array();
            while ( $Field = $Metadata->fetch_field() ) {
                $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
            }
            call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
            $Statement->fetch();
        }
        return $RESULT;
    }

    $longURL = $_POST['longURL'];

    $stmt = $conn->prepare("SELECT code FROM associations WHERE link=?");    
    $stmt->bind_param("s",$longURL);
    $stmt->execute();
    $result = get_result($stmt);
    $stmt->close();

    if(count($result)){
        mysqli_close($conn);
        header("Location: https://ed0.it/sl/result?code=" . $result[0]["code"]);
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
        $stmt = $conn->prepare("INSERT INTO associations (code, link)
        VALUES (?, ?)");    
        $stmt->bind_param("ss", $code, $longURL);

        if ($stmt->execute()) {
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