@extends('admin.layout.tableLayout')

@section('tableName', 'Contuct Us Table')

@section('table')
@if (session('success'))
    <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contact_us as $request)
            <tr>
                <!-- Name -->
                <td>{{ $request->name }}</td>
                
                <!-- Phone Number -->
                <td>{{ $request->phone}}</td>
                
                <!-- Email -->
                <td>{{ $request->email }}</td>
                
                <!-- Message -->
                <td>{{ $request->message }}</td>
                @php
                    $formattedDate = \Carbon\Carbon::parse($request->submit_time)->format('d/m/Y \a\t h:i A');
                @endphp
                <td>{{$formattedDate}}</td>
                <!-- Action -->
                <td>
                      <a href="{{route('contuctUs.destroy',$request->id )}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </td>
            
            </tr>
        @endforeach
    </tbody>
</table>
@endsection