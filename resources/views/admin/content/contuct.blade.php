@extends('admin.layout.tableLayout')

@section('tableName', 'Contact Table')

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
            <th>Phone</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
            <tr>
                <!-- Name -->
                <td>{{ $contact->name }}</td>
                
                <!-- Phone -->
                <td>{{ $contact->phone }}</td>
                
                <!-- Message -->
                <td>{{ $contact->message }}</td>
                @php
                    $formattedDate = \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y \a\t h:i A');
                @endphp
                <td>{{$formattedDate}}</td>
                
                <!-- Delete Button -->
                <td>
                     <a href="{{route('contucts.destroy',$contact->id )}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection