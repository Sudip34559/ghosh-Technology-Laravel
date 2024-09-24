@extends('admin.layout.tableLayout')

@section('cardHeader')
  
@if (session('success'))
  <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
 @endif

        <div class="card">
            <div class="card-header">
                <h2 >Upload Image</h2>
                <h3 class="card-title">(1312 ✕ 736 )</h3>
            </div>
            <!-- form start -->
            <form action="{{route('sliderImage.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Choose Image</label>
                        <input type="file" name="slider_image" class="form-control" id="image" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
   
@endsection


@section('table')
<div class="d-flex justify-content-center align-items-center">
<table class="table table-bordered" style="max-width: 700px">
    <thead>
    <tr>
        <th>Image</th>
        <th style="width: 200px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($images as $key => $image)
        <tr>
            <td>
                <img src="{{ asset('storage/' . $image->image) }}" alt="image" class="img-thumbnail"
                     style="width: 100px; cursor: pointer;"
                     data-bs-toggle="modal" data-bs-target="#imageModal{{ $key }}">
            </td>
            <td>
                <a href="{{route('sliderImage.delete',$image->id )}}" class="btn btn-danger">Delete</button>
            </td>
        </tr>

        <!-- Modal for each image -->
        <div class="modal fade" id="imageModal{{ $key }}" tabindex="-1" aria-labelledby="imageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image View</h5>
                        
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="image" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <a href="" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endsection
