<?php namespace SunLab\SSOProvider\Components;

use Cms\Classes\ComponentBase;
use Winter\Storm\Support\Facades\Flash;
use Winter\User\Facades\Auth;

class AuthorizedClients extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'AuthorizedClients Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function onRevoke()
    {
        $user = Auth::getUser();
        $idClient = post('id');

        $user->sunlab_sso_authorizations()->detach($idClient);

        Flash::success('Authorization has been revoked');
    }
}
