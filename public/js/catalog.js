$(document).ready(function() {

    const coursePath = "/unicreds/public/course-lists.php";
    const mcPath = "/unicreds/public/micro-creds-lists.php";
    const epPath = "/unicreds/public/ep-list.php";
    var getPath = window.location.pathname;
    var curr_path = "";

    // Check if this is course or micro-credential list page.
    if (getPath == coursePath) {
        var curr_path = "c";
    } else if (getPath == mcPath) {
        var curr_path = "mc";
    }
     else if (getPath == epPath) {
        var curr_path = "ep";
    }

    var curr_list_count = 0;

    /**
     * View the courses/microcredentials list based on the checked institutions & academic level when the page being loaded.
     */
    filterCheckbox();


    /*--------------------------------------------------------- JS EVENT ---------------------------------------------------------*/

    /**
     * View the list of courses/microcredentials based on the filter type (currently: institution, academic level).
     */
    $("div#filter").find("input[type='checkbox']").on("change", function() {
        curr_list_count = 0;

        $("div#gridList").html("");
        $("div#tabList").html("");
        filterCheckbox();
    });

    /**
     * View more of the list when the Load more button is clicked.
     */
    $("button#load-more").on("click", function() {
        filterCheckbox();
    });

    /**
     * View the remaining of the lists when scrolling down. 
     */
    // window.onscroll = function(ev) {
    //     if ((window.innerHeight + document.documentElement.scrollTop) >= document.body.offsetHeight) {
    //         alert("Bottom");
    //     }
    // };

    /**-------------------------------------------------------- JS EVENT --------------------------------------------------------**/


    /*--------------------------------------------------------- CATALOG AJAX REQUEST ---------------------------------------------------------*/

    /**
     * Function to processed the filter input and display the results.
     */
    function filterCheckbox() {
        var checked_box = $("div#filter input:checkbox:checked");

        if (checked_box.length > 0) {
            const inst_id = [];
            const acadlvl_id = [];
            // Get the ID for each of the checked checkboxes.
            checked_box.each(function() {
                var filter_type = $(this).prop("name");

                if (filter_type == "inst") {
                    inst_id.push($(this).prop("value"));
                } else if (filter_type == "acad_lvl") {
                    acadlvl_id.push($(this).prop("value"));
                }
            });

            fetchList("filter", inst_id, acadlvl_id);
        } else {
            fetchList("all");
        }
    }

    /**
     * Function to view all the list of courses/micro-credentials based on institution and/or academic level.
     * 
     * @param {string} fetch_type can be either __all__ or __filter__.
     * @param {array} inst_id array of institution id, default is null.
     * @param {array} acad_lvl array of academic level, default is null.
     */
    function fetchList(fetch_type, inst_id = null, acad_lvl = null) {
        $.ajax({
            type: "POST",
            url: "function/catalog.php",
            data: { fetchList: fetch_type, curr_path: curr_path, list_count: curr_list_count, inst_id: inst_id, acad_lvl: acad_lvl },
            dataType: "json",
            beforeSend: function() {
                $("#gridLoad").removeClass("collapse");
                $("#tabLoad").removeClass("collapse");
            },
            success: function(data) {
                curr_list_count += data.count;

                // --- display the number of results.
                $("span#displayCount").html(curr_list_count);
                $("span#totalCount").html(data.total);

                // --- display result in grid and tab lists view.
                $("div#gridList").append(data.grid);
                $("div#tabList").append(data.tab);

                // --- call tooltip() function manually to show the tooltip.
                $("[data-bs-toggle=tooltip]").tooltip();

                // --- show/Hide Load more button.
                if (curr_list_count < data.total) {
                    $("button#load-more").removeClass("collapse");
                } else {
                    $("button#load-more").addClass("collapse");
                }

                footer_display();
            },
            error: function(request, status, error) {
                alert(request.responseText);
                alert(error.message);
            },
            complete: function() {
                $("#gridLoad").addClass("collapse");
                $("#tabLoad").addClass("collapse");
            }
        });
    }

    /**-------------------------------------------------------- CATALOG AJAX REQUEST --------------------------------------------------------**/

});