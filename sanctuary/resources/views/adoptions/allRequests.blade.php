@extends('layouts.app') 
@section('content') 
<div class="container">
<div class="row justify-content-center">
<p class="msg">{{ session('msg') }}</p>
<div class="col-md-10">
<div class="card">

    <!--staff account shown all adoption requests if approved or denied-->
    <div class="card-header">List of All Adoption Requests</div> 
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
                    <th>Updated At</th>
                </tr> 
            </thead>
            <tbody>
                @foreach($adoptions as $adoption)
                    @foreach($users as $user)
                        @foreach($animals as $animal)
                            @if($adoption["animalid"] == $animal["id"])
                                @if($adoption["userid"] == $user["id"])
                                <!--only shows approved or denied requests-->
                                    @if($adoption["status"] != 'pending')
                                        <tr>
                                            <td>{{$adoption['id']}}</td> 
                                            <td>{{$adoption['userid']}}</td> 
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>{{$adoption['animalid']}}</td>
                                            <td>{{$animal['name']}}</td>
                                            <td>{{$adoption['status']}}</td>
                                            <td>{{$adoption['updated_at']}}</td>
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