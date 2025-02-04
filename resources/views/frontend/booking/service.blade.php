@extends('frontend.booking.__layout')


@section('main-content')

    <main>
        <div class="container">

            <div class="slider_wp">

                <div class="slider">

                    <livewire:frontend.service-form
                        :citySlug="$branch->city->slug"
                        :companySlug="$branch->company->slug"
                        :branchId="$branch->id"
                    />

                </div>
            </div>
        </div>
    </main>

@endsection


@pushonce('scripts')

<script>
    function initializeLazyLoading() {
        const lazyImages = document.querySelectorAll('img.lazy');

        if ("IntersectionObserver" in window) {
            const lazyLoad = function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                });
            };

            const imageObserver = new IntersectionObserver(lazyLoad, {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            });

            lazyImages.forEach(img => {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    }

    document.addEventListener('livewire:init', function() {
        initializeLazyLoading();
    });

    document.addEventListener('livewire:update', function() {
        initializeLazyLoading();
    });
</script>
@endpushonce

@pushonce('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
@endpushonce
