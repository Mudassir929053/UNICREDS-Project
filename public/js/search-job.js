$(document).ready(function() {
    // Display the query search results based on function below.
    fetchJobList();


/*-------------------------------------------------- SEARCH BOX EVENT & FUNCTIONS --------------------------------------------------*/

    /**
     * Function to show/hide the clear input (X-icon) for the search boxes (Job title and Job location).
     * 
     * @param {string} input_value value in the current search box.
     * @param {string} curr_search_box id of the current search box.
     */
    function showClearInput(input_value, curr_search_box) {
        if(input_value !== "") {
            $("div#"+curr_search_box).find("div > span.pe-3").removeClass("collapse");
            $("div#"+curr_search_box).find("div > span.pe-3").removeClass("collapse");
        } else {
            $("div#"+curr_search_box).find("div > span.pe-3").addClass("collapse");
            $("div#"+curr_search_box).find("div > span.pe-3").addClass("collapse");
        }
    }

    /**
     * Function to fetch and display the job title or location suggestion.
     * 
     * @param {string} query string containing job title/location name.
     * @param {string} curr_search_box Job title or Job location search box.
     */
    function searchSuggestion(query, curr_search_box) {
        $.ajax({
            url: "function/search-job.php", 
            type: "POST", 
            data: { searchSuggestion: curr_search_box, query: query }, 
            dataType: "", 
            beforeSend: function() {
                // do something...
            }, 
            success: function(data) {
                $("div#"+curr_search_box).find("div.dropdown-menu").html(data);
            }, 
            error: function(request, status, error) {
                alert(request.responseText);
                alert(error.message);
            }, 
            complete: function() {
                // do something...
            }
        });
    }

    /**
     * Clear the search boxes (Job title and Job location) when the X-icon are clicked.
     */
    $("div#job-title, div#job-location").find("i.fe-x").on("click", function() {
        var curr_search_box = $(this).closest(".col-md-4").prop("id");

        $("div#"+curr_search_box).find("input[type=search]").val("");
        $("div#"+curr_search_box).find("div > span.pe-3").addClass("collapse");
    });

    /**
     * Job Location Event.
     */
    $("div#job-title, div#job-location")
        .on("input", "input[type=search]", function() {
            // Show/hide the clear search boxes (Job title and Job location) and display the Job location suggestion dropdown.
            var input_value = $(this).val();
            var curr_search_box = $(this).parents(".col-md-4").prop("id");

            showClearInput(input_value, curr_search_box);

            // Show/hide the Job title/Job location dropdown menu.
            var dropdown_menu = $("div#"+curr_search_box).find("div.dropdown-menu");
            if(input_value !== "") {
                dropdown_menu.addClass("visible").removeClass("invisible").css("opacity", "1");

                searchSuggestion(input_value, curr_search_box);
            } else {
                dropdown_menu.removeClass("visible").addClass("invisible").css("opacity", "0");
            }
        })
        .on("blur", "input[type=search]", function() {
            // Hide the the Job location dropdown menu when the input lose focus.
            var curr_search_box = $(this).parents(".col-md-4").prop("id");
            
            $("div#"+curr_search_box).find("div.dropdown-menu").removeClass("visible").addClass("invisible").css("opacity", "0");
        })
        .on("mousedown", "div.dropdown-menu > span", function() {
            // Click on the suggestion to insert it into the Job title's/Job location's search box.
            var curr_search_box = $(this).parents(".col-md-4").prop("id");        
            var span_val = $(this).html();

            if(!($(this).hasClass("text-muted"))) {
                $("div#"+curr_search_box).find("input[type=search]").val(span_val);
            }
        });

/*-------------------------------------------------- SEARCH BOX EVENT & FUNCTIONS --------------------------------------------------*/


/*-------------------------------------------------- JOB SEARCH & FILTER EVENTS --------------------------------------------------*/

    /**
     * Displays Job Offers based on the search queries when the Search button is clicked.
     */
    $("button#search-job").on("click", function() {
        // Reset the Job filter.
        $("div#job-filter").find("select#job-type-filter").val("default").selectpicker("refresh");
        $("div#job-filter").find("select#date-posted-filter").val("anytime").selectpicker("refresh");

        // Display the query search results based on function below.
        fetchJobList();
    });

    /**
     * Displays Job Offers based on the search filters when the Apply button is clicked.
     */
    $("button#apply-filter").on("click", function() {
        const job_type_arr = new Array();
        var date_posted = "";

        var selected = $("div#job-filter").find(":selected");
        selected.each(function() {
            var select_id = $(this).closest("select").prop("id");
            var curr_value = $(this).val();

            if(select_id == "job-type-filter") {
                job_type_arr.push(curr_value);
            } else if(select_id == "date-posted-filter"){
                date_posted = curr_value;
            }
        });

        fetchJobList();
    });

    /**
     * Displays Job Offers based on the company name when the company name link is clicked in Job Description section.
     */
    $("div#job-desc-card").on("click", "a#ind-name", function() {
        var ind_name = $(this).text();

        $("div#job-title").find("input[type=search]").val(ind_name);

        showClearInput(ind_name, "job-title");
        fetchJobList();
    });

    /**
     * Displays Job Offers based on the job category when the job category link is clicked in Job Description section.
     */
    $("div#job-desc-card").on("click", "a#job-categ", function() {
        var categ_code = $(this).data("categ-code");

        $("div#jobSearch select").val(categ_code).selectpicker("refresh");
        
        fetchJobList();
    });

/**------------------------------------------------- JOB SEARCH & FILTER EVENTS -------------------------------------------------**/


/*-------------------------------------------------- JOB PAGINATION --------------------------------------------------*/

    /**
     * Function for the pagination of the Job Offers list.
     * 
     * @param {string} direction either __prev__ or __next__.
     */
    function pagination(direction) {
        var li_btwn = $("ul.pagination li:first").nextUntil("li:last");

        li_btwn.each(function(index) {
            if($(this).hasClass("active")) {
                if(direction == "prev") {
                    if(index == 0) {
                        // alert("This is the first page.");
                    } else {
                        $(this).removeClass("active");
                        $(this).prev().addClass("active");

                        page_num = $(this).prev().data("page");
                        fetchJobList(page_num);
                    }
                } else if(direction == "next") {
                    if(index == (li_btwn.length - 1)) {
                        // alert("This is the last page.");
                    } else {
                        $(this).removeClass("active");
                        $(this).next().addClass("active");

                        page_num = $(this).next().data("page");
                        fetchJobList(page_num);
                    }
                }
                return false;
            }
        });
    }

    /**
     * Triggers when the pagination arrow are clicked.
     */
    $("ul.pagination")
        .on("click", "li:first", function() {
            pagination("prev");
        })
        .on("click", "li:last", function() {
            pagination("next");
        });

    /**
     * Triggers when the page numbers are clicked.
     */
    $("ul.pagination").on("click", "li.page-num", function() {
        var li_btwn = $("ul.pagination li:first").nextUntil("li:last");
        li_btwn.each(function() {
            if($(this).hasClass("active")) {
                $(this).removeClass("active");
            }
        });
        $(this).addClass("active");

        var page_num = $(this).data("page");
            
        fetchJobList(page_num);
    });

/**------------------------------------------------- JOB PAGINATION -------------------------------------------------**/


/*-------------------------------------------------- JOB SEARCH AJAX REQUEST --------------------------------------------------*/

    /**
     * Function to fetch all the value in the search boxes.
     * 
     * @return {object|null} object that contains the job's title, location, and category. If no input, return null.
     */
    function searchQuery() {
        var form_id = $("div#jobSearch");
        var job_title = form_id.find("input[name=job-title]");
        var job_location = form_id.find("input[name=job-location]");
        var job_category = form_id.find("select[name=job-category]");

        const search_query = {
            "job_title"     : job_title.val() != "" ? job_title.val() : null, 
            "job_location"  : job_location.val() != "" ? job_location.val() : null, 
            "job_category"  : job_category.val() != "" ? job_category.val() : null
        };

        var count = 0;
        $.each(search_query, function(key, val) {
            if(val == null) {
                count++;
            }
        });

        if(count == 3) {
            return null;
        } else {
            return search_query;
        }
    }

    /**
     * Function to fetch all the value in the filter boxes.
     * 
     * @return {object} object that contains the job's types and date posted.
     */
    function searchFilter() {
        var job_type_arr = new Array();
        var date_posted = "";

        var selected = $("div#job-filter").find(":selected");
        selected.each(function() {
            var select_id = $(this).closest("select").prop("id");
            var curr_value = $(this).val();

            if(select_id == "job-type-filter") {
                job_type_arr.push(curr_value);
            } else if(select_id == "date-posted-filter"){
                date_posted = curr_value;
            }
        });

        return {
            "job_type"      : job_type_arr.length > 0 ? job_type_arr : null, 
            "date_posted"   : date_posted
        };
    }

    /**
     * Function to print the page count of the pagination.
     * 
     * @param {number} total_job total number of jobs.
     * @param {number} page_num current page number.
     */
    function paginationDisplay(total_job, page_num) {
        var total_page = Math.ceil(total_job/30);

        $("ul.pagination").html("");

        var str = (
            '<li class="page-item">' + 
                '<a class="page-link" aria-label="Previous" style="cursor: pointer;">' + 
                    '<span aria-hidden="true"><i class="fe fe-chevron-left"></i></span>' + 
                '</a>' + 
            '</li>'
        );
        for(var i = 0; i < total_page; i++) {
            str += (
                '<li class="page-num page-item '+((i + 1) == page_num ? "active" : "")+'" data-page="'+(i + 1)+'">' + 
                    '<a class="page-link" style="cursor: pointer;">'+(i + 1)+'</a>' + 
                '</li>'
            );
        }
        str += (
            '<li class="page-item">' + 
                '<a class="page-link" aria-label="Next" style="cursor: pointer;">' + 
                    '<span aria-hidden="true"><i class="fe fe-chevron-right"></i></span>' + 
                '</a>' + 
            '</li>'
        );

        $("ul.pagination").html(str);
    }

    /**
     * Function to fetch the job offer results based on the query and filter.
     * Send an AJAX Request.
     * 
     * @param {number} page_num number of page. Default: __1__.
     */
     function fetchJobList(page_num = 1) {
        // Display all job offers based on search queries.
        $.ajax({
            url: "function/search-job.php", 
            type: "POST", 
            data: { fetchJobList: "fetch_type", search_query: searchQuery(), search_filter: searchFilter(), page_num: page_num }, 
            dataType: "json", 
            beforeSend: function() {
                $("div#job-offers-card").find("div.spinner-border").removeClass("collapse");
                $("div#job-desc-card").find("div.spinner-border").removeClass("collapse");
            }, 
            success: function(data) {
                var total_job_list = data.total_count;

                $("div#job-offers-card").find("div > ul").html(data.job_list);
                $("div#job-desc-card").find("div.overflow-hidden").html(data.job_desc_count);

                var lwr_count = data.curr_count != 0 ? (data.curr_count == 30 ? ((page_num * 30) - 30) + 1 : (page_num > 1 ? ((page_num - 1) * 30) + 1 : 1)) : 0;
                var upr_count = data.curr_count != 0 ? (page_num == 0 ? data.curr_count : (data.curr_count == 30 ? (page_num * 30) : (lwr_count - 1) + data.curr_count)) : 0;
                $("span#curr-count").html(lwr_count + " - "+upr_count);
                $("span#total-count").html(data.total_count);

                // --- call tooltip() function manually to show the tooltip.
                $("[data-bs-toggle=tooltip]").tooltip();

                data.total_count == 0 ? $("div#pagination").addClass("collapse") : $("div#pagination").removeClass("collapse");
                paginationDisplay(total_job_list, page_num);
                footer_display();
            }, 
            error: function(request, status, error) {
                alert(request.responseText);
                alert(error.message);
            }, 
            complete: function() {
                $("div#job-offers-card").find("div.spinner-border").addClass("collapse");
                $("div#job-desc-card").find("div.spinner-border").addClass("collapse");
            }
        });
    }

/**------------------------------------------------- JOB SEARCH AJAX REQUEST -------------------------------------------------**/


/*-------------------------------------------------- JOB DESCRIPTION AJAX REQUEST --------------------------------------------------*/

    /**
     * Fetch and display the Job Descriptions based on the selected Job Offers.
     * Send an AJAX Request.
     */
    $("div#job-offers-card").on("click", "div > ul > li", function() {
        $("div#job-offers-card").find("div > ul > li.bg-light-info").removeClass("bg-light-info");
        $(this).addClass("bg-light-info");
        
        var job_id = $(this).data("id");

        $.ajax({
            url: "function/search-job.php", 
            type: "POST", 
            data: { fetchJobDesc: job_id }, 
            dataType: "", 
            beforeSend: function() {
                $("div#job-desc-card").find("div.spinner-border").removeClass("collapse");
            }, 
            success: function(data) {
                $("div#job-desc-card").find("div.overflow-hidden").html(data);
                // --- call tooltip() function manually to show the tooltip.
                $("[data-bs-toggle=tooltip]").tooltip();
                
                footer_display();
            }, 
            error: function(request, status, error) {
                alert(request.responseText);
                alert(error.message);
            }, 
            complete: function() {
                $("div#job-desc-card").find("div.spinner-border").addClass("collapse");
            }
        });
    });

/**------------------------------------------------- JOB DESCRIPTION AJAX REQUEST -------------------------------------------------**/

});