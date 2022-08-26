<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $guarded = [];

    final public const BRAND_LOGO_PATH = 'branding_logos';

    final public const BRAND_POPULAR = ['comments', 'reactions', 'replies'];

    protected $casts = [
        'brand_popular_by' => 'array'
    ];

    protected $appends = ['brand_logo_url'];

    public function getBrandLogoUrlAttribute(): ?string
    {
        if ($this->brand_logo && Storage::disk('public')->exists($this->brand_logo))
        {
            return Storage::disk('public')->url($this->brand_logo);
        }
        return null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(AccountUser::class);
    }
}
