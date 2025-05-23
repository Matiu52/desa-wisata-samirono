<x-user-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('homepage') }}" class="inline-flex items-center mb-6 text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Home
            </a>

            <!-- Gallery Title and Description -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ $carousel->title }}</h1>
                <p class="mt-2 text-lg text-gray-600">{{ $carousel->description }}</p>
            </div>

            <!-- Images Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($carousel->images as $index => $image)
                    <div class="cursor-pointer transform hover:scale-105 transition-transform duration-200 rounded-lg overflow-hidden"
                        onclick="openLightbox({{ $index }})">
                        <img src="{{ $image->image_path }}" alt="{{ $carousel->title }}"
                            class="w-full h-48 object-cover" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl z-50">&times;</button>
        <button onclick="prevImage()"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-3xl z-50">&#10094;</button>
        <button onclick="nextImage()"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-3xl z-50">&#10095;</button>

        <div class="w-full h-full flex items-center justify-center">
            <div class="max-w-4xl w-full">
                <img id="lightbox-image" class="w-full h-auto max-h-[80vh] object-contain" src="">
                <div class="text-center mt-4 text-white opacity-70 text-sm">
                    <span id="lightbox-counter"></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const carouselImages = {!! json_encode($carousel->images) !!};
        let currentImageIndex = 0;
        let touchStartX = 0;
        let touchEndX = 0;

        function openLightbox(index) {
            currentImageIndex = index;
            updateLightbox();
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + carouselImages.length) % carouselImages.length;
            updateLightbox();
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % carouselImages.length;
            updateLightbox();
        }

        function updateLightbox() {
            const image = carouselImages[currentImageIndex];
            const lightboxImg = document.getElementById('lightbox-image');
            const lightboxCounter = document.getElementById('lightbox-counter');

            lightboxImg.src = 'https://res.cloudinary.com/'.config('cloudinary.cloud_name').
            '/image/upload/' + image.image_path;
            lightboxImg.alt = '{{ $carousel->title }}';
            lightboxCounter.textContent = `${currentImageIndex + 1} / ${carouselImages.length}`;
        }

        // Touch events for swipe navigation
        document.getElementById('lightbox-image').addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.getElementById('lightbox-image').addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const threshold = 50; // Minimum swipe distance
            if (touchStartX - touchEndX > threshold) {
                nextImage(); // Swipe left
            } else if (touchEndX - touchStartX > threshold) {
                prevImage(); // Swipe right
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;

            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                prevImage();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            }
        });
    </script>

    <style>
        /* Smooth transitions for lightbox */
        #lightbox {
            transition: opacity 0.3s ease;
        }

        #lightbox-image {
            transition: transform 0.3s ease;
        }
    </style>
</x-user-layout>
