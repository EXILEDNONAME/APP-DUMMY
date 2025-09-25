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
        <span class="kt-form-label w-40 pt-2"> Description </span>
        <div class="kt-form-control flex-1">
            {{ Html::textarea('description', (isset($data->description) ? $data->description : ''))->class(['kt-textarea', ])->id('ex-textarea') }}
        </div>
    </div>
</div>