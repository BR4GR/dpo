export default class DpoTerminal {
    // Static method to check if the class should be loaded.
    // This method returns true if the terminal container exists on the page.
    static applies() {
        return document.querySelector('.terminal-prompt') !== null;
    }

    // Private class variables.
    #commandInput;

    constructor() {
        this.initializeTerminal();
        this.addEventListeners();
        // Focus on the command input field
        setTimeout(() => {
            const commandInput = document.getElementById("command-input");
            if (commandInput) {
                commandInput.focus();
            }
        }, 100);
    }

    /**
     * Initializes the terminal UI elements.
     */
    initializeTerminal() {
        // Initial update of the terminal path based on the current URL
        this.updateTerminalPath();
    }

    /**
     * Adds event listeners for terminal and navigation interactions.
     */
    addEventListeners() {
        document.addEventListener("DOMContentLoaded", () => {
            this.#commandInput = document.getElementById("command-input");

            if (this.#commandInput) {
                this.#commandInput.addEventListener("keydown", (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        this.performSearch(this.#commandInput.innerText.trim());
                    }
                });
            }

            // Add event listener for popstate to update the terminal when navigating with back/forward buttons
            window.addEventListener("popstate", () => {
                this.updateTerminalPath();
            });

            // Add click event listeners to all menu links to update terminal when navigating
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', (e) => {
                    // Allow navigation but also update the terminal path after a slight delay
                    setTimeout(() => this.updateTerminalPath(), 100);
                });
            });
        });
    }

    /**
     * Handles the commands entered by the user.
     * @param {string} command - The command entered by the user.
     */
    handleCommand(command) {
        if (command.startsWith('find ')) {
            const query = command.replace('find ', '').trim();
            this.performSearch(query);
        }
    }

    /**
     * Performs a search based on the user's command.
     * @param {string} query - The search query.
     */
    performSearch(query) {
        if (query) {
            const url = `/search?query=${encodeURIComponent(query)}`;
            window.location.href = url;
            this.updateTerminalPath(`~/pdo/search-results find ${query}`);
        }
    }

    /**
     * Updates the terminal path to reflect the current URL.
     */
    updateTerminalPath() {
        const path = window.location.pathname.replace(/^\//, '');
        const terminalPath = `${path || ""}`;

        // Update the terminal prompt with the current path
        const terminalPromptElement = document.querySelector(".terminal-prompt");
        if (terminalPromptElement) {
            terminalPromptElement.innerHTML = `${terminalPath} <span id="command-input" contenteditable="true" class="command-input"></span>`;

            // Reattach event listener to the new input
            this.#commandInput = document.getElementById("command-input");
            if (this.#commandInput) {
                this.#commandInput.addEventListener("keydown", (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        this.performSearch(this.#commandInput.innerText.trim());
                    }
                });
            }
        }
    }
}
