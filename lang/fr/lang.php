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
            'accept' => 'Accepter',
            'decline' => 'Refuser',
            'access_request' => ':name veut accéder vos données.',
            'shared_info' => 'Votre nom, usager et email vont être partagés.',

        ],
        'authorized_clients' => [
            'name' => 'Clients autorisés',
            'desc' => 'Permet à vos utilisateurs de révoquer leurs autorisations.',
            'access_granted' => ':name peut accéder à vos données',
            'revoke_warning' => "Révoquer l'accès ne fermera pas les sessions distantes. Vous devez vous déconnecter manuellement.",
            'no_authorization' => "Aucun site web n'a présentement l'autorisation d'accéder à vos données.",

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
