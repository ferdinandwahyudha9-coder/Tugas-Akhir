import './bootstrap';

// Dark Mode Logic
function initDarkMode() {
    const isDark = localStorage.getItem('theme') === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if (isDark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark'); // Sync to ensure state consistency
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
}

window.toggleDarkMode = function () {
    const html = document.documentElement;
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
    document.dispatchEvent(new Event('theme-changed')); // Notify components if needed
};

// Initialize on load
initDarkMode();
