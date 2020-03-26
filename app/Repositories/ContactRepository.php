<?php

namespace App\Repositories;

use App\Contact;
use Illuminate\Http\Request;

class ContactRepository 
{
    /**
     * createContact
     *
     * @param Request $request
     * @return void
     */
    public function createContact(Request $request)
    {
        return Contact::create($request->all());
    }
}