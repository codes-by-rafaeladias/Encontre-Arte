import './bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    if (!toggle || !sidebar) return;

    toggle.addEventListener('click', () => {
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            sidebar.classList.toggle('open');
            overlay?.classList.toggle('active');
        } else {
            sidebar.classList.toggle('hidden');
        }
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('open');
            overlay?.classList.remove('active');
        }
    });

    const userMenu = document.getElementById('userMenu');
    const dropdown = document.getElementById('dropdownMenu');
    
    if (userMenu && dropdown) {
        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('open');
        });

        document.addEventListener('click', () => {
            dropdown.classList.remove('open');
        });
    }
});
