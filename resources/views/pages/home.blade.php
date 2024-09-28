<x-layout.index :data="$headers" >
  {{-- @dd($headers) --}}
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
    <section class="py-0">
      {{-- <div class="swiper theme-slider min-vh-100" data-swiper='{"loop":true,"allowTouchMove":false,"autoplay":{"delay":5000},"effect":"fade","speed":800}'>
        <div class="swiper-wrapper">
          @foreach ($images as $image )
          <div class="swiper-slide" data-zanim-timeline="{}">
            <div class="bg-holder" style="background-image:url({{asset('storage/' . $image->image)}});"></div>
            <!--/.bg-holder-->
            <div class="container">
              <div class="row min-vh-100 py-8 align-items-center" data-inertia='{"weight":1.5}'>
                <div class="col-sm-8 col-lg-7 px-5 px-sm-3">
                  <div class="overflow-hidden">
                    <div data-zanim-xs='{"delay":0.2}'><a class="btn btn-primary me-3 mt-3" href="{{route('about')}}">Read more<span class="fas fa-chevron-right ms-2"></span></a><a class="btn btn-warning mt-3" href="{{route('contuct')}}">Contact us<span class="fas fa-chevron-right ms-2"></span></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-nav">
          <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
          <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
        </div>
      </div> --}}

      <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js"></script>
      <spline-viewer url="https://prod.spline.design/Gctd-pyq8ZnvhxPp/scene.splinecode"></spline-viewer>
    </section>

    <section class="bg-white text-center">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-10 col-md-6">
            <h3 class="fs-2 fs-lg-3">Welcome to Ghosh Technology</h3>
            <p class="px-lg-4 mt-3">Get expert servicing and support for computers, laptops, printers, CCTV, networks, and data recovery with Ghosh Technology.</p>
            <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" /> 
          </div>
        </div>
        <div class="row mt-4 mt-md-5">
          <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-laptop"></span></div>
            <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Laptop & Computer Service</h5>
            <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Comprehensive repair and maintenance services for all your computing needs.</p>
          </div>
          <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-print"></span></div>
            <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Printer Service</h5>
            <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Expert printer servicing for smooth operations and uninterrupted printing.</p>
          </div>
          <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-video"></span></div>
            <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>CCTV Installation & Service</h5>
            <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Reliable CCTV installation and servicing to ensure your security systems are fully functional.</p>
          </div>
          <div class="col-sm-6 col-lg-3 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="ring-icon mx-auto" data-zanim-xs='{"delay":0}'><span class="fas fa-network-wired"></span></div>
            <h5 class="mt-4" data-zanim-xs='{"delay":0.1}'>Network Service</h5>
            <p class="mb-0 mt-3 px-3" data-zanim-xs='{"delay":0.2}'>Efficient network troubleshooting and support to keep your connections running seamlessly.</p>
          </div>
        </div>
      </div>
    </section> 
    
    <section class="pt-0">
      <div class="container">
        <div class="row flex-center text-center pb-6">
          <div class="col-12">
            <div class="position-relative mt-4 py-5 py-md-11">
              <div class="bg-holder rounded-3" style="background-image:url({{asset('Admin/assets/img/7ELWRgXfSoiFCUvwTJEs4Q.jpg')}});"></div>
              <button class="btn-elixir-play" data-bigpicture="{&quot;ytSrc&quot;:&quot;jlWMTNZNOc0&quot;}" data-zanim-trigger="scroll" data-zanim-xs='{"from":{"opacity":0,"scale":0.8},"to":{"opacity":1,"scale":1},"duration":1}'><span class="fas fa-play fs-1"></span></button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-users"></span>Skilled Technicians</h5>
            <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Our skilled team ensures top-quality repairs and maintenance for all your tech devices.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-headset"></span>24/7 Support</h5>
            <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Facing issues? Our support team is always ready to assist you with your tech concerns.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mt-3 mt-lg-0 px-4 px-sm-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <h5 data-zanim-xs='{"delay":0}'><span class="text-primary me-3 fas fa-hdd"></span>Data Recovery</h5>
            <p class="mt-3 pe-3 pe-lg-5" data-zanim-xs='{"delay":0.1}'>Recover lost data with our expert data recovery services to safeguard your valuable information.</p>
          </div>
        </div>
      </div>

    </section>
   
    <section>
      <div class="container">
        <div class="text-center mb-7">
          <h3 class="fs-2 fs-md-3">Why Choose Ghosh Technology</h3>
          <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
        </div>
        <div class="row">
          <div class="col-lg-6 pe-lg-3">
            <img class="rounded-3 img-fluid" src="{{asset('Admin/assets/img/223.jpg')}}" alt="about" />
          </div>
          <div class="col-lg-6 px-lg-5 mt-6 mt-lg-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="overflow-hidden">
              <div class="px-4 px-sm-0" data-zanim-xs='{"delay":0}'>
                <h5 class="fs-0 fs-lg-1"><span class="fas fa-cogs fs-1 me-2" data-fa-transform="flip-h"></span>We Are Experts</h5>
                <p class="mt-3">Our team of experienced professionals provides reliable and efficient IT services including Computer, Laptop, and Network Services, ensuring smooth operations for your business.</p>
              </div>
            </div>
            <div class="overflow-hidden">
              <div class="px-4 px-sm-0 mt-5" data-zanim-xs='{"delay":0}'>
                <h5 class="fs-0 fs-lg-1"><span class="fas fa-lightbulb fs-1 me-2" data-fa-transform="shrink-1"></span>We Are Innovative</h5>
                <p class="mt-3">From Data Recovery to Printer Service, we stay ahead of the curve with creative solutions that meet the latest industry standards.</p>
              </div>
            </div>
            <div class="overflow-hidden">
              <div class="px-4 px-sm-0 mt-5" data-zanim-xs='{"delay":0}'>
                <h5 class="fs-0 fs-lg-1"><span class="fas fa-headset fs-1 me-2" data-fa-transform="grow-1"></span>24/7 Customer Support</h5>
                <p class="mt-3">Ghosh Technology is always available to assist you with your IT needs. From troubleshooting to maintenance, our support team is here to help round the clock.</p>
              </div>
            </div>
          </div>
        </div>
      </div><!-- end of .container-->
    </section>
    

    <section class="bg-primary">
      <div class="container">
        <div class="row align-items-center text-white">
          <div class="col-lg-4">
            <div class="border-2 border-warning p-4 py-lg-5 text-center rounded-3" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <h4 class="text-white" data-zanim-xs='{"delay":0}'>Request a call back</h4>
              </div>
              <div class="overflow-hidden">
                <p class="px-lg-1 text-100 mb-0" data-zanim-xs='{"delay":0.1}'>Would you like to speak to one of our financial advisers over the phone? Just submit your details and we’ll be in touch shortly. You can also email us if you would prefer.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-8 ps-lg-5 mt-6 mt-lg-0">
            <h5 class="text-white">I would like to discuss:</h5>
            <form class="mt-4" action="{{route('contuctUs.create')}}" method="POST">
              @csrf
              <div class="row">
                <div class="col-6"><input class="form-control" type="text" placeholder="Your Name" aria-label="Your Name" name="name"/></div>
                <div class="col-6"><input class="form-control" type="text" placeholder="Phone Number" aria-label="Phone Number" name="phone"/></div>
                <div class="col-6 mt-4"><input class="form-control" type="text"  placeholder="Email" name="email" /></div>
                <div class="col-6 mt-4"><input class="form-control" type="text" placeholder="Subject" aria-label="Subject" name="message" /></div>
                <div class="col-12 mt-4"><button class="btn btn-warning w-100" type="submit">Submit</button></div>
              </div>
            </form>
          </div>
        </div>
      </div><!-- end of .container-->
    </section>

    <section class="text-center">
      <div class="container">
        <div class="text-center">
          <h3 class="fs-2 fs-md-3">Things You Get</h3>
          <hr class="short" data-zanim-xs='{"from":{"opacity":0,"width":0},"to":{"opacity":1,"width":"4.20873rem"},"duration":0.8}' data-zanim-trigger="scroll" />
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-computer-50.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Expert IT Support</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Our team offers comprehensive Computer, Laptop, Network, and CCTV services to ensure your technology runs smoothly.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-database-restore-50.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Data Recovery Solutions</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>We offer reliable data recovery services to safeguard your critical data from unexpected loss or damage.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-wifi-50.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Network Setup & Maintenance</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>We offer complete networking solutions from installation to troubleshooting to ensure uninterrupted connectivity.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-printer-50.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Printer & Toner Services</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>We provide efficient printer servicing and toner refilling to keep your office running smoothly.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-support-64.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>Consulting Services</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>Our experienced consultants offer strategic advice to optimize your IT infrastructure and improve efficiency.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mt-4" data-zanim-timeline="{}" data-zanim-trigger="scroll">
            <div class="px-3 py-4 px-lg-4">
              <div class="overflow-hidden"><img src="{{asset('Admin/assets/img/icons/icons8-hotline-50.png')}}" alt="icon" height="37" data-zanim-xs='{"delay":0}' /></div>
              <div class="overflow-hidden">
                <h5 class="mt-3" data-zanim-xs='{"delay":0.1}'>24/7 Support</h5>
              </div>
              <div class="overflow-hidden">
                <p class="mb-0" data-zanim-xs='{"delay":0.2}'>We offer round-the-clock customer support to ensure your business never faces downtime due to IT issues.</p>
              </div>
            </div>
          </div>
        </div>
      </div><!-- end of .container-->
    </section>
    



    

   

    <div class="bg-200 py-6">
      <div class="container">
        <div class="row align-items-center" data-zanim-timeline="{}" data-zanim-trigger="scroll">
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/5969052.png')}}" alt="tvc" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/logo5.png')}}" alt="fast brothers" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/logo2.png')}}" alt="partnerco" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/logo6.png')}}" alt="arcade" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/logo3.png')}}" alt="bearbrand" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/logo4.png')}}" alt="harculis beards" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/thumbnail.png')}}" alt="bearbrand" data-zanim-xs="{}" /></div>
          <div class="col-4 col-md-2 my-3 overflow-hidden"><img class="img-fluid" src="{{asset('Admin/assets/img/partner/133319.png')}}" alt="harculis beards" data-zanim-xs="{}" /></div>
        </div>
      </div>
    </div>

    

</main>
<x-emailFrom/>
<div class="whatsapp-button">
  <a href="https://wa.me/919876543210" target="_blank" id="whatsapp-link">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon">
      Chat with us on WhatsApp!
  </a>
</div>

<style>

.whatsapp-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.whatsapp-button a {
    display: flex;
    align-items: center;
    background-color: #f6921e; /* Orange background color */
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 25px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

.whatsapp-button a:hover {
    background-color: #e58415; /* Slightly darker shade on hover */
}

.whatsapp-button img {
    width: 24px;
    height: 24px;
    margin-right: 10px;
}

</style>
<script>
  document.getElementById('whatsapp-link').addEventListener('click', function (e) {
      e.preventDefault();
      
      var phoneNumber = '919476172842';
      
      var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
      
      if (isMobile) {
          window.location.href = `whatsapp://send?phone=${phoneNumber}`;
          setTimeout(function () {
              window.location.href = `https://wa.me/${phoneNumber}`;
          }, 500);
      } else {
          window.location.href = `https://wa.me/${phoneNumber}`;
      }
  });
</script>
</x-layout.index>