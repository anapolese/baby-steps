

var numberOfSquares = 6;
var colores = [];
var pickedColor;
var resetButton = document.querySelector("#reset");
var h1 = document.querySelector("h1");
var squares = document.querySelectorAll(".square");
var queenColor = document.getElementById("queenColor");
var messageDisplay = document.querySelector("#message");
var modeButtons = document.querySelectorAll(".mode");

queenColor.textContent = pickedColor;

init();

function init() {
	//activate function of buttons
	setUpButtons();
	//activate function in squres
	activSquares();
	//see function reset for more explanations
	reset1();
 }


resetButton.addEventListener("click", function(){
	reset1();
});

function setUpButtons () {
	for(var i = 0; i < modeButtons.length; i++) {
		modeButtons[i].addEventListener("click", function(){
			modeButtons[0].classList.remove("selected");
			modeButtons[1].classList.remove("selected");
			this.classList.add("selected");
			this.textContent === "EASY" ? numberOfSquares = 3: numberOfSquares = 6;
			reset1();
		});
	}
}

function activSquares () {
	for(var i = 0; i < squares.length; i++) {
			//add clicl listeners to squares
		squares[i].addEventListener("click", function () {
			//grab color of clicked square
			var clickedColor = this.style.backgroundColor;
			//COMPARE COLOR TO PICKED COLOR
			if(clickedColor === pickedColor) {
			messageDisplay.textContent = "Congrats!";
			resetButton.textContent = "PLAY AGAIN?";
			h1.style.backgroundColor = clickedColor;
			changeColors(clickedColor);
			} else {
			this.style.backgroundColor = "#232323";
			messageDisplay.textContent = "Sorry... Try Again"
			}
		});
	}
}

function changeColors(color) {
	//loop through all squares
	for (var i = 0; i < squares.length; i++) {
		//change each color to match given color
		squares[i].style.backgroundColor = color;
	}
}



function pickColor() {
	var randomize = Math.floor(Math.random() * colores.length);
	return colores[randomize];
}

function generateRandomColors(num) {
	//make an array
	var arr = []
	//add num random colors to array
	for(var i = 0; i < num; i++) {
		arr.push(randomColor());
	}
	//return that array
	return arr;
}


function randomColor() {
  //pick a "red" from 0 to 255
 var r = Math.floor(Math.random() * 256);
  //pick a "green" from 0 to 255
 var g = Math.floor(Math.random() * 256);
  //pick a "blue" from 0 to 255
 var b = Math.floor(Math.random() * 256);
 return "rgb(" + r + ", " + g + ", " + b + ")";
}

function reset1 () {
	colores = generateRandomColors(numberOfSquares);
	pickedColor = pickColor();
	queenColor.textContent = pickedColor;
	for(var i = 0; i < squares.length; i++) {
		if(colores[i]) {
			squares[i].style.display = "block";
			squares[i].style.backgroundColor = colores[i];
		} else {
			squares[i].style.display = "none";
		}
	}
	h1.style.backgroundColor = "rgba(234, 118, 130, 1)";
	resetButton.textContent = "NEW COLORS";
	messageDisplay.textContent = "";
}
