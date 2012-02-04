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
+ interface.......... Pages PHP d�crivant les diff�rentes parties de l'interface (ent�te et pied de page, menus, contenu de page)
|
+ pages.............. Pages HTML (vou�es � dispara�tre)
|
+ styles............. Styles CSS disponibles
	+ default........ Style par d�faut
		+ images..... Images utilis�es par le style

II.1 Classes PHP

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

� noter que les interfaces ont leur noms pr�fix�s par I (comme interface), par exemple IHtmlComponent pour un composant HTML, IDatabaseComponent pour un composant de la DB, etc. Cependant ces interfaces ne sont jamais impl�ment�es directement, en effet plusieurs m�thodes ont une logique commune quelque soit la classe h�ritant une de ces interfaces, et m�ritent donc d'�tre impl�ment�es � un niveau sup�rieur. Par exemple les composants HTML peuvent tous avoir une des propri�t�s telles que id, class, style, etc. Aussi le processus de g�n�ration du code HTML est toujours le m�me (une balise englobant le contenu). Ce genre de m�thodes communes est impl�ment� par des classes ayant le m�me nom que l'interface qu'il impl�mente, sauf que le pr�fixe est Default, par exemple DefaultHtmlComponent pour l'interface IHtmlComponent. Pour impl�menter un nouveau composant HTML, mieux vaut �tendre ces classes par d�faut plut�t que de r�impl�menter toute l'interface, on peut toujours surcharger certaines m�thodes si besoin (mais cela peut traduire une erreur de conception). Normalement, tous les composants HTML de base sont impl�ment�s de cette mani�re :
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
- CornerImage pour les images en haut � gauche du site, qui sont en m�me temps un lien vers le projet repr�sent� par l'image
- MailLink pour des liens "mailto"
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

II.2 Pages

Le dossier "pages" contient un peu tout et n'importe quoi. Cela dit il est important d'avoir en t�te certains points :
- home.php correspond � la page d'accueil, affichant les news
- team.php correspond � la page "L'�quipe"
- about.php correspond � la apge "� propos"
- contact.php correspond � la page "Contact"
- xdcc.php correspond � la page "XDCC"
- series.php correspond � la liste des projets
- hhentai.php correspond � la liste des projets + news hentai, � terme il devrait �tre redistribu� sur la page des news et la liste des projets normaux (avec un filtre pour les hentai)
- havert.php correspond � l'avertissement pour l'acc�s � la page hentai

Des tas d'autres fichiers sont pr�sents, principalement des pages obsol�tes. Une fois le site compl�tement raffin�, un nettoyage complet de ce dossier devrait �tre op�r�.

II.3 Images

Ce dossier est un peu fourre-tout, mais il est important de retenir ceci :
- autre contient quelques images qu'il faudra penser � ranger ailleurs (comme des bonus li�s � des releases)
- calques contient les PNG HD transparent � utiliser pour faire les banni�res et autres compositions d'images
- episodes contient les previews des releases
- hautmenu contient les images affich�es en haut � gauche du site, elles font toutes 150x250 pixels
- icones contient des icones telles que ceux utilis�s dans les descriptions des releases (torrent, lien MU, lien free, ...)
- interface contient les images utilis�es pour l'interface, cependant il est vou� � dispara�tre vu que les images de l'interface doivent �tre transf�r�es dans le dossier du style associ� (c'est d�j� le cas pour certaines images du style par d�faut)
- news contient les images utilis�es dans les news
- partenaires contient les banni�res des partenaires (et les notres)
- series contient les banni�res des projets + les images utilis�es dans la description de chaque projet (pas les previews des releases)
- sorties contient lesimages de l'ent�te du site (les derniers �pisodes sortis)
- team contient les avatars des membres de la team (utilis�es notamment dans la page d�crivant l'�quipe)

II.4 Styles

Pour l'instant un seul style est disponible, celui par d�faut (default). Ce style est le mod�le � consid�rer pour tout nouveau style. En particulier, tout style devrait se composer de cette fa�on :

+ images........ Ensemble des images utilis�es par le style
+ style.css..... Style tout public
+ styleH.css.... Style Hentai

II.5 Conventions de programmation

Le code PHP est �crit en anglais. C'est un langage plus adapt� � la programmation (ou plut�t le langage de programmation est adapt� � cette langue) et donc mieux vaut rester homog�ne. Un des avantages est que l'anglais offre pas mal de petits mots tr�s r�currents (set au lieu de assigner, get au lieu de r�cup�rer, ...) ce qui r�duit les noms de mani�re assez importante. De plus, le fran�ais utilisant des accents incompatibles avec PHP, mieux vaut �viter.

Certains commentaires sont aussi en anglais mais ce n'est pas obligatoire (plut�t une habitude pour certains), aussi ce n'est pas grave si d'autres commentaires sont en fran�ais (les autres langues sont cependant � proscrire). Il convient de noter qu'un commentaire n'est pas l� pour dire ce que fait le code, le code en lui-m�me doit �tre suffisamment parlant. Par exemple :

// on cherche la release X dans la liste des releases
$r = null;
foreach($releases as $release) {
	if ($release->getId() == $id) {
		$r = $release;
		break;
	}
}

Le commentaire est ici inutile, car le code est assez explicite pour voir qu'on parcoure (boucle foreach) des releases (tableau $releases) et que lorsqu'un ID sp�cifique est atteint ($release->getId() == $id) on garde en m�moire la release correspondante ($r = $release) et on arr�te la recherche (break). Si on estime que le code est trop compliqu� pour qu'en le lisant on comprenne ce qu'il fait, alors mieux vaut revoir le code pour le simplifier (le r��crire ou factoriser certaines parties dans des fonctions aux noms explicites) de fa�on � avoir un code clair. Les commentaires ne sont utiles que pour :
- les ent�tes (d�crire le r�le et l'utilisation d'une classe ou de longues fonctions)
- les subtilit�s (par exemple on sait dans quel ordre est tri� un tableau, donc on le parcours dans un ordre particulier plut�t que de mani�re habituelle)
- les notifications telles que des TODO (future t�che), FIXME (bogue � corriger), etc.

II.6 Divers

Le dossier "ddl" est sens� contenir les releases de la team. En raison de sa taille, il n'est pas disponible sur le d�p�t. De ce fait certaines informations relatives aux releases peuvent �tre non renseign�es sur le site local et sur le site de test, cependant elles doivent appara�tre sur le site serveur. Il est possible de rajouter des releases dans ce dossier, d�s lors le site correspondant dispose des informations relatives aux releases disponibles.