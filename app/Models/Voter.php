<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function mobilizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mobilizer_id');
    }
}
