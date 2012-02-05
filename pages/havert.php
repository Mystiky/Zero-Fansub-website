<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("Avertissement", 1));
	
	$content = new SimpleBlockComponent();
	$content->setClass("havert");
	$content->addComponent(new Image("images/news/avert.jpg"));
	$content->addComponent(new Title("Vous �tes sur le point d'entrer en mode Henta�", 2));
	$content->addComponent("Comme son nom l'indique, vous vous appr�tez � regarder plein de machins d�go�tants interdits aux enfants. Mais bon, si vous �tes majeur, vaccin� et consentant, on vous y autorise.");
	$content->addComponent(Format::convertTextToHTML("[separator]"));
	
	$okLink = new Link();
	$okLink->setContent("Montrer les machins d�goutants");
	$url = $okLink->getUrl();
	$url->removeQueryVar(DISPLAY_H_AVERT);
	$url->setQueryVar(MODE_H, true);
	$content->addComponent($okLink);
	
	$cancelLink = new Link(Url::indexUrl(), "Garder mon �cran propre");
	if (isset($_SERVER["HTTP_REFERER"])) {
		// TODO if the referer is a page needing the H mode, do not use it
		$cancelLink->setUrl(new Url($_SERVER["HTTP_REFERER"]));
	}
	$content->addComponent($cancelLink);
	
	$page->addComponent($content);
?>
