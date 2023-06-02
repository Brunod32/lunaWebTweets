# Documentation LunaWeb Tweets

## Installation des dépendances
Lancez la commande ``composer install`` pour installer les dépendances nécessaires au projet.  
***
## Variables d'environnements

### Modification du fichier .env
1 - Modifiez la ligne suivante pour créer la base de données :  
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4  
- Changez app:!ChangeMe! par le nom d'utilisateur de la base de données  
- Changez app par le nom de la base de données  

2 - Créer une constante API_KEY, à laquelle vous affecterez l'URL contenant le flux JSON permettant de récupérer les Tweets.


### Création de la base de données et de fichiers de migrations
Lancer la commande ``php bin/console doctrine:database:create`` pour créer la base de données.  
Enfin, effectuez les migrations en exécutant la commande ``php bin/console doctrine:migration:migrate``



***

## Récupération des tweets
Pour récupérer les tweets, saisisser la commande ``php bin/console app:get-tweets`` ou son alias ``php bin/console app:tweets``.

