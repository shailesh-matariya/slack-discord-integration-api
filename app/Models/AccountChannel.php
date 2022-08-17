<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountChannel extends Model
{
    use HasFactory;

    protected $table = 'account_channels';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AccountScope());
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(AccountUser::class, 'account_channel_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'account_channel_id');
    }

    public function scopeVisible($query)
    {
        $query->where('is_visible', 1);
    }

    public function scopePrivate($query)
    {
        $query->where('is_private', 1);
    }
}
