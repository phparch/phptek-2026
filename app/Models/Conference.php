<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Conference extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'venue_name',
        'venue_address',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get the conference name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the venue name.
     */
    public function getVenueName(): ?string
    {
        return $this->venue_name;
    }

    /**
     * Get the venue address.
     */
    public function getVenueAddress(): ?string
    {
        return $this->venue_address;
    }

    /**
     * Get the start date.
     */
    public function getStartDate(): ?Carbon
    {
        return $this->start_date;
    }

    /**
     * Get the end date.
     */
    public function getEndDate(): ?Carbon
    {
        return $this->end_date;
    }

    /**
     * Get the formatted start date.
     */
    public function formattedStartDate(string $format = 'Y-m-d'): ?string
    {
        return $this->start_date ? $this->start_date->format($format) : null;
    }

    /**
     * Get the formatted end date.
     */
    public function formattedEndDate(string $format = 'Y-m-d'): ?string
    {
        return $this->end_date ? $this->end_date->format($format) : null;
    }

    /**
     * Get the conference duration in days.
     */
    public function getDurationInDays(): ?int
    {
        if (! $this->start_date || ! $this->end_date) {
            return null;
        }

        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Check if the conference is currently ongoing.
     */
    public function isOngoing(): bool
    {
        if (! $this->start_date || ! $this->end_date) {
            return false;
        }

        $now = now();

        return $now->gte($this->start_date) && $now->lte($this->end_date);
    }

    /**
     * Get the formatted date range in the format "May 19th - 21st, 2026".
     * If start and end dates are in the same month and year, only the day is shown for the end date.
     */
    public function getFormattedDateRange(): ?string
    {
        if (! $this->start_date || ! $this->end_date) {
            return null;
        }

        $startMonth = $this->start_date->format('F');
        $startDay = $this->start_date->format('j');
        $startDayOrdinal = $this->getDayOrdinal($startDay);
        $endMonth = $this->end_date->format('F');
        $endDay = $this->end_date->format('j');
        $endDayOrdinal = $this->getDayOrdinal($endDay);
        $year = $this->end_date->format('Y');

        // If same month and year, format as "May 19th - 21st, 2026"
        if ($this->start_date->format('F Y') === $this->end_date->format('F Y')) {
            return "{$startMonth} {$startDay}{$startDayOrdinal} - {$endDay}{$endDayOrdinal}, {$year}";
        }

        // Different months, format as "May 19th - June 21st, 2026"
        return "{$startMonth} {$startDay}{$startDayOrdinal} - {$endMonth} {$endDay}{$endDayOrdinal}, {$year}";
    }

    /**
     * Get the ordinal suffix for a day number (st, nd, rd, th).
     */
    private function getDayOrdinal(int $day): string
    {
        if ($day >= 11 && $day <= 13) {
            return 'th';
        }

        switch ($day % 10) {
            case 1:
                return 'st';
            case 2:
                return 'nd';
            case 3:
                return 'rd';
            default:
                return 'th';
        }
    }
}
