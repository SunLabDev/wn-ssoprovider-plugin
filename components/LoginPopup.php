<?php namespace SunLab\SSOProvider\Components;

use Cms\Classes\ComponentBase;
use SunLab\SSOProvider\Models\Client;
use Winter\Storm\Support\Facades\Url;
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
        $encodedHost = $this->property('identifier');
        $identifier = base64_decode($encodedHost);
        $this->client = Client::query()
            ->where('host', $identifier)
            ->firstOrFail();

        // Abort if we didn't find a valid client
        if (!$this->client) {
            abort(401, 'Provider details not found');
        }

        // If the user is logged-in, check for authorization
        if (($this->user = Auth::getUser())) {
            $callbackUrl = $this->getFullCallbackUrl();

            // If the user already authorizes this client, return directly
            if ($this->user->authorizesSSO($this->client)) {
                abort(redirect($callbackUrl));
            }

            $this->callbackWithToken = $callbackUrl;
        }

        // Else display login/register form
        else {
            $this->addComponent(
                Account::class,
                'SSOLoginForm',
                ['redirect' => url()->current()]
            );
        }
    }

    public function onRun()
    {
        $this->addCss('components/loginpopup/assets/css/style.css');
    }

    public function onAccept()
    {
        $this->user->sunlab_sso_authorizations()->attach($this->client);
    }

    public function componentDetails()
    {
        return [
            'name' => 'sunlab.ssoprovider::lang.components.login_popup.name',
            'description' => 'sunlab.ssoprovider::lang.components.login_popup.desc'
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

    protected function getFullCallbackUrl()
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + self::SECONDS_VALID;

        $token = JWT::encode([
            'name' => $this->user->name,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        ], $this->client->secret, 'HS256');

        return Url::buildUrl([
            'host' => $this->client->callback_url,
            'query' => sprintf('%s=%s', $this->client->token_url_param, $token)
        ]);
    }
}
