<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasApiTokens, HasFactory;

    protected $primaryKey = 'brand_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'brand_name',
        'brand_image',
        'rating',
    ];

    public function getRouteKeyName(): string
    {
        return 'brand_id';
    }

    public function toplists():HasMany
    {
        return $this->hasMany(TopList::class);
    }
}
