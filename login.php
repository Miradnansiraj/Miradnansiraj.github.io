<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="main.js" type="text/javascript"></script>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-2">
        <a class="navbar-brand h1" href="index.html">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="giphy.html">Giphy API Example</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login Example</a>
              </li>
            </ul>
        </div>
    </nav>
    <div class="card p-1 m-1 w-50 border-dark shadow rounded  text-white bg-info" style="height: 200px;">
        <h4 class="card-header">Login example</h4>
        <form action="login.php" method="post" id="formid">
            <table>
                <tr>
                    <td><h7>username:</h7></td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><h7>password:</h7></td>
                    <td><input type="password" name="password"><br></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Log in"></td>
                </tr>
                <tr><div id="resultText"></div></tr>
            </table>
        </form>
    </div>
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
</body>
</html>