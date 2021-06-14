<?php return [
    'plugin' => [
        'name' => 'Fournisseur SSO',
        'desc' => "Permet à votre site de partager sa base d'utilisateurs."
    ],

    'settings' => [
        'general_label' => 'Fournisseur SSO',
        'general_desc' => 'Configurer le comportement.',
        'clients_label' => 'Clients SSO',
        'clients_desc' => 'Visualiser et modifier les clients.',
    ],

    'permissions' => [
        'access_settings' => 'Gérer les paramètres',
        'access_clients' => 'Gérer les clients'
    ],

    'components' => [
        'login_popup' => [
            'name' => 'Pop-up de connexion',
            'desc' => "Affiche la pop-up de connexion et d'autorisation.",
        ],
        'authorized_clients' => [
            'name' => 'Clients autorisés',
            'desc' => 'Permet à vos utilisateurs de révoquer leurs autorisations.',
        ]
    ],

    'fields' => [
        'accepts_new_clients' => 'Accepte des nouveaux clients',
        'accepts_new_clients_comment' => 'Les clés clients seront générées automatiquement.',
        'login_page' => 'Page de connexion',
        'login_page_comment' => 'La page qui affiche le composant Pop-up de connexion.',
        'token_url_param' => "Paramètre du token dans l'url",
        'token_url_param_comment' => 'Transmis par le fournisseur.',
        'secret' => 'Clé secrète',
        'secret_comment' => 'Rempli par le fournisseur',
        'design_section' => "Apparence de la page d'autorisation",
        'name' => 'Nom',
        'name_comment' => 'Sera affiché comme ceci: {{ name }} veut accéder à vos informations.',
        'splash_image' => 'Image de présentation',
        'splash_image_comment' => "Sera affichée sur votre page d'autorisation.",
        'host' => 'Hôte',
        'callback_url' => 'URL de retour',
        'nb_authorizations' => "Nb d'utilisateurs autorisant"
    ],

    'authorization_revoked' => "L'autorisation a bien été révoquée."
];
