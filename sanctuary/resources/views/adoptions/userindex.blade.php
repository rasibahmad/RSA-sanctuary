@extends('layouts.app') 
@section('content') 
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<p class="msg">{{ session('msg') }}</p> 
<div class="card">

    <!--user is shown all their requests-->
    <div class="card-header">All {{Auth::user()->name}}'s Adoption Requests</div>
        <div class="card-body">
            <table class="table table-striped">
                  <thead>
                    <tr>
                    <th>Animal ID</th> 
                    <th>Animal's Name</th> 
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($adoptions as $adoption)
                    @foreach($animals as $animal)
                        @if($adoption["userid"]== Auth::user()->id)
                            @if($adoption["animalid"] == $animal["id"])
                                <tr> 
                                    <td>{{$adoption['animalid']}}</td>
                                    <td>{{$animal['name']}}</td>
                                    <td>{{$adoption['status']}}</td>

                                    <!--if a request is pending, user can cancel the request.-->
                                    @if($adoption["status"] == 'pending')
                                        <td>
                                        <form action="{{ action([App\Http\Controllers\AdoptionController::class, 'destroy'],
                                        ['adoption' => $adoption['id']]) }}" method="post">
                                        <!--generate csrf token-->
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE"> <button class="btn btn-danger" type="submit">Cancel Request</button>
                                        </form> 
                                        </td>
                                    @endif
                                </tr>  
                            @endif
                        @endif
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