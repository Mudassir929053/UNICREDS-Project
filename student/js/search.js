/*--------------------------------------------------------- HTML CODE ---------------------------------------------------------*/

/**
 * Function that holds the HTML code for loading spinner.
 * 
 * @returns string of loading spinner HTML code.
 */
function loadSpinner() {
    var spinner = (
        '<!-- Loading spinner -->' + 
        '<div class="d-flex justify-content-center">' + 
            '<div class="spinner-border text-warning mt-2 mb-2" role="status">' + 
                '<span class="sr-only">Loading...</span>' + 
            '</div>' + 
        '</div>'
    );

    return spinner;
}

/**-------------------------------------------------------- HTML CODE --------------------------------------------------------**/


/*--------------------------------------------------------- AJAX REQUEST ---------------------------------------------------------*/

/**
 * Function that holds ajax requests based on the search query for Matched.
 * 
 * @param {string} search_query string of input from search box.
 */
function queryMatched(search_query) {
    $.ajax({
        url: "function/search.php", 
        type: "POST", 
        data: { matchedSearch: search_query }, 
        dataType: "", 
        beforeSend: function() {
            $("#matched-result").html(loadSpinner());
        }, 
        success: function(data) {
            $("#matched-result").html(data);
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }, 
        complete: function() {
            // function here...
        }
    });
}

/**
 * Function that holds ajax requests based on the search query for Relevant.
 * 
 * @param {string} search_query string of input from search box.
 */
//  function queryRelevant(search_query) {
//     $.ajax({
//         url: "function/search.php", 
//         type: "POST", 
//         data: { relevantSearch: search_query }, 
//         dataType: "", 
//         beforeSend: function() {
//             $("#relevant-result").html(loadSpinner());
//         }, 
//         success: function(data) {
//             $("#relevant-result").html(data);
//         }, 
//         error: function(request, status, error) {
//             alert(request.responseText);
//             alert(error.message);
//         }, 
//         complete: function() {
//             // function here...
//         }
//     });
// }

/**-------------------------------------------------------- AJAX REQUEST --------------------------------------------------------**/


/*--------------------------------------------------------- JS EVENT ---------------------------------------------------------*/

/** 
 * Attach multiple event handlers on search box using the map parameter.
 */
$("input[type=search]").on({
    // Show search result dropdown when the user type in the input.
    input: function() {
        var query = $(this).val();

        // Check if there's an input.
        // --- if exist, then show the dropdown, if not, hide the dropdown.
        if(query.length > 0) {
            $("#search-result").removeClass("invisible").addClass("visible").css("opacity", "1");

            // Print the results.
            queryMatched(query);
            // queryRelevant(query);
        } else {
            $("#search-result").removeClass("visible").addClass("invisible").css("opacity", "0");
        }
    }, 
    // Hide the search result dropdown when the search box lose its focus.
    blur: function() {
        $("#search-result").removeClass("visible").addClass("invisible").css("opacity", "0");
    }, 
    // Submit the search query form when user hit Enter key.
    // --- redirect to `search-result.php` page.
    keydown: function(event) {
        if(event.which == 13) {
            // $("#searchBox").append("<input type='hidden' name='searchQuery' value=''>");
            $("#searchBox")[0].submit();
        }
    }
});

/**-------------------------------------------------------- JS EVENT --------------------------------------------------------**/