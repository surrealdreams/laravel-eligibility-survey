<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-xl font-bold mb-2 dark:text-white" id="section-title">Past survey submissions</h1>
        <section aria-labelledby="section-title">
            @forelse ($surveys as $survey)
                <x-survey-summary :survey="$survey"></x-survey-summary>
            @empty
                <div class="bg-white border-gray-700 border-2 p-3 mb-2 rounded-md shadow-md">
                    <span>There are currently no eligibility survey results to display.</span>
                </div>
            @endforelse
            {{ $surveys->links() }}
            <section>
    </div>
</x-app-layout>
