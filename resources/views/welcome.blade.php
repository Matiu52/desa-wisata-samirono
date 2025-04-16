<x-user-layout>
    <section class="bg-white p-2">
        <div class="container mx-auto px-6 lg:flex lg:items-center lg:space-x-10">
            <!-- Image Section -->
            <div class="lg:w-1/2 mt-0 lg:mt-0">
                <img src="{{ asset('images/desa-wisata-samirono.png') }}" alt="Desa Wisata Samirono"
                    class="w-full max-w-24 mx-auto lg:max-w-lg lg:mx-2">
            </div>
            <!-- Text Section -->
            <div class="text-center lg:w-1/2  lg:text-left">
                <h1 class="text-4xl font-bold mb-6 lg:text-5xl">
                    Selamat Datang di <br><span class="text-blue-500">Desa Wisata Samirono</span>
                </h1>
                <p class="text-lg text-gray-600 mb-6">
                    Desa Wisata Samirono adalah desa sentra peternakan sapi perah rakyat di Kecamatan Getasan, Kabupaten
                    Semarang. Menawarkan keindahan alam, budaya lokal, dan inovasi energi terbarukan.
                </p>
                <div class="flex flex-col mb-5 lg:flex-row lg:space-x-4 justify-center lg:justify-start">
                    <a href="{{ route('frontend.posts') }}"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-medium shadow-md hover:bg-blue-600">
                        Jelajahi Sekarang
                    </a>
                    <a href="{{ route('frontend.tour-packages') }}"
                        class="mt-3 lg:mt-0 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-100">
                        Pesan Paket Sekarang!
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white space-y-8">
        <!-- Section Atas -->
        @foreach ($homeAtas as $h)
            <div class="section-atas bg-[linear-gradient(to_bottom,white,rgb(239,246,255),white)]">
                <div class="container mx-auto px-6 lg:flex lg:items-center lg:space-x-10">
                    @if (!isset($h->images) || empty($h->images))
                        <div class="w-full text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @else
                        <!-- Title dan Content -->
                        <div class="lg:w-1/2 text-center lg:text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <!-- Carousel -->
                        <div class="carousel-wrapper lg:w-1/2 mt-10 lg:mt-0 overflow-hidden relative">
                            <div class="carousel flex transition-transform ease-in-out">
                                @foreach (explode(',', $h->images) as $image)
                                    <div class="carousel-slide w-full flex-shrink-0">
                                        <img src="{{ asset('images/uploads/' . trim($image)) }}"
                                            alt="{{ $h->title }}"
                                            class="w-full h-64 md:h-96 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Section Tengah -->
        @foreach ($homeTengah as $h)
            <div class="section-atas bg-[linear-gradient(to_bottom,white,rgb(239,246,255),white)]">
                <div class="container mx-auto px-6 lg:flex lg:items-center lg:space-x-10">
                    @if (!isset($h->images) || empty($h->images))
                        <div class="w-full text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @else
                        <!-- Carousel -->
                        <div class="carousel-wrapper lg:w-1/2 mt-10 lg:mt-0 overflow-hidden relative">
                            <div class="carousel flex transition-transform ease-in-out">
                                @foreach (explode(',', $h->images) as $image)
                                    <div class="carousel-slide w-full flex-shrink-0">
                                        <img src="{{ asset('images/uploads/' . trim($image)) }}"
                                            alt="{{ $h->title }}"
                                            class="w-full h-64 md:h-96 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Title dan Content -->
                        <div class="lg:w-1/2 text-center lg:text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Section Bawah -->
        @foreach ($homeBawah as $h)
            <div class="section-atas bg-[linear-gradient(to_bottom,white,rgb(239,246,255),white)]">
                <div class="container mx-auto px-6 lg:flex lg:items-center lg:space-x-10">
                    @if (!isset($h->images) || empty($h->images))
                        <div class="w-full text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @else
                        <!-- Title dan Content -->
                        <div class="lg:w-1/2 text-center lg:text-center">
                            <h1 class="text-4xl font-extrabold text-blue-700 mb-6">{{ $h->title }}</h1>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                @foreach (explode('.', $h->content) as $paragraph)
                                    @if (!empty(trim($paragraph)))
                                        <span>{{ trim($paragraph) }}.</span><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <!-- Carousel -->
                        <div class="carousel-wrapper lg:w-1/2 mt-10 lg:mt-0 overflow-hidden relative">
                            <div class="carousel flex transition-transform ease-in-out">
                                @foreach (explode(',', $h->images) as $image)
                                    <div class="carousel-slide w-full flex-shrink-0">
                                        <img src="{{ asset('images/uploads/' . trim($image)) }}"
                                            alt="{{ $h->title }}"
                                            class="w-full h-64 md:h-96 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </section>

    <!-- Pencapaian Section -->
    <section class="py-16">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-blue-700 mb-6">Pencapaian Pembangunan Berkelanjutan</h2>
                <p class="text-lg text-gray-600 mb-6">
                    <strong>UMKM Desa Wisata Samirono</strong> menawarkan produk seperti Kue Bakpia Berkah, Milky Jong,
                    Teh Jawa Sangrai, dan masih banyak lagi produk yang bisa dibeli melalui
                    <a href="https://umkmsamirono.com" target="_blank"
                        class="text-blue-500 underline hover:text-blue-700">
                        umkmsamirono.com
                    </a>.
                </p>
                <img src="{{ asset('images/umkm-achievements.jpg') }}" alt="UMKM Achievements"
                    class="rounded-lg shadow-lg hover:shadow-xl transition-shadow mx-auto">
            </div>
        </div>
    </section>

    <!-- Kunjungan Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-left">
                <h2 class="text-4xl font-extrabold text-blue-700 mb-6">Kunjungan ke Desa Wisata Samirono</h2>
                <x-carousels :carousels="$carousels" />
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil semua wrapper carousel
            const carouselWrappers = document.querySelectorAll(".carousel-wrapper");

            carouselWrappers.forEach((wrapper) => {
                const carousel = wrapper.querySelector(".carousel");
                const slides = wrapper.querySelectorAll(".carousel-slide");
                const totalSlides = slides.length;
                let currentIndex = 0;

                // Fungsi untuk mengupdate posisi carousel
                function updateCarousel() {
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                }

                // Fungsi untuk berpindah ke slide berikutnya
                function nextSlide() {
                    currentIndex = (currentIndex + 1) % totalSlides; // Looping ke awal
                    updateCarousel();
                }

                // Atur interval untuk masing-masing carousel
                setInterval(nextSlide, 5000);
            });
        });
    </script>
</x-user-layout>
