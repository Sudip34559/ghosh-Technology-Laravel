@extends('admin.layout.layout')

  @section('adminSection')
  
  @if (session('success'))
  <x-message message="{{session('success')}}"/>
     @endif
   @if (session('error'))
      <x-message type="danger" message="{{session('error')}}"/>
       @endif
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card p-4">
            <form action="{{route('headers.store')}}" method="POST">
                @csrf
            
                <!-- Main Header Input -->
                <div class="form-group">
                    <label for="main_header">Main Header</label>
                    <input type="text" class="form-control" id="main_header" name="main_header" required>
                </div>
            
                <!-- Sub Header Number Input -->
                <div class="form-group">
                    <label for="sub_header_count">Number of Sub Headers</label>
                    <input type="number" class="form-control" id="sub_header_count" name="sub_header_count" min="0" required value="{{ old('sub_header_count', 1) }}">
                </div>
            
                <!-- Dynamic Sub Headers -->
                <div id="sub_headers_container">
                    @for ($i = 0; $i < old('sub_header_count', 1); $i++)
                    <div class="form-row mb-3">
                        <!-- Sub Header Name -->
                        <div class="col-md-6">
                            <label for="sub_header_name_{{ $i }}">Sub Header Name {{ $i + 1 }}</label>
                            <input type="text" class="form-control" id="sub_header_name_{{ $i }}" name="sub_header_name[{{ $i }}]" required value="{{ old('sub_header_name.'.$i) }}">
                        </div>
            
                        <!-- Sub Header Link -->
                        <div class="col-md-6">
                            <label for="sub_header_link_{{ $i }}">Sub Header Link</label>
                            <input type="url" class="form-control" id="sub_header_link_{{ $i }}" name="sub_header_link[{{ $i }}]" required value="{{ old('sub_header_link.'.$i) }}">
                        </div>
                    </div>
                    @endfor
                </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </section>
     @if (isset($headers) && $headers->count() > 0)
     <div class="container-fluid">
        <div class="row" style="min-width: 882px">
          <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="mb-4">Header List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Main Header</th>
                                    <th>Sub Headers</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($headers) --}}
                                @foreach($headers as $header)
                                    <tr>
                                        <!-- Main Header -->
                                        <td>{{ $header->header }}</td>
                                        
                                        <!-- Sub Headers (as a list) -->
                                        <td>
                                            <ul>
                                                @foreach($header->subheader as $subHeaderName => $subHeaderLink)
                                                    <li>{{ $subHeaderName }} - <a href="{{ $subHeaderLink }}" target="_blank">{{ $subHeaderLink }}</a></li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        
                                        <!-- Delete Button -->
                                        <td>
                                        
                                                <a href="{{route('headers.destroy',$header->id )}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                </div>
          </div>
        </div>
      </div>
         
     @endif
 
</div>


  <script>
    document.getElementById('sub_header_count').addEventListener('change', function() {
        const count = parseInt(this.value);
        const container = document.getElementById('sub_headers_container');

        // Clear the existing subheader fields
        container.innerHTML = '';

        // Generate the new subheader input fields based on the count
        for (let i = 0; i < count; i++) {
            const subHeaderDiv = document.createElement('div');
            subHeaderDiv.classList.add('form-row', 'mb-3');

            subHeaderDiv.innerHTML = `
                <div class="col-md-6">
                    <label for="sub_header_name_${i}">Sub Header Name ${i + 1}</label>
                    <input type="text" class="form-control" id="sub_header_name_${i}" name="sub_header_name[${i}]" required>
                </div>
                <div class="col-md-6">
                    <label for="sub_header_link_${i}">Sub Header Link</label>
                    <input type="url" class="form-control" id="sub_header_link_${i}" name="sub_header_link[${i}]" required>
                </div>
            `;

            container.appendChild(subHeaderDiv);
        }
    });
</script>


  @endsection
  
