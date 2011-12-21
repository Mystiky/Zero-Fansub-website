I. DEFINITIONS

Tout d'abord mettons-nous d'accord sur les termes employ�s, il n'en sera que plus simple de discuter :

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

TODO d�crire le processus de raffinage

II.2 Classes PHP

TODO d�crire la logique des classes impl�ment�es et leur hi�rarchie

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