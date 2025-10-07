@extends('layouts.backend.default')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title"> Edit </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <a href="{{ $url }}"><button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" data-kt-tooltip="#tooltip_back" data-kt-tooltip-placement="bottom-start"><i class="ki-filled ki-black-right-line"></i></button></a>
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    @include($path . 'form', ['formMode' => 'edit'])
                    @include('layouts.backend.__extensions.form.date')
                    @include('layouts.backend.__extensions.form.daterange')
                    @include('layouts.backend.__extensions.form.status')
                    @include('layouts.backend.__extensions.form.active')
                    @include('layouts.backend.__extensions.form.file', ['formMode' => 'edit'])

                    <div class="flex justify-end" bis_skin_checked="1">
                        <button type="submit" class="kt-btn kt-btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>

            <div class="kt-modal" data-kt-modal="true" id="modalPicture">
                <div class="kt-modal-content w-[350px] top-5 lg:top-[15%]">
                    <div class="kt-modal-header">
                        <h3 class="kt-modal-title text-sm"> Preview </h3>
                        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost shrink-0" data-kt-modal-dismiss="true"><i class="ki-filled ki-cross"></i></button>
                    </div>
                    <div class="kt-modal-body grid gap-5 px-0 py-5">
                        <div class="flex flex-col items-center px-5 gap-2.5">
                            <img data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
                        </div>
                    </div>
                    <div class="kt-modal-footer">
                        <div></div>
                        <div class="flex gap-2">
                            <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}"><button class="kt-btn kt-btn-sm"><i class="ki-filled ki-cloud-download"></i> Download </button></a>
                            <button class="kt-btn kt-btn-sm kt-btn-mono" data-kt-modal-dismiss="#modalPicture"> Close </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#exilednoname-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let fileInput = $(this).find('input[type="file"]')[0];
        let hasFile = fileInput && fileInput.files.length > 0;

        let progressBar = $('#uploadProgress');
        let bar = progressBar.find('.progress-bar');

        $('#errors').html('');
        $('#success').html('');

        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();

                // ✅ progress hanya ditrigger kalau ada file
                if (hasFile) {
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            progressBar.show();
                            bar.css('width', percentComplete + '%').text(percentComplete + '%');
                        }
                    }, false);
                }

                return xhr;
            },

            url: "{{ URL::Current() }}/../",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,

            beforeSend: function() {
                if (hasFile) {
                    progressBar.show();
                    bar.css('width', '0%').text('0%');
                } else {
                    progressBar.hide(); // ⛔ kalau tidak ada file, pastikan progress disembunyikan
                }
            },

            success: function(res) {
                $('.kt-form-message').remove();
                $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');

                if (res.status === 'success') {
                    window.location.href = res.redirect_url;
                } else if (res.status === 'error') {
                    window.location.href = res.redirect_url;
                } else {
                    alert(res.message);
                }
            },

            error: function(xhr) {
                if (xhr.status === 422) {
                    // hapus pesan error lama
                    $('.kt-form-message').remove();
                    $('[aria-invalid="true"]').attr('aria-invalid', 'false').removeClass('border-red-500');

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let input = $('[name="' + key + '"]');

                        // kasih tanda invalid
                        input.attr('aria-invalid', 'true');
                        input.addClass('border-red-500');

                        // tambahin pesan error custom
                        input.closest('.kt-form-control')
                            .next('.kt-form-message')
                            .text(value[0]);
                        input.after('<div class="kt-form-message">' + value[0] + '</div>');
                    });
                }
            }
        });
    });
</script>
@endpush