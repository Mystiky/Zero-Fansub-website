<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("Z�ro fansub", 1));
	$page->addComponent(new Archives());
	
	$newsList = array();
	foreach(News::getAllPartnerNews() as $news) {
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
<h2>Kouhai Scantrad, les chapitres de KissXsis</h2>
<h4>26/08/2010 par db0</h4>
<div class="p">
<a href="http://kouhaiscantrad.wordpress.com/" target="_blank"><img src="http://kouhaiscantrad.files.wordpress.com/2010/08/sans-titre-1.png" width="550px" border="0" alt="Kouhai Scantrad" /></a><br /><br />
Un nouveau partenaire a rejoint la grande famille des amis de Zero : Kouhai Scantrad.<br />
Comme vous le savez, Zero aime vous proposer en plus de vos series preferees tout ce qui tourne autours de celles-ci : Wallpaper, OST, jaquettes DVD et pleins d'autres surprises, mais surtout les mangas d'ou sont tires les series.<br />
C'est pourquoi nous avions fait un partennariat avec l'equipe Ecchi-no-chikara qui vous proposait les chapitres du manga original de KissXsis. Aujourd'hui, cette equipe a fermee, mais heuresement pour vous, fans des deux jumelles, l'equipe Kouhai Scantrad a decide de reprendre le flambeau !<br />
Allez donc visiter leur site pour lire les chapitres et les remercier pour leur travail.
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t247.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=247" target="_blank">Ajouter un commentaire</a> ~<br />
~ <a href="http://twitter.com/home?status=Vous conaissez Kouhai Scantrad ? Ils proposent les chapitres de KissXsis ! http://kouhaiscantrad.wordpress.com/" target="_blank" onclick="javascript:pageTracker._trackPageview ('/outbound/twitter.com');">Partager sur <img src="images/autre/logo_twitter.png" border="0" alt="twitter" /></a> ou <a name="fb_share" type="button" share_url="http://kouhaiscantrad.wordpress.com/"></a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>~</span><br /><br /></div>
<p></p>

<h2>Samazama no Koto recrute !</h2>
<h4>26/08/2010 par db0</h4>
<div class="p">
<img src="images/news/samazama.jpg" alt="Samazama no Koto recrute finger pointed loli" style="float:left;" /><br /><br />
La fin de l'�t� arrive � grand pas, et qui dit rentr�e dit manque de disponibilit�s ! C'est ce qui arrive � nos petits potes de chez Samazama no Koto : ils manquent d'effectifs.<br /><br />
C'est pourquoi ils font appel � <strong>vous</strong>. Oui, vous, l�, qui �tes en train de me lire !<br /><br />
Vous avez plus de 16 ans ? Vous aimez les mangas ecchi/hentais ? Vous avez envie de connaitre le monde qui se cachent derri�re la r�alisation de ces chapitres all�chants ?<br /><br />
N'attendez plus ! Tentez votre chance pour rejoindre cette talentueuse �quipe de Scantrad !<br /><br />
<img src="images/news/mercidons2.png" alt="Merci Alain pour son don de 20 euros ! Touhou Projet money money" style="float:right;" />
Vous devez �tre disponible et tr�s motiv�. Aucune comp�tence n'est requise. Les postes disponibles sont : traducteurs, �diteurs, checkeurs, webmasters, designers, xdcc-makers.
<br />
<br /><br />
Un grand <strong>merci</strong> � Alain pour son don de 20 euros qui va nous aider � payer nos serveurs !<br />
<br />
A bientot !<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t245.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=245" target="_blank">Ajouter un commentaire</a> ~<br />
~ <a href="http://twitter.com/home?status=Samazama no Koto recrute trad, edit, check, etc http://samazamablog.wordpress.com/" target="_blank" onclick="javascript:pageTracker._trackPageview ('/outbound/twitter.com');">Partager sur <img src="images/autre/logo_twitter.png" border="0" alt="twitter" /></a> ou <a name="fb_share" type="button" share_url="http://samazamablog.wordpress.com/2010/08/26/on-a-besoin-de-vous/"></a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>~</span><br /><br /></div>
<p></p>


<h2>Licence de Rosario+Vampire</h2>
<h4>04/05/2010 par La Mite en Pullover</h4>
<div class="p">
<img src="images/news/licencerv.jpg" /><br />
Black Box a acquis les droits des deux s�ries, aussi je vous demande de ne plus distribuer, sur n'importe quel r�seau ou syst�me de t�l�chargement que ce soit, nos fansubs. Si la s�rie vous a plu, soutenez l'�diteur en achetant ses DVD (ou allumez un cierge pour d'�ventuels Bluray).<br />
J'en appelle � tous les sites partenaires de t�l�chargement, � tous les blogs s�rieux et � ceux de kikoololz : stoppez tout, effacez vos liens, supprimez les �pisodes de vos comptes.<br />
Rien ne vous emp�che de harceler Black Box pour avoir du boobies en haute d�finition !<br />
Bon courage � Black Box !
<br /><br />
<span>~ <a href="http://www.kanaii.com/comment.php?comment.news.1627" target="_blank">Commentaires</a> - <a href="http://www.kanaii.com/comment.php?comment.news.1627" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Nouveau partenaire : Samazama na Koto</h2>
<h4>24/04/2010 par db0</h4>
<div class="p">
<a href="http://samazamablog.wordpress.com" target="_blank"><img src="images/news/sama1.jpg" /></a><br />
Un nouveau petit pote partenaire viens s'ajouter aux petits potes de Z�ro :<br />
<a href="http://samazamablog.wordpress.com" target="_blank">Samazama na Koto</a> est une �quipe de Fanscan, Scantrad aux penchants Ecchi et Henta� qui nous propose du contenu d'une certaine qualit� que nous appr�cions.<br />
Allez donc lire quelques-uns de leurs chapitres et revenez nous en dire des nouvelles !<br />
<a href="http://samazamablog.wordpress.com" target="_blank"><img src="images/news/sama2.jpg" /></a>
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t227.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=227" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Nouveau partenaire : Mangas Arigatou</h2>
<h4>24/03/2010 par db0</h4>
<div class="p">
<img src="images/news/newsarigatou2.jpg" /><br />
Bonjour tout le monde !<br />
Un nouveau partenaire se joint aujourd'hui � l'�quipe Z�ro :<br />
Mangas Arigatou !<br />
Un tr�s bon �tat d'esprit, un petit grain de folie et que de sympathie... Que demander de plus ?<br />
Justement, ils vont bien plus loin...<br />
C'est � la fois une �quipe de fansub et in distribuants !<br />
Attention, pas n'importe quelle �quipe de fansub : une �quipe de dramas. Une grande premi�re parmi les partenaires de chez Z�ro, mais vous le savez, nous sommes ouverts � toute la jap'culture.<br />
Et pas non plus un banal distribuant qui prend b�tement le premier �pisode sortis sans se soucier de prendre diff�rentes �quipes... Non, non ! Mangas-Arigatou recherche la qualit� et nous a choisi pour la plupart de nos animes (oh arr�tez je vais rougir...). Nos �pisodes sont disponibles chez eux pour les s�ries suivantes :<br />
Canaan<br />
Genshiken 2<br />
Issho ni Training<br />
Kanamemo<br />
KissXsis<br />
Kodomo no  Jikan<br />
Kodomo no Jikan Ni Gakki<br />
Maria+Holic<br />
Potemayo<br />
Sketchbook Full Color's<br />
Tayutama<br />
Toradora<br />
Allz visiter leur site au plus vite !!
<br /><br />
<span>~ <a href="http://commentaires.zerofansub.net/t215.htm" target="_blank">Commentaires</a> - <a href="http://commentaires.zerofansub.net/posting.php?mode=reply&t=215" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[MnF] K-On! et Tayutama Kiss on my Deity</h2>
<h4>08/05/09 par db0</h4>
<img src="images/news/tamakon.jpg" style="float:right;" border="0">
<div class="p">Chez Maboroshi, �a ne ch�me pas, et on ne vous l'annonce que maintenant, mais mieux vaut tard que jamais. La petite �quipe est actuellement sur 2 nouveaux projets : K-on!, o� elle en est d�j� � l'�pisode 05 et Tayutama Kiss on my deity � l'�pisode 04. N'attendez plus, et allez mater ces deux exellentes s�ries : <a href="http://www.maboroshinofansub.fr/" target="_blank">Le site Maboroshi</a>.
<br /><br />
<span>~ <a href="http://www.maboroshinofansub.fr/" target="_blank">Commentaires</a> - <a href="http://www.maboroshinofansub.fr/" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>[SkY] Lucky Star 03</h2>
<h4>04/05/09 par db0</h4>
<img src="images/news/lucky3.jpg" style="float:right;" border="0">
<div class="p">On vous l'avait promis ! Sky-fansub, c'est du s�rieux, et malgr� la difficult� de la s�rie, les revoil� d�j� avec l'�pisode 03... Si c'est pas beau, �a ? Allez, va le t�l�charger, mon petit otaku : <a href="http://www.sky-fansub.com/" target="_blank">Le site Sky-fansub</a>.
<br /><br />
<span>~ <a href="http://www.sky-fansub.com/comment.php?comment.news.57" target="_blank">Commentaires</a> - <a href="http://www.sky-fansub.com/comment.php?comment.news.57" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<h2>Konoe no Jikan 02 + [SkY] Lucky Star 02</h2>
<h4>15/04/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/lucky2.jpg" border="0">
</div>
<div class="p">Sky-Anime nous apporte comme promis les aventures d�jant�s de Konata et ses amies. L'�pisode 02 est d�j� disponible sur leur site.<br /><br />
C�t� henta�, l'�pisode 02 de Konoe no Jikan (parodie X de Kodomo no jikan).
<br /><br /></div>
<p></p>

<h2>[SkY] Lucky Star !</h2>
<h4>07/04/09 par db0</h4>
	<div style="float : right; display:block; margin-right: 20px;">
<img src="images/news/lucky.png" border="0">
</div>
<div class="p">Notre tr�s proche partenaire Sky-fansub commence une nouvelle s�rie, et pas une petite s�rie, attention... Lucky Star ! C'est s�r, c'est pas r�cent comme anime, mais malheuresement, niveau fansub, c'est pas au top (Aucune team n'est arriv� au bout de la s�rie). La diff�rence, c'est que cette team-l�, mes amis, n'a rien � voir avec les autres ! En plus de nous faire de la qualit�, elle est s�rieuse et assidue. Que demandez de plus ? Profitez d�j� du premier �pisode ^o^<br /><br /><a href="http://www.sky-fansub.com/" target="_blank">Sky-fansub, c'est par l� !</a><br /><br />
<span>~ <a href="http://www.sky-fansub.com/comment.php?comment.news.54" target="_blank">Commentaires</a> - <a href="http://www.sky-fansub.com/comment.php?comment.news.54" target="_blank">Ajouter un commentaire</a> ~</span><br /><br /></div>
<p></p>

<p>[KfS] Minami-ke Okawari 13/01/09 par db0 <br> 	<img src="http://zerofansub.net/images/news/kyoutsu.jpg" border="0" /> <br> Notre partenaire-dakk� Kyoutsu commence une nouvelle s�rie... Minami-ke Okawari ! Vous pouvez d�s maintenant t�l�charger l'�pisode 01 en DDL :<br> <a href="http://zerofansub.net/ddl/kyoutsu/%5bKfS%5d1280x720_Minami-Ke_Okawari_001_vostfr.mkv" target="_blank" class="postlink">DDL Minami-ke Okawari 01</a><br> Mais aussi en torrent, Megaupload sur leur site : <a href="http://kyoutsu-subs.over-blog.com/" target="_blank" class="postlink">Lien</a>.<br> <br><br>  ~ <a href="http://kyoutsu-subs.over-blog.com/article-26782727-6.html#anchorComment" target="_blank" class="postlink">Commentaires</a> - <a href="http://ann.over-blog.com/ajout-commentaire.php?ref=1365792&amp;ref_article=26782727" target="_blank" class="postlink">Ajouter un commentaire</a> ~</p>

<p>[MnF] Akane 08 12/01/09 par db0   <a href="http://ranka.imouto.org/image/85ba4e0864c9ee58520eee540d4cebcb/moe%2053546%20bikini%20cleavage%20katagiri_yuuhi%20kiryu_tsukasa%20nagase_minato%20nekomimi%20no_bra%20open_shirt%20pantsu%20seifuku%20shiina_mitsuki%20shiraishi_nagomi%20swimsuits.jpg" target="_blank" class="postlink"><img src="http://japanslash.free.fr/images/news/akane8.jpg" border="0" /></a><br> Maboroshi nous sort aujourd'hui l'�pisode 08 de Akane !<br>Contrairement � ce qui a �t� dit, cet �pisode n'a pas �t� r�alis� en co-pro avec Z�ro.<br> <a href="http://japanslash.free.fr/" target="_blank" class="postlink">Pour t�l�charger l'�pisode sur MU, cliquez ici !</a></p>
