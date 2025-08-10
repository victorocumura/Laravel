
<button onclick="toggleTheme()" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-800 text-black dark:text-white">
    Alternar Tema
</button>

<script>
    function toggleTheme() {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    // Carregar preferência do tema ao iniciar
    document.addEventListener('DOMContentLoaded', () => {
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    });
</script>
