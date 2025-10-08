$('#exilednoname-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let fileInput = $(this).find('input[type="file"]')[0];
    let hasFile = fileInput && fileInput.files.length > 0;

    let progressBar = $('#uploadProgress');
    let bar = progressBar.find('.progress-bar');

    $('#errors').html('');
    $('#success').html('');

    $.ajax({
        xhr: function () {
            let xhr = new window.XMLHttpRequest();

            if (hasFile) {
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        progressBar.show();
                        bar.css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                }, false);
            }

            return xhr;
        },

        url: this_url + "/../",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,

        beforeSend: function () {
            if (hasFile) {
                progressBar.show();
                bar.css('width', '0%').text('0%');
            } else {
                progressBar.hide();
            }
        },

        success: function (res) {
            $('.kt-form-message').remove();
            $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');
            if (['success', 'error'].includes(res.status)) {
                window.location.href = res.redirect_url;
            }
        },

        error: function (xhr) {
            if (xhr.status === 422) {
                $('.kt-form-message').remove();
                $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');

                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    let input = $('[name="' + key + '"]');
                    input.attr('aria-invalid', 'true');
                    input.addClass('border-red-500');
                    input.closest('.kt-form-control').next('.kt-form-message').text(value[0]);
                    input.after('<div class="kt-form-message">' + value[0] + '</div>');
                });
            }
        }
    });
});