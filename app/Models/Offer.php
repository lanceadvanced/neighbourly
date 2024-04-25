<?php

namespace App\Models;

use App\Traits\Associated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $title
 * @property $text
 * @property $fk_ownerID
 *
 * @mixin Eloquent
 */
class Offer extends Model
{
    use Associated;

    protected $table = 'offer';
    protected $primaryKey = 'offerID';

    public $timestamps = false;
    protected $fillable = [
        "title",
        "text",
        "fk_ownerID",
    ];

    private array $associations = [
        'owner' => [Account::class, 'fk_ownerID']
    ];

}
