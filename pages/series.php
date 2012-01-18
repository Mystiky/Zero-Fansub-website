<?php
	$page = PageContent::getInstance();
	$page->setTitle("S�ries");
	$page->setClass("series");

	$url = new Url();
	$vars = $url->getQueryVars();
	$useImageLists = !array_key_exists('noImage', $vars);
	if ($useImageLists) {
		$url->setQueryVar('noImage');
		$link = new Link($url, "Voir la liste sans images");
		$link->setClass('pictureSwitch');
		$page->addComponent($link);
	}
	else {
		$url->removeQueryVar('noImage');
		$link = new Link($url, "Voir la liste avec images");
		$link->setClass('pictureSwitch');
		$page->addComponent($link);
	}

	$licensedProjects = array();
	$notLicensedProjects = array();
	foreach(Project::getNonHentaiProjects() as $project) {
		if (!$project->isDoujin()) {
			if ($project->isLicensed()) {
				$licensedProjects[] = $project;
			} else {
				$notLicensedProjects[] = $project;
			}
		}
	}
	
	$page->addComponent(new Title("Non licenci�s", 2));
	
	$page->addComponent(new Title("Projets en cours", 3));
	$list = new ProjectList();
	$list->useImage($useImageLists);
	$page->addComponent($list);
	foreach($notLicensedProjects as $project) {
		if ($project->isRunning()) {
			$list->addComponent($project);
		}
	}
	
	$page->addComponent(new Title("Projets termin�s", 3));
	$list = new ProjectList();
	$list->useImage($useImageLists);
	$page->addComponent($list);
	foreach($notLicensedProjects as $project) {
		if ($project->isFinished()) {
			$list->addComponent($project);
		}
	}

	$page->addComponent(new Title("Projets abandonn�s", 3));
	$list = new ProjectList();
	$list->useImage($useImageLists);
	$page->addComponent($list);
	foreach($notLicensedProjects as $project) {
		if ($project->isAbandonned()) {
			$list->addComponent($project);
		}
	}

	$page->addComponent(new Title("Projets envisag�s", 3));
	$list = new ProjectList();
	$list->useImage($useImageLists);
	$page->addComponent($list);
	foreach($notLicensedProjects as $project) {
		if (!$project->isStarted() && !$project->isAbandonned()) {
			$list->addComponent($project);
		}
	}

	$page->addComponent(new Title("Licenci�s", 2));
	$list = new ProjectList();
	$list->useImage($useImageLists);
	$page->addComponent($list);
	foreach($licensedProjects as $project) {
		$list->addComponent($project);
	}
	
	$url = new Url();
	$url->setQueryVar('page', 'havert');
	$hentaiLink = new Link($url, "Voir les projets Henta�");
	$hentaiLink->setStyle("text-align: center; font-size: 25px;");
	$page->addComponent($hentaiLink);
?>

