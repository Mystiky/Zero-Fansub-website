<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("Signaler un bug", 1));
	
	$admin = TeamMember::getMemberByPseudo("sazaju HITOKAGE");
	
	$serverInfo = function($id) {
		return isset($_SERVER[$id]) ? $_SERVER[$id] : 'inconnue';
	};
	
	$text = "


Le site �tant en plein raffinage, il est possible que vous tombiez sur des bogues (ou bug) au cours de votre navigation. Si tel est le cas, vous retomberez g�n�ralement sur cette page. Par cons�quent, si vous vous trouvez ici sans trop savoir pourquoi, c'est probablement parce que vous venez de tomber sur un de ces bogues. Pour nous le signaler, plusieurs moyens sont � votre disposition :

[url=https://github.com/Sazaju/Zero-Fansub-website/issues]Enregistrer un bug sur GitHub[/url]

[mail=".$admin->getMail()."]Envoyer un mail � l'administrateur Web[/mail]

La premi�re solution est de loin la meilleure, car en plus d'avertir les administrateurs, le probl�me est enregistr� et peut donc �tre suivi efficacement. N�anmoins, si vous ne savez pas comment utiliser ce syst�me, la seconde option vous permet d'envoyer directement un mail aux admins. De pr�f�rence utilisez la premi�re solution, n'utilisez la seconde que si vraiment vous avez des soucis avec la premi�re.

Soyez s�rs de donner le maximum de d�tails, en particulier l'adresse actuelle de la page, la page ou vous �tiez juste avant le bogue, votre navigateur et sa version (ou au moins dire si vous l'avez mis � jour r�cemment), et les plugins ou programmes que vous auriez install� qui vous semble �tre une cause potentielle du probl�me (gestionnaire de scripts, antivirus, ...).

En voici quelques unes, vous pouvez les recopier et les compl�ter :
[left][list]
[item]adresse actuelle : [urlk=current|full][/urlk][/item]
[item]adresse pr�c�dente : [urlk=referer|full][/urlk][/item]
[item]infos navigateur : ".$serverInfo('HTTP_USER_AGENT')."[/item]
[/list][/left]";
	
	$content = new SimpleTextComponent();
	$content->setClass("bug");
	$content->setContent(Format::convertTextToHtml($text));
	
	$page->addComponent($content);

?> 
