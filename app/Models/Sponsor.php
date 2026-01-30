<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'logo_url',
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

    /**
     * Get the logo URL.
     */
    protected function logoUrl(): Attribute
    {

        return Attribute::make(
            get: function (): ?string {
                if (!$this->logo) {
                    return null;
                }

                if (str_starts_with($this->logo, 'http')) {
                    return $this->logo;
                }

                if (file_exists(public_path($this->logo))) {
                    return asset($this->logo);
                }

                $path = $this->logo;
                if (!str_starts_with($path, 'vendor_logos/')) {
                    $path = 'vendor_logos/' . $path;
                }

                return Storage::disk('s3')->url($path);
            }
        );
    }
}
