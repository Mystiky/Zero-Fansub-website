<?php
class ProjectComponent extends SimpleBlockComponent {
	public function __construct(Project $project) {
		$title = new Title($project->getName(), 3);
		$title->setClass('projectTitle');
		$this->addComponent($title);
		
		$image = new Image('images/series/'.$project->getID().'.jpg');
		$image->setClass('projectPicture');
		$this->addComponent($image);
		
		$this->addComponent(new Title("Informations g�n�rales", 2));
		if ($project->hasExternalSource()) {
			$subtitle = new Title("Source : ", 4);
			$subtitle->addComponent($project->getExternalSource());
			$this->addComponent($subtitle);
		}
		
		$array = array(
			array("Titre Original", $project->getOriginalName()),
			array("Site officiel", $project->getOfficialWebsite()),
			array("Ann�e de production", $project->getAiringYear()),
			array("Studio", $project->getStudio()),
			array("Auteur", $project->getAuthor()),
			array("Genre", $project->getGenre()),
			array("Synopsis", $project->getSynopsis()),
		);
		$infos = new SimpleTextComponent();
		$infos->setClass('projectInfos');
		foreach($array as $data) {
			if ($data[1] !== null) {
				$text = new SimpleTextComponent("<b>".$data[0]."</b> ");
				$text->addComponent($data[1]);
				$infos->addLine($text);
			}
		}
		$this->addComponent($infos);
		
		$this->addComponent("<p></p>");
		$link = Link::newWindowLink("http://zero.xooit.fr/t471-Liens-morts.htm", "Signaler un lien mort");
		$link->setClass('deadLinks');
		$this->addComponent($link);
		
		$this->addComponent("<p></p>");
		$this->addComponent(new Title($project->isDoujin() ? "Chapitres" : "�pisodes", 2));
		
		$releases = Release::getAllReleasesForProject($project->getID());
		usort($releases, array('ProjectComponent', 'sortReleases'));
		$list = new SimpleListComponent();
		$list->setClass("releaseList");
		foreach($releases as $release)
		{
			$list->addComponent(new ReleaseComponent($release));
		}
		$this->addComponent($list);
		
		$linkedProjects = Project::getProjectsLinkedTo($project);
		if (!empty($linkedProjects)) {
			$this->addComponent("<p></p>");
			$this->addComponent(new Title("Voir aussi", 2));
			
			$list = new ProjectList();
			$list->useImage(true);
			foreach($linkedProjects as $link) {
				$list->addComponent($link);
			}
			$this->addComponent($list);
		}
		
		$skins = $project->getSkins();
		if (!empty($skins)) {
			$this->addComponent("<p></p>");
			$this->addComponent(new Title("Bonus : Th�mes pour Firefox (Skin Persona)", 2));
			
			$list = new SimpleListComponent();
			$list->setClass('skinList');
			foreach($skins as $skin) {
				$list->addComponent($skin);
			}
			$this->addComponent($list);
		}
	}
	
	public function sortReleases(Release $a, Release $b) {
		return strnatcmp($a->getID(), $b->getID());
	}
}
?>