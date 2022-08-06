<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $guarded = [];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(AccountChannel::class, 'account_channel_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'account_user_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'message_id');
    }
}
