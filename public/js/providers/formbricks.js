class FormbricksProvider {

    constructor(config) {

        this.config = config;

    }

    async launch() {

        if (!this.config.show) {
            return;
        }

        console.log("Launching Formbricks survey...");

        /*
         * SDK initialization will go here.
         */

    }

}

window.FormbricksProvider = FormbricksProvider;
