<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Component extends Model
{
    use HasFactory;

    //not recording the grade of the component in the components table. the grade will come from the latest inspection
    protected $fillable = [
        'turbine_id',
        'name',
        'description'
    ];

    public function turbine(): BelongsTo
    {
        return $this->belongsTo(Turbine::class);
    }

    public function inspections(): BelongsToMany
    {
        return $this->belongsToMany(Inspection::class)
                    ->withPivot('grade');
    }

    public function latestInspection()
    {
        // I would also filter this by status once I implement the status
        return $this->hasOne(ComponentInspection::class)->latest();
    }
}
