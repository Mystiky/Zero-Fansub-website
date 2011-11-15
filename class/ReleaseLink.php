<?php
/*
	A release link is a link to a specific release.
*/

class ReleaseLink extends IndexLink {
	private $projectId = null;
	private $releaseList = array();
	
	public function __construct($projectId, $releaseList, $content = null) {
		if (!is_array($releaseList)) {
			$releaseList = array($releaseList);
		}
		
		$this->setProjectId($projectId);
		$this->setReleaseList($releaseList);
		
		if ($content === null) {
			$release = Release::getRelease($projectId, $releaseList[0]);
			$content = $release->getCompleteName().(count($releaseList) > 1 ? "+" : "");
		}
		$this->setContent($content);
	}
	
	public function setUrl($url) {
		throw new Exception("You cannot change the URL directly, change the project/release ID.");
	}
	
	public function updateUrl() {
		if (count($this->releaseList) > 0) {
			$list = "";
			$first = null;
			foreach($this->releaseList as $id) {
				if ($first == null) {
					$first = $id;
				}
				$list .= ",".$id;
			}
			$list = substr($list, 1);
			parent::setUrl('page=series/'.$this->projectId.'&show='.$list.'#'.$first);
		}
	}
	
	public function setProjectID($id) {
		$this->projectId = $id;
		$this->updateUrl();
	}
	
	public function getProjectID() {
		return $this->projectId;
	}
	
	public function setReleaseList($list) {
		if (count($list) == 0) {
			throw new Exception("At least one id should be given.");
		}
		$this->releaseList = $list;
		$this->updateUrl();
	}
	
	public function getReleaseList() {
		return $this->releaseList;
	}
}
?>