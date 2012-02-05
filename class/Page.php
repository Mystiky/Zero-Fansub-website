<?php
class Page {
	private $id = null;
	private $content = null;
	private $useBBCode = null;
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setUseBBCode($boolean) {
		$this->useBBCode = $boolean;
	}
	
	public function useBBCode() {
		return $this->useBBCode;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	
	public function getID() {
		return $this->id;
	}
	
	private static $allPages = null;
	public static function getAllPages() {
		if (Page::$allPages === null) {
			Page::$allPages = array();
			
			$page = new Page();
			$page->setID('contact');
			$page->setContent("[title]Contact[/title]


Un commentaire � faire ?
Une critique ?
Un lien mort ?
Une proposition ?
Un lien de streaming ?

Une seule adresse pour contacter la team :


[size=25px][mail]zero.fansub@gmail.com[/mail][/size]");
			$page->setUseBBCode(true);
			Page::$allPages[] = $page;
			
			$page = new Page();
			$page->setID('bug');
			$page->setContent("[title]Signaler un bug[/title]


Le site �tant en plein raffinage, il est possible que vous tombiez sur des bogues (ou bug) au cours de votre navigation. Si tel est le cas, vous retomberez g�n�ralement sur cette page. Par cons�quent, si vous vous trouvez ici sans trop savoir pourquoi, c'est probablement parce que vous venez de tomber sur un de ces bogues. Pour nous le signaler, plusieurs moyens sont � votre disposition :

[url=https://github.com/Sazaju/Zero-Fansub-website/issues]Enregistrer un bug sur GitHub[/url]

[mail=5]Envoyer un mail � l'administrateur Web[/mail]

La premi�re solution est de loin la meilleure, car en plus d'avertir les administrateurs, le probl�me est enregistr� et peut donc �tre suivi efficacement. N�anmoins, si vous ne savez pas comment utiliser ce syst�me, la seconde option vous permet d'envoyer directement un mail aux admins. De pr�f�rence utilisez la premi�re solution, n'utilisez la seconde que si vraiment vous avez des soucis avec la premi�re.

Soyez s�rs de donner le maximum de d�tails, en particulier l'adresse actuelle de la page, la page ou vous �tiez juste avant le bogue, votre navigateur et sa version (ou au moins dire si vous l'avez mis � jour r�cemment), et les plugins ou programmes que vous auriez install� qui vous semble �tre une cause potentielle du probl�me (gestionnaire de scripts, antivirus, ...).

En voici quelques unes, vous pouvez les recopier et les compl�ter :
[left][list]
[item]adresse actuelle : [currentUrl=full][/item]
[item]adresse pr�c�dente : [refererUrl=full][/item]
[item]infos navigateur : [serverData=HTTP_USER_AGENT][/item]
[/list][/left]");
			$page->setUseBBCode(true);
			Page::$allPages[] = $page;
			
			$page = new Page();
			$page->setID('partenariat');
			$page->setContent('[title]Partenariat[/title]
[title=2][url=http://forum.zerofansub.net/t552-Les-regles-d-Or-de-chez-Zero.htm#p17057]Conditions, Offres (a lire avant toute demande !)[/url][/title]
[title=2]Nos banni�res[/title]
[img=images/partenaires/ourbanner/zero_280x45.png]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_280x45.png" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_468x60.png]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_468x60.png" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_500x117.png]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_500x117.png" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_500x150.png]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_500x150.png" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_88x31.png]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_88x31.png" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero.jpg]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero.jpg" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_500x117x.jpg]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_500x117x.jpg" alt="zero"
border="0"></a>[/code]

[img=images/partenaires/ourbanner/zero_500x117xx.jpg]zero[/img]
[code]<a href="http://zerofansub.net"><img
src="http://zerofansub.net/images/partenaires/ourbanner/zero_500x117xx.jpg" alt="zero"
border="0"></a>[/code]');
			$page->setUseBBCode(true);
			Page::$allPages[] = $page;
		}
		return Page::$allPages;
	}
	
	public static function getPage($id) {
		foreach(Page::getAllPages() as $page) {
			if ($page->getID() === $id) {
				return $page;
			}
		}
		throw new Exception($id.' si not a known page ID');
	}
}
?>
