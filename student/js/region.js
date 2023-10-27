/*--------------------------------------------------------- FUNCTION TO FETCH STATE & CITY ---------------------------------------------------------*/

/**
 * Function to fetch all state and city based on the country id and state id.
 * 
 * @param {string} formID ID for the edit form. 
 */
 function viewCurrPlace(formID) {
    // --- get the selected country value (country_id).
    var selectedVal = $("form#"+formID).find("select[name=countryID]").find(":selected").val();
    // --- get the state_id.
    var stateID = $("form#"+formID).find("select[name=stateID]").data("state-id");
    // --- get the city_id.
    var cityID = $("form#"+formID).find("select[name=cityID]").data("city-id");

    $.ajax({
        type: "POST", 
        url: "function/region.php", 
        data: { fetchCurrAddr: "", country_id: selectedVal, state_id: stateID, city_id: cityID }, 
        dataType: "json", 
        success: function(data) {
            $("form#"+formID).find("select[name=stateID]").html(data.state);
            $("form#"+formID).find("select[name=cityID]").html(data.city);
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
}

/**
 * Function to fetch all state based on country id.
 * 
 * @param {string} selectID ID for the `select` tag for Country input.
 * @param {string|number} countryID DATA- for the `select` tag for Country input.
 */
function fetchState(selectID, countryID) {
    // --- get the ID of the form.
    var formID = $("#"+selectID).closest("form").prop("id");

    $.ajax({
        type: "POST", 
        url: "function/region.php", 
        data: { fetchState: "", country_id: countryID }, 
        success: function(data) {
            $("#"+formID).find("select[name=stateID]").html(data);
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
}

/**
 * Function to fetch all city based on state id.
 * 
 * @param {string} selectID ID for the `select` tag for State input.
 * @param {string|number} stateID DATA- for the `select` tag for State input.
 */
function fetchCity(selectID, stateID) {
    // --- get the ID of the form.
    var formID = $("#"+selectID).closest("form").prop("id");

    $.ajax({
        type: "POST", 
        url: "function/region.php", 
        data: { fetchCity: "", state_id: stateID }, 
        success: function(data) {
            $("#"+formID).find("select[name=cityID]").html(data);
        }, 
        error: function(request, status, error) {
            alert(request.responseText);
            alert(error.message);
        }
    });
}

/**-------------------------------------------------------- FUNCTION TO FETCH STATE & CITY --------------------------------------------------------**/