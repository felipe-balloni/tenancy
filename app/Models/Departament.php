<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $getState)
 */
class Departament extends Model
{
    use HasFactory;

    protected $fillable =  [
        'name',
        'tenant_id'
    ];

    protected static function boot()
    {
        self::addGlobalScope(new TenantScope);

        self::creating(function ($model) {
            if (session()->has('tenant_id')) {
                $model->tenant_id = session()->get('tenant_id');
            }
        });
    }

}
