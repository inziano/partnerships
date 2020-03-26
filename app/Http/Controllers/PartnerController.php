<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Filters\PartnersFilters;
use App\Repositories\PartnerRepository;
use App\Http\Resources\Partner as PartnerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{

    public function __construct( PartnerRepository $repo )
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PartnersFilters $filters)
    {
        //
        return PartnerResource::collection( Partner::filter($filters)->paginate(50));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        // confirm if request is valid
        $this->validate(request(),
        [
            'name' => 'required',
            'abbreviation' => 'required',
            'location' => 'required',
            'address' => 'required',
            'type' => 'required',
            'field'=> 'required',
            'country' => 'required',
            
        ]);

        // if logo exists, upload it to storage an append it, else use a default image
        if ( $request->hasFile('partnerimg')) {
            // Generate storage name
            $name = $request->abbreviation;

            // Upload the files
            $logonew = Storage::cloud()->putFileAs('logo', $request->file('partnerimg'),$name.'.'.$request->file('partnerimg')->extension());

            // append logo path to request
            $request->request->add(['logo' => $logonew]);

            // Create new record
            $partner = $this->repo->createPartner( $request );

        } else {
            
            // Create the record and skip logo
            $partner = $this->repo->createPartner( $request );
        }
        // return newly created record
        return $partner;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
    }
}
