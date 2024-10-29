// Import Bootstrap JavaScript
import 'bootstrap';

// Import custom JavaScript setup (axios and other setups)
import './bootstrap.js';


document.addEventListener("DOMContentLoaded", function () {
    const commandInput = document.getElementById("command-input");

    // Initial update of the terminal path based on the current URL
    updateTerminalPath();

    // Add event listener for user navigation using command input
    commandInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            handleCommand(commandInput.innerText.trim());
        }
    });

    // Add event listener for popstate to update the terminal when navigating with back/forward buttons
    window.addEventListener("popstate", function () {
        updateTerminalPath();
    });

    // Add click event listeners to all menu links to update terminal when navigating
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function (e) {
            // Allow navigation but also update the terminal path after a slight delay
            setTimeout(updateTerminalPath, 100);
        });
    });

    function performSearch(query) {
        if (query) {
            const url = `/search?query=${encodeURIComponent(query)}`;
            window.location.href = url;
            updateTerminalPath(`~/pdo/search-results find ${query}`);
        }
    }


    function updateTerminalPath() {
        const path = window.location.pathname.replace(/^\//, '');
        const terminalPath = `visitor@pdo-site ~/pdo/${path || ""}`;

        // Update the terminal prompt with the current path
        const terminalPromptElement = document.querySelector(".terminal-prompt");
        if (terminalPromptElement) {
            terminalPromptElement.innerHTML = `${terminalPath} <span id="command-input" contenteditable="true" class="command-input"></span>`;
            // Reattach event listener to the new input
            const newCommandInput = document.getElementById("command-input");

            newCommandInput.addEventListener("keydown", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault();

                    performSearch(newCommandInput.innerText.trim());
                }
            });
        }
    }
});
