<?php
$username = "root";
$password = "";
$database = "tapeagent";
$_POST = json_decode(file_get_contents("php://input"),true);
switch($_POST['option']){
    case 'POST':
        $rName = $_POST['rName'];
        $yName = $_POST['yName'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $tape = $_POST['tape'];
        $mysqli = new mysqli("localhost", $username, $password, $database);
        $today = date('Y-m-d');
        $query="INSERT INTO tapes(rName, yName, pass, tape, date) VALUES ('{$rName}','{$yName}','{$pass}','{$tape}', '{$today}')";
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
        $query="UPDATE tapes SET link = '{$link}' WHERE id = '{$id}'";
        $mysqli->query("$query");
        $mysqli->close();
        if ($num) {
            echo json_encode(array('success' => 1, 'link' => $link));
        } else {
            echo json_encode(array('success' => 0));
        }
        exit();
    case 'RETRIEVE':
        $link = $_POST['link'];
        $query="SELECT link FROM tapes WHERE link = '{$link}'";
        $mysqli = new mysqli("localhost", $username, $password, $database);
        $result = $mysqli->query("$query");
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            $rows =  $result->fetch_assoc();
            echo json_encode($rows);
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
        if(password_verify($pass, $rows['pass'])){
            echo json_encode($rows);
        }else{
            echo json_encode('fail');
        }
        $mysqli->close();
        exit();
}
?>