class GuestSurvey {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.show) {
            return;
        }

        const configuration = this.config.configuration;

        switch (this.config.provider) {

            case "formbricks":

                await new FormbricksProvider(configuration).launch();
                break;

            case "google":

                await new GoogleFormsProvider(configuration).launch();
                break;

            case "microsoft":

                await new MicrosoftFormsProvider(configuration).launch();
                break;

            case "typeform":

                await new TypeformProvider(configuration).launch();
                break;

            case "survicate":

                await new SurvicateProvider(configuration).launch();
                break;

            case "custom":

                await new CustomProvider(configuration).launch();
                break;

            default:

                console.warn(
                    "Unknown survey provider:",
                    this.config.provider
                );

        }

    }

}

window.GuestSurvey = GuestSurvey;
