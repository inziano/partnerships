<?php

namespace App\Filters;

use App\Contact;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\DB;

class ContactFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct($request);
    }

    public function search($term ='%')
    {
        return $this->builder->where('contacts.firstname', 'LIKE', "%$term%")
            ->orWhere('contacts.lastname','LIKE', "%$term%")
            ->orWhere('contacts.email','LIKE', "%$term%");

    }
}