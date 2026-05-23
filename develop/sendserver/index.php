<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php';
  if(!isset($_SESSION['user'])){
	header("Location: /games/");
}else{

}
// hello, meditation here. i'm too lazy and sick to fix this shit code. if someone here see this, replace it. thanks.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rblx15');
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
  // collect value of input field
  $gamename = $_POST['gamename'];
  $port = $_POST['gameport'];
  $desc = $_POST['gamedesc'];
  $ip = $_POST['gameip'];
  $client = $_POST["client"];
  if($client == "1"){
	 $clientreal = 2015;
  }elseif($client == "2"){
	  $clientreal = 2016;
  }else{
	  $clientreal = 2015;
  }
  if (empty($name) && empty($port) && empty($desc) && empty($ip)) {
    echo "Please put the required fields";
  } else {
    $check = mysqli_query($con,"SELECT * FROM games WHERE LCASE(gamename) = '".htmlspecialchars($_SESSION["user"]["username"])."'"); // This was inspired by Rainway and his crappy system for preventing spam attacks. I DIDNT COPY THIS FROM RAINWAY. INSTEAD I COPIED FROM THIS POST: https://stackoverflow.com/questions/7537366/prevent-users-from-having-the-same-username
    if(mysqli_num_rows($check) == 1){ // checking if user is spamming or already exist the game
    die('game alr uploaded');
    } else {
    $query = $pdo->prepare("INSERT INTO games (gameName, gameDesc, gameIp, port, owner, ownerid, client) VALUES (:gameName, :gameDesc, :gameIp, :port, :owner, :ownerid, :client)");
    $query->execute(["gameName" => $gamename, "gameDesc" => $desc, "gameIp" => $ip, "port" => $port, "owner" => $_SESSION["user"]["username"], "ownerid" => $_SESSION["user"]["id"], "client" => $clientreal]);
    //mysqli_query($con,"INSERT INTO `games` (`gameName`, `gameId`, `gameDesc`, `gameIp`, `port`, `owner`, `ownerid`, `client`) VALUES ('".htmlspecialchars($gamename)."', NULL, '".htmlspecialchars($desc)."', '".$ip."', ".$port.", '".$name."', '".$discord_id."', '".$clientreal."');"); // Adds the game
    
    header("Location: /develop");
    exit("game uploaded succesfully");
	 }
 }
