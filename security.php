<?php
//load the timeout duration TIMEOUT_IN_SECONDS
require_once("config.php");

//for storing important messages
$messages = array();

if( isset($_SESSION['time-last-active']) ){
    //detemine time now
	$timeNow 		= time();
	//determine time of last request
	$timeLastAcive 	= $_SESSION['time-last-active'];
	//figure the difference
	$timeSinceLastRequest = $timeNow - $timeLastAcive;
    //see if user has exceeded timeout
    if($timeSinceLastRequest > TIMEOUT_IN_SECONDS){		
		//prepare descriptive message
		$_SESSION['messages'] = array("You have been logged out due to inactivity");
		//forward user to logout page
		header("location: logout.php");
		//terminate this script
		die();
	}else{
		//reset the time last active
		//to give user a fresh new timeout duration		
		$_SESSION['time-last-active'] = time();
	}

}else{
    $messages[] = "Please log in to access the content.";
    //save message in session
    $_SESSION['messages'] = $messages;
    //forward user back to the login page
    header("location: index.php");
    die();
}
if( isset($_SESSION['username']) ){
    echo "<p>Hello <strong>".ucfirst(strtolower($_SESSION['username']))."</strong>. Your account is verified</p>";
}

?>