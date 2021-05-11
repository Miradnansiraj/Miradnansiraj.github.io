<?php
    $serverName = "DESKTOP-9G0Q1C0";
    $connectionInfo = array(
        "Database"=>"USERS",
        "Uid"=>"sa",
        "PWD"=>"1234"
    );
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if($conn){
        //echo "Connection established.";
    }
    else{
        echo "Connection could not be established.";
            die(print_r(sqlsrv_errors(),true));
    }
    $uname;
    $pword;
    if (isset($_POST['username']) && isset($_POST['password'])){
        $tsql= "SELECT username, password FROM users;";
        $getResults= sqlsrv_query($conn, $tsql);
        //echo ("Reading data from table" . PHP_EOL);
        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
            //echo ($row['username'] . " " . $row['password']. PHP_EOL);
            $uname = $row['username'];
            $pword = $row['password'];
        }
        $isName = $_POST['username'] == $uname;
        $ispass = $_POST['password'] == $pword;
        if($isName && $ispass){
            echo 'Login Succesful';
        }
        sqlsrv_free_stmt($getResults);
    }
?>