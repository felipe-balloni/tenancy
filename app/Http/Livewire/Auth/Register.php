<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Filament\Forms;
use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;
use League\Flysystem\MountManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Filament\Forms\Components\TextInput;

class Register extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $name;
    public $email;
    public $password;
    public $password_confirm;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->maxLength(255)
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('E-mail')
                ->email()
                ->maxLength(255)
                ->unique(User::class)
                ->required(),
            Forms\Components\TextInput::make('password')
                ->label('Senha')
                ->required()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => !is_null($state))
                ->maxLength(255)
                ->password(),
            Forms\Components\TextInput::make('password_confirm')
                ->label('Confirme a senha')
                ->required()
                ->dehydrated(false)
                ->maxLength(255)
                ->password()
                ->same('password'),
        ];
    }

    public function submit(): Redirector|RedirectResponse
    {
        $tenant = Tenant::create([
            'name' => Str::uuid(),
        ]);

        $user = User::create($this->form->getState(), [
            'tenant_id' => $tenant->id,
            'role' => 'admin',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function getFormModel(): string
    {
        return User::class;
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
