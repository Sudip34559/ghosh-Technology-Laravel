<x-layout.index :data="$headers">
    <section>
        <div class="bg-holder overlay" style="background-image:url({{asset('Admin/assets/img/background-2.jpg')}});background-position:center bottom;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row pt-6" data-inertia='{"weight":1.5}'>
            <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>About</h1>
                <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
                  <ol class="breadcrumb fs-1 ps-0 fw-bold">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>

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
    <section class="bg-100">
      <div class="container">
        <div class="row g-0">
          
        </div>
        <div class="row mt-6">
          <div class="col">
            <h3 class="text-center fs-2 fs-md-3">Company Overview</h3>
            <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
          </div>
          <div class="col-12">
            <div class="bg-white px-3 mt-6 py-5 px-lg-5 rounded-3">
              <h5>Pioneering Innovative Solutions</h5>
              <p class="mt-3">At Ghosh Technology, we are dedicated to delivering cutting-edge solutions that address the most pressing challenges in technology and service industries. Our mission is to empower businesses and individuals with the tools and expertise needed to drive meaningful progress and achieve exceptional results.</p>
              <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                <h5 class="fw-medium ms-3 mb-0">We do Computer Hardware Services, Computer Networking Services, Quickheal New & Renewal Services …</h5>
              </blockquote>
              <p class="column-lg-2 dropcap">We believe that tackling complex problems requires a multi-faceted approach. At Ghosh Technology, we go beyond conventional solutions by integrating diverse strategies and cutting-edge technologies to address your unique challenges. Our team excels at breaking down barriers and delivering tailored solutions that range from optimizing IT infrastructure and enhancing network services to providing comprehensive support for printers, CCTV systems, and toner cartridge refills.

                We don’t just fix problems—we partner with you to build lasting, future-ready solutions that drive efficiency, security, and long-term success. Whether you're a small business or a large enterprise, Ghosh Technology empowers you to innovate faster and achieve your goals with confidence.</p>
            </div>
          </div>
        </div>
      </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    

    <x-contuct/>

  </main>
</x-layout.index>