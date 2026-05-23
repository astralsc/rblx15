<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php';
    $FindGames = $pdo->prepare("SELECT * FROM games ORDER by gameId");
    $FindGames->execute();
?>

<head>
<title>RBLX15</title>
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


<body bgcolor="#FFFFFF" text="#000000" data-bs-theme="dark">
<style>body{background:#1b1e21 url('/images/bg.png')}</style>
<style>
 /* add some kewl game stuff */
  .bar
  {
    background: #dc3545;
    height: 10px;
    width: 179px;
    display: block;
    border-radius: 5px;
  }
  
  .inner-bar
  {
    background: #198754;
    display: block;
    border-radius: 5px;
    height: 100%;
  }
  
  .game-item-image
  {
    width: 180px;
    height: 100px;
  }
  
  .game-item
  {
    color: white;
  }
</style>

<div class="row">
<?php
while($row = $FindGames->fetch(PDO::FETCH_ASSOC)){
          echo '
  <div class="col-sm-3 mb-3 mb-sm-0">
            <a class="game-item-anchor" rel="external" href="/Place1.aspx?id='.$row['gameId'].'" style="text-decoration: none; color: black;">
                  <div class="card">
      <div class="card-body">
            <div class="game-item">
    <div class="always-shown">
        
            <span class=""><img class="game-item-image" src="/images/Unnaproved.png"/></span>
            <div class="game-name notranslate text-truncate text-center">
                '.$row['gameName'].'  
            </div>
            <div class="game-creator notranslate text-truncate text-center">
                By: '.$row['owner'].'
            </div>
                           <div class="game-creator notranslate text-truncate text-center">
                Client: '.$row['client'].'
            </div>
        <div class="hover-shown" id="hoverShown">
             <div class="game-likes notranslate text-truncate text-center">
                <span class="bar"> <span class="inner-bar" style="width: 100%"> </span> </span>
                <i class="fa-solid fa-thumbs-up"></i> 100% \ 0 <i class="fa-solid fa-thumbs-down"></i>
            </div>
        </div>
        </div>
     
    </div></div></a></div></div>';
}
?>
</div>
</body>
</html>
