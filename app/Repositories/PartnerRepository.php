<?php

namespace App\Repositories;

use App\Partner;
use Illuminate\Http\Request;

class PartnerRepository {

    /**
     * createPartner
     *
     * @param Request $request
     * @return void
     */
    public function createPartner( Request $request )
    {
        // Store
        return Partner::create($request->all());
    }

    public function deletePartner($partner)
    {
        if ( Partner::where('id', $partner)->exists())
        {
            return Partner::find('id')->delete();
        } else {
            return abort(404);
        }
    }
}