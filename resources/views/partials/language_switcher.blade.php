<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            <span class="ml-4 mr-4 text-info font-weight-bold">{{ $locale_name }}</span>
        @else
            <a class="ml-1 text-decoration-none link-secondary ml-4 mr-4" href="language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif

           
    @endforeach
    
</div>