<?php namespace SunLab\SSOProvider;

use Backend;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
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
            'name'        => 'SSOProvider',
            'description' => 'No description provided yet...',
            'author'      => 'SunLab',
            'icon'        => 'icon-leaf'
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

            $user->addDynamicMethod('authorizeSSO', static function ($client) use ($user) {
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
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'sunlab.ssoprovider::lang.settings.menu_label',
                'description' => 'sunlab.ssoprovider::lang.settings.menu_description',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-key',
                'url'       => Backend::url('sunlab/ssoprovider/clients'),
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
        return []; // Remove this line to activate

        return [
            'sunlab.ssoprovider.some_permission' => [
                'tab' => 'SSOProvider',
                'label' => 'Some permission'
            ],
        ];
    }
}
