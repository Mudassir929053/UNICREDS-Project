const coursePath = "/unicreds/student/course-learning-material.php";
const mcPath = "/unicreds/student/micro-creds-learning-material.php";
var getPath = window.location.pathname;
var currPath = "";

// Check if this is course or micro-credential list page.
if(getPath == coursePath) {
    var currPath = "course";
} else if(getPath == mcPath) {
    var currPath = "mc";
}


/*--------------------------------------------------------- LEARNING VIDEO ---------------------------------------------------------*/

// Fetch the video link and display the video in Video section.
$("#video > div > div.collapse").find("a").on("click", function() {
    var vidID = $(this).data("id");
    var vidLink = $(this).data("link");
    var targetId = $("#teachVid");
    var targetSrc = $("#teachVid > source");

    // --- change the video source and data-video-id.
    targetId.data("video-id", vidID);
    targetSrc.attr("src", vidLink);
    $("video")[0].load();

    // --- go to the top of the page.
    $("html, body").animate({scrollTop: 0}, "fast");
});

// Store the watched video(s) in DB.
$("#teachVid").on("ended", function() {
    var videoID = $(this).data("video-id");
    var success = '<i class="mdi mdi-eye-check-outline mdi-18px text-success ms-2" data-bs-toggle="tooltip" data-placement="top" title="Viewed"></i>';

    $.ajax({
        type: "POST", 
        url: "function/learning-material.php", 
        data: { videoProgress: currPath, videoID: videoID }, 
        success: function(data) {
            if(data == "success") {
                $("#videoHeading" + videoID).find("div.me-auto").append(success);
                // --- call tooltip() function manually to show the tooltip.
                $("[data-bs-toggle=tooltip]").tooltip();
            } else {
                console.log(data);
            }
        },
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
});

/**-------------------------------------------------------- LEARNING VIDEO --------------------------------------------------------**/


/*--------------------------------------------------------- DROPZONE.JS (TUTORIAL, ASSIGNMENT, PROJECT) ---------------------------------------------------------*/

// Dropzone JS.
Dropzone.autoDiscover = false;

// --- configure for each of the dropzone (tutorial, assignment, project).
$(".dropzone").each(function() {
    var studuni_id = $(this).find("input[name=su_id]").prop("value");
    var tlm_id = $(this).find("input[name=tlm_id]").prop("value");
    var tlm_type = $(this).prop("id").split("-")[0];
    var tlm_cat = $(this).find("input[name=tlm_cat]").prop("value");
    var file_info = [tlm_cat, tlm_type];
    var view_uploaded = tlm_type+"-"+$(this).prop("id").split("-")[1];
    var subj_type = $(this).prop("id").split("-")[2];
    var curr_num = $(this).prop("id").split("-")[1];

    $(this).dropzone({
        acceptedFiles: "application/pdf, .docx, .doc", 
        maxFiles: 1, // --- number of file(s)
        maxFilesize: 100, // --- file(s) size (in MB)
        addRemoveLinks: true, 
        dictRemoveFileConfirmation: "Are you sure to remove this file?", 
        dictDuplicateFile: "Duplicate files!", 
        preventDuplicates: true, 
        init: function() {
            var myDropzone = this;

            // Fetch the uploaded file, if exists.
            $.ajax({
                type: "POST", 
                url: "function/learning-material.php", 
                data: { fetchUploadedFile: file_info, tlm_id: tlm_id }, 
                dataType: "json", 
                success: function(data) {
                    if(data.fileCount == 1) {
                        var mockFile = { name: data.fileName, size: data.fileSize };
    
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        // --- disable drag/click event.
                        myDropzone.removeEventListeners();

                        $("a#view-uploaded-"+view_uploaded).prop("href", "../assets/attachment/student/"+studuni_id+"/submission/"+subj_type+"/"+tlm_type+"/"+data.fileName);
                    }
                }
            });
    
            // Triggered when the file have successfully been sent.
            this.on("success", function(file, response) {
                // --- parse json data (response) to JS object.
                const obj = JSON.parse(response);
    
                // --- display status.
                $(obj.showCheck+curr_num).find("span.uploaded-indicator").html(obj.check);
                $(obj.showStatus+curr_num).html(obj.status);
                $(obj.showDate+curr_num).html(obj.date);

                // --- view button.
                $("a#view-uploaded-"+view_uploaded).removeClass("collapse").prop("href", "../assets/attachment/student/"+studuni_id+"/submission/"+subj_type+"/"+tlm_type+"/"+file.name);

                // --- call tooltip() function manually to show the tooltip.
                $("[data-bs-toggle=tooltip]").tooltip();
            });

            // Triggered when there is an error when uploading file.
            this.on("error", function(file, response) {
                $(file.previewElement).find(".dz-error-message").text(response);
            });
    
            // Triggered when the file exceeded the maxFiles.
            this.on("maxfilesexceeded", function(file) {
                myDropzone.removedfile(file);
            });
    
            // Triggered when the max file reached.
            this.on("maxfilesreached", function() {
                // --- disable drag/click event.
                myDropzone.removeEventListeners();
            });
    
            // Triggered when removing the file.
            this.on("removedfile", function(file) {
                $.ajax({
                    type: "POST", 
                    url: "function/learning-material.php", 
                    data: { deleteUploadedFile: file_info, tlm_id: tlm_id }, 
                    dataType: "json", 
                    success: function(data) {
                        // --- display status.
                        $(data.showCheck+curr_num).find("span.uploaded-indicator").html("");
                        $(data.showStatus+curr_num).html(data.status);
                        $(data.showDate+curr_num).html(data.date);

                        // --- view button.
                        $("a#view-uploaded-"+view_uploaded).addClass("collapse").prop("href", "");
                    }
                });
                
                // --- enable drag/click event.
                myDropzone.setupEventListeners();
                // --- remove the file (display).
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            });
        }
    });
});

/**-------------------------------------------------------- DROPZONE.JS (TUTORIAL, ASSIGNMENT, PROJECT) --------------------------------------------------------**/