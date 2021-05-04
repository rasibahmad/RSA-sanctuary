@extends('layouts.app') 
@section('content') 
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-8 ">
<div class="card">

    <!--Shows details of animal-->
    <div class="card-header">Animal</div> 
        <div class="card-body">
            <table class="table table-striped" border="1" >
                <tr> <th> <b>Name </th> <td> {{$animal['name']}}</td></tr>
                <tr> <th>Date of Birth </th> <td>{{$animal->date_of_birth}}</td></tr>
                <tr> <th>Availability</th> <td>{{$animal->availability}}</td></tr>
                <tr> <th>Description </th> <td style="max-width:150px;" >{{$animal->description}}</td></tr> 
                <tr> <td colspan='2' ><img style="width:100%;height:100%" src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
                <!--only displays second image if there is one-->
                @if($animal->secondimage != 'noimage.jpg')
                    <tr> <td colspan='2' ><img style="width:100%;height:100%" src="{{ asset('storage/images/'.$animal->secondimage)}}"></td></tr>  
                @endif
            </table>
            <table><tr>
            <td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a></td>
            <td>
            <!--users can make adoption request-->
            @cannot('admin')
            <a href="{{ action([App\Http\Controllers\AdoptionController::class, 'makeAdoption'], $animal['id']) }}" class="btn btn-success" role="button">Adopt</a>
            @endcannot
            </td>
            <!--staff can edit and delete animal-->
            @can('admin')
            <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-warning">Edit</a></td>
            <td><form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}" method="post">
            <!--generate csrf token--> 
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
            @endcan
            </form></td>
            </tr></table> 
        </div>
    </div> 
</div>
</div> 
</div>
@endsection