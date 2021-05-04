@extends('layouts.app') 
@section('content') 
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-9 ">
<p class="msg">{{ session('msg') }}</p>
<div class="card">

    <!--staff shown all animals | users shown all Available animals-->
    <div class="card-header">All the Animals</div> 
        <div class="card-body">
            <table class="table table-striped"> 
                <thead>
                <tr>
                <th>Name</th> 
                <th>Date of Birth</th> 
                <th>Availability</th>
                <th colspan="3">View</th>
                <!--staff can see animal Owner's if adopted-->
                @can('admin')
                <th> Owner ID</th>
                @endcan
                </tr> 
                </thead>
                <tbody>
                @foreach($animals as $animal) 
                    <tr>
                        <td>{{$animal['name']}}</td> 
                        <td>{{$animal['date_of_birth']}}</td> 
                        <td>{{$animal['availability']}}</td>
                        <td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btn-primary">Details</a></td>
                        <!--users can make adoption requests-->
                        @cannot('admin')
                        <td>
                        <a href="{{ action([App\Http\Controllers\AdoptionController::class, 'makeAdoption'], $animal['id']) }}" class="btn btn-success" role="button">Adopt</a>
                        </td>
                        @endcannot
                        <!--staff can edit and delete animals-->
                        @can('admin')
                        <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-warning">Edit</a></td>
                        <td>
                        <form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],
                        ['animal' => $animal['id']]) }}" method="post">
                        <!--generate csrf token-->
                        @csrf
                        <input name="_method" type="hidden" value="DELETE"> <button class="btn btn-danger" type="submit">Delete</button>
                        @endcan
                        </form> 
                        </td>
                        <!--shows staff the animal's Owner ID of adopted animals-->
                        @if(Gate::allows('admin'))
                            @foreach($adoptions as $adoption)
                                @foreach($users as $user)
                                    @if($animal["availability"] == 'Unavailable')
                                        @if($adoption["animalid"] == $animal["id"])
                                            @if($adoption["userid"] == $user["id"])
                                                @if($adoption["status"] == 'accepted')
                                                    <td>{{$adoption['userid']}}</td>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tr> 
                @endforeach
                </tbody>
            </table> 
        </div>
</div> 
</div>
</div> 
</div>
@endsection