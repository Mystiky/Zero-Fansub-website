<?php
	$page = PageContent::getInstance();
	$page->addComponent(new Title("À propos...", 1));

	$page->addComponent(new Title("Historique des versions", 2));
	
	$table = new Table();
	$page->addComponent($table);

	$row = new TableRow();
	$head = new TableHeader("Version");
	$head->setClass("version");
	$row->addComponent($head);
	$head = new TableHeader("Déscription");
	$head->setClass("description");
	$row->addComponent($head);
	$head = new TableHeader("Aperçu");
	$head->setClass("preview");
	$row->addComponent($head);
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("<b>1.0</b>");
	$row->addComponent("Zéro était un site de ddl.");
	$row->addComponent("Non dispo.");
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("1.1");
	$content = new SimpleTextComponent("Zéro devient une team de fansub avec pour seul projet ");
	$content->addComponent(new ProjectLink(Project::getProject("kimikiss")));
	$content->addComponent(".");
	$row->addComponent($content);
	$row->addComponent(Link::newWindowLink("http://zero.xooit.fr/index.php?theme=test", "Utiliser cette version"));
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("<b>2.0</b>");
	$row->addComponent("On essaye un design plus moderne, et c'est jouli. Enfin, je trouve. Et puis c'est rose !");
	$row->addComponent(Link::newWindowLink("http://zerofansub.net/v2/?s_theme=rose", "Utiliser cette version"));
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("2.1");
	$row->addComponent("On laisse le choix à l'utilisateur, si il préfère le bleu ^^");
	$row->addComponent(Link::newWindowLink("http://zerofansub.net/v2/index.php?s_theme=bleu", "Utiliser cette version"));
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("2.2");
	$row->addComponent("Et pour les tristes, du noir. Du black !");
	$row->addComponent(Link::newWindowLink("http://zerofansub.net/v2/index.php?s_theme=noir", "Utiliser cette version"));
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("<b>3.0</b>");
	$row->addComponent("Le petit rond de la v2 n'étant pas pratique, on change de systéme pour la v3. De couleurs aussi.");
	$row->addComponent(Link::newWindowLink("index3.0.php", "Utiliser cette version"));
	$table->addComponent($row);

	$row = new TableRow();
	$row->addComponent("3.1");
	$row->addComponent("À part le design général change, mais le contenu des pages reste le même. C'est juste histoire d'améliorer le code.");
	$row->addComponent("Version actuelle !");
	$table->addComponent($row);
?>