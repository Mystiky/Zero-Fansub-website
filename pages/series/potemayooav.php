<h3>Potemayo OAV</h3>


<div style="float : right; display:block; margin-right: 20px;">
	<img src="images/series/potemayooav.jpg" border="0">
</div>
<h2>Informations g�n�rales</h2>
<h4>Source : <a href="http://animeka.com/fansub/teams/zero.html" target="_blank">Animeka</a></h4>

<p>
<b>Titre Original</b> Potemayo Special<br />
<b>Site officiel</b> <a href="http://www.potemayo.com/" target="_blank">Potemayo.com</a><br />
<b>Ann�e de production</b> 2008<br />
<b>Studio</b> <a href="http://www.jcstaff.co.jp/" target="_blank">JC Staff</a><br />
<b>Genre</b> Com�die<br />
<b>Synopsis</b> De petites aventures arrivent � Potemayo dans ces �pisodes bonus de la s�rie Potemayo.<br />
</p>

<p style="text-align: right;"><a href="http://zero.xooit.fr/t471-Liens-morts.htm" target="_blank">Signaler un lien mort</a></p><h2>�pisodes</h2>

<?php
	function sortReleases(Release $a, Release $b) {
		return strnatcmp($a->getID(), $b->getID());
	}

	$releases = Release::getAllReleasesForProject('potemayooav');
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
<a href="index.php?page=series/potemayo"><img src="images/series/potemayo.png" border="0" alt="Potemayo"></a><br /><br /> 
</p>

<h2>Bonus : Th�mes pour Firefox (Skin Persona)</h2>
<p>
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/208619"><img src="http://getpersonas-cdn.mozilla.net/static/1/9/208619/preview.jpg?1273490832" border="0" alt="Potemayo theme skin persona mozilla firefox" /></a> 
</p>
