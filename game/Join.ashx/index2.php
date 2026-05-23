<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/classes/gameUtils.php';
if (isset($_GET["placeId"]))
  {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'rblx15');
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $query = mysqli_query($con,'select gameName,gameDesc,port,gameIp,owner from games where gameId="'.$_GET['placeId'].'"');
    $row = mysqli_fetch_array($query);
}
  
$userid = rand(1, 9999);
$username = null;
$charapp = "http://rb15.us.to/Asset/CharacterFetch.ashx";
$jobid = "Test";
$gameid = null;
$creatorid = 1;
$membership = "None";
$accountAge = 365;
$ip = null;
$port = null;
  
if (isset($_GET["ip"])) {
  $ip = $_GET["ip"];
}
elseif (!isset($_GET["placeId"])) {
   $ip = "127.0.0.1";
}
else {
  $ip = $row["gameIp"];
}

if (isset($_GET["placeId"])) {
  $gameid = $_GET["placeId"];
}
else {
  $gameid = "1818";
}
 
  
if (isset($_GET["port"])) {
  $port = $_GET["port"];
}
elseif (isset($_GET["placeId"])) {
  $port = $row["port"];
}
else {
  $port = "53640";
}
if(isset($_GET['username'])){
$joinscript = array(
  "ClientPort" => 0,
  "MachineAddress" => $ip,
  "ServerPort" => $port,
  "PingUrl" => "",
  "PingInterval" => 30,
  "UserName" => $_GET['username'],
  "SeleniumTestMode" => false,
  "UserId" => $userid,
  "SuperSafeChat" => false,
  "CharacterAppearance" => $charapp,
  "ClientTicket" => gameUtils::GenerateClientTicketv1($userid, $username, $charapp, $jobid),
  "GameId" => $jobid,
  "PlaceId" => 1818,
  "MeasurementUrl" => "",
  "WaitingForCharacterGuid" => "26eb3e21-aa80-475b-a777-b43c3ea5f7d2",
  "BaseUrl" => "http://www.rb15.us.to/",
  "ChatStyle" => "ClassicAndBubble",
  "VendorId" => "0",
  "ScreenShotInfo" => "",
  "VideoInfo" => "",
  "CreatorId" => $creatorid,
  "CreatorTypeEnum" => "User",
  "MembershipType" => $membership,
  "AccountAge" => $accountAge,
  "CookieStoreFirstTimePlayKey" => "rbx_evt_ftp",
  "CookieStoreFiveMinutePlayKey" => "rbx_evt_fmp",
  "CookieStoreEnabled" => true,
  "IsRobloxPlace" => false,
  "GenerateTeleportJoin" => false,
  "IsUnknownOrUnder13" => false,
  "SessionId" => "",
  "DataCenterId" => 69420,
  "UniverseId" => $gameid,
  "BrowserTrackerId" => 0,
  "UsePortraitMode" => false,
  "FollowUserId" => 0
);
}else{
$joinscript = array(
  "ClientPort" => 0,
  "MachineAddress" => $ip,
  "ServerPort" => $port,
  "PingUrl" => "",
  "PingInterval" => 30,
  "UserName" => "Guest " . $userid,
  "SeleniumTestMode" => false,
  "UserId" => $userid,
  "SuperSafeChat" => false,
  "CharacterAppearance" => $charapp,
  "ClientTicket" => gameUtils::GenerateClientTicketv1($userid, $username, $charapp, $jobid),
  "GameId" => $jobid,
  "PlaceId" => 1818,
  "MeasurementUrl" => "",
  "WaitingForCharacterGuid" => "26eb3e21-aa80-475b-a777-b43c3ea5f7d2",
  "BaseUrl" => "http://www.rb15.us.to/",
  "ChatStyle" => "ClassicAndBubble",
  "VendorId" => "0",
  "ScreenShotInfo" => "",
  "VideoInfo" => "",
  "CreatorId" => $creatorid,
  "CreatorTypeEnum" => "User",
  "MembershipType" => $membership,
  "AccountAge" => $accountAge,
  "CookieStoreFirstTimePlayKey" => "rbx_evt_ftp",
  "CookieStoreFiveMinutePlayKey" => "rbx_evt_fmp",
  "CookieStoreEnabled" => true,
  "IsRobloxPlace" => false,
  "GenerateTeleportJoin" => false,
  "IsUnknownOrUnder13" => false,
  "SessionId" => "",
  "DataCenterId" => 69420,
  "UniverseId" => $gameid,
  "BrowserTrackerId" => 0,
  "UsePortraitMode" => false,
  "FollowUserId" => 0
);
}
$joinscript = json_encode($joinscript, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
$joinscript = gameUtils::signv1($joinscript);
header("Content-Type: application/json");
exit($joinscript);