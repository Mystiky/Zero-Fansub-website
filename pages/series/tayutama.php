<h3>Tayutama -Kiss on my Deity-</h3>


<div style="float : right; display:block; margin-right: 20px;">
	<img src="images/series/tayutama.jpg" border="0">
</div>
<h2>Informations g�n�rales</h2>
<h4>Source : <a href="http://animeka.com/fansub/teams/zero.html" target="_blank">Animeka</a></h4>

<p>
<b>Titre Original</b> Tayutama -Kiss on my Deity-<br />
<b>Site officiel</b> <a href="http://www.tayutama.com/" target="_blank">Tayutama.com</a><br />
<b>Ann�e de production</b> 2009<br />
<b>Studio</b> Silver Link<br />
<b>Genre</b> Amour et Amiti�<br />
<b>Synopsis</b> L'histoire est centr�e sur Yuuri Mito, un �tudiant de l'Acad�mie Sousei et le fils unique de l'homme qui dirige le temple Yachimata. � Yachimata, il y a une l�gende � propos d'une divinit� appel�e Tayutama-sama qui prot�gea la r�gion, mais cette divinit� et d'autres ainsi nomm�es "Tayutai" ont �t� oubli�es avec le temps. Mito et ses amis d�couvrent une relique dans le sol de l'�cole, avec de myst�rieux motifs. D�s lors, � la c�r�monie d'ouverture de la nouvelle ann�e scolaire, une tout aussi myst�rieuse fille appel�e Mashiro appara�t devant Mito. Mashiro est d'une certaine mani�re li�e � la relique et � la l�gende de Tayutama-sama.<br />
<b>Vosta</b> <a href="http://fansubs.anime-share.net/" target="_blank">Anime-Share fansub</a> et Anoymous
</p>

<p style="text-align: right;"><a href="http://zero.xooit.fr/t471-Liens-morts.htm" target="_blank">Signaler un lien mort</a></p><h2>�pisodes</h2>

<?php
	function sortReleases(Release $a, Release $b) {
		return strnatcmp($a->getID(), $b->getID());
	}

	$releases = Release::getAllReleasesForProject('tayutama');
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
<a href="index.php?page=series/tayutamapure"><img src="images/series/tayutamapure.png" border="0" alt="Tayutama - Kiss on my Deity - Pure My Heart"></a><br /><br /> 
</p>

<h2>Bonus : Jaquette(s) DVD</h2>
<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>

<h2>Bonus : Th�mes pour Firefox (Skin Persona)</h2>
<p>
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/236444"><img src="http://getpersonas-cdn.mozilla.net/static/4/4/236444/preview.jpg?1277397610" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/260878"><img src="http://getpersonas-cdn.mozilla.net/static/7/8/260878/preview.jpg?1279817830" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a> 
</p>

<p></p>








