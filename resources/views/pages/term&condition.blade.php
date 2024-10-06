<x-layout.index :data="$headers">
    <section>
        <div class="bg-holder overlay" style="background-image:url({{asset('Admin/assets/img/background-2.jpg')}});background-position:center bottom;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row pt-6" data-inertia='{"weight":1.5}'>
            <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>Terms & Conditions</h1>
                <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
                  <ol class="breadcrumb fs-1 ps-0 fw-bold">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
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
              <h3 class="text-center fs-2 fs-md-3">Terms and Conditions</h3>
              <hr class="short mx-auto" style="width: 4.2rem; opacity: 0; transition: width 0.8s ease-in-out;" data-zanim-trigger="scroll" />
            </div>
            <div class="col-12">
              <div class="bg-white px-3 mt-6 py-5 px-lg-5 rounded-3 shadow-sm">
                <h5 class="fw-bold">Repair Estimate and New Problems</h5>
                <p class="mt-3">
                  Repair estimates of the parts are suspected. In case during repair we find additional issues, they will be treated as new problems, and we will intimate you before proceeding.
                </p>
          
                <h5 class="fw-bold mt-5">Material Verification</h5>
                <p>
                  Physical verification of materials is only possible once they reach our workshop.
                </p>
          
                <h5 class="fw-bold mt-5">Client Responsibilities for Software and Data</h5>
                <p>
                  All software and data are the client's responsibility. Please ensure to back up all data before submitting for repair. We will not be held accountable for any data loss.
                </p>
          
                
                <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                    <h5 class="fw-medium ms-3 mb-0">All Laptop, Desktop, Printer, and Monitor repairs are warranted for 15 days from the date of call closure.</h5>
                  </blockquote>
          
                <h5 class="fw-bold mt-5">Warranty Limitations</h5>
                <p>
                  This warranty only applies to the items found defective and repaired. It does not apply to products that were returned without any issues or were merely recalibrated. Out-of-warranty products may not be returned to their original specifications.
                </p>
          
                <h5 class="fw-bold mt-5">On-Site Services Conditions</h5>
                <p>
                  All on-site services are subject to technician availability, part availability, and the service area coverage.
                </p>
          
                <h5 class="fw-bold mt-5">Replacement Policy</h5>
                <p>
                  No advance replacements will be issued unless the faulty product is returned. Computer parts come from different manufacturers, and for any hardware defects, customers must contact the manufacturer. We offer replacement services (pick-up and drop) on a chargeable basis according to the manufacturer's terms.
                </p>
          
                <h5 class="fw-bold mt-5">Payment Terms</h5>
                <p>
                  Diagnosis fees must be paid at the time of pick-up, with the remaining balance due upon delivery or completion of work.
                </p>
          
                <h5 class="fw-bold mt-5">Customer Responsibilities</h5>
                <p>
                  It is the customer's responsibility to back up all existing data and software before repairs. Ghosh Technology is not liable for any data loss during the repair process.
                </p>
          
                {{-- <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px; border-left: 4px solid #ccc; padding-left: 15px;">
                  <h5 class="fw-medium ms-3 mb-0">Our mission: Helping people Upgrade Through Technology.</h5>
                </blockquote> --}}
                <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                    <h5 class="fw-medium ms-3 mb-0">Our mission: Helping people Upgrade Through Technology.</h5>
                  </blockquote>
              </div>
            </div>
        </div>
      </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    

    <x-contuct/>

  </main>
</x-layout.index>
  