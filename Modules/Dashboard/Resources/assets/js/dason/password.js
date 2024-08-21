document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById('password-addon')) {
        document.getElementById('password-addon').addEventListener('click', function () {
            var passwordInput = document.getElementById("password-input");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("topnav-menu-content")) {
        var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
        for (var i = 0, len = elements.length; i < len; i++) {
            elements[i].onclick = function (elem) {
                if (elem && elem.target && elem.target.getAttribute("href") === "#") {
                    elem.target.parentElement.classList.toggle("active");
                    if (elem.target.nextElementSibling)
                        elem.target.nextElementSibling.classList.toggle("show");
                }
            }
        }
    }
});
