<?php namespace SunLab\Ssoprovider\Models;

use Cms\Classes\Page;
use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    /**
     * @var array Behaviors implemented by this model.
     */
    public $implement = [
        \System\Behaviors\SettingsModel::class
    ];

    public $settingsCode = 'sso_provider_settings';
    public $settingsFields = 'fields.yaml';

    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'login_page' => 'required',
        'token_url_param' => 'required',
    ];

    public function getLoginPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('title', 'baseFileName');
    }
}
