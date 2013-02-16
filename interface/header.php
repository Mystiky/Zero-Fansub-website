<?php
class Sortie {
	private $image = null;
	private $timestamp = null;
	private $releases = array();
	
	public function __construct($timestamp, $image) {
		$this->image = $image;
		$this->timestamp = $timestamp;
	}
	
	public function getImage() {
		return $this->image;
	}
	
	public function getTimestamp() {
		return $this->timestamp;
	}
	
	public function addRelease(Release $release) {
		$this->releases[] = $release;
	}
	
	public function getReleases() {
		return $this->releases;
	}
	
	public function getReleasesIDs() {
		$list = array();
		foreach($this->releases as $release) {
			$list[] = $release->getId();
		}
		return $list;
	}
	
	public function getProject() {
		return $this->releases[0]->getProject();
	}
}

$completeList = null;
if ($_SESSION[MODE_H]) {
	$completeList = Release::getHentaiReleases();
} else {
	$completeList = Release::getNotHentaiReleases();
}
usort($completeList, array('Release', 'releasingSorter'));

$size = 3;
$sorties = array();
$sortie = null;
foreach($completeList as $release) {
	if ($release->isReleased()) {
		$timestamp = $release->getReleasingTime();
		$image = $release->getHeaderImage();
		if ($sortie === null || $sortie->getTimestamp() != $timestamp || strcmp($sortie->getImage(), $image) !== 0) {
			if (count($sorties) == $size) {
				break;
			}
			$sortie = new Sortie($timestamp, $image);
			$sorties[count($sorties)] = $sortie;
		}
		$sortie->addRelease($release);
	} else {
		continue;
	}
}

$list = new SimpleListComponent();
$list->setClass("sortieList");
krsort($sorties);
foreach($sorties as $sortie) {
	$link = Link::createReleaseLink($sortie->getProject()->getID(), $sortie->getReleasesIDs());
	$link->setContent(new Image($sortie->getImage(), $sortie->getProject()->getName()));
	$link->setClass("sortie");
	$list->addComponent($link);
}

$header = new SimpleBlockComponent();
$header->setId("header");
$header->addComponent($list);
return $header->getCurrentHTML();
?>