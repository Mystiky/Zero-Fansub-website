<?php
	$page = PageContent::getInstance();
	$page->setTitle("Avertissement");
	
	$page->addComponent(new Archives());
	
	$content = new SimpleBlockComponent();
	$content->setClass("havert");
	$page->addComponent($content);
	
	$content->addComponent(new Image("images/news/avert.jpg"));
	$content->addComponent(new Title("Vous �tes sur le point d'entrer en mode Henta�", 2));
	$content->addComponent(new SimpleParagraphComponent("Comme son nom l'indique, vous vous appr�tez � regarder plein de machins d�go�tants interdits aux enfants. Mais bon, si vous �tes majeur, vaccin� et consentant, on vous y autorise."));
	
	$okLink = new Link();
	$okLink->setContent("Montrer les machins d�goutants");
	$url = $okLink->getUrl();
	$url->removeQueryVar(DISPLAY_H_AVERT);
	$url->setQueryVar(DISPLAY_H, true);
	$content->addComponent($okLink);
	
	$cancelLink = new Link(Url::indexUrl(), "Garder mon �cran propre");
	if (isset($_SERVER["HTTP_REFERER"])) {
		$cancelLink->setUrl(new Url($_SERVER["HTTP_REFERER"]));
	}
	$content->addComponent($cancelLink);
?>
