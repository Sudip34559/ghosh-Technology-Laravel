@extends('admin.layout.tableLayout')
@section('cardHeader', 'Employees Table')
@section('table')
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Status</th>
            <th class="text-center" >Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
            <tr>
                <td class="text-center">{{ $employee->name }}</td>
                <td class="text-center">{{ $employee->email }}</td>
                <td class="text-center">{{ $employee->role }}</td>
                <td class="text-center">
                    <form action="{{route('updateEmployeeStatus',$employee->id)}}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $employee->isActive == 1 ? 'btn-success' : 'btn-warning' }}">
                            {{ $employee->isActive == 1 ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="text-center"> 
                   
                    <button type="button" class="btn btn-info btn-sm" onclick="editEmployee({{ $employee->id }}, '{{ $employee->name }}', '{{ $employee->email }}', '{{ $employee->role }}')">Edit</button>

                    <form action="{{route('deleteEmployee', $employee->id)}}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editEmployeeForm" method="POST">
          @csrf
          @method('PATCH') <!-- Important for the update method -->
          <div class="modal-header">
            <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
          </div>
          <div class="modal-body">
            <!-- Name Field -->
            <div class="mb-3">
              <label for="edit-name" class="form-label">Name</label>
              <input type="text" class="form-control" id="edit-name" name="name" required>
            </div>
  
            <!-- Email Field -->
            <div class="mb-3">
              <label for="edit-email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit-email" name="email" required>
            </div>
  
            {{-- <!-- Role Field -->
            <div class="mb-3">
              <label for="edit-role" class="form-label">Role</label>
              <select class="form-control" id="edit-role" name="role" required>
                <option value="caller">Caller</option>
                <option value="installer">Installer</option>
                <option value="both">Both</option>
              </select>
            </div> --}}
  
           
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id='closeButton'>Close</button>
            <button type="submit" class="btn btn-primary" id="saveButton">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script>
    function editEmployee(id, name, email, role) {
    // Populate form inputs with the passed value

    console.log(role);
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-email').value = email;
    // if (role == 'caller&insteller'){
    //     document.getElementById('edit-role').value = 'both';
    // }else{
    //     document.getElementById('edit-role').value = role;
    // }


    // Dynamically set the form action (update route with employee ID)
    document.getElementById('editEmployeeForm').action = `/update-employee/${id}`;

    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
    modal.show();

        document.getElementById('closeButton').addEventListener('click', function() {
            modal.hide();
        })
        document.getElementById('saveButton').addEventListener('click', function() {
            modal.hide();
        })
}






</script>

<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection