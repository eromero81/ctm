<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Models\EmailContact;

class EmailContactController extends Controller
{
    
    public function postEmailContact(Request $request) {
        $strEmail = $request->get('email');
        if (empty($strEmail)) {
            return response()->json([ 'success' => false, 'error' => 'Email can not be empty' ], 500);    
        }
        $mdlEmailContact = EmailContact::where('email', $strEmail)->first();
        if (empty($mdlEmailContact)) {
            $mdlEmailContact = EmailContact::create([
                'email' => $strEmail
            ]);
        }
        $strFirstname = $request->get('firstname');
        if (!empty($strFirstname)) {
            $mdlEmailContact->firstname = $strFirstname;
        }
        $strLastname = $request->get('lastname');
        if (!empty($strLastname)) {
            $mdlEmailContact->lastname = $strLastname;
        }
        $bIsOptIn = $request->get('opt_in');
        $numOptIn = 0; 
        if (!empty($bIsOptIn)) {
            $numOptIn = 1;
        }
        $mdlEmailContact->is_opt_in = $numOptIn;
        if (!$mdlEmailContact->save()) {
            return response()->json([ 'success' => false, 'error' => 'Unknown problem' ], 500);
        }
        return response()->json([ 'success' => true, 'error' => '', 'message' => 'contact updated' ], 200);
    }
}
