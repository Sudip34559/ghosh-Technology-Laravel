
@extends('admin.layout.layout')

@section('adminContent')

@if (session('success'))
<x-message message="{{session('success')}}"/>
   @endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
@endif

<!-- Main content -->
<section class="content mt-5">
  <div class="container-fluid" >
    <div class="row" style="display: flex; justify-content:center; align-items: center;">
      <div class="col-12" style="max-width: 1000px">
        <div class="card" >
          <div class="card-header">
            <h1>
              Edit Ragistration
            </h1>
           
          </div>
          <div class="card-body">
            <form role="form" action="{{route('registration.update',$registration->id )}}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                    <label for="product">Product</label>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle form-control @error('product_id') is-invalid btn-outline-danger @enderror" type="button" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: 1px solid; border-color:#ced4da; text-align: left; color: #6c757d;">
                            {{ $registration->products->prod_list ?? 'Select Product' }}
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="customDropdown" style="max-height: 200px; overflow-y: auto; overflow-x: hidden; padding: 0;">
                            <input class="form-control" id="searchInput" type="text" placeholder="Search..." style="margin: 8px; border-radius: 0; width: calc(100% - 16px);">
                            @foreach($product as $prod)
                                <li>
                                    <a class="dropdown-item" data-value="{{ $prod->id }}" {{ $registration->product == $prod->id ? 'selected' : '' }}>{{ $prod->prod_list }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="product_id" id="product" value="{{ $registration->product}}">
                    @error('product_id')
                    <span class="text-danger small">  {{$message}}</span>
                    @enderror
                </div>

                <!-- Other form fields with existing data -->
                <div class="form-group">
                    <label for="installation_date">Installation Date</label>
                    <input type="date" value="{{ $registration->installation_date ?? old('installation_date') }}" class="form-control @error('installation_date') is-invalid @enderror" id="installation_date" name="installation_date">
                    @error('installation_date')
                    <span class="text-danger small">  {{$message}}</span>
                    @enderror
                </div>
            <div class="form-group">
              <label for="expiry_date">Expiry Date</label>
              <input type="date" value="{{ $registration->expiry_date ?? old('expiry_date') }}" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" >
              @error('expiry_date')
              <span class="text-danger small">  {{$message}}</span>
             @enderror
            </div>
                  
                  <!-- Renewal Key -->
                  <div class="form-group">
                    <label for="renewal_key">Renewal Key</label>
                    <input type="text" value="{{ $registration->renewal_key ?? old('renewal_key') }}" class="form-control @error('renewal_key') is-invalid @enderror" id="renewal_key" name="renewal_key" placeholder="Enter Renewal Key">
                    @error('renewal_key')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
                  </div>
                  <!-- Installed By -->
                  <div class="form-group">
                      <label for="ins_by">Installed By</label>
                      <select class="form-control @error('ins_by') is-invalid @enderror" id="ins_by" name="ins_by" >
                        <option value="">Select Installer</option>
                        @foreach($installBy as $installer)
                            <option value="{{ $installer->id }}" {{ $registration->ins_by == $installer->id ? 'selected' : '' }}>{{ $installer->install_by }}</option> 
                        @endforeach
                    </select>
                    @error('ins_by')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
                  </div>
                  
                  <!-- Call By -->
                  <div class="form-group">
                    <label for="call_by">Call By</label>
                    <select class="form-control @error('call_by') is-invalid @enderror" id="call_by" name="call_by" >
                      <option value="">Select Caller</option>
                      @foreach($callBy as $caller)
                          <option value="{{ $caller->id }}" {{ $registration->call_by == $caller->id ? 'selected' : '' }}>{{ $caller->call_by }}</option> 
                      @endforeach
                  </select>
                  
                  @error('call_by')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
              
                </div>
                  <!-- Customer Name -->
                  <div class="form-group">
                      <label for="customer_name">Customer Name</label>
                      <input type="text" value="{{ $registration->customer_name ?? old('customer_name') }}" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="Enter Customer Name" >
                      @error('customer_name')
                    <span class="text-danger small">  {{$message}}</span>
                     @enderror
                    </div>
                  <!-- Email ID -->
                  <div class="form-group">
                      <label for="email_id">Email ID</label>
                      <input type="email" value="{{ $registration->email_id ?? old('email_id') }}" class="form-control" id="email_id" name="email_id" placeholder="Enter Email" >
                  </div>

                  <!-- Mobile Number -->
                  <div class="form-group">
                      <label for="mobile_no">Mobile Number</label>
                      <input type="text" value="{{ $registration->mobile_no ?? old('mobile_no') }}" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number" >
                    
                    </div>
                  <!-- Address -->
                  <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address">{{ $registration->address ?? old('address') }}</textarea>
                </div>
                  <!-- Product Keys -->
                  <div class="form-group">
                      <label for="product_keys">Product Keys</label>
                      <div class="row">
                          <!-- Generate fields dynamically -->
                          <div class="col-md-4">
                            <input type="text" value="{{ $registration->product_key_1 ?? old('product_key_1') }}" class="form-control mb-2" name="product_key_1" placeholder="Product Key 1">
                              <input type="text" value="{{ $registration->product_key_2 ?? old('product_key_2') }}" class="form-control mb-2" name="product_key_2" placeholder="Product Key 2">
                              <input type="text" value="{{ $registration->product_key_3 ?? old('product_key_3') }}" class="form-control mb-2" name="product_key_3" placeholder="Product Key 3">
                              <input type="text" value="{{ $registration->product_key_4 ?? old('product_key_4') }}" class="form-control mb-2" name="product_key_4" placeholder="Product Key 4">
                              <input type="text" value="{{ $registration->product_key_5 ?? old('product_key_5') }}" class="form-control mb-2" name="product_key_5" placeholder="Product Key 5">
                          </div>
                          <div class="col-md-4">
                              <input type="text" value="{{ $registration->product_key_6 ?? old('product_key_6') }}" class="form-control mb-2" name="product_key_6" placeholder="Product Key 6">
                              <input type="text" value="{{ $registration->product_key_7 ?? old('product_key_8') }}" class="form-control mb-2" name="product_key_7" placeholder="Product Key 7">
                              <input type="text" value="{{ $registration->product_key_8 ?? old('product_key_8') }}" class="form-control mb-2" name="product_key_8" placeholder="Product Key 8">
                              <input type="text" value="{{ $registration->product_key_9 ?? old('product_key_9') }}" class="form-control mb-2" name="product_key_9" placeholder="Product Key 9">
                              <input type="text" value="{{ $registration->product_key_10 ?? old('product_key_10') }}" class="form-control mb-2" name="product_key_10" placeholder="Product Key 10">
                          </div>
                      </div>
                  </div>
                  
                 
                  
                  <!-- Batch Number -->
                  <div class="form-group">
                      <label for="batch_no">Batch Number</label>
                      <input type="text" value="{{ $registration->batch_no ?? old('batch_no') }}" class="form-control" id="batch_no" name="batch_no" placeholder="Enter Batch Number">
                  </div>
                   <!-- Amount -->
                   <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" value="{{ $registration->amount ?? old('amount') }}" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Enter Amount">
                    @error('amount')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
                </div>
                  <!-- Payment Received By -->
                  <div class="form-group">
                      <label for="pay_recv_by">Payment Received By</label>
                      <select class="form-control @error('pay_recv_by') is-invalid @enderror" id="pay_recv_by" name="pay_recv_by" >
                        <option value="">Select Payment Receiver</option>
                        @foreach($payRcvBy as $receiver)
                            <option value="{{ $receiver->id }}" {{ $registration->payment_received_by == $receiver->id ? 'selected' : '' }}>{{ $receiver->pay_recv_by }}</option> 

                        @endforeach
                      </select>
                    @error('pay_recv_by')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
                  </div>
                  <!-- Company Code -->
                  <div class="form-group">
                      <label for="com_code">Company Code</label>
                      <select class="form-control @error('com_code') is-invalid @enderror" id="com_code" name="com_code" >
                        <option value="">Select Company Code</option>
                        @foreach($compCode as $code)
                            <option value="{{ $code->com_code  }}" {{ $registration->com_code == $code->com_code ? 'selected' : '' }}>{{ $code->com_code }}</option> 
                        @endforeach
                    </select>
                    @error('com_code')
                    <span class="text-danger small">  {{$message}}</span>
                   @enderror
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
          </form>
          </div>
        </div>
      </div>

    </div>
 
</section>
<script>
  // Search filter functionality
  document.getElementById('searchInput').addEventListener('input', function () {
      let filter = this.value.toUpperCase();
      let items = document.querySelectorAll('.dropdown-item');

      items.forEach(function (item) {
          let text = item.textContent || item.innerText;
          item.style.display = text.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
      });
  });

  // Update the button text and hidden select when an option is selected
  document.querySelectorAll('.dropdown-item').forEach(function (item) {
      item.addEventListener('click', function () {
          // Set the button text
          document.getElementById('customDropdown').textContent = this.textContent;
          // Set the hidden select value
          document.getElementById('product').value = this.getAttribute('data-value');
        //   console.log(this.getAttribute('data-value'));
      });
  });

  // Focus style for the button when clicked
  document.getElementById('customDropdown').addEventListener('focus', function () {
      this.classList.add('btn-outline-primary'); // Adding focus style class
  });

  document.getElementById('customDropdown').addEventListener('blur', function () {
      this.classList.remove('btn-outline-primary'); // Removing focus style class
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

@endsection



