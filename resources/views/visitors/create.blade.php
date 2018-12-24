@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a New Visitor</div>
                <div class="card-body">
                    <form action="{{ route('visitor.store') }}" method="post">
                        @csrf 
                        <div class="form-group">
                            <label for="name">Visitor Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Visitor Email</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autofocus required>
                            @if ($errors->has('email'))
                                <span class="invalid-feeback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="details">Visitor Details</label>
                            <textarea rows="4" type="text" name="details" id="details" class="form-control {{$errors->has('details') ? ' is-invalid' : '' }}" autofocus required>{{ old('details') }}</textarea>
                            @if ($errors->has('details'))
                                <span class="invalid-feeback" role="alert">
                                    <strong> {{ $errors->first('detailes') }}</strong>
                                </span>
                            @endif  
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Add Visitor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
