@extends('layouts.backend.default')
@section('title', 'Account Informations')

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div class="kt-card kt-card-grid h-full min-w-full">
            <div class="kt-card-header">
                <h3 class="kt-card-title text-sm grid gap-5"> {{ __('default.label.account_informations') }} </h3>
                <div class="kt-menu" data-kt-menu="true">
                    <div id="tooltip_back" class="kt-tooltip">
                        Back
                    </div>
                </div>
            </div>
            <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/update/{{ $data->id }}" accept-charset="UTF-8" class="kt-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="kt-card-content p-7.5 grid gap-5">

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Avatar </span>
                            <div class="kt-form-control flex-1">
                                <input type="file" name="avatar" id="avatar-upload" accept="image/*" class="hidden" />
                                <div class="relative inline-block cursor-pointer" onclick="document.getElementById('avatar-upload').click()">
                                    <img id="avatar-preview" src="{{ Auth::user()->avatar ? asset('storage/avatar/' . Auth::id() . '/' . Auth::user()->avatar) : asset('assets/backend/media/avatars/blank.png') }}" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200" />
                                    <div class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-500"> Click to upload avatar </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Name </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class([ $errors->has('name ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Email </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::email('email', (isset($data->email) ? $data->email : ''))->class([ $errors->has('email') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Phone </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('phone', (isset($data->phone) ? $data->phone : ''))->class([ $errors->has('phone ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>

                    <div class="kt-form-item">
                        <div class="flex items-start gap-4">
                            <span class="kt-form-label w-40 pt-2"> Username </span>
                            <div class="kt-form-control flex-1">
                                {{ Html::text('username', (isset($data->username) ? $data->username : ''))->class([ $errors->has('username ') ? 'kt-input w-full is-invalid' : 'kt-input w-full'])->isReadOnly() }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-card-footer flex justify-end space-x-2">
                <button type="submit" form="exilednoname-form" class="kt-btn kt-btn-primary"> {{ __('default.label.save_changes') }} </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('avatar-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
            console.log('File selected:', file.name);
        }
    });
</script>
@endpush