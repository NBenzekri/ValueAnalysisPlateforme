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
    	$searchSql = "SELECT emailMembre, activationToken, compteActive FROM membre WHERE emailMembre='.$email.' AND activationToken='.$token.' AND compteActive = 0"; 
    	$result = $db->query($searchSql);
    	if ($result->rowCount() > 1) {

    		$updateSql="UPDATE membre SET compteActive=1 WHERE emailMembre='".$email."' AND activationToken='".$token."' AND compteActive=0";
    		$stmt = $db->prepare($updateSql);
    		$db = $stmt->execute();
    		$message = "<div class='alert alert-success'>
    		<strong>Felicitation! </strong> Votre compte a été activer <i class='em em-blush'></i>, Vous pouvez
    		<a href='http://localhost/ValueAnalysisPlateforme/github.com/' class='alert-link'>Se connecter
    		</a></div>
    		<p class='alt-h2 mb-4 text-center'>Merci pour la verification de votre email addresse <i class='em em-blush'></i></p>";
    	}else{
        // No match -> invalid url or account has already been activated.
    		$message = "<div class='alert alert-warning '>mail: ".$email." - token: ".$token." active: ".$_SESSION['compteActive']."<br>
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

<div class="footer container-lg p-responsive mt-6" role="contentinfo">
	<div class="d-flex flex-wrap py-5 mb-5">
		<div class="col-12 col-md-2 mb-3">
			<img src="api/img/Market-Analysis-icon.png" width="50" height="50" >
			<p class="text-gray alt-text-small">
				&copy; 2017
			</p>
		</div>
		<div class="col-6 col-sm-4 col-md-2 mb-3 pr-3">
			<h4 class="mb-2">Features</h4>
			<ul class="list-style-none text-gray">
				<li class="lh-condensed mb-2"><a href="features.html#code-review" class="muted-link alt-text-small">Code
				review</a></li>
				<li class="lh-condensed mb-2"><a href="features.html#project-management"
					class="muted-link alt-text-small">Project management</a></li>
					<li class="lh-condensed mb-2"><a href="features.html#community-management"
						class="muted-link alt-text-small">Community</a></li>
						<li class="lh-condensed mb-2"><a href="features.html#documentation"
							class="muted-link alt-text-small no-wrap">Documentation</a></li>
							<li class="lh-condensed mb-2"><a href="features.html#code-hosting" class="muted-link alt-text-small">Code
							hosting</a></li>
						</ul>
					</div>
					<div class="col-6 col-sm-4 col-md-2 mb-3 pr-3">
						<h4 class="mb-2">Platform</h4>
						<ul class="list-style-none">
							<li class="lh-condensed mb-2"><a href="https://atom.io/" class="muted-link alt-text-small">Atom</a></li>
							<li class="lh-condensed mb-2"><a href="http://electron.atom.io/" class="muted-link alt-text-small">Electron</a>
							</li>
							<li class="lh-condensed mb-2"><a href="https://desktop.github.com/" class="muted-link alt-text-small">GitHub
							Desktop</a></li>
							<li class="lh-condensed mb-2"><a href="https://developer.github.com/"
								data-ga-click="Footer, go to api, text:api"
								class="muted-link alt-text-small">Developers</a></li>
							</ul>
						</div>
						<div class="col-6 col-sm-4 col-md-2 mb-3 pr-3">
							<h4 class="mb-2">Community</h4>
							<ul class="list-style-none">
								<li class="lh-condensed mb-2"><a href="personal.html" class="muted-link alt-text-small">Personal</a>
								</li>
								<li class="lh-condensed mb-2"><a href="open-source.html" class="muted-link alt-text-small">Open
								source</a></li>
								<li class="lh-condensed mb-2"><a href="business.html" class="muted-link alt-text-small">For Business</a>
								</li>
								<li class="lh-condensed mb-2"><a href="https://education.github.com/" class="muted-link alt-text-small">For
								Education</a></li>
								<li class="lh-condensed mb-2"><a href="https://community.github.com/" class="muted-link alt-text-small">Sponsorships</a>
								</li>
							</ul>
						</div>
						<div class="col-6 col-sm-4 col-md-2 mb-3 pr-3">
							<h4 class="mb-2">Company</h4>
							<ul class="list-style-none">
								<li class="lh-condensed mb-2"><a href="about.html" class="muted-link alt-text-small"
									data-ga-click="Footer, go to about, text:about">About</a></li>
									<li class="lh-condensed mb-2"><a href="blog.html" class="muted-link alt-text-small"
										data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
										<li class="lh-condensed mb-2"><a href="business/customers.html" class="muted-link alt-text-small">Customers</a>
										</li>
										<li class="lh-condensed mb-2"><a href="about/careers.html" class="muted-link alt-text-small">Careers</a>
										</li>
										<li class="lh-condensed mb-2"><a href="about/press.html" class="muted-link alt-text-small">Press</a>
										</li>
										<li class="lh-condensed mb-2"><a href="https://shop.github.com/"
											class="muted-link alt-text-small">Shop</a></li>
										</ul>
									</div>
									<div class="col-6 col-sm-4 col-md-2 mb-3 pr-3">
										<h4 class="mb-2">Resources</h4>
										<ul class="list-style-none">
											<li class="lh-condensed mb-2"><a href="contact.html" class="muted-link alt-text-small"
												data-ga-click="Footer, go to contact, text:contact">Contact GitHub</a>
											</li>
											<li class="lh-condensed mb-2"><a href="https://help.github.com/" class="muted-link alt-text-small"
												data-ga-click="Footer, go to help, text:help">Help</a></li>
												<li class="lh-condensed mb-2"><a href="https://status.github.com/"
													data-ga-click="Footer, go to status, text:status"
													class="muted-link alt-text-small">Status</a></li>
													<li class="lh-condensed mb-2"><a href="https://help.github.com/articles/github-terms-of-service/"
														class="muted-link alt-text-small"
														data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
														<li class="lh-condensed mb-2"><a href="https://help.github.com/articles/github-privacy-statement/"
															class="muted-link alt-text-small"
															data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
															<li class="lh-condensed mb-2"><a href="https://help.github.com/articles/github-security/"
																class="muted-link alt-text-small"
																data-ga-click="Footer, go to security, text:security">Security</a></li>
																<li class="lh-condensed mb-2"><a href="https://services.github.com/" class="muted-link alt-text-small">Training</a>
																</li>
															</ul>
														</div>
													</div>
												</div>


												<div id="ajax-error-message" class="ajax-error-message flash flash-error">
													<svg aria-hidden="true" class="octicon octicon-alert" height="16" version="1.1" viewBox="0 0 16 16" width="16">
														<path fill-rule="evenodd"
														d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/>
													</svg>
													<button type="button" class="flash-close js-flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
														<svg aria-hidden="true" class="octicon octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12">
															<path fill-rule="evenodd"
															d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/>
														</svg>
													</button>
													You can't perform that action at this time.
												</div>


												<script crossorigin="anonymous"
												src="../assets-cdn.github.com/assets/compat-91f98c37fc84eac24836eec2567e9912742094369a04c4eba6e3cd1fa18902d9.js"></script>
												<script crossorigin="anonymous"
												src="../assets-cdn.github.com/assets/frameworks-143a6f74056707f6b14875ec6ca4f2eb16f5d0781f7e1cb82bd441b4438b43d3.js"></script>

												<script async="async" crossorigin="anonymous"
												src="../assets-cdn.github.com/assets/github-a3db37c169c8510815dedb0e9bbfda110628b0b4a4fb9652b95642f8e0b0fff2.js"></script>


												<div class="js-stale-session-flash stale-session-flash flash flash-warn flash-banner d-none">
													<svg aria-hidden="true" class="octicon octicon-alert" height="16" version="1.1" viewBox="0 0 16 16" width="16">
														<path fill-rule="evenodd"
														d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/>
													</svg>
													<span class="signed-in-tab-flash">You signed in with another tab or window. <a href="#">Reload</a> to refresh your session.</span>
													<span class="signed-out-tab-flash">You signed out in another tab or window. <a href="#">Reload</a> to refresh your session.</span>
												</div>
												<div class="facebox" id="facebox" style="display:none;">
													<div class="facebox-popup">
														<div class="facebox-content" role="dialog" aria-labelledby="facebox-header"
														aria-describedby="facebox-description">
													</div>
													<button type="button" class="facebox-close js-facebox-close" aria-label="Close modal">
														<svg aria-hidden="true" class="octicon octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12">
															<path fill-rule="evenodd"
															d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/>
														</svg>
													</button>
												</div>
											</div>


										</body>

										<!-- Mirrored from github.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2017 20:47:54 GMT -->
										</html>

