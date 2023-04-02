/**
 * Custom scripts
 * 
 * @author Xanders Samoth
 * @see https://www.linkedin.com/in/xanders-samoth-b2770737/
 */
/* Necessary headers for APIs */
// var headers = {'Authorization': 'Bearer ' + $('#custom-style').attr('blp-api-token'), 'Accept': 'application/json', 'X-localization': navigator.language};

$(document).ready(function () {
    /* Return false when click on "#" link */
    $('[href="#"]').on('click', function (e) {
        return false;
    });

    $('.back-to-top').click(function (e) {
        $("html, body").animate({ scrollTop: "0" });
    });

    /* Multiline text truncation */
    $('.paragraph-ellipsis').multilineTruncation('.paragraph2', 2, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph3', 3, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph4', 4, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph5', 5, '.roll-block a');

    /* Animate number counter */
    $('.counter').animateCounter(4000);

    /* Upload news/user cropped photo */
    $('.news-image img').uploadNewsImage('#cropModal1', '#news_image', currentHost + '/api/news/add_image/' + parseInt($('#newsId').val()), 'news_id');
    $('.user-image img').uploadUserImage('#cropModal1', '#avatar', currentHost + '/api/user/update_avatar_picture/' + parseInt($('#userId').val()), 'user_id');

    /* Load other user image */
    $('.other-user-image-recto img').loadOtherUserImage('#cropModal2', '.register_image_recto', '#loaded_image_recto', '.image_64_recto');
    $('.other-user-image-verso img').loadOtherUserImage('#cropModal2', '.register_image_verso', '#loaded_image_verso', '.image_64_verso');

    /* Auto-resize textarea */
    autosize($('textarea'));

    /* jQuery Date picker */
    $('#register_birthdate').datepicker({
        dateFormat: navigator.language.startsWith('fr') ? 'dd/mm/yyyy' : 'yyyy-mm-dd',
        onSelect: function () {
            $(this).focus();
        }
    });

    /* On select change, update de country phone code */
    $('#select_country1').on('change', function () {
        var countryPhoneCode = $(this).val();

        $('#phone_code_text1 .text-value').text(countryPhoneCode);
        $('phone_code1').val(countryPhoneCode);
    });
    $('#select_country2').on('change', function () {
        var countryPhoneCode = $(this).val();

        $('#phone_code_text2 .text-value').text(countryPhoneCode);
        $('phone_code2').val(countryPhoneCode);
    });
    $('#select_country3').on('change', function () {
        var countryPhoneCode = $(this).val();

        $('#phone_code_text3 .text-value').text(countryPhoneCode);
        $('phone_code3').val(countryPhoneCode);
    });

    /* On check, show/hide some blocs */
    // OFFER TYPE
    $('#donationType .form-check-input').each(function () {
        $(this).on('click', function () {
            if ($('#anonyme').is(':checked')) {
                $('#donorIdentity').addClass('d-none');

            } else {
                $('#donorIdentity').removeClass('d-none');
            }
        });
    });
    // TRANSACTION TYPE
    $('#paymentMethod .form-check-input').each(function () {
        $(this).on('click', function () {
            if ($('#anonyme').is(':checked')) {
                $('#phoneNumberForMoney').addClass('d-none');

            } else {
                $('#phoneNumberForMoney').removeClass('d-none');
            }
        });
    });

    /* Hover stretched link */
    $('.card-body + .stretched-link').each(function () {
        $(this).hover(function () {
            $(this).addClass('changed');

        }, function () {
            $(this).removeClass('changed');
        });
    });

    /* Mark all notifications as read */
    $('#markAllRead').click(function (e) {
        e.preventDefault();

        $.ajax({
            headers: headers,
            type: 'PUT',
            contentType: 'application/json',
            url: currentHost + '/api/notification/mark_all_read/' + parseInt($(this).attr('data-user-id')),
            success: function () {
                window.location.reload();
            },    
            error: function (xhr, error, status_description) {
                console.log(xhr.responseJSON);
                console.log(xhr.status);
                console.log(error);
                console.log(status_description);
            }
        });
    });

    /* Run an ajax function every second */
    // setInterval(function () {
    // }, 1000);
});
