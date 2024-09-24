<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('Admin/assets/img/download.png')}}" alt="Logo" style="margin-left: 15px">
      <span class="brand-text font-weight-light">Ghose Technology</span>

    </a>
    <div  style="display: flex; justify-content: center; align-items: center;">
      <span class="brand-text font-weight-light" style="color: white; font-size:20px">ADMIN PANEL</span>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     
       
      

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.dashbord')}}" class="nav-link {{request()->routeIs('admin.dashbord') ?"active" : '' }}" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          
          </li>
          <li class="nav-item">
            <a href="{{route('registrations.index')}}" class="nav-link {{request()->routeIs('registrations.index') ?"active" : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                All Registrations
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('registration.monthly')}}" class="nav-link {{request()->routeIs('registration.monthly') ?"active" : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Monthly Registrations
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('callRecords.index')}}" class="nav-link {{request()->routeIs('callRecords.index') ?"active" : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Renewals
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="{{route('registration.form')}}" class="nav-link {{request()->routeIs('registration.form')  ? "active" : '' }}" >
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Registration Form
                {{-- <i class="fas fa-angle-left right"></i> --}}
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            
            <a href="#" class="nav-link {{request()->routeIs('products.index') || request()->routeIs('installBy.index') ?"active" : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link {{request()->routeIs('products.index') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('installBy.index')}}" class="nav-link {{request()->routeIs('installBy.index') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Install & Call by</p>
                </a>
              </li>
              
            </ul>
          </li>

          @if (Auth::user()->role === 'admin')
          <li class="nav-item">
            <a href="#" class="nav-link {{request()->routeIs('addEmployees') || request()->routeIs('employees')  ? "active" : '' }}" >
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('addEmployees')}}" class="nav-link {{request()->routeIs('addEmployees') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees')}}" class="nav-link {{request()->routeIs('employees') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employees Table</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#"class="nav-link {{request()->routeIs('headers.create') || request()->routeIs('imageGallery.from')||request()->routeIs('textSlider.add')  ? "active" : '' }}">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Updates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('headers.create')}}" class="nav-link {{request()->routeIs('headers.create') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Manue</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('imageGallery.from')}}" class="nav-link {{request()->routeIs('imageGallery.from') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Image</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('textSlider.add')}}" class="nav-link {{request()->routeIs('textSlider.add') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Event</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            
            <a href="#" class="nav-link {{request()->routeIs('contucts.index') || request()->routeIs('contuctUs.index') ?"active" : '' }}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
              Contacts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('contucts.index')}}" class="nav-link {{request()->routeIs('contucts.index') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('contuctUs.index')}}" class="nav-link {{request()->routeIs('contuctUs.index') ?"active" : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Us</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
         
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>