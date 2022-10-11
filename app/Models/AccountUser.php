<?php

namespace App\Models;

use App\Models\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'account_users';

    protected $guarded = [];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AccountScope());
    }
}
