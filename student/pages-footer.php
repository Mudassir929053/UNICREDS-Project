<!-- Footer -->
<div class="footer mt-5">
    <div class="container">
        <div class="row align-items-center g-0 border-top py-2">
            <!-- Desc -->
            <div class="col-md-6 col-12 text-center text-md-start">
                <span>© 2021 EDESS, Inc. All Rights Reserved</span>
            </div>
            <!-- Links -->
            <div class="col-12 col-md-6">
                <nav class="nav nav-footer justify-content-center justify-content-md-end">
                    <a class="nav-link ps-0" href="#">Privacy Policy</a>
                    <a class="nav-link px-2 px-md-3" href="#">Cookie Notice  </a>
                    <a class="nav-link" href="#">Terms of Use</a>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Footer JS-->
<script>
    function footer_display() {
        var browserViewport = $(window).height();
        var elementHeight = $("body").height();

        // alert(elementHeight+" vs "+browserViewport);

        if(elementHeight > browserViewport) {
            $("div.footer").removeClass("fixed-bottom");
        } else {
            $("div.footer").addClass("fixed-bottom");
        }
    }

    footer_display();
</script>