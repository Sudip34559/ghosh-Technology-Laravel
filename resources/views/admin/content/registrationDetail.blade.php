@extends('admin.index')
@section('adminContent')
   <section class="content mt-5">
    <div class="container-fluid"  style="display: flex; justify-content:center; align-items: center;">
      <div class="row" style="max-width: 1060px">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h2>Registration Details</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width:500px">Expiry Date</th>
                            <td>{{ $registration->expiry_date }}</td>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <td>{{ $registration->products->prod_list ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Installation Date</th>
                            <td>{{ $registration->installation_date }}</td>
                        </tr>
                        <tr>
                            <th>Installed By</th>
                            <td>{{ $registration->installedBy->install_by ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $registration->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $registration->email_id ? $registration->email_id : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Mobile No</th>
                            <td>{{ $registration->mobile_no ? $registration->mobile_no : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Product Key 1</th>
                            <td>{{ $registration->product_key_1 ? $registration->product_key_1 : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 2</th>
                            <td>{{ $registration->product_key_2 ? $registration->product_key_2 : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 3</th>
                            <td>{{ $registration->product_key_3 ? $registration->product_key_3  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 4</th>
                            <td>{{ $registration->product_key_4 ? $registration->product_key_4  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 5</th>
                            <td>{{ $registration->product_key_5 ? $registration->product_key_5  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 6</th>
                            <td>{{ $registration->product_key_6 ? $registration->product_key_6  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 7</th>
                            <td>{{ $registration->product_key_7 ? $registration->product_key_7  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 8</th>
                            <td>{{ $registration->product_key_8 ? $registration->product_key_8  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 9</th>
                            <td>{{ $registration->product_key_9 ? $registration->product_key_9  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Product Key 10</th>
                            <td>{{ $registration->product_key_10 ? $registration->product_key_10  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Renewal Key</th>
                            <td>{{ $registration->renewal_key ? $registration->renewal_key  : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $registration->amount ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $registration->address ? $registration->address :'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Batch No</th>
                            <td>{{ $registration->batch_no ? $registration->batch_no : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Called By</th>
                            <td>{{ $registration->calledBy->call_by ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Payment Received By</th>
                            <td>{{ $payment->pay_recv_by ?? 'N/A' }}</td> <!-- Adjust field as necessary -->
                        </tr>
                        <tr>
                            <th>Com Code</th>
                            <td>{{ $registration->com_code ??  'N/A'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('registrations.index') }}" class="btn btn-primary">Back to List</a>
            </div>
            <!-- /.card-footer -->

          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
   


@endsection