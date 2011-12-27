<?php
/*
	A news is a block of text giving actual information. A news contains the text
	to display and some added data (image, author, date of writing, ...).
*/
// TODO separate in a News (data) + NewsComponent (HTML)
class News extends SimpleBlockComponent {
	private $title = null;
	private $date = null;
	private $timestamp = null;
	private $author = null;
	private $message = null;
	private $commentAccess = null;
	private $twitterUrl = null;
	private $releasesOut = array();
	private $licensesOut = array();
	
	public function __construct() {
		$this->setClass("news");
		
		$this->title = new Title(null, 2);
		$this->title->setClass("title");
		$this->addComponent($this->title);
		
		$subtitle = new Title(null, 4);
		$subtitle->setClass("subtitle");
		$this->date = new SimpleTextComponent();
		$subtitle->addComponent($this->date);
		$subtitle->addComponent(" par ");
		$this->author = new SimpleTextComponent();
		$subtitle->addComponent($this->author);
		$this->addComponent($subtitle);
		
		$this->message = new SimpleTextComponent();
		$this->message->setClass("message");
		$this->message->setContentPinned(true);
		$this->addComponent($this->message);
		
		$this->commentAccess = new SimpleTextComponent();
		$this->commentAccess->setClass("comment");
		$this->addComponent($this->commentAccess);

		$this->addComponent("~ ");
		$this->twitterUrl = new NewWindowLink(null, "Partager sur <img src='images/autre/logo_twitter.png' border='0' alt='twitter' />");
		$this->twitterUrl->setOnClick("javascript:pageTracker._trackPageview ('/outbound/twitter.com');");
		$this->addComponent($this->twitterUrl);
		$this->addComponent(" ou ");
		$this->addComponent("<a name='fb_share' type='button' share_url='http://zerofansub.net'></a>");
		$this->addComponent("<script src='http://static.ak.fbcdn.net/connect.php/js/FB.Share' type='text/javascript'></script>");
		$this->addComponent(" ~");
	}
	
	public function setTitle($title) {
		$this->title->setContent($title);
		$this->setTwitterUrl("http://twitter.com/home?status=[Zero] ".$title);
	}
	
	public function getTitle() {
		return $this->title->getCurrentContent();
	}
	
	public function getDate() {
		return $this->date->getCurrentContent();
	}
	
	public function setTimestamp($timestamp) {
		$this->timestamp = intval($timestamp);
		$this->date->setContent(strftime("%d/%m/%Y", $timestamp));
	}
	
	public function getTimestamp() {
		return $this->timestamp;
	}
	
	public function setAuthor($author) {
		if ($author instanceof TeamMember) {
			$author = $author->getPseudo();
		}
		$this->author->setContent($author);
	}
	
	public function getAuthor() {
		return $this->author->getContent();
	}
	
	public function setMessage($message) {
		$this->message->clear();
		$this->message->addComponent($message);
	}
	
	public function getMessage() {
		$components = $this->message->getComponents();
		return $components[0];
	}
	
	private $commentClass = null;
	public function setCommentID($id) {
		if ($this->commentClass === null) {
			$this->commentClass = $this->commentAccess->getClass();
		}
		
		if ($id !== null) {
			$this->commentAccess->setClass($this->commentClass);
			$this->commentAccess->addComponent("~ ");
			$this->commentAccess->addComponent(new NewWindowLink("http://commentaires.zerofansub.net/t$id.htm", "Commentaires"));
			$this->commentAccess->addComponent(" - ");
			$this->commentAccess->addComponent(new NewWindowLink("http://commentaires.zerofansub.net/posting.php?mode=reply&t=$id", "Ajouter un commentaire"));
			$this->commentAccess->addComponent(" ~");
		}
		else {
			
			$this->commentAccess->setClass("hidden");
		}
	}
	
	public function setCommentUrl($url) {
		$this->commentUrl->setUrl($url);
	}
	
	public function getCommentUrl() {
		return $this->commentUrl->getUrl();
	}
	
	public function setCommentAddUrl($url) {
		$this->commentAddUrl->setUrl($url);
	}
	
	public function getCommentAddUrl() {
		return $this->commentAddUrl->getUrl();
	}
	
	public function setTwitterUrl($url) {
		$this->twitterUrl->setUrl($url);
	}
	
	public function getTwitterUrl() {
		return $this->twitterUrl->getUrl();
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
			$news->setTitle("Issho ni H Shiyo 6");
			//$news->setTimestamp(strtotime("27 December 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(278);
			$news->addReleasing(Release::getRelease('hshiyo', 'ep6'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new AutoFloatImage("images/news/hshiyo6.png", "J'ado~re les concombres !"));
			$newsMessage->addLine("Et voil� un nouvel opus (ou deux nouveaux obus, au choix) de notre H favori. Enfin je dis favori mais comme c'est moi qui fait la news, je vais avant tout donner mon avis {^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine("Vous avez aim� le 4 (pas le pr�c�dent, celui d'avant, que j'avais d�truit dans ma news) ? Si oui alors r�jouissez-vous, celui-ci est du m�me acabit. Ceux qui sont du m�me avis que moi, en revanche, passez votre chemin. Pour faire court : on se fait une vache � lait � la campagne. Les grosses mamelles sont de la partie, m�me si ce ne sont pas elles qui donneront le 'lait' de l'�pisode.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Recrutement pour le site");
			$news->setTimestamp(strtotime("24 December 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(276);
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Salut tout le monde ! {^_^}");
			$newsMessage->addLine();
			$newsMessage->addLine("Voil� un gros mois sans news, vous devez donc vous dire <i>enfin une sortie !</i> pas vrai ? Ben d�sol� de casser l'ambiance, mais non pas pour tout de suite {'^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/angry.jpg", "Quoi ?"));
			$newsMessage->addLine("<small>Non pas taper ! {'>_<}</small>");
			$newsMessage->addLine();
			$newsMessage->addLine("Comme certains d'entre-vous le savent, je suis en train de raffiner le site, et cela prends du temps. Si pas mal de choses ont �t� d�velopp�es pour l'instant, encore reste-t-il � les appliquer au site, et c'est �a qui est long. C'est donc pour �a que je viens � vous {^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine("Je cherche quelqu'un qui s'y conna�t un minimum en HTML/CSS/PHP. Inutile d'�tre un expert, je demande juste d'avoir d�j� utilis� un peu ces langages, dire qu'on se comprenne si je parles de style, de balise et de parcourir des tableaux. Si vous avez d�j� programm� en objet (PHP, Java, C++ ou autre) c'est un plus. Notez qu'il faut aussi savoir <i>retoucher</i> des images. Ce que j'entends par l� est simplement savoir redimensionner, couper, coller, rassembler des images en une seule, ... le b.a.-ba donc. Si des comp�tences plus avanc�es sont n�cessaires, je peux vous les apprendre avec Gimp. De m�me si vous avez des questions sur le code, c'est tout � votre honneur {^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine("Je tiens quand m�me � poser une contrainte : je cherche quelqu'un de motiv�, qui aime coder. Je ne veux pas dire par l� que c'est difficile, mais je veux quelqu'un sur qui je puisse compter sur la longueur. Il ne faut pas �tre disponible tout le temps, mais je ne veux pas voir quelqu'un qui apr�s une semaine me dise <i>j'ai plus le temps</i>. Ce sont toutes des petites t�ches qui peuvent se faire un peu n'importe quand, donc c'est tr�s flexible, mais il faut les faire.");
			$newsMessage->addLine();
			$newsMessage->addLine("Si vous �tes int�ress�s, passez dans la section recrutement (lien dans le menu de gauche).");
			$newsMessage->addLine();
			$newsMessage->addLine("NB : vous voyez, j'ai m�me pas le temps de vous faire une news d�cente en cette veille de No�l, pour vous dire comme j'ai besoin de quelqu'un {;_;}.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Mitsudomoe 7+8");
			$news->setTimestamp(strtotime("14 November 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(275);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep7'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep8'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Ah, j'ai des nouvelles pour vous. Vous allez rire {^_^}. Il se trouve que �a fait un moment qu'on a fini les Mitsudomoe 7 & 8... et j'ai oubli� de les sortir ! C'est marrant, hein ? {^o^}");
			$newsMessage->addLine();
			$newsMessage->addLine("Non ? Vous trouvez pas ? {�.�}?");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/aMort.png", "� mort !"));
			$newsMessage->addLine();
			$newsMessage->addComponent("OK, OK, j'arr�te {\">_<}. S'il vous reste des cailloux de la derni�re fois, vous pouvez me les jeter. Allez, pour me faire pardonner je vous file un acc�s rapide : ");
			$newsMessage->addLine(new ReleaseLink('mitsudomoe', array('ep7', 'ep8'), "Mitsudomoe 7 & 8"));
			$newsMessage->addLine();
			$newsMessage->addLine("J'en profite pour vous rappeler que le site est en cours de raffinage, et comme j'en ai fait beaucoup derni�rement (le lien rapide en est un ajout) il est possible que certains bogues me soient pass�s sous le nez. Aussi n'h�sitez pas � me crier dessus si vous en trouvez {'^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine("Et si vous voulez nous aider (ou vous essayer au fansub), on cherche des traducteurs Anglais-Francais (ou Japonais pour ceux qui savent {^_^}) !");
			$newsMessage->addLine();
			$newsMessage->addLine("Sur ceux, bon visionnage {^_^}.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Besoin de timeurs !");
			$news->setTimestamp(strtotime("11 October 2011"));
			$news->setAuthor(TeamMember::getMember(5));
			$news->setCommentId(273);
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Allez on encha�ne les news, la motivation est l�... Mais elle va peut-�tre pas durer...");
			$newsMessage->addLine();
			$newsMessage->addLine("<span style='color:red;font-size:2em;'>On a besoin de votre aide !</span>");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/urgent.gif", "Au secours !"));
			$newsMessage->addLine();
			$newsMessage->addLine("On embauche des timeurs ! On n'en a pas assez et du coup chacun essaye de faire pour avoir un time � peu pr�s correcte... Mais ce n'est pas la m�me chose quand quelqu'un s'y met � plein temps. C'est quelque chose qui nous ralentis beaucoup car, m�me si ce n'est pas difficile, �a demande du temps pour faire quelque chose de bien (en tout cas pour suivre notre charte qualit� {^_^}). On a les outils, les connaissances, il ne manque plus que les personnes motiv�es !");
			$newsMessage->addLine();
			$newsMessage->addLine("Si vous �tes interess�s, les candidatures sont ouvertes (cliquez sur <b>Recrutement</b> dans le menu � gauche) ! Si vous �tes soucieux du d�tail au point d'en faire chier vos amis, c'est un plus ! Oui on est des vrai SM � la Z�ro {>.<}.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kodomo no Jikan - Du neuf et du moins neuf");
			$news->setTimestamp(strtotime("10 October 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(272);
			$news->addReleasing(Release::getRelease('kodomooav', 'oav'));
			$news->addReleasing(Release::getRelease('kodomofilm', 'film'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/pedobear.jpg", "Pedobear"));
			$newsMessage->addLine();
			$newsMessage->addLine("Sortie de la v3 de Kodomo no Jikan OAD.");
			$newsMessage->addLine();
			$newsMessage->addLine("Et le film Kodomo no Jikan, qu'on n'a pas abandonn�, non, non... M�me si l'envie �tait l�.");
			$newsMessage->addLine("<small>Sazaju: Hein ? Quoi !? {'O_O}</small>");
			$newsMessage->addLine();
			$newsMessage->addLine("Bon matage et � bient�t pour la suite de Mitsudomoe.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Nouvelles sorties, nouveaux projets, nouveaux bugs...");
			$news->setTimestamp(strtotime("26 September 2011"));
			$news->setAuthor(TeamMember::getMember(5));
			$news->setCommentId(271);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep4'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep5'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep6'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Bon... par o� commencer... Dur dur, surtout que le moins r�jouissant c'est pour ma pomme {'^_^}. En plus j'ai pas d'image pour vous, vous allez morfler. Alors allons-y gaiement !");
			$newsMessage->addLine(); // TODO replace double lines by CSS
			$newsMessage->addLine("Tout d'abord, sachez que le site est actuellement en cours de raffinage. Autrement dit, une r�vision compl�te du code est en cours. Par cons�quent, si vous voyez des petites modifications par rapport � avant, c'est normal, mais dans l'ensemble il ne devrait pas y avoir de changement notable sur le site. Quel int�r�t que j'en parle vous me direz... Tout simplement parce qu'il est possible que certaines pages boguent (ou bug, comme vous voulez), et si jamais vous en trouvez une, le mieux c'est de me le faire savoir directement par mail : <a href='mailto:sazaju@gmail.com'>sazaju@gmail.com</a>. Le raffinage �tant en cours, il est possible que des pages qui fonctionnent maintenant ne fonctionnent pas plus tard, aussi ne soyez pas surpris. Je fais mon possible pour que �a n'arrive pas, mais si j'en loupe merci de m'aider � les rep�rer {^_^}.");
			$newsMessage->addLine();
			$newsMessage->addLine("Voil�, les mauvaises nouvelles c'est fini ! Passons aux r�joussances : 3 nouveaux �pisodes de Mitsudomoe sont termin�s (4 � 6). Si vous ne les voyez pas sur la page de la s�rie... c'est encore de ma faute (lapidez-moi si vous voulez {;_;}). Si au contraire vous les voyez, alors profitez-en, ruez-vous dessus, parce que depuis le temps qu'on n'a pas fait de news vous devez avoir faim, non ? {^_�}");
			$newsMessage->addLine();
			$newsMessage->addLine("Allez, mangez doucement, �a se d�guste les animes (pur�e j'ai la dalle maintenant {'>.<}). Cela dit, si vous en voulez encore, on a un bon dessert tout droit sorti du restau : Working!! fait d�sormais partie de nos futurs projets ! Certains doivent se dire qu'il y ont d�j� go�t� ailleurs... Mais non ! Parce que vous aurez droit aux deux saisons {^o^}v. Tout le monde le sait (surtout dans le Sud de la France), quand on a bien mang�, une sieste s'impose. Vous pourrez donc rejoindre la fille aux ondes dans son futon : Denpa Onna to Seishun Otoko vient aussi allonger la liste de nos projets ! On dit m�me qu'un projet myst�re se faufile entre les membres de l'�quipe...");
			$newsMessage->addLine();
			$newsMessage->addLine("Pour terminer, un petit mot sur notre charte qualit�. Nous avons d�cid� de ne plus sortir de releases issues d'une version TV, mais de ne faire que des Blu-Ray. Bien entendu, on fera toujours attention aux petites connexions : nos encodeurs travaillent d'arrache pied pour vous fournir la meilleure vid�o dans le plus petit fichier. J'esp�re donc que vous appr�cierez la qualit� de nos futurs �pisodes {^_^} (et que vous n'aurez pas trop de pages bogu�es {'-.-}).");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Hitohira - S�rie compl�te");
			$news->setTimestamp(strtotime("14 August 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(270);
			$news->addReleasing(Project::getProject('hitohira'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/hito1.jpg", "Hitohira"));
			$newsMessage->addLine();
			$newsMessage->addLine("Sortie de Hitohira, la s�rie compl�te, 12 �pisodes d'un coup !");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/hito2.jpg", "Hitohira"));
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe 03");
			$news->setTimestamp(strtotime("05 August 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(269);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Mitsudomoe 03 chez Z%C3%A9ro fansub !");
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep3'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/episodes/mitsudomoe3.jpg", "Mitsudomoe"));
			$newsMessage->addLine();
			$newsMessage->addLine("Sortie de l'�pisode 03 de Mitsudomoe.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Toradora! SOS - S�rie compl�te 4 OAV");
			$news->setTimestamp(strtotime("26 July 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(268);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Toradora! SOS chez Zero fansub !");
			$news->addReleasing(Project::getProject('toradorasos'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/series/toradorasos.jpg", "Toradora SOS"));
			$newsMessage->addLine();
			$newsMessage->addLine("4 mini OAV d�lirants sur la bouffe, avec les personnages en taille r�duite.");
			$newsMessage->addLine("C'est de la superproduction ^_^");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko");
			$news->setTimestamp(strtotime("23 July 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(267);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Isshoni Training Ofuro chez Zero fansub !");
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/bath.jpg", "Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko"));
			$newsMessage->addLine();
			$newsMessage->addLine("Nous avons appris qu'Ankama va diffuser &agrave; partir de la rentr�e de septembre 2011 :");
			$newsMessage->addLine("Baccano, Kannagi et Tetsuwan Birdy Decode. Tous les liens on donc �t� retir�s.");
			$newsMessage->addLine("On vous invite &agrave; cesser la diffusion de nos liens et &agrave; aller regarder la s�rie sur leur site.");
			$newsMessage->addLine();
			$newsMessage->addLine("Sorties d'Isshoni Training Ofuro : Bathtime with Hinako & Hiyoko");
			$newsMessage->addLine();
			$newsMessage->addLine("3e volet des \"isshoni\", on apprend comment les Japonaises prennent leur bain, tr�s int�ressant...");
			$newsMessage->addLine("Avec en bonus, une petite s�ance de stretching...");
			$newsMessage->addLine();
			$newsMessage->addLine("Je ne sais pas s'il y aura une suite, mais si oui, je devine un peu le genre ^_^");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Recrutement traducteur");
			$news->setTimestamp(strtotime("04 July 2011"));
			$news->setAuthor(TeamMember::getMember(8));
			$news->setCommentId(266);
			$news->setTwitterUrl("http://twitter.com/home?status=Zero recherche un traducteur");
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/m1.jpg", "Mitsudomoe"));
			$newsMessage->addLine();
			$newsMessage->addLine("Nous avons urgemment besoin d'un trad pour Mitsudomoe !!");
			$newsMessage->addLine("S'il vous pla&icirc;t, piti� xD");
			$newsMessage->addLine("Notre edit s'impatiente et ne peux continuer la s�rie, alors aidez-nous ^_^");
			$newsMessage->addLine("C'est pas souvent qu'on demande du renfort, mais l&agrave;, c'est devenu indispensable...");
			$newsMessage->addLine("Nous avons perdu un trad r�cemment, il ne nous en reste plus qu'un... et comble de malheur,  il n'a pas accroch� &agrave; la s�rie, mais je le remercie pour avoir quand m&ecirc;me traduit deux �pisodes pour nous d�panner.");
			$newsMessage->addComponent("Des petits cours sont dispos ici : ");
			$link = new Link("http://forum.zerofansub.net/f221-Cours-br.htm", "Lien");
			$link->openNewWindow(true);
			$newsMessage->addComponent($link);
			$newsMessage->addLine(".");
			$newsMessage->addLine();
			$newsMessage->addComponent("Pour postuler, faites une candidatures &agrave; l'�cole : ");
			$link = new Link("http://ecole.zerofansub.net/?page=postuler", "Lien");
			$link->openNewWindow(true);
			$newsMessage->addComponent($link);
			$newsMessage->addLine(".");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/m2.jpg", "Mitsudomoe"));
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kannagi - S�rie compl�te");
			$news->setTimestamp(strtotime("19 June 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(264);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Kannagi serie complete chez Zero fansub !");
			$news->addReleasing(Project::getProject('kannagi'));
			$newsMessage = new SimpleTextComponent();
			$link = new Link("http://zerofansub.net/galerie/gal/Zero_fansub/Images/Kannagi/%5BZero%5DKannagi_Image63.jpg", new Image("images/news/kannagi.jpg", "Kannagi"));
			$link->openNewWindow(true);
			$newsMessage->addLine($link);
			$newsMessage->addLine();
			$newsMessage->addLine("Bonjour les amis !");
			$newsMessage->addLine("La s�rie Kannagi est termin�e !");
			$newsMessage->addLine("J&#039;�sp�re qu&#039;elle vous plaira.");
			$newsMessage->addLine("N&#039;h�sitez pas &agrave; nous dire ce que vous en pensez dans les commentaires. C&#039;est en apprenant de ses erreurs qu&#039;on avance, apr�s tout ;)");
			$newsMessage->addLine();
			$newsMessage->addLine("P.S.: Les karaok�s sont nuls. D�sol�e !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe 01 + 02");
			$news->setTimestamp(strtotime("27 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(263);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Mitsudomoe 01 + 02 chez Zero fansub !");
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep1'));
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep2'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/mitsu0102.jpg", "Mitsudomoe"));
			$newsMessage->addLine();
			$newsMessage->addLine("Bonjour les amis !");
			$newsMessage->addLine("Apr�s des mois d'attente, les premiers �pisodes de Mitsudomoe sont enfin disponibles !");
			$newsMessage->addLine("Quelques petits changements dans notre fa&ccedil;on de faire habituelle, on attend vos retours avec impatience ;)");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Tayutama ~ Kiss on my Deity ~ Pure my Heart ~ - S�rie compl�te 6 OAV");
			$news->setTimestamp(strtotime("15 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(262);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Tayutama Kiss on my Deity Pure my Heart serie complete chez Zero fansub !");
			$news->addReleasing(Project::getProject('tayutamapure'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/tayutamapure.jpg", "Tayutama ~ Kiss on my Deity ~ Pure my Heart ~"));
			$newsMessage->addLine();
			$newsMessage->addLine("On continue dans les s�ries compl�tes avec cette fois-ci la petite s�rie de 6 OAV qui fait suite &agrave; la s�rie Tayutama ~ Kiss on my Deity : les 'Pure my Heart'. Ils sont assez courts mais plut&ocirc;t dr&ocirc;le alors amusez-vous bien !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Potemayo OAV - S�rie compl�te");
			$news->setTimestamp(strtotime("11 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(261);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Potemayo serie complete chez Zero fansub !");
			$news->addReleasing(Project::getProject('potemayooav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/series/potemayooav.jpg", "Potemayo"));
			$newsMessage->addLine();
			$newsMessage->addLine("Petit bonjour !");
			$newsMessage->addLine("Dans la suite de la s�rie Potemayo, voici la petite s�rie d'OAV. Au nombre de 6, ils sont disponibles en versions basses qialit� uniquement puisqu'ils ne sont pas sortis dans un autre format. D�sol�e !");
			$newsMessage->addLine("Amusez-vous bien !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Potemayo - S�rie compl�te enti�rement refaite");
			$news->setTimestamp(strtotime("08 May 2011"));
			$news->setAuthor(TeamMember::getMember(1));
			$news->setCommentId(261);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Potemayo serie complete chez Zero fansub !");
			$news->addReleasing(Project::getProject('potemayo'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/series/potemayo.jpg", "Potemayo"));
			$newsMessage->addLine();
			$newsMessage->addLine("Bonjour le monde !");
			$newsMessage->addLine();
			$newsMessage->addLine("Tout comme pour Kujibiki Unbalance 2, nous avons enti�rement refait la s�rie Potemayo. Pour ceux qui suivaient la s�rie, seule les versions avi en petit format �taient disponible puisque c&#039;etait le format qu&#039;utilisait Kirei no Tsubasa, l&#039;�quipe qui nous a l�gu� le projet.");
			$newsMessage->addLine();
			$newsMessage->addLine("Du coup, la s�rie compl�te a �t� r�envod�e et on en a profit� pour ajouter quelques am�liorations.");
			$newsMessage->addLine();
			$newsMessage->addLine("Rendez-vous page 'Projet' sur le site pour t�l�charger les 12 �pisodes !");
			$newsMessage->addLine();
			$newsMessage->addLine("Et n&#039;oubliez pas : si vous avez une remarque, une question ou quoi que ce soit &agrave; nous dire, utilisez le syst�me de commentaires ! Nous vous r�pondrons avec plaisir.");
			$newsMessage->addLine();
			$newsMessage->addLine("Bons �pisodes, &agrave; tr�s bient&ocirc;t pour les 6 OAV suppl�mentaires Potemayo... et un petit bonjour &agrave; toi aussi !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kujibiki Unbalance 2 - S�rie compl�te enti�rement refaite");
			$news->setTimestamp(strtotime("02 May 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(260);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Kujibiki Unbalance 2 serie complete chez Zero Fansub !");
			$news->addReleasing(Project::getProject('kujibiki'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new AutoFloatImage("images/news/kujiend.jpg", "Kujibiki Unbalance 2"));
			$newsMessage->addLine("La s&eacute;rie Kujibiki Unbalance 2 a enti&eacute;rement &eacute;t&eacute; refaite !");
			$newsMessage->addLine("Les polices illisibles ont &eacute;t&eacute; chang&eacute;es, les panneaux stylis&eacute;s ont &eacute;t&eacute; refait, la traduction a &eacute;t&eacute; revue, bref, une jolie s&eacute;rie compl&egrave;te vous attend !");
			$newsMessage->addLine();
			$newsMessage->addLine("Pour t&eacute;l&eacute;charger les &eacute;pisodes, c'est comme d'habitude :");
			$newsMessage->addLine("- Page projet, liens DDL,");
			$newsMessage->addLine("- Sur notre tracker Torrent (restez en seed !)");
			$newsMessage->addLine("- Sur le XDCC de notre chan irc (profitez-en pour nous dire bonjour :D)");
			$newsMessage->addLine();
			$newsMessage->addLine("Petite info importante :");
			$newsMessage->addLine("Cette s&eacute;rie est comp&eacute;tement ind&eacute;pendante, n'a rien a voir avec la premi&eacute;re saison de Kujibiki Unbalance ni avec la s&eacute;rie Genshiken et il n'est pas n&eacute;cessaire d'avoir vu celles-ci pour appr&eacute;cier cette petite s&eacute;rie.");
			$newsMessage->addLine();
			$newsMessage->addLine("Si vous avez aim&eacute; la s&eacute;rie, si vous avez des remarques &agrave; nous faire ou autre, n'h&eacute;sitez pas &agrave; nous en faire part ! (Commentaires, Forum, Mail, IRC, ...)");
			$newsMessage->addLine();
			$newsMessage->addLine("&Agrave; tr&eacute;s bient&ocirc;t pour Potemayo !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kodomo no Natsu Jikan");
			$news->setTimestamp(strtotime("11 April 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(259);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Kodomo no Natsu Jikan chez Zero fansub !");
			$news->addReleasing(Release::getRelease('kodomonatsu', 'oav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/kodomonatsu1.jpg", "Kujibiki Unbalance 2"));
			$newsMessage->addLine("Rin, Kuro et Mimi sont de retour dans un OAV Sp&eacute;cial de Kodomo no Jikan : Kodomo no Natsu Jikan ! Elles sont toutes les trois absulument adorables dans leurs maillots de bains d'&eacute;t&eacute;, en vacances avec Aoki et Houin.");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/kodomonatsu2.jpg", "Kujibiki Unbalance 2"));
			$newsMessage->addLine(new Image("images/news/kodomonatsu3.jpg", "Kujibiki Unbalance 2"));
			$newsMessage->addLine(new Image("images/news/kodomonatsu4.jpg", "Kujibiki Unbalance 2"));
			$newsMessage->addLine(new Image("images/news/kodomonatsu5.jpg", "Kujibiki Unbalance 2"));
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Licence de L&#039;entrainement avec Hinako + Sortie de Akina To Onsen et Faisons l'amour ensemble &eacute;pisode 05");
			$news->setTimestamp(strtotime("08 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(252);
			$news->setTwitterUrl("http://twitter.com/home?status=Deux hentai : Akina To Onsen et Issho ni H shiyo chez Zero fansub !");
			$news->addReleasing(Release::getRelease('akinahshiyo', 'oav'));
			$news->addReleasing(Release::getRelease('hshiyo', 'ep5'));
			$news->addLicensing(Release::getRelease('training', 'oav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new AutoFloatImage("images/news/issho5.jpg", "Akina To Onsen De H Shiyo"));
			$newsMessage->addLine();
			$newsMessage->addLine("Dans la suite de notre reprise tant attendue, on ne rel&#226;che pas le rythme ! Apr&#232;s la sortie d'un genre classique chez Z&#233;ro, on poursuit avec l'une de nos sp&#233;cialit&#233;s : <i>Faisons l'amour ensemble</i> revient en force avec un nouvel &#233;pisode (de quoi combler les d&#233;&#231;us du 4e opus) et un &#233;pisode bonus !");
			$newsMessage->addLine();
			$newsMessage->addLine("Tout d'abord, ce 5e &#233;pisode nous sort le grand jeu : la petite s&#339;ur est dans la place ! Apr&#232;s plusieurs ann&#233;es sans nouvelles de son grand fr&#232;re, voil&#224; qu'elle a bien grandi et d&#233;cide donc de taper l'incruste. Voil&#224; une bonne occasion de faire le m&#233;nage (les filles sont dou&#233;es pour &#231;a {^.^}~). &#192; la suite de quoi une bonne douche s'impose... Et si on la prenait ensemble comme au bon vieux temps, <i>oniichan</i> ?");
			$newsMessage->addLine();
			$newsMessage->addLine("Pour ceux qui auraient encore des r&#233;serves (faut dire qu'on vous a donn&#233; le temps pour {^_^}), un &#233;pisode bonus aux sources chaudes vous attend ! Akina, cette jeune demoiselle du premier &#233;pisode, revient nous saluer avec son charme g&#233;n&#233;reux et son c&#244;t&#233; ivre toujours aussi mignon. Vous en d&#233;gusterez bien un morceau apr&#232;s le bain, non ?");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/series/akinahshiyo.jpg", "Akina To Onsen De H Shiyo"));
			$newsMessage->addLine();
			$newsMessage->addLine("db0 dit : Et pour finir, une nouvelle assez inattendue : La licence de L'entra&#238;nement avec Hinako chez Kaze. On vous tiendra au courant quand le DVD sortira.");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/training.gif", "Isshoni Training"));
			$newsMessage->addLine();
			$newsMessage->addLine("En parlant de Kaze, j'ai re&#231;u hier par la poste le Blu-ray de Canaan chez Kaze. Vous avez aim&#233; la s&#233;rie ? Faites comme moi, achetez-le !");
			$newsMessage->addLine();
			$newsMessage->addLine(new Image("images/news/canaanli.jpg", "DVD canaan buy kaze"));
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Issho Ni H Shiyo OAV 04 - Fin !");
			$news->setTimestamp(strtotime("13 July 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(237);
			$news->setTwitterUrl("http://twitter.com/home?status=Sortie de Issho Ni H Shiyo OAV 04 - Fin ! http://zerofansub.net/");
			$news->addReleasing(Release::getRelease('hshiyo', 'ep4'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new AutoFloatImage("images/news/hshiyonew.png", "Issho ni H Shiyo oav  4 fin de la serie interdit aux moins de 18 ans."));
			$newsMessage->addLine();
			$newsMessage->addLine("Déception intense ! Après de jolis épisodes, c'est avec regret que je vous annonce la sortie de ce quatrième et dernier opus, qui retombe dans de banals stéréotypes H sans une once d'originalité ni de qualité graphique : gros seins surréalistes, personnages prévisibles à souhaits, et comble du comble un final à la \"je jouis mais faisons pour que ça n'en ait pas l'air\" ! Alors que les épisodes précédents nous offraient de somptueux ralentis et des mouvements de corps langoureux pour un plaisir savouré jusqu'à la dernière goutte, ce dernier épisode nous marquera (hélas) par sa simplicité grotesque et son manque de plaisir évident.");
			$newsMessage->addLine();
			$newsMessage->addLine("Mais réjouissez-vous ! La série étant finie, nous n'aurons plus l'occasion d'assister à une autre erreur mettant en doute la qualité de cette dernière : les plus pointilleux pourront sauvagement se dessécher sur les précédents épisodes sans jamais voir le dernier, alors que ceux qui auront pitié de notre travail pourront gaspiller leur bande passante à télécharger le torchon qui sert de final à cette série qui ne le mérite pourtant pas.");
			$newsMessage->addLine();
			$newsMessage->addLine("Merci à tous de nous avoir suivi sur cette série, et je vous souhaite tout le plaisir du monde à sauvegarder votre temps en revisionnant un des épisodes précédents plutôt que celui-ci {^_^}.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("KissXsis 03");
			$news->setTimestamp(strtotime("24 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(233);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep3'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/kissxsis3news.jpg", "KissXsis kiss x sis DVD Blu-Ray Jaquette"));
			$newsMessage->addLine("On peut dire qu'il s'est fait attendre cet épisode...");
			$newsMessage->addLine("Mais le voilà enfin, et c'est tout ce qui compte.");
			$newsMessage->addLine("Vous devez vous demander ce qu'il advient de notre annonce de sortie une semaine/un épisode pour kissxsis.");
			$newsMessage->addLine("Vous avez remarqué que c'est un echec. Pourquoi ? Les épisodes s'avèrent bien plus longs à réaliser que prévu si on souhaite continuer à vous fournir la meilleure qualité possible. De plus, j'étais dans ma période de fin d'année scolaire et j'ai dû mettre de côté nos chères soeurs jumelles pour être sûre de passer en année supérieure...!");
			$newsMessage->addLine();
			$newsMessage->addLine("Une nouvelle qui ne vous fera peut-être pas plaisir, mais qui j'éspère ne vous découragera pas de mater les soeurettes un peu plus tard : Nous avons l'intention d'attendre la sortie des Blu-Ray des autres épisodes avant de continuer KissXsis. La qualité des vidéos sera meilleure, il y aura moins de censure, plus de détails, bref, plus de plaisir !<br />
Le premier Blu-Ray contenant les 3 premiers épisodes vient tout juste de sortir et nous sortirons bientôt des nouvelles versions de ces trois premiers. Croyez-moi, ça en vaut la peine. Vous ne me croyiez pas ? <a href='http://www.sankakucomplex.com/2010/06/24/kissxsis-erotic-climax-dvd-ero-upgrades-highly-salacious/' target='_blank'>Petit lien</a>.");
			$newsMessage->addLine();
			$newsMessage->addLine("Et pour ne pas parler que de KissXsis, sachez qu'une petite surprise que je vous ai personnellement concocté devrait bientôt sortir...<br />
En ce qui concerne les autres projets, nous devrions nous concentrer sur Kujian en attendant les Blu-Ray de KissXsis et boucler certains vieux projets comme Sketchbook, Kodomo no Jikan (le film) ou Tayutama.");
			$newsMessage->addLine();
			$newsMessage->addLine("En ce qui concerne l'école du fansub, elle va très bien et le nombre d'élève augmente chaque jour, les exercices et les cours aussi ! Si vous êtes intéréssés, vous savez où nous trouver : sur le forum Zéro fansub.");
			$newsMessage->addLine();
			$newsMessage->addLine("Bonne chance à ceux qui sont en examens, et que ceux qui sont en vacances en profite bien. Moi, je suis en vacances :p");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Mitsudomoe, Bande-Annonce");
			$news->setTimestamp(strtotime("15 June 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(231);
			$news->addReleasing(Release::getRelease('mitsudomoe', 'ep0'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine('<object width="550" height="309"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=12592506&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=12592506&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="550" height="309"></embed></object>');
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kiss X Sis TV 02");
			$news->setTimestamp(strtotime("04 May 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(228);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep2'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/kissxsis2.jpg"));
			$newsMessage->addLine("Ako et Riko ne laisseront pas Keita rater ses examens ! Ako d�cident donc de donner des cours particulier � Keita.");
			$newsMessage->addLine("Ils y resteront tr�s sages et se contenteront d'apprendre sagement l'anglais, l'histoire et les maths. C'est tout.");
			$newsMessage->addLine("Vous vous attendiez � autre chose, peut-�tre ?");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Kiss X Sis TV 01");
			$news->setTimestamp(strtotime("17 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(225);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep1'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new Image("images/news/newskissxsis1.jpg"));
			$newsMessage->addLine("Yo !");
			$newsMessage->addLine("Ako et Riko sont ENFIN de retour, cette fois-ci dans une s�rie compl�te.");
			$newsMessage->addLine("Il y aura donc plus de sc�nario, mais toujours autant de ecchi.");
			$newsMessage->addLine("C'est bien une suite des OAV, mais il n'est pas n�c�ssaire des les avoir vus pour suivre la s�rie.");
			$newsMessage->addLine("J'ai essay� de faire des jolis karaok�s, alors chantez !! (Et envoyez les vid�os)");
			$newsMessage->addLine("� tr�s vite pour l'�pisode 2.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("S'endormir avec Hinako (Issho ni Sleeping) OAV");
			$news->setTimestamp(strtotime("08 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(209);
			$news->addReleasing(Release::getRelease('sleeping', 'oav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine(new AutoFloatImage("images/news/pcover1.gif"));
			$newsMessage->addLine("Salut toi, c'est Hinako !<br />
Tu m'as tellement manquer depuis notre entra�nement, tout les deux...<br />
Tu te souviens ? Flexions, extensions ! Une, deux, une deux !<br />
Gr�ce � toi, j'ai perdu du poids, et toi aussi, non ?<br />
Tu sais, cette nuit, je dors toute seule, chez moi, et �a me rend triste...<br />
Quoi ? C'est vrai ? Tu veux bien dormir avec moi !?<br />
Oh merci ! Je savais que je pouvais compter sur toi.<br />
Alors, � tout � l'heure, quand tu auras t�l�charger l'�pisode ;)");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("KissXsis 02");
			$news->setTimestamp(strtotime("06 December 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(153);
			$news->addReleasing(Release::getRelease('kissxsisoav', 'ep2'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/kiss2.png' /><br />
Ah, elles nous font bien attendre, les deux jolies jumelles... Des mois pour sortir les OAV ! Mais au final, �a en vaut la peine, donc on ne peut pas leur en vouloir. C'est bient�t No�l, donc pour l'occasion, elles ont sortis des cosplays tr�s mignons des \"soeurs de No�l\". Elles sont de plus en plus ecchi avec leur fr�re. Finira-t-il par craquer !? La premi�re version sort ce soir, les autres versions de plus haute qualit� sortieront dans la nuit et demain. J'�sp�re que cet OAV vous plaira ! Une s�rie est annonc�e en plus des OAV. Info ou Intox ? Dans tout les cas, Z�ro sera de la partie, donc suivez aussi la s�rie avec nous !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;

			$news = new News();
			$news->setTitle("Canaan 13 ~ Fin !");
			$news->setTimestamp(strtotime("06 October 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(138);
			$news->addReleasing(Release::getRelease('canaan', 'ep13'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/canaanfin.png\" /><br />
Ainsi se termine Canaan.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 12 + Piscine + Partenariats + Maboroshi + Kobato");
			$news->setTimestamp(strtotime("04 October 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(137);
			$news->addReleasing(Release::getRelease('canaan', 'ep12'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/piscine.jpg' style='float: left;' />
Tout d'abord, la sortie du <b>12e �pisode de Canaan</b>. On change compl�tement de d�cor par rapport aux pr�c�dents �pisodes. Cet �pisode est centr� sur la relation entre Canaan et Alphard, ainsi que les pouvoirs de Canaan.<br /><br />
Ensuite, <b>db0 va a la piscine !</b> (Elle a mis son joli maillot de bain, et tout, comme sur l'image) Elle sera donc <b>absente du 5 au 26 octobre inclus</b>. En attendant, l'�quipe Z�ro va essayer de continuer � faire des sorties quand m�me, et c'est ryocu qui se chargera de faire les news.<br /><br />
Puis, deux nouveaux partenaires : <b>Gokuraku-no-fansub</b> et <b>Tanjou-fansub</b>.<br /><br />
Enfin, une bonne nouvelle. Si certains n'�taient pas au courant, j'annonce : <b>Maboroshi no fansub a r�ouvert ses portes</b>. L'incident de fermeture �tait d� � une mauvaise entente entre la personne qui h�bergeait le site et le reste de l'�quipe. J'ai repris les r�nes ! C'est maintenant moi qui g�re leur site. Du coup, il n'y a aucun risque de fermeture ou de mauvais entente :). Ils prennent un nouveau d�part, et ont d�cid� de ne pas reprendre leurs anciens projets, sauf Hakushoku to Yousei d�e � la forte demande.<br /><br />
Pour finir, <b>Kobato</b>, dans la liste de nos projets depuis juin, ne se fera finalement pas. Kaze nous a devanc� et a achet� la licence.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 11");
			$news->setTimestamp(strtotime("30 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(136);
			$news->addReleasing(Release::getRelease('canaan', 'ep11'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/canaan11.jpg'/><br />
Chose promise, chose due. Et en plus, on a m�me le droit � un peu de ecchi dans cet �pisode ! Avec la tenue sexy de Liang Qi, on peut pas dire le contraire... Et un peu de necrophilie aussi. Ouais, c'est tout de suite moins sexy. (Enfin, chacun son truc, hein) Sankaku Complex en a parl�. Cet �pisode est un peu triste, comme le pr�cedent, mais un peu plus violent aussi.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 10");
			$news->setTimestamp(strtotime("30 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(135);
			$news->addReleasing(Release::getRelease('canaan', 'ep10'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/canaan10.jpg' /><br />
Vous en r�viez ? Les fans l'ont dessin�... Est-ce que c'est ce qui va se passer dans la suite de l'anime ? �a semble bien parti... Regardez vite l'�pisode 10 pour le savoir ! Et comme on a trop envie de savoir la suite � la fin de cet �pisode, je vous promets qu'il ne tardera pas.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 09 + Canaan Cosplays");
			$news->setTimestamp(strtotime("25 September 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(130);
			$news->addReleasing(Release::getRelease('canaan', 'ep9'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/canaancos.png' /><br />
Je comptais sortir tout les �pisodes en m�me temps, mais comme les autres prennent plus de temps que pr�vu, on va pas vous faire attendre plus longtemps et on vous propose d�s maintenant l'�pisode 09, pr�t depuis longtemps. Comme vous pouvez le constater, l'�quipe est tr�s occup�e en ce moment, donc entre deux irl, on taffe un peu fansub, mais �a reste pas grand chose.<br />
Je profite de cette news pour vous poster quelques photos de mon cosplay Canaan. Si vous voulez en savoir plus sur ce cosplay et mes autres, rendez-vous sur mon site perso cosplay : <a href='http://db0.dbcosplay.fr' target='_blank'>http://db0.dbcosplay.fr</a> (et abonnez-vous � la newsletter !)<br />
<a href='http://www.cosplay.com/photo/2268921/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268921.jpg'></a> <a href='http://www.cosplay.com/photo/2268922/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268922.jpg'></a> <a href='http://www.cosplay.com/photo/2268923/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2268923.jpg'></a> <a href='http://www.cosplay.com/photo/2274553/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274553.jpg'></a> <a href='http://www.cosplay.com/photo/2274515/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274515.jpg'></a> <a href='http://www.cosplay.com/photo/2274516/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274516.jpg'></a> <a href='http://www.cosplay.com/photo/2274517/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274517.jpg'></a> <a href='http://www.cosplay.com/photo/2274518/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274518.jpg'></a> <a href='http://www.cosplay.com/photo/2274519/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274519.jpg'></a> <a href='http://www.cosplay.com/photo/2274520/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274520.jpg'></a> <a href='http://www.cosplay.com/photo/2274521/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274521.jpg'></a> <a href='http://www.cosplay.com/photo/2274522/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274522.jpg'></a> <a href='http://www.cosplay.com/photo/2274523/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274523.jpg'></a> <a href='http://www.cosplay.com/photo/2274531/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274531.jpg'></a> <a href='http://www.cosplay.com/photo/2274532/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274532.jpg'></a> <a href='http://www.cosplay.com/photo/2274533/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274533.jpg'></a> <a href='http://www.cosplay.com/photo/2274536/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274536.jpg'></a> <a href='http://www.cosplay.com/photo/2274537/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274537.jpg'></a> <a href='http://www.cosplay.com/photo/2274538/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274538.jpg'></a> <a href='http://www.cosplay.com/photo/2274540/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274540.jpg'></a> <a href='http://www.cosplay.com/photo/2274541/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274541.jpg'></a> <a href='http://www.cosplay.com/photo/2274542/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274542.jpg'></a> <a href='http://www.cosplay.com/photo/2274543/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274543.jpg'></a> <a href='http://www.cosplay.com/photo/2274544/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274544.jpg'></a> <a href='http://www.cosplay.com/photo/2274554/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274554.jpg'></a> <a href='http://www.cosplay.com/photo/2274555/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274555.jpg'></a> <a href='http://www.cosplay.com/photo/2274556/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274556.jpg'></a> <a href='http://www.cosplay.com/photo/2274557/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274557.jpg'></a> <a href='http://www.cosplay.com/photo/2274560/' target='_blank'><img src='http://images.cosplay.com/thumbs/22/2274560.jpg'></a>");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 08");
			$news->setTimestamp(strtotime("26 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(116);
			$news->addReleasing(Release::getRelease('canaan', 'ep8'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/canaan8.png' style='float: right;' />
Avec un peu de retard cette semaine, la suite de la tr�pidante histoire de Canaan, une fille pas comme les autres.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 06");
			$news->setTimestamp(strtotime("11 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(112);
			$news->addReleasing(Release::getRelease('canaan', 'ep6'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/can6.jpg'><br />
Comme � son habitude, le petit �pisode de Canaan de la semaine fait sa sortie. Et comme pr�vu, nous n'avons aucune r�ponse pour le recrutement traducteur T___T pourtant j'aime bien, moi, Mermaid Melody. C'est mignon.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 04 + 05 + Rythme Toradora!");
			$news->setTimestamp(strtotime("06 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(109);
			$news->addReleasing(Release::getRelease('canaan', 'ep4'));
			$news->addReleasing(Release::getRelease('canaan', 'ep5'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src='images/news/can45.jpg' alt='' /><br />
Des bunny girls, des blondasses, et tout �a qui se fait des c�lins ! Si c'est pas mignon, tout �a ! Non, pas tant que �a, si on remet l'image dans le contexte. Je vous laisse d�couvrir tout �a dans la double sortie du jour. Double sortie, pourquoi ? Bah justement. J'ai bien envie de faire des news longues ses derniers temps, donc je vais vous expliquer ce que j'appelle \"le rythme Toradora!\".<br />
Pour ceux qui nous ont connus � l'�poque Toradora!, � l'\"apog�e\" de la carri�re de Z�ro, vous vous souvenez sans doute du rythme sp�ctaculaire auquel les sorties s'encha�naient. C'�tait de l'ordre de une sortie tout les deux jours, voir tout les jours ! Pour vous, qui attendez sagement derri�re vos �crans, c'est tout b�n�f'. Mais ce que vous ne savez pas, c'est que �a travaille, derri�re la machine. Nous ne sommes pas une �quipe de Speedsub, alors comment r�aliser un tel exploit sans perdre de la qualit� des �pisodes ? Non, non, nous ne savons toujours pas ralentir le temps. Quel est notre secret ? Tout d'abord, sachez qu'il faut minimum 20 heures de boulot pour sortir un �pisode chez Z�ro (traduction-adaptation-correction-edition-time-v�rification finale) encodage non compris. Et que g�n�ralement, nous r�partissons ses heures sur des semaines. Pour suivre le rythme Toradora!, c'est simple : Etaler ses 20 heures minimum (je dis bien minimum parce qu'en fait c'est beaucoup plus long) sur une seule journ�e. C'est-�-dire sacrifier une journ�e + une nuit. Pour Toradora!, suivre ce rythme n'�tait pas trop dur puisque nous �tions en coproduction, ce qui nous permettait de faire des pauses de temps en temps dans ces looongues journ�es de fansub. Mais nous avons d�cid� de reprendre ce rythme, pour montrer � nos amis leechers que nous n'avons pas vieilli ! C'est pourquoi nous avons choisi un anime qui nous tient � coeur, � Ryocu et moi-m�me : Canaan. Ici, nous ne sommes pas en coproduction, mais comme nous sommes en vacances, nous pouvons nous permettre de sacrifier deux journ�es par �pisode de Canaan. Oui, deux jours, car il me faut bien faire des pauses, et comme je m'occupe de tout sauf de la v�rification finale et que je suis humaine, je ne peux pas me permettre de taffer 24h d'affil�e sans faiblir un chouilla.<br />
Bref, je raconte pas tout �a pour me la p�ter, mais juste pour vous �xpliquer ce que repr�sente un rythme accel�r� pour une �quipe de bon sub et pas de speedsub. Je raconte �a aussi parce que j'ai �t� d��u par des r�actions de personnes qui se sont dit rapide = mauvais sub. Je vous prouve ici que nous travaillons dur pour vous !!<br />
Et l�, je finirai sur une question qui vous turlupine depuis tout � l'heure : Comment se fait-il que vous ne nous sortiez ses �pisodes que maintenant ? La r�ponse est simple : J'avais pas internet dans le trou paum� o� je suis pour mes vacances :p<br />
Et histoire de craner un peu : Ryocu et moi passons de superbes vacances en bord de mer dans une grande maison avec piscine dont nous profitons entre deux Canaan.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Erreur Canaan 03");
			$news->setTimestamp(strtotime("24 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(106);
			$news->addReleasing(Release::getRelease('canaan', 'ep3'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Sous la pr�cipitation (train � prendre), j'ai envoy� le mauvais ass � lepims (notre encodeur) pour l'�pisode 03 de Canaan, c'est-�-dire celui dont les fautes n'ont pas �t� corrig�s, c'est-�-dire ma traduction telle quelle... Du coup, il a �t� r�encoder, et la nouvelle version est t�l�chargeable � la place de l'ancienne. Toutes mes excuses !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 03 + Recrutement trad Hitohira");
			$news->setTimestamp(strtotime("22 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(106);
			$news->addReleasing(Release::getRelease('canaan', 'ep3'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/hitocry.png\" style=\"float: right;\" />
Je lance cette bouteille � la mer en esp�rant que ce message parvienne aux oreilles d�une �me charitable� Nous recherchons d�sesp�r�ment une personne pour reprendre l�une de nos s�ries, j�ai nomm� Hitohira. Nous n'avons rien � offrir, � part notre gratitude. Nous ne nous attendons pas � avoir beaucoup de r�ponses, voire rien du tout... Si par bonheur, vous �tes int�ress�, n�h�sitez pas � passer sur le forum, nous vous accueillerons sur un tapis rouge orn� de fleurs xD<br /><br /><br /><br /><br /><br />
<img src=\"images/news/canaan-3.jpg\" border=\"0\" /><br />
Encore du ecchi dans la s�rie Canaan ! Mais pas que �a, bien s�r. L'�pisode 3 est disponible, amusez-vous bien~");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Canaan 02");
			$news->setTimestamp(strtotime("19 July 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(103);
			$news->addReleasing(Release::getRelease('canaan', 'ep2'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/oppaicanaan.png\" border=\"0\"><br />
Bah alors ? Z�ro nous fait Canaan ? Mais Z�ro, c'est une team de l'ecchi, non ? Bah en voil� un peu d'ecchi, dans cette s�rie de brutes ^^ Alors, heureux ? Oui, tr�s heureux. Snif. Tout �a pour dire que y'a l'�pisode 02 pr�t � �tre mat�. Et vous savez quoi, les p'tits loulous ? Dans l'�pisode 01, on comprenait pas toujours ce qu'il se passait. Dans l'�pisode 02, on comprends ce qui s'est pass� dans l'�pisode 1 ! Hein ? �a se passe toujours comme �a dans les s�ries s�rieuses...? Ah, naruhodo...");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("KissXsis 01");
			$news->setTimestamp(strtotime("28 May 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(77);
			$news->addReleasing(Release::getRelease('kissxsis', 'ep1'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kissx1.jpg\" style=\"float:right;\" border=\"0\">
On vous l'avait promis, le v'l� ! On a mis un peu de temps parce qu'on l'a traduit � moiti� du Japonais, et forc�ment, �a prend plus de temps. J'esp�re qu'il vous plaira autant que le premier, parce qu'il d�passe les limites de l'ecchi !<br />
Demain : Epitanime ! J'veux tous vous y voir !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("L'entra�nement avec Hinako (Isshoni Training)");
			$news->setTimestamp(strtotime("28 April 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(65);
			$news->addReleasing(Release::getRelease('training', 'oav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/hinako.jpg\" border=\"0\"><br />L'�t� arrive � grand pas. C'est donc la saison des r�gimes ! Et qui dit r�gime, dit bonne alimentation mais aussi entra�nement, musculation ! Mais comment arriver � faire bouger nos chers Otakus de leurs chaises...? Hinako a trouv� la solution ! Un entra�nement compos� de pompes, d'abdos et de flexions on ne peut plus ECCHI ECCHI ! Lancez-vous donc dans cette aventure un peu perverse et rejoignez Hinako dans sa s�ance de musculation. Et vous le faites, hein ? Hinako vous regarde ;)");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux No�l ! - OAV Kiss X Sis");
			$news->setTimestamp(strtotime("24 December 2008"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(24);
			$news->addReleasing(Release::getRelease('kissxsisoav', 'ep2'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/noel.jpg\" border=\"0\" /><br>Toute l'�quipe Z�ro vous souhaite � tous un joyeux no�l, un bon r�veillon, une bonne dinde, de bons chocolats, de beaux cadeaux et tout ce qui va avec.<br>Nos cadeaux pour vous :<br>- Une galerie d'images de No�l (dans les bonus)<br>- L'OAV de Kiss x sis !<br>Dans la liste de nos projets depuis cet �t�, initialement pr�vu en septembre... Au final, il est sorti le 22 d�cembre, et nous vous l'avons traduit comme cadeau de No�l. C'est entre-autre gr�ce � cet OAV que nous avons fait la conaissance de la <a href=\"http://kanaii.com/\" target=\"_blank\" class=\"postlink\">Kanaii</a>.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko");
			$news->setTimestamp(strtotime("23 July 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(267);
			$news->addReleasing(Release::getRelease('bath', 'oav'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/bath.jpg\" alt=\"Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko\" />
  <br /><br />
  Nous avons appris qu'Ankama va diffuser &agrave; partir de la rentr&eacute;e de septembre 2011 :<br />
  Baccano, Kannagi et Tetsuwan Birdy Decode. Tous les liens on donc &eacute;t&eacute; retir&eacute;s.<br />
  On vous invite &agrave; cesser la diffusion de nos liens et &agrave; aller regarder la s&eacute;rie sur leur site.<br />
  <br />
  Sorties d'Isshoni Training Ofuro : Bathtime with Hinako & Hiyoko<br />
  <br />
  3e volet des \"isshoni\", on apprend comment les Japonaises prennent leur bain, tr&egrave;s int&eacute;ressant...<br />
  Avec en bonus, une petite s&eacute;ance de stretching...<br />
  <br />
  Je ne sais pas s'il y aura une suite, mais si oui, je devine un peu le genre ^_^");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 13 - FIN");
			$news->setTimestamp(strtotime("29 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(256);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep13'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana131.jpg\" alt=\"Kanamemo\" /><br /><br />
<img src=\"images/news/kana132.jpg\" alt=\"Kanamemo\" />
<br /><br />
Eh oui, c'est déjà la fin de Kanamemo, j'espère que cette petite série fort sympathique vous aura plus autant qu'à nous.<br />
C'est pour nous une bonne nouvelle, on diminue ainsi le nombre de nos projets en cours/futurs, on espère pouvoir faire de même avec d'autres séries prochainement...<br />
<img src=\"images/news/kana133.jpg\" alt=\"Kanamemo\" /><br /><br />
On vous annonce déjà que Kujibiki Unbalance II et Potemayo seront entièrement refaits ! Pas mal de choses ont été revues, j'espère que vous apprécierez nos efforts.<br />
Kodomo no Jikan OAV 4 ne devrait plus tarder...<br />
Merci de nous avoir suivis et à bientôt pour d'autres épisodes ^_^<br /><br />
<img src=\"images/news/kana134.jpg\" alt=\"Kanamemo\" /><br /><br />
<img src=\"images/news/kana135.jpg\" alt=\"Kanamemo\" />");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 12");
			$news->setTimestamp(strtotime("20 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(255);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep12'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana12.jpg\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'&eacute;pisode 12 de Kanamemo ! Youhouh ! C'est la f&ecirc;te !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 11");
			$news->setTimestamp(strtotime("14 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(254);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep11'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana11.jpg\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'&eacute;pisode 11 de Kanamemo ! Youhouh ! C'est la f&ecirc;te !<br /><br />
Rappel, nos releases sont t&eacute;l&eacute;chargeable sur :<br />
<ul>
<li>Sur <a href=\"http://zerofansub.net/\">le site zerofansub.net</a> en DDL (cliquez sur projet dans le menu &agrave; gauche)</li>
<li>Sur <a href=\"http://www.bt-anime.net/index.php?page=tracker&team=Z%e9ro\">notre tracker torrent BT-Anime</a> en torrent peer2peer (Notre &eacute;quipe de seeder vous garantie du seed !)</li>
<li>Sur <a href=\"irc://irc.fansub-irc.eu/zero\">notre chan IRC</a> en XDCC (<a href=\"http://zerofansub.net/index.php?page=xdcc\">liste des paquets</a>)</li>
<li>Sur <a href=\"http://www.anime-ultime.net/part/Site-93\">Anime-Ultime</a> en DDL (Mais en fait, c'est les m&ecirc;mes fichiers que sur Z&eacute;ro, c'est juste des liens symboliques ^^)</li>
</ul>");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 10");
			$news->setTimestamp(strtotime("10 March 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(253);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep10'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana10.jpg\" style=\"float: left;\" alt=\"Kanamemo\" />
<br /><br />
Bonjour !<br />
Sortie de l'episode 10 de Kanamemo ! Youhouh ! C'est la fete !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 7, 8 et 9");
			$news->setTimestamp(strtotime("23 February 2011"));
			$news->setAuthor(TeamMember::getMemberByPseudo("praia"));
			$news->setCommentId(251);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep7'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep8'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep9'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kanamemo7.jpg\" alt=\"Kanamemo\" />
<br /><br />
Voilà qui met un terme à cette longue période d'inactivité : Kanamemo 7, 8 et 9, enfin !<br />
Tout comme l'épisode 5, l'épisode 7 était inutilement censuré, donc on s'est orientés vers les DVD. En version HD uniquement, la LD n'est plus très en vogue, faut dire ^^<br />
D'autres projets reprennent du service, encore un peu de patience...<br />
Je vous dis à bientôt pour d'autres épisodes ^_^");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo Chapitre 01");
			$news->setTimestamp(strtotime("02 August 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(241);
			$news->addReleasing(Release::getRelease('kanamemobook', 'ch1'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kanac1.jpg\" alt=\"Kanamemo Chapitre 01\" /><br /><br />
Sortie du chapitre 01 de Kanamemo qui ouvre le retour du scantrad chez Zéro !<br />
Depuis pas mal de temps, nous l'avions laissé à l'abandon mais avec l'école du fansub, nous avons pu nous y remettre.<br />
Sont prévus les scantrad de Kanamemo, Sketchbook et Maria+Holic. Quelques doujins devraient aussi arriver.<br />
Pour toutes nos autres séries dont les versions manga existent, vous pouvez les trouver en téléchargement sur les pages des séries comme Hitohira, Kannagi, Kimikiss et KissXsis.
<br />
A bientot !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 06");
			$news->setTimestamp(strtotime("16 April 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(224);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep6'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/newskana6.jpg\" /><br />
H� !<br />
Mais c'est qu'on arrive � la moiti� de la s�rie.<br />
Le 6�me �pisode de Kanamemo est disponible.");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 4 + 5");
			$news->setTimestamp(strtotime("19 March 2010"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(212);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep4'));
			$news->addReleasing(Release::getRelease('kanamemo', 'ep5'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<a href=\"http://yotsuba.imouto.org/image/b943e76cbe684f3d4c4cf3b748d7d878/moe%2099353%20amano_saki%20fixed%20kanamemo%20kujiin_mika%20nakamachi_kana%20neko%20pantsu%20seifuku.jpg\" target=\"_blank\"><img src=\"images/news/newskana5.jpg\" /><br />
(Image en plus grand clique ici)</a><br />
Coucou, nous revoilou !<br />
La suite de Kanamemo avec deux �pisodes : le 4 et le 5.<br />
Dans les deux, on voit des filles dans l'eau... Toute nues, aux bains, et en maillot de bain � la \"piscine\" !
<br />Les deux sont en version non-censur�e.
<br />Pour voir la diff�rence entre les deux versions : <a href =\"http://www.sankakucomplex.com/2009/11/10/kanamemo-dvd-loli-bathing-steamier-than-ever/\" target=\"_blank\">LIEN</a>.<br />
En bonus, un petit AMV de l'�pisode 05 (pass� � la TV, nous le l'avons pas fait nous-m�me).<br />
� bient�t !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 03");
			$news->setTimestamp(strtotime("26 November 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(150);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep3'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana3.jpg\" /><br />
BANZAIII !! Kanamemo �pisode 03, ouais, trop bien ! Je mets du temps � sortir les �pisodes ces derniers temps, mais derrni�re le rideau, ne vous inqui�tez pas, �a bosse ! Oui, c'est encore de ma faute, avant la piscine, maintenant printf, je suis d�bord�e... (Mais de quoi elle parle !? o__O) Bref. Bon �pisode !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Kanamemo 01");
			$news->setTimestamp(strtotime("20 August 2009"));
			$news->setAuthor(TeamMember::getMemberByPseudo("db0"));
			$news->setCommentId(114);
			$news->addReleasing(Release::getRelease('kanamemo', 'ep1'));
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("<img src=\"images/news/kana1.jpg\" />
Bonsoir....<br /><br />
Kodomo no Jikan touche � sa fin (bouhouh T__T) et on nous a propos� un anime sur le forum : Kanamemo. On a tout de suite vu qu'il s'inscrivait directement dans la ligne directe de Kodomo no Jikan, ecchi ~ loli ! R�tissants au d�part � commencer un nouvel anime sans finir nos pr�c�dents en cours, mais ayant plusieurs personnes de l'�quipage n'ayant rien � faire, nous avons finalement accept� la proposition. Cet anime est trop mignon~choupi~kawaii, c'est la petite Kana qui perd sa grand-m�re et ses parents et doit se debrouiller toute seule et trouver du travail. Y'a aussi un peu de yuri dedant, donc je pense que tout le monde y trouvera ce qu'il aime !");
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
			
			$news = new News();
			$news->setTitle("Joyeux No�l !");
			$news->setTimestamp(strtotime("24 December 2011 21:05"));
			$news->setAuthor(TeamMember::getMemberByPseudo("Sazaju HITOKAGE"));
			$news->setCommentId(277);
			$newsMessage = new SimpleTextComponent();
			$newsMessage->addLine("Allez pour me faire pardonner de ma derni�re news, un petit go�t de No�l dans cette mini-news (cliquez sur l'image).");
			$newsMessage->addLine();
			$newsMessage->addLine(new Link("images/news/[Zero Fansub]Noel 2011.zip", new Image("images/news/noel3.jpg", "Joyeux No�l !")));
			$news->setMessage($newsMessage);
			News::$allNews[] = $news;
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
}
?>
