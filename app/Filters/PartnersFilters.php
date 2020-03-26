<?php

namespace App\Filters;

use App\Partner;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\DB;

class PartnersFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct($request);
    }

    public function search($term='%')
    {
        return $this->builder->where('partners.name','LIKE', "%$term%")
            ->orWhere('partners.location','LIKE', "%$term%")
            ->orWhere('partners.type','LIKE', "%$term%");
    }

    public function locations($term)
    {
        return $this->builder->where('partners.location','LIKE',"%$term%");
    }

    public function type($term)
    {
        return $this->builder->where('partners.type','LIKE', "%$term%");
    }
}