<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voters';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'dni',
        'address',
        'phone',
        'sex',
        'center_id',
        'mobilizer_id',
        'guest',
        'has_dni',
        'mobilization',
        'mobilization_details',
        'census_status'
    ];
}
