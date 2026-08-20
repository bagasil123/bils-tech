@props([
    'name',
    'label'   => null,
    'type'    => 'text',
    'value'   => null,
    'errors'  => null,
    'required' => false,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-sienna">*</span> @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            class="form-textarea {{ $errors && $errors->has($name) ? 'border-red-400 focus:ring-red-400 focus:border-red-400' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $type !== 'file' ? old($name, $value) : '' }}"
            class="form-input {{ $errors && $errors->has($name) ? 'border-red-400 focus:ring-red-400 focus:border-red-400' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        />
    @endif

    @if($errors && $errors->has($name))
        <p class="form-error">{{ $errors->first($name) }}</p>
    @endif
</div>
