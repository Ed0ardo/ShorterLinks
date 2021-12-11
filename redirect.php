<?php
if(isset($_GET["code"])){
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

    $sql = "SELECT link FROM associations WHERE code='".$_GET["code"]."'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($result);

    if($row){
        $result = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        header("Location: " . $result["link"]);
    }
    else{
        header("Location: https://xx.xx/sl");
    }
}
?>