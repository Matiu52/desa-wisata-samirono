@if (session('success'))
    <div class="flex items-center justify-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
        role="alert" id="successMessage">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const messageDiv = document.getElementById('successMessage');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 10000);
    });
</script>
