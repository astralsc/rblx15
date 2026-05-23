<?php
  ob_start();
  include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php'; 
  pageBuilder::buildHeader();
  $Guest_Name = "Guest".rand(1, 9999);
  $FindGames = $pdo->prepare('select * from games where gameId="'.$_GET['id'].'"');
  $FindGames->execute();
  $gametype = null;
  if(!isset($_SESSION['user'])){
	
}else{
extract($_SESSION['userData']);
}
  if(isset($_SESSION['user'])){
	$username = ($name);
  }
  //if ($_SERVER["HTTP_USER_AGENT"], "ROBLOX Android App") == true){
	//  header("Location: /games/list");
  //}
  $row = $FindGames->fetchAll(PDO::FETCH_ASSOC)[0];
  if($row["client"] == 2015){
    $gametype = "join()";
    }else{
      $gametype = "join2016()";
	}
    //exit($gametype . "working on 2016 games");
  if (!isset($row["gameName"]))
  {
    // just do a 404 page
    header("Location: /errors/404.html");
    exit;
  }
  else if (!isset($_GET['id']))
  {
    // just do a 404 page
    header("Location: /errors/404.html");
    exit;
  }
?>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true"/>
  <title>
  <?php echo $row['gameName']?> - rblx15
</title>
    
<body data-bs-theme="dark">

                <div class="card mx-auto" style="
    width: 50rem;
">
  <div class="card-body">

            
    <div class="col-md-9"><h1><?php echo $row['gameName']; ?></h1><h3>by <?php echo $row['owner']?></h3></div>
        
        


    
        
        
    <div class="mx-auto col-sm-7">
      <!--<img src="https://cdn.rb15.us.to/1bc0eecbf9203e4e6aaf81a7ca635c62.png" alt="Game Image" title="Game Image" class="img-fluid"></div><div class="mx-auto col-sm-7"><br>-->
      <img src="/images/Unnaproved.png" alt="Game Image" title="Game Image" class="img-fluid"></div><div class="mx-auto col-sm-7"><br>
    
    <div class="row"> <div class="col-sm-6 text-center"><h5>Description</h5> <p><?php echo $row['gameDesc'] ?></p></div><div class="col-sm-6 text-center"><style>.checked { color: orange; }</style><h5>Rating</h5> 
<div id="stars"><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span></div>


<script defer>
              //const gameIp = "<?= $row['gameIp'] ?>";
              const placeId = <?= $_GET['id'] ?>;
              //const port = <?= $row['port'] ?>; // old systems
	    <?php
		//hopefully this works..
	    if(isset($_SESSION['user'])){ // meanwhile, we are not using the Cookie, since its broken. asked one of the team and no one did respond. so i'll use the older method sadly.
			echo('const username = "'.urlencode($_SESSION['user']['username']).'";');
			echo('const userid = "'.$_SESSION['user']['id'].'";');
		echo' ';
		echo'	
        function join() {
              const placeLauncher = `https%3A%2F%2Fwww.rb15.us.to%2Fgame%2FPlaceLauncher.ashx%2F%3FplaceId%3D${placeId}%26username%3D${username}%26id%3D${userid}`;
              const joinArgs = `rblx15-player-rb15:1+launchmode:play+gameinfo:'.time().'+launchtime:17020401369379+placelauncherurl:${placeLauncher}+browsertrackerid:197870394468`;
              window.location.href = joinArgs;
        }
		
					
        function join2016() {
              const placeLauncher = `https%3A%2F%2Fwww.rb15.us.to%2Fgame%2FPlaceLauncher.ashx%2F%3FplaceId%3D${placeId}%26username%3D${username}%26id%3D${userid}`;
              const joinArgs = `rblx16-player-rb15:1+launchmode:play+gameinfo:'.time().'+launchtime:17020401369379+placelauncherurl:${placeLauncher}+browsertrackerid:197870394468`;
              window.location.href = joinArgs;
        }
		';
		}else{
			echo'	
        function join() {
              const placeLauncher = `https%3A%2F%2Fwww.rb15.us.to%2Fgame%2FPlaceLauncher.ashx%2F%3FplaceId%3D${placeId}`;
              const joinArgs = `rblx15-player-rb15:1+launchmode:play+gameinfo:0+launchtime:17020401369379+placelauncherurl:${placeLauncher}+browsertrackerid:197870394468`;
              window.location.href = joinArgs;
        }
		
					
          function join2016() {
              const placeLauncher = `https%3A%2F%2Fwww.rb15.us.to%2Fgame%2FPlaceLauncher.ashx%2F%3FplaceId%3D${placeId}`;
              const joinArgs = `rblx16-player-rb15:1+launchmode:play+gameinfo:0+launchtime:17020401369379+placelauncherurl:${placeLauncher}+browsertrackerid:197870394468`;
              window.location.href = joinArgs;
        }
		';
		}
		?>
</script>
<div class="text-center"> 
<?php
echo'
<button onclick="'.$gametype.'" class="btn btn-success me-md-3">Play</button>
'; 
			 if(isset($_SESSION['user'])){ 
			 if($row['ownerid'] == $discord_id){
				 echo('<a class="btn btn-primary" href="/edit.php?id='.$_GET['id'].'">Edit</a>'); 
				 }
				 } /* lmao, i did this on my phone */ 
				 ?></div></div></div>
    </div>



          </form>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        Requesting Server...
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <br><br><br><br>
        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
</div>
        <br>
       <center><div id="progressthing2" style="display: block;">
                        
                        
                        <muted>Join Our discord server to download the files!</muted>
         
                    </div>
      </div></center>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
                    <script> // the button or section or div container or anything
    //var btnEl = document.getElementById(‘yes’);
    // target time in ISO 8601 format (UTC)
    //var target = new Date(“2016-08-25T01:33:00Z”);
    // check the time every second
    //var thisTimer = setInterval(function(){
    //var now = new Date(); // what time is it now?
    // check if we’ve reached or exceeded our target time
   // if (now.getTime() >= target.getTime()) {
    //btnEl.style.display = ‘block’; // show the button
    //clearInterval(thisTimer); // stop the timer
    //}
    //}, 1000); // 1000 milliseconds interval
    </script>
       
   
</body>
       </div>  </div></div>    
</html>
  <?php
  pageBuilder::buildFooter();
  ?>