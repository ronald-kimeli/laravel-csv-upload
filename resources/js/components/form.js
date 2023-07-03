import 'jquery/dist/jquery.min.js';
import $ from 'jquery';
import jQuery from 'jquery';

jQuery(function () {
    $('#submitButton').on('click', function (e) {
        e.preventDefault();
        const postcode = $('#postcode').val();
        const api_key = $('#api_key').val();

        const url = 'api/v1/postcodes/' + postcode;
        const data = {
            api_key: api_key
        };
        const param = 'api_key=' + data.api_key;

        const fullUrl = url + '?' + param;

        fetchPostcodes();

        function fetchPostcodes() {
            $.ajax({
                type: "GET",
                "url": `${fullUrl}`,
                // 'data' : `${param}`,
                dataType: "json",
                "headers": {
                    "Accept": "application/vnd.api+json",
                    "Accept": "application/x-www-form-urlencoded"
                },
                success: function (response) {

                    $('#message').html('');
                    $('#message').removeClass('alert alert-warning alert-dismissible fade show');

                    $('#success').html('');
                    $('#success').addClass('alert alert-success alert-dismissible fade show');
                    $('#success').append('<span><strong>Message! </strong>' + response.status + '</span>');

                    $('table').html('');

                    $('table').append('<thead>\
                            <tr>\
                            <th scope="col">ID</th>\
                            <th scope="col">Lat</th>\
                            <th scope="col">Long</th>\
                            <th scope="col">Street_Address</th>\
                            </tr>\
                           </thead>');

                    $.map(response.locations, function ({ Lat, Long, Street_Address }, index) {
                        $('table').append('<tbody>\
                                <tr key=`${index}`>\
                                <td scope="row">'+ index + '</td>\
                                <td>'+ Lat + '</td>\
                                <td><i class="bi bi-check2-circle green"></i><span class="ms-1">'+ Long + '</span></td>\
                                <td>'+ Street_Address + '</td>\
                                </tr>\
                                </tbody>');
                    });

                    $('#postcode').val('');
                    $('#api_key').val('');
                },
                error: function (jqXHR, status, error) {

                    const errors = jqXHR.responseJSON.status;

                    $('table').html('');

                    $('#success').html('');
                    $('#success').removeClass('alert alert-success alert-dismissible fade show');

                    $('#message').html('');
                    $('#message').addClass(
                        'alert alert-warning alert-dismissible fade show');
                    $('#message').append('<span><strong>Message! </strong>' +
                        errors +
                        '</span>');

                    //  $('#postcode').val('');
                    //  $('#api_key').val('');
                }
            });
        }

    });
});
