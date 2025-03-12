<!-- Carousel Container -->
<div class="flex items-center justify-center">
    <div class="relative overflow-hidden h-auto w-3/5 rounded-lg shadow-lg">
        <div class="carousel flex transition-transform duration-500 ease-in-out w-full mx-auto" id="carousel">
            @foreach ($carousels as $carousel)
                <div class="w-full flex-shrink-0 relative">
                    <img src="{{ asset('images/uploads/' . $carousel->image_path) }}" alt="{{ $carousel->title }}"
                        class="w-full h-auto object-cover">
                    <div class="absolute bottom-0 w-full bg-black bg-opacity-50 text-white p-2">
                        <h2 class="text-xl font-bold">{{ $carousel->title }}</h2>
                        <p class="text-sm">{{ Str::limit($carousel->description, 25) }}</p>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- Previous Button -->
        <button onclick="prevSlide()"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-gray-900 transition">
            &#10094;
        </button>

        <!-- Next Button -->
        <button onclick="nextSlide()"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-gray-900 transition">
            &#10095;
        </button>

        <!-- Slide Indicators -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            @foreach ($carousels as $index => $carousel)
                <button class="w-3 h-3 rounded-full bg-gray-400" onclick="showSlide({{ $index }})"
                    id="indicator-{{ $index }}"></button>
            @endforeach
        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel > div');
    const totalSlides = slides.length;

    function updateIndicators() {
        document.querySelectorAll('[id^="indicator-"]').forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('bg-blue-500');
                indicator.classList.remove('bg-gray-400');
            } else {
                indicator.classList.remove('bg-blue-500');
                indicator.classList.add('bg-gray-400');
            }
        });
    }

    function showSlide(index) {
        currentSlide = index;
        const offset = -index * 100;
        document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
        updateIndicators();
    }

    function prevSlide() {
        currentSlide = (currentSlide > 0) ? currentSlide - 1 : totalSlides - 1;
        showSlide(currentSlide);
    }

    function nextSlide() {
        currentSlide = (currentSlide < totalSlides - 1) ? currentSlide + 1 : 0;
        showSlide(currentSlide);
    }

    function autoSlide() {
        nextSlide();
    }

    setInterval(autoSlide, 5000);
    document.addEventListener('DOMContentLoaded', updateIndicators);
</script>
