
    @extends('welcome')

    @section('display')
        
@if (session('success'))
  <x-flash-message message="{{session('success')}}"/>
@endif
@if (session('error'))
    <x-flash-message type="error" message="{{session('error')}}"/>
 @endif
@if (session('info'))
    <x-flash-message type="info" message="{{session('info')}}"/>
 @endif
    
    <main class="main" id="top">
      <div class="preloader" id="preloader">
        <div class="loader">
          <div class="line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      </div>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="text-center py-0">
        <div class="bg-holder overlay overlay-2" style="background-image:url({{asset('Admin/assets/img/_zVVIafSRyRIx3fK4V9QA.jpg')}});"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row min-vh-100 align-items-center">
            <div class="col-md-8 col-lg-5 mx-auto" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="mb-5" data-zanim-xs='{"delay":0,"duration":1}'><a href="#"><img src="{{asset('Admin/assets/img/download.png')}}" alt="logo" /></a>
            <h4 style="color: white">
                Ghosh Technology
            </h4>
            </div>
              <div class="card" data-zanim-xs='{"delay":0.1,"duration":1}'>
                <div class="card-body p-md-5">
                  <h4 class="text-uppercase fs-0 fs-md-1">login </h4>
                  <form class="text-start mt-4" action="{{route('login')}}" method="POST" >
                    @csrf
                    <div class="row align-items-center">
                      <div class="col-12">
                        <div class="input-group">
                          <div class="input-group-text bg-100"><span class="far fa-user"></span></div><input class="form-control" type="text" placeholder="Email " aria-label="Text input with dropdown button" name="email" />
                        </div>
                      </div>
                      <div class="col-12 mt-2 mt-sm-4">
                        <div class="input-group">
                          <div class="input-group-text bg-100"><span class="fas fa-lock"></span></div><input class="form-control" type="Password" placeholder="Password" aria-label="Text input with dropdown button" name="password" />
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center mt-3 justify-content-center">
                      <div class="col-6 mt-2 mt-sm-3"><button class="btn btn-primary w-100" type="submit">Login</button></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @endsection