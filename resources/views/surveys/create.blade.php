<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-xl font-bold mb-2 dark:text-white" id="form-label">Eligibility Survey</h1>
        <div class="bg-white dark:bg-gray-800 border-gray-500 border-2 p-3 mb-2 rounded-md shadow-md">
            <form aria-labelledby="form-label" method="POST" action="{{ route('surveys.store') }}">
                @csrf
                <x-input-label for="first_name">First Name</x-input-label>
                <x-text-input class="w-96" type="text" field="first_name" placeholder="first name" autocomplete="off"
                    :value="@old('first_name')"></x-text-input>

                <x-input-label for="date_of_birth">Date of Birth</x-input-label>
                <x-text-input type="date" field="date_of_birth" autocomplete="off" :value="@old('date_of_birth')"></x-text-input>

                <div class="mb-4">
                    <x-input-label for="headache_frequency">How frequently do you experperience
                        headaches?</x-input-label>
                    <select
                        class="dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 px-2 border-2 border-gray-300 rounded-md shadow-sm @error('headache_frequency') border-red-600 text-sm @enderror"
                        id="headache_frequency" name="headache_frequency" aria-label="Select headache frequency"
                        required field="headache_frequency" onchange="manageDailyFrequency(this.value)">
                        @foreach ($Survey::HEADACHE_FREQUENCY as $value)
                            <option value="{{ $value }}" @selected(old('headache_frequency') == $value)>{{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('headache_frequency')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-input-label for="daily_frequency">How many headaches do you experience each day?</x-input-label>
                    <select
                        class="dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 px-2 border-2 border-gray-300 rounded-md shadow-sm  @error('daily_frequency') border-red-600 text-sm @enderror"
                        id="daily_frequency" name="daily_frequency" aria-label="Select daily headache frequency"
                        field="daily_frequency">
                        @foreach ($Survey::DAILY_FREQUENCY as $value)
                            <option value="{{ $value }}" @selected(old('daily_frequency') == $value)>{{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('daily_frequency')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                </div>

                <x-input-error class="mt-2" :messages="$errors->store->get('message')" />
                <div class="mt-4 space-x-2">

                    <x-primary-button class="mt-4" type="submit">{{ __('Submit') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function manageDailyFrequency(value) {
        const dailyInput = document.getElementById('daily_frequency');
        let disabled = true;
        let visibilityClass = 'hidden';

        if (value === '{{ $Survey::DAILY_LABEL }}') {
            disabled = false;
            visibilityClass = '';
        }

        dailyInput.disabled = disabled;
        dailyInput.parentElement.className = visibilityClass;
    }

    // Call once to initialize the form after load
    manageDailyFrequency('{{ old('headache_frequency') }}');
</script>
