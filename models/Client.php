<?php namespace SunLab\SSOProvider\Models;

use Model;
use Str;

/**
 * Client Model
 */
class Client extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sunlab_ssoprovider_clients';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['host'];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'host' => 'required|url',
        'callback_url' => 'required|url',
        'token_url_param' => 'required'
    ];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'sunlab_sso_authorizations' => [\Winter\User\Models\User::class, 'table' => 'sunlab_ssoprovider_client_user'],
    ];

    /**
     * Auto-Generate secret if empty
     */
    public function beforeSave()
    {
        if (!$this->secret) {
            $this->secret = Str::random(64);
        }
    }
}
