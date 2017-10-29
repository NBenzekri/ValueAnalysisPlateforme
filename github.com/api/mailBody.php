<?php 

	function htmlMailBody($password,$name,$prenom, $email,$NomEntreprise, $link){

		return '
    <!DOCTYPE html>
  <html>
  <head>
  	<title>Cloud-VAP </title>
  	<meta charset="utf-8">
  	<!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  	<!-- jQuery library -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  	<!-- Latest compiled JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<!-- -->
  	<style type="text/css">

  	.vap {display:inline-block;margin-right:10px;} 
  	.img-vap {
  		display:inline-block;
  		margin-top: -10px;
  	} 
  </style>
</head>
<body>	
					<div class="col-md-2" style="display:inline-block; margin-right:10px; margin-bottom:-10px;">
						<img  src="http://icons.iconarchive.com/icons/designbolts/seo/256/Market-Analysis-icon.png" width="90" height="90" style="border-radius: 10px; ">
					</div>
					<div class="col-md-10 text-left" style="display:inline-block;">
						<h1 >Cloud-VAP plateforme </h1>
					</div>								
				</div>
				<p>Bonjour '.$name.' '.$prenom.',</p>
				<div>								
					<div  style=" display:inline-block;">
						<p>Merci pour votre inscription à </p>
					</div>
					<div style="display:inline-block;margin-right:10px;">
						<h3> <a style=" text-decoration: none;" href="http://localhost/ValueAnalysisPlateforme/github.com">Cloud-VAP plateforme</a></h3>&#13;
					</div>								
				</div>
				<h4>Votre données d"inscription:</h4>&#13;
				<ul style="list-style-type:disc;">
					<li>Email: <b>'.$email.'</b></li>
					<li>Entreprise: <b>'.$NomEntreprise.'</b></li>
					<li>Mot de passe: <b>'.$password.'</b></li>
				</ul>
				<h3>Veuillez confirmer votre email pour terminer votre inscription </h3>&#13;
				<p class="text-center" style = "text-align: center;"><a href="'.$link.'" ><button type="button" class="text-center btn btn-success btn-lg">Confirmer mon inscription</button></a></p>&#13;

				<p>Merci pour votre temps</p>
				&#13;
				<p class="text-center">
					<a style=" text-decoration: none;" href="http://localhost/ValueAnalysisPlateforme/github.com">Cloud-VAP</a> &copy; 2017
				</p>&#13;
			</div>
		</div>	
	</div>
</body>
</html>
		';

	}


 ?>