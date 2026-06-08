@props([
    'linkClass' => 'rounded-lg p-2 text-slate-500 transition hover:bg-sky-100 hover:text-bareeq-blue',
    'iconClass' => 'h-4 w-4',
    'wrapperClass' => 'flex items-center gap-1',
])

@php
    $socialLinks = site_social_links();
@endphp

@if ($socialLinks !== [])
    <div {{ $attributes->merge(['class' => $wrapperClass]) }} aria-label="{{ tr('site.social.aria') }}">
        @foreach ($socialLinks as $social)
            <a
                href="{{ $social['url'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="{{ $linkClass }}"
                aria-label="{{ $social['label'] }}"
            >
                @include('partials.social-icon', ['icon' => $social['icon'], 'class' => $iconClass])
            </a>
        @endforeach
    </div>
@endif
