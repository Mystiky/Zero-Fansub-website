I. DEFINITIONS

Tout d'abord mettons-nous d'accord sur les termes employ�s, il n'en sera que plus simple de se comprendre :

Les sorties :
	Scantrad = chapitre ou volume traduit
	Fansub   = �pisode ou s�rie traduit(e)
	Release  = �l�ment traduit (fansub ou scantrad)
	Preview  = images tir�es d'une release pour �tre affich�es dans sa description

Le code :
	HTML = description de la structure du site (menus, listes, titres, ...) et de son contenu
	CSS  = description du rendu du site (couleurs, polices, tailles, ...)
	PHP  = logique du site (objets, fonctions, ...)
	DB   = base de donn�es (contenu du site)

Le site:
	local   = site install� sur le PC du d�veloppeur
	test    = site disponible sur un serveur de test
	serveur = site du serveur officiel (site "de production")

II.ARCHITECTURE DU SITE

II.1 Architecture globale

+ class.............. Classes PHP
|	+ database....... Classes relatives � la DB
|	+ util........... Classes utilitaires
|
+ ddl................ Releases de la team (disponible uniquement sur le serveur)
|
+ episodes........... Pages des releases (vou�es � dispara�tre)
|	+ chapitres...... Pages des scantrad (vou�es � dispara�tre)
|
+ images............. Images utilis�es pour le site
|	+ autre.......... 
|	+ calques........ Images transparentes utilisables pour faire du traitement d'image
|	+ cover.......... 
|	+ episodes....... Preview des �pisodes
|	+ forum.......... 
|	+ hautmenu....... Images aleatoires utilis�es dans le coin en haut � gauche du site
|	+ icones......... 
|	+ interface...... 
|	+ kanaii......... 
|	+ news........... Images utilis�es dans les news
|	+ part........... 
|	+ partenaires.... 
|	+ pub............ 
|	+ recrut......... 
|	+ scan........... 
|	+ series......... Images utilis�es pour d�crire les projets (liste + descriptions)
|	+ sorties........ Images apparaissant en haut du site, montrant les derni�res sorties
|	+ team........... Avatars des membres de l'�quipe (page �quipe)
|	+ titres......... 
|	+ xdcc........... 
|
+ pages.............. Pages HTML (vou�es � dispara�tre)
|	+ dossiers....... Pages des dossiers (vou�es � dispara�tre)
|	+ series......... Pages des s�ries (vou�es � dispara�tre)
|
+ sorties............ Contient un unique fichier PHP, affiche les derni�res sorties (vou� � dispara�tre)
|
+ styles............. Styles CSS disponibles
	+ default........ Style par d�faut

II.1 Processus de raffinage

Le site s'organise globalement sous forme d'une hi�rarchie. Pour le sch�matiser on peut donc utiliser un arbre :

                   index
                     |
    +----------+-----+---+---------+
    |          |         |         |
  news      projets    �quipe     ...
               |
    +----------+---------+
    |          |         |
 projet1    projet2     ...
               |
   +-----------+---------+
   |           |         |
release1    release2    ...

Chaque noeud correspond � une page particuli�re (ou juste une partie). La racine du site est donc l'index, � partir de l� on acc�de � toutes les autres parties du site. Par exemple la liste des projets, qui donne elle-m�me acc�s aux diff�rents projets, eux-m�me donnant acc�s aux releases qui leurs sont propres. Les noeuds ne donnant acc�s � rien de particulier sont les feuilles de l'arbre. Parmis ces feuilles, on trouve bien entendu les releases, qui sont au plus bas niveau, mais aussi la liste des news et la page de l'�quipe par exemple.

Ce qu'il faut savoir, c'est que modifier du code sur un noeud projet peut impliquer de devoir modifier du code au niveau release juste en dessous. Par exemple, si du jour au lendemain on d�cide que les releases doivent �tre affich�es sous une forme diff�rente au niveau projet, alors il faudra le r�percuter sur toutes les releases. En revanche, si un projet s'attend � avoir un certain rendu au niveau de sa release 1, alors on peut modifier la release 1 en ayant pour seule contrainte de donner ce m�me rendu. Le projet compte donc sur ses releases pour afficher ce qu'il faut comme il faut, les releases par contre ne demandent rien au projet. Ce genre de "d�pendance" peut se g�n�raliser � l'ensemble du site, on peut voir ainsi qu'on a un arbre de d�pendances, allant de haut en bas.

A la base, chaque noeud du site est g�r� par un code sp�cifique (un fichier HTML pour chacun). Cela implique que si une modification est faite � un niveau, elle doit �tre r�percut�e dans tous les ficheirs de ce m�me niveau. Si �a semble anodin pour les niveaux les plus hauts, les niveaux les plus bas en revanche deviennent ing�rables. Il y a par exemple plusieurs dizaines de projets, et pour chaque projet en g�n�rale plus d'un dizaine de releases. Si on souhaite changer une simple couleur au niveau des releases, on a vite fait d'abandonner l'id�e.

Ce qu'on souhaite faire est simple : on veut raffiner le site de mani�re � "factoriser" l'ensemble du code. Par exemple, m�me si on a beaucoup de releases, si on regarde bien le code HTML pour chacune on remarque que c'est globalement la m�me structure, seul le contenu change. L'id�e est donc, plut�t que de g�rer N releases avec N codes similaires, on pr�f�re n'avoir qu'un seul code qui va donner N rendus adapt�s, selon la release demand�e. Pour cela, on remplace chaque code HTML par un code PHP qui sera le m�me pour tous. L'avantage du PHP est qu'on peut utiliser des variables et des fonctions, c'est ce qui nous permet de factoriser nos N codes HTML en un seul code PHP. Le code PHP va g�rer la structure (qui est la m�me pour toutes les releases) et les donn�es diff�rentes pour chaque release seront stock�es dans la DB. Le code PHP fera appel � la DB pour compl�ter ses propres donn�es, de fa�on � fournir le m�me rendu final que le code HTML initial.

Ce principe de factorisation va �tre appliqu� sur tout le site. L'id�e est que, d�s qu'un code ayant le m�me objectif appara�t 2 fois, on le factorise. De cette mani�re, le jour ou on souhaite changer quelque chose, on n'a qu'un seul endroit � changer pour que la modification s'applique partout. Cependant, si on fait le raffinage dans n'importe quel sens, on peut avoir des probl�mes. Par exemple, si on raffine un projet mais ses releases n'ont pas �t� raffin�s, si on a besoin de changer le rendu des releases (probl�me de d�pendance) on doit le faire sur tous les fichiers non raffin�s. Et selon la modification, on peut vouloir la faire sur tous les projets, et donc devoir modifier toutes les releases. On ne sort pas de notre probl�me. De plus, il ne faut pas oublier que le site est toujours disponible, on ne peut pas se permettre de le mettre hors service le temps de tout raffiner, puis de le remettre en service une fois que c'est fait. Raffiner un site est tr�s long et peut �tre risqu�, aussi il est important de le faire intelligemment pour appliquer les am�liorations progressivement sur tout le site, sans le rendre hors d'usage.

Par cons�quent, si on reprend l'arbre du site sch�matis� pr�c�demment, le raffinage doit se faire depuis les feuilles de l'arbre jusqu'� la racine. Une fois que tous les enfants d'un noeud sont raffin�s (toutes les releases d'un projet), on peut raffiner le noeud en question (le projet). L'index, qui est � la racine du site, est donc le dernier � pouvoir �tre raffin� enti�rement. Cela permet d'�viter les probl�mes de d�pendance.

Il convient de noter que, une fois qu'un code HTML est raffin� en code PHP, ce code PHP est d�plac� au niveau du noeud parent. Autrement dit, lorsqu'une release est raffin�e, son code PHP r�sultant est g�r� au niveau du projet. Cela se comprend simplement : comme toutes les releases finissent par avoir le m�me code, ce code peut �tre plac� � un seul endroit, le plus adapt� �tant le code du projet qui les concerne. L'id�e peut para�tre saugrenue, car cela veut dire qu'� la fin tout le code se retrouvera dans l'index, ce qui risque d'�tre �norme. Cela dit, la factorisation en code PHP se fait en utilisant un langage objet, et si celui-ci est bien fait il peut se r�duire � quelques lignes (cr�er le bon objet avec les bonnes propri�t�s, puis appliquer la bonne fonction). Autrement dit, si le code HTML d'une release fait 20 lignes, on peut le r�duire � un code PHP de 3 lignes par exemple, qui seront alors d�plac�es au niveau projet. Une fois toutes les releases raffin�es, le projet peut contenir plusieurs dizaines de lignes, mais son propre raffinage peut le r�duire par exemple � 5 lignes. Ces 5 lignes peuvent alors �tre d�plac�es au niveau de la liste des projets, et ainsi de suite.

II.2 Classes PHP

La hi�rarchie des classes PHP n'est pas encore compl�tement fix�e, cela dit elle vise � s'approcher d'un sch�ma MVC (Mod�le-Vue-Controleur). Ce sch�ma s'organise comme suit :
- le mod�le d�finit les donn�es disponibles, qui est grosso modo le contenu de la DB, ce niveau est g�r� par les classes impl�mentant IDatabaseComponent (ligne d'une table) ou IDatabaseContainer (ensemble de lignes)
- la vue correspond au rendu final de ces donn�es (affichage sur le site), ce niveau est g�r� par les classes impl�mentant l'interface IHtmlComponent (g�n�re la structure HTML)
- le controleur est la logique du site, c'est lui qui g�re la lecture et l'�criture des donn�es au niveau mod�le, selon les besoins du niveau vue, ce niveau est g�r� par des classes qui n'impl�mentent pas d'interface commune (chaque objet d�finit sa propre logique)

Pour faire simple, le mod�le d�finit les informations disponibles, le controleur utilise et traite ces informations, puis la vue les formate pour l'affichage final sur le site. Le sch�ma suivant r�sume la situation par rapport aux diff�rentes classes PHP :

   VUE     |       IHtmlComponent
    |      |             |
CONTROLEUR |    classes sp�cialis�es
    |      |             |
  MOD�LE   |  IDatabaseComponent/Container

� noter que les interfaces ont leur noms pr�fix�s par I (comme interface), par exemple IHtmlComponent pour un composant HTML, IDatabaseComponent pour un composant de la DB, etc. Cependant ces interfaces ne sont jamais impl�ment�es directement, en effet plusieurs m�thodes ont un logique commune quelque soit la classe. Par exemple les composants HTML peuvent tous avoir une des propri�t�s telles que id, class, style, etc. Aussi le processus de g�n�ration du code HTML est toujours le m�me (une balise englobant le contenu). Ce genre de m�thodes communes est impl�ment� par des classes ayant le m�me nom que l'interface qu'il impl�mente, sauf que le pr�fixe est Default, par exemple DefaultHtmlComponent pour l'interface IHtmlComponent. Pour impl�menter un nouveau composant HTML, mieux vaut �tendre ces classes par d�faut plut�t que de r�impl�menter toute l'interface,on peut toujours surcharger certaines m�thodes si besoin (mais cela peut traduire une erreur de conception). Normalement, tous les composants HTML de base sont impl�ment�s de cette mani�re :
- Image pour la balise img
- Link pour la balise a
- SimpleBlockComponent pour la balise div
- SimpleListComponent pour les balises ol/ul
- SimpleParagraphComponent pour la balise p
- SimpleTextComponent pour la balise span
- Table, TableRow et TableCell pour les balises table, tr et td
- Title pour les balises h1, h2, etc.

Il est alors possible d'�tendre ces classes pour avoir des gestions sp�cialis�es. On a par exemple :
- Anchor pour les ancres (<a name="#..."></a>)
- CornerImage pour les images en haut � gauche du site, qui sont en m�em temps un lien vers le projet repr�sent� par l'image
- IndexLink pour les liens vers des pages du site (accessible depuis l'index)
- MailLink pour des liens "mailto"
- NewWindowLink pour des liens ouvrant une nouvelle fen�tre (target="_blank")
- ProjectLink pour des liens vers des projets complets
- ReleaseLink pour des liens vers des releases sp�cifiques
- ReleaseComponent pour l'affichage d'une release
- Pin pour aider au positionnement de certains composants
- ...

Certaines classes ne font pas partie de ce mod�le MVC, tout simplement parce qu'elles peuvent �tre utilis�es un peu partout. Ce sont les classes utilitaires du dossier "class/util". Elles offrent par exemple des fonctionnalit�s pouvant :
- appliquer des formatages sp�ciaux,
- v�rifier des donn�es,
- d�boguer,
- ...

II.3 Pages

TODO d�crire les pages disponibles et leur utilisation dans le processus de raffinage

II.4 Episodes et chapitres

TODO d�crire les releases disponibles et leur utilisation dans le processus de raffinage

II.5 Images

TODO d�crire les images disponibles et leur utilisation dans le processus de raffinage

II.6 Styles

TODO d�crire les styles disponibles et leur mod�le (d�faut)

II.7 Divers

Le dossier "ddl" est sens� contenir les releases de la team. En raison de sa taille, il n'est pas disponible sur le d�p�t. De ce fait certaines informations relatives aux releases peuvent �tre non renseign�es sur le site local et sur le site de test, cependant elles doivent appara�tre sur le site serveur. Il est possible de rajouter des releases dans ce dossier, d�s lors le site correspondant dispose des informations relatives aux releases disponibles.

Le fichier sorties/sortie.php d�finit la logique d'affichage des derni�res sorties, dans le bandeau en haut du site. Ce code devrait finir par �tre fusionn� � l'index, cela dit il reste l� tant que le processus de raffinage du site n'arrive pas � l'index.