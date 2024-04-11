<script>
    console.log("wegoin")
</script>


<?php

require_once("../functions.php");

if(isset($_GET['tile'])) {
    $tile = $_GET['tile'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['moveTile' => $tile], "gameId = {$gameId}");
}else if(isset($_GET['checker'])) {
    $checker = $_GET['checker'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['moveChecker' => $checker], "gameId = {$gameId}");
}else if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['checkerId' => $id], "gameId = {$gameId}");
}else if(isset($_GET['start'])) {
    $start = $_GET['start'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['start' => $start], "gameId = {$gameId}");
}else if(isset($_GET['attack'])) {
    $attack = $_GET['attack'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['attack' => $attack], "gameId = {$gameId}");
}else if(isset($_GET['prevC'])) {
    $prevC = $_GET['prevC'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['prevC' => $prevC], "gameId = {$gameId}");
}else if(isset($_GET['board'])) {
    $board = $_GET['board'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['board' => $board], "gameId = {$gameId}");
}else if(isset($_GET['hist'])) {
    $hist = $_GET['hist'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['gameHist' => $hist], "gameId = {$gameId}");
}else if(isset($_GET['pos'])) {
    $pos = $_GET['pos'];
    $gameId = $_SESSION['player']['gameId'];
    // $tile = json_encode($tile);
    db_update('checkers', ['position' => $pos], "gameId = {$gameId}");
}

