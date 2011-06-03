<?php

if(empty($_GET['type']))
{
	header("Location : index.php?page=general/erreur&type=erreur");
}
else
{
	$class = $_GET['type'];
	$title = ($_GET['type'] == "error") ? "Une erreur est survenue" : "L'action a été correctement effectuée";
}

$msg = (empty($_GET['msg'])) ? 'Une erreur est survenue lors de l\'affichage de la page, veuillez en référer au responsable du site web.' : $_GET['msg'];
$retour = (empty($_GET['retour'])) ? 'page=main' : 'page='.$_GET['retour'];
$opt = (!empty($_GET['opt'])) ? '&'.$_GET['opt'] : '';
?>
<div id="wrapper">
	<div class="box">
		<h2><?php echo $title; ?></h2>
		<p class="<?php echo $class; ?>"><?php echo $msg; ?></p>
		<p><a href="index.php?<?php echo $retour.$opt; ?>">Retour</a></p>
	</div>
</div>

<div id="action">
	<h2>Actions possibles</h2>
	<p>Aucune action possible...</p>
</div>