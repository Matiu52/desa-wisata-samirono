<script>
    const toggleButton = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('main');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        mainContent.classList.toggle('ml-64');

        if (sidebar.classList.contains('-translate-x-full')) {
            toggleButton.classList.remove('left-64');
            toggleButton.classList.add('left-4');
        } else {
            toggleButton.classList.remove('left-4');
            toggleButton.classList.add('left-64');
        }
    });
</script>
