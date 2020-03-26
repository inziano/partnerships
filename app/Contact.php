<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;
use App\Agreement;

class Contact extends Model
{
    use Filterable;
    //
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'gender',
        'phone',
        'address',
        'organisation',
        'country',
        'designation',
        'agreement_id'
    ];

    // Relationship

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
