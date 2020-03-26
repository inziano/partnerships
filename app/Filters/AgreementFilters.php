<?php

namespace App\Filters;

use App\Agreement;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\DB;

class AgreementFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct($request);
    }

    public function search($term='%')
    {
        return $this->builder->where('agreements.title','LIKE',"%$term%")
            ->orWhere('agreements.type','LIKE',"%$term");
    }
}