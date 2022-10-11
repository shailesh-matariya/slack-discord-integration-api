<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'accounts';

    protected $guarded = [];

    final public const BRAND_LOGO_PATH = 'branding_logos';

    final public const BRAND_POPULAR = ['reactions', 'replies'];

    final public const PLATFORM_SLACK = 'slack';

    final public const PLATFORM_DISCORD = 'discord';

    protected $casts = [
        'brand_popular_by' => 'array',
        'discord_access_token_expire_at' => 'datetime',
    ];

    protected $appends = ['brand_logo_url'];

    public function getBrandLogoUrlAttribute(): ?string
    {
        if ($this->brand_logo && Storage::disk('public')->exists($this->brand_logo)) {
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

    public function channels(): HasMany
    {
        return $this->hasMany(AccountChannel::class);
    }

    function refreshDiscordExpiredToken()
    {
        if ($this->platform == Account::PLATFORM_DISCORD &&
            isset($this->discord_access_token_expire_at) &&
            $this->discord_access_token_expire_at->diffInSeconds() < (1 * 60 * 60)) {
            \Log::info("Required Refresh token for accountId#{$this->id} ");
            $url = 'https://discord.com/api/oauth2/token';

            $response = Http::asForm()->post($url, [
                'client_id' => config('services.discord.client_id'),
                'client_secret' => config('services.discord.secret'),
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->discord_refresh_token
            ]);

            $response = json_decode($response->body());

            \Log::info("Response Of refresh token for accountId#{$this->id} ", (array)$response);

            if (isset($response->access_token)) {
                $this->discord_access_token = $response->access_token;
                $this->discord_refresh_token = $response->refresh_token;
                $this->discord_access_token_expire_at = Carbon::now()->addSeconds($response->expires_in);
                $this->bot_scope = $response->scope;
                $this->save();
            }
        }
    }

    function removeAccount()
    {
        foreach ($this->channels as $channel) {
            foreach ($channel->messages as $message) {
                $message->attachments()->delete();
                $message->reactions()->delete();
            }
            $channel->messages()->delete();
        }
        $this->channels()->delete();
        $this->users()->delete();
        $this->delete();
        config('auth.account', null);
    }

    function getEmbedScriptURL(): string
    {
        if (! $this->brand_embed_url) {
            $embedCode = 'function em() { const t = document.getElementsByTagName("body"); let e = document.createElement("embed"); e.setAttribute("width", "100%"), e.setAttribute("height", "100%"), e.setAttribute("src", "'.config("app.frontend_url").'/t/'.$this->team_id.'"), t[0].style.cssText = "height: 100vh; margin:0", t[0].innerHTML = "", t[0].appendChild(e) }';
            $path = "customJS/" . Str::random(32) .".js";
            if (!Storage::exists($path)) {
                Storage::put($path, $embedCode);
            }

            $this->brand_embed_url = $path;
            $this->save();
        }

        return "<script src=\"" . Storage::url($this->brand_embed_url) . "\"></script>";
    }
}
