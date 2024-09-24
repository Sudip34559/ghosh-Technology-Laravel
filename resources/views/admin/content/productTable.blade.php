@extends('admin.layout.tableLayout')
@section('tableName', 'Product Table')
@section('cardHeader')
           @if (session('success'))
               <x-message message="{{session('success')}}"/>
           @endif
           @if (session('error'))
               <x-message type="danger" message="{{session('error')}}"/>
           @endif
<div style="display: flex; justify-content: space-evenly">
    <div>
        <a href="{{route('export.pdf')}}" class="btn btn-primary btn-sm">PDF</a>
        <a href="{{route('export.csv')}}" class="btn btn-primary btn-sm">CSV</a>
    </div>
        <div style="width: 30%">
            <input type="text" id="search-input" class="form-control" placeholder="Search products..." oninput="fetchData()"> 
        </div>
      <div>
        <button class="btn btn-success btn-sm" onclick="openForm()">Add Product</button>
        <button class="btn btn-success btn-sm" onclick="showCSVDialog()">Add CSV File</button>
        <div class="modal fade" id="formDialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmDialogLabel">Add Product</h5>
                </div>
                <form id="csv-form" method="POST" action="{{route('product.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Product Quantity:</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity" required>
                        </div>
                     </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="closeCreateBtn">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="confirmCreateBtn">Add</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          
        
         </div>

        
<div class="modal fade" id="confirmDialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmDialogLabel">Import Product CSV File</h5>
                </div>
                <form id="csv-form" method="POST" action="{{ route('prodlist.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                     </div>
                <div class="modal-footer" style="display: flex; justify-content: space-evenly">
                    <a href="{{ route('show.csv') }}">View Example File</a>
                    <div>
                        <button type="button" class="btn btn-secondary" id="closeDeleteBtn">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="confirmDeleteBtn">Import</button>
                    </div>
                  
                </div>
                </form>
              </div>
            </div>
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
<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center" style="width: 100px">
                S.No
                <span onclick="sortTable('id')" id="sort-icon-id" class="sort-icon">↑</span>
            </th>
            <th class="text-center">
                Product Name
                
            </th>
            <th class="text-center">
                Quantity
                <span onclick="sortTable('qty')" id="sort-icon-name" class="sort-icon">↑</span>
            </th>
            <th class="text-center" style="width: 300px">Action</th>
        </tr>
    </thead>
    <tbody id="product-table-body">
        @foreach ($products as $product)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $product->prod_list }}</td>
                <td class="text-center">{{ $product->qty }}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm" onclick="updateProduct({{ $product->qty }},'{{$product->prod_list}}',{{$product->qty }})" >Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct({{ $product->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="pagination-links" class="mt-4">
    {{ $products->links() }}
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="updateDialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDialogLabel">Update Product</h5>
            </div>
            <form id="product-form" method="POST" action="{{route('products.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- Hidden input to store the product ID -->
                <input type="hidden" id="product-id" name="id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="updatename">Product Name:</label>
                        <input type="text" class="form-control" id="updatename" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="updatequantity">Product Quantity:</label>
                        <input type="text" class="form-control" id="updatequantity" placeholder="Enter Quantity" name="quantity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeUpdateBtn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmUpdateBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deletDialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDialogLabel">Delete Product</h5>
            </div>
            <form id="product-form" method="POST" action="{{route('products.delete')}}" >
                @csrf
                @method('DELETE')
                <!-- Hidden input to store the product ID -->
                <input type="hidden" id="delete-id" name="id">

                <div class="modal-body">
                   Are you sure you want to delete this product
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeDelete">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="DeleteBtn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
        fetch(`{{ route('products.index') }}?column=${currentColumn}&order=${currentOrder}&page=${page}&search=${encodeURIComponent(searchQuery)}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            updateTable(data.data);
            document.getElementById('pagination-links').innerHTML = data.pagination;
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    function updateTable(products) {
        let tableBody = document.getElementById('product-table-body');
        tableBody.innerHTML = '';
        products.forEach((product, index) => {
            let row = `<tr>
                <td class="text-center">${index+1}</td>
                <td class="text-center">${product.prod_list}</td>
                <td class="text-center">${product.qty}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm" onclick="updateProduct(${product.id},'${product.prod_list}',${product.qty})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Delete</button>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function deleteProduct(id) {
        document.getElementById('delete-id').value = id;
        const deleteDialog = new bootstrap.Modal(document.getElementById('deletDialog'));
        deleteDialog.show();
        document.getElementById('closeDelete').addEventListener('click', function() {
            deleteDialog.hide();
        })
        document.getElementById('DeleteBtn').addEventListener('click', function() {s
            confirmDialog.hide();
        })
    }

    function updateProduct(id, name, quantity) {
        // console.log(id,name,quantity);
        document.getElementById('product-id').value = id;
        document.getElementById('updatename').value = name;
        document.getElementById('updatequantity').value = quantity;
        const updateDialog = new bootstrap.Modal(document.getElementById('updateDialog'));
        updateDialog.show();
        document.getElementById('confirmUpdateBtn').addEventListener('click', function() {
            updateDialog.hide();
        })
        document.getElementById('closeUpdateBtn').addEventListener('click', function() {
            updateDialog.hide();
        })

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
    // Open form for adding a new product
    function showCSVDialog() {
        const confirmDialog = new bootstrap.Modal(document.getElementById('confirmDialog'));
        confirmDialog.show();

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            confirmDialog.hide();
        });
        document.getElementById('closeDeleteBtn').addEventListener('click', function() {
            confirmDialog.hide();
        });
    }
    function openForm() {
        const confirmDialog = new bootstrap.Modal(document.getElementById('formDialog'));
        confirmDialog.show();

        document.getElementById('confirmCreateBtn').addEventListener('click', function() {
            confirmDialog.hide();
        });
        document.getElementById('closeCreateBtn').addEventListener('click', function() {
            confirmDialog.hide();
        });
    }
    

    
</script>
@endsection
