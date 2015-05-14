<?php

class twoThree {

var $prizes = [true, false, false];
// The picks are set to numbers above the length of the prizes array after every pick.
var $firstPick = 5;
var $presentorShows = 5;
var $secondPick = 5;

var $didRepick = 0;
var $didNotRepick = 0;
var $amountStaySuccess = 0;
var $amountChangeSuccess = 0;


// Reset variables and reshuffle the prizes array for ever iteration.
function resetAndRandomize() {
    $this->firstPick = 5;
    $this->presentorShows = 5;
    $this->secondPick = 5;

    shuffle($this->prizes);
}

// The contestant does their first pick.
function pickBefore() {
	$this->firstPick = rand(0,2);
}

// The presentor shows a bad choice that is not the choice the contestant picked.
function presentShowBad() {
	$good = true;
	
	// This loop will only exit if the pick is false one
	while($good) {
		$this->presentorShows = 5;
		// This loop will only exit once the presentorShow variable is different from the first pick.
		do {
			$this->presentorShows = rand(0,2);
		} while($this->presentorShows == $this->firstPick);

		$good = $this->prizes[$this->presentorShows];
	}
}

// It is randomly decided if the contestant repicks or not.
function randomUserRepick() {
	do {
		$this->secondPick = rand(0,2);
	} while($this->secondPick == $this->presentorShows);
	
	if ($this->secondPick == $this->firstPick) {
		$this->didRepick++;
		// Result of not changing pick
		if($this->prizes[$this->secondPick]) {
			$this->amountStaySuccess++;
		}
	} else {
		$this->didNotRepick++;
		// Result of changing pick
		if($this->prizes[$this->secondPick]) {
			$this->amountChangeSuccess++;
		}
	}
	
}

// Run the simulation.
function runSimulation() {
	// Run it 10000 times.
	for ($i = 0; $i < 10000; $i += 1) {
		$this->resetAndRandomize();
		$this->pickBefore();
		$this->presentShowBad();
		$this->randomUserRepick();
	}
	
	echo "Win percentage when not repicking: ".$this->amountStaySuccess/$this->didNotRepick*100;
	echo '<br>';
	echo "Win percentage when repicking: ".$this->amountChangeSuccess/$this->didRepick*100;
}

}

$var = new twoThree();
$var->runSimulation();
?>
