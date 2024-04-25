<?php

namespace App\Models;

use App\Traits\Associated;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $street
 * @property $number
 * @property $fk_cityID
 */
class Address extends Model
{
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
