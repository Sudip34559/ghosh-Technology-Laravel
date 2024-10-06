@extends('admin.layout.tableLayout')

@section('tableName', 'Registration Table')

@section('cardHeader')
@if (session('success'))
    <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
@endif

<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <a href="{{route('registration.export')}}" class="btn btn-success btn-sm">Download CSV</a>
    </div>
    <div style="width: 30%;">
        <input type="text" id="search-input" class="form-control" placeholder="Search registrations..." oninput="fetchData()">
    </div>
</div>
@endsection

@section('table')
@if (session('success'))
    <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
@endif

<table id="registration-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 100px">
                No
                <span onclick="sortTable('id')" id="sort-icon-installation_date" class="sort-icon">↑</span>
            </th>
            <th class="text-center">Product</th>
            <th class="text-center">
                Installation Date
                <!--<span onclick="sortTable('installation_date')" id="sort-icon-installation_date" class="sort-icon">↑</span>-->
            </th>
            <th class="text-center">
                Expiry Date
                <span onclick="sortTable('expiry_date')" id="sort-icon-expiry_date" class="sort-icon">↑</span>
            </th>
            <th class="text-center">
                Customer
            </th>
            {{-- <th class="text-center">Installed By</th>
            <th class="text-center">Call By</th> --}}
            <th class="text-center" style="width: 200px; min-width: 150px;">Action</th>
        </tr>
    </thead>
    <tbody id="registration-table-body">
        @foreach ($registrations as $registration)
            <tr>
                <td class="text-center">{{ $registration->id }}</td>
                <td class="text-center">{{ $registration->products->prod_list}}</td>
                <td class="text-center">
                    @php
                    $installation = new DateTime($registration->installation_date);
                    $expiry = new DateTime($registration->expiry_date);
                    $installation_date = $installation->format('d/m/Y');
                    $expiry_date = $expiry->format('d/m/Y');
                    @endphp
                    {{ $installation_date }}
                </td>
                <td class="text-center">{{ $expiry_date }}</td>
                <td class="text-center">{{ $registration->customer_name }}</td>
                <td class="text-center">
                    <a href="{{route('registration.show',$registration->id )}}" class="btn btn-info btn-sm">Details</a>
                      <a href="{{route('registration.edit',$registration->id)}}" class="btn btn-warning btn-sm disabled"
                        >Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="pagination-links" class="mt-4">
    {{ $registrations->links() }}
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">




<script>
    let currentOrder = 'asc';
    let currentColumn = 'id';
    let searchQuery = '';

    function sortTable(column) {
        if (currentColumn === column) {
            currentOrder = (currentOrder === 'asc') ? 'desc' : 'asc';
        } else {
            currentColumn = column;
            currentOrder = 'asc';
        }
        fetchData();
    }

    function fetchData(page = 1) {
        searchQuery = document.getElementById('search-input').value;
        fetch(`{{ route('registrations.index') }}?column=${currentColumn}&order=${currentOrder}&page=${page}&search=${encodeURIComponent(searchQuery)}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data.data[0].installedBy);
            updateTable(data.data, page);
            document.getElementById('pagination-links').innerHTML = data.pagination;
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    function updateTable(registrations, page = 1) {
        let tableBody = document.getElementById('registration-table-body');
        tableBody.innerHTML = '';
        registrations.forEach((registration, index) => {
            let detailsUrl = `/registration/${registration.id}`;p
            
            let editUrl = `/edit-registration/${registration.id}`
            let row = `<tr>
                <td class="text-center">${index + 1}</td>
                <td class="text-center">${registration.products.prod_list}</td>
                <td class="text-center">${registration.installation_date.replace(/-/g, '/')}</td>
                <td class="text-center">${registration.expiry_date.replace(/-/g, '/')}</td>
                <td class="text-center">${registration.customer_name }</td>
                <td class="text-center">
                    <a href="${detailsUrl}"  class="btn btn-info btn-sm">Details</a>
                    <a href='${editUrl}' class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Handle pagination links
        document.addEventListener('click', (e) => {
            if (e.target.matches('.pagination a')) {
                e.preventDefault();
                let page = new URL(e.target.href).searchParams.get('page');
                fetchData(page);
            }
        });

        // Fetch initial data
        fetchData();
    });

    function showDetails(id) {
        // Implement the function to show details of a registration
    }

    function editRegistration(id) {
        // Implement the function to edit a registration
    }
</script>

<style>
.sort-icon {
    cursor: pointer;
    margin-left: 5px;
}

.sort-icon.asc::after {
    content: "↑"; /* Up arrow */
}

.sort-icon.desc::after {
    content: "↓"; /* Down arrow */
}
</style>
@endsection
