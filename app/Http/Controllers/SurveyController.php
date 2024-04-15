<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $surveys = Survey::latest()->paginate(20);

        return view('surveys.index')->with('surveys', $surveys);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('surveys.create')->with('Survey', Survey::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|max:150',
            'date_of_birth' => 'required|date|after:1904-01-01|before:today',
            'headache_frequency' => [
                'required',
                Rule::in(Survey::HEADACHE_FREQUENCY)
            ],
            // daily_frequency is required only if headache_frequency == 'Daily'
            'daily_frequency' => [
                'present_if:headache_frequency,' . Survey::DAILY_LABEL,
                Rule::in(Survey::DAILY_FREQUENCY)
            ],
        ]);

        $dob_dateStamp = strtotime($request->date_of_birth);
        $today = strtotime('today');

        // Is the subject's date of birth at least 18 years before today?  If so, they are eligible
        $eligible = $today - strtotime('+18 years', $dob_dateStamp) > 0;
        $cohort = null;
        if ($eligible) {
            // Monthly and Weekly headaches are assigned to cohort A, Daily are assigned to cohort B
            $cohort = $request->headache_frequency == Survey::DAILY_LABEL ? "B" : "A";
        }

        // uuid is set for automatic generation in Surveys class
        $survey = Survey::create(
            array_merge(
                $validated,
                [
                    'eligible' => $eligible,
                    'cohort' => $cohort,
                ]
            )
        );

        return to_route('surveys.show', $survey);
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey): View
    {
        return view('surveys.show')->with('survey', $survey);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        // unused
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        // unused
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        // unused
    }
}
