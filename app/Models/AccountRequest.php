<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $account_id
 * @property int $user_id
 * @property string $type
 * @property string $status
 * @property bool $is_approved
 * @property string $is_approved_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountRequestMeta[] $accountRequestMetas
 * @property Account $account
 * @property User $user
 */
class AccountRequest extends Model
{
    protected $fillable = [
        'account_id',
        'user_id',
        'type',
        'status',
        'is_approved',
        'is_approved_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function accountRequestMetas(): HasMany
    {
        return $this->hasMany(AccountRequestMeta::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(config('account.model'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meta(string $key, mixed $value = null): mixed
    {
        if ($value !== null) {
            return $this->accountRequestMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        } else {
            $value = $this->accountRequestMetas()->where('key', $key)->first()?->value;
            if ($value === 'image') {
                return $this->accountRequestMetas()->where('key', $key)->first()?->getMedia('image')->first()?->getUrl();
            } else {
                return $this->accountRequestMetas()->where('key', $key)->first()?->value;
            }
        }
    }
}
