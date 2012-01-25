<?php
/*
	A news is a block of text giving actual information. A news contains the text
	to display and some added data (image, author, date of writing, ...).
*/
class News {
	private $title = null;
	private $timestamp = null;
	private $author = null;
	private $message = null;
	private $commentAccess = null;
	private $commentId = null;
	private $twitterTitle = null;
	private $releasesOut = array();
	private $licensesOut = array();
	private $displayInNormalMode = null;
	private $displayInHentaiMode = null;
	private $isTeamNews = null;
	private $isPartnerNews = null;
	
	public function __construct($title = null, $message = null) {
		$this->setTitle($title);
		$this->setMessage($message);
		$this->setTimestamp(time());
	}
	
	public function setPartnerNews($boolean) {
		$this->isPartnerNews = $boolean;
	}
	
	public function isPartnerNews() {
		return $this->isPartnerNews;
	}
	
	public function setTeamNews($boolean) {
		$this->isTeamNews = $boolean;
	}
	
	public function isTeamNews() {
		return $this->isTeamNews;
	}
	
	public function setDisplayInHentaiMode($boolean) {
		$this->displayInHentaiMode = $boolean;
	}
	
	public function displayInHentaiMode() {
		return $this->displayInHentaiMode;
	}
	
	public function setDisplayInNormalMode($boolean) {
		$this->displayInNormalMode = $boolean;
	}
	
	public function displayInNormalMode() {
		return $this->displayInNormalMode;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTimestamp($timestamp) {
		$this->timestamp = intval($timestamp);
	}
	
	public function getTimestamp() {
		return $this->timestamp;
	}
	
	public function setAuthor($author) {
		if ($author instanceof TeamMember) {
			$author = $author->getPseudo();
		}
		$this->author = $author;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function setCommentID($id) {
		$this->commentId = $id;
	}
	
	public function getCommentID() {
		return $this->commentId;
	}
	
	public function setTwitterTitle($title) {
		$this->twitterTitle = $title;
	}
	
	public function getTwitterTitle() {
		return $this->twitterTitle;
	}
	
	public function addReleasing($target) {
		// /!\ can be a release or a project (if a complete project is released)
		if ($target != null) {
			$this->releasesOut[] = $target;
		}
	}
	
	public function getReleasing() {
		return $this->releasesOut;
	}
	
	public function isReleasing() {
		return count($this->releasesOut) > 0;
	}
	
	public function addLicensing($target) {
		// /!\ can be a release or a project (if a complete project is licensed)
		if ($target != null) {
			$this->licensesOut[] = $target;
		}
	}
	
	public function getLicensing() {
		return $this->licensesOut;
	}
	
	public function isLicensing() {
		return count($this->licensesOut) > 0;
	}
	
	private static $allNews = null;
	public static function getAllNews() {
		if (News::$allNews === null) {
			$news = new News();
			$news->setTitle("Recrutement Boku Tomo");
			$news->setTimestamp(strtotime("25 January 2012 15:02"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setMessage("Le trad et l'adapt qui auraient d� s'occuper de Boku wa tomodachi ga Sukunai
ne sont plus disponibles, devant affronter les al�as de la vie...

On cherche donc avec une certaine urgence un trad, un adapt et un timeur pour cette s�rie...

Oui, un timeur aussi, car celle qui devait s'en occuper n'a plus le temps.

exp�rience requise pour le time, non pas parce qu'on ne forme pas,
vu qu'on forme, mais parce que �a commence � �tre chiant de passer
plus de temps � former des gens qui ne timent pas grand-chose au final
que de timer soi-m�me lol");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			$news->setCommentId(285);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("MegaUpload hors service");
			$news->setTimestamp(strtotime("23 January 2012 13:29"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(284);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Pour ceux qui utilisent nos liens MegaUpload, ces derniers jours vous avez s�rement d� avoir du mal, voire vous �tes tomb�s sur une image comme celle-ci :");
			$message->addLine();
			$message->addLine(new Image("images/news/fbi.jpg", "Avertissement FBI"));
			$message->addLine();
			$message->addLine("En effet MegaUpload est sous le joug d'une enqu�te gouvernementale (en Am�rique), du coup la majorit� de leurs liens (si ce n'est tous) sont hors service, et cela pour une dur�e indetermin�e.");
			$message->addLine();
			$message->addLine("Pour t�l�charger nos �pisodes il vous faudra donc vous retrancher sur le DDL, les torrents et autres solutions disponibles.");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("V3.3 du site !");
			$news->setTimestamp(strtotime("23 January 2012 01:48"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(283);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Ces derniers jours, le raffinage du site a pas mal avanc�, et on en est d�sormais � la version 3.3+ du site. '+' parce que la version 3.3 s'est faite Samedi et que depuis j'ai encore raffin� une quantit� assez ph�nom�nale de donn�es (j'y ai pass� tout mon weekend). Du coup la version 3.4 ne devrait pas trop tarder � voir le jour (mais je ne donne pas de date, vu que de toute fa�on je n'ai aucune raison de la respecter {^.^}~). En bref, le raffinage est quasiment termin�.");
			$message->addLine();
			$message->addLine("\\{^o^}/ Banzai !");
			$message->addLine();
			$message->addLine("N�anmoins vous me direz peut-�tre <i>elle est o� la diff�rence ?</i>. Si vous vous posez la question, tant mieux pour moi, �a veut dire que j'ai bien fait mon boulot {^_^}. Le but du raffinage est en effet de r��crire le code, la mise en page du site n'est donc pas sens�e changer de mani�re notable.");
			$message->addLine();
			$message->addLine("J'en profite tout de m�me pour vous faire un petit topo sur ce qu'il en est :");
			$message->addLine();
			$message->addLine("* <b>Toutes les pages projets</b>, incluant toutes les releases, ont �t� refaites. Autrement dit plusieurs centaines de fichiers on �t� factoris�s (c'est ce dont je me r�jouis le plus, parce que contenant des tonnes de donn�es et hyper r�p�titifs, donc le plus chiant � faire). La version 3.2 (que peu ont d� voir passer {^_^}) sonnait le glas du raffinage des releases. Cette nouvelle version sonne celui du raffinage des projets.");
			$message->addLine();
			$message->addLine("* <b>Presque toutes les news</b> ont �t� raffin�es. Sur les 6 vues disponibles, il me reste les 3 derni�res, en sachant que ce sont de tr�s loin les plus petites et qu'il y a quelques doublons avec les pr�c�dentes.");
			$message->addLine();
			$message->addLine("* La plupart des autres pages du site ont �t� refaites. En mettant de c�t� les pages g�r�es � part, il reste les <b>dossiers et galleries d'images</b> � faire.");
			$message->addLine();
			$message->addLine("* Le site profite d�sormais d'un peu plus <b>d'affichage dynamique</b> (contenu chang� � la vol�e). Certaines fonctionnalit�s peuvent donc �tre impl�ment�es pour rendre le site un peu plus intelligent, mais encore rien d'extraordinaire vu que les donn�es sont toujours �crites en dur (et non en base de donn�es). En gros, on n'a pas encore de dynamisme sur les donn�es (on ne peut pas modifier un titre par exemple), mais on en a sur leur pr�sentation (afficher/cacher, changer les couleurs/dimensions, ...) avec possibilit� de m�morisation (gr�ce aux sessions et cookies, bien que ces derniers ne soient pas encore utilis�s). Le point suivant montre un exemple d'application.");
			$message->addLine();
			$message->addLine("* La section H se retrouve d�sormais <b>fusionn�e</b> � la section tout public, donc il n'y a plus de diff�rence entre les deux. Le passage entre section H et tout public se fait un peu diff�remment par rapport � avant : d�sormais vous �tes soit en mode <i>tout public</i>, soit en mode <i>hentai</i>, <b>quelque soit la page</b> (et non certaines pages tout public et d'autres hentai, comme �a se faisait avant). Cela permet une gestion bien plus souple et pr�cise de l'acc�s aux contenus adultes. Le passage de l'un � l'autre se fait en premier lieu via le menu de gauche, avec le <b>lien <i>Hentai</i></b> pour passer en mode hentai, qui se retrouve remplac� par un <b>lien <i>Tout public</i></b> qui refait passer en mode tout public. Le passage se fait aussi lorsque c'est n�cessaire (acc�s � un projet hentai sans �tre en mode hentai). Selon le mode, les projets affich�s sont les projets correspondants (la liste habituelle ou les projets H). Il en est de m�me pour les news (pour celles d�j� raffin�es). Le passage au mode hentai se fait toujours via un avertissement, l'inverse en revanche est direct. Quand vous refusez de passer en mode hentai, vous retournez � la page pr�c�dente (� l'index pour les acc�s directs).");
			$message->addLine();
			$message->addLine("Il me semble que c'est � peu pr�s tout... Ah oui, si vous avez des soucis sur certaines pages du site, c'est toujours moi qu'il faut venir engueuler {^_^}. Regardez du c�t� du lien <i>Signaler un bug</i> dans le menu de gauche. Sur ce, bon leech.");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Un peu de repos");
			$news->setTimestamp(strtotime("18 January 2012 14:26"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(282);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Une petite news pour les autres �quipes de fansub et pour nos habitu�s : �tant donn� le nombre d'animes licenci�s et le nombre d'animes restant non fansubb�s, Z�ro Fansub ne pr�voit pas d'ajouter de nouveaux projets � sa liste pour cette saison.");
			$message->addLine();
			$message->addLine("On en profitera pour avancer correctement nos s�ries d�j� en cours, dont certaines sont sur le feu depuis un moment d�j� {'^_^}.");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Encore des bugs ?");
			$news->setTimestamp(strtotime("4 January 2012"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(281);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Juste une petite news informative. Beaucoup savent d�j� que s'il y a un bug, c'est de ma faute. Cela dit, mon mail il faut le trouver (et oui c'est dur d'aller voir dans la page �quipe, c'est qu'il faut r�fl�chir et les leecheurs aiment pas �a). Pour vous simplifier la vie, si vous avez le moindre probl�me, un lien <i>Signaler un bug</i> est d�sormais disponible dans le menu de gauche.");
			$message->addLine();
			$message->addLine("Non seulement je vous demande de me jeter des cailloux, mais en plus je vous dit o� viser pour faire mal. C'est pas beau �a ? {^_^}");
			$message->addLine(new Image("images/news/working_punch.jpg", "Frappez-moi !"));
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Bonne ann�e !");
			$news->setTeamNews(false);
			$news->setTimestamp(strtotime("1 January 2012"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(280);
			$message = new SimpleTextComponent();
			$message->addLine("Bonne ann�e � tous ! En esp�rant que le raffinage du site avance vite pour enfin vous (et nous) fournir un site plus pratique {^_^}�.");
			$message->addLine();
			$message->addLine(new Image("images/news/newYear2012.jpg", "Bonne ann�e 2012 !"));
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("ATTENTION : Raffinage massif !");
			$news->setTeamNews(true);
			$news->setTimestamp(strtotime("31 December 2011 02:44"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(279);
			$message = new SimpleTextComponent();
			$message->addLine("Note importante : beaucoup de raffinage a �t� fait derni�rement. En particulier la structure des fichiers a �t� retouch�, certains fichiers ont m�me �t� remplac�s (probablement � cause de quelques probl�mes CRC). Quelques-uns ont �t� v�rifi�, mais pas tous. Aussi, si vous t�l�chargez des fichiers qui semblent corrompus, faites-le-moi savoir au plus vite. C'est probablement de ma faute.");
			$message->addLine();
			$message->addLine("Vous pouvez laisser des commentaires, sinon je redonne mon mail : <a href='mailto:sazaju@gmail.com'>sazaju@gmail.com</a>");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Issho ni H Shiyo 6");
			$news->setDisplayInHentaiMode(true);
			$news->setDisplayInNormalMode(false);
			$news->setTimestamp(strtotime("28 December 2011 19:17"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(278);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('hshiyo', 'ep6'));
			$message = new SimpleTextComponent();
			$message->addLine(new AutoFloatImage("images/news/hshiyo6.png", "J'ado~re les concombres !"));
			$message->addLine("Et voil� un nouvel opus (ou deux nouveaux obus, au choix) de notre H favori. Enfin je dis favori mais comme c'est moi qui fais la news, je vais avant tout donner mon avis {^_^}.");
			$message->addLine();
			$message->addLine("Vous avez aim� le 4 (pas le pr�c�dent, celui d'avant, que j'avais d�truit dans ma news) ? Si oui alors r�jouissez-vous, celui-ci est du m�me acabit. Ceux qui sont du m�me avis que moi, en revanche, passez votre chemin. Pour faire court : on se fait une vache � lait � la campagne. Les grosses mamelles sont de la partie, m�me si ce ne sont pas elles qui donneront le 'lait' de l'�pisode.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement pour le site");
			$news->setTimestamp(strtotime("24 December 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(276);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Salut tout le monde ! {^_^}");
			$message->addLine();
			$message->addLine("Voil� un gros mois sans news, vous devez donc vous dire <i>enfin une sortie !</i> pas vrai ? Ben d�sol� de casser l'ambiance, mais non pas pour tout de suite {'^_^}.");
			$message->addLine();
			$message->addLine(new Image("images/news/angry.jpg", "Quoi ?"));
			$message->addLine("<small>Non pas taper ! {'>_<}</small>");
			$message->addLine();
			$message->addLine("Comme certains d'entre-vous le savent, je suis en train de raffiner le site, et cela prends du temps. Si pas mal de choses ont �t� d�velopp�es pour l'instant, encore reste-t-il � les appliquer au site, et c'est �a qui est long. C'est donc pour �a que je viens � vous {^_^}.");
			$message->addLine();
			$message->addLine("Je cherche quelqu'un qui s'y conna�t un minimum en HTML/CSS/PHP. Inutile d'�tre un expert, je demande juste d'avoir d�j� utilis� un peu ces langages, dire qu'on se comprenne si je parles de style, de balise et de parcourir des tableaux. Si vous avez d�j� programm� en objet (PHP, Java, C++ ou autre) c'est un plus. Notez qu'il faut aussi savoir <i>retoucher</i> des images. Ce que j'entends par l� est simplement savoir redimensionner, couper, coller, rassembler des images en une seule, ... le b.a.-ba donc. Si des comp�tences plus avanc�es sont n�cessaires, je peux vous les apprendre avec Gimp. De m�me si vous avez des questions sur le code, c'est tout � votre honneur {^_^}.");
			$message->addLine();
			$message->addLine("Je tiens quand m�me � poser une contrainte : je cherche quelqu'un de motiv�, qui aime coder. Je ne veux pas dire par l� que c'est difficile, mais je veux quelqu'un sur qui je puisse compter sur la longueur. Il ne faut pas �tre disponible tout le temps, mais je ne veux pas voir quelqu'un qui apr�s une semaine me dise <i>j'ai plus le temps</i>. Ce sont toutes des petites t�ches qui peuvent se faire un peu n'importe quand, donc c'est tr�s flexible, mais il faut les faire.");
			$message->addLine();
			$message->addLine("Si vous �tes int�ress�s, passez dans la section recrutement (lien dans le menu de gauche).");
			$message->addLine();
			$message->addLine("NB : vous voyez, j'ai m�me pas le temps de vous faire une news d�cente en cette veille de No�l, pour vous dire comme j'ai besoin de quelqu'un {;_;}.");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Mitsudomoe 7+8");
			$news->setDisplayInHentaiMode(false);
			$news->setDisplayInNormalMode(true);
			$news->setTimestamp(strtotime("14 November 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(275);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep7'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep8'));
			$message = new SimpleTextComponent();
			$message->addLine("Ah, j'ai des nouvelles pour vous. Vous allez rire {^_^}. Il se trouve que �a fait un moment qu'on a fini les Mitsudomoe 7 & 8... et j'ai oubli� de les sortir ! C'est marrant, hein ? {^o^}");
			$message->addLine();
			$message->addLine("Non ? Vous trouvez pas ? {�.�}?");
			$message->addLine();
			$message->addLine(new Image("images/news/aMort.png", "� mort !"));
			$message->addLine();
			$message->addComponent("OK, OK, j'arr�te {\">_<}. S'il vous reste des cailloux de la derni�re fois, vous pouvez me les jeter. Allez, pour me faire pardonner je vous file un acc�s rapide : ");
			$message->addLine(new ReleaseLink('mitsudomoe', array('ep7', 'ep8'), "Mitsudomoe 7 & 8"));
			$message->addLine();
			$message->addLine("J'en profite pour vous rappeler que le site est en cours de raffinage, et comme j'en ai fait beaucoup derni�rement (le lien rapide en est un ajout) il est possible que certains bogues me soient pass�s sous le nez. Aussi n'h�sitez pas � me crier dessus si vous en trouvez {'^_^}.");
			$message->addLine();
			$message->addLine("Et si vous voulez nous aider (ou vous essayer au fansub), on cherche des traducteurs Anglais-Francais (ou Japonais pour ceux qui savent {^_^}) !");
			$message->addLine();
			$message->addLine("Sur ceux, bon visionnage {^_^}.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Besoin de timeurs !");
			$news->setTimestamp(strtotime("11 October 2011"));
			$news->setAuthor(TeamMember::getMember(5));
			$news->setCommentId(273);
			$news->setTeamNews(true);
			$message = new SimpleTextComponent();
			$message->addLine("Allez on encha�ne les news, la motivation est l�... Mais elle va peut-�tre pas durer...");
			$message->addLine();
			$message->addLine("<span style='color:red;font-size:2em;'>On a besoin de votre aide !</span>");
			$message->addLine();
			$message->addLine(new Image("images/news/urgent.gif", "Au secours !"));
			$message->addLine();
			$message->addLine("On embauche des timeurs ! On n'en a pas assez et du coup chacun essaye de faire pour avoir un time � peu pr�s correcte... Mais ce n'est pas la m�me chose quand quelqu'un s'y met � plein temps. C'est quelque chose qui nous ralentis beaucoup car, m�me si ce n'est pas difficile, �a demande du temps pour faire quelque chose de bien (en tout cas pour suivre notre charte qualit� {^_^}). On a les outils, les connaissances, il ne manque plus que les personnes motiv�es !");
			$message->addLine();
			$message->addLine("Si vous �tes interess�s, les candidatures sont ouvertes (cliquez sur <b>Recrutement</b> dans le menu � gauche) ! Si vous �tes soucieux du d�tail au point d'en faire chier vos amis, c'est un plus ! Oui on est des vrai SM � la Z�ro {>.<}.");
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan - Du neuf et du moins neuf");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("10 October 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(272);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomooav', 'oav'));
			$news->addReleasing(Release::getRelease('kodomofilm', 'film'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/pedobear.jpg", "Pedobear"));
			$message->addLine();
			$message->addLine("Sortie de la v3 de Kodomo no Jikan OAD.");
			$message->addLine();
			$message->addLine("Et le film Kodomo no Jikan, qu'on n'a pas abandonn�, non, non... M�me si l'envie �tait l�.");
			$message->addLine("<small>Sazaju: Hein ? Quoi !? {'O_O}</small>");
			$message->addLine();
			$message->addLine("Bon matage et � bient�t pour la suite de Mitsudomoe.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Nouvelles sorties, nouveaux projets, nouveaux bugs...");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("26 September 2011"));
			$news->setAuthor(TeamMember::getMember(5));
			$news->setCommentId(271);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep4'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep5'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep6'));
			$message = new SimpleTextComponent();
			$message->addLine("Bon... par o� commencer... Dur dur, surtout que le moins r�jouissant c'est pour ma pomme {'^_^}. En plus j'ai pas d'image pour vous, vous allez morfler. Alors allons-y gaiement !");
			$message->addLine(); // TODO replace double lines by CSS
			$message->addLine("Tout d'abord, sachez que le site est actuellement en cours de raffinage. Autrement dit, une r�vision compl�te du code est en cours. Par cons�quent, si vous voyez des petites modifications par rapport � avant, c'est normal, mais dans l'ensemble il ne devrait pas y avoir de changement notable sur le site. Quel int�r�t que j'en parle vous me direz... Tout simplement parce qu'il est possible que certaines pages boguent (ou bug, comme vous voulez), et si jamais vous en trouvez une, le mieux c'est de me le faire savoir directement par mail : <a href='mailto:sazaju@gmail.com'>sazaju@gmail.com</a>. Le raffinage �tant en cours, il est possible que des pages qui fonctionnent maintenant ne fonctionnent pas plus tard, aussi ne soyez pas surpris. Je fais mon possible pour que �a n'arrive pas, mais si j'en loupe merci de m'aider � les rep�rer {^_^}.");
			$message->addLine();
			$message->addLine("Voil�, les mauvaises nouvelles c'est fini ! Passons aux r�joussances : 3 nouveaux �pisodes de Mitsudomoe sont termin�s (4 � 6). Si vous ne les voyez pas sur la page de la s�rie... c'est encore de ma faute (lapidez-moi si vous voulez {;_;}). Si au contraire vous les voyez, alors profitez-en, ruez-vous dessus, parce que depuis le temps qu'on n'a pas fait de news vous devez avoir faim, non ? {^_�}");
			$message->addLine();
			$message->addLine("Allez, mangez doucement, �a se d�guste les animes (pur�e j'ai la dalle maintenant {'>.<}). Cela dit, si vous en voulez encore, on a un bon dessert tout droit sorti du restau : Working!! fait d�sormais partie de nos futurs projets ! Certains doivent se dire qu'il y ont d�j� go�t� ailleurs... Mais non ! Parce que vous aurez droit aux deux saisons {^o^}v. Tout le monde le sait (surtout dans le Sud de la France), quand on a bien mang�, une sieste s'impose. Vous pourrez donc rejoindre la fille aux ondes dans son futon : Denpa Onna to Seishun Otoko vient aussi allonger la liste de nos projets ! On dit m�me qu'un projet myst�re se faufile entre les membres de l'�quipe...");
			$message->addLine();
			$message->addLine("Pour terminer, un petit mot sur notre charte qualit�. Nous avons d�cid� de ne plus sortir de releases issues d'une version TV, mais de ne faire que des Blu-Ray. Bien entendu, on fera toujours attention aux petites connexions : nos encodeurs travaillent d'arrache pied pour vous fournir la meilleure vid�o dans le plus petit fichier. J'esp�re donc que vous appr�cierez la qualit� de nos futurs �pisodes {^_^} (et que vous n'aurez pas trop de pages bogu�es {'-.-}).");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Hitohira - S�rie compl�te");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("14 August 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(270);
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('hitohira'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/hito1.jpg", "Hitohira"));
			$message->addLine();
			$message->addLine("Sortie de Hitohira, la s�rie compl�te, 12 �pisodes d'un coup !");
			$message->addLine();
			$message->addLine(new Image("images/news/hito2.jpg", "Hitohira"));
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe 03");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("05 August 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(269);
			$news->setTwitterTitle("Sortie de Mitsudomoe 03 chez Z%C3%A9ro fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep3'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/episodes/mitsudomoe3.jpg", "Mitsudomoe"));
			$message->addLine();
			$message->addLine("Sortie de l'�pisode 03 de Mitsudomoe.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Toradora! SOS - S�rie compl�te 4 OAV");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("26 July 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(268);
			$news->setTwitterTitle("Sortie de Toradora! SOS chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('toradorasos'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/series/toradorasos.jpg", "Toradora SOS"));
			$message->addLine();
			$message->addLine("4 mini OAV d�lirants sur la bouffe, avec les personnages en taille r�duite.");
			$message->addLine("C'est de la superproduction ^_^");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Recrutement traducteur");
			$news->setTimestamp(strtotime("04 July 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(266);
			$news->setTeamNews(true);
			$news->setTwitterTitle("Zero recherche un traducteur");
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/m1.jpg", "Mitsudomoe"));
			$message->addLine();
			$message->addLine("Nous avons urgemment besoin d'un trad pour Mitsudomoe !!");
			$message->addLine("S'il vous pla&icirc;t, piti� xD");
			$message->addLine("Notre edit s'impatiente et ne peux continuer la s�rie, alors aidez-nous ^_^");
			$message->addLine("C'est pas souvent qu'on demande du renfort, mais l�, c'est devenu indispensable...");
			$message->addLine("Nous avons perdu un trad r�cemment, il ne nous en reste plus qu'un... et comble de malheur,  il n'a pas accroch� � la s�rie, mais je le remercie pour avoir quand m�me traduit deux �pisodes pour nous d�panner.");
			$message->addComponent("Des petits cours sont dispos ici : ");
			$link = new Link("http://forum.zerofansub.net/f221-Cours-br.htm", "Lien");
			$link->openNewWindow(true);
			$message->addComponent($link);
			$message->addLine(".");
			$message->addLine();
			$message->addComponent("Pour postuler, faites une candidatures � l'�cole : ");
			$link = new Link("http://ecole.zerofansub.net/?page=postuler", "Lien");
			$link->openNewWindow(true);
			$message->addComponent($link);
			$message->addLine(".");
			$message->addLine();
			$message->addLine(new Image("images/news/m2.jpg", "Mitsudomoe"));
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kannagi - S�rie compl�te");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("19 June 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(264);
			$news->setTwitterTitle("Sortie de Kannagi serie complete chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('kannagi'));
			$message = new SimpleTextComponent();
			$link = new Link("http://zerofansub.net/galerie/gal/Zero_fansub/Images/Kannagi/%5BZero%5DKannagi_Image63.jpg", new Image("images/news/kannagi.jpg", "Kannagi"));
			$link->openNewWindow(true);
			$message->addLine($link);
			$message->addLine();
			$message->addLine("Bonjour les amis !");
			$message->addLine("La s�rie Kannagi est termin�e !");
			$message->addLine("J'�sp�re qu'elle vous plaira.");
			$message->addLine("N'h�sitez pas � nous dire ce que vous en pensez dans les commentaires. C'est en apprenant de ses erreurs qu'on avance, apr�s tout ;)");
			$message->addLine();
			$message->addLine("P.S.: Les karaok�s sont nuls. D�sol�e !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe 01 + 02");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("27 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(263);
			$news->setTwitterTitle("Sortie de Mitsudomoe 01 + 02 chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep1'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep2'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/mitsu0102.jpg", "Mitsudomoe"));
			$message->addLine();
			$message->addLine("Bonjour les amis !");
			$message->addLine("Apr�s des mois d'attente, les premiers �pisodes de Mitsudomoe sont enfin disponibles !");
			$message->addLine("Quelques petits changements dans notre fa�on de faire habituelle, on attend vos retours avec impatience ;)");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Tayutama ~ Kiss on my Deity ~ Pure my Heart ~ - S�rie compl�te 6 OAV");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("15 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(262);
			$news->setTwitterTitle("Sortie de Tayutama Kiss on my Deity Pure my Heart serie complete chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('tayutamapure'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/tayutamapure.jpg", "Tayutama ~ Kiss on my Deity ~ Pure my Heart ~"));
			$message->addLine();
			$message->addLine("On continue dans les s�ries compl�tes avec cette fois-ci la petite s�rie de 6 OAV qui fait suite � la s�rie Tayutama ~ Kiss on my Deity : les 'Pure my Heart'. Ils sont assez courts mais plut�t dr�le alors amusez-vous bien !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Potemayo OAV - S�rie compl�te");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("11 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(261);
			$news->setTwitterTitle("Sortie de Potemayo serie complete chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('potemayooav'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/series/potemayooav.jpg", "Potemayo"));
			$message->addLine();
			$message->addLine("Petit bonjour !");
			$message->addLine("Dans la suite de la s�rie Potemayo, voici la petite s�rie d'OAV. Au nombre de 6, ils sont disponibles en versions basses qialit� uniquement puisqu'ils ne sont pas sortis dans un autre format. D�sol�e !");
			$message->addLine("Amusez-vous bien !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Potemayo - S�rie compl�te enti�rement refaite");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("08 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(261);
			$news->setTwitterTitle("Sortie de Potemayo serie complete chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('potemayo'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/series/potemayo.jpg", "Potemayo"));
			$message->addLine();
			$message->addLine("Bonjour le monde !");
			$message->addLine();
			$message->addLine("Tout comme pour Kujibiki Unbalance 2, nous avons enti�rement refait la s�rie Potemayo. Pour ceux qui suivaient la s�rie, seule les versions avi en petit format �taient disponible puisque c'etait le format qu'utilisait Kirei no Tsubasa, l'�quipe qui nous a l�gu� le projet.");
			$message->addLine();
			$message->addLine("Du coup, la s�rie compl�te a �t� r�envod�e et on en a profit� pour ajouter quelques am�liorations.");
			$message->addLine();
			$message->addLine("Rendez-vous page 'Projet' sur le site pour t�l�charger les 12 �pisodes !");
			$message->addLine();
			$message->addLine("Et n'oubliez pas : si vous avez une remarque, une question ou quoi que ce soit � nous dire, utilisez le syst�me de commentaires ! Nous vous r�pondrons avec plaisir.");
			$message->addLine();
			$message->addLine("Bons �pisodes, � tr�s bient�t pour les 6 OAV suppl�mentaires Potemayo... et un petit bonjour � toi aussi !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kujibiki Unbalance 2 - S�rie compl�te enti�rement refaite");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("02 May 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(260);
			$news->setTwitterTitle("Sortie de Kujibiki Unbalance 2 serie complete chez Zero Fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('kujibiki'));
			$message = new SimpleTextComponent();
			$message->addLine(new AutoFloatImage("images/news/kujiend.jpg", "Kujibiki Unbalance 2"));
			$message->addLine("La s�rie Kujibiki Unbalance 2 a enti�rement �t� refaite !");
			$message->addLine("Les polices illisibles ont �t� chang�es, les panneaux stylis�s ont �t� refait, la traduction a �t� revue, bref, une jolie s�rie compl�te vous attend !");
			$message->addLine();
			$message->addLine("Pour t�l�charger les �pisodes, c'est comme d'habitude :");
			$message->addLine("- Page projet, liens DDL,");
			$message->addLine("- Sur notre tracker Torrent (restez en seed !)");
			$message->addLine("- Sur le XDCC de notre chan irc (profitez-en pour nous dire bonjour :D)");
			$message->addLine();
			$message->addLine("Petite info importante :");
			$message->addLine("Cette s�rie est comp�tement ind�pendante, n'a rien a voir avec la premi�re saison de Kujibiki Unbalance ni avec la s�rie Genshiken et il n'est pas n�cessaire d'avoir vu celles-ci pour appr�cier cette petite s�rie.");
			$message->addLine();
			$message->addLine("Si vous avez aim� la s�rie, si vous avez des remarques � nous faire ou autre, n'h�sitez pas � nous en faire part ! (Commentaires, Forum, Mail, IRC, ...)");
			$message->addLine();
			$message->addLine("� tr�s bient�t pour Potemayo !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kodomo no Natsu Jikan");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("11 April 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(259);
			$news->setTwitterTitle("Sortie de Kodomo no Natsu Jikan chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomonatsu', 'oav'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/kodomonatsu1.jpg", "Kujibiki Unbalance 2"));
			$message->addLine("Rin, Kuro et Mimi sont de retour dans un OAV Sp�cial de Kodomo no Jikan : Kodomo no Natsu Jikan ! Elles sont toutes les trois absulument adorables dans leurs maillots de bains d'�t�, en vacances avec Aoki et Houin.");
			$message->addLine();
			$message->addLine(new Image("images/news/kodomonatsu2.jpg", "Kujibiki Unbalance 2"));
			$message->addLine(new Image("images/news/kodomonatsu3.jpg", "Kujibiki Unbalance 2"));
			$message->addLine(new Image("images/news/kodomonatsu4.jpg", "Kujibiki Unbalance 2"));
			$message->addLine(new Image("images/news/kodomonatsu5.jpg", "Kujibiki Unbalance 2"));
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Licence de L'entrainement avec Hinako + Sortie de Akina To Onsen et Faisons l'amour ensemble �pisode 05");
			$news->setTimestamp(strtotime("08 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(252);
			$news->setTwitterTitle("Deux hentai : Akina To Onsen et Issho ni H shiyo chez Zero fansub !");
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('akinahshiyo', 'oav'));
			$news->addReleasing(Release::getRelease('hshiyo', 'ep5'));
			$news->addLicensing(Release::getRelease('training', 'oav'));
			$message = new SimpleTextComponent();
			$message->addLine(new AutoFloatImage("images/news/issho5.jpg", "Akina To Onsen De H Shiyo"));
			$message->addLine();
			$message->addLine("Dans la suite de notre reprise tant attendue, on ne rel�che pas le rythme ! Apr�s la sortie d'un genre classique chez Z�ro, on poursuit avec l'une de nos sp�cialit�s : <i>Faisons l'amour ensemble</i> revient en force avec un nouvel �pisode (de quoi combler les d��us du 4e opus) et un �pisode bonus !");
			$message->addLine();
			$message->addLine("Tout d'abord, ce 5e �pisode nous sort le grand jeu : la petite s&#339;ur est dans la place ! Apr�s plusieurs ann�es sans nouvelles de son grand fr�re, voil� qu'elle a bien grandi et d�cide donc de taper l'incruste. Voil� une bonne occasion de faire le m�nage (les filles sont dou�es pour �a {^.^}~). � la suite de quoi une bonne douche s'impose... Et si on la prenait ensemble comme au bon vieux temps, <i>oniichan</i> ?");
			$message->addLine();
			$message->addLine("Pour ceux qui auraient encore des r�serves (faut dire qu'on vous a donn� le temps pour {^_^}), un �pisode bonus aux sources chaudes vous attend ! Akina, cette jeune demoiselle du premier �pisode, revient nous saluer avec son charme g�n�reux et son c�t� ivre toujours aussi mignon. Vous en d�gusterez bien un morceau apr�s le bain, non ?");
			$message->addLine();
			$message->addLine(new Image("images/series/akinahshiyo.jpg", "Akina To Onsen De H Shiyo"));
			$message->addLine();
			$message->addLine("db0 dit : Et pour finir, une nouvelle assez inattendue : La licence de L'entra�nement avec Hinako chez Kaze. On vous tiendra au courant quand le DVD sortira.");
			$message->addLine();
			$message->addLine(new Image("images/news/training.gif", "Isshoni Training"));
			$message->addLine();
			$message->addLine("En parlant de Kaze, j'ai re�u hier par la poste le Blu-ray de Canaan chez Kaze. Vous avez aim� la s�rie ? Faites comme moi, achetez-le !");
			$message->addLine();
			$message->addLine(new Image("images/news/canaanli.jpg", "DVD canaan buy kaze"));
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Issho Ni H Shiyo OAV 04 - Fin !");
			$news->setDisplayInNormalMode(false);
			$news->setDisplayInHentaiMode(true);
			$news->setTimestamp(strtotime("13 July 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(237);
			$news->setTwitterTitle("Sortie de Issho Ni H Shiyo OAV 04 - Fin ! http://zerofansub.net/");
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('hshiyo', 'ep4'));
			$message = new SimpleTextComponent();
			$message->addLine(new AutoFloatImage("images/news/hshiyonew.png", "Issho ni H Shiyo oav  4 fin de la serie interdit aux moins de 18 ans."));
			$message->addLine();
			$message->addLine("D�ception intense ! Apr�s de jolis �pisodes, c'est avec regret que je vous annonce la sortie de ce quatri�me et dernier opus, qui retombe dans de banals st�r�otypes H sans une once d'originalit� ni de qualit� graphique : gros seins surr�alistes, personnages pr�visibles � souhaits, et comble du comble un final � la \"je jouis mais faisons pour que �a n'en ait pas l'air\" ! Alors que les �pisodes pr�c�dents nous offraient de somptueux ralentis et des mouvements de corps langoureux pour un plaisir savour� jusqu'� la derni�re goutte, ce dernier �pisode nous marquera (h�las) par sa simplicit� grotesque et son manque de plaisir �vident.");
			$message->addLine();
			$message->addLine("Mais r�jouissez-vous ! La s�rie �tant finie, nous n'aurons plus l'occasion d'assister � une autre erreur mettant en doute la qualit� de cette derni�re : les plus pointilleux pourront sauvagement se dess�cher sur les pr�c�dents �pisodes sans jamais voir le dernier, alors que ceux qui auront piti� de notre travail pourront gaspiller leur bande passante � t�l�charger le torchon qui sert de final � cette s�rie qui ne le m�rite pourtant pas.");
			$message->addLine();
			$message->addLine("Merci � tous de nous avoir suivi sur cette s�rie, et je vous souhaite tout le plaisir du monde � sauvegarder votre temps en revisionnant un des �pisodes pr�c�dents plut�t que celui-ci {^_^}.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("KissXsis 03");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("24 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(233);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep3'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/kissxsis3news.jpg", "KissXsis kiss x sis DVD Blu-Ray Jaquette"));
			$message->addLine("On peut dire qu'il s'est fait attendre cet �pisode...");
			$message->addLine("Mais le voil� enfin, et c'est tout ce qui compte.");
			$message->addLine("Vous devez vous demander ce qu'il advient de notre annonce de sortie une semaine/un �pisode pour kissxsis.");
			$message->addLine("Vous avez remarqu� que c'est un echec. Pourquoi ? Les �pisodes s'av�rent bien plus longs � r�aliser que pr�vu si on souhaite continuer � vous fournir la meilleure qualit� possible. De plus, j'�tais dans ma p�riode de fin d'ann�e scolaire et j'ai d� mettre de c�t� nos ch�res soeurs jumelles pour �tre s�re de passer en ann�e sup�rieure...!");
			$message->addLine();
			$message->addLine("Une nouvelle qui ne vous fera peut-�tre pas plaisir, mais qui j'�sp�re ne vous d�couragera pas de mater les soeurettes un peu plus tard : Nous avons l'intention d'attendre la sortie des Blu-Ray des autres �pisodes avant de continuer KissXsis. La qualit� des vid�os sera meilleure, il y aura moins de censure, plus de d�tails, bref, plus de plaisir !<br />
Le premier Blu-Ray contenant les 3 premiers �pisodes vient tout juste de sortir et nous sortirons bient�t des nouvelles versions de ces trois premiers. Croyez-moi, �a en vaut la peine. Vous ne me croyiez pas ? <a href='http://www.sankakucomplex.com/2010/06/24/kissxsis-erotic-climax-dvd-ero-upgrades-highly-salacious/' target='_blank'>Petit lien</a>.");
			$message->addLine();
			$message->addLine("Et pour ne pas parler que de KissXsis, sachez qu'une petite surprise que je vous ai personnellement concoct� devrait bient�t sortir...<br />
En ce qui concerne les autres projets, nous devrions nous concentrer sur Kujian en attendant les Blu-Ray de KissXsis et boucler certains vieux projets comme Sketchbook, Kodomo no Jikan (le film) ou Tayutama.");
			$message->addLine();
			$message->addLine("En ce qui concerne l'�cole du fansub, elle va tr�s bien et le nombre d'�l�ve augmente chaque jour, les exercices et les cours aussi ! Si vous �tes int�r�ss�s, vous savez o� nous trouver : sur le forum Z�ro fansub.");
			$message->addLine();
			$message->addLine("Bonne chance � ceux qui sont en examens, et que ceux qui sont en vacances en profite bien. Moi, je suis en vacances :p");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe, Bande-Annonce");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("15 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(231);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep0'));
			$message = new SimpleTextComponent();
			$message->addLine('<object width="550" height="309"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=12592506&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=12592506&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="550" height="309"></embed></object>');
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kiss X Sis TV 02");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("04 May 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(228);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep2'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/kissxsis2.jpg"));
			$message->addLine("Ako et Riko ne laisseront pas Keita rater ses examens ! Ako d�cident donc de donner des cours particulier � Keita.");
			$message->addLine("Ils y resteront tr�s sages et se contenteront d'apprendre sagement l'anglais, l'histoire et les maths. C'est tout.");
			$message->addLine("Vous vous attendiez � autre chose, peut-�tre ?");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kiss X Sis TV 01");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("17 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(225);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep1'));
			$message = new SimpleTextComponent();
			$message->addLine(new Image("images/news/newskissxsis1.jpg"));
			$message->addLine("Yo !");
			$message->addLine("Ako et Riko sont ENFIN de retour, cette fois-ci dans une s�rie compl�te.");
			$message->addLine("Il y aura donc plus de sc�nario, mais toujours autant de ecchi.");
			$message->addLine("C'est bien une suite des OAV, mais il n'est pas n�c�ssaire des les avoir vus pour suivre la s�rie.");
			$message->addLine("J'ai essay� de faire des jolis karaok�s, alors chantez !! (Et envoyez les vid�os)");
			$message->addLine("� tr�s vite pour l'�pisode 2.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("S'endormir avec Hinako (Issho ni Sleeping) OAV");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("08 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(209);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sleeping', 'oav'));
			$message = new SimpleTextComponent();
			$message->addLine(new AutoFloatImage("images/news/pcover1.gif"));
			$message->addLine("Salut toi, c'est Hinako !<br />
Tu m'as tellement manquer depuis notre entra�nement, tout les deux...<br />
Tu te souviens ? Flexions, extensions ! Une, deux, une deux !<br />
Gr�ce � toi, j'ai perdu du poids, et toi aussi, non ?<br />
Tu sais, cette nuit, je dors toute seule, chez moi, et �a me rend triste...<br />
Quoi ? C'est vrai ? Tu veux bien dormir avec moi !?<br />
Oh merci ! Je savais que je pouvais compter sur toi.<br />
Alors, � tout � l'heure, quand tu auras t�l�charger l'�pisode ;)");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("KissXsis 02");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("06 December 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(153);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kissxsisoav', 'ep2'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/kiss2.png' /><br />
Ah, elles nous font bien attendre, les deux jolies jumelles... Des mois pour sortir les OAV ! Mais au final, �a en vaut la peine, donc on ne peut pas leur en vouloir. C'est bient�t No�l, donc pour l'occasion, elles ont sortis des cosplays tr�s mignons des \"soeurs de No�l\". Elles sont de plus en plus ecchi avec leur fr�re. Finira-t-il par craquer !? La premi�re version sort ce soir, les autres versions de plus haute qualit� sortieront dans la nuit et demain. J'�sp�re que cet OAV vous plaira ! Une s�rie est annonc�e en plus des OAV. Info ou Intox ? Dans tout les cas, Z�ro sera de la partie, donc suivez aussi la s�rie avec nous !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Canaan 13 ~ Fin !");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("06 October 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(138);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep13'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/canaanfin.png\" /><br />
Ainsi se termine Canaan.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 12 + Piscine + Partenariats + Maboroshi + Kobato");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("04 October 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(137);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('canaan', 'ep12'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/piscine.jpg' style='float: left;' />
Tout d'abord, la sortie du <b>12e �pisode de Canaan</b>. On change compl�tement de d�cor par rapport aux pr�c�dents �pisodes. Cet �pisode est centr� sur la relation entre Canaan et Alphard, ainsi que les pouvoirs de Canaan.<br /><br />
Ensuite, <b>db0 va a la piscine !</b> (Elle a mis son joli maillot de bain, et tout, comme sur l'image) Elle sera donc <b>absente du 5 au 26 octobre inclus</b>. En attendant, l'�quipe Z�ro va essayer de continuer � faire des sorties quand m�me, et c'est ryocu qui se chargera de faire les news.<br /><br />
Puis, deux nouveaux partenaires : <b>Gokuraku-no-fansub</b> et <b>Tanjou-fansub</b>.<br /><br />
Enfin, une bonne nouvelle. Si certains n'�taient pas au courant, j'annonce : <b>Maboroshi no fansub a r�ouvert ses portes</b>. L'incident de fermeture �tait d� � une mauvaise entente entre la personne qui h�bergeait le site et le reste de l'�quipe. J'ai repris les r�nes ! C'est maintenant moi qui g�re leur site. Du coup, il n'y a aucun risque de fermeture ou de mauvais entente :). Ils prennent un nouveau d�part, et ont d�cid� de ne pas reprendre leurs anciens projets, sauf Hakushoku to Yousei d�e � la forte demande.<br /><br />
Pour finir, <b>Kobato</b>, dans la liste de nos projets depuis juin, ne se fera finalement pas. Kaze nous a devanc� et a achet� la licence.");
			$news->setMessage($message);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 11");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("30 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(136);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep11'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/canaan11.jpg'/><br />
Chose promise, chose due. Et en plus, on a m�me le droit � un peu de ecchi dans cet �pisode ! Avec la tenue sexy de Liang Qi, on peut pas dire le contraire... Et un peu de necrophilie aussi. Ouais, c'est tout de suite moins sexy. (Enfin, chacun son truc, hein) Sankaku Complex en a parl�. Cet �pisode est un peu triste, comme le pr�cedent, mais un peu plus violent aussi.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 10");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("30 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(135);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep10'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/canaan10.jpg' /><br />
Vous en r�viez ? Les fans l'ont dessin�... Est-ce que c'est ce qui va se passer dans la suite de l'anime ? �a semble bien parti... Regardez vite l'�pisode 10 pour le savoir ! Et comme on a trop envie de savoir la suite � la fin de cet �pisode, je vous promets qu'il ne tardera pas.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 09 + Canaan Cosplays");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("25 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(130);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep9'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/canaancos.jpg' /><br />
Je comptais sortir tout les �pisodes en m�me temps, mais comme les autres prennent plus de temps que pr�vu, on va pas vous faire attendre plus longtemps et on vous propose d�s maintenant l'�pisode 09, pr�t depuis longtemps. Comme vous pouvez le constater, l'�quipe est tr�s occup�e en ce moment, donc entre deux irl, on taffe un peu fansub, mais �a reste pas grand chose.<br />
Je profite de cette news pour vous poster quelques photos de mon cosplay Canaan. Si vous voulez en savoir plus sur ce cosplay et mes autres, rendez-vous sur mon site perso cosplay : <a href='http://db0.dbcosplay.fr' target='_blank'>http://db0.dbcosplay.fr</a> (et abonnez-vous � la newsletter !)<br />
<a href='http://www.cosplay.com/photo/2268921/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268921.jpg'></a> <a href='http://www.cosplay.com/photo/2268922/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268922.jpg'></a> <a href='http://www.cosplay.com/photo/2268923/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268923.jpg'></a> <a href='http://www.cosplay.com/photo/2274553/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274553.jpg'></a> <a href='http://www.cosplay.com/photo/2274515/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274515.jpg'></a> <a href='http://www.cosplay.com/photo/2274516/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274516.jpg'></a> <a href='http://www.cosplay.com/photo/2274517/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274517.jpg'></a> <a href='http://www.cosplay.com/photo/2274518/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274518.jpg'></a> <a href='http://www.cosplay.com/photo/2274519/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274519.jpg'></a> <a href='http://www.cosplay.com/photo/2274520/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274520.jpg'></a> <a href='http://www.cosplay.com/photo/2274521/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274521.jpg'></a> <a href='http://www.cosplay.com/photo/2274522/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274522.jpg'></a> <a href='http://www.cosplay.com/photo/2274523/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274523.jpg'></a> <a href='http://www.cosplay.com/photo/2274531/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274531.jpg'></a> <a href='http://www.cosplay.com/photo/2274532/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274532.jpg'></a> <a href='http://www.cosplay.com/photo/2274533/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274533.jpg'></a> <a href='http://www.cosplay.com/photo/2274536/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274536.jpg'></a> <a href='http://www.cosplay.com/photo/2274537/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274537.jpg'></a> <a href='http://www.cosplay.com/photo/2274538/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274538.jpg'></a> <a href='http://www.cosplay.com/photo/2274540/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274540.jpg'></a> <a href='http://www.cosplay.com/photo/2274541/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274541.jpg'></a> <a href='http://www.cosplay.com/photo/2274542/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274542.jpg'></a> <a href='http://www.cosplay.com/photo/2274543/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274543.jpg'></a> <a href='http://www.cosplay.com/photo/2274544/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274544.jpg'></a> <a href='http://www.cosplay.com/photo/2274554/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274554.jpg'></a> <a href='http://www.cosplay.com/photo/2274555/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274555.jpg'></a> <a href='http://www.cosplay.com/photo/2274556/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274556.jpg'></a> <a href='http://www.cosplay.com/photo/2274557/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274557.jpg'></a> <a href='http://www.cosplay.com/photo/2274560/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274560.jpg'></a>");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 08");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("26 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(116);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep8'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/canaan8.png' style='float: right;' />
Avec un peu de retard cette semaine, la suite de la tr�pidante histoire de Canaan, une fille pas comme les autres.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 06");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("11 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(112);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep6'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/can6.jpg'><br />
Comme � son habitude, le petit �pisode de Canaan de la semaine fait sa sortie. Et comme pr�vu, nous n'avons aucune r�ponse pour le recrutement traducteur T___T pourtant j'aime bien, moi, Mermaid Melody. C'est mignon.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 04 + 05 + Rythme Toradora!");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("06 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(109);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('canaan', 'ep4'));
			$news->addReleasing(Release::getRelease('canaan', 'ep5'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src='images/news/can45.jpg' alt='' /><br />
Des bunny girls, des blondasses, et tout �a qui se fait des c�lins ! Si c'est pas mignon, tout �a ! Non, pas tant que �a, si on remet l'image dans le contexte. Je vous laisse d�couvrir tout �a dans la double sortie du jour. Double sortie, pourquoi ? Bah justement. J'ai bien envie de faire des news longues ses derniers temps, donc je vais vous expliquer ce que j'appelle \"le rythme Toradora!\".<br />
Pour ceux qui nous ont connus � l'�poque Toradora!, � l'\"apog�e\" de la carri�re de Z�ro, vous vous souvenez sans doute du rythme sp�ctaculaire auquel les sorties s'encha�naient. C'�tait de l'ordre de une sortie tout les deux jours, voir tout les jours ! Pour vous, qui attendez sagement derri�re vos �crans, c'est tout b�n�f'. Mais ce que vous ne savez pas, c'est que �a travaille, derri�re la machine. Nous ne sommes pas une �quipe de Speedsub, alors comment r�aliser un tel exploit sans perdre de la qualit� des �pisodes ? Non, non, nous ne savons toujours pas ralentir le temps. Quel est notre secret ? Tout d'abord, sachez qu'il faut minimum 20 heures de boulot pour sortir un �pisode chez Z�ro (traduction-adaptation-correction-edition-time-v�rification finale) encodage non compris. Et que g�n�ralement, nous r�partissons ses heures sur des semaines. Pour suivre le rythme Toradora!, c'est simple : Etaler ses 20 heures minimum (je dis bien minimum parce qu'en fait c'est beaucoup plus long) sur une seule journ�e. C'est-�-dire sacrifier une journ�e + une nuit. Pour Toradora!, suivre ce rythme n'�tait pas trop dur puisque nous �tions en coproduction, ce qui nous permettait de faire des pauses de temps en temps dans ces looongues journ�es de fansub. Mais nous avons d�cid� de reprendre ce rythme, pour montrer � nos amis leechers que nous n'avons pas vieilli ! C'est pourquoi nous avons choisi un anime qui nous tient � coeur, � Ryocu et moi-m�me : Canaan. Ici, nous ne sommes pas en coproduction, mais comme nous sommes en vacances, nous pouvons nous permettre de sacrifier deux journ�es par �pisode de Canaan. Oui, deux jours, car il me faut bien faire des pauses, et comme je m'occupe de tout sauf de la v�rification finale et que je suis humaine, je ne peux pas me permettre de taffer 24h d'affil�e sans faiblir un chouilla.<br />
Bref, je raconte pas tout �a pour me la p�ter, mais juste pour vous �xpliquer ce que repr�sente un rythme accel�r� pour une �quipe de bon sub et pas de speedsub. Je raconte �a aussi parce que j'ai �t� d��u par des r�actions de personnes qui se sont dit rapide = mauvais sub. Je vous prouve ici que nous travaillons dur pour vous !!<br />
Et l�, je finirai sur une question qui vous turlupine depuis tout � l'heure : Comment se fait-il que vous ne nous sortiez ses �pisodes que maintenant ? La r�ponse est simple : J'avais pas internet dans le trou paum� o� je suis pour mes vacances :p<br />
Et histoire de craner un peu : Ryocu et moi passons de superbes vacances en bord de mer dans une grande maison avec piscine dont nous profitons entre deux Canaan.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Erreur Canaan 03");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("24 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(106);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep3'));
			$message = new SimpleTextComponent();
			$message->addLine("Sous la pr�cipitation (train � prendre), j'ai envoy� le mauvais ass � lepims (notre encodeur) pour l'�pisode 03 de Canaan, c'est-�-dire celui dont les fautes n'ont pas �t� corrig�s, c'est-�-dire ma traduction telle quelle... Du coup, il a �t� r�encoder, et la nouvelle version est t�l�chargeable � la place de l'ancienne. Toutes mes excuses !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 03 + Recrutement trad Hitohira");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("22 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(106);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('canaan', 'ep3'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/hitocry.png\" style=\"float: right;\" />
Je lance cette bouteille � la mer en esp�rant que ce message parvienne aux oreilles d�une �me charitable� Nous recherchons d�sesp�r�ment une personne pour reprendre l�une de nos s�ries, j�ai nomm� Hitohira. Nous n'avons rien � offrir, � part notre gratitude. Nous ne nous attendons pas � avoir beaucoup de r�ponses, voire rien du tout... Si par bonheur, vous �tes int�ress�, n�h�sitez pas � passer sur le forum, nous vous accueillerons sur un tapis rouge orn� de fleurs xD<br /><br /><br /><br /><br /><br />
<img src=\"images/news/canaan-3.jpg\" border=\"0\" /><br />
Encore du ecchi dans la s�rie Canaan ! Mais pas que �a, bien s�r. L'�pisode 3 est disponible, amusez-vous bien~");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 02");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("19 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(103);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('canaan', 'ep2'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/oppaicanaan.png\" border=\"0\"><br />
Bah alors ? Z�ro nous fait Canaan ? Mais Z�ro, c'est une team de l'ecchi, non ? Bah en voil� un peu d'ecchi, dans cette s�rie de brutes ^^ Alors, heureux ? Oui, tr�s heureux. Snif. Tout �a pour dire que y'a l'�pisode 02 pr�t � �tre mat�. Et vous savez quoi, les p'tits loulous ? Dans l'�pisode 01, on comprenait pas toujours ce qu'il se passait. Dans l'�pisode 02, on comprends ce qui s'est pass� dans l'�pisode 1 ! Hein ? �a se passe toujours comme �a dans les s�ries s�rieuses...? Ah, naruhodo...");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("KissXsis 01");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("28 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(77);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep1'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kissx1.jpg\" style=\"float:right;\" border=\"0\">
On vous l'avait promis, le v'l� ! On a mis un peu de temps parce qu'on l'a traduit � moiti� du Japonais, et forc�ment, �a prend plus de temps. J'esp�re qu'il vous plaira autant que le premier, parce qu'il d�passe les limites de l'ecchi !<br />
Demain : Epitanime ! J'veux tous vous y voir !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("L'entra�nement avec Hinako (Isshoni Training)");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("28 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(65);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('training', 'oav'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/hinako.jpg\" border=\"0\"><br />L'�t� arrive � grand pas. C'est donc la saison des r�gimes ! Et qui dit r�gime, dit bonne alimentation mais aussi entra�nement, musculation ! Mais comment arriver � faire bouger nos chers Otakus de leurs chaises...? Hinako a trouv� la solution ! Un entra�nement compos� de pompes, d'abdos et de flexions on ne peut plus ECCHI ECCHI ! Lancez-vous donc dans cette aventure un peu perverse et rejoignez Hinako dans sa s�ance de musculation. Et vous le faites, hein ? Hinako vous regarde ;)");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux No�l ! - OAV Kiss X Sis");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("24 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(24);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kissxsisoav', 'ep2'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/noel.jpg\" border=\"0\" /><br>Toute l'�quipe Z�ro vous souhaite � tous un joyeux no�l, un bon r�veillon, une bonne dinde, de bons chocolats, de beaux cadeaux et tout ce qui va avec.<br>Nos cadeaux pour vous :<br>- Une galerie d'images de No�l (dans les bonus)<br>- L'OAV de Kiss x sis !<br>Dans la liste de nos projets depuis cet �t�, initialement pr�vu en septembre... Au final, il est sorti le 22 d�cembre, et nous vous l'avons traduit comme cadeau de No�l. C'est entre-autre gr�ce � cet OAV que nous avons fait la conaissance de la <a href=\"http://kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a>.");
			$news->setMessage($message);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("23 July 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(267);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('bath', 'oav'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/bath.jpg\" alt=\"Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko\" />
  <br /><br />
  Nous avons appris qu'Ankama va diffuser � partir de la rentr�e de septembre 2011 :<br />
  Baccano, Kannagi et Tetsuwan Birdy Decode. Tous les liens on donc �t� retir�s.<br />
  On vous invite � cesser la diffusion de nos liens et � aller regarder la s�rie sur leur site.<br />
  <br />
  Sorties d'Isshoni Training Ofuro : Bathtime with Hinako & Hiyoko<br />
  <br />
  3e volet des \"isshoni\", on apprend comment les Japonaises prennent leur bain, tr�s int�ressant...<br />
  Avec en bonus, une petite s�ance de stretching...<br />
  <br />
  Je ne sais pas s'il y aura une suite, mais si oui, je devine un peu le genre ^_^");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 13 - FIN");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("29 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(256);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep13'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana131.jpg\" alt=\"Kanamemo\" /><br /><br />
<img src=\"images/news/kana132.jpg\" alt=\"Kanamemo\" />
<br /><br />
Eh oui, c'est d�j� la fin de Kanamemo, j'esp�re que cette petite s�rie fort sympathique vous aura plus autant qu'� nous.<br />
C'est pour nous une bonne nouvelle, on diminue ainsi le nombre de nos projets en cours/futurs, on esp�re pouvoir faire de m�me avec d'autres s�ries prochainement...<br />
<img src=\"images/news/kana133.jpg\" alt=\"Kanamemo\" /><br /><br />
On vous annonce d�j� que Kujibiki Unbalance II et Potemayo seront enti�rement refaits ! Pas mal de choses ont �t� revues, j'esp�re que vous appr�cierez nos efforts.<br />
Kodomo no Jikan OAV 4 ne devrait plus tarder...<br />
Merci de nous avoir suivis et � bient�t pour d'autres �pisodes ^_^<br /><br />
<img src=\"images/news/kana134.jpg\" alt=\"Kanamemo\" /><br /><br />
<img src=\"images/news/kana135.jpg\" alt=\"Kanamemo\" />");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 12");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("20 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(255);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep12'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana12.jpg\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'�pisode 12 de Kanamemo ! Youhouh ! C'est la f�te !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 11");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("14 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(254);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep11'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana11.jpg\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'�pisode 11 de Kanamemo ! Youhouh ! C'est la f�te !<br /><br />
Rappel, nos releases sont t�l�chargeable sur :<br />
<ul>
<li>Sur <a href=\"http://zerofansub.net/\">le site zerofansub.net</a> en DDL (cliquez sur projet dans le menu � gauche)</li>
<li>Sur <a href=\"http://www.bt-anime.net/index.php?page=tracker&team=Z%e9ro\">notre tracker torrent BT-Anime</a> en torrent peer2peer (Notre �quipe de seeder vous garantie du seed !)</li>
<li>Sur <a href=\"irc://irc.fansub-irc.eu/zero\">notre chan IRC</a> en XDCC (<a href=\"http://zerofansub.net/index.php?page=xdcc\">liste des paquets</a>)</li>
<li>Sur <a href=\"http://www.anime-ultime.net/part/Site-93\">Anime-Ultime</a> en DDL (Mais en fait, c'est les m�mes fichiers que sur Z�ro, c'est juste des liens symboliques ^^)</li>
</ul>");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 10");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("10 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(253);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep10'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana10.jpg\" style=\"float: left;\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'episode 10 de Kanamemo ! Youhouh ! C'est la fete !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 7, 8 et 9");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("23 February 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(251);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep7'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep8'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep9'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kanamemo7.jpg\" alt=\"Kanamemo\" />
<br /><br />
Voil� qui met un terme � cette longue p�riode d'inactivit� : Kanamemo 7, 8 et 9, enfin !<br />
Tout comme l'�pisode 5, l'�pisode 7 �tait inutilement censur�, donc on s'est orient�s vers les DVD. En version HD uniquement, la LD n'est plus tr�s en vogue, faut dire ^^<br />
D'autres projets reprennent du service, encore un peu de patience...<br />
Je vous dis � bient�t pour d'autres �pisodes ^_^");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo Chapitre 01");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("02 August 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(241);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kanamemobook', 'ch1'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kanac1.jpg\" alt=\"Kanamemo Chapitre 01\" /><br /><br />
Sortie du chapitre 01 de Kanamemo qui ouvre le retour du scantrad chez Z�ro !<br />
Depuis pas mal de temps, nous l'avions laiss� � l'abandon mais avec l'�cole du fansub, nous avons pu nous y remettre.<br />
Sont pr�vus les scantrad de Kanamemo, Sketchbook et Maria+Holic. Quelques doujins devraient aussi arriver.<br />
Pour toutes nos autres s�ries dont les versions manga existent, vous pouvez les trouver en t�l�chargement sur les pages des s�ries comme Hitohira, Kannagi, Kimikiss et KissXsis.
<br />
A bientot !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 06");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("16 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(224);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep6'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/newskana6.jpg\" /><br />
H� !<br />
Mais c'est qu'on arrive � la moiti� de la s�rie.<br />
Le 6�me �pisode de Kanamemo est disponible.");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 4 + 5");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("19 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(212);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep4'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep5'));
			$message = new SimpleTextComponent();
			$message->addLine("<a href=\"http://yotsuba.imouto.org/image/b943e76cbe684f3d4c4cf3b748d7d878/moe%2099353%20amano_saki%20fixed%20kanamemo%20kujiin_mika%20nakamachi_kana%20neko%20pantsu%20seifuku.jpg\" target=\"_blank\"><img src=\"images/news/newskana5.jpg\" /><br />
(Image en plus grand clique ici)</a><br />
Coucou, nous revoilou !<br />
La suite de Kanamemo avec deux �pisodes : le 4 et le 5.<br />
Dans les deux, on voit des filles dans l'eau... Toute nues, aux bains, et en maillot de bain � la \"piscine\" !
<br />Les deux sont en version non-censur�e.
<br />Pour voir la diff�rence entre les deux versions : <a href =\"http://www.sankakucomplex.com/2009/11/10/kanamemo-dvd-loli-bathing-steamier-than-ever/\" target=\"_blank\">LIEN</a>.<br />
En bonus, un petit AMV de l'�pisode 05 (pass� � la TV, nous le l'avons pas fait nous-m�me).<br />
� bient�t !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 03");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("26 November 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(150);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep3'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana3.jpg\" /><br />
BANZAIII !! Kanamemo �pisode 03, ouais, trop bien ! Je mets du temps � sortir les �pisodes ces derniers temps, mais derrni�re le rideau, ne vous inqui�tez pas, �a bosse ! Oui, c'est encore de ma faute, avant la piscine, maintenant printf, je suis d�bord�e... (Mais de quoi elle parle !? o__O) Bref. Bon �pisode !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 01");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("20 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(114);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep1'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kana1.jpg\" />
Bonsoir....<br /><br />
Kodomo no Jikan touche � sa fin (bouhouh T__T) et on nous a propos� un anime sur le forum : Kanamemo. On a tout de suite vu qu'il s'inscrivait directement dans la ligne directe de Kodomo no Jikan, ecchi ~ loli ! R�tissants au d�part � commencer un nouvel anime sans finir nos pr�c�dents en cours, mais ayant plusieurs personnes de l'�quipage n'ayant rien � faire, nous avons finalement accept� la proposition. Cet anime est trop mignon~choupi~kawaii, c'est la petite Kana qui perd sa grand-m�re et ses parents et doit se debrouiller toute seule et trouver du travail. Y'a aussi un peu de yuri dedant, donc je pense que tout le monde y trouvera ce qu'il aime !");
			$news->setMessage($message);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux No�l !");
			$news->setTimestamp(strtotime("24 December 2011 21:05"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(277);
			$news->setTeamNews(false);
			$message = new SimpleTextComponent();
			$message->addLine("Allez pour me faire pardonner de ma derni�re news, un petit go�t de No�l dans cette mini-news (cliquez sur l'image).");
			$message->addLine();
			$message->addLine(new Link("images/news/[Zero Fansub]Noel 2011.zip", new Image("images/news/noel3.jpg", "Joyeux No�l !")));
			$news->setMessage($message);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kujibiki Unbalance �pisode 09");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("18 August 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(243);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep9'));
			$message = new SimpleTextComponent();
			$message->addLine("<img src=\"images/news/kujian9news.jpg\" alt=\"Kujibiki Unbalance �pisode 09 - Yamada montre sa culotte Renko\" /><br /><br />
Chihiro, Tokino, Koyuki, Yamada et Renko sont de retour pour la suite de leurs aventures pour devenir les membres du conseil des �l�ves de Rikkyouin ! Retrouvez les dans cet �pisode 09 o� Yamada ne sera pas dans son �tat normal...<br />
Comme d'habitude, l'�pisode est t�l�chargeable sur la page de la s�rie partie \"Projets\" en t�l�chargement direct uniquement et plus tard en torrent, XDCC, etc.<br />
<br />
<img src=\"images/news/news_dons_k-on.gif\" alt=\"Merci pour le don a Herve ! K-On money money\" /><br /><br />
Un grand <strong>merci</strong> � H�rv� pour son don de 10 euros qui va nous aider � payer nos serveurs !<br />
<br />
A bientot !<br /><br />");
			$news->setMessage($message);
			$news->setTwitterTitle("Sortie de Kujibiki Unbalance episode 09 chez Zero ! http://zerofansub.net/");
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~ full color's  ~ Picture Drama s�rie compl�te (01 � 06)");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("26 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sketchdrama.png\" alt=\"Sketchbook ~ full color's ~ Picture Drama\" /><br />
Pour f�ter les vacances qui arrivent, Sora et ses amies vous emmenent avec elles � la mer !<br />
C'est une petite s�rie de 6 �pisodes de moins de 10 minutes chacun qui �taient en Bonus sur les DVDs de Sketchbook ~ full color's ~. Ils ont �t� r�alis� � partir du Drama CD de la s�rie et l'animation est minime. Dans la m�me douceur que la s�rie, ils sont parfait pour se reposer en pensant aux vacances qui arrivent.");
			$news->setCommentId(234);
			$news->setTeamNews(false);
			$news->addReleasing(Project::getProject('sketchbookdrama'));
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kujibiki Unbalance 2 episode 08");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("03 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/newskuji8.png\" /><br />
Comment attirer l'oeil des fans d'animes de chez Zero ?<br />
Avec une paire de seins, evidemment !<br />
Episode 8 de Kujibiki Unbalance 2 en exclusivite total gratuit pas cher promo solde !<br />
Un episode qui m'a beaucoup plu, tres tendre et qui revele des elements cles de l'histoire.<br />
En reponse au precedent sondage, il n'est ABSOLUMENT PAS NECESSAIRE D'AVOIR VU GENSHIKEN OU LA PREMIERE SAISON de Kujibiki Unbalance pour regarder celle-ci. Les histoires ont quelques liens mais sont completement independantes les unes des autres. C'est une serie a part.<br />
Bon episode a tous et a tres bientot !");
			$news->setCommentId(220);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep8'));
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setDisplayInHentaiMode(false);
			$news->setTitle("Potemayo [08] 15 + 16");
			$news->setTimestamp(strtotime("01 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage('<img src="images/news/pote8.jpg" /><br />
Anyaa~~<br />
Potemayo, �pisode 8, youhou ! Et tr�s bient�t, Kanamemo, Isshoni H shiyo et Isshoni sleeping ! Enjoy, Potemayo !');
			$news->setCommentId(207);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('potemayo', 'ep8'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Potemayo [07] 13 + 14");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setTimestamp(strtotime("30 January 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Tarf"));
			$news->setMessage('<img src="images/news/moepote1.jpg"><br />
Revenons � nos charmants allum�s dans un PotemaYo que j\'ai particuli�rement aim�.<br />
<br />
Deux �pisodes : La fin de l\'�t�, et La nuit du Festival<br />
<br />
Encore, encore un �pisode totalement d�jant�, o� on va devoir faire du nettoyage... et prier. Puis on va manger de la glace � base de lait avec un type fou, fou, fou ^^<br />
H�, vous voulez savoir comment on fait cuir plus vite des ramens ?<br />
<br />
Moi �a m\'�clate comment Potemayo sait d�penser son argent<br />
ENJOY IT !<br />
<img src="images/news/moepote2.jpg"><br />
db0 dit : Les screens ci-dessus n\'ont rien � voir avec l\'�pisode :) Ce sont des extraits de Moetan, l\'�pisode 11. J\'en profite donc pour faire une petite pub � notre partenaire <a href="http://kanaii.com" target="_blank">Kanaii</a> gr�ce � qui on peut regarder Moetan avec des sous-titres d\'excellente qualit�.');
			$news->setCommentId(191);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('potemayo', 'ep7'));
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan ~Ni Gakki~ OAV 03 - Fin");
			$news->setTimestamp(strtotime("19 January 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage('<img src="images/news/newkodomo1.jpg" alt="Kodomo no Jikan ~Ni Gakki~ OAV 03 - Fin" /><br /><br />
Vous l\'avez attendu longtemps, celui-l� ! Il faut dire qu\'il est quand m�me sorti en aout. Alors pourquoi le sortir si tard ? Surtout qu\'il faut savoir qu\'il �tait pr�t en septembre. C\'est simple : Pour toujours rester dans l\'optique de la qualit� de nos animes, nous attendions que les paroles officielles du nouvel ending sortent. Malheuresement, elle ne sont toujours pas sorties � l\'heure actuelle. Nous pensons donc que les chances qu\'elles sortent maintenant sont minimes et avons � contre-coeur d�cid� de sortir l\'OAV maintenant et sans le karaok�. Cependant, sachez que s\'il s\'av�re que les paroles finissent par sortir, m�me tardivement, nous sortirons une nouvelle version de celui-ci avec le karaok� !<br />
Merci � DC pour avoir encod� cet �pisode et Maboroshi, avec nous en coproduction sur cette s�rie.<br />
C\'est avec ce dernier �pisode que nous marquons la fin de Kodomo no Jikan ! C\'est ma s�rie pr�f�r�e et je pense que c\'est aussi la pr�f�r�e de beaucoup de membres de chez Z�ro et sa communaut�.<br />
Nous avons pass� du bon temps aux c�t�s de Rin et ses deux amies et nous �sp�rons que c\'est aussi votre cas.<br /><br />
<img src="images/news/newkodomo2.jpg" alt="Kodomo no Jikan ~Ni Gakki~ OAV 03 - Fin" /><br /><br />
<img src="images/news/newkodomo3.jpg" alt="Kodomo no Jikan ~Ni Gakki~ OAV 03 - Fin" />');
			$news->setCommentId(185);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo2', 'ep3'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama ~Kiss on my deity~ 12 - Fin");
			$news->setTimestamp(strtotime("12 January 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("C'est aujourd'hui la fin de Tayutama. Le douzi�me et dernier �pisode toujours en coproduction avec nos amis de chez Maboroshi. Nous �sp�rons que vous avez pass� un bon moment avec nous pour cette merveilleuse s�rie ! Et maintenant, it's scrolling time !<br /><br />
<img src=\"images/news/tayufin1.jpg\" /><br />
<img src=\"images/news/tayufin2.jpg\" />");
			$news->setCommentId(176);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('tayutama', 'ep12'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama - Kiss on my Deity - 11");
			$news->setTimestamp(strtotime("04 December 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("TchO"));
			$news->setMessage("<img src=\"images/news/mashinoel.jpg\" /><br />
Tayu 11, la Bataille D�cisive !!<br /><br />
Pour calmer la col�re du dragon, la grande pr�tresse Mashiro tente...<br />
H� !!!!! Mais que se passe-t-il ????? C't'une surprise !!!<br /><br />
Pour la Bataille D�cisive, on a droit � un cosplay de Dieu !!<br />
Si c'est comme �a que Mashiro esp�re gagner la partie !<br /><br />
Tenez bon ! La fin se pr�cise, et elle est belle � regarder !<br /><br />
Coproduction Zero+Maboroshi !<br />
TchO_�");
			$news->setCommentId(152);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('tayutama', 'ep11'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama - Kiss on my Deity - 10");
			$news->setTimestamp(strtotime("17 November 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("TchO"));
			$news->setMessage("<img src=\"images/news/tayu10.jpg\" /><br />
L'Horoscope d'aujourd'hui :<br />
Humains : Ecras� par l'�motion, sachez �viter les coups de marteau !<br /><br />
Port�e par le r�ve de la coexistence, Yumina-chan danse.<br />
Quant � Ameri, elle est la proie de ses mauvais r�ves...<br /><br />
M�me romantique, la passion peut �tre tellement furieuse !");
			$news->setCommentId(149);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('tayutama', 'ep10'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama - Kiss on my Deity - 09");
			$news->setTimestamp(strtotime("05 November 2009 01:00"));
			$news->setAuthor(TeamMember::getMemberByPseudo("TchO"));
			$news->setMessage("<img src=\"images/news/tayuu9.jpg\" /><br />
Mashiro d�couvre que la moto est un souci pour aller aux sources d'eau chaudes.<br /><br />
H�, on va tous faire un karaok� ?<br />
C'est le moment de s'amuser !<br />
Entre deux entra�nements, une balade � la tour de Tokyo.<br />
Les sentiments de Mashiro n'�chappent � personne, ni � Ameri, ni �...<br /><br />
Une Zero + Maboroshi coprod<br /><br />
TchO_�");
			$news->setCommentId(141);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('tayutama', 'ep9'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama - Kiss on my Deity - 08");
			$news->setTimestamp(strtotime("05 November 2009 00:30"));
			$news->setAuthor(TeamMember::getMemberByPseudo("TchO"));
			$news->setMessage("<img src=\"images/news/tayuuu.jpg\" /><br />
Tayutama !!!!!!<br />
Tayutama, c'est pour ce soir l'�pisode 08, toujours coproduit avec la Maboroshi.<br />
Un �pisode qui nous livre, dans une exceptionnelle interpr�tation, un remake de \"j'assortis mon foulard avec ma jupe\".<br />
Et puis, on allait pas louper la tronche de Yuuri pour une fois ^^<br />
(Ca veut dire quoi, au fait, Tayutama ?)<br />
Profitez-en bien, c'est toujours aussi d�lire !!<br />
db0 dit :<br />
J'en profite en coup de vent pour vous annoncer que la deuxi�me session de Konshinkai � Lyon arrive en fin du mois, et pour �a, un forum a fait son ouverture ainsi qu'un nouveau site et un chan irc. Venez nombreux ! <a href=\"http://konshinkai.c.la\" target=\"_blank\">+ d'infos, clique.</a>");
			$news->setCommentId(140);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('tayutama', 'ep8'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama - Kiss on my Deity - 06 + 07 + Kanamemo 02");
			$news->setTimestamp(strtotime("05 November 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/tayuu.jpg\" /><br />
Bonjour tout le monde !<br />
Je me suis dit que c'�tait toujours moi qui r�digait les news, et qu'il serait temps que �a change. Donc j'ai demand� � quelques membres de l'�quipe de le faire. J'ai trouv� le r�sultat assez marrant, donc je vous donne leurs petites id�es de news :<br /><br />
Praia dit :<br />
\"On abandonne tout et on recommence : Tayutama 6 et 7 en copro avec la Maboroshi.<br />
Bon leech ! Version MP4 disponible uniquement.<br />
Kanamemo, c'est quoi ? C'est la s�rie des petits pervers... non, vous voyez, suis pas fait pour faire des news, moi... ^_^
Dommage que Sunao ne soit pas l�... Il nous aurait pondu une brique > <\"
<br /><br />
Tarf dit :<br />
\"Hein ? J'ai pas sign� pour �a moi ! Et puis je suis juste un petit trad qui fait un peu de time � ses heures perdus, donc je fais le d�but de cha�ne. C'est aux gens en bout de cha�ne de faire �a non ? Va donc voir le joli post \"staff\" que tu as pondu sur toutes les s�ries, et choppe le dernier nom ^^.<br />
Bon, une petite news : \"J'ai pu rencontrer samedi 31 octobre, � l'occasion du Konshinkai trois personnes parfois int�ressantes. J'ai ainsi parl� IRL mon idole Ryokku, qui travail en tant qu'admin pour anime ultime, qui est � mon avis un des meilleurs sites fran�ais d'anime. Apr�s une interview exclusive de ce monument vivant de l'animation, il m'a confi� qu'il d�sesp�rait de la saison en cours d'anime, et qu'aucun ne trouvait gr�ce � ses yeux. N'ayant pas les m�mes go�ts que lui, je ne suis pas d'accord, mais moi tout le monde s'en fout. Pour ceux que �a interesse, il est gentil, jeune et dynamique ! Avis aux jeunes filles, jetez vous dessus !\"<br />
Tayutama Kiss on my deity, �pisode 6 et 7 enfin sortis en corproduction avec la Maboroshi no Fansub ! La suite des aventures plus ou moins os�e de l'avatar fort mignon d'une d�esse dans le monde r�el. Vous y retrouverez l'amie d'enfance jalouse, la Tsundere et la na�ve � forte poitrine. La version MP4 est disponible imm�diatement sur le site, la version AVI �tant abandonn�e.\"<br /><br />
db0 dit :<br />
J'en profite en coup de vent pour vous annoncer que la deuxi�me session de Konshinkai � Lyon arrive en fin du mois, et pour �a, un forum a fait son ouverture ainsi qu'un nouveau site et un chan irc. Venez nombreux ! <a href=\"http://konshinkai.c.la\" target=\"_blank\">+ d'infos, clique.</a>");
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('tayutama', 'ep6'));
			$news->addReleasing(Release::getRelease('tayutama', 'ep7'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep2'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tayutama ~ Kiss on my Deity ~ 06");
			$news->setTimestamp(strtotime("21 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/newtayu.jpg\" border=\"0\" /><br />
On vous l'avait promis : on n'allait pas laisser tomber Maboroshi ! Et voil�, c'est chose faite : l'�pisode 06 de Tayutama sort aujourd'hui. J'esp�re qu'il vous plaira.");
			$news->setCommentId(105);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('tayutama', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Hitohira 05 + 06");
			$news->setTimestamp(strtotime("10 November 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/hito5.jpg\" /><br />
Mugi-choco ! Tu nous as tellement manqu�... Et tu reviens en maillot de bain, � la plage ! Yahou ! Mugi-Mugi-choco !!");
			$news->setCommentId(142);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('hitohira', 'ep5'));
			$news->addReleasing(Release::getRelease('hitohira', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Hitohira 04 + KnJ Ni Gakki OAV Sp�cial Version LD HD");
			$news->setTimestamp(strtotime("02 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/hito4.jpg\" border=\"0\" style=\"float : right; display:block; margin-right: 20px;\">
On est decid�, on va avancer nos projets ! L'un de nos plus vieux, Hitohira, revient ce soir avec son 4�me �pisode.<br />Et les versions LD et HD tant attendues de l'OAV sorti hier sont aussi arriv�es. Profitez-en, c'est gratuit, aujourd'hui ! Et tous les autres jours aussi.");
			$news->setCommentId(55);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('hitohira', 'ep4'));
			$news->addReleasing(Release::getRelease('kodomo2', 'ep0'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("KnJ 03 LD V2, Petit point sur nos petites s�ries");
			$news->setTimestamp(strtotime("26 January 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/akirin.jpg\" border=\"0\" /> <br> Petite v2 qu'on attendait depuis pas mal de temps : L'�pisode 03 de Kodomo no Jikan LD qui avait quelques petits soucis d'encodage. <a href=\"http://zerofansub.net/ddl/%5BZero%5DKodomo_no_Jikan%5B03v2%5D%5BXVID-MP3%5D%5BLD%5D%5B499E9C85%5D.avi\" target=\"_blank\" class=\"postlink\">DDL</a><br> <br>On en profite pour faire un petit point sur nos s�ries actuellement.<br> - <span style=\"font-weight: bold\">Alignment you you</span> En cours de traduction, mais on prend notre temps.<br> - <span style=\"font-weight: bold\">Genshiken 2</span> L'�pisode 07 est en cours d'adapt-edit.<br> - <span style=\"font-weight: bold\">Guardian Hearts</span> En pause pour le moment.<br> - <span style=\"font-weight: bold\">Hitohira</span> En cours de traduction.<br> - <span style=\"font-weight: bold\">Kimikiss pure rouge</span> En pause pour le moment.<br> - <span style=\"font-weight: bold\">Kodomo no Jikan</span> L'�pisode 10, 11, 12 sont pr�t. La saison 2 arrive bient�t. Heuresement, avec la fin de la saison 1 qui s'approche...<br> - <span style=\"font-weight: bold\">Kujibiki Unbalance</span> Je vais m'y mettre...<br> - <span style=\"font-weight: bold\">Kurokami</span> En attente de Karamakeur.<br> - <span style=\"font-weight: bold\">Maria Holic</span> Tr�s bient�t <img src=\"http://img1.xooimage.com/files/w/i/wink-1627.gif\" alt=\"Wink\" border=\"0\" class=\"xooit-smileimg\" /><br> - <span style=\"font-weight: bold\">Mermaid Melody</span> Notre annonce a fonctionn�e, LeChat, notre traducteur IT-FR prend la suite en charge.<br> - <span style=\"font-weight: bold\">Sketchbook full color's</span> Des V2 des �pisodes 1 et 5 ainsi que l'�pisode 6 sont en cours d'encodage par Ajira.<br> - <span style=\"font-weight: bold\">Toradora!</span> Le 10 arrive !");
			$news->setCommentId(32);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kodomo', 'ep3'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Hitohira 03");
			$news->setTimestamp(strtotime("07 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/mugi.png\" border=\"0\" /><br>Oh !<br>� cause d'un probl�me de raws, la s�rie Hitohira est rest�e en pause pendant tr���s longtemps. Mais gr�ce � Lyf, le raw-hunter, et bien s�r � Jeanba, notre nouveau traducteur, mais aussi � B3rning14, nouvel encodeur, la s�rie peut continuer. Et c'est donc l'�pisode 03 que nous sortons aujourd'hui !<br><br>La Genesis ayant accept� que leurs releases en co-pro avec la Kanaii soient diffus�es en DDL chez nous, vous pouvez maintenant retrouver la saison 2 de Rosario+Vampire ainsi que 'Kimi ga Aruji de Shitsuji ga Ore de - They are my Noble Masters'. <a href=\"http://zerofansub.net/?page=kanaiiddl\" target=\"_blank\" class=\"postlink\">Lien</a><br>Bon DL !<br><br>Les derni�res sorties de la <a href=\"http://www.kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a> :<br>- Kanokon 11<br>- Kanokon 12");
			$news->setCommentId(18);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('hitohira', 'ep3'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Quelques mises � jour");
			$news->setTimestamp(strtotime("12 October 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/sorties/lasthitohira2.png\" border=\"0\" /><br><br>Cela faisait pas mal de temps que Z�ro n'avait rien sorti !<br>Je pense vous faire plaisir en vous annon�ant quelques nouvelles :<br>- 4 �pisodes sont pr�ts et attendent juste d'�tre encod�s.<br>- 2 Nouvelles s�ries sont � para�tre :<br>-- Sketchbook ~full color's~ <br>-- Toradora!<br>- Bient�t une v3 du site !<br><br>On profite de cette news pour mettre fin � certaines rumeurs :<br>- Non ! Nous ne faisons pas de Henta�<br>- Non ! Nous n'avons pas tous 13 ans ! <br>- Nous n'avons rien contre la Genesis. Au contraire, si �a pouvait s'arranger, je pr�fererais. Nous ne comprenons toujours pas le pourquoi du comment de cette histoire, mais soyez s�r que nous ne r�pondrons jamais � leurs �ventuelles provocations, insultes ou agressions.<br>Merci � tous et Bon download !");
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('hitohira', 'ep2'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 12 ~ fin ! + 01v2 & 02v2");
			$news->setTimestamp(strtotime("29 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/ogiue.jpg\" /><br />
Et ainsi se termine Genshiken, le club d'�tude de la culture visuelle moderne, avec un 12e �pisode et quelques v2 pour perfectionner. Elle est pas trop mignonne, comme �a, Ogiue ?");
			$news->setCommentId(133);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('genshiken', 'ep12'));
			$news->addReleasing(Release::getRelease('genshiken', 'ep1'));
			$news->addReleasing(Release::getRelease('genshiken', 'ep2'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 2 �pisode 11");
			$news->setTimestamp(strtotime("19 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/genshiken-11.jpg\" style=\"float: right\" border=\"0\">
C'est les vacances pour certains membres de chez Z�ro donc on a le temps de s'occuper de vous... Du moins, des �pisodes que vous attendez avec impatience. (Pour qu'on s'occupe de vous personnellement, appelez le 08XXXXXXXX 0.34� la minute demandez Sonia) Bref, ce soir sort l'�pisode 11 de la saison 2 de Genshiken, c'est-�-dire l'avant dernier de la s�rie. Les deux copines am�ricaines sont toujours l� pour vous faire rire, mais partieront � la fin de l'�pisode. Profitez bien, c'est bient�t la fin ^^");
			$news->setCommentId(104);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('genshiken', 'ep11'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 10");
			$news->setTimestamp(strtotime("24 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/gen10.jpg\" style=\"float:right;\" border=\"0\">
Notre petit Week-end d'otaku kanaii-z�ro s'est tr�s bien pass�, dommage pour ceux qui n'y �taient pas ^^<br />Vous vous en foutez ? Anyaa ~~ Bon, bon, le v'l� votre �pisode 10 de Genshiken.<br />
Petite info importante : L'OAV de KissXsis est en cours. Apr�s sa sortie, Z�ro se met en \"pause\" temporaire puisque je passe mon bac.");
			$news->setCommentId(76);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('genshiken', 'ep10'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 09");
			$news->setTimestamp(strtotime("22 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/genshi9.jpg\" style=\"float:right;\" border=\"0\">
Nyaron~ La suite de Genshiken 2 avec l'�pisode 09. Bon download, bande d'otaku.");
			$news->setCommentId(75);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('genshiken', 'ep9'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken2 08 + Sortie Kanaii");
			$news->setTimestamp(strtotime("10 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"http://moe.mabul.org/up/moe/2009/05/10/img-122101gdcpq.png\" border=\"0\"><br />3 sorties en une journ�e, c'est un cas plut�t rare ! La suite de Genshiken2, c'est <a href=\"index.php?page=series/genshiken\">par l�</a> avec l'�pisode 08 qui sort aujourd'hui. Plus tar dans la soir�e sortieront les versions LD de Kodomo oav2 et md, ld de Maria Holic 08.<br /><br />
Une petite sortie Kanaii-Z�ro est organis�e entre Otaku le 23 et 24 mai � Nice ! Les sudistes pourront ainsi se retrouver sur nos plages ensoleill�es pour se sentir un peu en vacances. Et les nordistes, n'h�sitez pas � descendre nous voir ! Si vous souhaitez �tre de la partie, n'h�sitez pas ! Envoyez-moi un mail (zero.fansub@gmail.com) ou venez vous signaler sur le forum Kanaii : <a href=\"http://www.kanaii.com/e107_plugins/forum/forum_viewtopic.php?46591\" target=\"_blank\">Lien</a>. Venez nombreux !");
			$news->setCommentId(70);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('genshiken', 'ep8'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria+Holic 05 et Genshiken2 07");
			$news->setTimestamp(strtotime("20 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/mariagen.jpg\" border=\"0\">
<img style=\"float : left; display:block; margin-right: 20px;\" src=\"images/news/mariagen2.jpg\" border=\"0\">
Un probl�me de ftp est survenu hier soir, ce qui nous a pouss� � reporter la sortie de Maria+Holic 05 � aujourd'hui. (Nous nous excusons aupr�s de <a href=\"http://kanaii.com\" target=\"_blank\">Kanaii</a> en coproduction sur cet anime). Genshiken2 07 devait sortir ce soir. Maria 05 est toujours aussi dr�le et dans l'�pisode 07 de Genshiken, vous trouverez 2 nouveaux karaok�s (� vos micros !). Profitez bien de cette double sortie !<br /><br /><a href=\"index.php?page=series/mariaholic\">Maria Holic</a> <a href=\"index.php?page=series/genshiken\">Genshiken2</a>");
			$news->setCommentId(49);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('genshiken', 'ep7'));
			$news->addReleasing(Release::getRelease('mariaholic', 'ep5'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 06");
			$news->setTimestamp(strtotime("13 January 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/gen6.jpg\" border=\"0\" /> <br> Otaku, otaku, nous revoil� ! Genshiken �pisode 06 enfin dans les bacs, en ddl.<br> <a href=\"index.php?page=series/genshiken\" target=\"_blank\" class=\"postlink\">Pour t�l�charger les �pisodes en DDL, cliquez ici !</a><br><br>  <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.sky-fansub.com/\" target=\"_blank\" class=\"postlink\">Sky-fansub</a> :</span><br> Kurozuka 08<br> Mahou Shoujo Lyrical Nanoha Strikers 21<br> <br> <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://kyoutsu-subs.over-blog.com/\" target=\"_blank\" class=\"postlink\">Kyoutsu</a> :</span><br> Hyakko 06<br> <br> <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a> :</span><br> Kamen no maid Guy 01v2<br> Rosario+Vampire Capu2 07v2");
			$news->setCommentId(31);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('genshiken', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 05, Toradora! 08, Sketchbook 05 et Recrutement QC");
			$news->setTimestamp(strtotime("10 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/recrut/qc.jpg\" border=\"0\" /><br>3 sorties en une, aujourd'hui ! Les �pisodes 5 de Genshiken2, 8 de toradora! et 5 de Sketchbook sont disponibles dans la partie projets en DDL uniquement pour le moment. Les liens torrents, XDCC, Streaming viendront plus tard, ainsi que la version avi de genshiken et H264 de Toradora. Bon �pisode !<br><br>Notre unique QC, praia, aimerait bien partager les QC de toutes nos s�ries avec un autre QC. Si vous �tes exellent en orthographe et que vous avez un oeil de lynx, nous vous solicitons ! Merci de vous pr�senter au poste de QC ^^ <a href=\"http://zerofansub.net/index.php?page=recrutement\" target=\"_blank\" class=\"postlink\">Lien</a>");
			$news->setCommentId(21);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('genshiken', 'ep5'));
			$news->addReleasing(Release::getRelease('toradora', 'ep8'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep5'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Genshiken 04");
			$news->setTimestamp(strtotime("08 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Voil� enfin la suite de notre saga otaku pr�f�r�e, j'ai nomm�... GENSHIKEN ! L'�pisode 04 est dispo en ddl seulement pour le moment.");
			$news->setCommentId(19);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('genshiken', 'ep4'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria+Holic 12 - Fin de la s�rie");
			$news->setTimestamp(strtotime("20 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/mariafin.png\" style=\"float: right;\" />
Cette s�rie �tait si dr�le qu'elle est pass�e bien vite... Eh oui ! D�j� le dernier �pisode de Maria+Holic ! Ce 12e �pisode est compl�tement d�lirant, Kanako fait encore des siennes, et Mariya la suit de pr�s. Avec la fin de cette s�rie se termine aussi une coproduction avec Kanaii, nos partenaires et amis, qui s'est exellement bien pass�e et que nous accepterons avec plaisir de renouveler. Merci � eux et particuli�rement � DC, le ma�tre du projet aux superbes edits AE. Bon dernier �pisode, et aussi bonne s�rie � ceux qui attendaient la fin pour commencer la s�rie compl�te !");
			$news->setCommentId(115);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep12'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 07 + Maria Holic 11 + Mermaid Melody 02");
			$news->setTimestamp(strtotime("17 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/canaan7.png\" style=\"float: right\" />
<img src=\"images/news/maria11.png\" style=\"float: left\" />
Une triple sortie ce soir !<br /><br />
Tout d'abord, l'habituel Canaan de la semaine avec l'�pisode 07. Cet �pisode �tait particuli�rement difficile, avec tout ces politiciens, tout �a tout �a, donc nous a pris plus de temps que pr�vu mais nous y sommes arriv� !<br /><br />
Une deuxi�me sortie qui est en fait un �pisode d�j� encod� depuis longtemps mais que nous n'avions pas encore mis sur le site, l'�pisode 2 version italienne de Mermaid Melody Pichi Pichi Pitch. Je pense ne d�cevoir personne, mais je rappelle que nous abandonnons les versions italiennes pour continuer les versions japonaises de chez Maboroshi (nous recrutons pour cela un traducteur ! SVP ! Help us !). Les liens de t�l�chargement des 13 �pisodes par Maboroshi ne sont pas encore tous mis en place mais le seront dans le courant de la journ�e de demain.<br /><br />
Et enfin, la suite de Maria Holic que vous attendiez tous ! L'�pisode 11 et... avant-dernier �pisode. Profitez bien de ce concentr� d'humour avant la fin de cette superbe s�rie, toujours en coproduction avec nos chers amis de chez Kanaii. La version avi ne sera disponible que demain.");
			$news->setCommentId(113);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep11'));
			$news->addReleasing(Release::getRelease('canaan', 'ep7'));
			$news->addReleasing(Release::getRelease('mermaid', 'ep54'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 01 + Maria Holic 10");
			$news->setTimestamp(strtotime("16 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/canaan.jpg\" border=\"0\"><br />
Une double sortie ce soir (peut-�tre pour rattraper vos attentes ?) dont l'�pisode 10 tant attendu de Maria Holic avec comme toujours nos potes de chez Kanaii, et une nouvelle s�rie : Canaan. C'est un nouveau projet assez original puisque c'est un genre d'anime qu'on ne fait habituellement chez Z�ro. En fait, c'est Ryocu (le chef ultime !) qui s'est motiv� � la traduire. J'esp�re qu'elle vous plaiera ! Bon download !");
			$news->setCommentId(101);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep10'));
			$news->addReleasing(Release::getRelease('canaan', 'ep1'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria Holic 09");
			$news->setTimestamp(strtotime("05 June 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/maria9.jpg\" style=\"float:right;\" border=\"0\">
La team �tait en \"semi-pause\", maintenant que notre �pisode en coproduction est sorti (Maria Holic 09 avec Kanaii), la team est en pause totale et revient en juillet. Bon �pisode en attendant.");
			$news->setCommentId(78);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep9'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria Holic 08 + Doujin");
			$news->setTimestamp(strtotime("09 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/maria8.jpg\" style=\"float:right;\" border=\"0\">
Maria Holic �pisode 08 pour aujourd'hui, en coproduction avec Kanaii. Un �pisode plut�t riche, et toujours aussi dr�le. En bonus avec cet �pisode, les images des anges \"cosplay�s\" pendant l'�pisode. <a href=\"index.php?page=series/mariaholic\">C'est par l� !</a>
<br /><br />PARTIE HENTA� :<br />Une mise � jour de la partie henta� du site et la sortie d'un doujin de He is my master <a href=\"index.php?page=project&id=heismymaster\">Par l� !</a>");
			$news->setCommentId(67);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep8'));
			$news->addReleasing(Project::getProject('heismymaster'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria+Holic 07");
			$news->setTimestamp(strtotime("24 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/maria7.jpg\" border=\"0\">
La suite de Maria+Holic, toujours en coproduction avec nos petits kanailloux. Disponible en DDL pour l'instant, et un peu plus tard en torrent et MU. J'en profite pour vous informer que nous risquons de ralentir le rythme puisque je suis en vacances, mais que d�s la rentr�e, tout reviendra dans l'ordre.");
			$news->setCommentId(63);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep7'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria+Holic 06");
			$news->setTimestamp(strtotime("05 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/maria6.jpg\" border=\"0\">
Maria+Holic, la suite plut�t attendue ! L'�pisode 06, en coproduction avec la Kanaii. Et notre DC et ses edits. Un �pisode particulierement important pour la s�rie : On y apprend une information ca-pi-tale ! � ne pas manquer !<br /><br />Sinon, HS, je suis un peu d��ue de voir que le nombre de visite diminue de fa�on exponentielle depuis la fin de Toradora!... Anya >.< 
<br /><br />EDIT : Sorties des deux autres versions.");
			$news->setCommentId(56);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria Holic 03");
			$news->setTimestamp(strtotime("16 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Maria Holic 03, en copro avec <a href=\"http://kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a>. <a href=\"index.php?page=series/mariaholic\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a>");
			$news->setCommentId(39);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep3'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria Holic 02");
			$news->setTimestamp(strtotime("07 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/mariaholic2.jpg\" border=\"0\" /> <br> En direct de Lyon, je vous sors le deuxi�me �pisode de Maria+Holic en co-production avec <a href=\"http://kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a>.<br>Les m�saventures de Kanako continuent, ne les manquez pas !<br> <a href=\"index.php?page=series/mariaholic\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a><br><br> PS : Maboroshi est de retour !!");
			$news->setCommentId(38);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep2'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Maria+Holic 01");
			$news->setTimestamp(strtotime("28 January 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/kanako.png\" border=\"0\" /> <br> Nouvelle s�rie que l'on avait pas annonc� officiellement pour le moment : Maria+Holic. Mais ce n'est pas tout : Nouvelle co-production aussi, non pas avec MNF, mais cette fois-ci avec l'un de nos <a href=\"http://zerofansub.net/index.php?page=dakko\" target=\"_blank\" class=\"postlink\">partenaires dakk�</a> a qui l'on offre du DDL et qui nous laisse poster sur leur site quelques news.... <a href=\"http://www.kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii !</a><br> Tr�ves de paroles inutiles : Voici donc l'�pisode 01, disponible en DDL chez nous et torrent MU chez eux.<br> <a href=\"ddl/%5bKanaii-Zero%5d_Maria+Holic_01_%5bX264_1280x720%5d.mkv\" target=\"_blank\" class=\"postlink\">DDL</a>");
			$news->setCommentId(33);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('mariaholic', 'ep1'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Potemayo 06 (11 + 12)");
			$news->setTimestamp(strtotime("04 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/pote.jpg\" /><br />
Le sondage de la semaine derni�re �tait un peu foireux parce ce qu'on pouvait pas voter en fait donc euh les commentaires seront pris en compte finalement. Merci pour vos r�ponses. Nous continueront of course � poster moultes actualit�s concernant autre chose que le fansub. Ce sont les vacances, donc nous en profitons bien, mais nous ne ch�mons pas quand m�me et vous proposons donc quelques petits �pisodes � regarder entre 2 s�ries de bronzage ou de baignade ou que sais-je encore de randonn�es, de visites au mus�e, pourquoi pas de job d'�t�, ect. M'enfin, bref, je m'�tale inutilement (comment �a, comme d'habitude ?) et vous propose de vous rendre sur le site si vous n'y �tes pas d�j� pis d'aller t�l�charger notre petit potemayo, mignon potemayo, potemayo, potemayo naaassuuu !! (�a veut rien dire, c'est normal, j'ai un peu bu)(bah quoi ? c'est les vacances ou pas ?). Je regretterai s�rement d'avoir �crit une news aussi fonced� demain mais bon vous inqui�tez pas je l'�tais pas quand je taffais sur cet �pisode, hein. J'vous l'jure, m'sieur l'agent. J'suis sobre, moi, j'bois pas. Jamais, jamais. J'vais jamais en soir�e ou quoi, non, non. Moi, je fais du fan-sub ! Du fan-sub ! Sinon, vous avez vu, l'image de sortie, au dessus ? Elle est pourrie, hein ? C'est parce que je sais pas me servir de Gimp et que j'ai internet qu'avec ubuntu parce que j'ai fait �a avec un t�l�phone portable, en fait. C'est �a, marrez-vous. M'enf, j'apprendrais � utiliser Gimp !! Bon, bon. Et l'image du mois, elle vous pla�t ? Ouais, c'est des nichons, tout �a, l�, �a vous pla�t, ce genre de trucs. Moi, �a me pla�t bien en tout cas. Je kiffe ma race, m�me, je dirais. Et moi, je fais du cosplay !! Si, si. Fin.");
			$news->setCommentId(108);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('potemayo', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Potemayo 05");
			$news->setTimestamp(strtotime("21 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/pote5.jpg\" style=\"float:right;\" border=\"0\">
Si c'est pas trop Kawaii, �a ? Bah oui, c'est Potemayo ! Comme vous le savez, notre partenaire, Kirei no Tsubasa, a d�pos� le bilan r�cemment. Histoire de ne pas laisser leurs projets tomber � l'eau, nous avons accept� de reprendre le projet Potemayo. Nous continuons l� o� ils se sont arr�t� et sortons l'�pisode 05. Les �pisodes 01 � 04 sont aussi disponibles sur le site. Honi Honi ~");
			$news->setCommentId(74);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('potemayo', 'ep5'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kujibiki Unbalance 2 07");
			$news->setTimestamp(strtotime("18 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/kuji.jpg\" style=\"float:right;\" border=\"0\">
Kujibiki Unbalance est de retour avec l'�pisode 7 qui sort aujourd'hui. Il est riche en �motion pour nos h�ros et particuli�rement pour Tokino. Un nouveau personnage appara�t et on d�couvre des informations sur les personnages. Je vous laisse d�couvrir tout �a...");
			$news->setCommentId(102);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep7'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kujibiki Unbalance 2 06");
			$news->setTimestamp(strtotime("14 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/kuji6.jpg\" border=\"0\">
Apr�s une longue attente sans Kujibiki, la s�rie continue avec l'�pisode 06 (Z�ro n'abbandonne jamais !). Merci � Zetsubo Sensei qui prend le relais pour la traduction.<br /><br />
Ce Week-End, Mangazur � Toulon. Une petite convention tr�s sympa ^^ J'y serais, n'h�sitez pas � me contacter (zero.fansub@gmail.com). Et venez nombreux pour cet �v�nement.");
			$news->setCommentId(59);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux Anniversaire ! Z�ro a un an aujourd'hui. + Kujibiki Unbalance 05");
			$news->setTimestamp(strtotime("18 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/unan.png\" border=\"0\" /><br>Z�ro f�te aujourd'hui son anniversaire ! Cela fait maintenant un an que le site Z�ro existe. Cr�e le 18 d�cembre 2007, il �tait au d�part un site de DDL. Ce n'est que le 6 janvier que le site deviens une team de fansub ^^ Pour voir les premi�res versions, allez sur la page '� propos...'. Merci � tous pour votre soutien, c'est gr�ce � vous que nous en sommes arriv�s l� !<br><br>Comme petit cadeau d'anniversaire, voici l'�pisode 05 de Kujibiki Unbalance, en �sp�rant qu'il vous plaira.<br><br><span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.sky-fansub.com/\" target=\"_blank\" class=\"postlink\">Sky-fansub</a> :</span><br>Kurozuka 06 HD<br>Mahou Shoujo Lyrical Nanoha Strikers 18");
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep5'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kujian 4, Recrutement Encodeur, Dons pour le sida");
			$news->setTimestamp(strtotime("01 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sida.png\" border=\"0\" /><br>Ciao !<br>Sortie de Kujibiki Unbalance, l'�pisode 04 ! Je tiens � remercier DC, qui, par piti� peut-�tre ^^, nous a encod� cet �pisode.<br><br>Oui ! Comme vous l'avez compris, nous recrutons de mani�re urgente un encodeur !<br>N'h�sitez pas � vous proposer <img src=\"http://img1.xooimage.com/files/s/m/smile-1624.gif\" alt=\"Smile\" border=\"0\" class=\"xooit-smileimg\" /> &gt; <a href=\"index.php?page=recrutement\" target=\"_blank\" class=\"postlink\">Lien</a>.<br><br>Aujourd'hui, 1er d�cembre, journ�e internationale du Sida. Nous vous rappelons que les dons et les clicks sur les pubs sont revers�s � l'association medecin du monde. Nous avons besoin de vous !<br><a href=\"index.php?page=dons\" target=\"_blank\" class=\"postlink\">En savoir plus sur le fonctionnement des dons sur le site</a><br><a href=\"http://zerofansub.net/#\" target=\"_blank\" class=\"postlink\">En savoir plus sur l'action de l'association</a><br><br>Sinon, Man-Ban nous a fait une jolie fanfic que vous pouvez lire dans la partie Scantrad <img src=\"http://img1.xooimage.com/files/s/m/smile-1624.gif\" alt=\"Smile\" border=\"0\" class=\"xooit-smileimg\" /><br>Merci � tous et � bient�t !<br>//<a href=\"http://db0.fr/\" target=\"_blank\" class=\"postlink\">db0</a>");
			$news->setCommentId(16);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kujibiki', 'ep4'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Fin de la s�rie Sketchbook ~full color's~");
			$news->setTimestamp(strtotime("30 June 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sketchend.jpg\"><br />
Nous avons temporairement repris de nos activit�s pour finir la s�rie Sketchbook full color's. Sortie aujourd'hui de 5 �pisodes d'un coup : 09, 10, 11, 12 et 13 :) Profitez bien de ctte magnifique s�rie, et � dans deux jours � Japan Expo !");
			$news->setCommentId(98);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep9'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep10'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep11'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep12'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep13'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~ full color's ~ 08");
			$news->setTimestamp(strtotime("15 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sketch8.png\" border=\"0\"><br />V'l� d�j� la suite de Sketchbook full colors ! L'�pisode 08 est disponible, et � peine 2 jours apr�s l'�pisode 07 ! Si c'est pas beau, �a ? Allez, d�tendez-vous un peu en regardant ce joli �pisode. <a href=\"index.php?page=series/sketchbook\" target=\"_blank\">En t�l�chargement ici !</a>");
			$news->setCommentId(72);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep8'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~ full color's ~ 07");
			$news->setTimestamp(strtotime("12 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sketch7.jpg\" style=\"float:right;\" border=\"0\">
On avance un peu dans Sketchbook aussi, �pisode 07 aujourd'hui ! Apparition d'un nouveau personnage : une �tudiante transfer�e. Cet �pisode est plut�t dr�le. <a href=\"index.php?page=series/sketchbook\" target=\"_blank\">Et t�l�chargeable ici !</a>");
			$news->setCommentId(72);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep7'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~full color's~ 06 + 01v2 + 02v2 + 05v2");
			$news->setTimestamp(strtotime("23 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/sketchh.jpg\" border=\"0\">
Une avalanche de Sketchbook ! Ou plut�t, une avalanche de fleurs ^^ Avec la sortie longtemps attendue de la suite de Sketchbook �pisode 06 et de 3 v2 (tout �a pour am�liorer la qualit� de nos releases) Enjoy !");
			$news->setCommentId(62);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep6'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep1'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep2'));
			$news->addReleasing(Release::getRelease('sketchbook', 'ep5'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~full color's 04~ ; Kanaii DDL et Sky-fansub");
			$news->setTimestamp(strtotime("05 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/moka.jpg\" border=\"0\" /><br>Bouonj�u !<br>L'�pisode 04 de Sketchbook est sorti ! <a href=\"index.php?page=series/sketchbook\" target=\"_blank\" class=\"postlink\">Lien</a> Les sorties se font attendre, �tant donn� qu'on a plus vraiment d'encodeur officiel ^^ Merci � Kyon qui nous a encod� c'lui-ci.<br>Beaucoup nous demandaient o� il fallait t�l�charger nos releases. Probl�me r�gl�, j'ai fait une page qui r�sume tout. <a href=\"index.php?page=dl\" target=\"_blank\" class=\"postlink\">Lien</a><br>J'offre aussi du DDL � notre partenaire : la team Kanaii. Allez t�l�charger leurs animes, ils sont tr�s bons ! <a href=\"index.php?page=kanaiiddl\" target=\"_blank\" class=\"postlink\">Lien</a><br>Nous avons aussi un nouveau partenaire : La team Sky-fansub. <a href=\"http://www.sky-fansub.com/\" target=\"_blank\" class=\"postlink\">Lien</a><br>//<a href=\"http://db0.fr/\" target=\"_blank\" class=\"postlink\">db0</a><br>PS : 'Bouonj�u' c'est du ni�ois <img src=\"http://img1.xooimage.com/files/s/m/smile-1624.gif\" alt=\"Smile\" border=\"0\" class=\"xooit-smileimg\" /><br><br>Les derni�res sorties de la <a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi</a> :<br>- Neo Angelique Abyss 2nd Age 07<br>- Akane Iro Ni Somaru Saka 07");
			$news->setCommentId(17);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep4'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sketchbook ~full color's 03~");
			$news->setTimestamp(strtotime("22 November 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Bonjour, bonjour !<br>Sortie de l'�pisode 03 de Sketchbook full color's !<br>Et c'est tout. Je sais pas quoi dire d'autre. Bonne journ�e, mes amis. <br>//<a href=\"http://db0.fr/\" target=\"_blank\" class=\"postlink\">db0</a>");
			$news->setCommentId(13);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('sketchbook', 'ep3'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan ~ Ni Gakki OAV 02");
			$news->setTimestamp(strtotime("10 May 2009 01:00"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/knjng2.png\" border=\"0\"><br />La suite tant attendue des aventures de Rin, Kuro et Mimi ! Un �pisode riche en �motion qui se d�roule pendant la f�te du sport o� toutes les trois font de leur mieux pour que leur classe, la CM1-1, remporte la victoire ! Toujours en coproduction avec <a href=\"http://www.maboroshinofansub.fr/\" target=\"_blank\">Maboroshi</a>. Cet �pisode a �t� traduit du Japonais par Sazaju car la vosta se faisait attendre, puis \"am�lior�e\" par Shana. C'est triste, hein ? Plus qu'un et c'est la fin... <a href=\"index.php?page=series/kodomo2\">Ici, ici !</a>");
			$news->setCommentId(69);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo2', 'ep2'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan ~ Ni Gakki OAV 01");
			$news->setTimestamp(strtotime("13 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/knjoav1.png\" border=\"0\">
C'est maintenant que la saison 2 de Kodomo no Jikan commence vraiment ! Profitez bien de cette �pisode ^^ Toujours en coproduction avec <a href=\"http://maboroshinofansub.fr\" target=\"_blank\">Maboroshi no fansub</a>, chez qui vous pourrez t�lecharger l'�pisode en XDCC. Chez nous, c'est comme toujours en DDL. Nous vous rappelons que les torrents sont disponibles peu de temps apr�s, et que tout nos �pisodes sont disponibles en Streaming HD sur <a href=\"http://www.anime-ultime.net/part/Site-93\" target=\"_blank\">Anime-Ultime</a>.");
			$news->setCommentId(58);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo2', 'ep1'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan ~ Ni Gakki OAV Sp�cial");
			$news->setTimestamp(strtotime("01 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/nigakki0.jpg\" border=\"0\">
Vous l'attendiez TOUS ! (Si, si, m�me toi) Il est arriv� ! Le premier OAV de la saison 2 de Kodomo no Jikan. Cet OAV est consacr� � Kuro-chan et Shirai-sensei. Amateurs de notre petite goth-loli-neko, vous allez �tre servis ! Elle est encore plus kawaii que d'habitude ^^ La saison 2 se fait en coproduction avec <a href=\"http://maboroshinofansub.fr\" target=\"_blank\">Maboroshi</a> et avec l'aide du grand (� grand) DC.");
			$news->setCommentId(55);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo2', 'ep0'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 24 + 25 - FIN");
			$news->setTimestamp(strtotime("29 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<a href=\"images/news/torafin.jpg\" target=\"_blank\"><img src=\"images/news/min_torafin.jpg\" border=\"0\"></a><br /><br />
C'est ainsi que se termine Toradora! ...");
			$news->setCommentId(53);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep24'));
			$news->addReleasing(Release::getRelease('toradora', 'ep25'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 23");
			$news->setTimestamp(strtotime("27 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/tora23.png\" border=\"0\">
La suite de Toradora! avec l'�pisode 23. Toujours aussi �mouvant, toujours aussi kawaii, toujours aussi Taiga-Ami-Minorin-Ryyuji-ect, toujours aussi dispo sur <a href=\"http://toradora.fr/\" target=\"_blank\">Toradora.fr!</a>, toujours aussi en copro avec <a href=\"http://japanslash.free.fr\" target=\"_blank\">Maboroshi</a>, toujours en DDL sur notre site <a href=\"index.php?page=series/toradora\">\"Lien\"</a>, Bref, toujours aussi g�nial ! Enjoy ^^<br /><br />Discutons un peu (dans les commentaires) ^^<br />Que penses-tu des Maid ? Tu es fanatique, f�tichiste, amateur ou indiff�rent ?");
			$news->setCommentId(52);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep23'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 22");
			$news->setTimestamp(strtotime("25 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/taiiga.jpg\" border=\"0\">
Que d'�motion, que d'�motion ! La suite de Toradora!, l'�pisode 22. Nous vous rappelons que vous pouvez aussi t�l�charger les �pisodes et en savoir plus sur la s�rie sur <a href=\"http://toradora.fr/\" target=\"_blank\">Toradora.fr!</a>. Sinon, les �pisodes sont toujours t�l�chargeables chez <a href=\"http://japanslash.free.fr\" target=\"_blank\">Maboroshi</a> en torrent et XDCC et chez nous <a href=\"index.php?page=series/toradora\">par ici en DDL.</a> Enjoy ^^");
			$news->setCommentId(51);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep22'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 21");
			$news->setTimestamp(strtotime("23 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/ski.jpg\" border=\"0\"><br /><br />
Toradora! encore et encore, et bient�t, la fin de la s�rie. Cet �pisode est encore une fois bourr� d'�motion et de rebondissements... Et de luge, et de neige, et de skis ! <a href=\"index.php?page=series/toradora\">C'est par ici que �a se t�l�charge !</a><br /><br />Profitions-en pour discutailler ! Alors, toi, lecteur de news de Z�ro... Tu es parti en vacances, faire du ski ? Raconte-nous tout �a dans les commentaires ;)");
			$news->setCommentId(50);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep21'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 19");
			$news->setTimestamp(strtotime("16 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/taigahand.jpg\" border=\"0\"><br />
Apr�s une semaine d'absence (je passais mon Bac Blanc >.< ), nous reprenons notre travail. Ou plut�t, notre partenaire <a href=\"http://japanslash.free.fr\" target=\"_blank\">Maboroshi</a> nous fait reprendre le travail ^^ Sortie de l'�pisode 19 de toradora, avec notre petite Taiga toute kawaii autant sur l'image de cette news que dans l'�pisode ! Comme d'hab, DDL sur le site, Torrent bient�t (Merci � Khorx), XDCC bient�t et d�j� dispo chez <a href=\"http://japanslash.free.fr\" target=\"_blank\">Maboroshi</a>. <a href=\"index.php?page=series/toradora\">\"Ze veux l'�pisodeuh !\"</a>.");
			$news->setCommentId(46);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep19'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 18");
			$news->setTimestamp(strtotime("05 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/noeltora.jpg\" border=\"0\">
Serait-ce le rythme \"une sortie / un jour\" qui nous prend, � Z�ro et <a href=\"http://japanslash.free.fr\" target=\"_blank\">Maboroshi</a> ? Peut-�tre, peut-�tre... En tout cas, voici la suite de Toradora!, l'�pisode 18 ! <a href=\"index.php?page=series/toradora\">Je DL tisouite !</a>");
			$news->setCommentId(43);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep18'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 16");
			$news->setTimestamp(strtotime("25 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/blond.jpg\" border=\"0\">
Toradora!, pour changer, en copro avec <a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi no Fansub</a>. Un �pisode plein d'�motion, de tendresse et de violence � la fois. � ne pas manquer ! <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a>");
			$news->setCommentId(39);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep16'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 15 et Chibi JE Sud");
			$news->setTimestamp(strtotime("20 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/chibi.jpg\" border=\"0\" /><br> En pleine chibi Japan Expo Sud, Toradora! continue avec ce soir l'�pisode 15 !<br> <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a><br> Rejoignez nous pour cet �venement : <br> Chibi Japan Expo � Marseille ! J'y serais, Kanaii y sera. Nous serions ravis de vous rencontrer, alors n'h�sitez pas � me mailer (Zero.fansub@gmail.com).<br><br> Derni�res sortie de nos partenaires :<br> Kyoutsu : Minami-ke Okawari 02 et Ikkitousen OAV 04<br> Kanaii : Kamen no Maid Guy 08<br> Sky-fansub : Kurozuka 09 et Mahou Shoujo Lyrical Nanoha Strikers 25");
			$news->setCommentId(41);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('toradora', 'ep15'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 12-13-14");
			$news->setTimestamp(strtotime("17 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/dentifrice.jpg\" border=\"0\" /><br> db0 s'excuse pour sa news ultra-courte de la derni�re fois pour Maria Holic 3 et en compensasion va raconter sa vie dans celle-ci (Non, pas �a !). C'est aujourd'hui et pour la premi�re fois chez Z�ro une triple sortie ! Les �pisodes 12, 13 et 14 de Toradora! sont disponibles, toujours en copro avec <a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi</a>.<br> <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">Les �pisodes en DDL, c'est par ici !</a><br><br> J'en profite aussi pour vous pr�ciser que les 2 autres versions de Maria 03 sont sorties.<br> Mais surtout, je vous sollicite pour une IRL :<br> Chibi Japan Expo � Marseille ! J'y serais, Kanaii y sera. Nous serions ravis de vous rencontrer, alors n'h�sitez pas � me mailer (Zero.fansub@gmail.com).");
			$news->setCommentId(40);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('toradora', 'ep12'));
			$news->addReleasing(Release::getRelease('toradora', 'ep13'));
			$news->addReleasing(Release::getRelease('toradora', 'ep14'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 11");
			$news->setTimestamp(strtotime("11 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"http://japanslash.free.fr/images/news/toradora11.jpg\" border=\"0\" /> <br> La suite, la suite ! Toradora! �pisode 11 sortie, en copro avec <a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi no Fansub</a>.<br><br><br> <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a>");
			$news->setCommentId(39);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep11'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 10");
			$news->setTimestamp(strtotime("10 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/ami.png\" border=\"0\" /> <br> En direct de Nice, et pour ce 10 F�vrier, l'�pisode 10 de Toradora! en co-production avec <a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi no Fansub</a>, qui est de retour, comme vous l'avez vu ! (Avec Kannagi 01, Mermaid 11-12-13 et Kimi Ga 4). Pour Toradora!, nous allons rattraper notre retard !<br><br><br> <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">L'�pisode en DDL, c'est par ici !</a>");
			$news->setCommentId(39);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep10'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 09");
			$news->setTimestamp(strtotime("04 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/tora.jpg\" border=\"0\" /> <br> L'�pisode 09 de Toradora! est termin� ! Nous avons pris du retard car la MNF (en co-production) est actuellement en pause temporaire (Tohru n'a plus internet).<br> <a href=\"index.php?page=series/toradora\" target=\"_blank\" class=\"postlink\">Pour t�l�charger les �pisodes en DDL, cliquez ici !</a><br><br>  <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.sky-fansub.com/\" target=\"_blank\" class=\"postlink\">Sky-fansub</a> :</span><br> Kurozuka 07<br> Mahou Shoujo Lyrical Nanoha Strikers 20<br> <br> <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://kyoutsu-subs.over-blog.com/\" target=\"_blank\" class=\"postlink\">Kyoutsu</a> :</span><br> Hyakko 05<br> <br> <span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a> :</span><br> Kamen no maid Guy 06<br> Rosario+Vampire Capu2 06");
			$news->setCommentId(31);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep9'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! 07");
			$news->setTimestamp(strtotime("24 November 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/toradora.png\" border=\"0\" /><br>Ohayo mina !<br>La suite de Toradora est arriv�e ! Et toujours en co-production avec la Maboroshi  <img src=\"http://img1.xooimage.com/files/s/m/smile-1624.gif\" alt=\"Smile\" border=\"0\" class=\"xooit-smileimg\" /> <br>Cet �pisode se d�roule � la piscine, et 'Y'a du pelotage dans l'air !' Je n'en dirais pas plus.<br>L'�pisode est sorti en DDL en format avi, en XDCC. Comme toujours, il sortira un peu plus tard en H264, torrent, streaming, ect.<br>//<a href=\"http://db0.fr/\" target=\"_blank\" class=\"postlink\">db0</a>");
			$news->setCommentId(14);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('toradora', 'ep7'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Nouveau XDCC, Radio, Scantrad et Toradora! 06");
			$news->setTimestamp(strtotime("20 November 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/img_shinobu.gif\" border=\"0\" /><br>Bonjour tout le monde !<br>J'ai aujourd'hui plusieurs bonnes nouvelles � vous annoncer :<br>La V3 avance bien, et je viens de mettre � jour les pages pour le scantrad, car comme vous le savez, nous commen�ons gr�ce � Fran�ois et notre nouvelle recrue Merry-Aime notre premier projet scantrad : Kodomo no Jikan.<br>J'ai aussi install�e la radio tant attendue et mis sur le site quelques OST.<br>Nous avons aussi, gr�ce � Ryocu, un nouveau XDCC. Vous aviez sans doute remarquer que nous ne pouvions pas mettre � jour le pr�c�dent. Celui-ci sera mis � jour � chaque nouvelle sortie.<br>Et enfin, notre derni�re sortie : Toradora! 06. Toujours en co-production avec<a href=\"http://japanslash.free.fr/\" target=\"_blank\" class=\"postlink\">Maboroshi</a>.<br>Enjoy  <img src=\"http://img1.xooimage.com/files/w/i/wink-1627.gif\" alt=\"Wink\" border=\"0\" class=\"xooit-smileimg\" /> <br>//<a href=\"http://db0.fr/\" target=\"_blank\" class=\"postlink\">db0</a>");
			$news->setCommentId(7);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('toradora', 'ep6'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan 12 FIN");
			$news->setTimestamp(strtotime("06 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/kodomo12fin.png\" border=\"0\"><br />
C'est ainsi, en ce 6 mars 2009, que nous f�tons � la fois l'anniversaire de la premi�re release de Z�ro (Kodomo no Jikan OAV) et l'achevement de notre premi�re s�rie de 12 �pisodes. L'�pisode 12 de Kodomo no Jikan sort aujourd'hui pour clore les aventures de nos 3 petites h�ro�nes : Rin, Mimi et Kuro. Il est dispo en DDL sur <a href=\"http://kojikan.fr\">le site Kojikan.fr</a>. Un pack des 12 �pisodes sera bient�t disponible en torrent. <br /><a href=\"http://kojikan.fr/?page=saison1-dl_1\" target=\"_blank\">T�l�charger en DDL !</a>");
			$news->setCommentId(44);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo', 'ep12'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kojikan 10");
			$news->setTimestamp(strtotime("03 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/kodomo10.jpg\" border=\"0\" /><br> RIIINN est revenue ! Elle nous apporte son dixi�me �pisode. Plus que 2 avant la fin, et la saison 2 par la suite. Une petite surprise arrive bient�t, sans doute pour le onzi�me �pisode. En attendant, retrouvez vite notre petite d�lur�e dans la suite de ses aventures et ses tentatives de s�duction de Aoki-sensei...");
			$news->setCommentId(37);
			$news->setTeamNews(false);
			$news->addReleasing(Release::getRelease('kodomo', 'ep10'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan 09, Recrutement QC, trad it&gt;fr");
			$news->setTimestamp(strtotime("13 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/kodomo9.jpg\" border=\"0\" /><br>Rin, Kuro et Mimi reviennent enfin vous montrer la suite de leurs aventures ! Sortie aujourd'hui de l'�pisode 09, merci � DC qui nous l'a encod�. Les 3 versions habituelles sont dispos en DDL.<br><br>Nous recrutons toujours un QC ! Proposez-vous !<br>Nous avons d�cider de reprendre le projet Mermaid Melody Pichi Pichi Pitch, mais pour cela nous avons besoin d'un traducteur italien &gt; fran�ais. N'h�sitez pas � postuler si vous �tes int�ress�s <img src=\"http://img1.xooimage.com/files/s/m/smile-1624.gif\" alt=\"Smile\" border=\"0\" class=\"xooit-smileimg\" /> Par avance, merci. <a href=\"index.php?page=recrutement\" target=\"_blank\" class=\"postlink\">Lien</a><br><br><span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a> :</span><br>Kanokon pack DVD 06 � 12<br>Rosario + Vampire S2 -05<br><span style=\"font-weight: bold\">Les derni�res sorties de la <a href=\"http://www.sky-fansub.com/\" target=\"_blank\" class=\"postlink\">Sky-fansub</a> :</span><br>Kurozuka 05 HD<br>Mahou Shoujo Lyrical Nanoha Strikers 17");
			$news->setCommentId(22);
			$news->setTeamNews(true);
			$news->addReleasing(Release::getRelease('kodomo', 'ep9'));
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(false);
			$news->setPartnerNews(true);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeuses f�tes !");
			$news->setTimestamp(strtotime("26 December 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setMessage("<img src=\"images/news/noel0.jpg\" alt=\"merry christmas ore no imouto\" /><br /><br />
Une autre ann�e se termine, mais ne vous en faite pas, nous on continue ! M�me si on semble �tre au point mort, �a s'active dans les coulisses. Ne perdez pas espoir, vos commentaires ne sont pas tomb�s aux oubliettes !<br /><br />
Toute l'�quipe de Z�ro Fansub vous souhaite de joyeuses f�tes de fin d'ann�e et esp�re vous retrouver l'ann�e prochaine pour de nouvelles s�ries ! N'h�sitez pas � passer sur le forum pour nous soutenir !<br /><br /><br />
<img src=\"images/news/noel1.jpg\" alt=\"merry christmas ore no imouto\" /><br /><br />
<img src=\"images/news/noel2.jpg\" alt=\"merry christmas ore no imouto\" /><br /><br />
PS : Le projet Canaan est licenci� par Kaze. Le dvd de l'integrale est d�j� disponible en pr�-order !<br /><br />
<img src=\"images/news/dvdcanaan.jpg\" alt=\"DVD canaan buy pre-order kaze\" />");
			$news->setCommentId(250);
			$news->setTeamNews(true);
			$news->setTwitterTitle("Toute l'equipe Zero fansub vous souhaitent de joyeuses fetes !");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Newsletter");
			$news->setTimestamp(strtotime("30 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Pour ceux qui ne seraient pas au courant, 
il est possible de recevoir un mail � chaque fois q'une \"news\" (sorties ou autre) apparait sur le site.<br />
Pour b�n�ficier de ce service et �tre les premier au courant, il suffit de vous inscrire sur le forum :<br />
<a href=\"http://forum.zerofansub.net/profile.php?mode=register&agreed=true\" target=\"_blank\">S'inscrire !</a><br />
<br />
<div class=\"left\">
<ul>
<li>Vous n'�tes pas oblig�s d'�tre un membre actif du forum pour la recevoir.</li>
<li>Nous ne divulgons votre adresse e-mail � personne.</li>
<li>� tout moment, vous pouvez arr�ter votre abonnement (lien en bas des newsletter).</li>
<li>Nous ne vous envoyons rien de plus que nos news : pas de spams, de pubs, etc.</li>
</ul>
</div>
<br />
Pour les habitu�s des flux RSS, vous pouvez aussi suivre nos news :<br />
<a href=\"http://zerofansub.feedxs.com/zero.rss\" target=\"_blank\">Flux RSS</a><br /><br />
<img src=\"images/news/newsletters.jpg\" alt=\"Newsletter Z�ro fansub\" />");
			$news->setCommentId(235);
			$news->setTeamNews(true);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("L'�cole du fansub + Mayoi Neko Overrun!");
			$news->setTimestamp(strtotime("22 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/ecolelogo.png\" /><br /><br />
Suite au succ�s inattendu de la pr�c�dente news, nous avons d�cider d'ouvrir une s�ction sp�ciale dans Z�ro fansub : L'�cole du fansub.<br /><br />
<div style=\"text-align: left\"><b>Le Concept</b><br />
Donner les moyens � des personnes motiv�es mais n'ayant aucune �xp�rience en fansub d'entrer dans une �quipe en les formant depuis la base.<br />
<br />
<b>Comment �a marche ?</b><br />
Parce que la pratique vaut mieux que la simple th�orie, on vous demandera d'effectuer des exercices et activit�s concr�tes qui seront tout de suite utilis�s pour l'�quipe. Il y aura des t�ches � faire avec des dates de rendus (assez flexibles) et vous ne serez jamais seuls puisqu'une section \"salle des profs\" vous permet de poser toutes les questions que vous voulez aux membres de l'�quipe.<br />
<br />
<b>Quelles sont les qualit�s requises ?</b><br />
- �tre tr�s motiv�<br />
- �tre disponible<br />
- �tre patient<br />
- Avoir envie de d�couvrir les coulisses du fansub<br />
- Avoir la soif d'apprendre<br />
- �tre pr�t � effectuer des taches pas tr�s amusantes pour commencer<br />
- N'avoir pas ou peu d'�xp�rience en fansub<br />
<br />
<b>Comment vais-je �voluer ?</b><br />
� chaque exercice rendu, le prof de la mati�re vous donnera une note bas�e sur des crit�res pr�cis avec des bonus et des malus ainsi qu'un commentaire. Vous saurez ainsi apprendre de vos erreurs pour progresser.<br />
<br />
<b>Quelles sont les mati�res enseign�es et par qui ?</b><br />
Actuellement, nous enseignons dans notre �cole :<br />
<ul>
<li>Utilisation du logiciel Aegisub pour le timing, l'�dition, ect - db0</li>
<li>Apprentissage du langage ASS pour l'�dition, le karaok�, ect - db0</li>
<li>Programmation orient�e web, XHTML/CSS/PHP - db0, Sazaju</li>
<li>Programmation en tout genre - db0, Sazaju</li>
<li>Cours de langue, Japonais �crit et oral - Sazaju</li>
<li>Cours de langue, Anglais - TchO, praia</li>
<li>Fran�ais �crit, grammaire orthographe - TchO, praia</li>
<li>Scantraduction, photoshop & co - db0</li>
</ul><br />
Par la suite seront enseign�s l'encodage vid�o et l'utilisation du logiciel After Effect pour les effets vid�os.<br />
<br />
<b>Comment y entrer ?</b><br /></div>
D�j� 11 personnes qui ont postul�e pour entrer � l'�cole du fansub, dont 7 qui y sont entr�es.<br/>Et vous ?<br/>
<span>~ <a href=\"http://forum.zerofansub.net/t981-Comment-entrer-dans-l-ecole-du-fansub.htm\" target=\"_blank\">Postuler</a> ~</span><br /><br />

� l'occasion de l'ouverture de cette �cole pas comme les autres, nous commencons une s�rie :<br />
Mayoi Neko Overrun!<br />
qui sera enti�rement fansubb�e par les �l�ves de l'�cole du fansub �paul�s par leurs professeurs.<br /><br />
<img src=\"images/news/newsmayoi.jpg\" />");
			$news->setCommentId(226);
			$news->setTeamNews(true);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement novice");
			$news->setTimestamp(strtotime("19 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/newsrecru.png\" /><br />
Bonjour tout le monde !<br />
Actuellement, nous recherchons quelqu'un qui n'a aucune conaissance ni �xp�rience en fansub pour rejoindre nos rangs.<br />
Au d�part, pour effectuer des t�ches tr�s simples qui nous permettrons d'aller plus vite dans nos sorties, et petit � petit d'apprendre les diff�rents domaines du fansub � nos c�t�s.<br />
Vous devez pour �a �tre tr�s motiv�, avoir envie de d�couvrir les coulisses du fansub, �tre pr�sent et actif parmi nous, avoir la soif d'apprendre et �tre pr�t � faire des t�ches pas forc�ment tr�s amusantes pour commencer.<br />
Fiche � remplir :<br /><br />
[b]R�le[/b] Novice<br />
[b]Pr�nom[/b] REMPLIR<br />
[b]�ge[/b] REMPLIR<br />
[b]Lieu[/b] REMPLIR<br />
[b]Motivation[/b] REMPLIR<br />
[b]Exp�rience fansub[/b] REMPLIR<br />
[b]Exp�rience hors fansub[/b] REMPLIR<br />
[b]CDI ou CDD (dur�e) ? [/b] CDI<br />
[b]Disponibilit�s[/b] REMPLIR<br />
[b]D�j� membres d'autre �quipe ?[/b] REMPLIR<br />
[b]Si oui, lesquelles ?[/b] REMPLIR<br />
[b]Connexion internet[/b] REMPLIR<br />
[b]Syst�me d'exploitation[/b] REMPLIR<br />
[b]Autre chose � dire ?[/b] REMPLIR");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sondage : Vos s�ries pr�f�r�es, les r�sultats");
			$news->setTimestamp(strtotime("31 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/sondageres.png\" /><br />
Nous vous avons laiss� 5 jours pour r�pondre au sondage et le nombre de participants nous a positivement �tonn�, �tant donn� que le nombre de visiteurs est en baisse compar� � l'an dernier.<br />
Vous avez �t� 24 personnes � participer et � d�fendre votre s�rie pr�f�r�e.<br />
Les votes ont �t� comptabilis�s de la mani�re suivante : Une s�rie en premi�re place vaut 5 points, deuxi�me 4, trois�me 3, quatri�me 2 et cinqui�me 1. Si vous n'avez vot� que pour une s�rie, vous lui avez donn� 5 points. J'ai v�rifi� rapidement les adresses IP et il n'y a pas eu d'ab�rances donc je consid�re que personne n'a trich�.<br />
Sans plus attendre, les r�sultats :
<a href=\"index.php?page=series/kissxsis\"><img src=\"images/series/kissxsis.png\" border=\"0\" alt=\"KissXsis\"></a><br />
KissXsis, OAV3 et s�rie avec 51 points. La s�rie benn�ficiera donc du mode Toradora! d�s sa sortie. Pour ceux qui ne conaissent pas le mode Toradora!, c'est le nom que la team donne aux s�ries dont les �pisodes sortent moins d'une semaine apr�s la vosta.<br />
<a href=\"index.php?page=series/kujibiki\"><img src=\"images/series/kujibiki.png\" border=\"0\" alt=\"Kujibiki Unbalance 2\"></a><br />
En seconde place, Kujibiki Unbalance 2 avec 44 points. Pour �tre honn�tes, nous nous attendions � avoir Kanamemo en seconde place. Ceci nous montre que beaucoup de leechers foncent sur la premi�re sortie d'une s�rie, et si Kujibiki Unbalance avait �t� fait par une autre team plus rapide, elle n'aurait s�rement pas cette place-l�. D��us, mais nous nous doutions bien que la plupart des gens pr�f�rent la rapidit� � la qualit�.<br />
<a href=\"index.php?page=series/kimikiss\"><img src=\"images/series/kimikiss.png\" border=\"0\" alt=\"Kimikiss pure rouge\"></a><br />
Kimikiss Pure Rouge, avec 28 points. Ici, c'est l'�tonnement inverse. Une s�rie pour laquelle nos �pisodes sont tous � refaire d� � leurs m�diocrit� (des v2 dont pr�vus pour les �pisodes 1 � 6) et termin�e chez plusieurs autres teams. Nous sommes dans l'incompr�hension, mais �a nous fait plaisir de voir qu'on attends cette s�rie de nous :)<br />
<a href=\"index.php?page=series/kannagi\"><img src=\"images/series/kannagi.png\" border=\"0\" alt=\"Kannagi\"></a><br />
Kannagi remporte 27 points. Nous n'avons pas encore sortis d'�pisodes pour cette s�rie malgr� qu'ils soient presque tous termin�s car nous pensions que cette s�rie n'aurait pas beaucoup de succ�s. Une quatri�me place, c'est pas mal, il va falloir qu'on s'y mette.<br />
<a href=\"index.php?page=series/kanamemo\"><img src=\"images/series/kanamemo.png\" border=\"0\" alt=\"Kanamemo\"></a><br />
Kanamemo avec 23 points. Grosse d�c�ption pour une s�rie que nous mettions en priorit� sur les autres avant ce sondage. Nous soup�onnons nos fans de pr�f�rer nos concurrents pour une s�rie qui refl�te pourtant l'�tat d'esprit de notre �quipe.<br />
<a href=\"index.php?page=series/hitohira\"><img src=\"images/series/hitohira.png\" border=\"0\" alt=\"Hitohira\"></a><br />
Hitohira avec 17 points. Rien d'�tonnant, nous savions que cette s�rie n'avait pas beaucoup de succ�s.<br />
<a href=\"index.php?page=series/potemayo\"><img src=\"images/series/potemayo.png\" border=\"0\" alt=\"Potemayo\"></a><br />
Potemayo avec 9 points. Un tout petit peu d��u mais pas �tonn�s pour autant. La s�rie est un peu niaise, mais moi je l'aime beaucoup ^^<br />
<a href=\"?page=havert\"><img src=\"images/series/hshiyo.png\" alt=\"Faisons l'amour ensemble, Issho ni H shiyo\" border=\"0\"></a><br />
En bon dernier, Issho ni H shiyo avec 5 points (un seul vote). Et pourtant, les statistiques sont claires, ce sont les henta�s qui nous rapportent le plus de visiteurs, les �pisodes sont beaucoup plus t�l�charg�s en ddl et ce sont les torrents henta�s qui sont le plus seed�s. Au niveau popularit�, nous savons que ce sont de loins les henta�s qui l'emportent, mais nous savons aussi que ce sont les fans de henta�s qui sont le moins verbeux. Tant pis pour eux ! Nous prendrons en compte les r�sultats de ce sondage.<br /><br />
Encore merci � tous d'avoir vot� ! `A bient�t pour les sorties tr�s prochaines de Kujian et Isshi ni H shiyo !");
			$news->setCommentId(218);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Sondage : Quelles sont vos s�ries pr�f�r�es ?");
			$news->setTimestamp(strtotime("26 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/newssondage.png\" /><br />
Vous commencez � nous conna�tre !<br />
Du moins, si vous lisez nos news un peu longues.<br />
Je r�sume.<br />
L'�tat d'esprit Z�ro est simple : Nous ne faisons pas du fansub pour nous, pour faire plaisir � nous-m�mes, mais pour promouvoir l'animation japonaise, permettre l'accessibilit� aus francophones aux s�ries qu'ils ne peuvent pas trouver (en France), et nous respectons le fameux slogan \"Par des fans, pour des fans.\".<br />
Oui, mes amis !<br />
Ce que l'�quipe Z�ro fait, du simple sous-titrage � la recherche de qualit�, c'est pour vous tous, et uniquement pour vous que nous le faisons.<br />
C'est la raison pour laquelle j'ai d�cid� aujourd'hui d'effectuer un sondage pour r�pondre au mieux � vos attentes.<br />
<b>Quelles sont vos s�ries pr�f�r�es, parmi celles que nous sous-titrons ? Lesquelles attendez-vous avec le plus d'impatience ?</b><br />
Pour y r�pondre, c'est tr�s simple, il suffit de poster un commentaire avec soit une liste, soit un argumentaire, bref, ce que vous voulez pour d�fendre vos s�ries pr�f�r�es.<br />
� l'issue de ce sondage, nous vous annoncerons les r�sultats, et les s�ries les plus attendues seront mises en priorit� dans notre travail pour toujours mieux vous satisfaire.<br />
J'�sp�re que vous serez nombreux � nous donner votre avis !<br /><br />
<a href=\"index.php?page=series/hitohira\"><img src=\"images/series/hitohira.png\" border=\"0\" alt=\"Hitohira\"></a><br /><br />
<a href=\"index.php?page=series/kanamemo\"><img src=\"images/series/kanamemo.png\" border=\"0\" alt=\"Kanamemo\"></a><br /><br />
<a href=\"index.php?page=series/kannagi\"><img src=\"images/series/kannagi.png\" border=\"0\" alt=\"Kannagi\"></a><br /><br />
<a href=\"index.php?page=series/kimikiss\"><img src=\"images/series/kimikiss.png\" border=\"0\" alt=\"Kimikiss pure rouge\"></a><br /><br />
<a href=\"index.php?page=series/kissxsis\"><img src=\"images/series/kissxsis.png\" border=\"0\" alt=\"KissXsis\"></a><br /><br />
<a href=\"index.php?page=series/kujibiki\"><img src=\"images/series/kujibiki.png\" border=\"0\" alt=\"Kujibiki Unbalance 2\"></a><br /><br />
<a href=\"index.php?page=series/potemayo\"><img src=\"images/series/potemayo.png\" border=\"0\" alt=\"Potemayo\"></a><br /><br />");
			$news->setCommentId(217);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Tracker torrent, le retour ! Recrutement Seeders");
			$news->setTimestamp(strtotime("09 February 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/seedep.png\" /><br />
.Apr�s une tr�s longue pause, notre tracker torrent est de retour ! Tarf a repris les r�nes et nos �pisodes ne devraient pas tarder � �tre disponibles en torrent.<br />
Oui, mais pour qu'il marche jusqu'au bout, il nous faut du monde qui soit l�, pr�t � sacrifier un peu de leur connexion pour partager avec Tarf nos �pisodes.<br />
Si vous �tes interess� pour devenir seeder de la team, cliquez sur le lien de postulat ci-dessous. Nous �sp�rons que vous serez nombreux � nous aider !
<br /><br />
<span>~ <a href=\"http://forum.zerofansub.net/posting.php?mode=newtopic&f=21\" target=\"_blank\">Postuler en tant que seeder</a> ~</span>");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Konshinkai fansub, la r�union des amateurs de fansub fran�ais");
			$news->setTimestamp(strtotime("17 January 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Le rendez-vous est fix� pour la prochaine convention : Paris manga.<br />
C'est donc le 6 F�vrier.<br />
On reste sur le m�me restaurant qu'� Konshinkai 1, un petit restaurant Jap' tr�s sympathique et pas tr�s cher pr�s de Charle de Gaulle �toile. Toutes les infos pour s'y rendre sont sur le site partie \"Rendez-vous\".<br />
<br />
Pour ceux qui ne conaissent pas encore Konshinkai, c'est une r�union de fansubbeurs et d'amateurs de fansub fran�ais (comme vous �tes s�rement puisque vous �tes chez Z�ro fansub ;))<br />
<br />
Dans un petit restaurant, nous discutons sans prise de t�te et chacun expose ses points de vue dans une ambiance sympathique.<br />
<br />
Nous en sommes aujourd'hui � la troisi�me �dition et les membres de Z�ro risquent fort d'y �tre, donc si vous voulez les rencontrer mais aussi discuter ensemble de nos passions communes, nous vous attendons avec impatience !<br />
<br />
Venez nombreux, parlez en autours de vous !<br />
<br />
<a href=\"http://konshinkai.c.la\" target=\"_blank\">Le site officiel Konshinkai fansub, pour plus d'informations
<br /><br />
<img src=\"archives/konshinkai/images/interface/konshinkai3.png\" width=\"600\" alt=\"Konshinkai fansub\" /></a>");
			$news->setCommentId(183);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux Anniversaire ! Z�ro a deux ans.");
			$news->setTimestamp(strtotime("18 December 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/anniv1.jpg\" /><br />
Aujourd'hui est un grand jour pour Z�ro et pour la db0 company ! Cela fait maintenant exactement deux ans que le groupe Z�ro existe, donc j'en profite pour faire un petit r�sum� de ces deux ann�es riches en evennements.<br />
db0 cr�er le site \"Z�ro\", qui vient de la derni�re lettre de son pseudo le 18 d�cembre 2007. Au d�part, c'est un �ni�me site de liens MU et torrent pour t�l�charger des animes. db0 rencontre ensuite Genesis et se met au fansub. Elle cr�ait ensuite avec et gr�ce � cette �quipe une nouvelle �quipe de fansub qui prend la place de l'ancien site Z�ro mais garde le design. Les d�buts de Z�ro sont difficiles. La formation fansub de db0 s'est en grande partie faite par Klick et le reste de l'�quipe Genesis. D'autres membres ont ensuite rejoint l'�quipe, dont praia qui deviendra par la suite le co-administrateur de l'�quipe. Ryocu rejoint ensuite l'�quipe en nous hebergant le site et les �pisode en DirectDownload. L'�quipe s'agrandit petit � petit, devient amie avec Maboroshi, Kanaii, Animekami, Moe, Kyoutsu, Sky, ect. db0 et Ryocu reprennent ensemble la db0 company et tout ses nombreux sites, dont Anime-ultime et Stream-Anime. Ces sites nous co�tent actuellement dans les environs de 300 � 350� par mois, et nous avons toujours beaucoup de mal � les financer. Un quatri�me \"gros\" site devait ouvrir cet �t� mais est sans cesse repouss� pour des raisons financi�res. Stream-Anime a malheuresement ferm� ses portes recemment, emportant avec lui ses plus de 5000 vid�os en streaming haute qualit�. Malgr� ce triste bilan financier, Z�ro et la db0 company se porte plut�t bien. Z�ro a d�sormais une �quipe soud�e et motiv�e qui ne risque pas de s'arr�ter de si t�t. Pour plus d'informations sur la db0 company, un historique complet et d�taill� est disponible sur le forum.<br /><br />
Concernant les �vennements � venir, un nouveau design de Z�ro fansub et d'Anime-Ultime sont pr�vu. La db0 company devrait bient�t ouvrir un site et regrouper les communaut�s.<br /><br />
Pour finir, je tenais � remercier toutes les personnes qui nous soutiennent. Financierement bien s�r, mais aussi avec les commentaires qui nous vont droit au coeur et qui nous donnent envie d'avancer. Sachez que Z�ro a un �tat d'esprit qui s'�loigne beaucoup de celui des autres �quipes de fansub. Nous ne faisons pas du fansub parce qu'on prend notre pied en sous-titrant des animes (oh oui encore plus de time plan, j'aime �a !), mais parce que nous sommes avant tout fans de l'animation japonaise et c'est avant tout pour vous, les fans comme nous, que nous sous-titrons des animes. C'est la raison pour laquelle nous sommes toujours � l'�coute de nos fans ador�s, que nous tenons �norm�ment compte des commentaires sur le site qui nous guident sur ce que nous fansubbons en priorit�. C'est gr�ce � vous et surtout pour vous que nous existons. Votre soutien nous fait vivre et nous donne envie d'aller plus loin. Merci.<br /><br />
Et Bon Anniversaire Z�ro ! <br /><br />
<img src=\"images/news/anniv2.jpg\" />");
			$news->setCommentId(155);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement Editeur ASS/AE");
			$news->setTimestamp(strtotime("10 December 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/edit.jpg\" /><br />
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
R�aliser l'edit du titre de d�but le plus ressemblant possible au titre de la s�rie, � la diff�rence qu'il ne doit pas y avoir �crit le titre de la s�rie mais \"Z�ro fansub\" ou \"Z�ro fansub pr�sente\". Ass ou After Effect. Vous pouvez nous envoyer : soit un script, soit une vid�o encod�e ET un script. Au choix :<br />
- <a href=\"http://zerofansub.net/ddl/RAW_Kanamemo/%5bZero-Raws%5d%20Kanamemo%20-%2001%20RAW%20(TVO%201280x720%20x264%20AAC%20Chap).mp4\">Titre Kanamemo, � 01:03:60</a> (mouvant obligatoire)<br />
- <a href=\"http://zerofansub.net/ddl/RAW_KissXsis/Kiss%d7sis_OAD_2_Raw_Travail_ED_non_bobb%e9.avi\">Titre KissXsis, � 02:03:12</a> (immobile ou mouvant)<br />
J'�sp�re que vous serez nombreux � r�pondre � notre demande ! Merci � tous de suivre nos �pisodes.");
			$news->setCommentId(154);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Konshinkai ~ fansub");
			$news->setTimestamp(strtotime("26 October 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/afkonsh.png\" /><br />
Bonjour cher ami gentils amis leechers.<br /><br />
\"Encore une nouvelle �quipe de fansub ?\", vous allez vous dire, avec le titre de la news. Eh bien non ! \"Konshinkai\" signifie en japonais \"R�union amicale\", et c'est exactement le but de notre projet.<br /><br />
Notre but est de r�unir toutes les �quipes de fansub fran�aise � une petite soir�e pour discuter amicalement de notre passion commune : le fansub. Nous invitons donc toutes les personnes travaillant dans le fansub, et pas seulement les chefs d'�quipes, toutes les personnes ayant d�j� travaill� dans le fansub et les plus grands fans de cette activit� � se r�unir autours d'une table dans un restaurant japonais pour se rencontrer, �changer, discuter et s'amuser, sans aucune prise de t�te.<br /><br />
L'�vennement se d�roule � Paris, et comme nous savons bien que tout le monde n'est pas apte � se d�placer librement sur Paris, nous avons d�cid� de le faire pendant les conventions parisiennes sur la jap'anime, puisque c'est � ce moment l� que nos chers otaku ont tendance � se d�placer, se d�gageant difficilement de leur chaise ador�e bien cal�e devant leurs ordinateurs (je caricature, hein).<br /><br />
Nous comptons renouveler l'�venemment pour plusieurs occasions, �sperant ainsi rencontrer un maximum de personnes ! Ne soyez pas timides, rejoignez-nous, venez nombreux !<br /><br />
<b>Prochaine rencontre : Samedi 30 octobre � 20h, pendant la Chibi Japan Expo. Venez nombreux ! Plus d'informations sur notre site : <a href=\"http://konshinkai.c.la/\" targt=\"_blank\">Konshinkai Site Officiel</a></p></b><br /><br />
L'�quipe Konshinkai fansub, r�unions amicales entre fansubbeurs fran�ais.<br /><br />
P.S. : Nous vous serions tr�s reconaissant de faire part de cette �venement autours de vous, aux membres de votre �quipes, aux autres �quipes, � vos amis fansubbeurs et pourquoi pas faire une news sur votre site officiel.");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Paris Manga");
			$news->setTimestamp(strtotime("01 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/parismanga.jpg\" /><br />
Paris Manga est une petite convention se d�roulant � Paris (logique) le 12 et 13 septembre � l'espace Champerret. Z�ro y sera ! Donc n'h�sitez pas � venir nous voir, on est gentil et on mord pas ^^ Et comme d'habitude, je participe aux concours cosplay. Venez m'encourager samedi � partir de 14h sur sc�ne en cosplay individuel et dimanche � partir de 14h en cosplay groupe avec un costume sp�cial Z�ro fansub !<br /><br />
L'�quipe de fansub n'est actuellement pas en mesure de vous proposer des sorties d'animes : L'encodeur Lepims est en vacances et dieu (db0) d�m�nage.");
			$news->setCommentId(119);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement traducteur Mermaid Melody");
			$news->setTimestamp(strtotime("10 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/mermaid.jpg\"><br />
Nous avons �t� tr�s �tonn� du succ�s qu'a eu notre demande de recrutement pour l'anime Hitohira et nous avons aujourd'hui un nouveau traducteur pour cette s�rie : whatake.<br />
Aurons-nous autant de succ�s pour ce deuxi�me appel...? Je l'esp�re ! Mais avant cela, je vous vous expliquer la situation. Nous avons commenc� la s�rie Mermaid Melody Pichi Pichi Pitch en Vistfr et MnF l'a fait en Vostfr. Nous avons d�cid� d'abbandonner la s�rie en Vistfr et de la continuer en Vostfr. 13 �pisodes de cette s�rie sont sortis. Vous pouvez t�l�charger l'�pisode 01 ici : <a href=\"http://www.megaupload.com/?d=ZZQNU3UZ\" target=\"_blank\">Episode 01</a><br />
Nous recherchons quelqu'un de motiv� qui aime les animes magical girl pour continuer cette s�rie avec nous ! N'h�sitez pas � postuler ! Merci de votre aide.");
			$news->setCommentId(111);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Infos T�l�chargements");
			$news->setTimestamp(strtotime("09 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("Depuis un incident de surcharge de t�l�chargements ayant fait planter toute la db0 company (anime-ultime, Z�ro et tout les autres), nous avons d�cid� de limiter les t�l�chargements. Nous avons annonc� �a clairement, et pourtant, nous continuons � recevoir dans le topics des liens morts qui ne le sont pas. Donc aujourd'hui, j'insiste : Si vous �tes d�j� en train de t�l�charger un �pisode sur notre site, vous ne pourrez en telecharger un autre qu'apr�s le premier t�l�chargement termin� ! Si le message suivant arrive :<br /><br />
\"Service Temporarily Unavailable<br />
The server is temporarily unable to service your request due to maintenance downtime or capacity problems. Please try again later.\"<br /><br />
Ne vous affolez pas : Attendez la fin de votre premier t�l�chargement. Il peut arriver que ce message arrive alors que vous n'�tes pas en train de t�l�charger. Dans ce cas, attendez 30 secondes puis actualisez la page � nouveau, et ceci jusqu'� ce que votre t�l�chargement se lance. Merci � tous !");
			$news->setCommentId(110);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("[IRL] Japan Expo 2009");
			$news->setTimestamp(strtotime("15 June 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/japan10.jpg\" style=\"float:right;\" border=\"0\">
Vous y allez ? �a tombe bien, nous aussi !<br />
Pour s'y rencontrer, signalez-vous dans le topic d�di� � cette convention sur le forum : <a href=\"http://forum.zerofansub.net/t196-japan-expo-2009.htm\" target=\"_blank\">http://forum.zerofansub.net/t196-japan-expo-2009.htm</a><br />
Il y aura comme toujours la petite bande de chez Kanaii en plus de celle de chez Z�ro.<br />
J'ai pr�vu plusieurs concours cosplay :<br />
Cosplay Standart Jeudi 13h (Kodomo no Jikan)<br />
WCS Pr�-selection Samedi 13h concours 15h (Surprise)<br />
Pen of Chaos Dimanche 13h (Dokuro-chan)<br />
Venez m'y voir ^^ Si vous voulez :)<br /><br />
Rappel : La team est toujours en pause jusqu'� Juillet !");
			$news->setCommentId(96);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("[IRL] Epitanime 2009");
			$news->setTimestamp(strtotime("06 June 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("C'�tait du 29 au 31 mai, et c'�tait un tr�s grand evenement. Bien malheureux sont ceux qui l'ont rat�s ! Et qui, surtout, on rat� db-chan ! Oui, il faut le dire, le plus important � Epitanime, c'�tait elle :P Il fallait �tre l�, car j'avais pr�vu pour tout les membres de la team Z�ro mais aussi toutes les personnes qui viennent r�gulierement chez Z�ro une petite surprise.<br />
Ce week-end, j'ai donc crois� Sazaju (notre traducteur), Ryocu, Guguganmo et des tas de copains-cosplayeurs dont je ne vous citerait pas le nom puisque vous ne les conna�trez s�rement pas.<br /><br />
J'ai particip� au concours cosplay le samedi 30 mai � 12 heure. � vous de deviner quel personnage j'incarnait :<br />
<img src=\"images/news/cosplay01.jpg\" /><br />
Vous ne trouvez pas ? Oui, je sais, c'est tr�s difficile. Pour voir qui c'�tait, lisez la suite.<br /><br />
<a href=\"index.php?page=dossier/epitanime2009\"><img src=\"images/interface/lirelasuite.png\" alt=\"[ Lire la suite . . . ]\" border=\"0\" /></a>");
			$news->setCommentId(79);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Epitanime 2009");
			$news->setTimestamp(strtotime("19 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"http://www.epita.fr/img/design/logos/epitanime-logo.jpg\" style=\"float:right;\" border=\"0\"><br />
Date � retenir : 29-30-31 mai 2009 ! Durant ses trois jours se d�rouleront un �venement de taille : la 17�me �dition de l'Epitanime ! Une des meilleures conventions et des plus vieilles. Plus pratique pour les parisiens puisqu'elle se d�roule au Kremlin-Bic�tre (Porte d'Italie). Si vous avez la possibilit� de vous y rendre, faites-le ! db-chan vous y attendra ^^");
			$news->setCommentId(525);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("forum.zerofansub.net");
			$news->setTimestamp(strtotime("18 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/favoris.png\" style=\"float:right;\" border=\"0\"><br />
Le forum change d'adresse : <br />
<a href=\"http://forum.zerofansub.net/\" target=\"_blank\"><span style=\"font-size: 22px;\">http://forum.zerofansub.net</span></a><br />
Faites comme Mario, mettez � jour vos favoris !");
			$news->setCommentId(588);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("The legend of Melba : Tonight Princess + Newsletter");
			$news->setTimestamp(strtotime("17 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<a href=\"http://melbaland.free.fr/\" target=\"_blank\"><img src=\"http://img8.imageshack.us/img8/6162/bannirepapyo.jpg\" border=\"0\"></a><br />
Papy Al, QC de la petite �quipe, a sorti hier soir le premier �pisode de sa saga mp3. <a href=\"http://melbaland.free.fr/\" target=\"_blank\">Pour l'�couter, c'est par ici !</a><br /><br />
Vous ne le savez peut-�tre pas, mais Z�ro envoie � chaque news une newsletter ! Pour la recevoir, il suffit de s'inscrire sur le forum. Il n'est pas demand� de participer ni quoi que ce soit.");
			$news->setCommentId(73);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("[Zero] Merci !");
			$news->setTimestamp(strtotime("11 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img src=\"images/news/merci.jpg\" border=\"0\"><br />Toute l'�quipe Z�ro fansub et toute la db0 company (Anime-Ultime, Stream-Anime, Z�ro, Kojikan, ect) tient � remercier chalereusement les personnes suivantes pour leurs r�ponses � notre appel � l'aide :<br />
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
//Ryocu et db0");
			$news->setCommentId(71);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("C'est la crise !");
			$news->setTimestamp(strtotime("01 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("C'est la crise pour tout le monde, et m�me pour nous. Nous n'arrivons plus � payer nos serveurs... On ajoute des publicit�s et on vous sollicite pour des dons, mais rien ne s'am�liore. Depuis le d�but de Z�ro, et sur tout les sites de la db0 company, nous n'avons re�u que 14 � de dons et 75 � de publicit�s. Sachant qu'il nous a fallut environ 80 � (en tout depuis que Z�ro existe) pour l'association humanitaire que Z�ro soutient et que nos serveurs de la db0 company co�te environ 250 � /mois, le calcul n'est pas long, nous sommes dans le n�gatif. Et pauvres petits �tudiants que nous sommes, � d�couvert tout les mois... C'est un appel � l'aide que je lance aujourd'hui, � ceux de Z�ro, de la db0 company, � ceux qui aiment les animes que nous sous-titrons et qui respectent notre travail. Par avance, merci.");
			$news->setCommentId(66);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("[Zero]");
			$news->setTimestamp(strtotime("10 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/3.1.png\" border=\"0\">
Du changement sur le site ?<br /><br />
Je ne vois vraiment pas de quoi vous parlez !");
			$news->setCommentId(57);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! Licenci�");
			$news->setTimestamp(strtotime("01 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/licence.jpg\" border=\"0\">
Triste nouvelle que je vous apporte aujourd'hui ! La premi�re licence d'une de nos s�rie. Avec beaucoup de regrets, nous retirons donc tout les liens de t�l�chargement de la s�rie Toradora!...");
			$news->setCommentId(54);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Toradora! Fin - L'impact !");
			$news->setTimestamp(strtotime("30 March 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/ryoc.jpg\" border=\"0\">
Bonjour.<br />
Je suis l'administrateur du site <a href=\"http://www.anime-ultime.net/part/Site-93\" target=\"_blank\">Anime-ultime</a>, et l'admin sys de Z�ro fansub ainsi que toute la <a href=\"http://db0.fr\" target=\"_blank\">db0 company</a>. Je tiens � remercier les personnes qui se sont crues malignes en employant des acc�l�rateurs de t�l�chargement. Gr�ce � ces personnes, plusieurs sites ont �t� inaccessibles. En utilisant ce genre de logiciel, vous bloquez les acc�s aux visiteurs des sites web et vous entra�nez un ralentissement g�n�ral des t�l�chargements (au lieu des les acc�lerer, vous faites en sorte que les disques durs ne puissent plus tenir la cadence et font ralentir tout le monde). Par cons�quent, vous ne pouvez d�sormais plus t�l�charger qu'un seul et unique fichier � la fois sur Zerofansub.net et je demande � toutes les personnes qui utilisent des acc�lerateurs de t�l�chargement d'arr�ter de vous servir de ce genre de logiciel qui plombent les serveurs inutilement en plus d'avoir l'effet contraire � celui d�sir�.<br />
Cette limite n'est pas tr�s s�v�re, soyez compr�hensifs. Profitez bien de la fin de Toradora!, m�me si pour cela, vous devez attendre un peu. Nos releases sont aussi disponibles en torrent.");
			$news->setCommentId(54);
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement Karamaker et Gestion tracker BT");
			$news->setTimestamp(strtotime("24 February 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setMessage("<img style=\"float : right; display:block; margin-right: 20px;\" src=\"images/news/guilde.jpg\" border=\"0\">
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
</p>");
			$news->setDisplayInNormalMode(true);
			$news->setDisplayInHentaiMode(true);
			$news->setTeamNews(true);
			$news->setPartnerNews(false);
			News::$allNews[] = $news;
		}
		
		foreach(News::$allNews as $news) {
			if ($news->isPartnerNews() === null) {
				throw new Exception($news->getCommentId());
			}
		}
		
		return News::$allNews;
	}
	
	public static function timestampSorter(News $a, News $b) {
		$ta = $a->getTimestamp();
		$tb = $b->getTimestamp();
		return $ta === $tb ? 0 : ($ta === null ? -1 : ($tb === null ? 1 : ($ta < $tb ? 1 : ($ta > $tb ? -1 : 0))));
	}
	
	public static function getAllReleasingNews() {
		$array = array();
		foreach(News::getAllNews() as $news) {
			if ($news->isReleasing()) {
				$array[] = $news;
			}
		}
		return $array;
	}
	
	public static function getAllTeamNews() {
		$array = array();
		foreach(News::getAllNews() as $news) {
			if ($news->isTeamNews()) {
				$array[] = $news;
			}
		}
		return $array;
	}
	
	public static function getAllPartnerNews() {
		$array = array();
		foreach(News::getAllNews() as $news) {
			if ($news->isPartnerNews()) {
				$array[] = $news;
			}
		}
		return $array;
	}
}
?>
