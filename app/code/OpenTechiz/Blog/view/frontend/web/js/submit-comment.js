define([
    'jquery',
    'mage/url',
    'mage/mage'
], function ($, urlBuilder) {

    return function () {

        $('#blog-comment-form').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: urlBuilder.build('blog/comment/save'),
                type: 'POST',
                data: formData,
                showLoader: true,
                success: function (response) {
                    $('#comment-response').html('<div class="message success">' + response.message + '</div>');
                    $('#blog-comment-form')[0].reset();
                },
                error: function (xhr) {
                    $('#comment-response').html('<div class="message error">' + xhr.responseJSON.message + '</div>');
                }
            });
        });
    };
});
