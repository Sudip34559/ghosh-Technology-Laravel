@props([
  'message' => 'Message',
  'type' => 'success' // 'success', 'error', or 'info'
])

<style>
  /* General alert container styles */
  .custom-alert {
    position: fixed;
    top: 70px;
    right: 20px;
    min-width: 320px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 50;
    transition: opacity 0.5s ease-out;
    font-family: Arial, sans-serif;
    font-size: 16px;
    border: 2px solid;
  }

  /* Success alert background and border */
  .custom-alert.success {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
  }

  /* Error alert background and border */
  .custom-alert.error {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
  }

  /* Info alert background and border */
  .custom-alert.info {
    background-color: #d1ecf1;
    color: #0c5460;
    border-color: #bee5eb;
  }

  /* Close button styling */
  .custom-alert .close-btn {
    background: none;
    border: none;
    font-size: 25px; /* Increased size */
    cursor: pointer;
    float: right;
    line-height: 1;
    color: inherit;
  }

  .custom-alert .close-btn:hover {
    opacity: 0.8;
  }

  /* Fade-out effect */
  .fade-out {
    opacity: 0;
  }

  /* Hidden class to completely remove alert after fade-out */
  .hidden {
    display: none;
  }
</style>

<!-- Alert div -->
<div id="customAlert" class="custom-alert {{$type}}" role="alert">
  {{$message}}
  <button type="button" class="close-btn" aria-label="Close">&times;</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const alertElement = document.getElementById('customAlert');
  const closeButton = alertElement.querySelector('.close-btn');

  // Automatically hide after 5 seconds
  if (alertElement) {
    setTimeout(() => {
      alertElement.classList.add('fade-out');
      setTimeout(() => {
        alertElement.classList.add('hidden');
      }, 500); // Wait for the fade-out transition to complete
    }, 5000); // 5 seconds delay
  }

  // Close button functionality
  closeButton.addEventListener('click', function() {
    alertElement.classList.add('fade-out');
    setTimeout(() => {
      alertElement.classList.add('hidden');
    }, 500); // Wait for fade-out to complete
  });
});
</script>
