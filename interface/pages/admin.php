<?php
	$page = PageContent::getInstance();
	$page->setClass('admin');
	$page->addComponent(new Title("Administration BDD", 1));
	
	$db = Database::getDefaultDatabase();
	
	$table = new Table();
	$row = new TableRow();
	$row->setHeader(true);
	$row->addComponent("ID");
	$row->addComponent("VALEUR");
	$table->addComponent($row);
	foreach($db->getProperties() as $id) {
		$row = new TableRow();
		$row->addComponent($id);
		$row->addComponent($db->getProperty($id));
		$table->addComponent($row);
	}
	$page->addComponent(new Title("Propriétés", 2));
	$page->addComponent($table);
	
	$table = new Table();
	$row = new TableRow();
	$row->setHeader(true);
	$row->addComponent("ID");
	$row->addComponent("VALIDE");
	$table->addComponent($row);
	foreach($db->getUsers() as $id) {
		$row = new TableRow();
		$row->addComponent($id);
		$row->addComponent($db->isValidUser($id) ? "oui" : "non");
		$table->addComponent($row);
	}
	$page->addComponent(new Title("Utilisateurs", 2));
	$page->addComponent($table);
	
	$table = new Table();
	$row = new TableRow();
	$row->setHeader(true);
	$row->addComponent("STRUCTURE");
	$table->addComponent($row);
	foreach($db->getClasses() as $class) {
		$row = new TableRow();
		$structureUrl = Url::getCurrentUrl();
		$structureUrl->setQueryVar('class', $class);
		$cell = new TableCell(new Link($structureUrl->toString(), $class));
		$cell->setClass('class');
		$row->addComponent($cell);
		$key = $db->getIDFieldsForClass($class);
		foreach($db->getFields($class, true) as $field => $data) {
			$cell = new TableCell($field);
			$cell->setClass('field '.(in_array($field, $key) ? 'key' : ''));
			$cell->setMetaData('title', 'type = '.$data['type'].'&#013;'.($data['mandatory'] ? 'obligatoire' : 'facultatif').'&#013;modifié le '.date("Y-m-d H:i:s", $data['timestamp']).'&#013;par '.$data['author']);
			$row->addComponent($cell);
		}
		$table->addComponent($row);
	}
	$page->addComponent(new Title("Structures", 2));
	$page->addComponent($table);
	
	/**********************************\
	       DISPLAY SPECIFIC CLASS
	\**********************************/
	
	$url = Url::getCurrentUrl();
	if ($url->hasQueryVar('class')) {
		$class = $url->getQueryVar('class');
		$table = new Table();
		$row = new TableRow();
		$key = $db->getIDFieldsForClass($class);
		$fields = $db->getFields($class, true);
		foreach($fields as $field => $data) {
			$cell = new TableCell($field, true);
			$cell->setClass('field '.(in_array($field, $key) ? 'key' : ''));
			$cell->setMetaData('title', 'type = '.$data['type'].'&#013;'.($data['mandatory'] ? 'obligatoire' : 'facultatif').'&#013;modifié le '.date("Y-m-d H:i:s", $data['timestamp']).'&#013;par '.$data['author']);
			$row->addComponent($cell);
		}
		$table->addComponent($row);
		
		$contentLimit = 20;
		foreach($db->getRecordsForClass($class, true) as $record) {
			$row = new TableRow();
			$historyUrl = new Url();
			$historyUrl->setQueryVar("page", "history");
			$historyUrl->setQueryVar("class", $class);
			foreach($fields as $field => $data) {
				$metadata = $record[$field];
				$content = $metadata['value'];
				if (in_array($field, $key)) {
					$historyUrl->setQueryVar('key_'.$field, $content);
				} else {
					// do not consider it in the history link
				}
				if ($data['type'] == 'string' && strlen($content) > $contentLimit) {
					$content = substr($content, 0, $contentLimit)."...";
				} else {
					// keep the full content
				}
				$cell = new TableCell($content);
				$cell->setClass('value '.(in_array($field, $key) ? 'key' : ''));
				$cell->setMetaData('title', 'type = '.$data['type'].'&#013;'.($data['mandatory'] ? 'obligatoire' : 'facultatif').'&#013;modifié le '.date("Y-m-d H:i:s", $metadata['timestamp']).'&#013;par '.$metadata['author']);
				$row->addComponent($cell);
			}
			$row->addComponent(new Link($historyUrl->toString(), "H"));
			$table->addComponent($row);
		}
		$page->addComponent(new Title("Enregistrements ".$class, 2));
		$page->addComponent($table);
	} else {
		$page->addComponent("Cliquez sur une structure pour afficher les enregistrements concernés.");
	}
?>