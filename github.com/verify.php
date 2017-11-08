<?php
session_start(); 
require 'api/DB_API.php';
$dbname = "vap1_test";
$message = "";
$database = new Database();
$db = $database->dbConnection($dbname);

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']))
{
    // Verify data
    $email = strip_tags($_GET['email']); // Set email variable
    $token = strip_tags($_GET['token']); // Set hash variable
    try{           
    	$searchSql = 'SELECT emailMembre, activationToken, compteActive FROM membre WHERE emailMembre="'.$email.'" AND activationToken="'.$token.'" AND compteActive = 0'; 
    	$result = $db->query($searchSql);
    	if ($result->rowCount() == 1) {

    		$updateSql='UPDATE membre SET compteActive=1 WHERE emailMembre="'.$email.'" AND activationToken="'.$token.'" AND compteActive= 0';
    		$stmt = $db->prepare($updateSql);
    		$db = $stmt->execute();
    		$message = "<div class='alert alert-success'>
    		<strong>Felicitation! </strong> Votre compte a été activer <i class='em em-blush'></i>, Vous pouvez
    		<a href='http://localhost/ValueAnalysisPlateforme/github.com/' class='alert-link'>Se connecter
    		</a></div>
    		<p class='alt-h2 mb-4 text-center'>Merci pour la verification de votre email addresse <i class='em em-blush'></i></p>";
    	}else{
        // No match -> invalid url or account has already been activated.
    		$message = "<div class='alert alert-warning '>mail: ".$email." - token: ".$token."<br>
    		<strong>Warning! <i class='em em-interrobang'></i></strong> L'URL est invalide ou vous avez déjà activé votre compte, essayer de 
    		<a href='http://localhost/ValueAnalysisPlateforme/github.com/' class='alert-link'>Se connecter</a>
    		</div>" ;
    	}  
    	unset($result);
    	unset($stmt);   
    }
    catch(PDOException $e) {
    	$message =  $e->getMessage();
    }            
}
else{ 
    // Invalid approach
	$message =  '<div class="alert alert-danger">
	<strong>Approche invalide! </ strong> Veuillez utiliser le lien qui a été envoyé à votre adresse e-mail. <a href="http://localhost/ValueAnalysisPlateforme/github.com/"" class="alert-link">Home</a>
	</div>';
}

unset($db);

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from github.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2017 20:47:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!-- /Added by HTTrack -->
<head>
	
	<title>Cloud-VAP | Verify email</title>
	<?php include 'head.html'; ?>
</head>

<body class="logged-out env-production page-responsive min-width-0">
	
	<?php include 'api/navbar.php'; ?>



	<div role="main">


		<div class="jumbotron jumbotron-codelines">

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2 class="alt-h1 text-white lh-condensed-ultra text-center ">  Cloud-VAP - Email Confirmation
					</h2>
					<br>
					<?php 
					echo $message; ?>
				</div>
			</div>

			<div class="bg-gray-dark">
				<div class="container-lg p-responsive">
					<div class="py-4 d-md-flex flex-items-center gutter-md-spacious">
						<a href="https://githubuniverse.com/?utm_source=github&amp;utm_medium=banner&amp;utm_campaign=ww-dotcom-universe-20170717"
						class="no-underline">
						<div class="mx-auto" style="max-width: 475px;">
							<img src="../assets-cdn.github.com/images/modules/site/universe-octoshop.png" class="d-block"
							alt="universe octoshop swag" width="100%">
						</div>
						<div class="col-md-5 ml-md-6 text-center text-md-left">
							<img src="../assets-cdn.github.com/images/modules/site/universe-wordmark.png"
							class="d-block mx-auto mx-md-0" alt="universe wordmark" width="150px">
							<h3 class="alt-h3 text-white mt-2">Experience the Octoshop</h3>
							<p class="text-white mt-1 mb-1">Get your Universe ticket and make room in your bag for limited
							edition Octoshop&nbsp;swag.</p>
							<a href="https://githubuniverse.com/?utm_source=github&amp;utm_medium=banner&amp;utm_campaign=ww-dotcom-universe-20170717"
							style="color: #959da5;" class="d-block mt-2">Learn more
							<svg aria-hidden="true" class="octicon octicon-chevron-right ml-2 v-align-text-bottom"
							height="16" version="1.1" viewBox="0 0 8 16" width="8">
							<path fill-rule="evenodd" d="M7.5 8l-5 5L1 11.5 4.75 8 1 4.5 2.5 3z"/>
						</svg>
					</a>
				</div>
			</a>
		</div>
	</div>
</div>





</div>
<?php include 'footer.html'; ?>


										</body>

										<!-- Mirrored from github.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2017 20:47:54 GMT -->
										</html>

