class MicrosoftFormsProvider {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.url) {

            console.warn("Microsoft Form URL missing.");

            return;

        }

        switch (this.config.type) {

            case "redirect":

                window.location.href = this.config.url;

                break;

            default:

                window.location.href = this.config.url;

        }

    }

}

window.MicrosoftFormsProvider = MicrosoftFormsProvider;
