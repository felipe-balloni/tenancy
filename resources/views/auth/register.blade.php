<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
        @csrf


        <!-- Company -->
            <div>

                <x-label for="company" :value="__('Company')"/>

                <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')"
                         required autofocus/>
            </div>

            <!-- Domain -->
            <div class="mt-4">

                <x-label for="domain" :value="__('Domain')"/>

                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                    <x-input id="domain"
                             class="flex-shrink flex-grow flex-auto w-px flex-1 border h-10 rounded-r-none px-3 relative"
                             type="text"
                             name="domain"
                             :value="old('domain')"
                             required/>
                    <div class="flex -mr-px">
                        <span
                            class="flex items-center leading-normal bg-gray-300 rounded-md rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-gray-700 text-sm">
                            {{ '.' . config('tenancy.central_domains')[0] }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div class="mt-4">

                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
