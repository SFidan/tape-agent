<?php
$username = "root";
$password = "";
$database = "tapeagent";
$_POST = json_decode(file_get_contents("php://input"),true);
switch($_POST['option']){
    case 'POST':
        $many = $_POST['many'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $timer = $_POST['timer'];
        $code1 = $_POST['code1'];
        $code2 = $_POST['code2'];
        $tape = encrypt_decrypt('encrypt', $_POST['tape'], $code1, $code2);
        $yName = encrypt_decrypt('encrypt', $_POST['yName'], $code1, $code2);
        $rName = encrypt_decrypt('encrypt', $_POST['rName'], $code1, $code2);
        $mysqli = new mysqli("localhost", $username, $password, $database);
        if ($mysqli->connect_error) {
            echo json_encode("Connection failed: " . $mysqli->connect_error);
        } 
        $today = date('Y-m-d', time() + 86400*3);
        $query="INSERT INTO tapes(rName, yName, pass, tape, date, many, timer) VALUES ('{$rName}','{$yName}','{$pass}','{$tape}', '{$today}', '{$many}', '{$timer}')";
        $mysqli->query("$query");
        $num =  $mysqli->affected_rows;
        $random = array();
        $id =  $mysqli->insert_id;
        $link = "";
        for ($i = 0; $i < 10;$i++){
            switch(rand(1,3)){
                case 1;
                $random[$i] = rand(48,57);
                break;
                case 2;
                $random[$i] = rand(65,90);
                break;
                case 3;
                $random[$i] = rand(97,122);
                break;
            }
        };
        foreach($random as $A){
            $A = chr($A);
            $link .= $A;
        }
        $link = "-".$id.$link;
        $query2="UPDATE tapes SET link = '{$link}' WHERE id = '{$id}'";
        $mysqli->query("$query2");
        $mysqli->close();
        if ($num) {
            echo json_encode(array('success' => 1, 'link' => $link));
        } else {
            echo json_encode(array('success' => 0));
        }
        exit();
    case 'RETRIEVE':
        $link = $_POST['link'];
        $query="SELECT link, many FROM tapes WHERE link = '{$link}'";
        $mysqli = new mysqli("localhost", $username, $password, $database);
        $result = $mysqli->query("$query");
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            $rows =  $result->fetch_assoc();
            if($rows['many'] >= 1){
                if(isset($_COOKIE[$link])){
                    echo json_encode('noViews');
                }else{
                    echo json_encode($rows);
                }
            }
        }else{
            echo json_encode('fail');
        }
        $mysqli->close();
        exit();
    case 'VERIFY':
        $link = $_POST['link'];
        $pass = $_POST['pass'];
        $query="SELECT * FROM tapes WHERE link = '{$link}'";
        $mysqli = new mysqli("localhost", $username, $password, $database);
        $result = $mysqli->query("$query");
        $numRows = mysqli_num_rows($result);
        $rows =  $result->fetch_assoc();
        $date = $rows['date'];
        $date = date(strtotime($date . ' +1 day'));
        if(password_verify($pass, $rows['pass'])){
            $rows['yName'] = encrypt_decrypt('decrypt',  $rows['yName'], $_POST['code1'], $_POST['code2']);
            $rows['rName'] = encrypt_decrypt('decrypt',  $rows['rName'], $_POST['code1'], $_POST['code2']);
            $rows['tape'] = encrypt_decrypt('decrypt',  $rows['tape'], $_POST['code1'], $_POST['code2']);
            if($rows['tape'] == false || $rows['yName'] == false || $rows['rName'] == false ){
                echo json_encode('dFailed');
            }else{
                echo json_encode($rows);
                if($rows['many'] <= 1){
                    $query="DELETE FROM tapes WHERE link = '{$link}'";
                }else{
                    $query="UPDATE tapes SET many = many-1 WHERE link = '{$link}'";
                }
                if($rows['many'] > 1){
                    setcookie($link,"1",$date);
                }
                $mysqli->query("$query");
            }
        }else{
            echo json_encode('fail');
        }
        $mysqli->close();
        exit();
}
function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else {
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    }
    return $output;
}
?>