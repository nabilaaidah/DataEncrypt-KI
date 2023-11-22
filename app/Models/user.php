<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model implements Authenticatable
{
    use HasFactory;
    use HasUuids;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['name',
                            'email',
                            'password',
                            'audio',
                            'document',
                            'video',
                            'privkey',
                            'pubkey',
                            'symkey'
    ];

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getPrivateKey()
    {
        return $this->privKey;
    }

    public function getPublicKey()
    {
        return $this->pubKey;
    }
    public function getSymKey()
    {
        return $this->symkey;
    }
    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
