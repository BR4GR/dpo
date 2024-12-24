import $ from 'jquery';

export default class GutenbergKaraoke {
    
    static applies() {
        return $('#displayArea').length > 0;
    }

    constructor() {
        this.$displayArea = $('#displayArea');
        this.$bookInfo = $('#bookInfo');
        this.$errorEl = $('#error');
        this.$speedSlider = $('#speed');
        this.$speedLabel = $('#speedLabel');
        this.$stopBtn = $('#stopBtn');
        this.$startBtn = $('#startBtn');

        // State variables
        this.words = [];
        this.currentIndex = 0;
        this.intervalId = null;
        this.currentWPM = parseInt(this.$speedSlider.val(), 10);

        // Initialize events
        this.initializeEvents();
        this.fetchBookFromBackend();
    }

    initializeEvents() {
        // Adjust speed
        this.$speedSlider.on('input', () => {
            this.currentWPM = parseInt(this.$speedSlider.val(), 10);
            this.updateInterval();
        });

        // Start reading
        this.$startBtn.on('click', () => this.startReading());

        // Stop reading
        this.$stopBtn.on('click', () => this.stopReading());
    }

    fetchBookFromBackend() {
        fetch('/gutenberg/fetch')
            .then((res) => res.json())
            .then((data) => {
                this.$bookInfo.text(`${data.title} by ${data.authors.map(a => a.name).join(', ')}`);
                this.processText(data.text);
            })
            .catch((err) => this.$errorEl.text("Error: " + err.message));
    }

    processText(rawText) {
        // Start from "START OF THE PROJECT GUTENBERG EBOOK"
        const startIndex = rawText.indexOf("START OF THE PROJECT GUTENBERG EBOOK");
        const cleanText = rawText.slice(startIndex).replace(/\s+/g, ' ').trim();
        this.words = cleanText.split(' ');

        // Display the first word
        this.$displayArea.text(this.words[this.currentIndex]);
    }

    startReading() {
        if (this.intervalId) return; // Prevent multiple intervals

        this.updateInterval(); // Ensure speed matches the slider
    }

    stopReading() {
        clearInterval(this.intervalId);
        this.intervalId = null;
    }

    updateInterval() {
        clearInterval(this.intervalId);
        const msPerWord = 60000 / this.currentWPM;

        this.intervalId = setInterval(() => {
            this.showNextWord();
        }, msPerWord);
        this.$speedLabel.text(`Speed: ${this.currentWPM} WPM`);

    }

    showNextWord() {
        if (this.currentIndex >= this.words.length) {
            this.stopReading();
            return;
        }

        this.$displayArea.text(this.words[this.currentIndex]);
        this.currentIndex++;
    }
}
