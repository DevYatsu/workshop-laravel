{{--
    Stock badge: out (quantity <= 0), low (<= 2), or plain quantity above.
    books/show passes ok-class="badge-stock-ok" for the in-stock case;
    without it the fallback is a plain muted quantity (books/index).
--}}
{{-- /** @var int $quantity Required. Stock level; out when <= 0, low when <= 2. */ --}}
{{-- /** @var string|null $okClass Badge class for the in-stock case (ok-class="..."). Default null = plain muted quantity. */ --}}
@props(['quantity', 'okClass' => null])

@if ($quantity <= 0)
    <span class="badge badge-stock-out">Épuisé</span>
@elseif ($quantity <= 2)
    <span class="badge badge-stock-low">{{ $quantity }} en stock</span>
@elseif ($okClass)
    <span class="badge {{ $okClass }}">{{ $quantity }} en stock</span>
@else
    <span class="text-body-secondary">{{ $quantity }}</span>
@endif
