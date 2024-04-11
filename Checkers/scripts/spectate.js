var board;

setInterval(function(){
    window.location.reload(1);
 }, 1000);

window.onload = () => {
    
    DrawBoard(); 
};


function fetchBoard() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'fetchCheckers.php', false);

    xhr.onload = function() {
        if (this.status == 200) {
            let info = JSON.parse(this.responseText);
    
            board = info[0].board;
        }
    }
    xhr.send();
}


function DrawBoard() {
    fetchBoard();
    board = JSON.parse(board);
    console.log(board);
    let tiles = document.querySelector('div.tiles');
    console.log(tiles);
    let tilesCount = 0;
    let chekersCount = 0;

    for (let row in board) {
        let horizontal = document.createElement('div');
        horizontal.classList.add('tileRow');

        for (let col in board[row]) {
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

            if (board[row][col] === 1) {
                checker.classList.add('black');
                tile.appendChild(checker);
                chekersCount++;
            } else if (board[row][col] === 2) {
                checker.classList.add('white');
                tile.appendChild(checker);
                chekersCount++;
            }
        }

        tiles.appendChild(horizontal);
    }
}