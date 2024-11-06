export default class MatrixLoading {
    static applies() {
        return true; // We want it to always be available to use when needed
    }

    constructor() {
        this.canvas = null;
        this.ctx = null;
        this.characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@$%&*";
        this.fontSize = 16;
        this.drops = [];
        this.drawInterval = null;

        this.setupNavigationHooks();
    }

    initializeCanvas() {
        // Create the canvas dynamically
        this.canvas = document.createElement("canvas");
        this.canvas.id = "matrix-canvas";
        this.canvas.style.position = "fixed";
        this.canvas.style.top = 0;
        this.canvas.style.left = 0;
        this.canvas.style.width = "100vw";
        this.canvas.style.height = "100vh";
        this.canvas.style.zIndex = 9999;
        this.canvas.style.pointerEvents = "none"; // Allow interactions below the canvas if needed
        this.canvas.style.opacity = '1'; // Start fully visible
        this.canvas.style.transition = "opacity 1s ease-out"; // Add fade-out transition

        document.body.appendChild(this.canvas);
        this.ctx = this.canvas.getContext("2d");

        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
        this.columns = this.canvas.width / this.fontSize;
        this.drops = Array(Math.floor(this.columns)).fill(1);

        // Add an event listener to resize the canvas on window resize
        window.addEventListener("resize", () => {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
            this.columns = this.canvas.width / this.fontSize;
            this.drops = Array(Math.floor(this.columns)).fill(1);
        });
    }

    blockPage() {
        if (!this.canvas) {
            this.initializeCanvas();
        }

        // Display the loading canvas
        this.canvas.style.display = 'block';
        this.canvas.style.opacity = '1'; // Ensure opacity is fully visible before animation starts
        this.startDrawing();
    }

    release() {
        if (this.canvas) {
            // Gradually slow down the animation before stopping it completely
            this.slowDownDrawing();

            // Set the opacity to 0 for a smooth fade-out effect
            this.canvas.style.opacity = '0';

            // Once the fade-out transition is complete, stop the animation and remove the canvas
            this.canvas.addEventListener("transitionend", () => {
                clearInterval(this.drawInterval); // Stop the drawing
                if (this.canvas) {
                    document.body.removeChild(this.canvas); // Remove canvas from the DOM
                    this.canvas = null; // Reset canvas for next usage
                }
            }, { once: true });
        }
    }

    slowDownDrawing() {


        let speed = 50;
        const reduceSpeed = () => {
            speed += 25;
            if (speed < 300) { // Cap the speed increment to ensure a smooth stop
                this.drawInterval = setInterval(() => this.draw(), speed);
                setTimeout(reduceSpeed, 200); // Gradually slow down every 200ms
            }
        };

        reduceSpeed();
    }

    startDrawing() {
        this.drawInterval = setInterval(() => this.draw(), 50);
    }

    draw() {
        if (!this.ctx) return;

        this.ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        this.ctx.fillStyle = "#00FF00"; // Green text color
        this.ctx.font = `${this.fontSize}px monospace`;

        this.drops.forEach((y, index) => {
            const text = this.characters[Math.floor(Math.random() * this.characters.length)];
            const x = index * this.fontSize;
            this.ctx.fillText(text, x, y * this.fontSize);

            if (y * this.fontSize > this.canvas.height && Math.random() > 0.975) {
                this.drops[index] = 0;
            }

            this.drops[index]++;
        });
    }

    setupNavigationHooks() {
        // Add event listeners to all <a> elements for navigation
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                // Skip links that are intended to open in a new tab
                if (link.target === "_blank") {
                    return;
                }

                // Block the page when clicking on a navigation link
                this.blockPage();

                // Add a one-time listener to release the loading animation after the page is fully loaded
                window.addEventListener('load', (event) => {
                    this.release();
                }, { once: true });
            });
        });
    }
}
