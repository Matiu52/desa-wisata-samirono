<div class="relative mt-1">
    <label for="search-input" class="sr-only">{{ $label ?? 'Search' }}</label>
    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>
    <input type="text" id="search-input" name="{{ $name ?? 'search' }}"
        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ $placeholder ?? 'Cari' }}" value="{{ $value ?? '' }}">
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        function fetch_data(url, page, keyword = '', target) {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    keyword: keyword,
                    page: page
                },
                success: function(data) {
                    $(target).html(data);
                    if (keyword) {
                        window.history.pushState({}, '', url + "?page=" + page + "&keyword=" +
                            keyword);
                    } else {
                        window.history.pushState({}, '', url + "?page=" + page);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        }
        $("#search-input").on("keyup", function() {
            var keyword = $(this).val().toLowerCase();
            if (keyword) {
                fetch_data("{{ route('posts.index') }}", 1, keyword, '#table-post');
            } else {
                fetch_data("{{ route('posts.index') }}", 1, '', '#table-post');
            }
        });
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var keyword = $('#search-input').val().toLowerCase();
            fetch_data("{{ route('posts.index') }}", page, keyword, '#table-post');
        });
    });
</script>
