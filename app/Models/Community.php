<?php

namespace App\Models;

use App\Traits\Associated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $communityID
 * @property $fk_addressID
 * @property $managed
 *
 * @mixin Eloquent
 */
class Community extends Model
{
    use Associated;

    protected $table = 'community';
    protected $primaryKey = 'communityID';

    public $timestamps = false;

    protected $fillable = [
        "fk_addressID",
        "managed",
    ];

    private array $associations = [
        'address' => [Address::class, 'fk_addressID'],
    ];
}
