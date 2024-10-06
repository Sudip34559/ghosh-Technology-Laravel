<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="profile-container">
        <!-- Button to trigger the profile card -->
        <button id="profileBtn" class="profile-button">
          <img src="{{asset('Admin/assets/img/istockphoto-1495088043-612x612.jpg')}}" alt="">
        </button>
        
        <!-- Profile Card -->
        <div id="profileCard" class="profile-card">
            <div class="profile-header">
              <div class="profile-button" style="margin: auto">
                <img src="{{asset('Admin/assets/img/istockphoto-1495088043-612x612.jpg')}}" alt="">
              </div>
                <h3>{{Auth::user()->name}}</h3>
                <p>{{Auth::user()->email}}</p>
                <p>{{Auth::user()->role}}</p>
            </div>
            <form action="{{route('changePassword')}}" method="POST" >
              @csrf
              @method('PATCH')
              <div class="form-group" >
                <label for="password">Change Password</label>
                <input type="password" value="{{old('password')}}" placeholder="Enter new password" class="form-control @error('amount') is-invalid @enderror" id="password" name='password'>
                @error('password')
                <span class="text-danger small">  {{$message}}</span>
               @enderror
              </div>
              <button type="submit" class="btn btn-primary ">Change</button>
            </form>
            
        </div>
    </li>
    
      <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" role="button">
              <i class="fas fa-sign-out-alt"></i> 
          </a>
      </li>
    </ul>
    <!-- Button to trigger the modal -->
  </nav>
   <style>
    /* Button styling */
.profile-button {
    height: 40px; 
    width: 40px; 
    border-radius: 50%; 
    border:none; 
    overflow: hidden;
    cursor: pointer;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}
.profile-button img{
  width: 60px;
  height: 60px;
}

/* Profile card styling */
.profile-card {
    width: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: fixed; /* Fixed position */
    top: 60px; /* Adjust this value to align the card under the button */
    right:-150px;
    transform: translateX(-50%);
    z-index: 1000;
    display: none; /* Hidden by default */
    padding: 15px;
}

/* Card header styling */
.profile-header {
    text-align: center;
}

.profile-header h3 {
    margin: 10px 0 5px;
}

.profile-header p {
    margin: 5px 0;
    color: #777;
}

/* Profile image styling */
.profile-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

/* Card body styling */
.profile-body {
    padding-top: 10px;
    text-align: left;
}

   </style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const profileBtn = document.getElementById('profileBtn');
      const profileCard = document.getElementById('profileCard');
      
      // Toggle profile card on button click
      profileBtn.addEventListener('click', function() {
          profileCard.style.display = (profileCard.style.display === 'block') ? 'none' : 'block';
      });

      // Close the profile card if clicked outside
      document.addEventListener('click', function(event) {
          if (!profileBtn.contains(event.target) && !profileCard.contains(event.target)) {
              profileCard.style.display = 'none';
          }
      });

      // Optional: Hover functionality (uncomment if needed)
      
      // profileBtn.addEventListener('mouseover', function() {
      //     profileCard.style.display = 'block';
      // });
      // profileBtn.addEventListener('mouseout', function() {
      //     profileCard.style.display = 'none';
      // });
      
  });
</script>


