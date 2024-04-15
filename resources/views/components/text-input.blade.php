@props(['disabled' => false, 'field' => ''])
@error($field)
    @php
        // When the field has a validation error, turn the border red.
        $attributes = $attributes->merge(['class' => 'border-red-600']);
    @endphp
@enderror
<span class="mb-4 inline-block">
    <input id="{{ $field }}" name="{{ $field }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'px-2 border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
    ]) !!}>

    @error($field)
        <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
</span>
