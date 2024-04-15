<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-xl font-bold mb-2 dark:text-white">Thank you for completing the eligibility survey</h1>
        <section class="mb-4" aria-labelledby="results-header">
            <h2 class="dark:text-gray-200" id="results-header">Results</h2>
            <div
                class="bg-white dark:bg-gray-800 dark:text-white border-gray-700 border-2 p-3 mb-2 rounded-md shadow-md">
                @if (!$survey->eligible)
                    <div>
                        <p>{{ __('Status') }}: {{ __('Ineligible') }}</p>
                        <p>Participants must be over 18 years of age.</p>
                    </div>
                @elseif($survey->cohort == 'A')
                    <div>
                        <p>{{ __('Status') }}: {{ __('Eligible') }}</p>
                        <p>Participant "{{ $survey->first_name }}" is assigned to Cohort A.</p>
                    </div>
                @else
                    <div>
                        <p>{{ __('Status') }}: {{ __('Eligible') }}</p>
                        <p>Candidate "{{ $survey->first_name }}" is assigned to Cohort B.</p>
                    </div>
                @endif
            </div>
        </section>
        <section aria-labelledby="survey-summary-header">
            <h2 class="dark:text-gray-200" id="survey-summary-header">Survey Summary</h2>
            <x-survey-summary :survey="$survey"></x-survey-summary>
        </section>
    </div>
</x-app-layout>
