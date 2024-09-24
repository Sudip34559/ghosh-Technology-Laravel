@extends('admin.layout.layout')

@section('adminSection')
  
@if (session('success'))
  <x-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-message type="danger" message="{{session('error')}}"/>
 @endif
 <div class="content-wrapper pt-4">
        <div class="card m-auto" style="max-width: 882px">
            <div class="card-header">
                <h3 class="card-title">Upload Event</h3>
                <div class="float-end flex-1 d-flex justify-content-end">
                    <a href="{{route('textSlider.delete')}}" class="btn btn-danger btn-sm">Delete Existing Evevt</a>
                </div>
            </div>
            <div>
                
            </div>
            <form action="{{route('textSlider.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="slidText1" class="form-label">Event Text 1</label>
                        <input type="text" class="form-control @error('slidText1') is-invalid @enderror" id="slidText1" name="slidText1" value="{{ old('slidText1') }}" >
                        @error('slidText1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <!-- Slid Text 2 Input -->
                    <div class="mb-3">
                        <label for="slidText2" class="form-label">Event Text 2</label>
                        <input type="text" class="form-control @error('slidText2') is-invalid @enderror" id="slidText2" name="slidText2" value="{{ old('slidText2') }}" >
                        @error('slidText2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <!-- Slid Text 3 Input -->
                    <div class="mb-3">
                        <label for="slidText3" class="form-label">Event Text 3</label>
                        <input type="text" class="form-control @error('slidText3') is-invalid @enderror" id="slidText3" name="slidText3" value="{{ old('slidText3') }}" >
                        @error('slidText3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <!-- Slid Text 4 Input -->
                    <div class="mb-3">
                        <label for="slidText4" class="form-label">Event Text 4</label>
                        <input type="text" class="form-control @error('slidText4') is-invalid @enderror" id="slidText4" name="slidText4" value="{{ old('slidText4') }}">
                        @error('slidText4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
 </div>
@endsection