document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-menu');
    const menu = document.getElementById('menu');

    toggleButton.addEventListener('click', function() {
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    });
});