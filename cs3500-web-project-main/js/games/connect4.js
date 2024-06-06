const PLAYER_ONE = 1
const PLAYER_TWO = 2;

const BOARD_ROW = 6
const BAORD_COL = 7

var currPlayer = PLAYER_ONE;
var nextRow = [5,5,5,5,5,5,5];
var gameOver = false;
var winner = null;

var baordValues = [];


$(function(){
    var board = $("div#board div.row div");
    setBoard(board);
    


    for(tile of board){
        $(tile).click(function(){
            var tileRow = this.id.split("-")[0][1]; 
            var tileCol = this.id.split("-")[1];
            playMove(tileRow, tileCol); 
        });

    
    }

})

function playMove(selectedRow, selectedCol){

    if(!gameOver){
        // Getting Row Number after the effects of the gravity.
        actualRow = nextRow[parseInt(selectedCol)].toString();


        if(actualRow == "-1"){
            alert("Invalid Move");
            return;
        }
        // Setting value of the played tile both for visual and actual boardValue
        $('#t'+actualRow+'-'+selectedCol).addClass(currPlayer == PLAYER_ONE ? "player1" : "player2");
        baordValues[parseInt(actualRow)][parseInt(selectedCol)] = currPlayer;

        // Checking for winner
        chekcWinner();


        currPlayer = currPlayer == PLAYER_ONE ? PLAYER_TWO : PLAYER_ONE;

        nextRow[parseInt(selectedCol)] -= 1;
    }
}



function setBoard(board){

    // Setting the baord to all empty holes in HTMLS
    for(tile of board){
        $(tile).removeClass("player1");
        $(tile).removeClass("player2");
    }

    // Setting the board values to 0

    for (let r = 0; r < BOARD_ROW; r++){
        var row = [];
        for (let c = 0; c < BAORD_COL; c++){
            row.push(0);
        }
        baordValues.push(row);


    } 
}


function chekcWinner(){
    // Horizontal Check
    for(let r=0; r < BOARD_ROW; r++){
        for(let c=0; c < BAORD_COL - 3; c++){
            if(
                baordValues[r][c] != 0 &&
                baordValues[r][c] == baordValues[r][c+1] &&
                baordValues[r][c+1] == baordValues[r][c+2] &&
                baordValues[r][c+2] == baordValues[r][c+3]
            ){
                declareWinner();
                return;            
            }
        }
    }

    // Vertical Cehck
    for(let r=0; r < BOARD_ROW-3; r++){
        for(let c=0; c < BAORD_COL; c++){
            if(
                baordValues[r][c] != 0 &&
                baordValues[r][c] == baordValues[r+1][c] &&
                baordValues[r+1][c] == baordValues[r+2][c] &&
                baordValues[r+2][c] == baordValues[r+3][c]
            ){
                declareWinner();
                return;            
            }
        }
    }

    // Right Diagonal Check
    for(let r=0; r < BOARD_ROW - 3; r++){
        for(let c=0; c < BAORD_COL - 3; c++){
            if(
                baordValues[r][c] != 0 &&
                baordValues[r][c] == baordValues[r+1][c+1] &&
                baordValues[r+1][c+1] == baordValues[r+2][c+2] &&
                baordValues[r+2][c+2] == baordValues[r+3][c+3]
            ){
                declareWinner();
                return;            
            }
        }
    }

    // Left Diagonal Check
    for(let r=3; r < BOARD_ROW; r++){
        for(let c=0; c < BAORD_COL; c++){
            if(
                baordValues[r][c] != 0 &&
                baordValues[r][c] == baordValues[r-1][c+1] &&
                baordValues[r-1][c+1] == baordValues[r-2][c+2] &&
                baordValues[r-2][c+2] == baordValues[r-3][c+3]
            ){
                declareWinner();
                return;            
            }
        }
    }

}

function declareWinner(){
    gameOver = true;
    winner = currPlayer;
}