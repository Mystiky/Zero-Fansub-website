<?php
	$page = PageContent::getInstance();
	$page->setTitle("Signaler un bug");
	
	$admin = TeamMember::getMemberByPseudo("sazaju HITOKAGE");
	
	$content = new SimpleTextComponent();
	$content->setClass("bug");
	$content->addLine("Le site �tant en plein raffinage, il est possible que vous tombiez sur des bugs au cours de votre navigation. Si tel est le cas, n'h�sitez pas � le signaler imm�diatement ! Pour cela, plusieurs solutions sont possibles :");
	$content->addLine();
	$content->addLine(Link::newWindowLink("https://github.com/Sazaju/Zero-Fansub-website/issues", "Enregistrer un bug sur GitHub"));
	$content->addLine();
	$content->addLine(new MailLink($admin->getMail(), "Envoyer un mail � l'administrateur Web"));
	$content->addLine();
	$content->addLine("La premi�re solution est de loin la meilleure, car en plus d'avertir les administrateurs, le probl�me est enregistr� et peut donc �tre suivi efficacement. Cela dit, il est n�cessaire de se connecter (si vous n'avez pas de compte GitHub vous pouvez toujours en cr�er un gratuitement). N�anmoins, comme il existe des r�fractaires, une seconde option est d'envoyer directement un mail aux admins. De pr�f�rence utilisez la premi�re solution, n'utilisez la seconde que si vraiment vous avez des soucis avec la premi�re.");
	
	$page->addComponent($content);

?> 
