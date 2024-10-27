// Import Bootstrap JavaScript
import 'bootstrap';

// Import custom JavaScript setup (axios and other setups)
import './bootstrap.js';

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('a[href^="http"]').forEach(link => {
        if (!link.href.includes(location.hostname)) {
            link.setAttribute('target', '_blank');
        }
    });
});