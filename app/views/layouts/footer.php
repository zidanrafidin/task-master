</main> <!-- Penutup tag main -->

    <!-- Script Logika Responsive Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeSidebarBtn = document.getElementById('close-sidebar-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Fungsi untuk membuka menu
            function openMenu() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            // Fungsi untuk menutup menu
            function closeMenu() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            // Event Listeners
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', openMenu);
            }
            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', closeMenu);
            }
            // Tutup menu jika background gelap di-klik
            if (overlay) {
                overlay.addEventListener('click', closeMenu);
            }
        });
    </script>
</body>
</html>