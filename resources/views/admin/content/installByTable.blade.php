@extends('admin.layout.twoTableLayput')
@section('tableName', 'Inatall by and Call by Table')
@section('1stTableHead')
          @if (session('success'))
               <x-message message="{{session('success')}}"/>
           @endif
           @if (session('error'))
               <x-message type="danger" message="{{session('error')}}"/>
           @endif

        <h1>
            Installer
        </h1>
@endsection

@section('2ndTableHead')
 <h1>
    Caller 
 </h1>
@endsection
@section('1stTable')
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 20px">S.No</th>
            <th class="text-center">Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($installBy as $install)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $install->install_by }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('2ndTable')
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 20px">S.No</th>
            <th class="text-center">Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($callBy as $call)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $call->call_by }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection