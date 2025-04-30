@props(['url' => '/', 'active' => false, 'icon' => null])
{{-- Default is false --}}

<a href="{{ $url }}" class="text-white hover:underline py-2 {{ $active ? 'text-yellow-500' : '' }}">
    @if ($icon)
        <i class="fa fa-{{ $icon }} mr-1 "></i>
    @endif
    {{ $slot }}
</a>
