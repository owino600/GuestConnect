class TypeformProvider {

    constructor(config) {
        this.config = config;
    }

    async launch() {

        if (!this.config.url) {

            console.warn("Typeform URL missing.");

            return;

        }

        switch (this.config.type) {

            case "popup":

                window.open(
                    this.config.url,
                    "TypeformSurvey",
                    "width=900,height=750,resizable=yes,scrollbars=yes"
                );

                break;

            case "redirect":

                window.location.href = this.config.url;

                break;

            case "embed":

                this.embed();

                break;

            default:

                window.location.href = this.config.url;

        }

    }

    embed() {

        const iframe = document.createElement("iframe");

        iframe.src = this.config.url;

        iframe.style.position = "fixed";

        iframe.style.left = "0";

        iframe.style.top = "0";

        iframe.style.width = "100%";

        iframe.style.height = "100%";

        iframe.style.border = "0";

        iframe.style.zIndex = "99999";

        iframe.style.background = "#fff";

        document.body.appendChild(iframe);

    }

}

window.TypeformProvider = TypeformProvider;
