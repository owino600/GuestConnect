class ProviderFactory {

    static create(provider, configuration) {

        switch (provider) {

            case "formbricks":
                return new FormbricksProvider(configuration);

            /*
            case "google":
                return new GoogleFormsProvider(configuration);

            case "typeform":
                return new TypeformProvider(configuration);
            */

            default:
                throw new Error(
                    "Unknown survey provider: " + provider
                );
        }
    }
}

window.ProviderFactory = ProviderFactory;
