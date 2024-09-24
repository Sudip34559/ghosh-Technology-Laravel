@props([
   'data' => []
])
{{-- @dd( 
$data
) --}}
@extends('welcome')
@section('display')
   <x-header :headers="$data"/>
      {{$slot}}
   <x-footer/>
@endsection