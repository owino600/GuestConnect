class FormbricksProvider {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.url) {

            console.warn("No Formbricks survey URL configured.");

            return;

        }

        switch (this.config.type) {

            case "popup":

                this.openPopup();
                break;

            case "redirect":

                window.location.href = this.config.url;
                break;

            case "modal":

                this.openModal();
                break;

            default:

                this.openPopup();

        }

    }

    openPopup() {

        window.open(

            this.config.url,

            "GuestSurvey",

            "width=900,height=750,resizable=yes,scrollbars=yes"

        );

    }

    openModal() {

        console.log("Modal support coming later.");

    }

}

window.FormbricksProvider = FormbricksProvider;
