<x-layout.index :data="$headers">
    <main class="main" id="top" >
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
    
        <!-- Floating Images Section -->
        <section class="floating-images-section">
            <div class="container">
                <div class="row g-4" id="dynamic-image-container">
                    <!-- Dynamic image cards will be appended here by JavaScript -->
                </div>
            </div>
        </section>

       
    
    </main>
    
    <!-- Modal Template -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="modalImage" src="" alt="Preview" class="img-fluid">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <style>
    /* Preloader (optional) */
    .preloader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
    }

    body {
        background-image: url('{{asset('Admin/assets/img/7ELWRgXfSoiFCUvwTJEs4Q.jpg')}}');
        background-attachment: fixed;
        background-size: cover;
        background-position: center center;
        height: 100vh;
    }
    
    .floating-images-section {
        background-color: rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
        padding-bottom: 50px; /* Ensure there's space for the footer */
        min-height: 100vh;
    }
    
    .card {
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .card:hover {
        transform: scale(1.05);
        transition: 0.3s;
    }

    .image-wrapper {
        width: 100%;
        height: 250px; /* Fixed height for consistency */
        overflow: hidden;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures that images fill the container while maintaining aspect ratio */
        display: block;
    }

    /* Footer Styling */
    .footer {
        position: relative;
        z-index: 2;
    }

    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageArray = {!! json_encode($galleries) !!};
            const imageContainer = document.getElementById('dynamic-image-container');
            const modalImage = document.getElementById('modalImage');
            const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    
            // Dynamically load the images
            imageArray.forEach(image => {
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-lg-4', 'col-md-12', 'mb-4', 'mb-lg-0');
                colDiv.innerHTML = `
                    <div class="card">
                        <div class="image-wrapper">
                            <img class="shadow-1-strong rounded" src="${image.imagepath}" alt="Featured Image" style="cursor: pointer;" />
                        </div>
                    </div>
                `;
                
                // Add click event to open modal with the clicked image
                colDiv.querySelector('img').addEventListener('click', () => {
                    modalImage.src = image.imagepath; // Set image src in the modal
                    modal.show(); // Show the modal
                });
                
                imageContainer.appendChild(colDiv);
            });
        });
    </script>
    
</x-layout.index>
