<?php

/**
 * Wrapper de l'application
 */

require_once 'bootstrap.php';

// récupération de la page à afficher
if(!empty($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = $config['defaultPage'];
}

// résolution du path du fichier à afficher
if(file_exists(APP_PATH.'/'.$page.EXT))
{
	$path = APP_PATH.'/'.$page.EXT;
}
else
{
	header('HTTP/1.0 404 Not Found');
	$path = APP_PATH.'/'.$config['error']['404'].EXT;
}

// buffering du résultat
ob_start();

try {
	require $path;
}
catch(PDOException $e)
{
	header('HTTP/1.0 500 Internal Server Error');
	
	if($config['debug_mode'] === true)
	{
		echo display_exception($e);
	}
	else
	{
		require APP_PATH.'/'.$config['error']['500'].EXT;
	}
}
    $display = ob_get_contents();
ob_end_clean();

// fin du routing de l'application, affichage dans le wrapper.

?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Relationship Management</title>
	<meta charset="UTF-8" />
	<meta http-equiv="content-type" content="text/html" />
	<link rel="stylesheet" href="resources/styles/crm.css" type="text/css" media="screen" />
</head>
	
<body>

	<div id="header">
		<h1>CRM</h1>
		<a href="index.php">Accueil</a> - 
		<a href="index.php?page=user/list">Gestion des utilisateurs</a> - 
		<a href="index.php?page=contact/list">Gestion des contacts</a> - 
		<a href="index.php?page=rdv/list">Gestion des rendez-vous</a> - 
		<a href="index.php?page=firm/list">Gestion des organisations</a>
	</div>
	
	<div id="contenu">
		<?php echo $display; ?>
	</div>
</body>
</html>