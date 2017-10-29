
<?php 
// user is connected and account activated
if (!empty($_SESSION) && $_SESSION['compteActive'] == 1)
{

  ?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar7" style="padding: 10px;  margin: 25px 15px 25px 0;">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="height: 60px;" href="http://localhost/ValueAnalysisPlateforme/github.com/"><img src="api/img/Market-Analysis-icon2.png" width="50" height="50" style="border-radius: 10px; margin-top: -10px;" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar7" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left navactive">
          <li class="active" ><a href="http://localhost/ValueAnalysisPlateforme/github.com/index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li><a href="eoa.php"> <span class="glyphicon glyphicon-stats"></span> Démarches VAP</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><button class="btn btn-primary navbar-btn">Compte activé</button></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?=$_SESSION['nomMembre'] ?> &nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Voir le Profil</a></li>
                <li><a href="api/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <?php 
// user is connected but account Not activated
  }elseif (!empty($_SESSION) && $_SESSION['compteActive'] == 0) {
   ?>
   <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar7" style="padding: 10px;  margin: 25px 15px 25px 0;">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="height: 60px;" href="http://localhost/ValueAnalysisPlateforme/github.com/"><img src="api/img/Market-Analysis-icon2.png" width="50" height="50" style="border-radius: 10px; margin-top: -10px;" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar7" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left navactive">
          <li class="active" ><a href="http://localhost/ValueAnalysisPlateforme/github.com/index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li><a href="eoa.php"> <span class="glyphicon glyphicon-stats"></span> Démarches VAP</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><button class="btn btn-danger navbar-btn"><i class="glyphicon glyphicon-exclamation-sign"></i>Compte n'est pas activer!</button></li>
          <li><a href="api/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
        </ul>
      </div>
    </div>
  </nav>

  <?php 
// user is disconnected
}elseif (empty($_SESSION)) {
  ?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar7" style="padding: 10px;  margin: 25px 15px 25px 0;">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="height: 60px;" href="http://localhost/ValueAnalysisPlateforme/github.com/"><img src="api/img/Market-Analysis-icon2.png" width="50" height="50" style="border-radius: 10px; margin-top: -10px;" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar7" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left navactive">
          <li class="active" ><a href="http://localhost/ValueAnalysisPlateforme/github.com/index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li><a href="eoa.php"> <span class="glyphicon glyphicon-stats"></span> Démarches VAP</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">You are disconnected!
          <li><a class="active">You are disconnected!</a></li> 
          <h3 style="color: white;z-index: 10;" > <li id="timeeee"></li></h3>
        </ul>
      </div>
    </div>
  </nav>


  <?php 

}

?>
<script type="text/javascript">
  $(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
 });
  var timestamp = '<?=time();?>';
  function updateTime(){
    $('#time').html(Date(timestamp));
    timestamp++;
  }
  $(function(){
    setInterval(updateTime, 1000);
  });

</script>