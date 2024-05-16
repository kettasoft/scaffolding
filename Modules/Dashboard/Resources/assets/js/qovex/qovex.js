// require('./bootstrap');
import "./bootstrap";
import axios from "axios";
import Vue from "vue";
import VueInternationalization from "vue-i18n";
import Locale from "../../../../../../resources/js/vue-i18n-locales.generated";
import FileUploader from "laravel-file-uploader";
import Select2Component from "../components/Select2Component.vue";
// import Speech from "speak-tts";

// try {
//     const speech = new Speech();

//     speech.setLanguage("en-US");

//     speech
//         .speak({
//             text: "Hello, how are you today ?",
//         })
//         .then(() => {
//             console.log("ssssssssssssssssssssssssss");
//         })
//         .catch((err) => {
//             console.log("eeeeeeeeeeeeeeeeeeeeeeeeee");
//         });
// } catch (error) {
//     console.log(error);
// }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const lang = document.documentElement.lang.substr(0, 2);

window.axios = axios;

window.Parsley.setLocale(lang);

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["lang"] = lang;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        lang: lang,
    },
});

const langMap = {
    ar: "ar_AR",
    en: "en_US",
};

switch (lang) {
    case "ar":
        import("bootstrap-select/js/i18n/defaults-ar_AR");
        break;
    case "en":
        import("bootstrap-select/js/i18n/defaults-en_US");
        break;
    default:
        console.error("Unknown language " + document.documentElement.lang);
}

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

Vue.use(FileUploader);

Vue.use(VueInternationalization);

// Vue.use(VueSweetalert2);

// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale,
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("select2", Select2Component);

const app = new Vue({
    el: "#vue",
    i18n,
});
