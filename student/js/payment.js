$(document).ready(function() {
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
// console.log("here");
    var pathname = window.location.pathname;

    if (pathname === '/unicreds/student/micro-creds-enroll.php' || pathname === '/unicreds/student/course-enroll.php' || pathname === '/unicreds/student/ep-enroll.php') {

        $('#addtocart').on('click', 'button', function() {
            $(this).prop("disabled", true);
            // console.log(this);
            $payload = {
                'data-id': $(this).attr("data-id"),
                'data-type': $(this).attr("data-type"),
                'data-function': $(this).attr("data-function"),
                'text': $(this).text()
            }
            // console.log($payload);

            $.post('/unicreds/module/post_cart.php', $payload, function($data) {
                console.log($data);
                // return false;
                if ($data['result'] == 'success') {

                    if ($data['type'] == 'c') {
                        console.log('C')
                        if ($data['function'] == 'addtocart') {
                            $('#addcartbody').html('Successfully added to cart');
                            $('#addcart').toast('show');

                            $("#addtocart").load(" #addtocart > *");
                        } else {
                            console.log('Success');
                            if ($data.hasOwnProperty('redirect_url')) {
                                location.href = $data['redirect_url'];
                            }
                        }
                    } else if ($data['type'] == 'mc') {
                        console.log('MC')
                        if ($data['function'] == 'addtocart') {
                            $('#addcartbody').html('Successfully added to cart');
                            $('#addcart').toast('show');
                            $("#addtocart").load(" #addtocart > *");
                        } else {
                            console.log('Success');
                            if ($data.hasOwnProperty('redirect_url')) {
                                location.href = $data['redirect_url'];
                            }
                        }
                    }
                      else if ($data['type'] == 'ep') {
                        console.log('EP')
                        if ($data['function'] == 'addtocart') {
                            $('#addcartbody').html('Successfully added to cart');
                            $('#addcart').toast('show');
                            $("#addtocart").load(" #addtocart > *");
                        } else {
                            console.log('Success');
                            if ($data.hasOwnProperty('redirect_url')) {
                                location.href = $data['redirect_url'];
                            }
                        }
                    }else {
                        alert('Error');
                    }
                } else if ($data['result'] == 'fail_already_exist') {
                    $('#incartbody').html('Already in cart');
                    $('#incart').toast('show');
                    $("#addtocart").load(" #addtocart > *");
                } else if ($data['result'] == 'fail_already_enrolled') {
                    $('#enrolledbody').html('Course already enrolled');
                    $('#enrolled').toast('show');
                    $("#addtocart").load(" #addtocart > *");
                } else {
                    alert('Fail');
                }
            }).done(function($data) {
                // console.log($data);
            }).fail(function() {
                alert('error111');
                console.log(this);
            }).always(function() {
                // alert('finished');
            });
        });



    } else if (pathname === '/unicreds/student/cart-checkout.php') {

        var r = getUrlParameter('r');

        $payload = null;

        if (r) {
            $payload = {
                r: r
            }
        }

        // From checkout
        var paymentmethod = null;
        $("input[type='radio'][name='paymentmethod']").click(function() {
            paymentmethod = $(this).val();
            console.log(paymentmethod);
        });
        $('#placeorder').click(function() {


            if (r) {
                $payload = {
                    r: r,
                    "paymentmethod": paymentmethod,
                    "country_id": 123,
                }
            } else {
                $payload = {
                    "paymentmethod": paymentmethod,
                    "country_id": 123,
                }
            }

            console.log('I am order, clicked');
            if (paymentmethod == null) {
                console.log('Invalid payment method');
                return;
            }

            $.post('/unicreds/module/post_checkout.php', $payload, function($data) {
                console.log($data);
                if ($data['result'] == 'success') {
                    console.log('Success');
                    location.href = $data['redirect_url'];
                } else {
                    alert('Fail');
                }
            }).done(function() {
                // alert('second success');
            }).fail(function() {
                alert('error');
            }).always(function() {
                // alert('finished');
            });

        });
    }

});