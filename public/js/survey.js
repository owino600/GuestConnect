class GuestSurvey {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.show) {
            return;
        }

        switch (this.config.provider) {

            case "formbricks":

                await new FormbricksProvider(
                    this.config.configuration
                ).launch();

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
