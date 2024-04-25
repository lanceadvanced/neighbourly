<?php

namespace App\Models;

use App\Traits\Associated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $fk_userID
 * @property $firstname
 * @property $lastname
 * @property $fk_communityID
 *
 * @mixin Eloquent
 */
class Account extends Model
{
    use Associated;

    public $timestamps = false;

    protected $table = 'account';
    protected $primaryKey = 'accountID';

    protected $fillable = [
        'fk_userID',
        'firstname',
        'lastname',
    ];

    private array $associations = [
        'userID' => [User::class, 'fk_userID'],
        'communityID' => [Community::class, 'fk_communityID'],
    ];

}
