const rockBtn = document.getElementById("rock");
const paperBtn = document.getElementById("paper");
const scissorsBtn = document.getElementById("scissors");
const player1NameEl = document.getElementById("player1-name");
const player1ScoreEl = document.getElementById("player1-score");
const player1Choice = document.getElementById("player1-choice");
const player2NameEl = document.getElementById("player2-name");
const player2ScoreEl = document.getElementById("player2-score");
const player2Choice = document.getElementById("player2-choice");
const playArea = document.querySelector(".play-area");
const statusEl = document.getElementById("status-el");
const vsEl = document.getElementById("vs-el");
const startGameBtn = document.getElementById("start-game-btn");
const endGameBtn = document.getElementById("end-game-btn");
const name1Input = document.getElementById("name1-el");
const name2Input = document.getElementById("name2-el");
const rockSymbol = '<i class="fa-solid fa-hand-back-fist"></i>';
const paperSymbol = '<i class="fa-solid fa-hand"></i>';
const scissorsSymbol = '<i class="fa-solid fa-hand-scissors"></i>';
const array = [rockSymbol, paperSymbol, scissorsSymbol];
var player;
var opp;
fetchOpp();
fetchPlayer();
var player1Score = 0;
var player2Score = 0;
var player1Win = false;
var player2Win = false;
var player1Name = player.username;
var player2Name = opp.username;
startGameBtn.classList.add("hidden");


function fetchPlayer() {
  var xhr = new XMLHttpRequest();

  xhr.open("GET", "fetchPlayer.php", false);

  xhr.onload = function () {
    if (this.status == 200) {
      let info = JSON.parse(this.responseText);
      //console.log(xhr.response);
      player = info[0];
      //console.log(player);
      console.log(player);
    }
  };
  xhr.send();
}

function fetchOpp() {
  var xhr = new XMLHttpRequest();

  xhr.open("GET", "fetchOpp.php", false);

  xhr.onload = function () {
    if (this.status == 200) {
      let info = JSON.parse(this.responseText);
      //console.log(xhr.response);
      opp = info[0];
      console.log(opp);
    }
  };
  xhr.send();
}

rockBtn.disabled = true;
paperBtn.disabled = true;
scissorsBtn.disabled = true;


// if (name1Input.value){
//     player1Name = name1Input.value.toUpperCase()
//     } else {
//     player1Name = 'PLAYER 1'}

// if (name2Input.value){
//     player2Name = name2Input.value.toUpperCase()
//     } else {
//     player2Name = 'PLAYER 2'}

player1NameEl.textContent = player1Name;
player2NameEl.textContent = player2Name;
// name1Input.classList.add("hidden")
// name2Input.classList.add("hidden")
vsEl.textContent = "VS";
rockBtn.disabled = false;
paperBtn.disabled = false;
scissorsBtn.disabled = false;
player1ScoreEl.textContent = 0;
player2ScoreEl.textContent = 0;

function renderGame() {
  player1ScoreEl.textContent = 0;
  player2ScoreEl.textContent = 0;

  if (
    player1Choice.innerHTML == rockSymbol &&
    player2Choice.innerHTML == scissorsSymbol
  ) {
    player1Score++;
  } else if (
    player1Choice.innerHTML == paperSymbol &&
    player2Choice.innerHTML == rockSymbol
  ) {
    player1Score++;
  } else if (
    player1Choice.innerHTML == scissorsSymbol &&
    player2Choice.innerHTML == paperSymbol
  ) {
    player1Score++;
  } else if (
    player2Choice.innerHTML == rockSymbol &&
    player1Choice.innerHTML == scissorsSymbol
  ) {
    player2Score++;
  } else if (
    player2Choice.innerHTML == paperSymbol &&
    player1Choice.innerHTML == rockSymbol
  ) {
    player2Score++;
  } else if (
    player2Choice.innerHTML == scissorsSymbol &&
    player1Choice.innerHTML == paperSymbol
  ) {
    player2Score++;
  }

  renderScore();
}

function renderScore() {
  player1ScoreEl.textContent = player1Score;
  player2ScoreEl.textContent = player2Score;
  checkWinner();
}

function checkWinner() {
  if ((player1Score == 2 && player2Score == 0) || player1Score == 3) {
    vsEl.textContent = `${player1Name} WON!`;
    rockBtn.disabled = true;
    paperBtn.disabled = true;
    scissorsBtn.disabled = true;
    player2Win = false;
    player1Win = true;
    reset();
  } else if ((player2Score == 2 && player1Score == 0) || player2Score == 3) {
    vsEl.textContent = `${player2Name} WON!`;
    rockBtn.disabled = true;
    paperBtn.disabled = true;
    scissorsBtn.disabled = true;
    player2Win = true;
    player1Win = false;
    reset();
  }
}

function reset() {
  player1Score = 0;
  player2Score = 0;
  player1Choice.innerHTML = "";
  player2Choice.innerHTML = "";
  startGameBtn.classList.remove("hidden");
  startGameBtn.textContent = `Play Again`;
  startGameBtn.addEventListener("click", () => {

fetchOpp();
fetchPlayer();
var player1Score = 0;
var player2Score = 0;
var player1Win = false;
var player2Win = false;
var player1Name = player.username;
var player2Name = opp.username;
startGameBtn.classList.add("hidden");


function fetchPlayer() {
  var xhr = new XMLHttpRequest();

  xhr.open("GET", "fetchPlayer.php", false);

  xhr.onload = function () {
    if (this.status == 200) {
      let info = JSON.parse(this.responseText);
      //console.log(xhr.response);
      player = info[0];
      //console.log(player);
      console.log(player);
    }
  };
  xhr.send();
}

function fetchOpp() {
  var xhr = new XMLHttpRequest();

  xhr.open("GET", "fetchOpp.php", false);

  xhr.onload = function () {
    if (this.status == 200) {
      let info = JSON.parse(this.responseText);
      //console.log(xhr.response);
      opp = info[0];
      console.log(opp);
    }
  };
  xhr.send();
}

rockBtn.disabled = true;
paperBtn.disabled = true;
scissorsBtn.disabled = true;


// if (name1Input.value){
//     player1Name = name1Input.value.toUpperCase()
//     } else {
//     player1Name = 'PLAYER 1'}

// if (name2Input.value){
//     player2Name = name2Input.value.toUpperCase()
//     } else {
//     player2Name = 'PLAYER 2'}


player1NameEl.textContent = player1Name;
player2NameEl.textContent = player2Name;
// name1Input.classList.add("hidden")
// name2Input.classList.add("hidden")
vsEl.textContent = "VS";
rockBtn.disabled = false;
paperBtn.disabled = false;
scissorsBtn.disabled = false;
player1ScoreEl.textContent = 0;
player2ScoreEl.textContent = 0;
});
  endGameBtn.classList.remove("hidden");
}

rockBtn.addEventListener("click", () => {
  player1Choice.innerHTML = `${rockSymbol}`;
  player2Choice.innerHTML = `${array[Math.floor(Math.random() * 3)]}`;
  renderGame();
});
paperBtn.addEventListener("click", () => {
  player1Choice.innerHTML = `${paperSymbol}`;
  player2Choice.innerHTML = `${array[Math.floor(Math.random() * 3)]}`;
  renderGame();
});
scissorsBtn.addEventListener("click", () => {
  player1Choice.innerHTML = `${scissorsSymbol}`;
  player2Choice.innerHTML = `${array[Math.floor(Math.random() * 3)]}`;
  renderGame();
});
