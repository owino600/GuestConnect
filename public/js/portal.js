document.addEventListener("DOMContentLoaded", () => {

    const form = document.querySelector("form");

    const button = document.getElementById("connectBtn");

    const terms = document.getElementById("terms");

    if (terms) {

        button.disabled = !terms.checked;

        terms.addEventListener("change", () => {

            button.disabled = !terms.checked;

        });

    }

    form.addEventListener("submit", () => {

        button.disabled = true;

        button.innerHTML = "Connecting...";

    });

});
