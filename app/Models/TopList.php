<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopList extends Model
{
    protected $fillable = [
        'brand_id',
        'country_id',
        'rating',
        'bonus',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
