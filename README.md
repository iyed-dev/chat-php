# Chat PHP

Un simple système de chat en temps réel développé en PHP avec une base de données MySQL. Ce chat permet aux utilisateurs d'envoyer des messages et de les afficher sur la page, tout en mémorisant leur pseudo pendant la session.

## Fonctionnalités

- Saisie du pseudo et du message.
- Les messages sont stockés dans une base de données MySQL.
- Le pseudo de l'utilisateur est mémorisé pendant toute la session.
- Affichage des messages envoyés, du plus récent au plus ancien.

### Créer la base de données
Ouvre phpMyAdmin (accessible via `http://127.0.0.1/phpmyadmin/`), puis crée une base de données appelée `chat` avec la table suivante :

```sql
CREATE TABLE chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
