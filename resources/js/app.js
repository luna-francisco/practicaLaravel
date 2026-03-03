import './bootstrap';

import Alpine from 'alpinejs';

document.documentElement.setAttribute('data-theme', 'light');
localStorage.setItem('theme', 'light');

window.Alpine = Alpine;

Alpine.start();
