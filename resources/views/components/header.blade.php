@props([
  'headers' => []
])
{{-- @dd($headers) --}}
<div class="bg-primary py-3 d-none d-sm-block text-white fw-bold">
    <div class="container">
      <div class="row align-items-center gx-4">
        <div class="col-auto d-none d-lg-block fs--1"><span class="fas fa-map-marker-alt text-warning me-2" data-fa-transform="grow-3"></span>37, Bhattacharya Para Lane, Berhampore, West Bengal </div>
        <div class="col-auto ms-md-auto order-md-2 d-none d-sm-flex fs--1 align-items-center"><span class="fas fa-envelope text-warning me-2" data-fa-transform="grow-3"></span>
          <a class="ms-2 fs--1 d-inline text-white fw-bold" href="mailto:support@ghoshtechnology.com">support@ghoshtechnology.com</a>
        </div>
        <div class="col-auto ms-md-auto order-md-2 d-none d-sm-flex fs--1 align-items-center"><span class="fas fa-clock text-warning me-2" data-fa-transform="grow-3"></span>Mon-Sat, 9.00-9.00. Sunday CLOSED</div>
        <div class="col-auto"><span class="fas fa-phone-alt text-warning" data-fa-transform="shrink-3"></span><a class="ms-2 fs--1 d-inline text-white fw-bold" href="tel:03482250380">03482 250 380</a></div>
      </div>
    </div>
  </div>
  <div class="sticky-top navbar-elixir bg-white" style="">
    <div class="" style="margin-left: 30px; margin-right: 30px; ">
      <nav class="navbar navbar-expand-lg"> <a class="navbar-brand" href="{{route('home')}}">
        <img height="50px" src="{{asset('Admin/assets/img/PHOTO-2024-09-23-07-09-08.jpg')}}" alt="logo" />
        
      </a><button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbarCollapse" aria-controls="primaryNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="hamburger hamburger--emphatic"><span class="hamburger-box"><span class="hamburger-inner"></span></span></span></button>
        <div class="collapse navbar-collapse" id="primaryNavbarCollapse">
          <ul class="navbar-nav py-3 py-lg-0 mt-1 mb-2 my-lg-0 ms-lg-n1">
            <li class="nav-item dropdown"><a href="{{route('home')}}" class="nav-link" role="button">Home</a>
            </li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('service')}}">Services</a></li>
                <li><a class="dropdown-item" href="{{route('about')}}">About</a></li>
                <li><a class="dropdown-item" href="{{route('imageGalary')}}">gallery</a></li>
              </ul>
            </li>
              @foreach ($headers as $header)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-indicator" href="JavaScript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $header->header }}</a>
                            <ul class="dropdown-menu">
                                @foreach ($header->subheader as $subheaderName => $subheaderLink)
                                    <li><a class="dropdown-item" href="{{ $subheaderLink }}">{{ $subheaderName }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                @endforeach
            <li class="nav-item dropdown"><a class="nav-link" href="{{route('contuct')}}" role="button">Contact</a></li>
          </ul><a class="btn btn-outline-primary rounded-pill btn-sm border-2 d-block d-lg-inline-block ms-auto my-3 my-lg-0" href="https://ghoshtechnology.myinstamojo.com/" target="_blank" style="min-width: 82px">E Store</a>
        </div>
      </nav>
    </div>
    <div class="slider-container" id="sliderContainer" style="display: none;">
      <div class="slider" id="slider">
          <!-- Slides will be dynamically added here -->
      </div>
  </div>
     
  </div>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
  }
  
  .slider-container {
      width: 100%;
      overflow: hidden;
      background-color: rgb(42,56,85);
      color: #fff;
      padding: 10px 0;
      position: relative;
  }
  
  .slider {
      display: flex;
      width: max-content;
      animation: scroll linear infinite;
  }
  
  .slide {
      padding: 0 20px;
      font-size: 14px;
      white-space: nowrap;
      display: inline-block;
  }
  
  @keyframes scroll {
      0% {
          transform: translateX(0);
      }
      100% {
          transform: translateX(-50%);
      }
  }

  .slider-container {
    transition: opacity 0.5s ease-in;
    opacity: 0;
}

.slider-container[style*="display: block;"] {
    opacity: 1;
}

    </style>

    <script>
   document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById('slider');
    const sliderContainer = document.getElementById('sliderContainer');

    // Fetch slide data from backend API
    fetch('/text-slider') // Replace with your actual API endpoint
        .then(response => response.json())
        .then(data => {
          console.log(data);
            if (data.length > 0) {
                // Function to add slides dynamically
                function addSlides(slideTextArray) {
                    slideTextArray.forEach(slideText => {
                        const slide = document.createElement('div');
                        slide.classList.add('slide');
                        slide.textContent = slideText.slidText;
                        slider.appendChild(slide);
                    });

                    // Duplicate the slides for smooth infinite loop
                    slideTextArray.forEach(slideText => {
                        const slide = document.createElement('div');
                        slide.classList.add('slide');
                        slide.textContent = slideText.slidText;
                        slider.appendChild(slide);
                    });
                }

                // Call the function to add slides
                addSlides(data);

                // Show the slider-container once slides are added
                sliderContainer.style.display = 'block';

                 // Adjust animation speed based on the number of slides
                 const slideCount = data.length;
                const animationSpeed = slideCount < 3 ? '10s' : '30s';
                slider.style.animationDuration = animationSpeed;
            }
        })
        .catch(error => {
            console.error('Error fetching slides:', error);
        });
});


  </script>
  
