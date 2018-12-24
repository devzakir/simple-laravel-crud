@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">View Visitor - {{ $visitor->name }} </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ $visitor->name }} </h5>
                    <h6 class="card-subtitle mb-2 text-muted"> {{ $visitor->email }} </h6>
                    <p class="card-text">{{ $visitor->details }} </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('visitor.index') }}" class="btn btn-success btn-sm"> Go Back </a>
                    <a href="{{ route('visitor.edit', ['id' => $visitor->id]) }}" class="btn btn-primary btn-sm"> Edit Info </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
