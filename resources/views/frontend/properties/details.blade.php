@extends('layouts.app')

@section('content')

<h2>{{ $property->title }}</h2>

<img src="{{ asset('storage/'.$property->image) }}" class="img-fluid">

<p>{{ $property->description }}</p>
<p><strong>Price:</strong> ₦{{ $property->price }}</p>
<p><strong>Location:</strong> {{ $property->location }}</p>

@endsection
