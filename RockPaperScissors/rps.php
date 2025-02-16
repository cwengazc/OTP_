

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/fe6bf42745.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa&family=Nabla&family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <section id="top-part">
            <section class="score-board">
                <article class="name-banner">
                <h2 id="player1-name">PLAYER 1</h2>
                </article>
                <article class="score-banner">
                    <p id="player1-score">0</p>
                </article>
            </section>
            <section class="around-play-area">
                <section class="play-area">
                    <article id="player1-choice">
                        
                    </article>
                    <span id="status-el">
                        <p id="vs-el">
                            
                        </p>
                       
                       
                        <button class="" id="start-game-btn">
                            Start Game
                        </button>
                        <a href="logout.php">End Game</a> 
                        </button>
                    </span>
                    <article id="player2-choice">
                        
                    </article>
                </section>
            </section>
            <section class="score-board">
                <article class="name-banner">
                <h2 id="player2-name">PLAYER 2</h2>
                </article>
                <article class="score-banner">
                    <p id="player2-score">0</p>
                </article>
            </section>
           
        </section>
        <section id="bottom-part">
            <article class="button"><button id="rock">
                <i class="fa-solid fa-hand-back-fist"></i>
            </button></article>
            <article class="button"><button id="paper">
                <i class="fa-solid fa-hand"></i>
            </button></article>
            <article class="button"><button id="scissors">
                <i class="fa-solid fa-hand-scissors"></i>
            </button></article>
        </section>
    </main>
    <footer>
    
    </footer>
</body>

</html>
