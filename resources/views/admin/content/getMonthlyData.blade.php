@extends('admin.layout.layout')

@section('adminSection')

<!-- Display Call Records -->
<div class="content-wrapper">
    <div class=" pt-4">
        <div>
            <form class="ml-5 mr-5">
             <div class="row ml-2" style="display: flex">
               <div class="">
                <input type="month" id="month-year" name="month_year" required>
               </div>
        
               <div class=" ml-3 ">
                <button type="submit" class="btn btn-primary btn-sm">Filter Data</button>
               </div>
            </form>
        </div>
        
        @if(isset($registrations) && $registrations->count() > 0)
        <div class="card ml-5 mr-5">
                 <div class="card-header"> 
                  <div class="ml-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Month: {{ $month }}/{{$year}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Total Records: {{ $count }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Total Calls:{{$callDoneCount}} </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Total Review:{{$reviewCount}}</h5>
                        </div>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Ins Date</th>
                            <th>User Details</th>
                            <th>Product</th>
                            <th>Call Done</th>
                            <th>Call Comment</th>
                            <th>Review</th>
                            <th>Review Comment</th>
                             @if (Auth::user()->role !== 'admin')
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $reg)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    @php
                                        $installation = new DateTime($reg->installation_date);
                                        $installation_date = $installation->format('d/m/Y');
                                    @endphp
                                    <td class="text-center">{{ $installation_date}}</td>
                                    <td>Name: {{ $reg->customer_name }} <br>Phone No: {{ $reg->mobile_no ?? 'N/A'}} <br>Email: {{ $reg->email_id ?? 'N/A'}}  </td>
                                    <td class="text-center">{{ $reg->products !== null ? $reg->products->prod_list : 'N/A' }}</td>
                                    <td class="text-center">
                                      
                                      
                                      @if($reg->call_done === 'Yes') 
                                      🟢
                                      @elseif($reg->call_done === 'No') 
                                      🔴
                                      @elseif($reg->call_done === 'Not Connected') 
                                      🟡
                                      @endif
                                 
                                    
                                    </td>
                                    <td class="text-center">{{ $reg->call_comment ?? 'N/A' }}</td>
                                    <td class="text-center">
                                       @if($reg->review === 'Yes') 
                                      🟢
                                      @elseif($reg->review === 'No') 
                                      🔴
                                      @elseif($reg->review === 'Not Connected') 
                                      🟡
                                      @endif
                                    </td>
                                    <td class="text-center">{{ $reg->review_comment ?? 'N/A' }}</td>
                                     @if (Auth::user()->role !== 'admin')
                                    <td class="text-center">
                                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#callReviewModal" 
                                      onclick="update({{$reg->id}}, {{$reg}})"
                                      @if (($reg->call_done === 'Yes' || $reg->call_done === 'No') && 
                                           ($reg->review === 'Yes' || $reg->review === 'No'))
                                          disabled 
                                      @endif
                                 >
                                  Call Now
                              </button>
                              
                                </td>
                                @endif
                                </tr>
                            @endforeach
                    </tbody>
                    </table>
                </div>    
                <div class="card-footer d-flex justify-content-center" id="pagination-links">
                    {{ $registrations->appends(request()->query())->links() }}
                </div>
        </div>
       @endif
    </div>
</div>
@if(isset($registrations) && $registrations->count() > 0)      

<!-- Modal -->
<div class="modal fade" id="callReviewModal" tabindex="-1" role="dialog" aria-labelledby="callReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('registration.updateStatus')}}" method="POST" id="form">
        @csrf <!-- Laravel CSRF token for form submission -->
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="month_year" value="{{ request('month_year') }}">
        <input type="hidden" name="page" value="{{ request('page') }}">
        <div class="modal-header">
          <h5 class="modal-title" id="callReviewModalLabel">Call Review Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Call Done -->
          <div class="form-group" id="call_done2">
            <label for="call_done">Call Done</label>
            <select class="form-control" id="call_done" name="call_done" >
              <option value="Not Connected">Not Connected</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
          <!-- Call Comment -->
          <div class="form-group" id="call_comment2">
            <label for="call_comment">Call Comment</label>
            <textarea class="form-control" id="call_comment" name="call_comment" rows="3"></textarea>
          </div>

          <!-- Review -->
          <div class="form-group" id="review2">
            <label for="review">Review</label>
            <select class="form-control" id="review" name="review" >
              <option value="Not Connected">Not Connected</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <!-- Review Comment -->
          <div class="form-group" id="review_comment2">
            <label for="review_comment">Review Comment</label>
            <textarea class="form-control" id="review_comment" name="review_comment" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function update(id, data) {
      $('#id').val(id);
      $('#form')[0].reset();

      // Call Done Logic
      $('#call_done').val(data.call_done);
      $('#call_comment').val(data.call_comment);

      if (data.call_done === 'Not Connected') {
          // Show call_done and call_comment when "Not Connected"
          $('#call_done').prop('disabled', false).show();
          $('#call_comment').prop('readonly', false).show();
      } else {
          // Hide call_done and call_comment when "Yes" or "No" and keep values
          $('#call_done2').hide();
          $('#call_comment2').hide();

          // Ensure the values are still sent to the controller
          $('#form').append(`
              <input type="hidden" name="call_done" value="${data.call_done}">
              <input type="hidden" name="call_comment" value="${data.call_comment}">
          `);
      }

      // Review Logic
      $('#review').val(data.review);
      $('#review_comment').val(data.review_comment);

      if (data.review === 'Not Connected') {
          // Show review and review_comment when "Not Connected"
          $('#review').prop('disabled', false).show();
          $('#review_comment').prop('readonly', false).show();
      } else {
          // Hide review and review_comment when "Yes" or "No" and keep values
          $('#review2').hide();
          $('#review_comment2').hide();

          // Ensure the values are still sent to the controller
          $('#form').append(`
              <input type="hidden" name="review" value="${data.review}">
              <input type="hidden" name="review_comment" value="${data.review_comment}">
          `);
      }
  }

  // Make sure hidden fields are sent to the controller
  $('#form').on('submit', function() {
      if ($('#call_done').is(':hidden')) {
          $('#call_done').prop('disabled', false);
      }
      if ($('#review').is(':hidden')) {
          $('#review').prop('disabled', false);
      }
  });
</script>



@endif

    
@endsection