class SurvicateProvider {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.url) {

            console.warn("Survicate URL missing.");

            return;

        }

        switch (this.config.type) {

            case "popup":

                window.open(

                    this.config.url,

                    "SurvicateSurvey",

                    "width=900,height=750,resizable=yes,scrollbars=yes"

                );

                break;

            case "redirect":

                window.location.href = this.config.url;

                break;

            default:

                window.location.href = this.config.url;

        }

    }

}

window.SurvicateProvider = SurvicateProvider;
