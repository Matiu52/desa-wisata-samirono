<footer
    class="bg-gray-800 text-white px-4 py-2 fixed bottom-4 right-4 max-w-[260px] w-full rounded-xl shadow-md text-xs">
    <div class="flex flex-col items-center gap-1 text-center">
        <!-- Copyright -->
        <p class="font-sans">
            © {{ date('Y') }}, oleh
            <a href="#" target="_blank" class="hover:text-blue-400 transition-colors">
                Matius Andreatna
            </a>
        </p>

        <!-- Link ke Homepage -->
        <a href="{{ route('homepage') }}" target="_blank" class="font-sans hover:text-blue-400 transition-colors">
            Kunjungi Website
        </a>
    </div>
</footer>
