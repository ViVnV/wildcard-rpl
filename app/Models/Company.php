<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use TomatoPHP\FilamentLocations\Models\Country;

/**
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $ceo
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string $registration_number
 * @property string $tax_number
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property Branch[] $branches
 * @property Country $country
 */
class Company extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'country_id',
        'name',
        'ceo',
        'address',
        'city',
        'zip',
        'registration_number',
        'tax_number',
        'email',
        'phone',
        'website',
        'notes',
        'created_at',
        'updated_at',
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'company_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
