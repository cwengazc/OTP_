var board;
var pos;

window.onload = () => {
    
    DrawBoard(); 
};

function Prev() {
    decrement();
    setTimeout(function(){
        window.location.reload(1);
     }, 1000);
}

function Next() {
    console.log(pos);
    increment();
    setTimeout(function(){
        window.location.reload(1);
     }, 1000);
}

function increment() {
	
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'processSome.php?pos='+(+pos+1), true);

    xhr.send();
}

function decrement() {
	
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'processSome.php?pos='+(+pos-1), true);

    xhr.send();
}

function fetchPosition() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'fetchCheckers.php', false);

    xhr.onload = function() {
        if (this.status == 200) {
            let info = JSON.parse(this.responseText);
    
            pos = info[0].position;
        }
    }
    xhr.send();
}


function fetchBoard() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'fetchCheckers.php', false);

    xhr.onload = function() {
        if (this.status == 200) {
            let info = JSON.parse(this.responseText);
    
            board = info[0].gameHist;
        }
    }
    xhr.send();
}


function DrawBoard() {
    fetchPosition();
    fetchBoard();
    board = JSON.parse(board);
    console.log(board[0]);
    let tiles = document.querySelector('div.tiles');
    console.log(pos);
    let tilesCount = 0;
    let chekersCount = 0;

    for (let row in board[pos]) {
        let horizontal = document.createElement('div');
        horizontal.classList.add('tileRow');

        for (let col in board[pos][row]) {
            // New tile
            let tile = document.createElement('div');
            tile.classList.add('tile');
            tile.setAttribute('id', 'tile' + tilesCount);
            // Add event to select tile
            // Tooltip to show tile name
            let tooltip = document.createElement('span');
            tooltip.classList.add('tooltiptext');
            tile.appendChild(tooltip);

            horizontal.appendChild(tile);
            tilesCount++;

            // New cheker
            let checker = document.createElement('div');
            checker.classList.add('checker');
            checker.setAttribute('id', chekersCount);
            // Add event to select checker

            if (board[pos][row][col] === 1) {
                checker.classList.add('black');
                tile.appendChild(checker);
                chekersCount++;
            } else if (board[pos][row][col] === 2) {
                checker.classList.add('white');
                tile.appendChild(checker);
                chekersCount++;
            }
        }

        tiles.appendChild(horizontal);
    }
}