{{--
    Centered empty-state card.
--}}
{{-- @var string $icon Required. Icon classes, e.g. "bi bi-inbox". --}}
{{-- @var string $title Required. h2 text. --}}
{{-- @var string $iconClass Icon colour class. Default 'text-body-secondary'. --}}
{{-- @var bool $wrapped Wrap in a centered grid column. Default true. --}}
{{-- @var string $slot Optional. Explanatory text. --}}
{{-- @var string $actions Optional named slot. Call-to-action link(s). --}}
@props([
    'icon',
    'title',
    'iconClass' => 'text-body-secondary',
    'wrapped' => true,
])

@if ($wrapped)
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
@endif
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="{{ $icon }} display-5 {{ $iconClass }} d-block mb-3" aria-hidden="true"></i>
                    <h2 class="h5">{{ $title }}</h2>
                    <p class="text-body-secondary mb-{{ isset($actions) ? '3' : '0' }}">{{ $slot }}</p>
                    @isset($actions)
                        {{ $actions }}
                    @endisset
                </div>
            </div>
@if ($wrapped)
        </div>
    </div>
@endif
