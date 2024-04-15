<div class="bg-white dark:bg-gray-800 dark:text-white border-gray-700 border-2 p-3 mb-2 rounded-md shadow-md">
    <div class="flex">
        <div class="w-1/2">
            <span class="text-gray-500">{{ __('Name') }}:</span>
            <span>{{ $survey->first_name }}</span>
        </div>
        <div class="w-1/2">
            <span class="text-gray-500">{{ __('Date of Birth') }}:</span>
            <span>{{ $survey->date_of_birth }}</span>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/2">
            <span class="text-gray-500">{{ __('Headache Frequency') }}:</span>
            <span>{{ $survey->headache_frequency }}</span>
        </div>
        @if ($survey->headache_frequency == $survey::DAILY_LABEL && $survey->daily_frequency != null)
            <div class="w-1/2">
                <span class="text-gray-500">{{ __('Daily Frequency') }}:</span>
                <span>{{ $survey->daily_frequency }}</span>
            </div>
        @endif
    </div>
    <div class="flex">
        <div class="w-1/2">
            <span class="text-gray-500">{{ __('Eligible') }}:</span>
            <span>{{ $survey->eligible ? __('Yes') : __('No') }}</span>
        </div>
        @if ($survey->eligible && $survey->cohort)
            <div class="w-1/2">
                <span class="text-gray-500">{{ __('Cohort') }}:</span>
                <span>{{ $survey->cohort }}</span>
            </div>
        @endif
    </div>
    @if (request()->routeIs('surveys.index'))
        <a class="btn-link" href="{{ route('surveys.show', $survey) }}">Review completed survey</a>
    @endif
</div>
