<?php
	$page = PageContent::getInstance();
	$page->setTitle("S�ries");
	$page->setClass("series");

	$url = new Url();
	$vars = $url->getQueryVars();
	$useImageLists = !array_key_exists('noImage', $vars);
	if ($useImageLists) {
		$url->setQueryVar('noImage');
		$page->addComponent(new Link($url, new Title("Voir la liste sans images", 2)));
	}
	else {
		$url->removeQueryVar('noImage');
		$page->addComponent(new Link($url, new Title("Voir la liste avec images", 2)));
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

	$page->addComponent(new Title("Projets licenci�s", 2));
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

