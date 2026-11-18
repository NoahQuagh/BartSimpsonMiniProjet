```
bart-simpson/
├── api/
│   └── clear_session.php       # Endpoint appelé en Ajax (fetch) pour vider la session
├── assets/
│   ├── css/
│   │   ├── reset.css           # Base propre (facilite la validation W3C)
│   │   ├── style.css           # Mise en page principale (tableau noir, responsive)
│   │   └── modal.css           # Styles dédiés à la modale de configuration
│   ├── images/                 # Craie, Bart, texture du tableau...
│   └── js/
│       ├── main.js             # Point d'entrée (type="module"), orchestre l'app
│       ├── blackboard.js       # Animation d'écriture ligne par ligne sur le tableau
│       ├── modal.js            # Ouverture/fermeture accessible (WCAG) de la modale
│       └── sessionAjax.js      # Requête fetch() vers api/clear_session.php
├── core/
│   ├── autoload.php            # Chargement automatique des classes (core/ et services/)
│   ├── CookieManager.php       # Classe utilitaire/Singleton pour gérer les cookies (V2)
│   └── SessionManager.php      # Ton Singleton issu de php-core-starter
├── data/
│   └── punitions.json          # Le fichier JSON source des punitions
├── services/
│   └── PunitionService.php     # Lecture du JSON, filtrage par saison, tirage aléatoire
├── views/
│   └── modal.php               # Fragment HTML du formulaire POST de la modale
├── .gitignore
├── index.php                   # Contrôleur frontal : traite le POST, lit cookies/session et affiche la page
└── README.md```