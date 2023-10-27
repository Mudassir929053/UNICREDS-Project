<?php
    $creatorProfile = $creator["image"];
    $creatorName = $creator["name"];
    $creatorUserID = $creator["user_id"];

    $studuniID = $suInfoRow["su_user_id"];
?>
<!-- left: offcanvas-start, right: offcanvas-end -->
<div style="width: 450px !important;" class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="chatCanvas" aria-labelledby="chatCanvaLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title h3" id="chatCanvaLabel">Chat</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- Chat header -->
    <div class="bg-white border-top border-bottom px-4 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="#" class="me-2 d-xl-none d-block" data-close>
                    <i class="fe fe-arrow-left"></i>
                </a>
                <div class="avatar avatar-md avatar-indicators avatar-online">
                    <img src="<?= $creatorProfile ?>" alt="" class="rounded-circle">
                </div>
                <div class="ms-2">
                    <h4 class="mb-0"><?= $creatorName ?></h4>
                    <p class="mb-0 text-muted">Online</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Chat messages -->
    <div class="offcanvas-body p-0">
        <div class="d-flex flex-column h-100 bg-white">
            <div id="chatBody" class="d-flex flex-column px-4 py-4 w-100 h-100 scrollbar">
                <!-- message here... -->
            </div>
        </div>   
    </div>
    <!-- Chat footer -->
    <div id="chatFooter" class="bg-light border-top border-bottom px-3 py-3">
        <div class="bg-white p-2 rounded-3 shadow-sm">
            <div class="position-relative">
                <textarea class="form-control border-0 form-control-simple no-resize" name="messageSend" id="messageSend" placeholder="Type message" rows="1" onfocus="enterSubmit(<?= $creatorUserID ?>, <?= $studuniID ?>)"></textarea>
            </div>
            <div class="position-absolute end-0 mt-n7 me-4">
                <button id="submitMessage" class="fs-3 btn text-primary btn-focus-none" onclick="buttonSubmit(<?= $creatorUserID ?>, <?= $studuniID ?>)">
                    <i class="fe fe-send"></i>
                </button>
            </div>
        </div>
        <!-- <div class="mt-3 d-flex">
            <div>
                <a class="text-link me-2 fs-4">
                    <i class="bi-emoji-smile"></i>
                </a>
                <a href="#" class="text-link me-2 fs-4">
                    <i class="bi-paperclip"></i>
                </a>
                <a href="#" class="text-link me-3 fs-4"><i class="bi-mic"></i></a>
            </div>
            <div class="dropdown">
                <a href="#" class="text-link fs-4" id="moreAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fe fe-more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="moreAction">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div> -->
    </div>
</div>

<!-- For fetching instructor chat messages -->
<script type="text/javascript">
    $(document).ready(function() {
        // --- check incoming chat messages in 1 seconds interval.
        setInterval(function() {
            instructorMessage(<?= $creatorUserID ?>, <?= $suInfoRow["su_user_id"] ?>);
        }, 1000);
    });
</script>