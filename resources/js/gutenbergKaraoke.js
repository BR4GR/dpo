import $ from 'jquery';

export default class GutenbergKaraoke {
    static applies() {
        return $('#displayArea').length > 0 && $('#bookInfo').length > 0;
    }

    constructor() {
        // Cache DOM elements
        this.$displayArea = $('#displayArea');
        this.$bookInfo = $('#bookInfo');
        this.$errorEl = $('#error');
        this.$speedSlider = $('#speed');
        this.$chapterSelect = $('#chapterSelect');
        this.$jumpBackBtn = $('#jumpBackBtn');

        // State variables
        this.words = [];
        this.currentIndex = 0;
        this.intervalId = null;

        // Initial WPM
        this.currentWPM = parseInt(this.$speedSlider.val(), 10);
        this.updateIntervalDuration();

        // Initialize event listeners and start
        this.initializeEvents();
        this.fetchBookFromBackend();
    }

    /**
     * Binds event listeners for the speed adjustment, chapter selection, and jump back.
     */
    initializeEvents() {
        this.$speedSlider.on('input', () => {
            this.currentWPM = parseInt(this.$speedSlider.val(), 10);
            this.updateIntervalDuration();
        });

        this.$chapterSelect.on('change', () => {
            const selectedChapterIndex = parseInt(this.$chapterSelect.val(), 10);
            if (this.chapters && this.chapters[selectedChapterIndex]) {
                this.setChapter(selectedChapterIndex);
            }
        });

        this.$jumpBackBtn.on('click', () => {
            this.jumpBack(50);
        });
    }

    /**
     * Updates the interval duration (ms/word) based on the current WPM.
     * WPM to ms/word: 60000 / WPM
     */
    updateIntervalDuration() {
        const msPerWord = 60000 / this.currentWPM;

        // If there's already an interval running, clear it and start a new one from the current word
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }

        this.intervalId = setInterval(() => this.showNextWord(), msPerWord);
    }

    /**
     * Shows the next word in the sequence.
     */
    showNextWord() {
        if (this.currentIndex >= this.words.length) {
            clearInterval(this.intervalId);
            return;
        }
        this.$displayArea.text(this.words[this.currentIndex]);
        this.currentIndex++;
    }

    /**
     * Fetches the random Gutenberg book text from your Laravel backend.
     */
    async fetchBookFromBackend() {
        try {
            const response = await fetch('/gutenberg/fetch');
            if (!response.ok) {
                throw new Error("Failed to fetch book data from backend.");
            }
            const data = await response.json();
            if (data.error) {
                throw new Error(data.error);
            }

            // Update book info
            this.$bookInfo.text(`${data.title} by ${data.authors.map(a => a.name).join(', ')} (ID: ${data.bookID})`);

            this.chapters = data.chapters || [{ title: 'Full Text', text: data.text }];
            this.populateChapterSelect();
            // Default to the first chapter
            this.setChapter(0);

        } catch (e) {
            this.$errorEl.text("Error: " + e.message);
            this.$bookInfo.text("");
        }
    }

    /**
     * Populates the chapter dropdown based on the chapters data.
     */
    populateChapterSelect() {
        this.$chapterSelect.empty();
        this.chapters.forEach((ch, index) => {
            const $option = $('<option>')
                .val(index)
                .text(ch.title);
            this.$chapterSelect.append($option);
        });
    }

    /**
     * Sets the text to the specified chapter and resets reading from the start of that chapter.
     */
    setChapter(chapterIndex) {
        if (!this.chapters || !this.chapters[chapterIndex]) return;

        const chapterText = this.chapters[chapterIndex].text;
        this.words = chapterText.replace(/\s+/g, ' ').trim().split(' ');
        this.currentIndex = 0;
        // Restart interval from the beginning of this chapter
        this.updateIntervalDuration();
    }

    /**
     * Jumps back a certain number of words, never going below zero, and updates the display immediately.
     */
    jumpBack(numWords) {
        this.currentIndex = Math.max(0, this.currentIndex - numWords);
        // Immediately show the current word (or the previous one) after jumping back
        if (this.words.length > 0 && this.currentIndex < this.words.length) {
            this.$displayArea.text(this.words[this.currentIndex]);
        }
    }
}
