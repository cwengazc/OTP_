// This is a main file that enables new instance of Game Manager and starts the game

// The only one global variable that we NEED
let gameManager;
var which = 0;

function fetchCheckers() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'fetchPlayer.php', false);

    xhr.onload = function() {
        if (this.status == 200) {
            let info = JSON.parse(this.responseText);
    
            which = info[0].player;
        }
    }
    xhr.send();
}

function getChecker() {
	
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'processSome.php?start='+1, true);

    xhr.send();
}

// When window is loaded
window.onload = () => {
    fetchCheckers();
    getChecker();
    console.log("Start " + which);
    // Create new GameManager
    gameManager = new GameManager(+which, 1);
    // Initialize the game
    gameManager.Initialize();
};