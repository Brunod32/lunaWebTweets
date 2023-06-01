# Documentation LunaWeb Tweets

## Installation des dépendances
Lancez la commande ``composer install`` pour installer les dépendances nécessaires au projet.  
***
## Variables d'environnements
### Création de la base de données
Lancez la commande ``composer r doctrine`` pour installer l'ORM doctrine  
Créez un fichier .env.local, à la racine du projet, et modifiez cette ligne pour créer la base de données:  
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4  
- Changez app:!ChangeMe! par le nom d'utilisateur de la base de données  
- Changez app par le nom de la base de données

Lancer la commande ``php bin/console doctrine:database:create`` pour créer la base de données.
***



