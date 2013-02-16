<?php
	$rightCol = new SimpleBlockComponent();
	$rightCol->setId("colRight");
	
	$logo = new SimpleBlockComponent(); // content set by the style
	$logo->setClass("logo");
	$rightCol->addComponent($logo);
	
	$partners = Partner::getAllPartners();
	$partners = array_filter($partners, function(Partner $partner) {return !$partner->isOver();});
	
	$menu = new Menu("db0 company");
	foreach($partners as $partner) {
		if ($partner->isDb0Company()) {
			$link = Link::createPartnerLink($partner, true);
			$menu->addEntry($link);
		}
	}
	$rightCol->addComponent(new MenuComponent($menu));
	
	$menu = new Menu("Fansub potes");
	foreach($partners as $partner) {
		if ($partner->isFansubPartner()) {
			$link = Link::createPartnerLink($partner, true);
			$menu->addEntry($link);
		}
	}
	$rightCol->addComponent(new MenuComponent($menu));
	
	$menu = new Menu("Liens");
	foreach($partners as $partner) {
		if (!$partner->isFansubPartner() && !$partner->isDb0Company()) {
			$link = Link::createPartnerLink($partner, true);
			$menu->addEntry($link);
		}
	}
	$rightCol->addComponent(new MenuComponent($menu));
	
	$menu = new Menu(new Link("?page=partenariat", "Devenir partenaires"));
	$rightCol->addComponent(new MenuComponent($menu));
	
	return $rightCol->getCurrentHTML();
?>