@extends('layouts.admin')

@section('content')







    @if(auth()->user()->userHasRole('Admin'))
    <h1>Dashboard</h1>


    @endif






@endsection 