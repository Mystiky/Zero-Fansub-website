<h3>ERIKO</h3>


<div style="float : right; display:block; margin-right: 20px;">
	<img src="images/series/eriko.jpg" border="0">
</div>
<h2>Informations g�n�rales</h2>

<p>
<b>Titre Original</b> ERIKO<br />
<b>Ann�e de production</b> 2007<br />
<b>Auteur</b> Gunma Kisaragi<br />
<b>Genre</b> Doujin<br />
<b>Synopsis</b> Parodie henta� de Kimikiss pure rouge mettant en sc�ne Futami Eriko, l'intello, continuant ses exp�riences encore plus profond�ment avec Kazuki.<br />
</p>

<p style="text-align: right;"><a href="http://zero.xooit.fr/t471-Liens-morts.htm" target="_blank">Signaler un lien mort</a></p><h2>Chapitres</h2>


<?php
	function sortReleases(Release $a, Release $b) {
		return strnatcmp($a->getID(), $b->getID());
	}

	$releases = Release::getAllReleasesForProject('eriko');
	usort($releases, 'sortReleases');
	$list = new SimpleListComponent();
	$list->setClass("releaseList");
	foreach($releases as $release)
	{
		$list->addComponent(new ReleaseComponent($release));
	}
	$list->writeNow();
?>

<p></p>
<h2>Voir aussi</h2>
<p>
<a href="index.php?page=series/kimikiss"><img src="images/series/kimikiss.png" border="0" alt="Kimikiss pure rouge"></a><br /><br />
</p>






