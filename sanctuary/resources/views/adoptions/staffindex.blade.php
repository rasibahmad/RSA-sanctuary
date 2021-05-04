@extends('layouts.app') 
@section('content') 
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-10">
<p class="msg">{{ session('msg') }}</p>
<div class="card">

    <!--staff account is shown all pending requests when logged in-->
    <div class="card-header">Pending Adoption Requests</div> 
        <div class="card-body">
            <table class="table table-striped"> 
            <thead>
                <tr>
                    <th>Adoption ID</th> 
                    <th>User ID</th> 
                    <th>User's Name</th> 
                    <th>User's Email Address</th> 
                    <th>Animal ID</th> 
                    <th>Animal's Name</th> 
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                </tr> 
            </thead>
            <tbody>
                @foreach($adoptions as $adoption)
                    @foreach($users as $user)
                        @foreach($animals as $animal)
                            @if($adoption["animalid"] == $animal["id"])
                                @if($adoption["userid"] == $user["id"])
                                    @if($adoption["status"] == 'pending')
                                        <tr>
                                            <td>{{$adoption['id']}}</td> 
                                            <td>{{$adoption['userid']}}</td> 
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>{{$adoption['animalid']}}</td>
                                            <td>{{$animal['name']}}</td>
                                            <td>{{$adoption['status']}}</td>
                                            <!--staff can approve request by calling AdoptionController@approveAdoption-->
                                            @can('admin')
                                            <td>
                                            <a href="{{ action([App\Http\Controllers\AdoptionController::class, 'approveAdoption'], $adoption['id']) }}" class="btn btn-success" role="button">Accept</a>
                                            </td>
                                            <!--staff can deny request by calling AdoptionController@denyAdoption-->
                                            <td>
                                            <a href="{{ action([App\Http\Controllers\AdoptionController::class, 'denyAdoption'], $adoption['id']) }}" class="btn btn-danger" role="button">Deny</a>
                                            </td>
                                            @endcan
                                        </tr>    
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endforeach 
            </tbody>
            </table>
        </div>
    </div>  
</div>

</div> 
</div>
@endsection