
export default class BaseCamp {
    // Static method to check if the class should be loaded.
    static applies() {
        return true;
    }

    // Class variables.

    constructor() {
        this.initializeEventListeners();
    }

    /**
     * Adds event listeners for terminal and navigation interactions.
     */
    initializeEventListeners() {
        $(document).ready(() => {
            const links = document.querySelectorAll("a");
            const currentDomain = window.location.hostname;

            links.forEach((link) => {
                const href = link.getAttribute("href");

                if (href && !href.startsWith("#") && !href.startsWith("/") && !href.includes(currentDomain)) {
                    // External link
                    link.classList.add("external-link");
                    link.setAttribute("target", "_blank");
                }
            });
        });
    }

}
