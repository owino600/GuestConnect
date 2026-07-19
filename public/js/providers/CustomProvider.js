class CustomProvider {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.url) {

            console.warn("Custom survey URL missing.");

            return;

        }

        switch (this.config.type) {

            case "popup":

                window.open(

                    this.config.url,

                    "CustomSurvey",

                    "width=900,height=750,resizable=yes,scrollbars=yes"

                );

                break;

            case "redirect":

                window.location.href = this.config.url;

                break;

            case "modal":

                this.modal();

                break;

            default:

                window.location.href = this.config.url;

        }

    }

    modal() {

        const iframe = document.createElement("iframe");

        iframe.src = this.config.url;

        iframe.style.position = "fixed";

        iframe.style.top = 0;

        iframe.style.left = 0;

        iframe.style.width = "100%";

        iframe.style.height = "100%";

        iframe.style.border = "0";

        iframe.style.background = "#fff";

        iframe.style.zIndex = "999999";

        document.body.appendChild(iframe);

    }

}

window.CustomProvider = CustomProvider;
