<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div style="display:flex; justify-content:space-between; width:200%">
            <span style="margin-right: 5%; width:45%">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </span>
        
            <span style=" width:45%">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </span>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4" style="display:flex; justify-content:space-between; width:200%">
            <span style="margin-right: 5%; width:45%">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="number" min="100000000" max="9999999999" name="phone" :value="old('phone', $user->phone)" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </span>

            <span style=" width:45%">
                <x-input-label for="role" :value="__('Role')" />
                <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->role)" required autofocus autocomplete="role" />
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </span>
        </div>

        <div style="width:90%">
            <x-input-label for="linkedin" :value="__('LinkedIn')" />
            <x-text-input id="linkedin" name="linkedin" type="text" class="mt-1 block w-full" :value="old('linkedin', $user->linkedin)" autofocus autocomplete="linkedin" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <div style="display:flex; justify-content:space-between; width:200%">
            <span style="margin-right: 5%; width:45%">
                <x-input-label for="techskills" :value="__('Tech skills')" />
                <x-text-input id="techskills" name="techskills" type="text" class="mt-1 block w-full skills" :value="old('techskills', $user->techskills)" autofocus autocomplete="techskills" />
                <x-input-error class="mt-2" :messages="$errors->get('techskills')" />
            </span>
        
            <span style="width:45%">
                <x-input-label for="softskills" :value="__('Soft skills')" />
                <x-text-input id="softskills" name="softskills" type="text" class="mt-1 block w-full skills" :value="old('softskills', $user->softskills)" autofocus autocomplete="softskills" />
                <x-input-error class="mt-2" :messages="$errors->get('softskills')" />
            </span>
        </div>

        <div>
            <x-input-label for="about" :value="__('Describe yourself and your motivations')" />
            <!-- <x-text-input id="about" name="about" type="text" class="mt-1 block w-full" :value="old('about', $user->about)" required autofocus autocomplete="about" /> -->
            <textarea class="mt-2" style="width: 100%;" rows="4" name="about" id="about" :value="old('about', $user->about)"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about')" />            
        </div>

        <div>
            <x-input-label for="photo" :value="__('Upload Photo if you want to change your current profile photo')" />
            <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" :value="old('photo', $user->photo)" autofocus  />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
