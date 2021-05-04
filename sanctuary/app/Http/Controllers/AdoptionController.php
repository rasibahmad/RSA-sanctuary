<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;
use App\Models\Adoption;
use App\Models\User;

class AdoptionController extends Controller
{
    /**
     * Constructor- only allows logged in users to do actions.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Gets data from adoption, animal and user tables.
     * Displays users requests only for logged in user in adoptions.userindex.
     * Displays all requests to admin in adoptions.staffindex.
     */
    public function index()
    {
        $animals = Animal::all()->toArray();
        $adoptions = Adoption::all()->toArray();
        $users = User::all()->toArray();
        if(Gate::denies('admin')){
            return view('adoptions.userindex', compact('animals', 'adoptions'));
        }
        else{
            return view('adoptions.staffindex', compact('animals', 'adoptions', 'users'));
        }
    }

    /**
     * Checks if adoption request for the animal is already made by this user.
     * If not, new adoption object created/adoption request sent by clicking "Adopt" button.
     * Returns user to 'animals' view - list of all available animals.
     */
    public function makeAdoption($animalid)
    {
        //check if request for this animalid is already made
        $adoptions = Adoption::all()->toArray();
        $animals = Animal::all()->toArray();
        foreach($adoptions as $adoption){
            foreach($animals as $animal){
                if($adoption["userid"] == Auth::user()->id){
                    if($adoption["animalid"] == $animalid){
                        // generate a redirect HTTP response with a success message
                        return redirect('animals')->with('msg', 'Request already made!');
                    }
                }
            }
        }
        // create an adoption object and set its values
        $adoption = new Adoption;
        $adoption->userid = Auth::user()->id;
        $adoption->animalid = $animalid;
        $adoption->status = 'pending';
        $adoption->created_at = now();
        // save the adoption object
        $adoption->save();
        // generate a redirect HTTP response with a success message
        return redirect('animals')->with('msg', 'Success Request sent! Please wait for approval.');
    }

    /**
     * admin sets adoption request status to denied by clicking 'Deny' button.
     */
    public function denyAdoption($id)
    {
        $adoption = Adoption::find($id);
        if($adoption["status"] == 'pending'){
            $adoption->status = 'denied';
            $adoption->updated_at= now();
            $adoption->save();
        }
        // generate a redirect HTTP response with a success message
        return redirect('adoptions')->with('msg', 'Adoption Request Denied!');
    }

    /**
     * admin accepts users adoption request by clicking "Accept" button
     * animal becomes "Unavailable"
     * if another adoption request is sent for that animal - it gets denied.  
     */
    public function approveAdoption(Request $request, $id)
    {
        $adoption = Adoption::find($id);
        $animal = Animal::find($adoption->animalid);
        if($adoption["status"] == 'pending'){
            $adoption->status = 'accepted';
            $animal->availability = 'Unavailable';
            $adoption->updated_at= now();
            $adoption->save();
            $animal->save();
        
            $others = Adoption::all()->where('animalid', $animal->id);
            foreach($others as $other){
                if($other["status"] == 'pending'){
                    $other->status = 'denied';
                    $other->updated_at= now();
                    $other->save();
                }   
            }
        }    
        // generate a redirect HTTP response with a success message 
        return redirect('adoptions')->with('msg', 'Adoption Request Approved!');
    }

    /**
     * User can 'destroy' their adoption request by clicking "Cancel Request" button.
     */
    public function destroy($id)
    {
        //
        $adoption = Adoption::find($id);
        $adoption->delete();
        // generate a redirect HTTP response with a success message
        return redirect('adoptions')->with('msg', 'Adoption Request Cancelled!');
    }

    /**
     * method returns a view for admin that displays All requests by all users and whether they have been approved or denied.
     */
    public function showAllRequests(){
        $animals = Animal::all()->toArray();
        $adoptions = Adoption::all()->toArray();
        $users = User::all()->toArray();
        if(Gate::allows('admin')){
            return view('adoptions.allRequests', compact('animals', 'adoptions', 'users'));
        }
    }
        

}
