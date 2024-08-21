/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");
    window.bootstrap = require("bootstrap5");

    require("bootstrap-select5/dist/js/bootstrap-select.js");
    require('summernote/dist/summernote-lite');
    require("select2/dist/js/select2.full");
    require("parsleyjs");
    require("parsleyjs/src/i18n/ar");
    require("parsleyjs/src/i18n/en");
    require("parsleyjs/src/i18n/tr");
    require("jquery-countdown");
    require("./broadcaster");
    require("../editor");
    require("../formValidation");
    require("./coming_soon");
    require("metismenu");
    require("simplebar");
    require("node-waves");
    window.feather = require("feather-icons");
    require("pace-js");
    require("./password");
    require('./broadcaster')
    require('./vanilla-tilt.min.js')
    require("./custom");

} catch (e) {
}
