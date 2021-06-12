<?php

use SunLab\SSOProvider\Models\Client;
use SunLab\SSOProvider\Models\Settings;

Route::put('sunlab_sso/client', static function () {
    $settings = Settings::instance();

    if (!$settings->isConfigured()) {
        return response()->json(['err_n' => 1], 406);
    }

    if (!$settings->accepts_new_clients) {
        return response()->json(['err_n' => 2], 406);
    }

    $callbackUrl = post('callback_url');
    $parsedUrl = parse_url($callbackUrl);
    $clientHost = sprintf('%s://%s', $parsedUrl['scheme'], $parsedUrl['host']);

    $client = Client::query()->firstOrNew(['host' => $clientHost]);
    $client->callback_url = $callbackUrl;
    $client->name = post('name', $clientHost);
    $client->splash_image = post('splash_image');
    $client->token_url_param = $settings->token_url_param;

    try {
        $client->saveOrFail();

        $loginPage = $settings->login_page;
        $urlProvider = (new \Cms\Classes\Controller)->pageUrl(
            $loginPage,
            ['identifier' => base64_encode($clientHost)]
        );

        return response()->json([
            'provider_url' => $urlProvider,
            'secret' => $client->secret,
            'token_url_param' => $settings->token_url_param
        ]);
    } catch (Throwable $e) {
        return response()->json(['reason' => $e->getMessage()]);
    }
});
