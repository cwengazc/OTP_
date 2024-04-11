<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


sleep(10);

require_once("functions.php");

$id = $_SESSION['player']['id'];

$result = db_select('player', "id != $id && rockpaperscissors = 1");

if (count($result) != 0) {

    foreach($result as $key => $value) {
        $_SESSION['opponent'] = $value;

        if ($_SESSION['opponent']['gameId'] != 0) {
            $res = db_select('player', "id = {$id} && gameId = {$_SESSION['opponent']['gameId']}");
        
            if ($res[0]['id'] != null){
                $_SESSION['player']['gameId'] = $_SESSION['opponent']['gameId'];
                header("Location: ../RockPaperScissors/rps.php");
                die();
            }
        }else {
            break;
        }
    }
    
    if ($_SESSION['opponent'] != null && $_SESSION['opponent']['gameId'] == 0) {
        $token = rand(10000, 10000000);

        db_update('player', ['gameId' => $token, 'player' => 2], "id = $id");
        db_update('player', ['gameId' => $token, 'player' => 1], "id = {$_SESSION['opponent']['id']}");

        db_insert('rockpaperscissors', ['player1' => $id, 'player2' => $_SESSION['opponent']['id'], 'gameId' => $token, 'time' => date("h:i:sa"), 'date' => date("Y/m/d")]);
        
        $_SESSION['player']['gameId'] = $token;

        header("Location: ../RockPaperScissors/rps.php");
        die();
    }
}

db_update('player', ["rockpaperscissors" => 0], "id=$id");
header("Location: noMatch.php");
