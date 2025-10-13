<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Name </span>
        <div class="kt-form-control flex-1">
            {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Email </span>
        <div class="kt-form-control flex-1">
            {{ Html::email('email', (isset($data->email) ? $data->email : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Phone </span>
        <div class="kt-form-control flex-1">
            {{ Html::number('phone', (isset($data->phone) ? $data->phone : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Username </span>
        <div class="kt-form-control flex-1">
            {{ Html::text('username', (isset($data->username) ? $data->username : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

@if($formMode == 'create')
<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Password </span>
        <div class="kt-form-control flex-1">
            {{ Html::password('password')->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <span class="kt-form-label w-40 pt-2"> Confirm Password </span>
        <div class="kt-form-control flex-1">
            {{ Html::password('password_confirmation')->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>
@endif