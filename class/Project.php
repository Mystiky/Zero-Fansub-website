<?php
/*
	A project is a set of data concerning a specific project (set of releases).
*/
// TODO add features to find identical/similar contents, in order to plan factoring
class Project {
	private $id = '';
	private $name = '';
	private $genre = null;
	private $studio = null;
	private $externalSource = null;
	private $officialWebsite = null;
	private $originalName = null;
	private $airingYear = null;
	private $author = null;
	private $synopsis = null;
	private $isStarted = false;
	private $isRunning = false;
	private $isFinished = false;
	private $isAbandonned = false;
	private $license = null;
	private $isHentai = false;
	private $isDoujin = false;
	private $isHidden = false;
	private $discussionUrl = null;
	private $vosta = null;
	private $bonuses = array();
	private $coproduction = null;
	
	public function __construct($id = null, $name = null) {
		$this->setID($id);
		$this->setName($name);
	}
	
	public function setCoproduction($coprod) {
		$this->coproduction = $coprod;
	}
	
	public function getCoproduction() {
		return $this->coproduction;
	}
	
	public function addBonus(ProjectBonus $bonus) {
		$this->bonuses[] = $bonus;
	}
	
	public function getBonuses() {
		return $this->bonuses;
	}
	
	public function setVosta($vosta) {
		$this->vosta = $vosta;
	}
	
	public function getVosta() {
		return $this->vosta;
	}
	
	public function setDiscussionUrl($url) {
		$this->discussionUrl = new Url($url);
	}
	
	public function getDiscussionUrl() {
		return $this->discussionUrl;
	}
	
	public function setGenre($genre) {
		$this->genre = $genre;
	}
	
	public function getGenre() {
		return $this->genre;
	}
	
	public function setStudio($studio) {
		$this->studio = $studio;
	}
	
	public function getStudio() {
		return $this->studio;
	}
	
	public function setExternalSource($source) {
		$this->externalSource = $source;
	}
	
	public function getExternalSource() {
		return $this->externalSource;
	}
	
	public function hasExternalSource() {
		return $this->externalSource != null;
	}
	
	public function setOfficialWebsite(Link $link) {
		$this->officialWebsite = $link;
	}
	
	public function getOfficialWebsite() {
		return $this->officialWebsite;
	}
	
	public function hasOfficialWebsite() {
		return $this->officialWebsite != null;
	}
	
	public function setAuthor($author) {
		$this->author = $author;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function setAiringYear($year) {
		$this->airingYear = $year;
	}
	
	public function getAiringYear() {
		return $this->airingYear;
	}
	
	public function setOriginalName($name) {
		$this->originalName = $name;
	}
	
	public function getOriginalName() {
		return $this->originalName;
	}
	
	public function setSynopsis($synopsis) {
		$this->synopsis = $synopsis;
	}
	
	public function getSynopsis() {
		return $this->synopsis;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setRunning($boolean) {
		$this->isRunning = $boolean;
		if ($boolean) {
			$this->setStarted(true);
			$this->setAbandonned(false);
		}
	}
	
	public function isRunning() {
		return $this->isRunning;
	}
	
	public function setStarted($boolean) {
		$this->isStarted = $boolean;
	}
	
	public function isStarted() {
		return $this->isStarted;
	}
	
	public function setFinished($boolean) {
		$this->isFinished = $boolean;
		if ($boolean) {
			$this->setStarted(true);
			$this->setRunning(false);
		}
	}
	
	public function isFinished() {
		return $this->isFinished;
	}
	
	public function setAbandonned($boolean) {
		$this->isAbandonned = $boolean;
		if ($boolean) {
			$this->setRunning(false);
		}
	}
	
	public function isAbandonned() {
		return $this->isAbandonned;
	}
	
	public function setLicense(License $license) {
		$this->license = $license;
	}
	
	public function getLicense() {
		return $this->license;
	}
	
	public function isLicensed() {
		return $this->getLicense() != null;
	}
	
	public function setHentai($boolean) {
		$this->isHentai = $boolean;
	}
	
	public function isHentai() {
		return $this->isHentai;
	}
	
	public function setHidden($boolean) {
		$this->isHidden = $boolean;
	}
	
	public function isHidden() {
		return $this->isHidden;
	}
	
	public function setDoujin($boolean) {
		$this->isDoujin = $boolean;
	}
	
	public function isDoujin() {
		return $this->isDoujin;
	}
	
	private static $allProjects = null;
	public static function getAllProjects() {
		if (Project::$allProjects === null) {
			
			$project = new Project("hitohira", "Hitohira");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kannagi", "Kannagi");
			$project->setFinished(true);
			$project->setLicense(License::getDefaultLicense());
			Project::$allProjects[] = $project;
			
			$project = new Project("kimikiss", "Kimikiss Pure Rouge");
			$project->setAbandonned(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kodomo", "Kodomo no Jikan");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kodomooav", "Kodomo no Jikan OAV");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kodomo2", "Kodomo no Jikan ~ Ni Gakki");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kodomonatsu", "Kodomo no Natsu Jikan");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kodomofilm", "Kodomo no Jikan Le Film");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("mitsudomoe", "Mitsudomoe");
			$project->setOriginalName("Mitsudomoe");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOfficialWebsite(Link::newWindowLink("http://www.mitsudomoe-anime.com/", "Mitsudomoe Anime"));
			$project->setAiringYear(2010);
			$project->setStudio("Bridge");
			$project->setAuthor("Sakurai Norio");
			$project->setGenre("Com�die Ecchi");
			$project->setSynopsis("Les tripl�s raconte l'histoire de 3 filles de primaire un peu perverses qui harc�lent leur prof pas dou�.");
			$project->setRunning(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("eriko", "ERIKO");
			$project->setOriginalName("ERIKO");
			$project->setAiringYear(2007);
			$project->setAuthor("Gunma Kisaragi");
			$project->setGenre("Hentai");
			$project->setSynopsis("Parodie henta� de Kimikiss pure rouge mettant en sc�ne Futami Eriko, l'intello, continuant ses exp�riences encore plus profond�ment avec Kazuki.");
			$project->setHentai(true);
			$project->setDoujin(true);
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("heismymaster", "Ce sont mes Maids");
			$project->setOriginalName("Kore ga Oresama no Maidtachi");
			$project->setAiringYear(2007);
			$project->setAuthor("Yukimihonpo");
			$project->setGenre("Hentai");
			$project->setSynopsis("Parodie henta� He is my master. Yoshitaka est malade et les m�dicaments qu'Izumi va lui donner vont le remettre d'aplomb, ainsi que son penis ! Il va tout faire pour avoir Izumi mais va finalement se rattraper sur les deux autres.");
			$project->setHentai(true);
			$project->setDoujin(true);
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("denpa", "Denpa Onna to Seishun Otoko");
			$project->setOriginalName("Denpa Onna To Seishun Otoko");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOfficialWebsite(Link::newWindowLink("http://www.tbs.co.jp/anime/denpa/", "Denpa Onna To Seishun Otoko"));
			$project->setAiringYear(2011);
			$project->setStudio("Shaft");
			$project->setGenre("Fantastique");
			$project->setSynopsis("Niwa Makoto est un lyc�en parti vivre chez sa tante car ses parents sont en voyage d'affaires. Il y rencontre une cousine du m�me �ge, inconnue du reste de sa famille, Towa Erio. Cette cousine �trange porte constamment un futon autour du corps, ne se nourrit pratiquement que de pizzas et pense �tre un extraterrestre.");
			$project->setStarted(true);
			$project->setRunning(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("sleeping", "Isshoni Sleeping - S'endormir avec Hinako");
			$project->setOriginalName("Isshoni Sleeping");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setAiringYear(2010);
			$project->setGenre("Ecchi");
			$project->setSynopsis("Hinako est de retour ! Apr�s l'effort, le r�confort, et c'est avec elle que vous allez pouvoir vous reposer apr�s les difficiles exercices de musculations du pr�c�dent �pisode.");
			$project->setFinished(true);
			$project->setLicense(License::getDefaultLicense());
			Project::$allProjects[] = $project;
			
			$project = new Project("bath", "Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko");
			$project->setOriginalName("Isshoni Training Ofuro - Bathtime with Hinako & Hiyoko");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setAiringYear(2011);
			$project->setStudio("Primaesta");
			$project->setGenre("Ecchi");
			$project->setSynopsis("Prendre un bain avec Hinako, &ccedil;a vous dit ? En plus, elle n'est pas seule : Hiyoko, sa copine loli, vient vous rejoindre.");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("potemayooav", "Potemayo OAV");
			$project->setOriginalName("Potemayo Special");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOfficialWebsite(Link::newWindowLink("http://www.potemayo.com/", "Potemayo.com"));
			$project->setAiringYear(2008);
			$project->setStudio(Link::newWindowLink("http://www.jcstaff.co.jp/", "JC Staff"));
			$project->setGenre("Com�die");
			$project->setSynopsis("De petites aventures arrivent � Potemayo dans ces �pisodes bonus de la s�rie Potemayo.");
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", Link::newWindowLink("http://www.getpersonas.com/en-US/persona/208619", new Image("http://getpersonas-cdn.mozilla.net/static/1/9/208619/preview.jpg?1273490832", "Potemayo theme skin persona mozilla firefox"))));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("konoe", "Konoe no Jikan");
			$project->setOriginalName("Konoe no Jikan");
			$project->setAiringYear(2008);
			$project->setGenre("Porno");
			$project->setSynopsis("Parodie pornographique de Kodomo no Jikan.");
			$project->setHentai(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("akinahshiyo", "Akina To Onsen De H Shiyo !");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Akina To Onsen De H Shiyo");
			$project->setAiringYear(2011);
			$project->setGenre("Hentai");
			$project->setHentai(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("alignment", "Alignment You ! You ! The Animation");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Alignment You ! You ! The Animation");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.pinkpineapple.co.jp/web/alignment/", "Pinkpineapple.co.jp"));
			$project->setAiringYear(2008);
			$project->setStudio(Link::newWindowLink("http://www.pinkpineapple.co.jp/", "Pinkpineapple"));
			$project->setGenre("Hentai");
			$project->setSynopsis("Takahashi, jeune lyc�enne, se masturbe furieusement dans la salle de cours devant l'homme qu'elle aime, Oohara. Mais personne ne remarque la lubrique jeune femme ! Et pour cause : elle est d�j� morte...");
			$project->setVosta(Link::newWindowLink("http://www.killer-maid.net", "Killer maid"));
			$project->setHentai(true);
			$project->setHidden(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("training", "Isshoni Training - L'entra&icirc;nement avec Hinako");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Isshoni Training");
			$project->setAiringYear(2009);
			$project->setGenre("Ecchi");
			$project->setSynopsis("Hinako est aspir�e dans le monde des mangas alors qu'elle en regardait un � la t�l�vision. C'est ainsi que commence sa vie en tant que personnage d'anime, tandis que le spectateur est sans cesse sollicit� pour des exercices physiques de remise en forme, avec une cam�ra � la premi�re personne.");
			$project->setVosta("Boobz");
			$project->setFinished(true);
			$project->setLicense(License::getDefaultLicense());
			Project::$allProjects[] = $project;
			
			$project = new Project("working", "Working!!");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Working!!");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.wagnaria.com/", "Wagnaria.com"));
			$project->setAiringYear(2010);
			$project->setStudio("A-1 Pictures Inc");
			$project->setGenre("Com�die");
			$project->setSynopsis("Takanashi Souta est un lyc�en qui a une passion pour les petites choses mignonnes. Quand une fille, Taneshima Popla, l'aborde dans la rue et lui demande si il cherche un travail � mi-temps, il la trouve mignonne car elle ressemble � une coll�gienne, peut-�tre m�me une �coli�re. Mais il se rend compte quelle a un an de plus que lui. Passant par dessus ce d�tail, il accepte le travail � mi-temps car elle est toute petite et craquante � souhait. Il commence donc � travailler dans un restaurant familial, mais on peut dire que le personnel est unique ici !");
			Project::$allProjects[] = $project;
			
			$project = new Project("working2", "Working!! 2");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Working!! 2");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.wagnaria.com/", "Wagnaria.com"));
			$project->setAiringYear(2011);
			$project->setStudio("A-1 Pictures Inc");
			$project->setGenre("Com�die");
			$project->setSynopsis("Takanashi Souta est un lyc�en qui a une passion pour les petites choses mignonnes. Quand une fille, Taneshima Popla, l'aborde dans la rue et lui demande si il cherche un travail � mi-temps, il la trouve mignonne car elle ressemble � une coll�gienne, peut-�tre m�me une �coli�re. Mais il se rend compte quelle a un an de plus que lui. Passant par dessus ce d�tail, il accepte le travail � mi-temps car elle est toute petite et craquante � souhait. Il commence donc � travailler dans un restaurant familial, mais on peut dire que le personnel est unique ici !");
			Project::$allProjects[] = $project;
			
			$project = new Project("hshiyo", "Faisons l'amour ensemble !");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Issho ni H shiyo");
			$project->setAiringYear(2009);
			$project->setGenre("Hentai");
			$project->setSynopsis("Vous avez aimez L'entra�nement avec Hinako ? Vous aimerez s�rement sa parodie Henta�, \"faisons l'amour ensemble\" ! Aujourd'hui, c'est avec vous que notre jolie h�ro�ne fait l'amour... Vous, et vous seul ! Profitez-en ;)");
			$project->setHentai(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("mermaid", "Mermaid Melody Pichi Pichi Pitch");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Mermaid Melody Pichi Pichi Pitch");
			$project->setOfficialWebsite(Link::newWindowLink("http://p-hanamori.cool.ne.jp/", "Lips"));
			$project->setAiringYear(2003);
			$project->setStudio(Link::newWindowLink("http://www.tokyu-agc.co.jp/", "Tokyo Agency"));
			$project->setGenre("Com�die - Magical Girl - Ecchi");
			$project->setAuthor("Pink Hanamori");
			$project->setSynopsis("Luchia, une jeune sir�ne, a sauv� dans son enfance un gar�on du m�me �ge qu'elle qui �tait en train de se noyer et lui a mis au cou un m�daillon. Quelques ann�es plus tard, elle gagne la terre ferme dans l'espoir de retrouver celui qu'elle a toujours aim�. Le jeune coll�gien en question qui est devenu un surfer participant � des concours invite Luchia et sa copine Hanon pour la revoir lors de sa prochaine comp�tition, mais les Forces du Mal aquatiques vont venir semer le trouble...");
			$project->setVosta("Lunar anime");
			$project->setDiscussionUrl("http://zero.xooit.fr/t148-Ton-avis-sur-Mermaid-Melody-Pichi-Pichi-Pich-la-serie-en-general.htm");
			$project->setAbandonned(true);
			$project->setLicense(License::getDefaultLicense());
			Project::$allProjects[] = $project;
			
			$project = new Project("nanami", "Nanami Madobe Windows 7 Publicit&eacute;");
			$project->setOriginalName("Madobe Nanami Windows7 Comercial");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.windows7-mania.jp/", "Windows7 Mania"));
			$project->setAiringYear(2010);
			$project->setStudio("Microsoft");
			$project->setGenre("Publicit�");
			$project->setSynopsis("Nanami Madobe te pr�sente Windows 7 et te donne des conseils pour mieux l'utiliser. Elle te montre aussi comment monter ton propre ordinateur.");
			$project->setVosta(Link::newWindowLink("http://bssubs.net/", "BSS"));
			$project->addBonus(new ProjectBonus("ThemePack", "Le th�me de Nanami Madobe pour Windows 7 ! Pour l'installer, vous devez avoir Windows 7. T�l�chargez le fichier puis double-cliquez dessus pour l'ouvrir. Le th�me s'installera tout seul et Nanami vous dira \"Konichiwa ! Nanami desu.\".<br/>
<a href='ddl/[Zero]_Windows_7_Nanami_Madobe_ThemePack.themepack' target='_blank'>
<img src='http://zerofansub.net/images/news/theme_nanami.png' border='0' alt='Themepack Th�me Windows 7 de Nanami Madobe � t�l�charger download gratuit' />
</a>"));
			$project->addBonus(new ProjectBonus("Pack d'images", Link::newWindowLink("http://zerofansub.net/galerie/index.php?spgmGal=Zero_fansub/Images/Nanami%20Madobe", new Image("http://zerofansub.net/images/news/galerie_nanami.png", "Galerie d'images Nanami Madobe"))));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("potemayo", "Potemayo");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Potemayo");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.potemayo.com/", "Potemayo.com"));
			$project->setAiringYear(2007);
			$project->setStudio(Link::newWindowLink("http://www.jcstaff.co.jp/", "JC Staff"));
			$project->setGenre("Com�die");
			$project->setSynopsis("Sunao Moriyama, se pr�parant � partir � l'�cole, ouvre la porte de son frigo afin de d�jeuner, hors celui-ci tombe nez � nez avec une dr�le de cr�ature plus ou moins semblable � un \"b�b�\".
Comme s'il n'avait rien vu de sp�cial celui-ci ferme la porte sans porter plus d'attention � la cr�ature en ayant au pr�alable saisi son d�jeun�, celui-ci portant le nom de \"Potemayo\", il surnommera la cr�ature \"Potemayo\".
Et c'est d�s lors qu'� se moment, les gags et situations humoristiques apparaissent !");
			$project->setVosta("<a href=\"http://fansubs.anime-share.net/\" target=\"_blank\">Anime-Share fansub</a> et Anoymous");
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", Link::newWindowLink("http://www.getpersonas.com/en-US/persona/208619", new Image("http://getpersonas-cdn.mozilla.net/static/1/9/208619/preview.jpg?1273490832", "Potemayo theme skin persona mozilla firefox"))));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("hyakkooav", "Hyakko OAV");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Hyakko Extra");
			$project->setOfficialWebsite(Link::newWindowLink("http://hyakko.jp/", "Hyakko.jp"));
			$project->setAiringYear(2009);
			$project->setStudio("Nippon Animation");
			$project->setGenre("Com�die");
			$project->setAuthor("Katoh Aruaki");
			$project->setSynopsis("Torako invite Toma dans un caf� manger des patisseries.");
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20Original%20Soundtrack.zip.torrent">[Nipponsei] Hyakko Original Soundtrack.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20OP%20Single%20-%20Suppin%20Rock%20%5BOgawa%20Mana%5D.zip.torrent">[Nipponsei] Hyakko OP Single - Suppin Rock [Ogawa Mana].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20ED%20Single%20-%20Namida%20Namida%20Namida%20%5BHirano%20Aya%5D.zip.torrent">[Nipponsei] Hyakko ED Single - Namida Namida Namida [Hirano Aya].zip</a>'));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("mayoi", "Mayoi Neko Overrun!");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Mayoi Neko Overrun!");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.patisserie-straycats.com/", "Patisserie Stray Cats"));
			$project->setAiringYear(2010);
			$project->setStudio(Link::newWindowLink("http://www.anime-int.com/", "Studio AIC"));
			$project->setAuthor("Matsu Tomohiro");
			$project->setGenre("Com�die Ecchi");
			$project->setSynopsis("Takumi Tsuzuki vit avec sa grande �soeur� Otome bien qu�ils ne soient pas li�s par le sang. Otome g�re une vieille p�tisserie appel�e Stray Cats o� y travaille �galement une amie d�enfance de Takumi, Fumino Serisawa. C�est alors qu�un jour, Nozomi Kiriya, une jeune fille myst�rieuse imitant un chat, appara�t�");
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/209338"><img src="http://getpersonas-cdn.mozilla.net/static/3/8/209338/preview.jpg?1273561667" border="0" alt="Mayoi Neko Overrun! theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/210030"><img src="http://getpersonas-cdn.mozilla.net/static/3/0/210030/preview.jpg?1273648101" border="0" alt="Mayoi Neko Overrun! theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/233236"><img src="http://getpersonas-cdn.mozilla.net/static/3/6/233236/preview.jpg?1277047781" border="0" alt="Mayoi Neko Overrun! theme skin persona mozilla firefox" /></a>'));
			$project->setStarted(true);
			$project->setRunning(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("tayutamapure", "Tayutama - Kiss on my Deity - Pure My Heart");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Tayutama -Kiss on my Deity- Pure My Heart");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.tayutama.com/", "Tayutama.com"));
			$project->setAiringYear(2009);
			$project->setStudio("Silver Link");
			$project->setGenre("Amour et Amiti�");
			$project->setSynopsis("Les �pisodes Bonus DVD de la s�rie Tayutama -Kiss on my Deity-.");
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/236444"><img src="http://getpersonas-cdn.mozilla.net/static/4/4/236444/preview.jpg?1277397610" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/260878"><img src="http://getpersonas-cdn.mozilla.net/static/7/8/260878/preview.jpg?1279817830" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a>'));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("sketchbookdrama", "Sketchbook ~full colors~ Picture Drama");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Sketchbook - full color's Picture Drama");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.sketch-full.net/", "Sketch-full.net"));
			$project->setAiringYear(2008);
			$project->setStudio(Link::newWindowLink("http://www.hal-film.co.jp/", "Hal film maker"));
			$project->setGenre("Com�die");
			$project->setAuthor("Kobako Totan");
			$project->setSynopsis("Sora et ses amies partent en vacances ensemble.");
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur la radio.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20colors~%20sound%20sketch%20book.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full colors~ sound sketch book.zip	11-21 01:28	130.02 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20color%27s~%20OP%20Single%20-%20Kaze%20Sagashi%20%5BKiyoura%20Natsumi%5D.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full color\'s~ OP Single - Kaze Sagashi [Kiyoura Natsumi].zip	10-24 01:52	43.88 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20color%27s~%20ED%20Single%20-%20Sketchbook%20wo%20Motta%20Mama%20%5BMakino%20Yui%5D.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full color\'s~ ED Single - Sketchbook wo Motta Mama [Makino Yui].zip	10-24 01:52	47.75 MB</a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t359-Ton-avis-sur-Sketchbook-full-color-s.htm");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("hyakko", "Hyakko");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Hyakko");
			$project->setOfficialWebsite(Link::newWindowLink("http://hyakko.jp/", "Hyakko.jp"));
			$project->setAiringYear(2008);
			$project->setStudio("Nippon Animation");
			$project->setGenre("Com�die");
			$project->setSynopsis("L��cole priv�e Kamizono est un �tablissement qui poss�de la particularit� d�accueillir en son sein des �l�ves allant du primaire jusqu�au lyc�e. De ce fait, son immense structure donne du mal aux nouveaux arrivants pour s�y retrouver. Nonomura Ayumi, jeune �tudiante au caract�re r�serv�, arrive � se perdre d�s le premier jour de la rentr�e. Cherchant d�sesp�r�ment son chemin, elle fini par tomber sur une de ses camarades de classe Lizuda Tatsuki qui se trouve �tre, sans vouloir l�admettre, dans la m�me situation qu�elle. Apr�s un long moment de marche, toutes les deux voient incr�dules deux �l�ves sautaient du deuxi�me �tage d�un b�timent. C�est ainsi qu�elles font la rencontre de Torako et Suzu, �galement perdues mais ayant un moyen infaillible pour atteindre rapidement leur salle de classe : aller de l�avant quelque soit l�obstacle rencontr�. Commence alors pour ce nouveau quatuor form�, une ann�e scolaire plac�e sous le signe de l�amiti� et de l�humour.");
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20Original%20Soundtrack.zip.torrent">[Nipponsei] Hyakko Original Soundtrack.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20OP%20Single%20-%20Suppin%20Rock%20%5BOgawa%20Mana%5D.zip.torrent">[Nipponsei] Hyakko OP Single - Suppin Rock [Ogawa Mana].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Hyakko%20ED%20Single%20-%20Namida%20Namida%20Namida%20%5BHirano%20Aya%5D.zip.torrent">[Nipponsei] Hyakko ED Single - Namida Namida Namida [Hirano Aya].zip</a>'));
			$project->setFinished(true);
			$project->setLicense(new License("Wakanim"));
			Project::$allProjects[] = $project;
			
			$project = new Project("tayutama", "Tayutama - Kiss on my Deity -");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Tayutama -Kiss on my Deity-");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.tayutama.com/", "Tayutama.com"));
			$project->setAiringYear(2009);
			$project->setStudio("Silver Link");
			$project->setGenre("Amour et Amiti�");
			$project->setSynopsis("L'histoire est centr�e sur Yuuri Mito, un �tudiant de l'Acad�mie Sousei et le fils unique de l'homme qui dirige le temple Yachimata. � Yachimata, il y a une l�gende � propos d'une divinit� appel�e Tayutama-sama qui prot�gea la r�gion, mais cette divinit� et d'autres ainsi nomm�es \"Tayutai\" ont �t� oubli�es avec le temps. Mito et ses amis d�couvrent une relique dans le sol de l'�cole, avec de myst�rieux motifs. D�s lors, � la c�r�monie d'ouverture de la nouvelle ann�e scolaire, une tout aussi myst�rieuse fille appel�e Mashiro appara�t devant Mito. Mashiro est d'une certaine mani�re li�e � la relique et � la l�gende de Tayutama-sama.");
			$project->setVosta('<a href="http://fansubs.anime-share.net/" target="_blank">Anime-Share fansub</a> et Anoymous');
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Tayutama_Kiss_on_my_deity_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/236444"><img src="http://getpersonas-cdn.mozilla.net/static/4/4/236444/preview.jpg?1277397610" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/260878"><img src="http://getpersonas-cdn.mozilla.net/static/7/8/260878/preview.jpg?1279817830" border="0" alt="Tayutama Kiss on my Deity theme skin persona mozilla firefox" /></a>'));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("sketchbook", "Sketchbook ~full colors~");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Sketchbook - full color's");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.sketch-full.net/", "Sketch-full.net"));
			$project->setAiringYear(2007);
			$project->setStudio(Link::newWindowLink("http://www.hal-film.co.jp/", "Hal film maker"));
			$project->setGenre("Com�die");
			$project->setAuthor("Kobako Totan");
			$project->setSynopsis("Nous suivons la vie de Sora, une jeune adolescente tr�s timide et qui, en raison de cela ne parle pas beaucoup. Donnant l�impression de vivre dans sa bulle, cette derni�re a une passion pour le dessin. Ce penchant pour l�art l�entra�na � faire partie du club de dessin de son �cole o� elle s�est fait plusieurs amies. Une des particularit�s de Sora est qu�elle ne quitte jamais son sketchbook afin de pouvoir retranscrire � n�importe quel moment sur papier, un �v�nement qui l��merveille. Malheureusement, elle rencontre toujours le m�me probl�me, celui de ne jamais pouvoir terminer les dessins qu�elle fait sur des sc�nes �ph�m�res (chat qui se l�che, feu d�artifice�). L�g�rement d�prim�e � cause de cela, elle retrouve cependant tr�s vite le sourire gr�ce � des petites choses qui paraissent insignifiantes, nous faisant ainsi partager son univers � la fois po�tique et touchant.");
			$project->setVosta('Spoonmoon');
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur la radio.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20colors~%20sound%20sketch%20book.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full colors~ sound sketch book.zip	11-21 01:28	130.02 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20color%27s~%20OP%20Single%20-%20Kaze%20Sagashi%20%5BKiyoura%20Natsumi%5D.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full color\'s~ OP Single - Kaze Sagashi [Kiyoura Natsumi].zip	10-24 01:52	43.88 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Sketchbook%20~full%20color%27s~%20ED%20Single%20-%20Sketchbook%20wo%20Motta%20Mama%20%5BMakino%20Yui%5D.zip.torrent" target="_blank">[Nipponsei] Sketchbook ~full color\'s~ ED Single - Sketchbook wo Motta Mama [Makino Yui].zip	10-24 01:52	47.75 MB</a>'));
			$project->setDiscussionUrl('http://zero.xooit.fr/t359-Ton-avis-sur-Sketchbook-full-color-s.htm');
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("mariaholic", "Maria+Holic");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Maria+Holic");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.mariaholic.com/", "MariaHolic.com"));
			$project->setAiringYear(2009);
			$project->setStudio(Link::newWindowLink("http://www.genco.co.jp/", "Genco"));
			$project->setGenre("Com�die - D�jant� - Ecchi");
			$project->setAuthor("Endou Minari");
			$project->setSynopsis("Au milieu de l�ann�e scolaire, Kanako est une adolescente qui d�cide de venir �tudier dans un �tablissement pour filles : Ame no Kisaki. En faisant ceci, cette derni�re esp�re avoir autant de chance en amour que ses parents qui s�y sont rencontr�s (sa m�re �tait une �l�ve et son p�re un enseignant). N�anmoins, due � sa grande taille, Kanako n�a jamais pu imaginer entretenir une vraie relation avec un gar�on et s�est finalement rendue compte qu�elle n��tait attir�e que par la gente f�minine.
Alors qu�elle cherche son chemin, elle tombe sous le charme d�une �tudiante accompagn�e de sa servante et r�pondant au nom de Mariya. Apr�s avoir fait connaissance, cette derni�re lui indique le lieu o� se situe le dortoir et lui donne rendez vous un peu plus tard dans la journ�e pour lui servir de guide � travers l��tablissement. Cependant, le moment venu, Kanako d�couvre par hasard la vraie � nature � de Mariya qui, si celle-ci �tait d�couverte, suffirait � l�exclure de l��cole. Afin que Kanako garde le secret, Mariya exploite vicieusement les penchants yuri que cette derni�re tente de dissimuler et la force � rester pr�s d�elle pour la surveiller. Ne pouvant faire face, Kanako lui ob�it en devenant sa camarade de chambre et voit son espoir ardant de trouver son �toile promise s�amincir�");
			$project->setVosta('<a href="http://www.ggkthx.org/" target="_blank">GG</a>');
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Maria%20Holic%20Soundtrack%20no%20Kikikata%202.zip.torrent" target="_blank">[Nipponsei] Maria Holic Soundtrack no Kikikata 2.zip	03-12 00:55	110.03 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Maria%20Holic%20Soundtrack%20no%20Kikikata%201.zip.torrent" target="_blank">[Nipponsei] Maria Holic Soundtrack no Kikikata 1.zip	03-12 00:55	126.31 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Maria%20Holic%20OP%20Single%20-%20HANAJI%20%5BKobayashi%20Yuu%5D.zip.torrent" target="_blank">[Nipponsei] Maria Holic OP Single - HANAJI [Kobayashi Yuu].zip	02-10 20:38	39.02 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Maria%20Holic%20ED%20Single%20-%20Kimi%20ni%2C%20Mune%20Kyun.%20%5BVarious%5D.zip.torrent" target="_blank">[Nipponsei] Maria Holic ED Single - Kimi ni, Mune Kyun. [Various].zip</a>'));
			$project->addBonus(new ProjectBonus("Divers", '<img src="images/icones/bonus.png" alt="Bonus" /> <a href="ddl/%5bKanaii-Zero%5d_Maria+Holic_Ending_Creditless_+_Opening_%5bHQ%5d.zip">Les Ending et Opening Creditless</a><br />
<img src="images/icones/bonus.png" alt="Bonus" /> <a href="http://www.megaupload.com/?d=NB2ZP0E1">Les jaquettes et images bonus des DVD</a><br />
<img src="images/icones/bonus.png" alt="Bonus" /> <a href="http://www.megaupload.com/?d=6SV5980U">Les ED Quad (X264)</a><br />
<img src="images/icones/bonus.png" alt="Bonus" /> <a href="ddl/%5bKanaii-Zero%5d_HANAJI_Maria+Holic_OP_%5bX264_1280x720%5d.mp4">Clip de l\'Opening Hanaji</a>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/126094"><img src="http://getpersonas-cdn.mozilla.net/static/9/4/126094/preview.jpg?1268458756" border="0" alt="Maria Holic theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/93715"><img src="http://getpersonas-cdn.mozilla.net/static/1/5/93715/preview.jpg?1265220806" border="0" alt="Maria Holic theme skin persona mozilla firefox" /></a>'));
			$project->setDiscussionUrl('http://zero.xooit.fr/t476-Ton-avis-sur-Maria-Holic.htm');
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kanamemobook", "Kanamemo");
			$project->setOriginalName("Kanamemo");
			$project->setGenre("Com�die - D�jant� - Ecchi");
			$project->setSynopsis("Kana vient tout juste de perdre sa grand-m�re et seule famille, la laissant seule au monde. Apr�s avoir fuit une horde de d�m�nageurs � l'air sournois (du moins pour son petit esprit herm�tique � toute r�flexion), elle entreprend de chercher un travail, ce qu'elle r�ussit plus ou moins � trouver au sein d'une petite entreprise de livraison de journaux...");
			$project->setStarted(true);
			$project->setRunning(true);
			$project->setDoujin(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kanamemo", "Kanamemo");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Kanamemo");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.starchild.co.jp/special/kanamemo/", "Starchild"));
			$project->setAiringYear(2009);
			$project->setStudio("Feel - Starchild Records");
			$project->setGenre("Com�die - D�jant� - Ecchi");
			$project->setAuthor("Iwami Shouko");
			$project->setSynopsis("Kana vient tout juste de perdre sa grand-m�re et seule famille, la laissant seule au monde. Apr�s avoir fuit une horde de d�m�nageurs � l'air sournois (du moins pour son petit esprit herm�tique � toute r�flexion), elle entreprend de chercher un travail, ce qu'elle r�ussit plus ou moins � trouver au sein d'une petite entreprise de livraison de journaux...");
			$project->setVosta('Underwater');
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
<a href="images/cover/[Zero]Kanamemo_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Kanamemo_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kanamemo%20Character%20Song%20%26%20Soundtrack%20Album%20-%20Kanamero.zip.torrent">[Nipponsei] Kanamemo Character Song &amp; Soundtrack Album - Kanamero.zip</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kanamemo%20ED%20Single%20-%20YAHHO%21%21%20%5BHorie%20Yui%5D.zip.torrent">[Nipponsei] Kanamemo ED Single - YAHHO!! [Horie Yui].zip</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kanamemo%20OP%20Single%20-%20Kimi%20he%20to%20Tsunagu%20Kokoro%20%5BVarious%5D.zip.torrent">[Nipponsei] Kanamemo OP Single - Kimi he to Tsunagu Kokoro [Various].zip</a>'));
			$project->addBonus(new ProjectBonus("Images & Wallpaper", ' <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image01.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image01.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image02.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image02.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image03.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image03.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image04.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image04.jpg" class="img-thumbnail" width="150" height="150"></a>    
 <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image05.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image05.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image06.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image06.jpg" class="img-thumbnail" width="150" height="150"></a>     
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image07.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image07.jpg" class="img-thumbnail" width="150" height="150"></a>    
  <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image08.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image08.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image09.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image09.jpg" class="img-thumbnail" width="150" height="150"></a>    
   <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image10.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image10.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image11.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image11.jpg" class="img-thumbnail" width="150" height="150"></a>    
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=11#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image12.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image12.jpg" class="img-thumbnail" width="150" height="150"></a>     
    <a href="galerie/index.php?spgmGal=Zero_fansub/Images/Kanamemo&amp;spgmPic=12#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image13.jpg" alt="galerie/gal/Zero_fansub/Images/Kanamemo/_thb_[Zero]Kanamemo_Image13.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("toradorasos", "Toradora! Sp�cial SOS");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Toradora! Special");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.starchild.co.jp/special/toradora/", "Toradora"));
			$project->setAiringYear(2009);
			$project->setStudio(Link::newWindowLink("http://www.genco.co.jp/", "Genco"));
			$project->setGenre("Com�die - Amour et Amiti�");
			$project->setAuthor("Takemiya Yuyuko");
			$project->setSynopsis("Ami, Taiga et Ryuuji d�cident d'aller chez Jonny's pour y gouter les spaghettis Tarako. Sur place ils retrouvent Minori et la d�gustation culinaire vire au duel...");
			$project->setCoproduction(Link::newWindowLink("http://japanslash.free.fr", new Image("http://japanslash.free.fr/images/bannieres/naishi.png", "Maboroshi no fansub")));
			$project->addBonus(new ProjectBonus("OST", '<div style="float : right; display:block; margin-right: 20px;">
	<img src="ost/[Zero] Toradora! OP Single - Pre-Parade.jpg" border="0">
</div>
<p>Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<b>Nom</b> [Zero] Toradora! OP Single - Pre-Parade<br />
<b>Pistes audio</b><br />
01 - Pre-Parade<br />
02 - Ka Ra Ku Ri<br />
03 - Pre-Parade (off vocal ver.)<br />
04 - Ka Ra Ku Ri (off vocal ver.)<br />
<b>+ 4 images</b><br />
<b>Taille totale</b> 35 Mo.<br />
<br />
<b>T�l�chargements</b><br />
<img src="images/icones/ddl.png">		[ <a href="ost/[Zero] Toradora! OP Single - Pre-Parade.zip">T�l�charger l\'archive .ZIP</a> ]<br />

<img src="images/icones/torrent.png"> 		[ <a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Toradora!%20OP%20Single%20-%20Pre-Parade%20%5BVarious%5D.zip.torrent">Torrent (Nipponsei)</a> ]<br />
	<img src="ost/[Zero] Toradora! ED Single - Vanilla Salt - Horie Yui.jpg" border="0"  style="float : left; display:block; margin-left: 20px;">
<b>Nom</b> [Zero] Toradora! ED Single - Vanilla Salt - Horie Yui<br />
<b>Pistes audio</b><br />
01 - Vanilla Salt<br />
02 - I my me<br />
03 - Vanilla Salt (off vocal ver.)<br />
04 - I my me (off vocal ver.)<br />
<b>+ 4 images</b><br />
<b>Taille totale</b> 42 Mo.<br />
<br />
<b>T�l�chargements</b><br />
<img src="images/icones/ddl.png">		[ <a href="ost/[Zero] Toradora! ED Single - Vanilla Salt - Horie Yui.zip">T�l�charger l\'archive .ZIP</a> ]<br />

<img src="images/icones/torrent.png"> 		[ <a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Toradora!%20ED%20Single%20-%20Vanilla%20Salt%20%5BHorie%20Yui%5D.zip.torrent">Torrent (Nipponsei)</a> ]'));
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Toradora_Cover01.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover01.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover02.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover02.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover03.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover03.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/75812"><img src="http://getpersonas-cdn.mozilla.net/static/1/2/75812/preview.jpg?1261355186" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/92100"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/92100/preview.jpg?1264947658" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/97183"><img src="http://getpersonas-cdn.mozilla.net/static/8/3/97183/preview.jpg?1265514870" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/107104"><img src="http://getpersonas-cdn.mozilla.net/static/0/4/107104/preview.jpg?1266634442" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/111779"><img src="http://getpersonas-cdn.mozilla.net/static/7/9/111779/preview.jpg?1267020347" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/123049"><img src="http://getpersonas-cdn.mozilla.net/static/4/9/123049/preview.jpg?1268381765" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/137800"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/137800/preview.jpg?1268916096" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/129800"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/129800/preview.jpg?1268570882" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/145485"><img src="http://getpersonas-cdn.mozilla.net/static/8/5/145485/preview.jpg?1270054918" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/161326"><img src="http://getpersonas-cdn.mozilla.net/static/2/6/161326/preview.jpg?1270042852" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/169796"><img src="http://getpersonas-cdn.mozilla.net/static/9/6/169796/preview.jpg?1270408779" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/190100"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/190100/preview.jpg?1271618180" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/205389"><img src="http://getpersonas-cdn.mozilla.net/static/8/9/205389/preview.jpg?1273098873" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/204714"><img src="http://getpersonas-cdn.mozilla.net/static/1/4/204714/preview.jpg?1273099951" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/221228"><img src="http://getpersonas-cdn.mozilla.net/static/2/8/221228/preview.jpg?1278446057" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/220075"><img src="http://getpersonas-cdn.mozilla.net/static/7/5/220075/preview.jpg?1278446084" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223130"><img src="http://getpersonas-cdn.mozilla.net/static/3/0/223130/preview.jpg?1275476469" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223131"><img src="http://getpersonas-cdn.mozilla.net/static/3/1/223131/preview.jpg?1275476559" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/229455"><img src="http://getpersonas-cdn.mozilla.net/static/5/5/229455/preview.jpg?1276434404" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223134"><img src="http://getpersonas-cdn.mozilla.net/static/3/4/223134/preview.jpg?1275477090" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/246423"><img src="http://getpersonas-cdn.mozilla.net/static/2/3/246423/preview.jpg?1278221246" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/247218"><img src="http://getpersonas-cdn.mozilla.net/static/1/8/247218/preview.jpg?1278329550" border="0" alt="Toradora theme firefox" /></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t357-Ton-avis-sur-Toradora.htm");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("toradora", "Toradora!");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Toradora!");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.starchild.co.jp/special/toradora/", "Toradora"));
			$project->setAiringYear(2008);
			$project->setStudio(Link::newWindowLink("http://www.genco.co.jp/", "Genco"));
			$project->setGenre("Com�die - Amour et Amiti�");
			$project->setAuthor("Takemiya Yuyuko");
			$project->setSynopsis("En raison de son regard mena�ant h�rit� de son p�re, Takasu Ryuuji est un adolescent craint, car consid�r� comme un d�linquant, par les autres �l�ves de son lyc�e. Cette image �tant � l�oppos� de ce qu�il est r�ellement, ce dernier aimerait s�en s�parer d�finitivement afin de ne plus souffrir des cons�quences qui en d�coulent. Ryuuji ne perd pas espoir d�y arriver gr�ce notamment � son ami Kitamura qui, en plus d�avoir vu clair dans cette m�sentente, lui a permis de rencontrer Kushieda Minori dont il est tomb� amoureux. Alors qu�il pense � elle, il bouscule par m�garde Asaika Taiga, une �l�ve de sa classe et amie de Minori dont le mauvais caract�re n�a d��gal que sa force. Suite � un concours de circonstances, Ryuuji apprendra que Aisaka est sa nouvelle voisine et que cette derni�re est amoureuse de Kitamura. Se d�veloppe alors entre les deux une relation ambigu� dans le but de se rapprocher des personnes respectives aim�es.");
			$project->setVosta('<a href="http://www.ggkthx.org/" target="_blank">GG</a>');
			$project->setCoproduction(Link::newWindowLink("http://japanslash.free.fr", new Image("http://japanslash.free.fr/images/bannieres/naishi.png", "Maboroshi no fansub")));
			$project->addBonus(new ProjectBonus("OST", '<div style="float : right; display:block; margin-right: 20px;">
	<img src="ost/[Zero] Toradora! OP Single - Pre-Parade.jpg" border="0">
</div>
<p>Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<b>Nom</b> [Zero] Toradora! OP Single - Pre-Parade<br />
<b>Pistes audio</b><br />
01 - Pre-Parade<br />
02 - Ka Ra Ku Ri<br />
03 - Pre-Parade (off vocal ver.)<br />
04 - Ka Ra Ku Ri (off vocal ver.)<br />
<b>+ 4 images</b><br />
<b>Taille totale</b> 35 Mo.<br />
<br />
<b>T�l�chargements</b><br />
<img src="images/icones/ddl.png">		[ <a href="ost/[Zero] Toradora! OP Single - Pre-Parade.zip">T�l�charger l\'archive .ZIP</a> ]<br />

<img src="images/icones/torrent.png"> 		[ <a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Toradora!%20OP%20Single%20-%20Pre-Parade%20%5BVarious%5D.zip.torrent">Torrent (Nipponsei)</a> ]<br />
	<img src="ost/[Zero] Toradora! ED Single - Vanilla Salt - Horie Yui.jpg" border="0"  style="float : left; display:block; margin-left: 20px;">
<b>Nom</b> [Zero] Toradora! ED Single - Vanilla Salt - Horie Yui<br />
<b>Pistes audio</b><br />
01 - Vanilla Salt<br />
02 - I my me<br />
03 - Vanilla Salt (off vocal ver.)<br />
04 - I my me (off vocal ver.)<br />
<b>+ 4 images</b><br />
<b>Taille totale</b> 42 Mo.<br />
<br />
<b>T�l�chargements</b><br />
<img src="images/icones/ddl.png">		[ <a href="ost/[Zero] Toradora! ED Single - Vanilla Salt - Horie Yui.zip">T�l�charger l\'archive .ZIP</a> ]<br />

<img src="images/icones/torrent.png"> 		[ <a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Toradora!%20ED%20Single%20-%20Vanilla%20Salt%20%5BHorie%20Yui%5D.zip.torrent">Torrent (Nipponsei)</a> ]'));
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Toradora_Cover01.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover01.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover02.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover02.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover03.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover03.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Toradora_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Toradora_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/75812"><img src="http://getpersonas-cdn.mozilla.net/static/1/2/75812/preview.jpg?1261355186" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/92100"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/92100/preview.jpg?1264947658" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/97183"><img src="http://getpersonas-cdn.mozilla.net/static/8/3/97183/preview.jpg?1265514870" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/107104"><img src="http://getpersonas-cdn.mozilla.net/static/0/4/107104/preview.jpg?1266634442" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/111779"><img src="http://getpersonas-cdn.mozilla.net/static/7/9/111779/preview.jpg?1267020347" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/123049"><img src="http://getpersonas-cdn.mozilla.net/static/4/9/123049/preview.jpg?1268381765" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/137800"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/137800/preview.jpg?1268916096" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/129800"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/129800/preview.jpg?1268570882" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/145485"><img src="http://getpersonas-cdn.mozilla.net/static/8/5/145485/preview.jpg?1270054918" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/161326"><img src="http://getpersonas-cdn.mozilla.net/static/2/6/161326/preview.jpg?1270042852" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/169796"><img src="http://getpersonas-cdn.mozilla.net/static/9/6/169796/preview.jpg?1270408779" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/190100"><img src="http://getpersonas-cdn.mozilla.net/static/0/0/190100/preview.jpg?1271618180" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/205389"><img src="http://getpersonas-cdn.mozilla.net/static/8/9/205389/preview.jpg?1273098873" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/204714"><img src="http://getpersonas-cdn.mozilla.net/static/1/4/204714/preview.jpg?1273099951" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/221228"><img src="http://getpersonas-cdn.mozilla.net/static/2/8/221228/preview.jpg?1278446057" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/220075"><img src="http://getpersonas-cdn.mozilla.net/static/7/5/220075/preview.jpg?1278446084" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223130"><img src="http://getpersonas-cdn.mozilla.net/static/3/0/223130/preview.jpg?1275476469" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223131"><img src="http://getpersonas-cdn.mozilla.net/static/3/1/223131/preview.jpg?1275476559" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/229455"><img src="http://getpersonas-cdn.mozilla.net/static/5/5/229455/preview.jpg?1276434404" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/223134"><img src="http://getpersonas-cdn.mozilla.net/static/3/4/223134/preview.jpg?1275477090" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/246423"><img src="http://getpersonas-cdn.mozilla.net/static/2/3/246423/preview.jpg?1278221246" border="0" alt="Toradora theme firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/247218"><img src="http://getpersonas-cdn.mozilla.net/static/1/8/247218/preview.jpg?1278329550" border="0" alt="Toradora theme firefox" /></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t357-Ton-avis-sur-Toradora.htm");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kujibiki", "Kujibiki Unbalance II");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Kujibiki Unbalance 2006");
			$project->setOfficialWebsite(Link::newWindowLink("http://kujian.info/index.html", "Kujian.info"));
			$project->setAiringYear(2006);
			$project->setStudio(Link::newWindowLink("http://www.genco.co.jp/", "Genco"));
			$project->setGenre("Com�die");
			$project->setAuthor("Kio Shimoku");
			$project->setSynopsis("C'est la rentr�e pour Chihiro et Tokino. Un tirage au sort est organis� pour d�terminer les r�les de chacun au sein de l'�tablissement. Chihiro, connu pour �tre malchanceux, semble avoir tir� le gros lot... ou pas.");
			$project->setVosta('Yu');
			$project->addBonus(new ProjectBonus("La Saison 1", "Ces deux \"saisons\" n'ont rien � voir l'une avec l'autre. Ce sont les m�mes personnages et la m�me histoire (pas tout � fait) mais racont� diff�remment. Pas besoin d'avoir vu la saison 1 pour voir la saison 2. M�me si vous n'avez pas aim� la saison 1, vous aimerez peut-�tre la saison 2 et inversement ! Il faut donc les voir comme deuz s�ries compl�tement diff�rentes.<br />
Les 3 �pisodes de la saison 1 sont disponibles en Bonus sur le DVD de Genshiken. C'est Kaze qui a acquit la licence.<br />
<div class=\"center\"><a href=\"http://www.kaze.fr/boutique/fiche_produit.php?p=e56b06c51e1049195d7b26d043c478a0&typeproduit=1\" target=\"_blank\"><img src=\"http://www.kaze.fr/images/boutique/produits/images/genshiken_integrale_collector.jpg\" alt=\"DVD Genshiken Kaze\" /></a></div>"));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Genshiken%20%26%20Kujibiki%20Unbalance%20Best%20Album%20-%20Songs%20for%20Young%20%26%20Silly%20Age.zip.torrent">[Nipponsei] Genshiken &amp; Kujibiki Unbalance Best Album - Songs for Young &amp; Silly Age.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kujibiki%20Unbalance%20Kaichou%20Mini%20Album%20-%20Forget%20%5BKoshimizu%20Ami%5D.zip.torrent">[Nipponsei] Kujibiki Unbalance Kaichou Mini Album - Forget [Koshimizu Ami].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kujibiki%20Unbalance%20Original%20Soundtrack.zip.torrent">[Nipponsei] Kujibiki Unbalance Original Soundtrack.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kujibiki%20Unbalance%20ED%20Single%20-%20Harmonies%20%5BNonaka%20Ai%20%26%20Koshimizu%20Ami%5D.zip.torrent">[Nipponsei] Kujibiki Unbalance ED Single - Harmonies [Nonaka Ai &amp; Koshimizu Ami].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kujibiki%20Unbalance%20OP%20Single%20-%20Ai%20%5BAtsumi%20Saori%5D.zip.torrent">[Nipponsei] Kujibiki Unbalance OP Single - Ai [Atsumi Saori].zip</a>'));
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
<a href="images/cover/[Zero]Kujibiki_Unbalance2_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Kujibiki_Unbalance2_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Images & Wallpaper", ' <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image01.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image01.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image02.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image02.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image03.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image03.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image04.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image04.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image05.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image05.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image06.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image06.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image07.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image07.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image08.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image08.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image09.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image09.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image10.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image10.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image11.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image11.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=11#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image12.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image12.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=12#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image13.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image13.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=13#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image14.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image14.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kujibiki%20Unbalance&amp;spgmPic=14#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kujibiki%20Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image15.jpg" alt="gal/Zero_fansub/Images/Kujibiki Unbalance/_thb_[Zero]Kujibiki_Unbalance_Image15.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t253-Ton-avis-sur-Kujibiki-Unbalance-2006.htm");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("genshiken", "Genshiken II");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Genshiken 2");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.genshiken.info/", "Genshiken.info"));
			$project->setAiringYear(2007);
			$project->setStudio(Link::newWindowLink("http://www.genco.co.jp/", "Genco"));
			$project->setGenre("Com�die");
			$project->setAuthor("Kio Shimoku");
			$project->setSynopsis("L�ancien pr�sident du club Genshiken ayant eu son dipl�me l�ann�e derni�re, Sasahara se voit nommer par les autres membres pour lui succ�der. En ce d�but d�ann�e, la venue de deux nouvelles personnes au sein du club s�accompagne d�une autre bonne surprise. En effet, nos fid�les otakus ont re�u pour la premi�re fois l�autorisation de participer au Comi-Fes (convention de jap'anime). L��quipe en effervescence d�cide de cr�er un doujinshi que Ohno vendra en tenue de cosplay. Ogiue quant � elle, montre qu�elle poss�de un talent assez �tonnant pour le dessin. Gr�ce � cela, il ne reste au club plus qu�� pr�voir les divers pr�paratifs mat�riels et financiers n�cessaires pour le jour J. Toujours dans la bonne humeur et l�amusement, les membres de Genshiken semblent ainsi faire un nouveau pas dans l�univers des otakus.");
			$project->setVosta('<a href="http://dattebayo.com/" target="_blank">Dattebayo US</a>');
			$project->addBonus(new ProjectBonus("La Saison 1", '<div style="float : right; display:block; margin-right: 20px;">
	<img src="images/autre/genshikendvd.jpg" border="0" width="100"><img src="http://www.discountmanga.fr/images/927754.pid.jpg" border="0" width="100">
</div>
<p>
<b>R�sum�</b> La rentr�e des classes a enfin lieu et Sasahara, jeune �tudiant timide, se d�cide � int�grer une association. Le choix se r�v�le particuli�rement ardu pour notre h�ros et finalement, celui-ci va rejoindre le Genshiken (�Gendai Shikaku Bunka Kenkyuu Kai�), un club o� se retrouve de jeunes otakus. Sasahara, qui ne peut encore admettre qu�il en est un, va peu � peu d�couvrir le monde si particulier des otakus et trouver sa v�ritable place parmi ces jeunes passionn�s de mangas et de jeux vid�os�<br />
La saison 1 de Genshiken est licenci�e en France par <a href="http://www.kaze.fr/" target="_blank">Kaze</a>.<br />
<b>Commander la saison 1 en dvd !</b><br />

<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/DVD+Anime/Genshiken+Integrale+Collector,p936135.html" target="_blank">Genshiken - Int�grale collector (Coffret Collector 4 DVD) <b>48.99�</b></a><br />

<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/DVD+Anime/Genshiken+Coffret+VOVF+1+2,p927498.html" target="_blank">Genshiken VF Box.1 (Coffret Pack 2 DVD) �pisodes 1 � 6 + 2 OAV Kujibiki Unbalance <b>41.99</b></a><br />

<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/DVD+Anime/Genshiken+Coffret+VOVF+2+2,p927754.html" target="_blank">Genshiken VF Box.2 (Coffret Pack 2 DVD) �pisodes 7 � 12 + 1 OAV Kujibiki Unbalance <b>41.99�</b></a><br />
</p>'));
			$project->addBonus(new ProjectBonus("Le manga", '<div style="float : right; display:block; margin-right: 20px;">
	<img src="images/autre/genshikenmanga.jpg" border="0">
</div>
<p>
<b>R�sum�</b> Kanji Sasahara rentre en premi�re ann�e � l\'universit� S. Grand fan de mangas et d\'animes, il recherche un club �tudiant o� il pourrait partager cette passion. Un seul semble lui convenir : le � club d\'�tude de la culture visuelle moderne � aussi appel� Genshiken. Malgr� sa timidit� maladive, il tente d\'en apprendre plus sur les activit�s propos�es par ce club. Il va � la rencontre des adh�rents, d\'authentiques otakus, qui le pi�gent et lui font passer un test avant de l\'accueillir officiellement. Le jeune homme va alors d�couvrir un univers o� pr�ne la connaissance des mangas et des jeux vid�o, un v�ritable parcours initiatique � travers la sous-culture contemporaine nippone.<br />
<b>Commander les mangas !</b><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p927469.html" target="_blank">Tome 1 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p927470.html" target="_blank">Tome 2 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p927471.html" target="_blank">Tome 3 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p930295.html" target="_blank">Tome 4 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p933386.html" target="_blank">Tome 5 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p937336.html" target="_blank">Tome 6 <b>6.55�</b></a><br />
<img src="images/icones/puce.png"> <a href="http://www.discountmanga.fr/Mangas+VF/Genshiken,p939954.html" target="_blank">Tome 7 <b>6.55�</b></a><br />
</p>'));
			$project->addBonus(new ProjectBonus("Divers", '<div class="p" style="text-align:left;">Pack de Bonus comprenant :<br />
<ul>
<li>Diverses images,</li>
<li>Des photos de cosplay,</li>
<li>Les screenshots des �pisodes,</li>
<li>Les musiques de l\'opening et de l\'ending,</li>
<li>Une jaquette dvd pour d�corer vos dvds grav�.</li>
</ul>
[ <a href="ddl/[Zero]Genshiken_2_Pack_Bonus.zip">T�l�charger le pack !</a> ]</div>'));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Genshiken%202%20Original%20Soundtrack.zip.torrent" target="_blank">[Nipponsei] Genshiken 2 Original Soundtrack.zip	02-09 02:21	143.30 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Genshiken%20%26%20Kujibiki%20Unbalance%20Best%20Album%20-%20Songs%20for%20Young%20%26%20Silly%20Age.zip.torrent" target="_blank">[Nipponsei] Genshiken & Kujibiki Unbalance Best Album - Songs for Young & Silly Age.zip	12-23 18:00	127.25 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Genshiken%202%20ED%20Single%20-%20Clubhouse%20Sandwich%20%5BYuumao%5D.zip.torrent" target="_blank">[Nipponsei] Genshiken 2 ED Single - Clubhouse Sandwich [Yuumao].zip	11-08 21:44	45.59 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Genshiken%202%20OP%20Single%20-%20disarm%20dreamer%20%5BMisato%20Aki%5D.zip.torrent" target="_blank">[Nipponsei] Genshiken 2 OP Single - disarm dreamer [Misato Aki].zip	10-24 01:51	47.29 MB</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20OVA%20Genshiken%20OP%20Single%20-%20Seishun%20to%20Shite%20%5Bmanzo%5D.zip.torrent" target="_blank">[Nipponsei] OVA Genshiken OP Single - Seishun to Shite [manzo].zip	01-16 06:00	33.03 MB</a>'));
			$project->addBonus(new ProjectBonus("Images & Wallpaper", '<a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image01.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image01.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image02.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image02.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image03.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image03.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image04.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image04.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image05.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image05.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image06.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image06.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image07.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image07.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image08.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image08.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image09.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image09.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image10.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image10.jpg" class="img-thumbnail" width="150" height="150"></a><a href="galerie/index.php?spgmGal=Zero_fansub/Images/Genshiken&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image11.jpg" alt="galerie/gal/Zero_fansub/Images/Genshiken/_thb_[Zero]Genshiken_Image11.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t254-Ton-avis-sur-Genshiken-II.htm");
			$project->setFinished(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("canaan", "Canaan");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Canaan");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.canaan.jp/", "Canaan.jp"));
			$project->setAiringYear(2009);
			$project->setStudio("PA Works");
			$project->setGenre("Enigme et Policier");
			$project->setSynopsis("Deux journalistes, Mino-san et sa partenaire sont envoy�s pour couvrir un �v�nement culturel dans la ville de Shanghai. En raison de certaines circonstances cette derni�re se retrouve seule au milieu de cette manifestation festive. Elle sera alors brutalement m�l�e � une situation critique au mauvais endroit, au mauvais moment mais c'est alors que surgit Canaan, une jeune mercenaire victime de guerre.");
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
	<a href="images/cover/[Zero]Canaan_Cover01.jpg" target="_blank">
	<img src="images/cover/[Zero]Canaan_Cover01.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Canaan_Cover02.jpg" target="_blank">
	<img src="images/cover/[Zero]Canaan_Cover02.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Canaan_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]Canaan_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
	<a href="images/cover/[Zero]Canaan_Label.jpg" target="_blank">
	<img src="images/cover/[Zero]Canaan_Label.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Canaan%20Inspired%20Album.zip.torrent">[Nipponsei] Canaan Inspired Album.zip</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Canaan%20Insert%20Song%20Single%20-%20China%20Kibun%20de%20High%20Tension%21%20%5BTakagaki%20Ayahi%5D.zip.torrent">[Nipponsei] Canaan Insert Song Single - China Kibun de High Tension! [Takagaki Ayahi].zip</a><br />
<a href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Canaan%20ED%20Single%20-%20My%20heaven%20%5BAnnabel%5D.zip.torrent">[Nipponsei] Canaan ED Single - My heaven [Annabel].zip</a>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/82036"><img src="http://getpersonas-cdn.mozilla.net/static/3/6/82036/preview.jpg?1264168415" border="0" alt="Canaan theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/124946"><img src="http://getpersonas-cdn.mozilla.net/static/4/6/124946/preview.jpg?1268429074" border="0" alt="Canaan theme skin persona mozilla firefox" /></a>'));
			$project->addBonus(new ProjectBonus("Wallpaper & Images", '<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image1.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image1.jpg" class="img-thumbnail" width="150" height="150"></a><a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image10.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image10.jpg" class="img-thumbnail" width="150" height="150"></a> <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image11.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image11.jpg" class="img-thumbnail" width="150" height="150"></a><a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image12.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image12.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image13.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image13.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image14.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image14.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image15.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image15.jpg" class="img-thumbnail" width="150" height="150"></a> 
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image16.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image16.jpg" class="img-thumbnail-selected" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image17.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image17.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image18.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image18.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image19.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image19.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=11#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image2.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image2.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=12#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image20.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image20.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=13#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image21.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image21.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=14#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image22.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image22.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=15#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image23.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image23.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=16#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image24.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image24.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=17#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image25.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image25.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=18#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image26.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image26.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=19#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image27.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image27.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=20#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image28.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image28.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=21#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image29.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image29.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=22#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image3.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image3.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=23#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image30.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image30.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=24#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image31.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image31.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=25#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image32.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image32.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=26#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image33.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image33.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=27#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image34.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image34.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=28#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image4.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image4.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=29#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image5.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image5.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=30#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image6.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image6.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=31#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image7.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image7.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=32#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image8.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image8.jpg" class="img-thumbnail" width="150" height="150"></a>
<a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Canaan&amp;spgmPic=33#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image9.jpg" alt="gal/Zero_fansub/Images/Canaan/_thb_[Zero]Canaan_Image9.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setFinished(true);
			$project->setLicense(License::getDefaultLicense());
			Project::$allProjects[] = $project;
			
			$project = new Project("kissxsis", "KissXsis TV");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Kiss�sis (2010)");
			$project->setOfficialWebsite(Link::newWindowLink("http://kc.kodansha.co.jp/kiss_sis/", "kc.kodansha.co.jp/kiss_sis"));
			$project->setAiringYear(2010);
			$project->setGenre("Com�die Ecchi");
			$project->setAuthor("Ditawa Bow");
			$project->setSynopsis("Keita a deux grandes demi-soeurs, Ako et Riko, mais puisqu'ils ne sont pas li�s par le sang, elles l'aiment d'une fa�on assez lascive. Apr�s une infortune � l'�cole, Ako et Riko lui avouent finalement leur amour. Keita n'aime pas la pens�e d'�tre plus que fr�re et soeur, mais comme il essaye d'entrer � la m�me �cole que ses soeurs, il devient lentement attir� par elles.");
			$project->setVosta("Subdesu");
			$project->addBonus(new ProjectBonus("Scantrad (Manga)", 'Ces mangas sont traduits par l\'�quipe de Scantrad Fran�aise <a href="http://www.ecchi-scan.com/" target="_blank">Ecchi-no-chikara <img src="images/partenaires/ecchi.png" /></a> et <a href="http://kouhaiscantrad.wordpress.com" target="_blank">Kouhai Scantrad <img src="images/partenaires/kouhai.jpg" /></a><br />
Si vous aimez leur travail, allez les remercier sur leur site !<br /><br />
<img src="images/autre/kxstome1.jpg" alt="Kiss X Sis tome 1" style="float:right;"/>
<a href="http://www.megaupload.com/?d=N0GUHPBW" target="_blank">Chapitre 00</a><br />
<a href="http://www.megaupload.com/?d=VLK1J43B" target="_blank">Chapitre 01</a><br />
<a href="http://www.megaupload.com/?d=PR61TD9L" target="_blank">Chapitre 02</a><br />
<a href="http://www.megaupload.com/?d=C5WX2GE2" target="_blank">Chapitre 03</a><br />
<a href="http://www.megaupload.com/?d=MGLWWRLN" target="_blank">Chapitre 04</a><br />
<a href="http://www.mediafire.com/?njzwnmdmmwx" target="_blank">Chapitre 05</a><br />
<a href="http://www.multiupload.com/QKV5Q4QC9I" target="_blank">Chapitre 06</a><br />
<a href="http://www.multiupload.com/IE23SC2GST" target="_blank">Tome 01 (Chapitres 01 a 06)</a><br />
<a href="http://www.multiupload.com/6N9GJIPN5B" target="_blank">Chapitre 07</a><br />
<a href="http://www.multiupload.com/A9A6UWFB2M" target="_blank">Chapitre 08</a><br />
<a href="http://www.multiupload.com/C5UAALT969" target="_blank">Chapitre 09</a><br />'));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />

<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20Character%20Song%20%26%20Soundtrack.zip.torrent">[Nipponsei] Kiss X Sis Character Song &amp; Soundtrack.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20Character%20Song%20Mini%20Album%20-%20Anata%20ni%20kiss.zip.torrent">[Nipponsei] Kiss X Sis Character Song Mini Album - Anata ni kiss.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20ED%20Single%20-%20Our%20Steady%20Boy%20%5BOgura%20Yui%20%26%20Ishihara%20Kaori%5D.zip.torrent">[Nipponsei] Kiss X Sis ED Single - Our Steady Boy [Ogura Yui &amp; Ishihara Kaori].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20OP%20Single%20-%20Balance%20KISS%20%5BTaketatsu%20Ayana%20%26%20Tatsumi%20Yuiko%5D.zip.torrent">[Nipponsei] Kiss X Sis OP Single - Balance KISS [Taketatsu Ayana &amp; Tatsumi Yuiko].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20OAD%20OP%20Single%20-%20Futari%20no%20Honey%20Boy%20%5BTaketatsu%20Ayana%20%26%20Tatsumi%20Yuiko%5D.zip.torrent">[Nipponsei] Kiss X Sis OAD OP Single - Futari no Honey Boy [Taketatsu Ayana &amp; Tatsumi Yuiko].zip</a>'));
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
<a href="images/cover/[Zero]KissXsis_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]KissXsis_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/206137"><img src="http://getpersonas-cdn.mozilla.net/static/3/7/206137/preview.jpg?1273191168" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/183962"><img src="http://getpersonas-cdn.mozilla.net/static/6/2/183962/preview.jpg?1271231940" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/237172"><img src="http://getpersonas-cdn.mozilla.net/static/7/2/237172/preview.jpg?1277448525" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a>'));
			$project->addBonus(new ProjectBonus("Images & Wallpaper", '    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image01.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image01.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image02.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image02.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image03.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image03.jpg" class="img-thumbnail" width="150" height="150"></a> 
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image04.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image04.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image05.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image05.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image06.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image06.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image07.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image07.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image08.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image08.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image09.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image09.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image10.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image10.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image11.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image11.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=11#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image12.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image12.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=12#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image13.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image13.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=13#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image14.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image14.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=14#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image15.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image15.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=15#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image16.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image16.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=16#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image17.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image17.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=17#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image18.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image18.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=18#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image19.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image19.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=19#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image20.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image20.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=20#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image21.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image21.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=21#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image22.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image22.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=22#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image23.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image23.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=23#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image24.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image24.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=24#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image25.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image25.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=25#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image26.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image26.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=26#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image27.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image27.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=27#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image28.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image28.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t384-Ton-avis-sur-Kiss-X-Sis.htm");
			$project->setRunning(true);
			Project::$allProjects[] = $project;
			
			$project = new Project("kissxsisoav", "KissXsis OAD");
			$project->setExternalSource(Link::newWindowLink("http://animeka.com/fansub/teams/zero.html", "Animeka"));
			$project->setOriginalName("Kiss�sis");
			$project->setOfficialWebsite(Link::newWindowLink("http://www.yanmaga.kodansha.co.jp/ym/rensai/bessatu/kissxsis/kiss.html", "Yamaga.kodansha.co.jp"));
			$project->setAiringYear(2008);
			$project->setGenre("Ecchi");
			$project->setAuthor("Ditawa Bow");
			$project->setSynopsis("Ako et Riko sont deux soeurs jumelles. Toutes les deux sont amoureuses de leur fr�re par alliance, Keita, avec qui elles n'ont aucun lien de sang.");
			$project->setVosta("Anonymous et AKFDP");
			$project->addBonus(new ProjectBonus("Scantrad (Manga)", 'Ces mangas sont traduits par l\'�quipe de Scantrad Fran�aise <a href="http://www.ecchi-scan.com/" target="_blank">Ecchi-no-chikara <img src="images/partenaires/ecchi.png" /></a> et <a href="http://kouhaiscantrad.wordpress.com" target="_blank">Kouhai Scantrad <img src="images/partenaires/kouhai.jpg" /></a><br />
Si vous aimez leur travail, allez les remercier sur leur site !<br /><br />
<img src="images/autre/kxstome1.jpg" alt="Kiss X Sis tome 1" style="float:right;"/>
<a href="http://www.megaupload.com/?d=N0GUHPBW" target="_blank">Chapitre 00</a><br />
<a href="http://www.megaupload.com/?d=VLK1J43B" target="_blank">Chapitre 01</a><br />
<a href="http://www.megaupload.com/?d=PR61TD9L" target="_blank">Chapitre 02</a><br />
<a href="http://www.megaupload.com/?d=C5WX2GE2" target="_blank">Chapitre 03</a><br />
<a href="http://www.megaupload.com/?d=MGLWWRLN" target="_blank">Chapitre 04</a><br />
<a href="http://www.mediafire.com/?njzwnmdmmwx" target="_blank">Chapitre 05</a><br />
<a href="http://www.multiupload.com/QKV5Q4QC9I" target="_blank">Chapitre 06</a><br />
<a href="http://www.multiupload.com/IE23SC2GST" target="_blank">Tome 01 (Chapitres 01 a 06)</a><br />
<a href="http://www.multiupload.com/6N9GJIPN5B" target="_blank">Chapitre 07</a><br />
<a href="http://www.multiupload.com/A9A6UWFB2M" target="_blank">Chapitre 08</a><br />
<a href="http://www.multiupload.com/C5UAALT969" target="_blank">Chapitre 09</a><br />'));
			$project->addBonus(new ProjectBonus("OST", 'Ces OST vous sont propos�es par Nipponsei.<br />
Les principales chansons de cette s�rie sont disponibles en DDL <a href="radio/mp3" target="_blank">Lien</a> ou directement �coutable sur <a href="radio" target="_blank">la radio</a>.<br />

<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20Character%20Song%20%26%20Soundtrack.zip.torrent">[Nipponsei] Kiss X Sis Character Song &amp; Soundtrack.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20Character%20Song%20Mini%20Album%20-%20Anata%20ni%20kiss.zip.torrent">[Nipponsei] Kiss X Sis Character Song Mini Album - Anata ni kiss.zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20ED%20Single%20-%20Our%20Steady%20Boy%20%5BOgura%20Yui%20%26%20Ishihara%20Kaori%5D.zip.torrent">[Nipponsei] Kiss X Sis ED Single - Our Steady Boy [Ogura Yui &amp; Ishihara Kaori].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20OP%20Single%20-%20Balance%20KISS%20%5BTaketatsu%20Ayana%20%26%20Tatsumi%20Yuiko%5D.zip.torrent">[Nipponsei] Kiss X Sis OP Single - Balance KISS [Taketatsu Ayana &amp; Tatsumi Yuiko].zip</a><br />
<a class="download" href="http://tracker.minglong.org/torrents/%5BNipponsei%5D%20Kiss%20X%20Sis%20OAD%20OP%20Single%20-%20Futari%20no%20Honey%20Boy%20%5BTaketatsu%20Ayana%20%26%20Tatsumi%20Yuiko%5D.zip.torrent">[Nipponsei] Kiss X Sis OAD OP Single - Futari no Honey Boy [Taketatsu Ayana &amp; Tatsumi Yuiko].zip</a>'));
			$project->addBonus(new ProjectBonus("Jaquette(s) DVD", '<h4>Source : <a href="http://www.animecoversfan.com" target="_blank">AnimeCoversFan</a></h4>
<p>
<a href="images/cover/[Zero]KissXsis_Cover.jpg" target="_blank">
	<img src="images/cover/[Zero]KissXsis_Cover.png" alt="Jaquette DVD" border="0" width="200" /></a> 
</p>'));
			$project->addBonus(new ProjectBonus("Th�mes pour Firefox (Skin Persona)", '<a target="_blank" href="http://www.getpersonas.com/en-US/persona/206137"><img src="http://getpersonas-cdn.mozilla.net/static/3/7/206137/preview.jpg?1273191168" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/183962"><img src="http://getpersonas-cdn.mozilla.net/static/6/2/183962/preview.jpg?1271231940" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a> 
<a target="_blank" href="http://www.getpersonas.com/en-US/persona/237172"><img src="http://getpersonas-cdn.mozilla.net/static/7/2/237172/preview.jpg?1277448525" border="0" alt="KissXsis Kiss X Sis theme skin persona mozilla firefox" /></a>'));
			$project->addBonus(new ProjectBonus("Images & Wallpaper", '    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=0#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image01.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image01.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=1#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image02.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image02.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=2#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image03.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image03.jpg" class="img-thumbnail" width="150" height="150"></a> 
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=3#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image04.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image04.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=4#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image05.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image05.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=5#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image06.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image06.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=6#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image07.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image07.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=7#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image08.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image08.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=8#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image09.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image09.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=9#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image10.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image10.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=10#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image11.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image11.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=11#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image12.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image12.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=12#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image13.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image13.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=13#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image14.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image14.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=14#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image15.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image15.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=15#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image16.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image16.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=16#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image17.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image17.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=17#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image18.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image18.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=18#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image19.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image19.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=19#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image20.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image20.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=20#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image21.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image21.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=21#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image22.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image22.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=22#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image23.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image23.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=23#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image24.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image24.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=24#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image25.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image25.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=25#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image26.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image26.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=26#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image27.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image27.jpg" class="img-thumbnail" width="150" height="150"></a>
    <a target="_blank" href="galerie/index.php?spgmGal=Zero_fansub/Images/Kiss%20X%20Sis&amp;spgmPic=27#spgmPicture" class=""><img src="galerie/gal/Zero_fansub/Images/Kiss%20X%20Sis/_thb_[Zero]Kiss_x_Sis_Image28.jpg" alt="galerie/gal/Zero_fansub/Images/Kiss X Sis/_thb_[Zero]Kiss_x_Sis_Image28.jpg" class="img-thumbnail" width="150" height="150"></a>'));
			$project->setDiscussionUrl("http://zero.xooit.fr/t384-Ton-avis-sur-Kiss-X-Sis.htm");
			$project->setRunning(true);
			Project::$allProjects[] = $project;
		}
		
		return Project::$allProjects;
	}
	
	public static function getNonHentaiProjects($getHiddenProjects = false) {
		$projects = array();
		foreach(Project::getAllProjects() as $project) {
			if (!$project->isHentai() && (!$project->isHidden() || $getHiddenProjects)) {
				$projects[] = $project;
			}
		}
		return $projects;
	}
	
	public static function getHentaiProjects($getHiddenProjects = false) {
		$projects = array();
		foreach(Project::getAllProjects() as $project) {
			if ($project->isHentai() && (!$project->isHidden() || $getHiddenProjects)) {
				$projects[] = $project;
			}
		}
		return $projects;
	}
	
	public static function getProject($id) {
		foreach(Project::getAllProjects() as $project) {
			if ($project->getID() === $id) {
				return $project;
			}
		}
		throw new Exception($id." is not a known project ID.");
	}
	
	private static $allLinks = null;
	public static function getAllProjectLinks() {
		if (Project::$allLinks === null) {
			Project::$allLinks = array();
			
			Project::$allLinks[] = array(Project::getProject('eriko'), Project::getProject('kimikiss'));
			Project::$allLinks[] = array(Project::getProject('working'), Project::getProject('working2'));
			Project::$allLinks[] = array(Project::getProject('kissxsis'), Project::getProject('kissxsisoav'));
			Project::$allLinks[] = array(Project::getProject('hyakko'), Project::getProject('hyakkooav'));
			Project::$allLinks[] = array(Project::getProject('toradora'), Project::getProject('toradorasos'));
			Project::$allLinks[] = array(Project::getProject('tayutama'), Project::getProject('tayutamapure'));
			Project::$allLinks[] = array(Project::getProject('sketchbook'), Project::getProject('sketchbookdrama'));
			Project::$allLinks[] = array(Project::getProject('potemayo'), Project::getProject('potemayooav'));
			Project::$allLinks[] = array(Project::getProject('genshiken'), Project::getProject('kujibiki'));
			Project::$allLinks[] = array(Project::getProject('kanamemo'), Project::getProject('kanamemobook'));
			Project::$allLinks[] = array(Project::getProject('bath'), Project::getProject('training'));
			Project::$allLinks[] = array(Project::getProject('bath'), Project::getProject('sleeping'));
			Project::$allLinks[] = array(Project::getProject('bath'), Project::getProject('akinahshiyo'));
			Project::$allLinks[] = array(Project::getProject('bath'), Project::getProject('hshiyo'));
			Project::$allLinks[] = array(Project::getProject('sleeping'), Project::getProject('training'));
			Project::$allLinks[] = array(Project::getProject('sleeping'), Project::getProject('hshiyo'));
			Project::$allLinks[] = array(Project::getProject('sleeping'), Project::getProject('akinahshiyo'));
			Project::$allLinks[] = array(Project::getProject('akinahshiyo'), Project::getProject('training'));
			Project::$allLinks[] = array(Project::getProject('akinahshiyo'), Project::getProject('hshiyo'));
			Project::$allLinks[] = array(Project::getProject('hshiyo'), Project::getProject('training'));
			Project::$allLinks[] = array(Project::getProject('konoe'), Project::getProject('kodomo'));
			Project::$allLinks[] = array(Project::getProject('konoe'), Project::getProject('kodomooav'));
			Project::$allLinks[] = array(Project::getProject('konoe'), Project::getProject('kodomofilm'));
			Project::$allLinks[] = array(Project::getProject('konoe'), Project::getProject('kodomonatsu'));
			Project::$allLinks[] = array(Project::getProject('konoe'), Project::getProject('kodomo2'));
			Project::$allLinks[] = array(Project::getProject('kodomofilm'), Project::getProject('kodomo'));
			Project::$allLinks[] = array(Project::getProject('kodomofilm'), Project::getProject('kodomooav'));
			Project::$allLinks[] = array(Project::getProject('kodomofilm'), Project::getProject('kodomonatsu'));
			Project::$allLinks[] = array(Project::getProject('kodomofilm'), Project::getProject('kodomo2'));
			Project::$allLinks[] = array(Project::getProject('kodomonatsu'), Project::getProject('kodomo'));
			Project::$allLinks[] = array(Project::getProject('kodomonatsu'), Project::getProject('kodomooav'));
			Project::$allLinks[] = array(Project::getProject('kodomonatsu'), Project::getProject('kodomo2'));
			Project::$allLinks[] = array(Project::getProject('kodomo2'), Project::getProject('kodomo'));
			Project::$allLinks[] = array(Project::getProject('kodomo2'), Project::getProject('kodomooav'));
			Project::$allLinks[] = array(Project::getProject('kodomooav'), Project::getProject('kodomo'));
		}
		
		return Project::$allLinks;
	}
	
	public static function getProjectsLinkedTo(Project $project) {
		$list = array();
		foreach(Project::getAllProjectLinks() as $link) {
			if ($link[0] == $project) {
				$list[] = $link[1];
			}
			else if ($link[1] == $project) {
				$list[] = $link[0];
			}
			else {
				// nothing to do
			}
		}
		
		return $list;
	}
}

class ProjectBonus {
	private $title = null;
	private $content = null;
	
	public function __construct($title, $content) {
		$this->title = $title;
		$this->content = $content;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getContent() {
		return $this->content;
	}
}
?>
