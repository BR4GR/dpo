import $ from 'jquery';

export default class DpoTerminal {
    // Static method to check if the class should be loaded.
    static applies() {
        return $('.terminal-prompt').length > 0;
    }

    // Class variables.
    #$commandInput;
    #$searchModal;

    constructor() {
        this.initializeTerminal();
        this.initializeSearchModal();
        this.initializeEventListeners();
        this.focusOnCommandInput();
    }

    /**
     * Initializes the terminal UI elements.
     */
    initializeTerminal() {
        this.updateTerminalPath();
    }

    /**
     * Creates and initializes the search modal element.
     */
    initializeSearchModal() {
        this.#$searchModal = $('<div id="search-modal"></div>').css('display', 'none');
        $('body').append(this.#$searchModal);
    }

    /**
     * Adds event listeners for terminal and navigation interactions.
     */
    initializeEventListeners() {
        $(document).ready(() => {
            this.#$commandInput = $('#command-input');

            if (this.#$commandInput.length) {
                this.#$commandInput.on('keydown', (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        this.handleCommand(this.#$commandInput.text().trim());
                    } else {
                        this.performLiveSearch(this.#$commandInput.text().trim());
                    }
                });
            }

            $(window).on('popstate', () => {
                this.updateTerminalPath();
            });

            $('a').on('click', () => {
                setTimeout(() => this.updateTerminalPath(), 100);
            });

            // Close modal if clicking outside it or pressing 'Esc'
            $(document).on('click', (e) => {
                if (
                    this.#$searchModal.is(':visible') &&
                    !$(e.target).closest('#search-modal, #command-input').length
                ) {
                    this.closeSearchModal();
                }
            });

            $(document).on('keydown', (e) => {
                if (e.key === "Escape" && this.#$searchModal.is(':visible')) {
                    this.closeSearchModal();
                }
            });
        });
    }

    /**
     * Focus on the command input field.
     */
    focusOnCommandInput() {
        setTimeout(() => {
            this.#$commandInput?.focus();
        }, 100);
    }

    /**
     * Handles the commands entered by the user.
     * @param {string} command - The command entered by the user.
     */
    handleCommand(command) {
        if (command.startsWith('find ')) {
            const query = command.replace('find ', '').trim();
            if (query) {
                this.performLiveSearch(query, true);
            }
        }
    }

    /**
     * Performs a live search based on the user's command.
     * @param {string} query - The search query.
     * @param {boolean} scrollToResult - Whether to scroll to the result on the page.
     */
    performLiveSearch(query, scrollToResult = false) {
        if (query.length > 0) {
            $.get(`/api/search?query=${encodeURIComponent(query)}`, (data) => {
                let resultsHtml = '';
                if (data.results && data.results.length > 0) {
                    resultsHtml += `<div class="search-results-header">Search Results for "${query}"</div>`;
                    data.results.forEach(result => {
                        resultsHtml += `
                            <div class="search-result-item" data-preview="${result.preview}">
                                <div class="result-title">${result.friendly_name}</div>
                                <div class="result-preview">${result.preview}</div>
                            </div>`;
                    });
                } else {
                    resultsHtml += '<div class="no-results">No results found</div>';
                }
                this.#$searchModal.html(resultsHtml);
                this.#$searchModal.show();

                // If it's a command, scroll to the result
                if (scrollToResult) {
                    this.scrollToSearchResult(query);
                }
            });
        } else {
            this.closeSearchModal();
        }
    }

    /**
     * Scrolls to the search result if found on the page.
     * @param {string} query - The search query to find in the document.
     */
    scrollToSearchResult(query) {
        const previewText = this.#$searchModal.find('.result-preview:contains("' + query + '")').first().text();

        if (previewText) {
            const escapedPreviewText = previewText.replace(/[-/\\^$*+?.()|[\]{}]/g, '\\$&');
            const regex = new RegExp(escapedPreviewText, 'i');
            const $paragraph = $('p').filter(function () {
                return regex.test($(this).text());
            }).first();

            if ($paragraph.length) {
                $('html, body').animate({
                    scrollTop: $paragraph.offset().top - 100 // Adjust offset as needed
                }, 500);
            }
        }
    }

    /**
     * Closes the search modal.
     */
    closeSearchModal() {
        this.#$searchModal.hide();
        this.#$searchModal.html(""); // Clear results
    }

    /**
     * Updates the terminal path to reflect the current URL.
     */
    updateTerminalPath() {
        const path = window.location.pathname.replace(/^\//, '');
        const terminalPath = `${path || ""}`;

        const $terminalPromptElement = $(".terminal-prompt");
        if ($terminalPromptElement.length) {
            $terminalPromptElement.html(`${terminalPath} <span id="command-input" contenteditable="true" class="command-input"></span>`);

            this.#$commandInput = $('#command-input');
            if (this.#$commandInput.length) {
                this.#$commandInput.on('keydown', (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        this.handleCommand(this.#$commandInput.text().trim());
                    } else {
                        this.performLiveSearch(this.#$commandInput.text().trim());
                    }
                });
            }
        }
    }
}
