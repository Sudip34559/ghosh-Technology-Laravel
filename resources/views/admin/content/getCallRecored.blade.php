@extends('admin.layout.layout')

@section('adminSection')

@if (session('success'))
    <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
@endif

<div class="content-wrapper">
    <div class="container pt-4">
        <form method="GET" class="row m-auto" action="{{ route('callRecords.index') }}">
            @csrf
            <div class="form-group col-md-3">
                <label for="call_status">Call Status</label>
                <select class="form-control @error('case_id') is-invalid @enderror" id="case_id" name="case_id">
                    <option value="null">Select Call Status</option>
                    @foreach($caseStatus as $status)
                        <option value="{{ $status->id }}" {{ old('case_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->case_status }}
                        </option>
                    @endforeach
                </select>
                @error('case_id')
                <span class="text-danger small ">  {{$message}}</span>
               @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="installation_date">Start Date</label>
                <input type="date" class="form-control @error('installation_date') is-invalid @enderror" id="installation_date" name="installation_date" value="{{ old('installation_date') }}" required>
                @error('installation_date')
                <span class="text-danger small">  {{$message}}</span>
               @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="expiry_date">End Date</label>
                <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required>
                @error('expiry_date')
                <span class="text-danger small">  {{$message}}</span>
               @enderror
            </div>
            <div class="form-group col-md-3" >
                <button type="submit" class="btn btn-primary" style="margin-top: 31px">Filter Data</button>
            </div> 
           
        </form>
        
        <!-- Display Call Records -->
        @if(isset($registrations) && $registrations->count() > 0)
        <div class="card mt-5" style="min-width: 882px">
            <div class="card-header" style="display:flex; gap:10px; align-items: center;">
            @php
                    
                $start = new DateTime($installationDate);
                $end = new DateTime($expiryDate);
                $startDate = $start->format('d/m/y');
                $endDate = $end->format('d/m/y');
            @endphp
                @if(isset($registrations) && $registrations->count() > 0)
                <form action="{{route('registration.renualExport')}}" method="POST"  >
                    @csrf
                    <input type="hidden" name="installation_date" value="{{ $installationDate }}">
                    <input type="hidden" name="expiry_date" value="{{ $expiryDate }}">
                    <input type="hidden" name="case_id" value="{{ old('case_id') }}">
                    <input type="hidden" name="page" value="{{ request('page') }}">
                    <button type="submit" class="btn btn-success mr-7">Imposr CSV</button>
                </form>
                @endif
               
                {{
                     "Expiry between $startDate and $endDate";
                }}

                
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            @php
                                $currentOrderid = request('order', 'asc');
                                $newOrderid = ($currentOrderid === 'asc') ? 'desc' : 'asc';
                            @endphp
                            No
                            <a href="{{ route('callRecords.index', array_merge(request()->query(), ['column' => 'id', 'order' => $newOrderid])) }}">
                                @if($newOrderid === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            </a>
                        </th>
                        
                        <th>
                            @php
                                $currentOrderins = request('order', 'asc');
                                $newOrderins = ($currentOrderins === 'asc') ? 'desc' : 'asc';
                            @endphp
                            Install
                            <a href="{{ route('callRecords.index', array_merge(request()->query(), ['column' => 'installation_date', 'order' => $newOrderins])) }}">
                                @if($currentOrderins === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            </a>
                        </th>
                        <th>Expiry</th>
                        <th>Call Status</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($registrations as $record)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @php
                                $installation = new DateTime($record->installation_date);
                                $expiry = new DateTime($record->expiry_date);
                                $installation_date = $installation->format('d/m/Y');
                                $expiry_date = $expiry->format('d/m/Y');
                                @endphp
                                {{ $installation_date }}
                            </td>
                            <td>{{ $expiry_date }}</td>
                            <td>
                                @if($record->callRecords->isEmpty())
                                    Not Recorded
                                @else
                                    @php
                                        $latestCallRecord = $record->callRecords->sortByDesc('created_tymeold')->first() // Get the first call record
                                    @endphp
                                   {{ $latestCallRecord->caseStatus->case_status ?? 'No Status' }}
                                    <br> 
                                    @php
                                        $time = $latestCallRecord->call_time ? new DateTime($latestCallRecord->call_time) : null;
                                        $call_time = $time ? $time->format('d/m/y') : '';
                                    @endphp
                                    {{ $latestCallRecord->call_time ? $call_time : '' }}
                                @endif
                            </td>
                            <td>{{ $record->products->prod_list }}</td>
                            <td>{{ $record->customer_name }}</td>
                            <td>
                                <a href="{{ route('callBooks.details', [
                                    'id' => $record->id, 
                                    'case_id' => request()->get('case_id'),
                                    'installation_date' => request()->get('installation_date'),
                                    'expiry_date' => request()->get('expiry_date'),
                                    '_token' => request()->get('_token'),
                                    'page' => request()->get('page') // Add the page parameter here
                                ]) }}" class="btn btn-info btn-sm">Details</a>
                            
                                <button class="btn btn-success btn-sm" onclick="updateProduct({{ $record->id }})">Call Book</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center" id="pagination-links">
                {{ $registrations->appends(request()->query())->links() }}
            </div>
        </div>
       
        
        @elseif(isset($registrations))
            <div class="mt-5">
                <h4>No Call Records found for the selected date range.</h4>
            </div>
        @endif
    </div>
</div>
@if(isset($registrations) && $registrations->count() > 0)
<div class="modal fade" id="callBook" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modelContent">
            <div class="modal-header">
               <h5 class="modal-title" id="confirmDialogLabel">Add Call Status</h5>
            </div>
            <div class="model-body">
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="col-md-5">
                        <ul id="callRecordsList">
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <form id="call-form" method="POST" action="{{route('callRecord.update')}}" >
                            @csrf
                            <div>
                                <input type="hidden" name="installation_date" value="{{ request('_token') }}">
                                <input type="hidden" name="installation_date" value="{{ request('installation_date') }}">
                                <input type="hidden" name="expiry_date" value="{{ request('expiry_date') }}">
                                <input type="hidden" name="case_id" value="{{ request('case_id') }}">
                                <input type="hidden" name="cust_id" id="cust_id" class="form-control" required>
                                
                                <div class="form-group">
                                    <label for="call_note">Call Note:</label>
                                    <textarea name="call_note" id="call_note" class="form-control" rows="4" ></textarea>
                                    @error('call_note')
                                    <span class="text-danger small">  {{$message}}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="call_status">Call Status:</label>
                                    <select class="form-control" id="call_status" name="call_status" >
                                        <option value="">Select Call Status</option>
                                        @foreach($callStatus as $status)
                                            <option value="{{ $status->id }}">{{ $status->case_status }}</option>
                                        @endforeach
                                    </select>
                                    @error('call_status')
                                    <span class="text-danger small">  {{$message}}</span>
                                @enderror
                                </div>
                                @php
                                    $today = \Carbon\Carbon::now()->format('Y-m-d');
                                @endphp
                                <div class="form-group" id="showInput" style="display: none">
                                    <label for="call_time">Call Time:</label>
                                    <input type="date" name="call_time" id="call_time" class="form-control" min={{$today}} >
                                </div>
                                
                                <div class="form-group">
                                    <label for="call_by">Call By:</label>
                                    <select class="form-control" id="call_by" name="call_by" >
                                        <option value="">Select Call By</option>
                                        @foreach($callBy as $by)
                                            <option value="{{ $by->id }}">{{ $by->call_by }}</option>
                                        @endforeach
                                    </select>
                                    @error('call_by')
                                    <span class="text-danger small">  {{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        <div class="modal-footer">
                            <div>
                                <button type="reset" class="btn btn-secondary" id="closeDeleteBtn">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="confirmDeleteBtn">Add</button>
                            </div>
                        
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        
    </div>
    </div>
   </div>
</div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    
    function updateProduct(id) {
        document.getElementById('cust_id').value = id;
        // Fetch the call records for the selected customer
        getData(id);
        const updateDialog = new bootstrap.Modal(document.getElementById('callBook'));
        updateDialog.show();
        var form = document.getElementById('call-form');
                if (form) {
                    form.reset(); // Reset the form
                }
            document.getElementById('showInput').style.display = 'none';
            const callRecordsList = document.getElementById('callRecordsList');
            callRecordsList.innerHTML = '';
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
           
                updateDialog.hide();
            
            
        });
        document.getElementById('closeDeleteBtn').addEventListener('click', function() {
            var form = document.getElementById('call-form');
                if (form) {
                    form.reset(); // Reset the form
                }
            document.getElementById('showInput').style.display = 'none';
            updateDialog.hide();
            const callRecordsList = document.getElementById('callRecordsList');
            callRecordsList.innerHTML = '';

        });
    }
     function getData(id) {
    // Fetch the ID dynamically or statically // Replace with the dynamic ID you're passing in the route

    // Fetch data from the server
    fetch(`/call-books/${id}`)
        .then(response => response.json()) // Convert the response to JSON
        .then(data => {
            // console.log(data);
            // Get the ul element to append the list items
            const callRecordsList = document.getElementById('callRecordsList');
            //  console.log(data);
            // Loop through the data and create list items
            data.forEach(callRecord => {
                // Create a new list item for each call record
                const li = document.createElement('li');
                li.textContent = ` Status: ${callRecord.case_status.case_status}, Date: ${callRecord.created_tyme.replace(/-/g, '/')}`;
                
                // Append the list item to the ul
                callRecordsList.appendChild(li);
            });
        })
        .catch(error => console.error('Error fetching call records:', error));
}

document.getElementById('call_status').addEventListener('change', function() {
        var selectedValue = this.value;
        var inputContainer = document.getElementById('showInput');

        // Show input field only if the specific option is selected
        if (selectedValue === '1' || selectedValue ==='9') {
            inputContainer.style.display = 'block';
        } else {
            inputContainer.style.display = 'none';
        }
    });

   

   
</script>

@endsection


