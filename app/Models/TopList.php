<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopList extends Model
{
    protected $fillable = [
        'country_id',
        'brand_id',
        'position',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(
            Brand::class,
            'brand_id',
            'brand_id'
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
