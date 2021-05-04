<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<title> Add Animal </title>
<!-- define the content section -->
@section('content')
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-9 ">
<div class="card">

        <!--staff can add new animal to the system-->
        <div class="card-header">Enter the details of the Animal</div>
        <!-- display the errors -->
           @if ($errors->any())
           <div class="alert alert-danger">
            <ul> 
            @foreach ($errors->all() as $error)
             <li>{{ $error }}</li> 
            @endforeach
            </ul>
           </div><br /> 
           @endif
        <!-- display the success status -->
            @if (\Session::has('success'))
            <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
            </div><br /> 
            @endif

       <!-- define the form -->
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{url('animals') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
               <label >Name</label>
               <input type="text" name="name"
                 placeholder="Name" />
             </div>
              <div class="col-md-8">
                <label >Date of Birth</label>
                <input type="text" name="date_of_birth"
                placeholder="e.g. 21/10/2020" />
              </div>
              <div class="col-md-8">
               <label >Description</label>
               <textarea rows="4" cols="50" name="description" placeholder="Notes about the Animal"></textarea>
              </div>
              <div class="col-md-8"> <label>Availability</label>
                <select name="availability" >
                  <option value="available">Available</option>
                  <option value="unavailable">Unavailable</option>
                </select>
              </div>
              <div class="col-md-8">
                <label>Image</label>
                <input type="file" name="image"
                placeholder="Image file" />
              </div>
              <!--Stretcher: Allows an animal to have multiple pictures-->
              <div class="col-md-8">
                <label>Image</label>
                <input type="file" name="secondimage"
                placeholder="Image file" />
              </div>
              <div class="col-md-6 col-md-offset-4">
                <input type="submit" class="btn btn-primary" />
                <input type="reset" class="btn btn-danger" />
              </div>
             </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection