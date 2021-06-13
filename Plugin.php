<?php namespace SunLab\SSOProvider;

use Backend;
use SunLab\Ssoprovider\Models\Settings;
use System\Classes\PluginBase;
use Winter\User\Models\User;

/**
 * SSOProvider Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'sunlab.ssoprovider::lang.plugin.name',
            'description' => 'sunlab.ssoprovider::lang.plugin.desc',
            'author'      => 'SunLab',
            'icon'        => 'icon-key'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function ($user) {
            $user->belongsToMany['sunlab_sso_authorizations'] = [
                \SunLab\SSOProvider\Models\Client::class,
                'table' => 'sunlab_ssoprovider_client_user'
            ];

            $user->addDynamicMethod('authorizesSSO', static function ($client) use ($user) {
                return $user->sunlab_sso_authorizations()->where('client_id', $client->id)->exists();
            });
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            \SunLab\SSOProvider\Components\LoginPopup::class => 'SSOLoginPopup',
            \SunLab\SSOProvider\Components\AuthorizedClients::class => 'SSOAuthorizedClients'
        ];
    }

    public function registerSettings()
    {
        return [
            'clients' => [
                'label'       => 'sunlab.ssoprovider::lang.settings.clients_label',
                'description' => 'sunlab.ssoprovider::lang.settings.clients_desc',
                'category'    => 'sunlab.ssoprovider::lang.plugin.name',
                'icon'        => 'icon-address-book-o',
                'url'       => Backend::url('sunlab/ssoprovider/clients'),
                'order'       => 500,
                'permissions' => ['sunlab.ssoprovider.access_clients']
            ],
            'sso_settings' => [
                'label'       => 'sunlab.ssoprovider::lang.settings.general_label',
                'description' => 'sunlab.ssoprovider::lang.settings.general_desc',
                'category'    => 'sunlab.ssoprovider::lang.plugin.name',
                'icon'        => 'icon-key',
                'class'       => Settings::class,
                'order'       => 500,
                'permissions' => ['sunlab.ssoprovider.access_settings']
            ]
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'sunlab.ssoprovider.access_settings' => [
                'tab' => 'sunlab.ssoprovider::lang.plugin.name',
                'label' => 'sunlab.ssoprovider::lang.permissions.access_settings'
            ],
            'sunlab.ssoprovider.access_clients' => [
                'tab' => 'sunlab.ssoprovider::lang.plugin.name',
                'label' => 'sunlab.ssoprovider::lang.permissions.access_clients'
            ],
        ];
    }
}
