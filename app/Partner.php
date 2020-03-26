<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Filters\Filterable;
use App\Agreement;

class Partner extends Model
{
    use Filterable;
    //
    protected $fillable = [
        'name',
        'abbreviation',
        'location',
        'type',
        'address',
        'country',
        'field', //research etc
        'purpose',
        'logo',
        'status' // Active/inactive
    ];

    // Relationships

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }
}
