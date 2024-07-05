<?php

namespace App\Models;

use App\Traits\Associated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $fk_userID
 * @property $firstname
 * @property $lastname
 * @property $phone
 * @property $email
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
        'phone',
        'email',
        'color',
        'fk_communityID'
    ];

    private array $associations = [
        'user' => [User::class, 'fk_userID'],
        'community' => [Community::class, 'fk_communityID'],
        'offers' => ['many' => [Offer::class, 'fk_ownerID']],
    ];

}
