<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;
use App\Partner;
use App\Contact;

class Agreement extends Model
{
    //
    use Filterable;

    protected $fillable = [
        'title',
        'type',
        'tags',
        'startdate',
        'enddate',
        'purpose',
        'partner_id'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array',
    ];

    // Relationships

    public function partner()
    {
        return $this->belongsTo(Parner::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
