@if (session('success'))
    <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div id="error-message" class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const successMessageDiv = document.getElementById('success-message');
            const errorMessageDiv = document.getElementById('error-message');
            if (successMessageDiv) {
                successMessageDiv.style.transition = "opacity 1s ease-out";
                successMessageDiv.style.opacity = "0";
                setTimeout(function() {
                    successMessageDiv.style.display = 'none';
                }, 1000);
            }
            if (errorMessageDiv) {
                errorMessageDiv.style.transition = "opacity 1s ease-out";
                errorMessageDiv.style.opacity = "0";
                setTimeout(function() {
                    errorMessageDiv.style.display = 'none';
                }, 1000);
            }
        }, 5000);
    });
</script>
