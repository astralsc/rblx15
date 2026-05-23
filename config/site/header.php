<!DOCTYPE html>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php'; 
pageBuilder::buildHeader(); 
if(!isset($_SESSION['user'])){
	
}else{
$username = $_SESSION["user"]["username"];
}
?>
<head>
<title><?php echo(config["site"]["name"]); ?></title>
  <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  
      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">

      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">

      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">

      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css">

</head>
<body data-bs-theme="dark">
<style>body{background:#1b1e21 url('/images/bg.png')}</style>
  <div class="fixed-top w-100">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <img src="/images/2014___2015_roblox_circle_logo_by_augmentedpoisonart_d8e625w-fullview.png" width="40" height="40"></a></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/"><i class="fa-regular fa-house"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/games"><i class="fa-regular fa-gamepad-modern"></i> Games</a>
        </li>
        <?php if(isset($_SESSION["user"])){ ?>
          <li class="nav-item">
          <a class="nav-link" href="/develop"><i class="fa-solid fa-display-code"></i> Develop</a>
        </li>
        <?php } ?>
	<?php if(isset($_SESSION["user"])){ ?>
          <li class="nav-item">
          <a class="nav-link" href="/membership"><i class="fa-solid fa-money-bills-simple"></i> Membership</a>
        </li>
        <?php } ?>
	<?php if(isset($_SESSION["user"])){ ?>
          <li class="nav-item">
          <a class="nav-link" href="/debug"><i class="fa-duotone fa-code"></i> Debug Mode</a>
        </li>
        <?php } ?>
      </ul>
    </div>
       <ul class="navbar-nav">
        <li class="nav-item">    


<?php
//please ffs fix this

if(!isset($_SESSION['user'])){	
    echo('<a href="/login/" class="btn btn-primary me-md-1">Login</a><a href="/register/" class="btn btn-primary me-md-1">Sign Up</a>');
}else{
	echo('<snap>RBX: '.$_SESSION['user']['robux'].'</snap><snap> Logged in as '.htmlspecialchars($username).' </snap> <a href="/logout.php" class="btn btn-danger me-md-1">Logout</a>');
}

?>
        <!-- <a href="/register" class="btn btn-secondary">Register</a> -->
      </li>
    </ul>
  </div>
</nav>

<div class="alert alert-warning" role="alert">
  <center><?php echo config["site"]["globalAlert"]; ?></center>
</div>
  </div>
</div>
  </div>
  <br><br><br><br><br><br><br>
  <!--<style>
    @-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}.snowflake:nth-of-type(10){left:25%;-webkit-animation-delay:2s,0s;animation-delay:2s,0s}.snowflake:nth-of-type(11){left:65%;-webkit-animation-delay:4s,2.5s;animation-delay:4s,2.5s}
</style>
<div class="snowflakes" aria-hidden="true">
    
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❄</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❆</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❄</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❆</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❄</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❅</h2>
  </div>
  <div class="snowflake" style="color: white;">
  <h2>❆</h2> -->
  </div>
</div>
</body>