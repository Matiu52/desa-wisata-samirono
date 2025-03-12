<footer class="bg-gray-800 text-white px-6 py-4 fixed bottom-4 right-4 rounded-2xl shadow-lg">
    <div class="flex flex-wrap items-center justify-center md:justify-between gap-4">
        <!-- Copyright -->
        <p class="text-sm font-sans antialiased">
            © {{ date('Y') }}, dibuat oleh
            <a href="#" target="_blank" class="hover:text-blue-500 transition-colors">
                Matius Andreatna
            </a>
        </p>

        <!-- Link ke Homepage -->
        <a href="{{ route('homepage') }}" target="_blank"
            class="text-sm font-sans py-1 px-2 hover:text-blue-500 transition-colors">
            Kunjungi Website
        </a>
    </div>
</footer>
