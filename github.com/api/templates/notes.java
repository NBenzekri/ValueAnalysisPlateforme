
<?php 
 	error not complited:

	- Signup conformation link
	- Session values must be gotten every time with an sql query.
	- gestion des roles - Admin validation - kifach kaydir l'admin inscription!!
	-...
	requete:
		- $searchSql = 'SELECT emailMembre, activationToken, compteActive FROM membre WHERE emailMembre="'.$email.'" AND activationToken="'.$token.'" AND compteActive = 0'; 
	
	$pdo = dbconnection();
	
	#UPDATE query:

		$updateSql='UPDATE membre SET compteActive=1 WHERE emailMembre="'.$email.'" AND activationToken="'.$token.'" AND compteActive= 0';
		$stmt = $pdo->prepare($updateSql);
		$db = $stmt->execute();
	#SELECT query:
		$stmt = $pdo->query('SELECT name FROM users');
		while ($row = $stmt->fetch())
		{
			echo $row['name'] . "\n";
		} '
		// -------------- //
		'
		$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND status=?');
		$stmt->execute([$email, $status]);
		$user = $stmt->fetch();
		// or
		$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND status=:status');
		$stmt->execute(['email' => $email, 'status' => $status]);
		$user = $stmt->fetch();
		 
