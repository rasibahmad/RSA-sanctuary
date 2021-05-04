<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Adoption;
use App\Models\User;

class AnimalController extends Controller
{
    /**
     * Constructor- only allows logged in users to do actions.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * only shows animals that are listed as 'Available' for adoption TO USERS.
     * shows list of ALL animals in system to staff
     * gets data from all tables so animal owner id can be shown to staff if adopted.
     */
    public function index()
    {   
        if(Gate::denies('admin')){
            $animals = Animal::where('availability', 'Available')->get()->toArray();
            return view('animals.index', compact('animals'));
        }
        else{
            $adoptions = Adoption::all()->toArray();
            $animals = Animal::all()->toArray();
            $users = User::all()->toArray();
            return view('animals.index', compact('animals', 'adoptions', 'users'));
        }
    }

    /**
     * Admin can create new Animal object and add animal to adoption list as 'Available'.
     */
    public function create()
    {
        if(Gate::allows('admin')){
            return view('animals.create');
        }
    }

    /**
     * Stores animal data when created by admin.
     */
    public function store(Request $request)
    {
        //form validation - only image files can be uploaded
        $animal = $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'secondimage' => 'sometimes|image|nullable|mimes:jpeg,png,jpg,gif,svg|max:500'
        ]);

        //Handles the uploading of the image
        if ($request->hasFile('image')){
            //Gets the filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Just gets the extension
            $extension = $request->file('image')->getClientOriginalExtension();
           //Gets the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Uploads the image
            $path =$request->file('image')->storeAs('public/images', $fileNameToStore); }
           else {
                 $fileNameToStore = 'noimage.jpg';
            }
            $animal = new Animal;
            $animal->image = $fileNameToStore;

        //Handles the uploading of the second image
        if ($request->hasFile('secondimage')){
            //Gets the filename with the extension
            $fileNameWithExt = $request->file('secondimage')->getClientOriginalName();
            //just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Just gets the extension
            $extension = $request->file('secondimage')->getClientOriginalExtension();
           //Gets the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Uploads the image
            $path =$request->file('secondimage')->storeAs('public/images', $fileNameToStore); }
           else {
                 $fileNameToStore = 'noimage.jpg';
            }

    // create a animal object and set its values from the input
        
        $animal->name = $request->input('name');
        $animal->date_of_birth = $request->input('date_of_birth');
        $animal->description = $request->input('description');
        $animal->availability = $request->input('availability');
        $animal->created_at = now();
        
        $animal->secondimage = $fileNameToStore;
        // save the animal object
        $animal->save();
        // generate a redirect HTTP response with a success message
        return redirect('animals')->with('msg', 'Success! Animal has been added');
    }

    /**
     * returns view which shows details of the animal when 'Details' button clicked.
     */
    public function show($id)
    {
        $animal = Animal::findOrFail($id);
        return view('animals.show',compact('animal'));
    }

    /**
     * returns view which allows Admin to edit animal details when 'Edit' button clicked.
     */
    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        return view('animals.edit',compact('animal'));
    }

    /**
     * Updates animal data from admin.
     */
    public function update(Request $request, $id)
    {
        //form validation - only image files can be uploaded
        $animal = Animal::find($id); $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'secondimage' => 'sometimes|image|nullable|mimes:jpeg,png,jpg,gif,svg|max:500'
        ]);
            $animal->name = $request->input('name'); 
            $animal->date_of_birth = $request->input('date_of_birth'); 
            $animal->description = $request->input('description'); 
            $animal->availability = $request->input('availability'); 
            $animal->updated_at = now();
            
            //Handles the uploading of the image
            if ($request->hasFile('image')){
            //Gets the filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Just gets the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Gets the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Uploads the image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            } else {
            $fileNameToStore = 'noimage.jpg';
            }
            $animal->image = $fileNameToStore;

            //Handles the uploading of the second image
            if ($request->hasFile('secondimage')){
                //Gets the filename with the extension
                $fileNameWithExt = $request->file('secondimage')->getClientOriginalName();
                //just gets the filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Just gets the extension
                $extension = $request->file('secondimage')->getClientOriginalExtension();
                //Gets the filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Uploads the image
                $path = $request->file('secondimage')->storeAs('public/images', $fileNameToStore);
                } else {
                $fileNameToStore = 'noimage.jpg';
                }
            $animal->secondimage = $fileNameToStore;

            $animal->save();
            // generate a redirect HTTP response with a success message
            return redirect('animals')->with('msg', 'Success Animal Updated');
    }

    /**
     * allows admin to delete Animal from system by clicking 'Delete' button.
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        // generate a redirect HTTP response with a success message
        return redirect('animals')->with('msg', 'Animal Deleted');
    }
}
