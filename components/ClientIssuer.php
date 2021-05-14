<?php namespace SunLab\SSOProvider\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use SunLab\SSOProvider\Models\Client;
use Winter\Storm\Database\ModelException;
use Winter\Storm\Support\Facades\Flash;

class ClientIssuer extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'ClientIssuer Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function onGetSecret()
    {
        $client = new Client;
        $client->name = post('name');
        $client->callback_url = post('callback_url');

        $client->validate();

        if ($client->save()) {
            $loginPage = $this->property('login_page');
            $urlProvider = $this->pageUrl($loginPage, ['identifier' => base64_encode($client->name)]);

            return [
                "#sso_clients_issuer" => $this->renderPartial(
                    '@success.htm',
                    ['secret' => $client->secret, 'urlProvider' => $urlProvider]
                )
            ];
        }
    }

    public function defineProperties()
    {
        return [
            'SSOLoginPage' => [
                'title'   => 'SSO Login Page',
                'type'    => 'dropdown',
                'default' => '',
            ]
        ];
    }

    public function getSSOLoginPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }
}
