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

    $stmt = $conn->prepare("SELECT link FROM associations WHERE code=?");    
    $stmt->bind_param("s",$_GET["code"]);
    $stmt->execute();
    $result = get_result($stmt);
    $stmt->close();

    if(count($result)){
        mysqli_close($conn);
        header("Location: " . $result[0]["link"]);
    }
    else{
        mysqli_close($conn);
        header("Location: https://ed0.it/sl");
    }
}
?>