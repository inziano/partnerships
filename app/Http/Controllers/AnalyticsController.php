<?php

namespace App\Http\Controllers;

use App\Events\Analytics;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        // Fire event
        event( new Analytics() );

        return null;
    }
}
