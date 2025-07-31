<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Center extends Model
{
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'centers';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'address',
        'coordinator_id',
        'category'
    ];

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function centerMobilizers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'center_mobilizer', 'center_id', 'mobilizer_id');
    }

    // Laravel Scout Configurations

    public function searchableAs(): string
    {
        return 'centers_index';
    }

    public function toSearchableArray(): array
    {
        return $this->only("name");
    }
}
