<?php

session_start();
include 'connection.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


sleep(10);

require_once("../functions.php");

$id = $_SESSION['player']['id'];

$result = db_select('player', "id != {$id} && tic_tac_toe = 1");

if (count($result) != 0) {

    foreach($result as $key => $value) {
        $_SESSION['opponent'] = $value;

        if ($_SESSION['opponent']['gameId'] != 0) {
            $res = db_select('player', "id = {$id} && gameIdTTT = {$_SESSION['opponent']['gameId']}");
        

            //Checks if you are already in a game and you can continue
            if ($res[0]['id'] != null){
                $_SESSION['pid'] = $id;
                $_SESSION['gamesessionid'] = $_SESSION['opponent']['gameId'];
                $_SESSION['pltype'] = "sender";
                header("Location: game.php");
                die();
            }
        }else {
            break;
        }
    }
    
    if ($_SESSION['opponent'] != null && $_SESSION['opponent']['gameId'] == 0) {
        $token = rand(10000, 10000000);

        db_update('player', ['gameIdTTT' => $token], "id = {$id}");
        db_update('player', ['gameIdTTT' => $token], "id = {$_SESSION['opponent']['id']}");
        $gameId = $token;
        $gameIdStr = "g" . $gameId;

        //Starts Game Recording Game History
        $connHist = new mysqli($server, $username, $password, $dbnameGH); //TTT History database
        $sqlConn = "CREATE TABLE ".$gameIdStr." (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `box1` int(11) DEFAULT NULL,
            `box2` int(11) DEFAULT NULL,
            `box3` int(11) DEFAULT NULL,
            `box4` int(11) DEFAULT NULL,
            `box5` int(11) DEFAULT NULL,
            `box6` int(11) DEFAULT NULL,
            `box7` int(11) DEFAULT NULL,
            `box8` int(11) DEFAULT NULL,
            `box9` int(11) DEFAULT NULL)";
        $connHist->query($sqlConn);
        $sqlConn = "INSERT INTO  ".$gameIdStr." (`box1`, `box2`, `box3`, `box4`, `box5`, `box6`, `box7`, `box8`, `box9`) VALUES (0,0,0,0,0,0,0,0,0)";
        $connHist->query($sqlConn);
        $connHist->close();
        //Local database (basically just used to reference to other database)
        $sql = "INSERT INTO ".$dbname.".`gameHist`(`sessionid`, `pl1id`, `pl2id`, `gTable`) VALUES (".$gameId.",".$id.",".$_SESSION['opponent']['id'].",'{$gameIdStr}')";
        $conn->query($sql);

        // pl1id is reciever id and pl2 is senderid
        $sql = "INSERT INTO ".$dbname.".`gamesessions`(`sessionid`, `pl1id`, `pl2id`, `box1`, `box2`, `box3`, `box4`, `box5`, `box6`, `box7`, `box8`, `box9`, `pl1scr`, `pl2scr`, `turn`, `count`) VALUES (".$gameId.",".$id.",".$_SESSION['opponent']['id'].",0,0,0,0,0,0,0,0,0,0,0,0,0)";
        $conn->query($sql);
        $sql = "select * from ".$dbname.".gamesessions where pl1id =".$id." and pl2id=".$_SESSION['opponent']['id'];
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $_SESSION['gamesessionid'] = $row['sessionid'];
        }

        $_SESSION['pltype'] = "rec";

        $_SESSION['pid'] = $_SESSION['player']['id'];
        $_SESSION['boxs'] = array(0,0,0,0,0,0,0,0,0);
        header("Location: game.php");
        die();

    }
}

header("Location: noMatch.php");
