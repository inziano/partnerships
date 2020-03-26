<?php

namespace App\Repositories;

use App\Agreement;
use Illuminate\Http\Request;

class AgreementRepository 
{
    /**
     * createAgreement
     *
     * @param Request $request
     * @return void
     */
    public function createAgreement(Request $request)
    {
        return Agreement::create($request->all());
    }
}