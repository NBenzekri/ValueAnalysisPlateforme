<?php
session_start();
require_once('api/MembreAPI.php');
$membre = new MembreAPI();
if($membre->is_loggedin()!="")
{
  $membre->redirect('eoa.php');
}
if(isset($_POST['btn_signup']))
{
  $membreName = strip_tags($_POST['nom_singup']);
  $membrePrenom = strip_tags($_POST['prenom_singup']);
  $membreEmail = strip_tags($_POST['email_signup']);
  $membreEntreprise = strip_tags($_POST['entreprise_signup']);  
  $membrePassword = strip_tags($_POST['password_signup']);  
  if($membreName=="")  {
    $error[] = "Inserer le nom !";  
  }
  else if($membrePrenom=="") {
    $error[] = "Inserer le prenom !";  
  }
  else if($membreEmail=="") {
    $error[] = "Inserer l'email !";  
  }
  else if($membreEntreprise=="0") {
    $error[] = "Selectionner une entreprise!";  
  }
  else if(!filter_var($membreEmail, FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Inserer un email valide !';
  }
  else if($membrePassword=="") {
    $error[] = "Inserer un mot de pass!";
  }
  else if(strlen($membrePassword) < 6){
    $error[] = "Le mot de passe doit être au moins de 6 caractères!"; 
  }
  else
  { 
    try
    {
      $sql = "SELECT nomMembre, prenomMembre, emailMembre FROM membre WHERE nomMembre=:nomMembre OR prenomMembre=:prenomMembre OR emailMembre =:emailMembre";
      $stmt = $membre->runQuery($sql);
      $stmt->execute(array(':nomMembre'=>$membreName, ':prenomMembre'=>$membrePrenom, ':emailMembre'=>$membreEmail));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);

      if($row['nomMembre']==$membreName && $row['prenomMembre']==$membrePrenom) {
        $error[] = "Sorry, $membreName $membrePrenom already exist !";
      }
      else if($row['emailMembre']==$membreEmail) {
        $error[] = "Sorry email id already taken !";
      }
      else
      {
        if($membre->insertMembre($membreName, $membrePrenom, $membrePassword, $membreEmail, $membreEntreprise))
        {  
          if($membre->sendConfirmationEmail($membrePassword,$membreName,$membrePrenom, $membreEmail,$membreEntreprise, $membre->getToken()))
            {
              $membre->setToken("Null");
              $membre->redirect('index.php?membreNameSignedin='.$membreName.'&joined');
            }else
            {
              $error[] = "Sorry email id already taken !";
            }
        
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  } 
}
if(isset($_POST['btn_signin'])){

  $membreEmail = strip_tags($_POST['email_signup']);
  $membreEntreprise = strip_tags($_POST['entreprise_signup']);  
  $membrePassword = strip_tags($_POST['password_signup']);

}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from github.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Sep 2017 20:47:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8"/><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- -->
  <link rel="dns-prefetch" href="https://assets-cdn.github.com/">
  <link rel="dns-prefetch" href="https://avatars0.githubusercontent.com/">
  <link rel="dns-prefetch" href="https://avatars1.githubusercontent.com/">
  <link rel="dns-prefetch" href="https://avatars2.githubusercontent.com/">
  <link rel="dns-prefetch" href="https://avatars3.githubusercontent.com/">
  <link rel="dns-prefetch" href="https://github-cloud.s3.amazonaws.com/">
  <link rel="dns-prefetch" href="https://user-images.githubusercontent.com/">


  <link crossorigin="anonymous"
  href="../assets-cdn.github.com/assets/frameworks-bedfc518345498ab3204d330c1727cde7e733526a09cd7df6867f6a231565091.css"
  media="all" rel="stylesheet"/>
  <link crossorigin="anonymous"
  href="../assets-cdn.github.com/assets/github-a1f1041276ec59b7ad51bdbd35d2d73f15f99aebe2686a60e9cd9f705b57d220.css"
  media="all" rel="stylesheet"/>


  <link crossorigin="anonymous"
  href="../assets-cdn.github.com/assets/site-877643c520258c4fa15ac8d1664d84efd0e3db56f5e544ccac58da0e50489904.css"
  media="all" rel="stylesheet"/>


  <meta name="viewport" content="width=device-width">

  <title>The world&#39;s leading software development platform · GitHub</title>
  <link rel="search" type="application/opensearchdescription+xml" href="opensearch.xml" title="GitHub">
  <link rel="fluid-icon" href="fluidicon.png" title="GitHub">
  <meta property="fb:app_id" content="1401488693436528">

  <meta property="og:url" content="index.php">
  <meta property="og:site_name" content="GitHub">
  <meta property="og:title" content="Build software better, together">
  <meta property="og:description"
  content="GitHub is where people build software. More than 24 million people use GitHub to discover, fork, and contribute to over 67 million projects.">
  <meta property="og:image" content="../assets-cdn.github.com/images/modules/open_graph/github-logo.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="1200">
  <meta property="og:image" content="../assets-cdn.github.com/images/modules/open_graph/github-mark.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="620">
  <meta property="og:image" content="../assets-cdn.github.com/images/modules/open_graph/github-octocat.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="620">


  <link rel="assets" href="https://assets-cdn.github.com/">

  <meta name="pjax-timeout" content="1000">

  <meta name="request-id" content="D71A:0C50:2D41AEB:4FE6B5E:59C81976" data-pjax-transient>


  <meta name="selected-link" value="/" data-pjax-transient>

  <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
  <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
  <meta name="google-analytics" content="UA-3769691-2">

  <meta content="collector.githubapp.com" name="octolytics-host"/>
  <meta content="github" name="octolytics-app-id"/>
  <meta content="https://collector.githubapp.com/github-external/browser_event" name="octolytics-event-url"/>
  <meta content="D71A:0C50:2D41AEB:4FE6B5E:59C81976" name="octolytics-dimension-request_id"/>
  <meta content="iad" name="octolytics-dimension-region_edge"/>
  <meta content="iad" name="octolytics-dimension-region_render"/>


  <meta class="js-ga-set" name="dimension1" content="Logged Out">


  <meta name="hostname" content="github.com">
  <meta name="user-login" content="">

  <meta name="expected-hostname" content="github.com">
  <meta name="js-proxy-site-detection-payload"
  content="M2U0YzVjZjA3M2FhMGIzMjExOTNlYjg1NDU2NjE5YTlkMmNlYzc5NDFlOTdlZWMxNmU2NjczNGUyMGFiOGMyMXx7InJlbW90ZV9hZGRyZXNzIjoiNDEuMjUwLjE2NS4xNiIsInJlcXVlc3RfaWQiOiJENzFBOjBDNTA6MkQ0MUFFQjo0RkU2QjVFOjU5QzgxOTc2IiwidGltZXN0YW1wIjoxNTA2Mjg1OTQzLCJob3N0IjoiZ2l0aHViLmNvbSJ9">


  <meta name="html-safe-nonce" content="c6346ba7bf44c1b7ff3289b3cf3a071898ac6b67">

  <meta http-equiv="x-pjax-version" content="91fbc80bd47c6773a7a0b82ce6f50214">


  <meta name="viewport" content="width=device-width">
  <link crossorigin="anonymous"
  href="../assets-cdn.github.com/assets/site-877643c520258c4fa15ac8d1664d84efd0e3db56f5e544ccac58da0e50489904.css"
  media="all" rel="stylesheet"/>


  <link rel="canonical" href="index.php" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <link rel="mask-icon" href="api/img/Market-Analysis-icon.png" color="#000000">
  <link rel="icon" type="image/x-icon" href="api/img/Market-Analysis-icon.png">

  <meta name="theme-color" content="#1e2327">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <style type="text/css">

    </style>

    <script>

  </script>

</head>

<body class="logged-out env-production page-responsive min-width-0 f4">


  <div class="position-relative js-header-wrapper ">
    <a href="#start-of-content" tabindex="1" class="px-2 py-4 show-on-focus js-skip-to-content">Skip to content</a>
    <div id="js-pjax-loader-bar" class="pjax-loader-bar">
      <div class="progress"></div>
    </div>


    <header class="Header header-logged-out js-details-container Details position-relative f4 py-3" role="banner">
      <div class="container-lg d-lg-flex p-responsive">
        <div class="d-flex flex-justify-between flex-items-center">
          <a class="header-logo-invertocat my-0" href="index.php" aria-label="Homepage"
          data-ga-click="(Logged out) Header, go to homepage, icon:logo-wordmark">
          <img src="api/img/Market-Analysis-icon2.png" width="50" height="50" style="border-radius: 10px;">
        </a>

        <button class="btn-link d-lg-none mt-1 js-details-target" type="button" aria-label="Toggle navigation"
        aria-expanded="false">
        <svg aria-hidden="true" class="octicon octicon-three-bars text-white" height="24" version="1.1"
        viewBox="0 0 12 16" width="18">
        <path fill-rule="evenodd"
        d="M11.41 9H.59C0 9 0 8.59 0 8c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zm0-4H.59C0 5 0 4.59 0 4c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zM.59 11H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1H.59C0 13 0 12.59 0 12c0-.59 0-1 .59-1z"/>
      </svg>
    </button>
  </div>

  <div class="HeaderMenu HeaderMenu--bright d-lg-flex flex-justify-between flex-auto">
    <nav class="mt-2 mt-lg-0">
      <ul class="d-lg-flex list-style-none">
        <li class="ml-lg-2">
          <a href="features.html"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0"
          data-ga-click="Header, click, Nav menu - item:features"
          data-selected-links="/features /features/project-management /features/code-review /features/project-management /features/integrations /features">
          Features
        </a></li>
        <li class="ml-lg-4">
          <a href="business.html"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0"
          data-ga-click="Header, click, Nav menu - item:business"
          data-selected-links="/business /business/security /business/customers /business">
          Business
        </a></li>

        <li class="ml-lg-4">
          <a href="explore.html"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0"
          data-ga-click="Header, click, Nav menu - item:explore"
          data-selected-links="/explore /trending /trending/developers /integrations /integrations/feature/code /integrations/feature/collaborate /integrations/feature/ship showcases showcases_search showcases_landing /explore">
          Explore
        </a></li>

        <li class="ml-lg-4">
          <a href="marketplace.html"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0"
          data-ga-click="Header, click, Nav menu - item:marketplace"
          data-selected-links=" /marketplace">
          Marketplace
        </a></li>
        <li class="ml-lg-4">
          <a href="pricing.html"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0"
          data-ga-click="Header, click, Nav menu - item:pricing"
          data-selected-links="/pricing /pricing/developer /pricing/team /pricing/business-hosted /pricing/business-enterprise /pricing">
          Pricing
        </a></li>      
        <li class="ml-lg-4">
          <a href="eoa.php"
          class="js-selected-navigation-item HeaderNavlink px-0 py-3 py-lg-2 m-0">
          Démarches VAP
        </a></li>
      </ul>
    </nav>

    <div class="d-lg-flex">
      <div class="d-lg-flex flex-items-center mr-lg-3">
        <div class="header-search   js-site-search" role="search">
          <!-- '"` --><!-- </textarea></xmp> --></option></form>
          <form accept-charset="UTF-8" action="https://github.com/search" class="js-site-search-form"
          data-unscoped-search-url="/search" method="get">
          <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden"
            value="&#x2713;"/></div>
            <label class="form-control header-search-wrapper js-chromeless-input-container">
              <a href="dashboard.html" class="header-search-scope no-underline">/dashboard</a>
              <input type="text"
              class="form-control header-search-input js-site-search-focus "
              data-hotkey="s"
              name="q"
              value=""
              placeholder="Search GitHub"
              aria-label="Search GitHub"
              data-unscoped-placeholder="Search GitHub"
              data-scoped-placeholder="Search"
              autocapitalize="off">
              <input type="hidden" class="js-site-search-type-field" name="type">
            </label>
          </form>
        </div>

      </div>

      <span class="d-block d-lg-inline-block">
        <div class="HeaderNavlink px-0 py-2 m-0">
          <a class="text-bold text-white no-underline" href="login.html"
          data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Sign in</a>
          <span class="text-gray">or</span>
          <a class="text-bold text-white no-underline" href="join6a53.html?source=header-home"
          data-ga-click="(Logged out) Header, clicked Sign up, text:sign-up">Sign up</a>
        </div>
      </span>
    </div>
  </div>
</div>
</header>


</div>

<div id="start-of-content" class="show-on-focus"></div>

<div id="js-flash-container">
</div>


<div role="main">


  <div class="jumbotron jumbotron-codelines">
    <div class="row">
      <div class="col-md-12">
        <div class="container-lg p-responsive position-relative">
          <div class="d-md-flex">
            <div class="">
              <h1 class="alt-h1 text-white lh-condensed-ultra text-center ">  Cloud-VAP - Entreprise Value Analysis Plateforme
              </h1>
              <p class="alt-h2 mb-4 text-center">
                Le succès d’une étude d’analyse de la valeur dépend de la possession d’informations pertinentes, justes et significatives au projet, au produit ou au service considéré.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 login-section" id="login">
        <div>
          <div class="rounded-1 text-gray bg-gray-light py-4 px-4 px-md-3 px-lg-4">
            <!-- '"` --><!-- </textarea></xmp> --></option></form>
            <!-- Login div -->
            <div class="row">
              <div class="col-md-1">
                <img src="api/img/login-xxl.png" width="40" height="40" style="border-radius: 10px; margin-top: -10px;">
              </div>  
              <div class="col-md-10 text-md-left" style="margin-left: 10px;">   
                <h2 >Se connecter</h2>
              </div>
            </div>
            <hr>
            <form action="" autocomplete="off"
            class="home-hero-signup js-signup-form" method="post">

            <dl class="form-group">
              <dt class="input-label">
                <label class="form-label f5" for="email_signin">Email</label>
              </dt>
              <dd>
                <input type="text" name="email_signin" id="email_signin"
                class="form-control form-control-lg input-block js-email-notice-trigger" placeholder="you@example.com" required >
              </dd>
            </dl>
            <dl class="form-group mt-0">
              <dt class="input-label">
                <label class="form-label f5" for="entreprise_signin">Entreprise</label>
              </dt>
              <dd>
                <select name="entreprise" class=" form-control form-control-lg input-block" placeholder="Pick a username">
                  <option selected value="0" >Choisir votre entreprise</option>
                  <option value="1">Volvo</option>
                  <option value="2">Google</option>
                </select>
              </dd>
            </dl>
            <dl class="form-group">
              <dt class="input-label">
                <label class="form-label f5" for="password_signin">Mot de Passe</label>
              </dt>
              <dd>
                <input required type="password" name="password_signin" id="password_signin"
                class="form-control form-control-lg input-block" placeholder="Inserer un Mot de Passe" >
              </dd>
              <p class="form-control-note">Use at least one letter, one numeral, and seven characters.</p>
            </dl>  
            <input class="btn btn-primary btn-large f4 btn-block" name="btn_signin" value="Connecter à  Cloud-VAP" type="submit"/>
            <p class="form-control-note mb-1 text-center"> ou 
              <a class="" href="../terms" target="_blank">Mot de passe oublié?</a>
            </p>
            <!--             <input class="btn btn-primary btn-large f4 btn-block" name="test" value="Test function" type="submit"/>   -->          
          </form>
        </div>
      </div>

    </div>

    <div class="col-md-1"></div>

    <div class="col-md-5">
      <div class="">
        <div class="rounded-1 text-gray bg-gray-light py-4 px-4 px-md-3 px-lg-4">
          <!-- '"` --><!-- </textarea></xmp> --></option></form>
          <!-- SIgn in form-->
          <?php
          if(isset($error))
          {
            foreach($error as $error)
            {
             ?>
             <div class="alert alert-danger">
              <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
            </div>
            <?php
          }
        }
        else if(isset($_GET['joined']))
        {
         ?>
         <div class="alert alert-info">
          <i class="glyphicon glyphicon-log-in"></i> &nbsp; <?php echo $_GET['membreNameSignedin'];  ?> has Successfully registered <br>
          Check your inbox, <b>Confirmation email has been sent.</b>
        </div>
        <?php
      }
      ?>
      <div class="row">
        <div class="col-md-1">
          <img src="api/img/icon_signup_dude.png" width="40" height="40" style="border-radius: 10px; margin-top: -10px;">
        </div>  
        <div class="col-md-10 text-md-left" style="margin-left: 10px;">   
          <h2>S'inscrire</h2>
        </div>
      </div>
      
      <hr>
      <form action="index.php" autocomplete="off"
      class="home-hero-signup js-signup-form" method="post">
      <dl class="form-group mt-0">
        <dt class="input-label">
          <label class="form-label f5" for="nom_singup">Nom</label>
        </dt>
        <dd>
          <input required type="text" value="nouriddin" name="nom_singup" id="nom_singup"
          class="form-control form-control-lg input-block" placeholder="Inserer votre Nom">
        </dd>
      </dl>
      <dl class="form-group mt-0">
        <dt class="input-label">
          <label class="form-label f5" for="prenom_singup">Prenom</label>
        </dt>
        <dd>
          <input required type="text" value="Benz" name="prenom_singup" id="prenom_singup"
          class="form-control form-control-lg input-block" placeholder="Inserer votre Prenom" >
        </dd>
      </dl>
      <dl class="form-group">
        <dt class="input-label">
          <label class="form-label f5" for="email_signup">Email</label>
        </dt>
        <dd>
          <input required type="text" value="benz@gmail.com" name="email_signup" id="email_signup"
          class="form-control form-control-lg input-block js-email-notice-trigger" placeholder="you@example.com" >
        </dd>
      </dl>

      <dl class="form-group mt-0">
        <dt class="input-label">
          <label class="form-label f5" for="entreprise_signup">Entreprise</label>
        </dt>
        <dd>
          <select name="entreprise_signup" id="entreprise_signup" class=" form-control form-control-lg input-block">
            <option selected value="0">Choisir votre entreprise</option>
            <option value="1">Volvo</option>
            <option value="2">Google</option>
          </select>
        </dd>
      </dl>

      <dl class="form-group">
        <dt class="input-label">
          <label class="form-label f5" for="password_signup">Mot de Passe</label>
        </dt>
        <dd>
          <input required type="password" value="74107410" name="password_signup" id="password_signup"
          class="form-control form-control-lg input-block" placeholder="Inserer un Mot de Passe">
        </dd>
        <p class="form-control-note">Use at least one letter, one numeral, and seven characters.</p>
      </dl>  

      <input class="btn btn-primary btn-large f4 btn-block" name="btn_signup" value="S'inscrire à  Cloud-VAP" type="submit"/>
      <p class="form-control-note mb-0 text-center">
        By clicking "S'inscrire a  Cloud-VAP", you agree to our
        <a class="" href="/terms" target="_blank">terms of service</a>
        and
        <a class="" href="/privacy" target="_blank">privacy policy</a>.
        <span class="js-email-notice">We’ll occasionally send you account related emails.</span>
      </p>

    </form>
  </div>
</div>
<div class="d-sm-none text-center">
  <a href="join75e8.html?source=button-home" class="btn btn-primary btn-large border-0"
  data-ga-click="Signup, Attempt, location:jumbotron; group:excluded_from_experiment"
  rel="nofollow">Sign up for GitHub</a>
</div>
</div>
</div>
</div>    
<div class="col-md-1"></div>

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

<div class="featurette bg-gray-dark">
  <div class="container-lg p-responsive text-white text-center">
    <h2 class="alt-h2">
      Get started for free &mdash; join the millions of developers already using GitHub to share their code,
      work together, and build amazing things.
    </h2>
  </div>
  <div class="container-xl p-responsive py-6 mt-lg-6">
    <!-- '"` --><!-- </textarea></xmp> --></option></form>
    <form accept-charset="UTF-8" action="https://github.com/join" autocomplete="off"
    class="home-hero-signup js-signup-form" method="post">
    <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;"/><input
      name="authenticity_token" type="hidden"
      value="Dgym6MJEPH2KZt4HqvOxMuq6G36AZ4Pdfw1NfVOtnqdKOYIHHx4udSx5xnA3uEjXRbEOHDOcU0H133dfg+xa+g=="/>
    </div>
    <div class="d-lg-flex flex-wrap flex-lg-nowrap flex-justify-between">
      <dl class="form-group col-12 col-sm-8 col-lg-3 mx-auto mt-0 mx-lg-0 mb-3 mb-lg-0 px-3">
        <dt class="input-label sr-only">
          <label class="form-label text-gray f5" for="user[login]-footer">Username</label>
        </dt>
        <dd>
          <input type="text" name="user[login]" id="user[login]-footer"
          class="form-control form-control-lg input-block input-lg"
          placeholder="Pick a username" data-autocheck-url="/signup_check/username"
          data-autocheck-authenticity-token="hXPZniI+iQ2EkfGdYomiOpnrXhvoBKIaZ3/9lBKaZi3RxjzaZ9gOaGv4ARLxgu7AzDD8BNsdErYPTDQYxZ8D3g==">
        </dd>
      </dl>

      <dl class="form-group col-12 col-sm-8 col-lg-3 mx-auto mt-0 mx-lg-0 mb-3 mb-lg-0 px-3">
        <dt class="input-label sr-only">
          <label class="form-label text-gray f5" for="user[email]-footer">Email</label>
        </dt>
        <dd>
          <input type="text" name="user[email]" id="user[email]-footer"
          class="form-control form-control-lg input-block input-lg js-email-notice-trigger"
          placeholder="Your email address" data-autocheck-url="/signup_check/email"
          data-autocheck-authenticity-token="IHgKPtiDl/LMNVvB088GCQp7xxJT2GfExp/Q88eYevMbX794l/DT6G9vY12iNN+D5JCJqLgPFFWza+oNyz1DnQ==">
        </dd>
      </dl>

      <dl class="form-group col-12 col-sm-8 col-lg-3 mx-auto mt-0 mx-lg-0 mb-3 mb-lg-0 px-3">
        <dt class="input-label sr-only">
          <label class="d-none form-label text-gray f5" for="user[password]-footer">Password</label>
        </dt>
        <dd>
          <input type="password" name="user[password]" id="user[password]-footer"
          class="form-control form-control-lg input-block input-lg"
          placeholder="Create a password" data-autocheck-url="/signup_check/password"
          data-autocheck-authenticity-token="jbDh8+k7K/EO2KDyDynOHIePvJ7/w+P4ZA0KZv5wbLMod/5CLWKwFhGyR1ppVx2qMQiPX/bIgMc6ZcIWW9NPSw==">
        </dd>
      </dl>

      <input type="hidden" name="source" class="js-signup-source" value="form-home">
      <input class="form-control" id="required_field_43d6" name="required_field_43d6"
      style="display: none" type="text"/>
      <input class="form-control" name="timestamp" type="hidden" value="1506285943199"/>
      <input class="form-control" name="timestamp_secret" type="hidden"
      value="ce0332adf7f068cdd78997ea690398b4626b33974dbef65056039893e4f16d23"/>

      <div class="col-12 col-sm-8 col-lg-3 mx-auto mx-lg-0 mb-3 mb-lg-0 px-3">
        <button class="btn btn-primary btn-large f4 btn-block" type="submit"
        data-ga-click="Signup, Attempt, location:teams; group:excluded_from_experiment">Sign up
        for GitHub
      </button>
    </div>
  </div>
  <p class="form-control-note text-center mt-6">
    By clicking "Sign up for GitHub", you agree to our
    <a class="text-white" href="https://help.github.com/terms" target="_blank">terms of service</a> and
    <a class="text-white" href="https://help.github.com/privacy" target="_blank">privacy policy</a>.
    <span class="js-email-notice">We’ll occasionally send you account related emails.</span>
  </p>
</form>
</div>
</div>


<div class="modal-backdrop js-touch-events"></div>

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

