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
    $('[href="#"]').on('click',  function(e){
        return false;
    });

    $('.back-to-top').click(function(e){
        $("html, body").animate({ scrollTop: "0" });
    });

    /* Multiline text truncation */
    $('.paragraph-ellipsis').multilineTruncation('.paragraph2', 2, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph3', 3, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph4', 4, '.roll-block a');
    $('.paragraph-ellipsis').multilineTruncation('.paragraph5', 5, '.roll-block a');

    /* Animate number counter */
    $('.counter').animateCounter(4000);

    /* Upload cropped photo */
    $('.user-image img').uploadImage('#cropModalUser', '#avatar', '/api/user/update_avatar_picture/' + parseInt($('#userId').val()), 'user_id');
    $('.other-user-image img').uploadImage('#cropModalOtherUserImage', '#other_user_image', '/api/user/add_image/' + parseInt($('#otheruserId').val()), 'other_user_id');
    $('.news-image img').uploadImage('#cropModalOtherUserImage', '#news_image', '/api/news/add_image/' + parseInt($('#newsId').val()), 'news_id');

    /* Auto-resize textarea */
    autosize($('textarea'));

    /* jQuery Date picker */
    $('#register_birthdate').datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $(this).focus();
        }
    });

    /* HOVER STRETCHED LINK */
    $('.card-body + .stretched-link').each(function () {
        $(this).hover(function () {
            $(this).addClass('changed');

        }, function () {
            $(this).removeClass('changed');
        });
    })

    setInterval(function () {
        /* Update administrator API token */
        $.ajax({
            headers: {'Authorization': 'Bearer ' + Cookies.get('acr-devref'), 'Accept': 'application/json', 'X-localization': navigator.language},
            type: 'PUT',
            contentType: 'application/json',
            url: '/api/user/update_api_token/3',
            dataType: 'json',
            success: function () {
            },    
            error: function (xhr, error, status_description) {
                console.log(xhr.responseJSON);
                console.log(xhr.status);
                console.log(error);
                console.log(status_description);
            }    
        });

    },60000); /* Run an ajax function every minute */
});
