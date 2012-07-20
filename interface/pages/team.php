<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("La Team de fansub", 1));

	$members = TeamMember::getAllCurrentMembers();
	usort($members, array('TeamMember', 'nameSorter'));
	
	$page->addComponent(new Title("Administrateurs", 2));

	$list = new TeamMemberList();
	$page->addComponent($list);
	foreach($members as $member) {
		if ($member->isAdmin()) {
			$list->addComponent($member);
		}
	}

	$page->addComponent(new Title("Membres", 2));

	$list = new TeamMemberList();
	$page->addComponent($list);
	foreach($members as $member) {
		if (!$member->isAdmin()) {
			$list->addComponent($member);
		}
	}

	$page->addComponent(new Title("Seeders, Uploaders", 2));

	$uploaders = array();
	$uploaders[] = "Sazaju HITOKAGE";
	$uploaders[] = "etienne2000";
	$uploaders[] = "lwienlin";
	$uploaders[] = "lepims";
	natcasesort($uploaders);
	
	$list = new SimpleListComponent();
	$page->addComponent($list);
	foreach($uploaders as $uploader) {
		$list->addComponent($uploader);
	}
?>