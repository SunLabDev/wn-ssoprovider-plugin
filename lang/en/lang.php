<?php return [
    'plugin' => [
        'name' => 'SSO Provider',
        'desc' => 'Allows your website securely share its userbase.'
    ],

    'settings' => [
        'general_label' => 'SSO Provider',
        'general_desc' => 'Configure the provider behavior',
        'clients_label' => 'SSO Clients',
        'clients_desc' => 'View and update your SSO clients',
    ],

    'permissions' => [
        'access_settings' => 'Manage settings',
        'access_clients' => 'Manage clients'
    ],

    'components' => [
        'login_popup' => [
            'name' => 'Login popup',
            'desc' => 'Display the SSO Login popup and authorization.',
            'accept' => 'Accept',
            'decline' => 'Decline',
            'access_request' => ':name wants to access your data.',
            'shared_info' => 'Name, Login and Email will be shared.',
        ],
        'authorized_clients' => [
            'name' => 'Authorized clients',
            'desc' => 'Gives to your users the ability to revoke an authorization.',
            'access_granted' => ':name can access your data',
            'revoke_warning' => "Revoking access won't log you out from the remote websites. You still need to manually logout from these websites.",
            'no_authorization' => 'You did not yet authorize any website to access your data.',
        ]
    ],

    'fields' => [
        'accepts_new_clients' => 'Accepts new clients',
        'accepts_new_clients_comment' => 'New client keys will be generated automatically.',
        'login_page' => 'Login page',
        'login_page_comment' => 'The page which displays the SSO login popup component.',
        'token_url_param' => "Token url parameter",
        'token_url_param_comment' => 'Url parameter containing the user token added in callback URL',
        'secret' => 'Secret key',
        'secret_comment' => 'Filled by the provider',
        'design_section' => "Client's authorization page appearance",
        'name' => 'Name',
        'name_comment' => 'Displayed like {{ name }} want to access your credentials.',
        'splash_image' => 'Splash image',
        'splash_image_comment' => "Displayed on the client's authorization form.",
        'host' => 'Host',
        'callback_url' => 'Callback URL',
        'nb_authorizations' => "Nb users' authorizations"
    ],

    'authorization_revoked' => 'Authorization has been revoked'
];
