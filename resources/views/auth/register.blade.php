<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User Type Radio Buttons -->
        <div class="mt-4">
            <x-input-label for="usertype" :value="__('User Type')" />

            <div>
                <label for="client">
                    <input type="radio" id="client" name="usertype" value="client" checked>
                    Client
                </label>
                <label for="rescuer" class="ml-4">
                    <input type="radio" id="rescuer" name="usertype" value="rescuer">
                    Rescuer
                </label>
            </div>

            <!-- Display error for usertype -->
            @error('usertype')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />

            <!-- Display error for name -->
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contact Number -->
        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" class="block w-full mt-1" type="text" name="contact_number" :value="old('contact_number')" required autocomplete="tel" />

            <!-- Display error for contact_number -->
            @error('contact_number')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />

            <!-- Display error for email -->
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Client Address Field -->
        <div class="mt-4" id="client-address">
            <x-input-label for="client_address" :value="__('Client Address')" />
            <x-text-input id="client_address" class="block w-full mt-1" type="text" name="clients_address" :value="old('client_address')"  />

            <!-- Display error for client_address -->
            @error('client_address')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rescuer Location Field -->
        <div class="mt-4" id="rescuer-location" style="display: none;">
            <x-input-label for="rescuer_location" :value="__('Rescuer Location')" />
            <x-text-input id="rescuer_location" class="block w-full mt-1" type="text" name="rescuer_location" :value="old('rescuer_location')"  />

            <!-- Display error for rescuer_location -->
            @error('rescuer_location')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full mt-1" type="password" name="passwords" required autocomplete="new-password" />

            <!-- Display error for password -->
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

       
        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript to Toggle Address Fields -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const clientRadio = document.getElementById('client');
        const rescuerRadio = document.getElementById('rescuer');
        const clientAddress = document.getElementById('client-address');
        const rescuerAddress = document.getElementById('rescuer-location');
        const clientAddressInput = document.getElementById('client_address');
        const rescuerAddressInput = document.getElementById('rescuer_location');

        function toggleAddressFields() {
            if (clientRadio.checked) {
                clientAddress.style.display = 'block';
                rescuerAddress.style.display = 'none';
                
                clientAddressInput.setAttribute('required', 'required');
                rescuerAddressInput.removeAttribute('required');
            } else if (rescuerRadio.checked) {
                clientAddress.style.display = 'none';
                rescuerAddress.style.display = 'block';

                clientAddressInput.removeAttribute('required');
                rescuerAddressInput.setAttribute('required', 'required');
            }
        }

        // Initialize default view
        toggleAddressFields();

        // Attach event listeners to radio buttons
        clientRadio.addEventListener('change', toggleAddressFields);
        rescuerRadio.addEventListener('change', toggleAddressFields);
    });
</script>

</x-guest-layout>
