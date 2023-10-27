/*-------------------------------------------------- GLOBAL VARIABLES --------------------------------------------------*/

// Initialize the industry list count.
var list_count = 0;

/**------------------------------------------------- GLOBAL VARIABLES -------------------------------------------------**/


/*-------------------------------------------------- SEARCH BOX EVENT & FUNCTIONS --------------------------------------------------*/

/**
 * Function to show/hide the clear input icon (x-icon) in the search box.
 * 
 * @param {string} state accept either __show__ or __hide__ value.
 */
function clearQuery(state) {
    var clear_input = $("div#ind-search").find("span.position-absolute");

    if(state == "show") {
        clear_input.removeClass("collapse");
    } else if(state == "hide") {
        clear_input.addClass("collapse");
    }
}

/**
 * Function to show/hide the search suggestion dropdown.
 * 
 * @param {string} state accept either __show__ or __hide__ value.
 */
function searchDropdown(state) {
    var dropdown = $("div#ind-search").find("div.dropdown-menu");

    if(state == "show") {
        dropdown.addClass("visible").removeClass("invisible").css("opacity", "1");
    } else if(state == "hide") {
        dropdown.addClass("invisible").removeClass("visible").css("opacity", "0");
    }
}

/**
 * Function to fetch the industry name suggestions.
 * 
 * @param {string} query search box value.
 */
function nameSuggest(query) {
    $.ajax({
        url: "function/industry-list.php", 
        type: "POST", 
        data: { fetchIndName: query }, 
        dataType: "", 
        beforeSend: function() {
            // do something...
        }, 
        success: function(data) {
            $("div#ind-search").find("div.dropdown-menu").html(data);
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
 * Function to display the list of industries based on the search query.
 */
function searchIndustry() {
    var query = $("div#ind-search").find("input[type=search]").val();

    if(query != "") {
        $.ajax({
            url: "function/industry-list.php", 
            type: "POST", 
            data: { fetchIndQuery: query }, 
            dataType: "json", 
            beforeSend: function() {
                $("div#company-list").find("div.spinner-border").removeClass("collapse");
            }, 
            success: function(data) {
                list_count = data.list_count;

                if(data.list_count < 9) {
                    $("div#company-list").html(data.ind_list);
                    $("a#load-more").addClass("collapse");
                } else {
                    $("div#company-list").html(data.ind_list);
                    $("a#load-more").removeClass("collapse");
                }
            }, 
            error: function(request, status, error) {
                alert(request.responseText);
                alert(error.message);
            }, 
            complete: function() {
                $("div#company-list").find("div.spinner-border").addClass("collapse");
            }
        });
    }
}

/**
 * Search box events.
 */
$("div#ind-search")
    .on("input", "input[type=search]", function() {
        var value = $(this).val();

        if(value != "") {
            clearQuery("show");
            searchDropdown("show");
            nameSuggest(value);
        } else {
            clearQuery("hide");
            searchDropdown("hide");
        }
    })
    .on("blur", "input[type=search]", function() {
        searchDropdown("hide");
    })
    .on("mousedown", "div.dropdown-menu > span", function() {
        var value = $(this).html();

        $("div#ind-search").find("input[type=search]").val(value);
    })
    .on("click", "button", function() {
        searchIndustry();
    })
    .on("keydown", "input[type=search]", function(e) {
        if(e.which == 13) {
            searchIndustry();
            searchDropdown("hide");
        }
    })
    .on("click", "span.position-absolute > i", function() {
        // To clear the search input value.
        $("div#ind-search").find("input[type=search]").val("");
        
        clearQuery("hide");
        searchDropdown("hide");
    });

/**------------------------------------------------- SEARCH BOX EVENT & FUNCTIONS -------------------------------------------------**/


/*-------------------------------------------------- INDUSTRY LIST EVENTS & FUNCTIONS --------------------------------------------------*/

/**
 * Function to fetch all the industries list.
 */
function fetchAllInd() {
    $.ajax({
        url: "function/industry-list.php", 
        type: "POST", 
        data: { fetchAllInd: "" }, 
        dataType: "json", 
        beforeSend: function() {
            $("div#company-list").find("div.spinner-border").removeClass("collapse");
        }, 
        success: function(data) {
            list_count = data.list_count;

            if(data.list_count < 9) {
                $("div#company-list").append(data.ind_list);
                $("a#load-more").addClass("collapse");
            } else {
                $("div#company-list").append(data.ind_list);
                $("a#load-more").removeClass("collapse");
            }
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }, 
        complete: function() {
            $("div#company-list").find("div.spinner-border").addClass("collapse");
        }
    });
}

/**
 * Trigger the event when the windows is loaded.
 */
$(window).on("load", function() {
    fetchAllInd();
});

/**
 * When `Load More` button is clicked, send AJAX Request and receive the industry lists based on the list_count.
 */
$("a#load-more").on("click", function() {
    var query = $("div#ind-search").find("input[type=search]").val();

    $.ajax({
        url: "function/industry-list.php", 
        type: "POST", 
        data: { fetchIndList: list_count, query: query != "" ? query : "NULL" }, 
        dataType: "json", 
        beforeSend: function() {
            $("a#load-more").find("div.spinner-border").removeClass("collapse");
        }, 
        success: function(data) {
            if(data.list_count < 9) {
                $("div#company-list").append(data.ind_list);
                $("a#load-more").addClass("collapse");
            } else {
                $("div#company-list").append(data.ind_list);
                $("a#load-more").removeClass("collapse");
                list_count += 9;
            }
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }, 
        complete: function() {
            $("a#load-more").find("div.spinner-border").addClass("collapse");
        }
    });
});

/**------------------------------------------------- INDUSTRY LIST EVENTS & FUNCTIONS -------------------------------------------------**/