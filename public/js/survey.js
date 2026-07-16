class GuestSurvey {

    constructor(config) {

        this.show = config.show;
        this.provider = config.provider;
        this.configuration = config.configuration;

    }

    launch() {

        if (!this.show) {

            return;

        }

        switch (this.provider) {

            case "formbricks":

                this.launchFormbricks();

                break;

            default:

                console.warn(
                    "Unknown survey provider:",
                    this.provider
                );

        }

    }

    launchFormbricks() {

        window.open(
            this.url,
            "_blank"
        );

    }

}
