function checkSide() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'getSide.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			side = info[0].gameColor;
		}
	}
	xhr.send();
}

function checkTurn() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'getSide.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			turn = info[0].turn;
		}
	}
	xhr.send();
}

function checkState() {
	checkTurn();
	checkOpp();

	console.log(game);

	if (game == 0) {
		declareEnd();
	}
		
		if (turn == "white"){
			the_checker = w_checker;
		} else {
			the_checker = b_checker;
		}

	
	fetchOpPrevW();
	fetchOpPrevB();

	console.log(turn);
	console.log(w_prev);
	console.log(b_prev);

	if (side == "blue" && turn == "black" && w_prev != 0) {
		fetchUpRight();
		fetchUpLeft();
		fetchDownRight();
		fetchDownLeft();

		fetchAttack();

		the_checker = w_checker;
		fetchOpMove();
		fetchOpPiece();
		console.log(selectedPieceindex);
		selectedPiece = true;
		makeMove2(indy);
		w_prev = 0;
		getWPrev();
		selectedPieceindex = undefined;
		selectedPiece = undefined;
		the_checker = b_checker;

		upRight = undefined;
		downRight = undefined;
		upLeft = undefined;
		downLeft = undefined;

		mustAttack = false;

		getDownRightL();
		getDownLeftL();
		getUpRightL();
		getUpLeftL();
		getattackL();

		var i;
		var lost = true;
		for(i = 1 ; i <= 12; i++){
			if(the_checker[i].alive){
				lost = false;
			}
		}
		if (lost) {
			setTimeout(declareWinner(),3000);
			return false
		}
	}

    function getUpLeftL() {
	
        var xhr = new XMLHttpRequest();
    
        xhr.open('GET', 'processSome.php?ul='+0, true);
    
        xhr.send();
    }

    function getWPrev() {
	
        var xhr = new XMLHttpRequest();
    
        xhr.open('GET', 'processPrev.php?w_prev='+w_prev, true);
    
        xhr.send();
    }

	if (side == "red" && turn == "white" && b_prev != 0) {
		fetchUpRight();
		fetchUpLeft();
		fetchDownRight();
		fetchDownLeft();

		fetchAttack();

		the_checker = b_checker;
		fetchOpMove();
		fetchOpPiece();
		selectedPiece = true;
		makeMove2(indy);
		b_prev = 0;
		getBPrev();
		selectedPieceindex = undefined;
		selectedPiece = undefined;
		the_checker = w_checker;

		upRight = undefined;
		downRight = undefined;
		upLeft = undefined;
		downLeft = undefined;

		mustAttack = false;

		getDownRightL();
		getDownLeftL();
		getUpRightL();
		getUpLeftL();
		getattackL();

		var i;
		var lost = true;
		for(i = 1 ; i <= 12; i++){
			if(the_checker[i].alive){
				lost = false;
			}
		}
		if (lost) {
			setTimeout(declareWinner(),3000);
			return false
		}
	}
	
}

var intervaling = setInterval(checkState, 1000);