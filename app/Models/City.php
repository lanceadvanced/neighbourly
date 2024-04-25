<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $name
 * @property $zip
 */
class City extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'cityID';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'zip',
    ];
}
