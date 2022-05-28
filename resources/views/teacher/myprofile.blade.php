@extends('layouts.app')

@section('content')
<h1>{{Auth::user()->teacher()->first()}}</h1>

@endsection
