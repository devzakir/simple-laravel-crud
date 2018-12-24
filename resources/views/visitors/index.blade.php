@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">            
            @if (session('status'))
                <div class="card mb-2">
                    <div class="card-header">Dashboard</div>    
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>    
                        You are logged in!
                    </div>
                </div>            
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="mb-0">See All Visitors</p>
                    <a href="{{ route('visitor.create')}}" class="btn btn-sm btn-primary">Add a New Visitor</a>
                </div>  
                <div class="card-body">
                    @if($visitors->count() !== 0)
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Details </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->name }}</td>
                                        <td>{{ $visitor->email }} </td>
                                        <td>{{ str_limit($visitor->details, 50) }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('visitor.show', ['id' => $visitor->id])}}" class="btn btn-success btn-sm mr-1"> View </a>
                                            <a href="{{ route('visitor.edit', ['id' => $visitor->id])}}" class="btn btn-primary btn-sm mr-1"> Edit </a>
                                            <form action="{{ route('visitor.destroy', ['id' => $visitor->id]) }}" method="post">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else 
                        <h4 class="text-center mb-5 mt-5">
                            No Visitor Data Found. Create <a href="{{ route('visitor.create') }}"> Here </a>
                        <h4>
                    @endif
                </div>
            </div>
            <div class="text-center mt-3 d-flex justify-content-center">
                {{ $visitors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
