<?php

use App\Models\Department;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

uses(RefreshDatabase::class);

it('has tenantscope page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('a model has a tenant id on the migration', closure: function () {
    $now = now();
    $filename = $now->format('Y_m_d_His').'_create_tests_table.php';
    $filePath = database_path('migrations/'.$filename);

    $this->artisan('make:model Test -m --force');

    $this->assertTrue(File::exists($filePath));
    $this->assertStringContainsString('$table->foreignIdFor(\App\Models\Tenant::class)->index()->nullable()->constrained();', File::get($filePath));

    File::delete($filePath);
    File::delete(app_path('Models/Test.php'));
});

it('user can onlu see users in the same tenant', closure: function () {
   $tenant1 = Tenant::factory()->create();
   $tenant2 = Tenant::factory()->create();

   $user = User::factory()->create([
       'tenant_id' => $tenant1
   ]);

    User::factory(9)->create([
        'tenant_id' => $tenant1
    ]);

    User::factory(10)->create([
        'tenant_id' => $tenant2
    ]);

    auth()->login($user);

    $this->assertEquals(10, User::count());
});

it('user can only create records in his tenant', function () {
    $user = User::factory()->create([
        'tenant_id' => $tenant = Tenant::factory()->create()
    ]);

    auth()->login($user);

    $createDepartment = Department::factory(5)->create();

    $this->assertEquals(5, Department::count());
    $this->assertTrue($createDepartment->first()->tenant_id === $user->tenant_id);
});

it('user can only create records in his tenant even if other tenant is provide', function () {
    $user = User::factory()->create([
        'tenant_id' => Tenant::factory()->create()
    ]);

    auth()->login($user);

    $createDepartment = Department::factory()->create([
        'tenant_id' => $tenant = Tenant::factory()->create()
    ]);

    $this->assertFalse($createDepartment->tenant_id === $tenant->id);
});
