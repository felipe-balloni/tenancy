<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredTenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RegisteredTenantController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisteredTenantRequest $request)
    {
       $tenant = Tenant::create(
           $request->safe()->all()
       );
       $tenant->domains()->create(['domain' => $request->domain]);

       return redirect(tenant_route($tenant->domains->first->domain));
    }
}
