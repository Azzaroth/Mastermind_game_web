<?php

session_start();

function generateSequence() {

	$ballColors = array("red","yellow","purple","blue","green","pink");
	$arr = [];

	for ($i = 0; $i < 4; $i++) {
		$irand = rand(0, 5);
		array_push($arr, $ballColors[$irand]);
	}

	return $arr;
}

if($_POST) {
	if(isset($_SESSION["rule"])) {
		session_unset();
}
} else if($_GET) {

	$full = 0;
	$half = 0;

	if(!isset($_SESSION["rule"])) {
		$_SESSION["rule"] = generateSequence();
}

	$one = $_GET["select-one"];
	$two = $_GET["select-two"];
	$three = $_GET["select-three"];
	$four = $_GET["select-four"];

	if($one == $_SESSION["rule"][0])
		$full++;

	if($two == $_SESSION["rule"][1])
		$full++;

	if($three == $_SESSION["rule"][2])
		$full++;

	if($four == $_SESSION["rule"][3])
		$full++;

	for($i = 0; $i < 4; $i++) {

		if($one == $_SESSION["rule"][$i] && $one != 999) {
			$half++;
			$one = 999;
		}

		else if($two == $_SESSION["rule"][$i] && $two != 999) {
			$half++;
			$two = 999;
		}

		else if($three == $_SESSION["rule"][$i] && $three != 999) {
			$half++;
			$three = 999;
		}

		else if($four == $_SESSION["rule"][$i] && $four != 999) {
			$half++;
			$four = 999;
		}

	}

	$half = $half - $full;

	$returnArray = array($_GET["select-one"],$_GET["select-two"],$_GET["select-three"],$_GET["select-four"],$half,$full);

	$jsonReq = json_encode($returnArray);

	echo $jsonReq;

}


?>