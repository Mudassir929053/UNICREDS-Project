
<!-- Flexbox container for aligning the toasts -->

<div id="toastmain" style="display:none;" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
  <!-- Then put toasts within -->
  <div  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <!-- <img src="..." class="rounded me-2" alt="..."> -->
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ms-2 mb-1 btn-close" data-bs-dismiss="toast" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span> -->
      </button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>

<!--Popup Notification-->