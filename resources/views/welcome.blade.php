@extends('Layouts.app')
@section('content')
    @foreach ($categories as $index => $category) 
        <h5>{{$category->name}}</h5>
    @endforeach
@endsection