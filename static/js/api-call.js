$(document).ready(function () {
    if (!!Cookies.get('user')) {
        // have cookie

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

        $('#counter').find('button').click(function () {
            location.href = "/unicreds/checkout.php";
        });

        var pathname = window.location.pathname;

        if (pathname === '/unicreds/not-index.php') {
            $("#login").hide();
            $("#course").show();
            $("#subcourse").show();

            $.getJSON('/unicreds/module/get_course.php', {
                r: "course"
            }, function (data) {
                $.each(data, function (index, element) {
                    $('#course').append(
                        $('<div class="ridge">').append([
                            $('<p>', {
                                text: element.name
                            }),
                            $('<p>', {
                                text: element.description
                            }),
                            $('<p>', {
                                text: 'RM ' + parseFloat(element.fee / 100).toFixed(2)
                            }),
                            $(' <button>', {
                                "data-id": element.id,
                                "data-type": element.type,
                                "data-function": "buynow",
                                "text": 'Enroll Now'
                            }),
                        ])
                    );
                });
            });

            $.getJSON('/unicreds/module/get_course.php', {
                r: "microcredential"
            }, function (data) {
                $.each(data, function (index, element) {
                    $('#subcourse').append(
                        $('<div class="ridge">').append([
                            $('<p>', {
                                text: element.name
                            }),
                            $('<p>', {
                                text: element.description
                            }),
                            $('<p>', {
                                text: 'RM ' + parseFloat(element.fee / 100).toFixed(2)
                            }),
                            $(' <button>', {
                                "data-id": element.id,
                                "data-type": element.type,
                                "data-function": "buynow",
                                "text": 'Enroll Now'
                            }),
                            $(' <button>', {
                                "data-id": element.id,
                                "data-type": element.type,
                                "data-function": "addtocart",
                                "text": 'Add To Cart'
                            }),
                        ])
                    );
                });
            });

            $('#course, #subcourse').on('click', 'button', function () {
                // console.log('ge');
                $(this).prop("disabled", true);

                $payload = {
                    'data-id': $(this).attr("data-id"),
                    'data-type': $(this).attr("data-type"),
                    'data-function': $(this).attr("data-function"),
                    'text': $(this).text()
                }
                console.log($payload);

                $.post('/unicreds/module/post_cart.php', $payload, function ($data) {
                    console.log($data);
                    if ($data['result'] == 'success') {
                        console.log('Success');
                        if ($data.hasOwnProperty('redirect_url')) {
                            // alert('YES I AM EXIST BTIHC');
                            location.href = $data['redirect_url'];
                        }

                    } else if ($data['result'] == 'fail_already_exist') {
                        alert('Already in cart');
                    } else if ($data['result'] == 'fail_already_enrolled') {
                        alert('Course already enrolled');
                    } else {
                        alert('Fail');
                    }
                }).done(function ($data) {
                    console.log($data['redirect_url']);
                }).fail(function () {
                    alert('error');
                }).always(function () {
                    // alert('finished');
                });

            });

        } else if (pathname === '/unicreds/cart.php') {
            $.getJSON('/unicreds/module/post_cart.php', function (data) {

                var course_num = $('#course_num').text().replace(/[0-9]+/, data.length);
                $('#course_num').text(course_num);

                var total = 0;

                $.each(data, function (index, element) {
                    console.log(index);
                    total += parseInt(element.product_price);
                    $('#cart').append(
                        $('<div class="ridge">').append([
                            $('<p>', {
                                text: element.product_name
                            }),
                            $('<p>', {
                                text: 'RM ' + parseFloat(element.product_price / 100).toFixed(2)
                            }),
                            $(' <a>', {
                                class: "remove",
                                "data-id": element.product_id,
                                "data-type": element.product_type,
                                "data-function": "remove",
                                "text": 'Remove'
                            }),
                        ])
                    );
                });

                var grand_total = $('#grand_total').text().replace(/[0-9]+/,
                    parseFloat(total / 100).toFixed(2));
                $('#grand_total').text(grand_total);

                // From cart
                $('#cart').on('click', 'a.remove', function () {
                    // console.log('ge');
                    // $(this).prop("disabled", true);
                    console.log('data-id :' + $(this).attr("data-id") +
                        '\ndata-type :' + $(this).attr("data-type") +
                        '\ndata-function :' + $(this).attr("data-function") +
                        '\ntext :' + $(this).text());

                    $payload = {
                        'data-id': $(this).attr("data-id"),
                        'data-type': $(this).attr("data-type"),
                        'data-function': $(this).attr("data-function"),
                        'text': $(this).text()
                    }

                    $.post('/unicreds/module/post_cart.php', $payload, function ($data) {
                        console.log($data);
                        if ($data['result'] == 'success') {
                            location.reload();
                        } else {
                            alert('Fail');
                        }
                    }).done(function () {
                        // alert('second success');
                    }).fail(function () {
                        alert('error');
                    }).always(function () {
                        // alert('finished');
                    });

                });

            });
        } else if (pathname === '/unicreds/checkout.php') {

            var r = getUrlParameter('r');

            $payload = null;

            if (r) {
                $payload = {
                    r: r
                }
            }

            $.getJSON('/unicreds/module/post_cart.php', $payload, function (data) {

                var course_num = $('#course_num').text().replace(/[0-9]+/, data.length);
                $('#course_num').text(course_num);

                var total = 0;
                $.each(data, function (index, element) {
                    total += parseInt(element.product_price);
                    $('#item').append([
                        $('<p>', {
                            text: element.product_name
                        }),
                        $('<p>', {
                            text: 'RM ' + parseFloat(element.product_price / 100).toFixed(2)
                        }),
                        $('<hr>'),
                    ]);
                });

                var grand_total = $('#grand_total').text().replace(/[0-9]+/,
                    parseFloat(total / 100).toFixed(2));
                $('#grand_total').text(grand_total);

            });



            // From checkout
            var paymentmethod = null;
            $("input[type='radio'][name='paymentmethod']").click(function () {
                paymentmethod = $(this).val();
                console.log(paymentmethod);
            });
            $('button.order').click(function () {

                
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

                $.post('/unicreds/module/post_checkout.php', $payload, function ($data) {
                    console.log($data);
                    if ($data['result'] == 'success') {
                        console.log('Success');
                        location.href = $data['redirect_url'];
                    } else {
                        alert('Fail');
                    }
                }).done(function () {
                    // alert('second success');
                }).fail(function () {
                    alert('error');
                }).always(function () {
                    // alert('finished');
                });

            });
        }





    } else {
        // no cookie
    }
});