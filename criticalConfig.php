<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<title>Configuration initiale</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="DC.Language" scheme="RFC3066" content="fr" />
		<link rel="stylesheet" href="styles/default/style.css" type="text/css" media="screen" title="Normal" />  
		<link rel="icon" type="image/gif" href="fav.gif" />
		<link rel="shortcut icon" href="fav.ico" />
		<style type="text/css">
			pre.code {
				border: 1px black solid;
				padding: 5px;
			}
			p {
				text-align: justify;
			}
		</style>
	</head>
	<body>
		<div id="main">
			<div id="page">
				<h1>Initialisation des donn�es critiques</h1>
				<?php
					$criticalDataFile = "criticalData.php";
					if (is_file($criticalDataFile)) {
						echo "<p>Le fichier <b>".$criticalDataFile."</b> existe d�j�, vous pouvez <a href='index.php'>retourner � l'index</a>.</p>";
					}
					else {
						echo "<p>Le fichier <b>".$criticalDataFile."</b> n'existe pas, il vous faut donc le cr�er. Pour se faire, ajoutez un fichier portant ce nom � la racine du site (au m�me endroit que l'index) et remplissez-le selon ce mod�le :";
						echo "<pre class='code'>&lt;?php
/*
	This file contains critical data and should never be written
	in git repository (should be in the .ignore file).
*/
define('DB_USE', false);
define('DB_NAME', 'zero-fansub');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'zero');
define('DB_PASS', 'pass');
?></pre></p>";
						echo "<p>Les informations pr�sentes dans ce fichier correspondent aux donn�es de connexions � la base de donn�es. Les noms en majuscules (comme DB_NAME) sont les noms des constantes utilis�es dans le code pour appeler ces donn�es. Les valeurs associ�es (par exemple 'zero-fansub') correspondent aux informations � personnaliser. Ce mod�le est un exemple, libre � vous d'utiliser les m�me valeurs ou de les changer (notamment le mot de passe), les noms des constantes en revanche ne peuvent pas �tre chang�es. Evitez cependant d'utiliser les m�mes valeurs que celles du serveur (si vous les connaissez). Si vous �tes un d�veloppeur qui utilise sa propre base de donn�es pour faire ses tests, vous pouvez r�utiliser ce mod�le tel quel ou changer les donn�es selon vos pr�f�rences.</p>";
						echo "<p>Notez que, comme l'indique le commentaire, ce fichier ne doit jamais �tre versionn�. Plus g�n�ralement il ne doit jamais �tre partag�, et cela pour une simple raison de s�curit�. En effet, si le fichier original devait �tre disponible, n'importe qui ayant acc�s au d�p�t (autrement dit tout le monde, vu que ce code source est disponible de mani�re public) aurait acc�s aux donn�es sensibles du site (nom de la base de donn�e, identifiants de connexion, etc.).</p>";
						echo "<p>Pour toute question, contactez l'administrateur par mail: <a href='mailto:sazaju@gmail.com'>sazaju@gmail.com</a>.</p>";
					}
				?>
			</div>
		</div>
	</body>
</html>
