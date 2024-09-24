@props([
  'message'=>'Message',
  'type'=> 'success'
])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gnb4GmKDF+H4YqDdW4xt5bFkw3kImxGzY2VVzOmaNndm4JHBwozRMOdnlkhIZWiW" crossorigin="anonymous">

  <style>
    .fade-out {
      transition: opacity 0.5s ease-out;
      opacity: 0;
    }
  </style>
  <div id="successMessage" class="alert alert-{{$type}} alert-dismissible show" role="alert" style="position: fixed; top: 70px; right: 20px; min-width:300px; z-index: 50;">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const alertElement = document.getElementById('successMessage');

    if (alertElement) {
      // Hide the alert after 5 seconds
      setTimeout(() => {
        alertElement.classList.add('fade-out');
        setTimeout(() => {
          alertElement.classList.add('d-none');
        }, 500); // Wait for the fade-out transition to complete (500ms)
      }, 5000); // 5000 milliseconds = 5 seconds
    }

   
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QrwZNZj5Er5uAsDoXfqNe8AAGd+FfSk6YcHbI6gW+tghnGDnBKrmo9U4FuFFzKVp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-5BDICb2YhrIUTNtE1/SHOgVjd3kdmnkkqZ3bL6RjpfxWsWyY7y6S3chMjNnPE5sM" crossorigin="anonymous"></script>

