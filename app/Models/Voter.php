<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Laravel\Scout\Searchable;

use App\Observers\VoterObserver;

#[ObservedBy([VoterObserver::class])]
class Voter extends Model
{
    use Searchable;

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
        'birthdate',
        'center_id',
        'mobilizer_id',
        'guest',
        'has_dni',
        'mobilization',
        'mobilization_details',
        'census_status',
        'center'
    ];

    public function centerR(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function mobilizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mobilizer_id');
    }

    // Laravel Scout Configurations

    public function searchableAs(): string
    {
        return 'voters_index';
    }

    public function toSearchableArray(): array
    {
        return $this->only("name", "dni");
    }
}
