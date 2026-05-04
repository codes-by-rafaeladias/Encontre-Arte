import './bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    if (!toggle || !sidebar) return;

    toggle.addEventListener('click', () => {

        if (window.matchMedia("(max-width: 768px)").matches) {
            sidebar.classList.toggle('open');
            sidebar.classList.remove('hidden');
            overlay?.classList.toggle('active');
        } else {
            sidebar.classList.toggle('hidden');
        }

    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        sidebar.classList.toggle('hidden');
    });
});
