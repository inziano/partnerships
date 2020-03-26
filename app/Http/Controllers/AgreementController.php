<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Filters\AgreementFilters;
use App\Repositories\AgreementRepository;
use App\Http\Resources\Agreement as AgreementResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgreementController extends Controller
{
    public function __construct( AgreementRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AgreementFilters $filters)
    {
        //
        return AgreementResource::collection(Agreement::filter($filters)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // confirm if request is valid
        $this->validate(request(),
        [
            'title' => 'required',
            'purpose' => 'required',
            'type' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'purpose' => 'required',
            'agrementdoc'=> 'required',
        ]);

        // Push agreement to file
        $name = $request->title;

        // Upload
        $agreement =  Storage::cloud()->putFileAs('agreements', $request->file('agreementdoc'),$name.'.'.$request->file('agreementdoc')->extension());
        // append agreement path to request
        $request->request->add(['agreeement'=> $agreement]);

        $startdate = Carbon::parse($request->input('startdate'))->toDateTimeString();
        $enddate = Carbon::parse($request->input('enddate'))->toDateTimeString();
        // Merge changes
        $request->merge(['startdate'=> $startdate, 'enddate'=> $enddate]);

        return $this->repo->createAgreement($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Agreement $agreement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Agreement $agreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agreement $agreement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agreement $agreement)
    {
        //
    }
}
