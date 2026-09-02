@extends('layouts.app')

@section('content')

<h2>Available Properties</h2>

<div class="row">
@foreach($properties as $property)
    <div class="col-md-4">
        <div class="card mb-3">
            <img src="{{ asset('storage/'.$property->image) }}" class="card-img-top">
            <div class="card-body">
                <h5>{{ $property->title }}</h5>
                <p>₦{{ $property->price }}</p>
                <a href="/property/{{ $property->id }}" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
@endforeach
</div>

@endsection
