<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="userForm">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="builemailding_no" class="block mt-1 w-full" type="text" name="email"
                                :value="old('email')" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="building_no" :value="__('Building No')" />
                            <x-text-input id="building_no" class="block mt-1 w-full" type="text" name="building_no"
                                :value="old('building_no')" required autofocus autocomplete="building_no" />
                            <x-input-error :messages="$errors->get('building_no')" class="mt-2" />
                        </div>


                        <div>
                            <x-input-label for="street_name" :value="__('Street')" />
                            <x-text-input id="street_name" class="block mt-1 w-full" type="text" name="street_name"
                                :value="old('street_name')" required autofocus autocomplete="street_name" />
                            <x-input-error :messages="$errors->get('street_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city')" required autofocus autocomplete="city" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="state" :value="__('State')" />
                            <x-text-input id="state" class="block mt-1 w-full" type="text" name="state"
                                :value="old('state')" required autofocus autocomplete="state" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="pincode" :value="__('Pincode')" />
                            <x-text-input id="pincode" class="block mt-1 w-full" type="text" name="pincode"
                                :value="old('pincode')" required autofocus autocomplete="pincode" />
                            <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                                :value="old('country')" required autofocus autocomplete="country" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <x-primary-button class="ms-3 mt-3">
                            {{ __('Save User') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {

            $("#userForm").on('submit', function (e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    type: 'POST',
                    url: '/user_detail',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User created successfully!',
                        });
                        form.reset();
                    },
                    error: function (error) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error creating user!',
                        });
                        console.log('Error fetching user details:', error);
                    }
                });

                return false;
            })
        });

    </script>
</x-app-layout>
