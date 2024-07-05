<?php

namespace App\Models;

use App\Traits\Associated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $street
 * @property $number
 * @property $fk_cityID
 *
 * @mixin Eloquent
 */
class Address extends Model
{
    use Associated;

    protected $table = 'address';
    protected $primaryKey = 'addressID';

    public $timestamps = false;
    protected $fillable = [
        "street",
        "number",
        "fk_cityID",
    ];

    private array $associations = [
        'city' => [City::class, 'fk_cityID']
    ];
}
