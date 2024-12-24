/**
 * @file app.js Main Entry for the DPO frontend ES6 system.
 *
 * From here, we import all other classes and compile everything to one JS file.
 */
import 'bootstrap';
import './bootstrap.js';

import BaseCamp from "./base.js";
import GutenbergKaraoke from "./gutenbergKaraoke.js";
import STD from "./std.js";
import DpoTerminal from "./terminal.js";
// import MatrixLoading from "./matrix.js";
// Import the main/root SCSS file to compile all styles.
import '../css/app.scss';

const apps = [
    DpoTerminal,
    GutenbergKaraoke,
    STD,
    BaseCamp,
];

// Ensure that all apps are only executed after the document is ready.
document.addEventListener("DOMContentLoaded", function () {
    apps.forEach(function (appClass) {
        if (typeof appClass.applies === 'function' && appClass.applies()) {
            new appClass();
        }
    });
});
