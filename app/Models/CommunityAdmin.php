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

class CommunityAdmin extends Model
{
    use Associated;

    protected $table = 'admin';
    protected $primaryKey = 'adminID';

    public $timestamps = false;

    protected $fillable = [
        "fk_communityID",
        "fk_accountID",
    ];

    private array $associations = [
        'community' => [Community::class, 'fk_communityID'],
        'account' => [Account::class, 'fk_accountID'],
    ];
}
