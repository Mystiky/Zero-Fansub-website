<?php
	$page = PageContent::getInstance();
	$page->setTitle("Avertissement");
	
	$page->addComponent(new Archives());
	
	$content = new SimpleBlockComponent();
	$content->setClass("havert");
	$page->addComponent($content);
	
	$content->addComponent(new Image("images/news/avert.jpg"));
	$content->addComponent(new Title("Vous �tes sur le point d'entrer dans la zone Henta�", 2));
	$content->addComponent(new SimpleParagraphComponent("Comme son nom l'indique, cette partie regorge de machins d�go�tants interdits aux enfants. Mais bon, si vous �tes majeur, vaccin� et consentant, on vous autorise � entrer l�-dedans."));
	$okLink = new Link();
	$okLink->setContent("Je rentre !");
	$url = $okLink->getUrl();
	$url->removeQueryVar(DISPLAY_H_AVERT);
	$url->setQueryVar(DISPLAY_H, true);
	$content->addComponent($okLink);
	$content->addComponent(new Link(Url::indexUrl(), "Je sors..."));
?>
