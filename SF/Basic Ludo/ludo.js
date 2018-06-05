
var time = 3 ;
var playerA = new Array( 0 , 0 ); /* Position of player A */
var playerB = new Array( -1 , -1 ); /* Position of player B */
var turn_around = new Array( 0 , 0 ); /* special counter for B to check already crossed position 1 */
var typo = 0; /* Dont forget to differentiate between A and B for move out or on */ 
var global_turn = 0; /* making the roll value global */
var move_count = 0; /* Can't remember why created */
var pointA = 0; /* how many reached the end position */
var pointB = 0; /* how many reached the end position */
var six_count = 0 ; /* to limit roll of 6 to max 2 times */
var extract = 0; /* My variable is my variable , none of your variable */

/* Till now no use of start_play() , later it will be implemented as tutorial part */
function start_play() {
	document.getElementById('play').style.display = "block";
	alert(playerB[0]);
	}
/* Main roll_it() function transfered to move() function*/
function roll_it() {
	/*alert("Real time is "+time);*/
		var x = math.random();
		var y=0;
		move_count = 1;
		do {
			if (x < 0.166 ) {
				y= 1; }
			else if (x < 0.333) {
				y= 2; }
			else if (x < 0.50) { 
				y= 3; }
			else if (x < 0.666) {
				y= 4; }
			else if (x < 0.833) {
				y= 5; }
			else {
				y= 6;
			}
			if ( y == 6 ) {
				six_count = six_count + 1 ;
			} else {
				six_count = 0 ;
			}
			if (six_count == 6 ) {
				alert("sorry");
				six_count = 0;
			}
		} while ( six_count > 2);
		
		
		
		if (document.roll_input.roll_in.value != 0) {
			y = Number(document.roll_input.roll_in.value) ;
		}
		document.getElementById("print").innerHTML = y;
		if ((time % 2) == 0 ) {
			/*alert('Player B gets '+y);*/
			document.getElementById("player_id2").innerHTML = "B";
			move("B",y);
			}
		else {
			/*alert('Player A gets '+y);*/
			document.getElementById("player_id2").innerHTML = "A";
			move("A",y);
			}
		if ((time % 2) == 0) {}
		
		
		if (y == 6) {
		
		}
		else {
			if (((time % 2) == 0) && (typo == 1)) {
				/*alert("typo is "+typo+" time is "+time);*/
				typo = 0;
			} else if (((time % 2) == 1 ) && (typo == 2)) {
				/*alert("typo is "+typo+" time is "+time);*/
				typo = 0;
			} else {
				time = time + 1;
			}
		}
		
		if ((time % 2) == 0 ) {
			document.getElementById("player_id").innerHTML = "Now player B's roll";
		}
		else {
			document.getElementById("player_id").innerHTML = "Now player A's roll";
		}
		/*alert("Roll over time is "+time);*/
	}
/* Transfer to show() or last_show() or hide roll_it() + starts move_on() and move_out() */
function move(player,turn) {
	if (player == "B") {
		if ((playerB[0] == -1 )&&(playerB[1] == -1 )) {
			if (turn == 6) {
				playerB[0] = 15 ;
				/*alert("yepout0 "+playerB[0]);*/
				show(15);
				document.getElementById('no_playerB').innerHTML = "1";
			}
		}
		else if (playerB[1] == -1) {
			if (playerB[0] != -1) {
				if (turn == 6) {
					document.getElementById("roll").style.display = "none";
					global_turn = turn;
					if (playerB[1] == -1) {
						document.getElementById("chatboxB").style.display = "block";
					}
				}
				else {
					if ((playerB[0] > 7 ) && (playerB[0] < 14)){
						alert("Critical");
						last_show(0,playerB[0],turn);
					}
					else {
						playerB[0] =playerB[0] + turn;
						del_show(playerB[0] - turn);
						if (playerB[0] > 28) {
							playerB[0] = playerB[0] - 28;
							
						}
						/*alert("yep0 "+playerB[0]);*/
						
						show(playerB[0]);
					}
				}
				
			}
		} else if (playerB[0] == -1) {
			if (playerB[1] != -1) {
				if (turn == 6) {
					document.getElementById("roll").style.display = "none";
					global_turn = turn;
					if (playerB[0] == -1) {
						document.getElementById("chatboxB").style.display = "block";
					}
				}
				else {
					if ((playerB[1] > 7 ) && (playerB[1] < 14)){
						alert("Critical");
						last_show(1,playerB[1],turn);
					}
					else {
						playerB[1] =playerB[1] + turn;
						del_show(playerB[1] - turn);
						if (playerB[1] > 28) {
							playerB[1] = playerB[1] - 28;
							
						}
						/*alert("yep0 "+playerB[1]);*/
						
						show(playerB[0]);
					}
				}
				
			}
		} else if ((playerB[1] != -1) && (playerB[0] != -1)) {
			document.getElementById("roll").style.display = "none";
			global_turn = turn;
			typo = 1;
		}
	}
	else if (player == "A") {
		if ((playerA[0] == 0 )&&(playerA[1] == 0 )) {
			if (turn == 6) {
				playerA[0] = 1 ;
				/*alert("yepout1 "+playerA[0]);*/
				show(1);
				document.getElementById('no_playerA').innerHTML = "1";
			}
		} else if (playerA[1] == 0) {
			if (playerA[0] != 0) {
				if (turn == 6) {
					document.getElementById("roll").style.display = "none";
					global_turn = turn;
					if (playerA[1] == 0) {
						document.getElementById("chatboxA").style.display = "block";
					}
				}
				else {
					if ((playerA[0] > 21 ) && (playerA[0] < 28)){
						alert("Critical");
						last_show(1,playerA[0],turn);
					}
					else {
						playerA[0] =playerA[0] + turn;
						del_show(playerA[0] - turn);
						/*alert("yep0 "+playerA[0]);*/
						
						show(playerA[0]);
					}
				}
				
			}
		}  else if (playerA[0] == 0) {
			if (playerA[1] != 0) {
				if (turn == 6) {
					document.getElementById("roll").style.display = "none";
					global_turn = turn;
					if (playerA[0] == 0) {
						document.getElementById("chatboxA").style.display = "block";
					}
				}
				else {
					if ((playerA[1] > 21 ) && (playerA[1] < 28)){
						alert("Critical");
						last_show(1,playerA[1],turn);
					}
					else {
						playerA[1] =playerA[1] + turn;
						del_show(playerA[1] - turn);
						/*alert("yep1 "+playerA[1]);*/
						
						show(playerA[1]);
					}
				}
			}
		} else if ((playerA[1] != 0) && (playerA[0] != 0)) {
			document.getElementById("roll").style.display = "none";
			global_turn = turn;
			typo = 2;
			/*alert("caution");*/
		}
	}
	/*alert("move over " + time);*/
	extract = 0;
}
function move_on(position) {
	if (global_turn == 0) { return;}
	move_count = 0;
	/*alert("move on start time is "+time);*/
	
	if ((position == playerB[0]) && (( time % 2) == 0 )) {
		
		if (playerB[1] != position ) {
			del_show(position);
		}
		else {
			document.getElementById(position).innerHTML = " 1 B";
		}
		if (extract == 1 ) {
			show(position);
		}
		if ((playerB[0] > 8 ) && (playerB[0] < 14)){
			alert("Critical");
			last_show(0,playerB[0],global_turn);
			if (extract == 1) {
				move("B",global_turn);
			}
		}
		else {
			playerB[0] =playerB[0] + global_turn;
			if (playerB[0] > 28) {
				playerB[0] = playerB[0] - 28;		
			}
			/*alert("yep0 "+playerB[0]);*/
			show(playerB[0]);
		}
		if (global_turn != 6 ) {
			time = time + 1;
		}
		global_turn = 0;
		document.getElementById("roll").style.display = "block";
		document.getElementById("chatboxB").style.display = "none";
	}
	else if ((position == playerB[1])  && (( time % 2) == 0 )) {
		
		if ((playerB[1] > 8 ) && (playerB[1] < 15)){
			alert("Critical");
			last_show(1,playerB[1],global_turn);
			if (extract == 1) {
				move("B",global_turn);
			}
		}
		else {
			playerB[1] =playerB[1] + global_turn;
			del_show(playerB[1] - global_turn);
			if (playerB[1] > 28) {
				playerB[1] = playerB[1] - 28;		
			}
			/*alert("yep0 "+playerB[1]);*/
			show(playerB[1]);
		}
		del_show(position);
		if (extract == 1 ) {
			show(position);
		}
		if (playerB[1] > 28) {
			playerB[1] = playerB[1] - 28;
		}
		/*alert("yep1 "+playerB[1]);*/
		if (global_turn != 6 ) {
			time = time + 1;
		}		
		global_turn = 0;
		document.getElementById("roll").style.display = "block";
		document.getElementById("chatboxB").style.display = "none";
	}
	else if ((position == playerA[0])  && (( time % 2) == 1 )) {
		
		
		if (playerA[1] != position ) {
			del_show(position);
		} else {
			document.getElementById(position).innerHTML = " 1 A";
		}
		if (extract == 1 ) {
			show(position);
		}
		if ((playerA[0] > 21 ) && (playerA[0] < 28)){
			alert("Critical");
			last_show(0,playerA[0],global_turn);
			if (extract == 1) {
				move("A",global_turn);
			}
		}
		else {
			playerA[0] =playerA[0] + global_turn;
			/*alert("yep0 "+playerA[0]);*/
			show(playerA[0]);
		}
		if (global_turn != 6 ) {
			time = time + 1;
		}
		global_turn = 0;
		document.getElementById("roll").style.display = "block";
		document.getElementById("chatboxA").style.display = "none";
	}
	else if ((position == playerA[1])  && (( time % 2) == 1 )) {
		/*alert("problem is here");*/
		if ((playerA[1] > 21 ) && (playerA[1] < 28)){
			alert("Critical");
			last_show(1,playerA[1],global_turn);
			if (extract == 1) {
				move("A",global_turn);
			}
		}
		else {
			/*alert("here also");*/
			playerA[1] =playerA[1] + global_turn;
			del_show(playerA[1] - global_turn);
			/*alert("yep1 "+playerA[1]);*/
			show(playerA[1]);
		}
		del_show(position);
		if (extract == 1 ) {
			show(position);
		}
		/*alert("yep1 "+playerA[1]);*/
		if (global_turn != 6 ) {
			time = time + 1;
		}
		global_turn = 0;
		document.getElementById("roll").style.display = "block";
		document.getElementById("chatboxA").style.display = "none";

	}
	else {
		alert("Error !!!! Error !!! hkrcuibykeutgvkwvuguuywnkcgunmkvu4v "+position+"time :"+time);
	}
	
	
	if ((time % 2) == 0 ) {
		document.getElementById("player_id").innerHTML = "Now player B's roll";
	}
	else {
		document.getElementById("player_id").innerHTML = "Now player A's roll";
	}
	/*alert("move on over " + time);*/
}
/* MOving out from locker */
function move_out(player) {
	if (global_turn !=6 ) { return;}
	
	if (global_turn == 6 ) {
		if ((player == 'B') && (( time % 2) == 0 )){
			if (playerB[1] == -1 ) {
				/*alert("move out");*/
				playerB[1] = 15;
				show(15);
				document.getElementById('no_playerB').innerHTML = "0";
			}
			document.getElementById("chatboxB").style.display = "none";
			move_count = 0;
			document.getElementById("roll").style.display = "block";
			/*global_turn = 0;*/
		}
		else if ((player == 'A') && (( time % 2) == 1 )) {
			if (playerA[1] == 0) {
				/*alert("move out");*/
				playerA[1] = 1;
				show(1);
				document.getElementById('no_playerA').innerHTML = "0";
			}
			document.getElementById("chatboxA").style.display = "none";
			move_count = 0;
			document.getElementById("roll").style.display = "block";
			/*global_turn = 0*/
		}
		else {
			alert("move out error!!!");
		}
	}
	/*alert("move out time is "+time);*/
	
}

/* Showing position of players 

also controls the cut / eaten properties 
*/

function show(position) {
	/*alert("position is "+position);
	alert("time is "+time);*/
	/* Determinig Player B or A */
	if (( time % 2)== 0 ) { 
		if (playerB[0] == playerB[1]) {
			document.getElementById(position).innerHTML = " 2 B";
		} else {
			document.getElementById(position).innerHTML = " 1 B";
		}
		/*Determinig eaten properties */
		if (position == playerA[0]) {
			if (playerA[1] == 0) {
				document.getElementById('no_playerA').innerHTML = "2";
			} else {
				document.getElementById('no_playerA').innerHTML = "1";
			}
			playerA[0] = player[1];
			playerA[1] = 0; /* Position swaping of 0 and 1 */
		} else if (position == playerA[1]) {
			playerA[1] = 0;
			if (playerA[0] == 0) {
				document.getElementById('no_playerA').innerHTML = "2";
			} else {
				document.getElementById('no_playerA').innerHTML = "1";
			}
		}
	} else {
		if (playerA[0] == playerA[1]) {
			document.getElementById(position).innerHTML = " 2 A";
		} else {
			document.getElementById(position).innerHTML = " 1 A";
		}
		if (position == playerB[0]) {
			if (playerB[1] == 0) {
				document.getElementById('no_playerB').innerHTML = "2";
			} else {
				document.getElementById('no_playerB').innerHTML = "1";
			}
			playerB[0] = playerB[1];
			playerB[1] = -1;
		} else if (position == playerB[1]) {
			playerB[1] = -1;
			if (playerB[0] == -1) {
				document.getElementById('no_playerB').innerHTML = "2";
			} else {
				document.getElementById('no_playerB').innerHTML = "1";
			}
		}
	}
	
	/*alert("after time is "+time);*/
}
function del_show(position) {
	document.getElementById(position).innerHTML = " ";
}
function last_show(type,position,turn) {
	/*alert("position is "+position);
	alert("turn is "+turn);*/
	if ((time % 2) == 0 ) {
		if ((position + turn) < 14 ) {
			del_show(position);
			if (type == 0 ) {
				playerB[0] = position + turn;
				show(position+turn);
			}
			else {
				playerB[1] = position + turn;
				show(position+turn);
			}
		}
		else if ((position + turn ) == 14) {
			del_show(position);
			
			pointB = pointB + 1;
			document.getElementById("scoreB").innerHTML = pointB;
			if (pointB == 2) {
				alert("Woo ha Player B wins the game");
			}
			else {
				alert("Woo One of Player B is inside win");
				if (position = playerB[0]) {
					playerB[0] = playerB[1];
				}
				playerB[1] = -1;
			}
		}
		else {
			alert("ops missed " + time);
		}
	}
	else {
		if ((position + turn) < 28 ) {
			del_show(position);
			if (type == 0 ) {
				playerA[0] = position + turn;
				show(position+turn);
			}
			else {
				playerA[1] = position + turn;
				show(position+turn);
			}
		}
		else if ((position + turn ) == 28) {
			del_show(position);
			pointA = pointA + 1;
			document.getElementById("scoreB").innerHTML = pointA;
			if (pointA == 2) {
				alert("Woo ha Player A wins the game");
			}
			else {
				alert("Woo One of Player A is inside win");
				if (position = playerA[0]) {
					playerA[0] = playerA[1];
				}
				playerA[1] = -1;
			}
		}
		else {
			alert("ops missed " + time);
			extract = 1 ;
		}
		
	} 
}
/*Not needed */
function eaten() {
	
}
