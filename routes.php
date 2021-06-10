<?php

use SunLab\SSOProvider\Models\Client;
use SunLab\SSOProvider\Models\Settings;

Route::put('sunlab_sso/client', static function () {
    $settings = Settings::instance();

    if (!$settings->isConfigured()) {
        return response()->json([
            'err_n' => 1,
            'reason' => 'SSO Provider is not configured yet.'
        ], 406);
    }

    if (!$settings->accepts_new_clients) {
        return response()->json([
            'err_n' => 2,
            'reason' => "SSO Provider doesn't accept new clients."
        ], 406);
    }

    $client = new Client;
    $client->name = post('name');
    $client->callback_url = post('callback_url');

    try {
//        $client->validate();
        $client->saveOrFail();

        $loginPage = $settings->login_page;
        $urlProvider = (new \Cms\Classes\Controller)->pageUrl(
            $loginPage,
            ['identifier' => base64_encode($client->name)]
        );

        return response()->json([
            'provider_url' => $urlProvider,
            'secret' => $client->secret
        ]);
    } catch (Throwable $e) {
        return response()->json([
            'err_n' => 2,
            'reason' => $e->getMessage()
        ]);
    }
});
