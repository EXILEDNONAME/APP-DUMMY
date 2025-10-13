<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <a href="/dashboard/administratives/managements/roles/create" target="_blank"><span class="kt-form-label w-40 pt-2"> Role </span></a>
        <div class="kt-form-control flex-1">
            {{ Html::select('role_id', ManagementRoles(), (isset($data->role_id) ? $data->role_id : NULL))->placeholder('- Select Role -')->class('kt-input w-full')->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex items-start gap-4">
        <a href="/dashboard/administratives/managements/users/create" target="_blank"><span class="kt-form-label w-40 pt-2"> User </span></a>
        <div class="kt-form-control flex-1">
            {{ Html::select('model_id', ManagementUsers(), (isset($data->model_id) ? $data->model_id : NULL))->placeholder('- Select User -')->class('kt-input w-full')->required() }}
        </div>
    </div>
</div>