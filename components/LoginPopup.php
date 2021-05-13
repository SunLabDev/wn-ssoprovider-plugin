<?php namespace SunLab\SSOProvider\Components;

use Cms\Classes\ComponentBase;
use SunLab\SSOProvider\Models\Client;
use Winter\User\Components\Account;
use Winter\User\Facades\Auth;
use Firebase\JWT\JWT;

class LoginPopup extends ComponentBase
{
    const SECONDS_VALID = 90;

    public $client;
    public $user;
    public $callbackWithToken;

    public function init()
    {
        // Search for a SSO Client corresponding to the identifier
        $this->client = Client::query()
            ->where('name', $this->property('identifier'))
            ->firstOrFail();

        // Abort if not a valid client
        if (!$this->client) {
            App::abort(401, 'Provider details not found');
        }

        if (($this->user = Auth::getUser())) {
            if ($this->user->authorizeSSO($this->client)) {
                return $this->returnToken();
            }
            $token = $this->getToken();
            $this->callbackWithToken = $this->client->callback_url . '/' . $token;
        } else {
            $this->addComponent(
                Account::class,
                'SSOLoginForm',
                ['redirect' => url()->current()]
            );
        }
    }

    public function onAccept()
    {
        $this->user->sunlab_sso_authorizations()->attach($this->client);
    }

    public function componentDetails()
    {
        return [
            'name' => 'LoginPopup Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'identifier' => [
                'title' => 'identifier',
                'default' => '{{ :identifier }}',
                'type' => 'string',
            ]
        ];
    }

    protected function returnToken($redirect = false)
    {
        $token = $this->getToken();

        abort(redirect($this->client->callback_url . '/' . $token));
    }

    protected function getToken()
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + self::SECONDS_VALID;

        return JWT::encode([
            'name' => $this->user->name,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        ], $this->client->secret, 'HS256');
    }
}
