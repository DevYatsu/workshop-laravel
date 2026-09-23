{{--
    Button-styled link with a leading Bootstrap icon.
--}}
{{-- @var string $href Required. Link target. --}}
{{-- @var string $icon Required. Icon classes without the trailing me-1. --}}
{{-- @var string $variant Button classes. Default 'btn btn-primary'. --}}
{{-- @var string $slot Optional. Label (HTML allowed). --}}
@props(['href', 'icon', 'variant' => 'btn btn-primary'])

<a href="{{ $href }}" class="{{ $variant }}">
    <i class="{{ $icon }} me-1" aria-hidden="true"></i>
    {{ $slot }}
</a>
