<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("Z�ro fansub", 1));
	$page->addComponent(new Archives());
	
	$newsList = array();
	foreach(News::getAllTeamNews() as $news) {
		// TODO remove the 'test' feature when the refinement will be completed
		if ($news->getTimestamp() !== null && $news->getTimestamp() <= time() || isset($_GET['test'])) {
			$hMode = $_SESSION[MODE_H];
			if (!$hMode && $news->displayInNormalMode() || $hMode && $news->displayInHentaiMode()) {
				$newsList[] = $news;
			}
		}
	}
	usort($newsList, array('News', 'timestampSorter'));
	foreach($newsList as $news) {
		$page->addComponent(new NewsComponent($news));
	}
	
	// rewrite the archive header as a footer
	$page->addComponent(new Archives());
	
	// TODO remove when all the news will be refined
	$page->setStyle("margin-left:0;");
	$page->writeNow();
	$page->clear();
?>
---------------------------
<h2>Sondage : Vos s�ries pr�f�r�es, les r�sultats</h2>
<h4>31/03/2010 par db0</h4>
<div class="p">
<img src="images/news/sondageres.png" /><br />
Nous vous avons laiss� 5 jours pour r�pondre au sondage et le nombre de participants nous a positivement �tonn�, �tant donn� que le nombre de visiteurs est en baisse compar� � l'an dernier.<br />
Vous avez �t� 24 personnes � participer et � d�fendre votre s�rie pr�f�r�e.<br />
Les votes ont �t� comptabilis�s de la mani�re suivante : Une s�rie en premi�re place vaut 5 points, deuxi�me 4, trois�me 3, quatri�me 2 et cinqui�me 1. Si vous n'avez vot� que pour une s�rie, vous lui avez donn� 5 points. J'ai v�rifi� rapidement les adresses IP et il n'y a pas eu d'ab�rances donc je consid�re que personne n'a trich�.<br />
Sans plus attendre, les r�sultats :
<a href="index.php?page=series/kissxsis"><img src="images/series/kissxsis.png" border="0" alt="KissXsis"></a><br />
KissXsis, OAV3 et s�rie avec 51 points. La s�rie benn�ficiera donc du mode Toradora! d�s sa sortie. Pour ceux qui ne conaissent pas le mode Toradora!, c'est le nom que la team donne aux s�ries dont les �pisodes sortent moins d'une semaine apr�s la vosta.<br />
<a href="index.php?page=series/kujibiki"><img src="images/series/kujibiki.png" border="0" alt="Kujibiki Unbalance 2"></a><br />
En seconde place, Kujibiki Unbalance 2 avec 44 points. Pour �tre honn�tes, nous nous attendions � avoir Kanamemo en seconde place. Ceci nous montre que beaucoup de leechers foncent sur la premi�re sortie d'une s�rie, et si Kujibiki Unbalance avait �t� fait par une autre team plus rapide, elle n'aurait s�rement pas cette place-l�. D��us, mais nous nous doutions bien que la plupart des gens pr�f�rent la rapidit� � la qualit�.<br />
<a href="index.php?page=series/kimikiss"><img src="images/series/kimikiss.png" border="0" alt="Kimikiss pure rouge"></a><br />
Kimikiss Pure Rouge, avec 28 points. Ici, c'est l'�tonnement inverse. Une s�rie pour laquelle nos �pisodes sont tous � refaire d� � leurs m�diocrit� (des v2 dont pr�vus pour les �pisodes 1 � 6) et termin�e chez plusieurs autres teams. Nous sommes dans l'incompr�hension, mais �a nous fait plaisir de voir qu'on attends cette s�rie de nous :)<br />
<a href="index.php?page=series/kannagi"><img src="images/series/kannagi.png" border="0" alt="Kannagi"></a><br />
Kannagi remporte 27 points. Nous n'avons pas encore sortis d'�pisodes pour cette s�rie malgr� qu'ils soient presque tous termin�s car nous pensions que cette s�rie n'aurait pas beaucoup de succ�s. Une quatri�me place, c'est pas mal, il va falloir qu'on s'y mette.<br />
<a href="index.php?page=series/kanamemo"><img src="images/series/kanamemo.png" border="0" alt="Kanamemo"></a><br />
Kanamemo avec 23 points. Grosse d�c�ption pour une s�rie que nous mettions en priorit� sur les autres avant ce sondage. Nous soup�onnons nos fans de pr�f�rer nos concurrents pour une s�rie qui refl�te pourtant l'�tat d'esprit de notre �quipe.<br />
<a href="index.php?page=series/hitohira"><img src="images/series/hitohira.png" border="0" alt="Hitohira"></a><br />
Hitohira avec 17 points. Rien d'�tonnant, nous savions que cette s�rie n'avait pas beaucoup de succ�s.<br />
<a href="index.php?page=series/potemayo"><img src="images/series/potemayo.png" border="0" alt="Potemayo"></a><br />
Potemayo avec 9 points. Un tout petit peu d��u mais pas �tonn�s pour autant. La s�rie est un peu niaise, mais moi je l'aime beaucoup ^^<br />
<a href="?page=havert"><img src="images/series/hshiyo.png" alt="Faisons l'amour ensemble, Issho ni H shiyo" border="0"></a><br />
En bon dernier, Issho ni H shiyo avec 5 points (un seul vote). Et pourtant, les statistiques sont claires, ce sont les henta�s qui nous rapportent le plus de visiteurs, les �pisodes sont beaucoup plus t�l�charg�s en ddl et ce sont les torrents henta�s qui sont le plus seed�s. Au niveau popularit�, nous savons que ce sont de loins les henta�s qui l'emportent, mais nous savons aussi que ce sont les fans de henta�s qui sont le moins verbeux. Tant pis pour eux ! Nous prendrons en compte les r�sultats de ce sondage.<br /><br />
Encore merci � tous d'avoir vot� ! `A bient�t pour les sorties tr�s prochaines de Kujian et Isshi ni H shiyo !
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t218.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=218" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Sondage : Quelles sont vos s�ries pr�f�r�es ?</h2>
<h4>26/03/2010 par db0</h4>
<div class="p">
<img src="images/news/newssondage.png" /><br />
Vous commencez � nous conna�tre !<br />
Du moins, si vous lisez nos news un peu longues.<br />
Je r�sume.<br />
L'�tat d'esprit Z�ro est simple : Nous ne faisons pas du fansub pour nous, pour faire plaisir � nous-m�mes, mais pour promouvoir l'animation japonaise, permettre l'accessibilit� aus francophones aux s�ries qu'ils ne peuvent pas trouver (en France), et nous respectons le fameux slogan "Par des fans, pour des fans.".<br />
Oui, mes amis !<br />
Ce que l'�quipe Z�ro fait, du simple sous-titrage � la recherche de qualit�, c'est pour vous tous, et uniquement pour vous que nous le faisons.<br />
C'est la raison pour laquelle j'ai d�cid� aujourd'hui d'effectuer un sondage pour r�pondre au mieux � vos attentes.<br />
<b>Quelles sont vos s�ries pr�f�r�es, parmi celles que nous sous-titrons ? Lesquelles attendez-vous avec le plus d'impatience ?</b><br />
Pour y r�pondre, c'est tr�s simple, il suffit de poster un commentaire avec soit une liste, soit un argumentaire, bref, ce que vous voulez pour d�fendre vos s�ries pr�f�r�es.<br />
� l'issue de ce sondage, nous vous annoncerons les r�sultats, et les s�ries les plus attendues seront mises en priorit� dans notre travail pour toujours mieux vous satisfaire.<br />
J'�sp�re que vous serez nombreux � nous donner votre avis !<br /><br />
<a href="index.php?page=series/hitohira"><img src="images/series/hitohira.png" border="0" alt="Hitohira"></a><br /><br />
<a href="index.php?page=series/kanamemo"><img src="images/series/kanamemo.png" border="0" alt="Kanamemo"></a><br /><br />
<a href="index.php?page=series/kannagi"><img src="images/series/kannagi.png" border="0" alt="Kannagi"></a><br /><br />
<a href="index.php?page=series/kimikiss"><img src="images/series/kimikiss.png" border="0" alt="Kimikiss pure rouge"></a><br /><br />
<a href="index.php?page=series/kissxsis"><img src="images/series/kissxsis.png" border="0" alt="KissXsis"></a><br /><br />
<a href="index.php?page=series/kujibiki"><img src="images/series/kujibiki.png" border="0" alt="Kujibiki Unbalance 2"></a><br /><br />
<a href="index.php?page=series/potemayo"><img src="images/series/potemayo.png" border="0" alt="Potemayo"></a><br /><br />
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t217.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=217" target="_blank">R�pondre au sondage</a> ~</span><br /><br /></div>
<p></p>

<h2>Tracker torrent, le retour ! Recrutement Seeders</h2>
<h4>09/02/2010 par db0</h4>
<div class="p">
<img src="images/news/seedep.png" /><br />
.Apr�s une tr�s longue pause, notre tracker torrent est de retour ! Tarf a repris les r�nes et nos �pisodes ne devraient pas tarder � �tre disponibles en torrent.<br />
Oui, mais pour qu'il marche jusqu'au bout, il nous faut du monde qui soit l�, pr�t � sacrifier un peu de leur connexion pour partager avec Tarf nos �pisodes.<br />
Si vous �tes interess� pour devenir seeder de la team, cliquez sur le lien de postulat ci-dessous. Nous �sp�rons que vous serez nombreux � nous aider !
<br /><br />
<span>~ <a href="http://forum.zerofansub.net/posting.php?mode=newtopic&f=21" target="_blank">Postuler en tant que seeder</a> ~</span><br /><br /></div>
<p></p>

<h2>Konshinkai fansub, la r�union des amateurs de fansub fran�ais</h2>
<h4>17/01/2010 par db0</h4>
<div class="p">
Le rendez-vous est fix� pour la prochaine convention : Paris manga.<br />
C'est donc le 6 F�vrier.<br />
On reste sur le m�me restaurant qu'� Konshinkai 1, un petit restaurant Jap' tr�s sympathique et pas tr�s cher pr�s de Charle de Gaulle �toile. Toutes les infos pour s'y rendre sont sur le site partie "Rendez-vous".<br />
<br />
Pour ceux qui ne conaissent pas encore Konshinkai, c'est une r�union de fansubbeurs et d'amateurs de fansub fran�ais (comme vous �tes s�rement puisque vous �tes chez Z�ro fansub ;))<br />
<br />
Dans un petit restaurant, nous discutons sans prise de t�te et chacun expose ses points de vue dans une ambiance sympathique.<br />
<br />
Nous en sommes aujourd'hui � la troisi�me �dition et les membres de Z�ro risquent fort d'y �tre, donc si vous voulez les rencontrer mais aussi discuter ensemble de nos passions communes, nous vous attendons avec impatience !<br />
<br />
Venez nombreux, parlez en autours de vous !<br />
<br />
<a href="http://konshinkai.c.la" target="_blank">Le site officiel Konshinkai fansub, pour plus d'informations
<br /><br />
<img src="archives/konshinkai/images/interface/konshinkai3.png" width="600" alt="Konshinkai fansub" /></a><br />
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t183.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=183" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Joyeux Anniversaire ! Z�ro a deux ans.</h2>
<h4>18/12/09 par db0</h4>
<div class="p"><img src="images/news/anniv1.jpg" /><br />
Aujourd'hui est un grand jour pour Z�ro et pour la db0 company ! Cela fait maintenant exactement deux ans que le groupe Z�ro existe, donc j'en profite pour faire un petit r�sum� de ces deux ann�es riches en evennements.<br />
db0 cr�er le site "Z�ro", qui vient de la derni�re lettre de son pseudo le 18 d�cembre 2007. Au d�part, c'est un �ni�me site de liens MU et torrent pour t�l�charger des animes. db0 rencontre ensuite Genesis et se met au fansub. Elle cr�ait ensuite avec et gr�ce � cette �quipe une nouvelle �quipe de fansub qui prend la place de l'ancien site Z�ro mais garde le design. Les d�buts de Z�ro sont difficiles. La formation fansub de db0 s'est en grande partie faite par Klick et le reste de l'�quipe Genesis. D'autres membres ont ensuite rejoint l'�quipe, dont praia qui deviendra par la suite le co-administrateur de l'�quipe. Ryocu rejoint ensuite l'�quipe en nous hebergant le site et les �pisode en DirectDownload. L'�quipe s'agrandit petit � petit, devient amie avec Maboroshi, Kanaii, Animekami, Moe, Kyoutsu, Sky, ect. db0 et Ryocu reprennent ensemble la db0 company et tout ses nombreux sites, dont Anime-ultime et Stream-Anime. Ces sites nous co�tent actuellement dans les environs de 300 � 350� par mois, et nous avons toujours beaucoup de mal � les financer. Un quatri�me "gros" site devait ouvrir cet �t� mais est sans cesse repouss� pour des raisons financi�res. Stream-Anime a malheuresement ferm� ses portes recemment, emportant avec lui ses plus de 5000 vid�os en streaming haute qualit�. Malgr� ce triste bilan financier, Z�ro et la db0 company se porte plut�t bien. Z�ro a d�sormais une �quipe soud�e et motiv�e qui ne risque pas de s'arr�ter de si t�t. Pour plus d'informations sur la db0 company, un historique complet et d�taill� est disponible sur le forum.<br /><br />
Concernant les �vennements � venir, un nouveau design de Z�ro fansub et d'Anime-Ultime sont pr�vu. La db0 company devrait bient�t ouvrir un site et regrouper les communaut�s.<br /><br />
Pour finir, je tenais � remercier toutes les personnes qui nous soutiennent. Financierement bien s�r, mais aussi avec les commentaires qui nous vont droit au coeur et qui nous donnent envie d'avancer. Sachez que Z�ro a un �tat d'esprit qui s'�loigne beaucoup de celui des autres �quipes de fansub. Nous ne faisons pas du fansub parce qu'on prend notre pied en sous-titrant des animes (oh oui encore plus de time plan, j'aime �a !), mais parce que nous sommes avant tout fans de l'animation japonaise et c'est avant tout pour vous, les fans comme nous, que nous sous-titrons des animes. C'est la raison pour laquelle nous sommes toujours � l'�coute de nos fans ador�s, que nous tenons �norm�ment compte des commentaires sur le site qui nous guident sur ce que nous fansubbons en priorit�. C'est gr�ce � vous et surtout pour vous que nous existons. Votre soutien nous fait vivre et nous donne envie d'aller plus loin. Merci.<br /><br />
Et Bon Anniversaire Z�ro ! <br /><br />
<img src="images/news/anniv2.jpg" />
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t155.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=155" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Recrutement Editeur ASS/AE</h2>
<h4>10/12/09 par db0</h4>
<div class="p"><img src="images/news/edit.jpg" /><br />
J'ai toujours tenu depuis la cr�ation de l'�quipe Z�ro � m'occuper personnellement des edits des �pisodes. On peut d'ailleurs voir l'�volution de mon niveau au fur et � mesure des �pisodes :)  Cependant, aujourd'hui, Z�ro conna�t un r�el ralentissement et j'en prend l'enti�re r�sponsabilit� : ayant commenc� mes �tudes sup�rieures, j'ai bien moins de temps que ce que j'en avais � l'�poque o� j'�tais lyc�enne. J'ai donc d�cid�, avec certes quelques regrets, d'int�grer un nouveau membre dans l'�quipe pour faire les edits � ma place.<br /><br />
Nous recrutons donc un <b>�diteur ASS ou After Effect</b> si possible exp�riment�, ayant un minimum de capacit�s et de motivation. Si vous �tes interess�s, postez un topic dans la partie recrutement du forum avec la fiche de renseignement suivante :<br />
[b]R�le[/b] REMPLIR<br />
[b]Pr�nom[/b] REMPLIR<br />
[b]�ge[/b] REMPLIR<br />
[b]Lieu[/b] REMPLIR<br />
[b]Motivation[/b] REMPLIR<br />
[b]Exp�rience fansub[/b] REMPLIR<br />
[b]Exp�rience hors fansub[/b] REMPLIR<br />
[b]CDI ou CDD (dur�e) ? [/b] REMPLIR<br />
[b]Disponibilit�s[/b] REMPLIR<br />
[b]D�j� membres d'autre �quipe ?[/b] REMPLIR<br />
[b]Si oui, lesquelles ?[/b] REMPLIR<br />
[b]Connexion internet[/b] REMPLIR<br />
[b]Syst�me d'exploitation[/b] REMPLIR<br />
[b]Autre chose � dire ?[/b] REMPLIR<br /><br />
Ainsi que le tr�s important test de validation. Le test est le suivant :<br />
R�aliser l'edit du titre de d�but le plus ressemblant possible au titre de la s�rie, � la diff�rence qu'il ne doit pas y avoir �crit le titre de la s�rie mais "Z�ro fansub" ou "Z�ro fansub pr�sente". Ass ou After Effect. Vous pouvez nous envoyer : soit un script, soit une vid�o encod�e ET un script. Au choix :<br />
- <a href="http://zerofansub.net/ddl/RAW_Kanamemo/%5bZero-Raws%5d%20Kanamemo%20-%2001%20RAW%20(TVO%201280x720%20x264%20AAC%20Chap).mp4">Titre Kanamemo, � 01:03:60</a> (mouvant obligatoire)<br />
- <a href="http://zerofansub.net/ddl/RAW_KissXsis/Kiss%d7sis_OAD_2_Raw_Travail_ED_non_bobb%e9.avi">Titre KissXsis, � 02:03:12</a> (immobile ou mouvant)<br />
J'�sp�re que vous serez nombreux � r�pondre � notre demande ! Merci � tous de suivre nos �pisodes.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t154.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=154" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Konshinkai ~ fansub</h2>
<h4>26/10/09 par db0</h4>
<div class="p"><img src="images/news/afkonsh.png" /><br />
Bonjour cher ami gentils amis leechers.<br /><br />

"Encore une nouvelle �quipe de fansub ?", vous allez vous dire, avec le titre de la news. Eh bien non ! "Konshinkai" signifie en japonais "R�union amicale", et c'est exactement le but de notre projet.<br /><br />

Notre but est de r�unir toutes les �quipes de fansub fran�aise � une petite soir�e pour discuter amicalement de notre passion commune : le fansub. Nous invitons donc toutes les personnes travaillant dans le fansub, et pas seulement les chefs d'�quipes, toutes les personnes ayant d�j� travaill� dans le fansub et les plus grands fans de cette activit� � se r�unir autours d'une table dans un restaurant japonais pour se rencontrer, �changer, discuter et s'amuser, sans aucune prise de t�te.<br /><br />

L'�vennement se d�roule � Paris, et comme nous savons bien que tout le monde n'est pas apte � se d�placer librement sur Paris, nous avons d�cid� de le faire pendant les conventions parisiennes sur la jap'anime, puisque c'est � ce moment l� que nos chers otaku ont tendance � se d�placer, se d�gageant difficilement de leur chaise ador�e bien cal�e devant leurs ordinateurs (je caricature, hein).<br /><br />

Nous comptons renouveler l'�venemment pour plusieurs occasions, �sperant ainsi rencontrer un maximum de personnes ! Ne soyez pas timides, rejoignez-nous, venez nombreux !<br /><br />
<b>Prochaine rencontre : Samedi 30 octobre � 20h, pendant la Chibi Japan Expo. Venez nombreux ! Plus d'informations sur notre site : <a href="http://konshinkai.c.la/" targt="_blank">Konshinkai Site Officiel</a></p></b><br /><br />

L'�quipe Konshinkai fansub, r�unions amicales entre fansubbeurs fran�ais.<br /><br />

P.S. : Nous vous serions tr�s reconaissant de faire part de cette �venement autours de vous, aux membres de votre �quipes, aux autres �quipes, � vos amis fansubbeurs et pourquoi pas faire une news sur votre site officiel.

<br /><br />
<span>~ <a href="http://www.i-services.net/membres/livredor/livredor.php?uid=154226&sid=100601" target="_blank">Commentaires</a> - <a href="http://www.i-services.net/membres/livredor/livredor.php?uid=154226&sid=100601" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Canaan 12 + Piscine + Partenariats + Maboroshi + Kobato</h2>
<h4>4/10/09 par db0</h4>
<div class="p"><img src="images/news/piscine.jpg" style="float: left;" />
Tout d'abord, la sortie du <b>12e �pisode de Canaan</b>. On change compl�tement de d�cor par rapport aux pr�c�dents �pisodes. Cet �pisode est centr� sur la relation entre Canaan et Alphard, ainsi que les pouvoirs de Canaan.<br /><br />
Ensuite, <b>db0 va a la piscine !</b> (Elle a mis son joli maillot de bain, et tout, comme sur l'image) Elle sera donc <b>absente du 5 au 26 octobre inclus</b>. En attendant, l'�quipe Z�ro va essayer de continuer � faire des sorties quand m�me, et c'est ryocu qui se chargera de faire les news.<br /><br />
Puis, deux nouveaux partenaires : <b>Gokuraku-no-fansub</b> et <b>Tanjou-fansub</b>.<br /><br />
Enfin, une bonne nouvelle. Si certains n'�taient pas au courant, j'annonce : <b>Maboroshi no fansub a r�ouvert ses portes</b>. L'incident de fermeture �tait d� � une mauvaise entente entre la personne qui h�bergeait le site et le reste de l'�quipe. J'ai repris les r�nes ! C'est maintenant moi qui g�re leur site. Du coup, il n'y a aucun risque de fermeture ou de mauvais entente :). Ils prennent un nouveau d�part, et ont d�cid� de ne pas reprendre leurs anciens projets, sauf Hakushoku to Yousei d�e � la forte demande.<br /><br />
Pour finir, <b>Kobato</b>, dans la liste de nos projets depuis juin, ne se fera finalement pas. Kaze nous a devanc� et a achet� la licence.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t137.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=137" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Paris Manga</h2>
<h4>01/09/09 par db0</h4>
<div class="p"><img src="images/news/parismanga.jpg" /><br />
Paris Manga est une petite convention se d�roulant � Paris (logique) le 12 et 13 septembre � l'espace Champerret. Z�ro y sera ! Donc n'h�sitez pas � venir nous voir, on est gentil et on mord pas ^^ Et comme d'habitude, je participe aux concours cosplay. Venez m'encourager samedi � partir de 14h sur sc�ne en cosplay individuel et dimanche � partir de 14h en cosplay groupe avec un costume sp�cial Z�ro fansub !<br /><br />
L'�quipe de fansub n'est actuellement pas en mesure de vous proposer des sorties d'animes : L'encodeur Lepims est en vacances et dieu (db0) d�m�nage.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t119.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=119" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Recrutement traducteur Mermaid Melody</h2>
<h4>10/08/09 par db0</h4>
<div class="p"><img src="images/news/mermaid.jpg"><br />
Nous avons �t� tr�s �tonn� du succ�s qu'a eu notre demande de recrutement pour l'anime Hitohira et nous avons aujourd'hui un nouveau traducteur pour cette s�rie : whatake.<br />
Aurons-nous autant de succ�s pour ce deuxi�me appel...? Je l'esp�re ! Mais avant cela, je vous vous expliquer la situation. Nous avons commenc� la s�rie Mermaid Melody Pichi Pichi Pitch en Vistfr et MnF l'a fait en Vostfr. Nous avons d�cid� d'abbandonner la s�rie en Vistfr et de la continuer en Vostfr. 13 �pisodes de cette s�rie sont sortis. Vous pouvez t�l�charger l'�pisode 01 ici : <a href="http://www.megaupload.com/?d=ZZQNU3UZ" target="_blank">Episode 01</a><br />
Nous recherchons quelqu'un de motiv� qui aime les animes magical girl pour continuer cette s�rie avec nous ! N'h�sitez pas � postuler ! Merci de votre aide.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t111.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=111" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Infos T�l�chargements</h2>
<h4>09/08/09 par db0</h4>
<div class="p">Depuis un incident de surcharge de t�l�chargements ayant fait planter toute la db0 company (anime-ultime, Z�ro et tout les autres), nous avons d�cid� de limiter les t�l�chargements. Nous avons annonc� �a clairement, et pourtant, nous continuons � recevoir dans le topics des liens morts qui ne le sont pas. Donc aujourd'hui, j'insiste : Si vous �tes d�j� en train de t�l�charger un �pisode sur notre site, vous ne pourrez en telecharger un autre qu'apr�s le premier t�l�chargement termin� ! Si le message suivant arrive :<br /><br />
"Service Temporarily Unavailable<br />
The server is temporarily unable to service your request due to maintenance downtime or capacity problems. Please try again later."<br /><br />
Ne vous affolez pas : Attendez la fin de votre premier t�l�chargement. Il peut arriver que ce message arrive alors que vous n'�tes pas en train de t�l�charger. Dans ce cas, attendez 30 secondes puis actualisez la page � nouveau, et ceci jusqu'� ce que votre t�l�chargement se lance. Merci � tous !
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t110.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=110" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Canaan 04 + 05 + Rythme Toradora!</h2>
<h4>06/08/09 par db0</h4>
<div class="p"><img src="images/news/can45.jpg" alt="" /><br />
Des bunny girls, des blondasses, et tout �a qui se fait des c�lins ! Si c'est pas mignon, tout �a ! Non, pas tant que �a, si on remet l'image dans le contexte. Je vous laisse d�couvrir tout �a dans la double sortie du jour. Double sortie, pourquoi ? Bah justement. J'ai bien envie de faire des news longues ses derniers temps, donc je vais vous expliquer ce que j'appelle "le rythme Toradora!".<br />
Pour ceux qui nous ont connus � l'�poque Toradora!, � l'"apog�e" de la carri�re de Z�ro, vous vous souvenez sans doute du rythme sp�ctaculaire auquel les sorties s'encha�naient. C'�tait de l'ordre de une sortie tout les deux jours, voir tout les jours ! Pour vous, qui attendez sagement derri�re vos �crans, c'est tout b�n�f'. Mais ce que vous ne savez pas, c'est que �a travaille, derri�re la machine. Nous ne sommes pas une �quipe de Speedsub, alors comment r�aliser un tel exploit sans perdre de la qualit� des �pisodes ? Non, non, nous ne savons toujours pas ralentir le temps. Quel est notre secret ? Tout d'abord, sachez qu'il faut minimum 20 heures de boulot pour sortir un �pisode chez Z�ro (traduction-adaptation-correction-edition-time-v�rification finale) encodage non compris. Et que g�n�ralement, nous r�partissons ses heures sur des semaines. Pour suivre le rythme Toradora!, c'est simple : Etaler ses 20 heures minimum (je dis bien minimum parce qu'en fait c'est beaucoup plus long) sur une seule journ�e. C'est-�-dire sacrifier une journ�e + une nuit. Pour Toradora!, suivre ce rythme n'�tait pas trop dur puisque nous �tions en coproduction, ce qui nous permettait de faire des pauses de temps en temps dans ces looongues journ�es de fansub. Mais nous avons d�cid� de reprendre ce rythme, pour montrer � nos amis leechers que nous n'avons pas vieilli ! C'est pourquoi nous avons choisi un anime qui nous tient � coeur, � Ryocu et moi-m�me : Canaan. Ici, nous ne sommes pas en coproduction, mais comme nous sommes en vacances, nous pouvons nous permettre de sacrifier deux journ�es par �pisode de Canaan. Oui, deux jours, car il me faut bien faire des pauses, et comme je m'occupe de tout sauf de la v�rification finale et que je suis humaine, je ne peux pas me permettre de taffer 24h d'affil�e sans faiblir un chouilla.<br />
Bref, je raconte pas tout �a pour me la p�ter, mais juste pour vous �xpliquer ce que repr�sente un rythme accel�r� pour une �quipe de bon sub et pas de speedsub. Je raconte �a aussi parce que j'ai �t� d��u par des r�actions de personnes qui se sont dit rapide = mauvais sub. Je vous prouve ici que nous travaillons dur pour vous !!<br />
Et l�, je finirai sur une question qui vous turlupine depuis tout � l'heure : Comment se fait-il que vous ne nous sortiez ses �pisodes que maintenant ? La r�ponse est simple : J'avais pas internet dans le trou paum� o� je suis pour mes vacances :p<br />
Et histoire de craner un peu : Ryocu et moi passons de superbes vacances en bord de mer dans une grande maison avec piscine dont nous profitons entre deux Canaan.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t109.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=109" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[IRL] Japan Expo 2009</h2>
<h4>15/06/09 par db0</h4>
<img src="images/news/japan10.jpg" style="float:right;" border="0">
<div class="p">Vous y allez ? �a tombe bien, nous aussi !<br />
Pour s'y rencontrer, signalez-vous dans le topic d�di� � cette convention sur le forum : <a href="http://forum.zerofansub.net/t196-japan-expo-2009.htm" target="_blank">http://forum.zerofansub.net/t196-japan-expo-2009.htm</a><br />
Il y aura comme toujours la petite bande de chez Kanaii en plus de celle de chez Z�ro.<br />
J'ai pr�vu plusieurs concours cosplay :<br />
Cosplay Standart Jeudi 13h (Kodomo no Jikan)<br />
WCS Pr�-selection Samedi 13h concours 15h (Surprise)<br />
Pen of Chaos Dimanche 13h (Dokuro-chan)<br />
Venez m'y voir ^^ Si vous voulez :)<br /><br />
Rappel : La team est toujours en pause jusqu'� Juillet !
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t96.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=96" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[IRL] Epitanime 2009</h2>
<h4>06/06/09 par db0</h4>
<div class="p">C'�tait du 29 au 31 mai, et c'�tait un tr�s grand evenement. Bien malheureux sont ceux qui l'ont rat�s ! Et qui, surtout, on rat� db-chan ! Oui, il faut le dire, le plus important � Epitanime, c'�tait elle :P Il fallait �tre l�, car j'avais pr�vu pour tout les membres de la team Z�ro mais aussi toutes les personnes qui viennent r�gulierement chez Z�ro une petite surprise.<br />
Ce week-end, j'ai donc crois� Sazaju (notre traducteur), Ryocu, Guguganmo et des tas de copains-cosplayeurs dont je ne vous citerait pas le nom puisque vous ne les conna�trez s�rement pas.<br /><br />
J'ai particip� au concours cosplay le samedi 30 mai � 12 heure. � vous de deviner quel personnage j'incarnait :<br />
<img src="images/news/cosplay01.jpg" /><br />
Vous ne trouvez pas ? Oui, je sais, c'est tr�s difficile. Pour voir qui c'�tait, lisez la suite.<br /><br />
<a href="index.php?page=dossier/epitanime2009"><img src="images/interface/lirelasuite.png" alt="[ Lire la suite . . . ]" border="0" /></a>
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t79.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=79" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Epitanime 2009</h2>
<h4>19/05/09 par db0</h4>
<img src="http://www.epita.fr/img/design/logos/epitanime-logo.jpg" style="float:right;" border="0">
<div class="p"><br />
Date � retenir : 29-30-31 mai 2009 ! Durant ses trois jours se d�rouleront un �venement de taille : la 17�me �dition de l'Epitanime ! Une des meilleures conventions et des plus vieilles. Plus pratique pour les parisiens puisqu'elle se d�roule au Kremlin-Bic�tre (Porte d'Italie). Si vous avez la possibilit� de vous y rendre, faites-le ! db-chan vous y attendra ^^<br /><br />
<span>~ <a href="http://forum.zerofansub.net/t525-Epitanime-2009.htm" target="_blank">Commentaires</a> - <a href="http://forum.zerofansub.net/posting.php?mode=reply&t=525" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>forum.zerofansub.net</h2>
<h4>18/05/09 par db0</h4>
<img src="images/news/favoris.png" style="float:right;" border="0">
<div class="p"><br />
Le forum change d'adresse : <br />
<a href="http://forum.zerofansub.net/" target="_blank"><span style="font-size: 22px;">http://forum.zerofansub.net</span></a><br />
Faites comme Mario, mettez � jour vos favoris !<br /><br />
<span>~ <a href="http://forum.zerofansub.net/t588.htm" target="_blank">Commentaires</a> - <a href="http://forum.zerofansub.net/t588.htm" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>The legend of Melba : Tonight Princess + Newsletter</h2>
<h4>17/05/09 par db0</h4>
<div class="p"><a href="http://melbaland.free.fr/" target="_blank"><img src="http://img8.imageshack.us/img8/6162/bannirepapyo.jpg" border="0"></a><br />
Papy Al, QC de la petite �quipe, a sorti hier soir le premier �pisode de sa saga mp3. <a href="http://melbaland.free.fr/" target="_blank">Pour l'�couter, c'est par ici !</a><br /><br />
Vous ne le savez peut-�tre pas, mais Z�ro envoie � chaque news une newsletter ! Pour la recevoir, il suffit de s'inscrire sur le forum. Il n'est pas demand� de participer ni quoi que ce soit.<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t73.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=73" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[Zero] Merci !</h2>
<h4>11/05/09 par db0 et Ryocu</h4>
<div class="p"><img src="images/news/merci.jpg" border="0"><br />Toute l'�quipe Z�ro fansub et toute la db0 company (Anime-Ultime, Stream-Anime, Z�ro, Kojikan, ect) tient � remercier chalereusement les personnes suivantes pour leurs r�ponses � notre appel � l'aide :<br />
Herv� (14�)<br />
Nicolas (10�)<br />
Guillaume (5�)<br />
Fabrice (20�)<br />
Luc (10�)<br />
Julien (40�)<br />
Bkdenice (15�)<br />
Pascal (10�)<br />
Mathieu (25�)<br />
Ces sommes ne nous permettent certes pas de nous sortir de nos probl�mes d'argent actuels, mais nous aident �norm�ment � remonter peu � peu la pente ! Nous reprenons du courage et la force de continuer � tenir en forme les sites de la db0 company. Encore une fois, merci.<br />
//Ryocu et db0<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t71.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=71" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Genshiken2 08 + Sortie Kanaii</h2>
<h4>10/05/09 par db0</h4>
<div class="p"><img src="http://moe.mabul.org/up/moe/2009/05/10/img-122101gdcpq.png" border="0"><br />3 sorties en une journ�e, c'est un cas plut�t rare ! La suite de Genshiken2, c'est<a href="http://zerofansub.net/index.php?page=series/kodomoo">par l�</a> avec l'�pisode 08 qui sort aujourd'hui. Plus tar dans la soir�e sortieront les versions LD de Kodomo oav2 et md, ld de Maria Holic 08.<br /><br />
Une petite sortie Kanaii-Z�ro est organis�e entre Otaku le 23 et 24 mai � Nice ! Les sudistes pourront ainsi se retrouver sur nos plages ensoleill�es pour se sentir un peu en vacances. Et les nordistes, n'h�sitez pas � descendre nous voir ! Si vous souhaitez �tre de la partie, n'h�sitez pas ! Envoyez-moi un mail (zero.fansub@gmail.com) ou venez vous signaler sur le forum Kanaii : <a href="http://www.kanaii.com/e107_plugins/forum/forum_viewtopic.php?46591" target="_blank">Lien</a>. Venez nombreux !
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t70.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=70" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>C'est la crise !</h2>
<h4>01/05/09 par db0</h4>
<div class="p">
C'est la crise pour tout le monde, et m�me pour nous. Nous n'arrivons plus � payer nos serveurs... On ajoute des publicit�s et on vous sollicite pour des dons, mais rien ne s'am�liore. Depuis le d�but de Z�ro, et sur tout les sites de la db0 company, nous n'avons re�u que 14 � de dons et 75 � de publicit�s. Sachant qu'il nous a fallut environ 80 � (en tout depuis que Z�ro existe) pour l'association humanitaire que Z�ro soutient et que nos serveurs de la db0 company co�te environ 250 � /mois, le calcul n'est pas long, nous sommes dans le n�gatif. Et pauvres petits �tudiants que nous sommes, � d�couvert tout les mois... C'est un appel � l'aide que je lance aujourd'hui, � ceux de Z�ro, de la db0 company, � ceux qui aiment les animes que nous sous-titrons et qui respectent notre travail. Par avance, merci.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t66.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=66" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Kujibiki Unbalance 2 06</h2>
<h4>14/04/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/kuji6.jpg" border="0">
</div>
<div class="p">Apr�s une longue attente sans Kujibiki, la s�rie continue avec l'�pisode 06 (Z�ro n'abbandonne jamais !). Merci � Zetsubo Sensei qui prend le relais pour la traduction.<br /><br />
Ce Week-End, Mangazur � Toulon. Une petite convention tr�s sympa ^^ J'y serais, n'h�sitez pas � me contacter (zero.fansub@gmail.com). Et venez nombreux pour cet �v�nement.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t59.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=59" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[Zero]</h2>
<h4>10/04/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/3.1.png" border="0">
</div>
<div class="p">Du changement sur le site ?<br /><br />
Je ne vois vraiment pas de quoi vous parlez !
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t57.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=57" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Toradora! Licenci�</h2>
<h4>01/04/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/licence.jpg" border="0">
</div>
<div class="p">Triste nouvelle que je vous apporte aujourd'hui ! La premi�re licence d'une de nos s�rie. Avec beaucoup de regrets, nous retirons donc tout les liens de t�l�chargement de la s�rie Toradora!... 
<br />
<span>~ <a href="http://commentaires.zerofansub.net/t54.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=54" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Toradora! Fin - L'impact !</h2>
<h4>30/03/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/ryoc.jpg" border="0">
</div>
<div class="p">Bonjour.<br />
Je suis l'administrateur du site <a href="http://www.anime-ultime.net/part/Site-93" target="_blank">Anime-ultime</a>, et l'admin sys de Z�ro fansub ainsi que toute la <a href="http://db0.fr" target="_blank">db0 company</a>. Je tiens � remercier les personnes qui se sont crues malignes en employant des acc�l�rateurs de t�l�chargement. Gr�ce � ces personnes, plusieurs sites ont �t� inaccessibles. En utilisant ce genre de logiciel, vous bloquez les acc�s aux visiteurs des sites web et vous entra�nez un ralentissement g�n�ral des t�l�chargements (au lieu des les acc�lerer, vous faites en sorte que les disques durs ne puissent plus tenir la cadence et font ralentir tout le monde). Par cons�quent, vous ne pouvez d�sormais plus t�l�charger qu'un seul et unique fichier � la fois sur Zerofansub.net et je demande � toutes les personnes qui utilisent des acc�lerateurs de t�l�chargement d'arr�ter de vous servir de ce genre de logiciel qui plombent les serveurs inutilement en plus d'avoir l'effet contraire � celui d�sir�.<br />
Cette limite n'est pas tr�s s�v�re, soyez compr�hensifs. Profitez bien de la fin de Toradora!, m�me si pour cela, vous devez attendre un peu. Nos releases sont aussi disponibles en torrent.<br />
<br />
<span>~ <a href="http://commentaires.zerofansub.net/t54-Toradora-Licencie.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=54" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Recrutement Karamaker et Gestion tracker BT</h2>
<h4>24/02/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/guilde.jpg" border="0">
</div>
<p>
Z�ro recrute !<br /><br />
<b>Gestion tracker BT</b><br />
Ma connexion actuelle ne me permet pas de t�l�charger, seeder, g�rer notre tracker BT. Nous sommes donc � la recherche de quelqu'un de motiv� et disponible ayant une bonne connexion. Son r�le : T�l�charger nos �pisodes d�s leurs sorties, cr�er le fichier .torrent, se mettre en seed dessus, l'uploader sur le tracker, surveiller les sans source. Nous avons aussi � notre disposition un TorrentFlux en cas de besoin.<br />
Interess� ? Venez vous proposer sur le forum partie Recrutement avec un screen de votre programme de torrent.
<br /><br />
<b>Karamaker</b><br />
Nous recherchons un karamaker uniquement pour les effets (je m'occupe du kara-time) qui est de l'�xp�rience et des id�es (� bannir les karaok�s par d�faut.)<br />
Interess� ? Venez vous proposer sur le forum partie Recrutement avec votre meilleur karaok�.
<br /><br />
Venez nombreux ! Nous avons besoin de vous !
<br /><br />
</p>

<p>KnJ 03 LD V2, Petit point sur nos petites s�ries. 26/01/09 par db0 <br> 	<img src="http://zerofansub.net/images/news/akirin.jpg" border="0" /> <br> Petite v2 qu'on attendait depuis pas mal de temps : L'�pisode 03 de Kodomo no Jikan LD qui avait quelques petits soucis d'encodage. <a href="http://zerofansub.net/dd
