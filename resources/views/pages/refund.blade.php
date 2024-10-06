<x-layout.index :data="$headers">
    <section>
        <div class="bg-holder overlay" style="background-image:url({{asset('Admin/assets/img/background-2.jpg')}});background-position:center bottom;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row pt-6" data-inertia='{"weight":1.5}'>
            <div class="col-md-8 text-white" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h1 class="text-white fs-4 fs-md-5 mb-0 lh-1" data-zanim-xs='{"delay":0}'>Refund & Cancellation</h1>
                <div class="nav" aria-label="breadcrumb" role="navigation" data-zanim-xs='{"delay":0.1}'>
                  <ol class="breadcrumb fs-1 ps-0 fw-bold">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Refund & Cancellation</li>
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
              <h3 class="text-center fs-2 fs-md-3">Refund & Cancellation Policy</h3>
              <hr class="short mx-auto" style="width: 4.2rem; opacity: 0; transition: width 0.8s ease-in-out;" data-zanim-trigger="scroll" />
            </div>
            <div class="col-12">
              <div class="bg-white px-3 mt-6 py-5 px-lg-5 rounded-3 shadow-sm">
                
                <h5 class="fw-bold">Cancellation Policy</h5>
                <p class="mt-3">
                  At Ghosh Technology, we aim to assist our customers as much as possible, and as part of this, we have a flexible cancellation policy. Under this policy:
                </p>
                <ul>
                  <li>Cancellations will only be considered if requested within 72 hours of placing an order.</li>
                  <li>No cancellation is allowed for orders placed under the Same Day Delivery category.</li>
                  <li>
                    Cancellation requests for computer-related software such as Quick Heal Antivirus, Windows OS, etc., are not accepted if the software has already been installed on the client's device. 
                    However, refunds or replacements can be processed if the customer proves that the quality of the computer hardware product differs from what was ordered.
                  </li>
                </ul>
          
                <h5 class="fw-bold mt-5">Return & Refund Policy</h5>
                <p>
                  There may be instances beyond our control where you receive a damaged or defective product, or a product that differs from your original order. 
                  In such cases, we will replace the product at no extra cost. 
                  Please contact our Customer Service Team before using the product, and they will guide you through the process at our customer service number <b>@ 03482-250380</b>.
                </p>
          
                <h5 class="fw-bold mt-5">Conditions for Return</h5>
                <ul>
                  <li>You must notify us within 24 hours of receiving a damaged or defective product.</li>
                  <li>The product/item should be UNUSED.</li>
                  <li>Items should be returned in their original packaging, along with the original price tags, labels, and invoices.</li>
                  <li>We advise packaging the return items securely to prevent any further damage during transit.</li>
                </ul>
          
                
                <blockquote class="blockquote my-5 ms-lg-6" style="max-width: 700px;">
                    <h5 class="fw-medium ms-3 mb-0">Customer satisfaction is our priority, and we aim to make your return process seamless and efficient.</h5>
                  </blockquote>
          
                <h5 class="fw-bold mt-5">Refunds</h5>
                <p>
                  Refunds will be processed after the returned product is received by Ghosh Technology or its business partner. The refund method will depend on the payment mode used at the time of the order:
                </p>
                <ul>
                  <li>If payment was made online, we will refund the amount within 7 working days, and the refund will reflect in the next account statement.</li>
                </ul>
          
              </div>
            </div>
          </div>
          
      </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    

    <x-contuct/>

  </main>
</x-layout.index>
  