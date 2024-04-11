<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


sleep(10);

require_once("functions.php");

$id = $_SESSION['player']['id'];

$result = db_select('player', "id != {$id} && checkers = 1");

$_SESSION['opponent']=null;

if (count($result) != 0) {

    foreach($result as $key => $value) {
        $_SESSION['opponent'] = $value;

        if ($_SESSION['opponent']['gameId'] != 0) {
            $res = db_select('player', "id = {$id} && gameId = {$_SESSION['opponent']['gameId']}");
        
            if ($res[0]['id'] != null){
                header("Location: checkers.php");
                die();
            }
        }else {
            break;
        }
    }
    
    if ($_SESSION['opponent'] != null && $_SESSION['opponent']['gameId'] == 0) {
        $token = rand(10000, 10000000);

        db_update('player', ['gameOpp' => $_SESSION['opponent']['username'], 'gameId' => $token, 'gameColor' => 'red'], "id = {$id}");
        db_update('player', ['gameOpp' => $_SESSION['player']['username'], 'gameId' => $token, 'gameColor' => 'blue'], "id = {$_SESSION['opponent']['id']}");

        header("Location: checkers.php");
        die();
    }
}

db_update('player', ["checkers" => 0], "id={$id}");
header("Location: noMatch.php");
