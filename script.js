
/*=========global variables=========================*/
var turn;
var side;
var opponent = false;
var indy;

var game = 1;

var w_prev = 0;
var b_prev = 0;

checkSide();
console.log(side);

var square_class = document.getElementsByClassName("square");

var white_checker_class = document.getElementsByClassName("white_checker");
var black_checker_class = document.getElementsByClassName("black_checker");

var table = document.getElementById("table");
var score = document.getElementById("score");
var end = document.getElementById("end");

var black_background = document.getElementById("black_background");
var moveSound = document.getElementById("moveSound");
var winSound = document.getElementById("winSound");
var endSound = document.getElementById("endSound");

var windowHeight = window.innerHeight
				|| document.documentElement.clientHeight
				|| document.body.clientHeight;

var windowWidth =  window.innerWidth
				|| document.documentElement.clientWidth
				|| document.body.clientWidth;

var moveLength = 80 ;
var moveDeviation = 10;
var Dimension = 1;

var selectedPiece, selectedPieceindex;
var upRight, upLeft, downLeft, downRight;  // all possible moves for a piece

var contor = 0, gameOver = 0;
var bigScreen = 1;

var block = [];
var w_checker = [];
var b_checker = [];
var the_checker;

var oneMove;
var anotherMove;

var mustAttack = false;
var multiplier = 1 // 2 if he jumps 1 piece

var tableLimit, reverse_tableLimit,  moveUpLeft, moveUpRight, moveDownLeft, moveDownRight, tableLimitLeft, tableLimitRight;

/*================================*/
	getDimension();
	if(windowWidth > 640){
		moveLength = 80;
		moveDeviation = 10;
	}
	else{
		moveLength = 50;
		moveDeviation = 6;
	}

/*================class declaration=========*/

var square_p = function(square, index){
	this.id = square;
	this.ocupied = false;
	this.pieceId = undefined;
	this.id.onclick = function() {
		makeMove(index);
	}
}

var checker = function(piece, color, square) {
	this.id = piece;
	this.color = color;
	this.king = false;
	this.ocupied_square = square;
	this.alive = true;
	this.attack = false;

	if(square%8){
		this.coordX= square%8;
		this.coordY = Math.floor(square/8) + 1;
	}else{
		this.coordX = 8;
		this.coordY = square/8;
	}

	this.id.onclick = function() {
		showMoves(piece);	
	}
}

checker.prototype.setCoord = function(X,Y){
	var x = (this.coordX - 1) * moveLength + moveDeviation;
	var y = (this.coordY - 1) * moveLength  + moveDeviation;
	this.id.style.top = y + 'px';
	this.id.style.left = x + 'px';
}

checker.prototype.changeCoord = function(X,Y){
	this.coordY += Y;
	this.coordX += X;
}

checker.prototype.checkIfKing = function() {
	if(this.coordY == 8 && !this.king && this.color == "white"){
		this.king = true;
		this.id.style.border = "4px solid #FFFF00";
	}
	if(this.coordY == 1 && !this.king && this.color == "black"){
		this.king = true;
		this.id.style.border = "4px solid #FFFF00";
	}
}

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

/*===============Initialization of playing fields =================================*/


for (var i = 1; i <=64; i++)
	block[i] = new square_p(square_class[i], i);

/*==================================================*/


/*================checkers initialization =================================*/

// red pieces

for (var i = 1; i <= 4; i++){
	w_checker[i] = new checker(white_checker_class[i], "white", 2*i - 1);
	w_checker[i].setCoord(0,0);
	block[2*i - 1].ocupied = true;
	block[2*i - 1].pieceId = w_checker[i];
}

for (var i = 5; i <= 8; i++){
	w_checker[i] = new checker(white_checker_class[i], "white", 2*i);
	w_checker[i].setCoord(0,0);
	block[2*i].ocupied = true;
	block[2*i].pieceId = w_checker[i];
}

for (var i = 9; i <= 12; i++){
	w_checker[i] = new checker(white_checker_class[i], "white", 2*i - 1);
	w_checker[i].setCoord(0,0);
	block[2*i - 1].ocupied = true;
	block[2*i - 1].pieceId = w_checker[i];
}

// blue pieces

for (var i = 1; i <= 4; i++){
	b_checker[i] = new checker(black_checker_class[i], "black", 56 + 2*i);
	b_checker[i].setCoord(0,0);
	block[56 + 2*i ].ocupied = true;
	block[56 + 2*i ].pieceId = b_checker[i];
}

for (var i = 5; i <= 8; i++){
	b_checker[i] = new checker(black_checker_class[i], "black", 40 + 2*i - 1);
	b_checker[i].setCoord(0,0);
	block[40 + 2*i - 1].ocupied = true;
	block[40 + 2*i - 1].pieceId = b_checker[i];
}

for (var i = 9; i <= 12; i++){
	b_checker[i] = new checker(black_checker_class[i], "black", 24 + 2*i);
	b_checker[i].setCoord(0,0);
	block[24 + 2*i].ocupied = true;
	block[24 + 2*i].pieceId = b_checker[i];
}

/*========================================================*/



/*================SELECTING A PIECE==============*/


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

function checkOpp() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'getSide.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			game = info[0].checkers;
		}
	}
	xhr.send();
}

function fetchOpMove() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			indy = info[0].move;
		}
	}
	xhr.send();
}

function fetchOpPrevW() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			w_prev = info[0].w_prev;
		}
	}
	xhr.send();
}

function fetchOpPrevB() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			b_prev = info[0].b_prev;
		}
	}
	xhr.send();
}

function fetchOpPiece() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			selectedPieceindex = info[0].pieceIndex;
		}
	}
	xhr.send();
}

function fetchUpRight() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			upRight = info[0].upRight;
		}
	}
	xhr.send();
}

function fetchDownRight() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			downRight = info[0].downRight;
		}
	}
	xhr.send();
}

function fetchUpLeft() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			upLeft = info[0].upLeft;
		}
	}
	xhr.send();
}

function fetchDownLeft() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);
	
			downLeft = info[0].downLeft;
		}
	}
	xhr.send();
}

function fetchAttack() {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'fetchOpMove.php', false);

	xhr.onload = function() {
		if (this.status == 200) {
			info = JSON.parse(this.responseText);

			if (info[0].attack == 0) {
				mustAttack = false;
			}else {
				mustAttack = true;
			}
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

function getUpLeftL() {
	
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?ul='+0, true);

	xhr.send();
}

function getattackL() {
	
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?at='+0, true);

	xhr.send();
}

function getUpRightL() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?ur='+0, true);

	xhr.send();
}

function getDownLeftL() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?dl='+0, true);

	xhr.send();
}

function getDownRightL() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?dr='+0, true);

	xhr.send();
}

var intervaling = setInterval(checkState, 1000);

function showMoves(piece) {
	
	/* if a track was previously selected, we delete its tracks by updating not the tracks to the new track voter	*/


	// else if (side == "red" && the_checker[1].color == 'black') {
	// 	fetchOpMove();
	// 	console.log(index);
	// 	makeMove2(index);
	// }
	
	var match = false;
	mustAttack = false;

	if(selectedPiece){
		erase_roads(selectedPiece);
	}

	selectedPiece = piece;

	var i, j; // retain the queen index

	for (j = 1; j <= 12; j++){

		if(the_checker[j].id == piece){
			i = j;
			selectedPieceindex = j;
			match = true;
		}
	}

	if(oneMove && !attackMoves(oneMove)){										// check what it does
		changeTurns(oneMove);
		oneMove = undefined;
		return false;
	}
	if(oneMove && oneMove != the_checker[i] ){
		return false;
	}

	if(!match) {
	 return 0; // if no match was found; it happens when, for example, red moves and you press blue
	}

	/*===now, depending on their color, I set the edges and the queen's movements===*/

	if(the_checker[i].color =="white"){
		tableLimit = 8;
		tableLimitRight = 1;
		tableLimitLeft = 8;
		moveUpRight = 7;
		moveUpLeft = 9;
		moveDownRight = - 9;
		moveDownLeft = -7;
	}
	else{
		tableLimit = 1;
		tableLimitRight = 8;
		tableLimitLeft = 1;
		moveUpRight = -7;
		moveUpLeft = -9;
		moveDownRight = 9;
		moveDownLeft = 7;
	}
 	/*===========CHECKING IF I CAN ATTACK====*/


		attackMoves(the_checker[i]); // check if I have any attack moves
	

	/*========IF I CAN'T ATTACK I CHECK IF I CAN GO======*/

 	if(!mustAttack){
		
		downLeft = checkMove(the_checker[i], tableLimit, tableLimitRight, moveUpRight, downLeft);
		downRight = checkMove( the_checker[i], tableLimit, tableLimitLeft, moveUpLeft, downRight);

		if(the_checker[i].king){
			upLeft = checkMove(the_checker[i], reverse_tableLimit, tableLimitRight, moveDownRight, upLeft);
			upRight = checkMove(the_checker[i], reverse_tableLimit, tableLimitLeft, moveDownLeft, upRight);
		}
	}

	if(downLeft || downRight || upLeft || upRight){
		return true;
	}

	return false;
}


function erase_roads(piece){
	if(downRight) block[downRight].id.style.background = "#8c1394";
	if(downLeft) block[downLeft].id.style.background = "#8c1394";
	if(upRight) block[upRight].id.style.background = "#8c1394";
	if(upLeft) block[upLeft].id.style.background = "#8c1394";
}
		
/*=============MOVING THE PIECE======*/

function getWPrev() {
	
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processPrev.php?w_prev='+w_prev, true);

	xhr.send();
}

function getBPrev() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processPrev.php?b_prev='+b_prev, true);

	xhr.send();
}

function getUpLeft() {
	
	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?ul='+upLeft, true);

	xhr.send();
}

function getUpRight() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?ur='+upRight, true);

	xhr.send();
}

function getDownLeft() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?dl='+downLeft, true);

	xhr.send();
}

function getDownRight() {

	var xhr = new XMLHttpRequest();

	xhr.open('GET', 'processSome.php?dr='+downRight, true);

	xhr.send();
}

function getAttack() {

	var xhr = new XMLHttpRequest();

	var num = 0;

	if (mustAttack){
		num = 1;
	}

	xhr.open('GET', 'processSome.php?at='+num, true);

	xhr.send();
}


function makeMove(index) {

	function getMove() {
	
		var xhr = new XMLHttpRequest();
	
		xhr.open('GET', 'processMove.php?move='+index, true);

		w_prev = index;

		xhr.send();
	}

	function getOpMove() {
	
		var xhr = new XMLHttpRequest();
	
		xhr.open('GET', 'processMove.php?move='+index, true);

		b_prev = index;

		xhr.send();
	}

	function getPiece() {
	
		var xhr = new XMLHttpRequest();
	
		xhr.open('GET', 'processPiece.php?piece='+selectedPieceindex, true);

		xhr.send();
	}

	if (side == "red" && the_checker[1].color == 'white') {
		getMove();
		getWPrev();
		getPiece();
		getUpLeft();
		getUpRight();
		getDownLeft();
		getDownRight();
		getAttack();
	}

	if (side == "blue" && the_checker[1].color == 'black') {
		getOpMove();
		getBPrev();
		getPiece();
		getUpLeft();
		getUpRight();
		getDownLeft();
		getDownRight();
		getAttack();
	}

	var isMove = false;

	if(!selectedPiece) // if the game has started and no piece has been selected
		return false;

	if(index != upLeft && index != upRight && index != downLeft && index != downRight){
		erase_roads(0);
		selectedPiece = undefined;
		return false;
	}

 /* ========= the perspective is of the player who moves ======*/
	if(the_checker[1].color=="white"){
		cpy_downRight = upRight;
		cpy_downLeft = upLeft;
		cpy_upLeft = downLeft;
		cpy_upRight = downRight;
	}
	else{
		cpy_downRight = upLeft;
		cpy_downLeft = upRight;
		cpy_upLeft = downRight;
		cpy_upRight = downLeft;
	}  

	if(mustAttack)  // to know if I skip only one row or 2
		multiplier = 2;
	else
		multiplier = 1;


		if(index == cpy_upRight){
			isMove = true;	
				
			if(the_checker[1].color=="white"){
				// move the piece
				executeMove(multiplier * 1, multiplier * 1, multiplier * 9);

				//remove the piece if a jump was executed
				if(mustAttack) eliminateCheck(index - 9);
			}
			else{
				executeMove(multiplier * 1, multiplier * -1, multiplier * -7);
				if(mustAttack) eliminateCheck(index + 7);
			}
		}

		if(index == cpy_upLeft){
			isMove = true;

			if(the_checker[1].color=="white"){
				executeMove(multiplier * -1, multiplier * 1, multiplier * 7);
			 	if(mustAttack)	eliminateCheck(index - 7);				
			}
			else{
				executeMove(multiplier * -1, multiplier * -1, multiplier * -9);
				if (mustAttack) eliminateCheck(index + 9);
			}
		}

		if(the_checker[selectedPieceindex].king){

			if(index == cpy_downRight){
				isMove = true;

				if(the_checker[1].color=="white"){
					executeMove(multiplier * 1, multiplier * -1, multiplier * -7);
					if(mustAttack) eliminateCheck (index  + 7) ;
				}
				else{
					executeMove(multiplier * 1, multiplier * 1, multiplier * 9);
					if(mustAttack) eliminateCheck ( index  - 9);
				}
			}

		if(index == cpy_downLeft){
			isMove = true;
				if(the_checker[1].color=="white"){
					executeMove(multiplier * -1, multiplier * -1, multiplier * -9);
					if(mustAttack) eliminateCheck (index  + 9);
				}
				else{
					executeMove(multiplier * -1, multiplier * 1, multiplier * 7);
					if(mustAttack) eliminateCheck ( index  - 7);
				}
			}
		}

	erase_roads(0);
	the_checker[selectedPieceindex].checkIfKing();

	// I change the turn
	if (isMove) {
		playSound(moveSound);
		anotherMove = undefined;

		if(mustAttack) {
		 	anotherMove = attackMoves(the_checker[selectedPieceindex]);
		}

		if (anotherMove){
			oneMove = the_checker[selectedPieceindex];
			showMoves(oneMove);
		}
		else{

			oneMove = undefined;
		 	changeTurns(the_checker[1]);
			 
		 	gameOver = checkIfLost();
		 	if(gameOver) { setTimeout( declareWinner(),3000 ); return false};
		 	gameOver = checkForMoves();
		 	if(gameOver) { setTimeout( declareWinner() ,3000) ; return false};
		}
	}

	
}

function makeMove2(index) {

	index = parseInt(index);

	var isMove = false;

	if(!selectedPiece) // if the game has started and no piece has been selected
		return false;

	if(index != upLeft && index != upRight && index != downLeft && index != downRight){
		erase_roads(0);
		selectedPiece = undefined;
		return false;
	}

 /* ========= the perspective is of the player who moves ======*/
	if(the_checker[1].color=="white"){
		cpy_downRight = upRight;
		cpy_downLeft = upLeft;
		cpy_upLeft = downLeft;
		cpy_upRight = downRight;
	}
	else{
		cpy_downRight = upLeft;
		cpy_downLeft = upRight;
		cpy_upLeft = downRight;
		cpy_upRight = downLeft;
	}  

	if(mustAttack) {
		multiplier = 2;
	} // to know if I skip only one row or 2
	else
		multiplier = 1;


		if(index == cpy_upRight){
			isMove = true;	
				
			if(the_checker[1].color=="white"){
				// move the piece
				executeMove(multiplier * 1, multiplier * 1, multiplier * 9);

				//remove the piece if a jump was executed
				if(mustAttack) eliminateCheck(index - 9);
			}
			else{
				console.log("Dafuq");
				console.log(mustAttack);
				console.log(multiplier);
				executeMove(multiplier * 1, multiplier * -1, multiplier * -7);
				if(mustAttack  || multiplier == 2) {
					eliminateCheck(index + 7);
				}
			}
		}

		if(index == cpy_upLeft){
			isMove = true;

			if(the_checker[1].color=="white"){
				executeMove(multiplier * -1, multiplier * 1, multiplier * 7);
			 	if(mustAttack)	eliminateCheck(index - 7);				
			}
			else{
				console.log('Dafuq');
				console.log(mustAttack);
				console.log(multiplier);
				executeMove(multiplier * -1, multiplier * -1, multiplier * -9);
				if (mustAttack  || multiplier == 2) {
					eliminateCheck(index + 9);
				} 
			}
		}

		if(the_checker[selectedPieceindex].king){

			if(index == cpy_downRight){
				isMove = true;

				if(the_checker[1].color=="white"){
					executeMove(multiplier * 1, multiplier * -1, multiplier * -7);
					if(mustAttack) eliminateCheck(index  + 7) ;
				}
				else{
					console.log("Dafuq");
					console.log(mustAttack);
					console.log(multiplier);
					executeMove(multiplier * 1, multiplier * 1, multiplier * 9);
					if(mustAttack  || multiplier == 2) {
						eliminateCheck(index  - 9);
					} 
				}
			}

		if(index == cpy_downLeft){
			isMove = true;
				if(the_checker[1].color=="white"){
					executeMove(multiplier * -1, multiplier * -1, multiplier * -9);
					if(mustAttack) eliminateCheck(index  + 9);
				}
				else{
					console.log("Dafuq");
					console.log(mustAttack);
					console.log(multiplier);
					executeMove(multiplier * -1, multiplier * 1, multiplier * 7);
					if(mustAttack  || multiplier == 2) {
						eliminateCheck(index  - 7);
					}
				}
			}
		}

	//erase_roads(0);
	the_checker[selectedPieceindex].checkIfKing();

	// I change the turn
// 	if (isMove) {
// 		playSound(moveSound);
// 		anotherMove = undefined;

// 		if(mustAttack) {
// 		 	anotherMove = attackMoves(the_checker[selectedPieceindex]);
// 		}

// 		if (anotherMove){
// 			oneMove = the_checker[selectedPieceindex];
// 			showMoves(oneMove);
// 		}
// 		else{
// 			oneMove = undefined;
// 		 	changeTurns(the_checker[1]);
// 		 	gameOver = checkIfLost();
// 		 	if(gameOver) { setTimeout( declareWinner(),3000 ); return false};
// 		 	gameOver = checkForMoves();
// 		 	if(gameOver) { setTimeout( declareWinner() ,3000) ; return false};
// 		}
// 	}
}

/*===========MOVING THE PIECE - CHANGING THE COORDINATES======*/

function executeMove(X, Y, nSquare) {

	// change the coordinates of the moved piece
	the_checker[selectedPieceindex].changeCoord(X, Y); 
	the_checker[selectedPieceindex].setCoord(0,0);

	// I release the field the piece occupies and occupy the one it will occupy
	block[the_checker[selectedPieceindex].ocupied_square].ocupied = false;	

	block[the_checker[selectedPieceindex].ocupied_square + nSquare].ocupied = true;
	block[the_checker[selectedPieceindex].ocupied_square + nSquare].pieceId = 	block[the_checker[selectedPieceindex].ocupied_square].pieceId;
	block[the_checker[selectedPieceindex].ocupied_square].pieceId = undefined; 	
	the_checker[selectedPieceindex].ocupied_square += nSquare;
}

function checkMove(Apiece, tLimit, tLimit_Side, moveDirection, theDirection){

	if(Apiece.coordY != tLimit){

		if(Apiece.coordX != tLimit_Side && !block[Apiece.ocupied_square + moveDirection].ocupied){
			block[Apiece.ocupied_square + moveDirection].id.style.background = "#500b94";
			theDirection = Apiece.ocupied_square + moveDirection;
		}
		else
			theDirection = undefined;
	}
	else
		theDirection = undefined;

	return theDirection;
}



function  checkAttack(check , X, Y , negX , negY, squareMove, direction){

	if(check.coordX * negX >= X * negX && check.coordY * negY <= Y * negY && block[check.ocupied_square + squareMove].ocupied && block[check.ocupied_square + squareMove].pieceId.color != check.color && !block[check.ocupied_square + squareMove * 2].ocupied){
		mustAttack = true;
		direction = check.ocupied_square +  squareMove*2;
		block[direction].id.style.background = "#7db2a9";
	}
	else
		direction =  undefined;
	
	return direction;
}

function eliminateCheck(indexx){
	if (side == "red") {
		console.log(indexx);
	}

	if(indexx < 1 || indexx > 64)
		return  0;

	if (side == "red") {
		console.log("Killed");
	}	

	var x = block[indexx].pieceId;
	x.alive = false;
	block[indexx].ocupied = false;
	x.id.style.display  = "none";
}

 	
function attackMoves(ckc){

 	upRight = undefined;
 	upLeft = undefined;
 	downRight = undefined;
 	downLeft = undefined;

 	if(ckc.king){

 		if(ckc.color == "white"){
			upRight = checkAttack(ckc, 6, 3, -1, -1, -7, upRight);
			upLeft = checkAttack(ckc, 3, 3, 1, -1, -9, upLeft);
		}
		else{
	 		downLeft = checkAttack(ckc, 3, 6, 1, 1, 7, downLeft);
			downRight = checkAttack(ckc, 6, 6, -1, 1, 9, downRight);		
		}
	}

	if(ckc.color == "white"){
	 	downLeft = checkAttack(ckc, 3, 6, 1, 1, 7, downLeft);
		downRight = checkAttack(ckc, 6, 6, -1, 1, 9, downRight);
	}
	else{
		upRight = checkAttack(ckc, 6, 3, -1, -1, -7, upRight);
		upLeft = checkAttack(ckc, 3, 3, 1, -1, -9, upLeft);
	}
 	
 	if(ckc.color == "black" && (upRight || upLeft || downLeft || downRight)) {
	 	var p = upLeft;
	 	upLeft = downLeft;
	 	downLeft = p;

	 	p = upRight;
	 	upRight = downRight;
	 	downRight = p;

	 	p = downLeft ;
	 	downLeft = downRight;
	 	downRight = p;

	 	p = upRight ;
	 	upRight = upLeft;
	 	upLeft = p;
 	}

 	if(upLeft != undefined || upRight != undefined || downRight != undefined || downLeft != undefined){
 		return true;
 	}

 	return false;
}

function serverTurn(c) {
	var xhr = new XMLHttpRequest();
	
	xhr.open('GET', 'processTurn.php?turn='+c, true);

	xhr.send();
}

function changeTurns(ckc){

	if(ckc.color=="white"){
		the_checker = b_checker;
		serverTurn("black");
	}	
	else {
		the_checker = w_checker;
		serverTurn("white");
	}
}

function checkIfLost(){
	var i;
	for(i = 1 ; i <= 12; i++)
		if(the_checker[i].alive)
			return false;
	return true;
}

function checkForMoves(){
	var i ;
	for(i = 1 ; i <= 12; i++)
		if(the_checker[i].alive && showMoves(the_checker[i].id)){
			erase_roads(0);
			return false;
		}
	return true;
}

function declareWinner(){
	playSound(winSound);
	black_background.style.display = "inline";
	score.style.display = "block";

if(the_checker[1].color == "white")
	score.innerHTML = "Blue wins";
else
	score.innerHTML = "Red wins";
}

function declareEnd(){
	playSound(endSound);
	black_background.style.display = "inline";
	end.style.display = "block";

	clearInterval(intervaling);
}

function playSound(sound){
	if(sound) sound.play();
}


function getDimension (){
	contor++;

	windowHeight = window.innerHeight
				|| document.documentElement.clientHeight
				|| document.body.clientHeight;  
	windowWidth =  window.innerWidth
				|| document.documentElement.clientWidth
				|| document.body.clientWidth;
}




document.getElementsByTagName("BODY")[0].onresize = function(){

	getDimension();
	var cpy_bigScreen = bigScreen ;

if(windowWidth < 650){
		moveLength = 50;
		moveDeviation = 6; 
		if(bigScreen == 1) bigScreen = -1;
	}
if(windowWidth > 650){
		moveLength = 80;
		moveDeviation = 10; 
		if(bigScreen == -1) bigScreen = 1;
	}

	if(bigScreen !=cpy_bigScreen){
	for(var i = 1; i <= 12; i++){
		b_checker[i].setCoord(0,0);
		w_checker[i].setCoord(0,0);
	}
	}
}