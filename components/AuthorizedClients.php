<?php namespace SunLab\SSOProvider\Components;

use Cms\Classes\ComponentBase;
use Winter\Storm\Support\Facades\Flash;
use Winter\User\Facades\Auth;

class AuthorizedClients extends ComponentBase
{
    public $user;

    public function init()
    {
        $this->user = Auth::getUser();
    }

    public function componentDetails()
    {
        return [
            'name' => 'sunlab.ssoprovider::lang.components.authorized_clients.name',
            'description' => 'sunlab.ssoprovider::lang.components.authorized_clients.desc'
        ];
    }

    public function onRevoke()
    {
        $idClient = post('id');

        $this->user->sunlab_sso_authorizations()->detach($idClient);

        Flash::success(__('sunlab.ssoprovider::lang.authorization_revoked'));
    }
}
