<x-user-layout>
    <section class="relative bg-cover bg-center bg-no-repeat p-8 h-[40rem]"
        @if ($backgroundImage && $backgroundImage->image_path) style="background-image: url('{{ $backgroundImage->image_path }}');" @endif>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Konten Utama -->
        <div class="relative z-10 container mx-auto px-6 lg:flex lg:items-center lg:space-x-10 h-full">
            <!-- Gambar -->
            <div class="lg:w-1/2 mt-0 lg:mt-0 flex items-center justify-center">
                <img src="{{ asset('images/desa-wisata-samirono.png') }}" alt="Desa Wisata Samirono"
                    class="w-full max-w-24 mx-auto lg:max-w-lg lg:mx-2">
            </div>

            <!-- Teks -->
            <div class="text-white text-center lg:text-left lg:w-1/2">
                <h1 class="text-4xl font-bold mb-6 lg:text-5xl drop-shadow-md">
                    Selamat Datang di <br><span class="text-blue-300">Desa Wisata Samirono</span>
                </h1>
                <p class="text-lg text-white/90 mb-6 drop-shadow">
                    Desa Wisata Samirono adalah desa sentra peternakan sapi perah rakyat di Kecamatan Getasan, Kabupaten
                    Semarang. Menawarkan keindahan alam, budaya lokal, dan inovasi energi terbarukan.
                </p>
                <div class="flex flex-col mb-5 lg:flex-row lg:space-x-4 justify-center lg:justify-start">
                    <a href="{{ route('frontend.posts') }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium shadow-md hover:bg-blue-700 transition">
                        Jelajahi Sekarang
                    </a>
                    <a href="{{ route('frontend.tour-packages') }}"
                        class="mt-3 lg:mt-0 px-6 py-3 border border-white text-white rounded-lg font-medium hover:bg-white hover:text-blue-700 transition">
                        Pesan Paket Sekarang!
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="my-10 bg-gradient-to-b from-white via-blue-50 to-white py-12">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">
                🎥 Tonton Video tentang Desa Wisata Samirono
            </h2>

            <p class="text-center text-gray-600 mb-10 text-lg">
                Saksikan keindahan alam, budaya lokal, dan keramahan warga di Desa Wisata Samirono melalui video ini.
            </p>

            <div class="relative w-full overflow-hidden rounded-2xl shadow-2xl ring-1 ring-gray-300 hover:ring-blue-400 transition duration-300 ease-in-out"
                style="padding-top: 56.25%;">
                <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/4yuuiNyjra4"
                    title="Video Desa Wisata Samirono" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>


    <section class="bg-white my-2 space-y-8">
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

    <!-- Kunjungan Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-blue-700 mb-6">Kunjungan ke Desa Wisata Samirono</h2>
                <x-carousels :carousels="$carousels" />
            </div>
        </div>
    </section>
</x-user-layout>
