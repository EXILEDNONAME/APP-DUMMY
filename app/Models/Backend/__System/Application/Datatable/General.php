<?php

namespace App\Models\Backend\__System\Application\Datatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class General extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $table = 'system_application_table_generals';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];
    protected static $recordEvents = ['created', 'deleted', 'updated'];
    protected $casts = ['date' => 'datetime'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    public function getDateAttribute($value)
    {
        return $value; // Return raw value, formatting di controller
    }
}
