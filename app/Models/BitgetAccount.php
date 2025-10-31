<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BitgetAccount extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'api_key',
        'secret_key',
        'passphrase',
        'is_active',
        'is_demo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_demo' => 'boolean',
    ];

    // Ocultar campos sensibles en JSON y arrays
    protected $hidden = [
        'secret_key',
        'passphrase',
    ];

    // Encriptar automáticamente
    protected function setSecretKeyAttribute($value)
    {
        $this->attributes['secret_key'] = encrypt($value);
    }

    protected function getSecretKeyAttribute($value)
    {
        return decrypt($value);
    }

    protected function setPassphraseAttribute($value)
    {
        $this->attributes['passphrase'] = encrypt($value);
    }

    protected function getPassphraseAttribute($value)
    {
        return decrypt($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Activar esta cuenta y desactivar las demás del usuario
    public function activate()
    {
        $this->user->bitgetAccounts()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }
}
