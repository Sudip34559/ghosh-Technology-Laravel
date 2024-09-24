
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
        <div class="card">
          <div class="card-header">
            <h1>
              Register Employee
            </h1>
           
          </div>
         
          <form action="{{route('createEmployees')}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Role Dropdown Field -->
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" >
                        <option value="">Choose...</option>
                        <option value="caller" {{ old('role') == 'caller' ? 'selected' : '' }}>Caller</option>
                        <option value="installer" {{ old('role') == 'installer' ? 'selected' : '' }}>Installer</option>
                        <option value="both" {{ old('role') == 'both' ? 'selected' : '' }}>Both</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
            </div>
        
            <!-- Register Button -->
            <div class="card-footer">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" style="width: 100px">Register</button>
                </div>
            </div>
        </form>
        
        </div>
      </div>

    </div>
  </div>
</section>


@endsection



