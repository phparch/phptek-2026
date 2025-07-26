<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    /** @use HasFactory<\Database\Factories\SponsorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'website',
        'slug',
        'logo',
        'description',
        'socials',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'socials' => 'array',
    ];

    /**
     * Get the conferences associated with this sponsor.
     */
    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class, 'conference_sponsor', 'sponsor_uuid', 'conference_uuid', 'uuid', 'uuid')
            ->withPivot('sponsorship_level')
            ->withTimestamps();
    }
}
