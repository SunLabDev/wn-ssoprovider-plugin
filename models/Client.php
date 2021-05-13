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
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name' => 'required',
        'callback_url' => 'required|url'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

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
