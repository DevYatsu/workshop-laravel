{{--
    Page header shared by every content view.
--}}
{{-- @var string $title Required. h1 text. --}}
{{-- @var string $wrapperClass Outer div classes. Default 'mb-4 border-bottom pb-3'. --}}
{{-- @var bool $centered Wrap in a centered grid column. Default false. --}}
{{-- @var string $slot Optional. Subtitle (HTML allowed). --}}
{{-- @var string $actions Optional named slot. Trailing action(s). --}}
@props([
    'title',
    'wrapperClass' => 'mb-4 border-bottom pb-3',
    'centered' => false,
])

@if ($centered)
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
@endif
            <div class="{{ $wrapperClass }}">
                @isset($actions)
                    <div>
                        <h1 class="mb-1">{{ $title }}</h1>
                        <p class="text-body-secondary mb-0">{{ $slot }}</p>
                    </div>
                    {{ $actions }}
                @else
                    <h1 class="mb-1">{{ $title }}</h1>
                    <p class="text-body-secondary mb-0">{{ $slot }}</p>
                @endisset
            </div>
@if ($centered)
        </div>
    </div>
@endif
