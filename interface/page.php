<?php
	try {
		$url = new Url();
		
		/***************************************\
		         READ GENERIC QUERY VARS
		\***************************************/
		$page = 'home';
		if ($url->hasQueryVar('page')) {
			$page = $url->getQueryVar('page');
		}
		
		$id = null;
		if ($url->hasQueryVar('id')) {
			$id = $url->getQueryVar('id');
		}
		
		/***************************************\
		           SPECIAL FEATURES
		\***************************************/
		if ($url->hasQueryVar(DISPLAY_H_AVERT)) {
			$page = "havert";
		}
		
		/***************************************\
		              PAGE LOADING
		\***************************************/
		if (!in_array($page, array('project', 'home', 'about', 'contact', 'bug', 'projects',
		                           'team', 'xdcc', 'havert', 'dossiers', 'dossier', 'partenariat',
		                           'kanaiiddl', 'recrutement', 'dakko', 'dons', 'dl'))) {
			throw new Exception("Inexistant page ".$page);
		}
		
		try {
			$id = Url::getCurrentUrl();
			$id = $id->getQueryVar('page');
			PageContentComponent::getInstance()->setClass($id);
			
			$page = Page::getPage($id);
			$content = $page->getContent();
			if ($page->useBBCode()) {
				$content = Format::convertTextToHTML($content);
			}
			PageContentComponent::getInstance()->addComponent(new SimpleTextComponent($content));
		} catch(Exception $e) {
			$file = "pages/$page.php";
			if (file_exists($file)) {
				require_once($file);
			} else {
				throw $e;
			}
		}
		PageContentComponent::getInstance()->writeNow();
	} catch(Exception $e) {
echo "a";
		if (TEST_MODE_ACTIVATED) {
			echo '<div id="page">';
			echo 'Invalid URL, the bug page should be displayed in not testing mode.<br/><br/>';
			echo $e->__toString();
			echo '</div>';
		}
		else {
			$pageContent = PageContentComponent::getInstance();
			$pageContent->clear();
			require_once("pages/bug.php");
			$pageContent->writeNow();
		}
	}
?>