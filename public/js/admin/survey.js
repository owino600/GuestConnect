document.addEventListener("DOMContentLoaded", () => {

    const provider = document.getElementById("survey_provider");
    const description = document.getElementById("providerDescription");

    const providers = {

        formbricks: {
            title: "Formbricks",
            text: "Self-hosted surveys with Popup, Redirect and Modal support."
        },

        google: {
            title: "Google Forms",
            text: "Launch a Google Form using Popup or Redirect."
        },

        microsoft: {
            title: "Microsoft Forms",
            text: "Launch Microsoft Forms after guest authentication."
        },

        typeform: {
            title: "Typeform",
            text: "Launch a Typeform survey."
        },

        survicate: {
            title: "Survicate",
            text: "Launch a Survicate survey."
        },

        custom: {
            title: "Custom",
            text: "Launch any custom survey URL."
        }

    };

    const displayMethods = {

        formbricks: ["popup","redirect","modal"],

        google: ["popup","redirect"],

        microsoft: ["redirect"],

        typeform: ["popup","redirect","embed"],

        survicate: ["popup","redirect"],

        custom: ["popup","redirect","modal"]

    };

    const sections = {

        formbricks: document.getElementById("formbricksSettings"),

        google: document.getElementById("googleSettings"),

        microsoft: document.getElementById("microsoftSettings"),

        typeform: document.getElementById("typeformSettings"),

        survicate: document.getElementById("survicateSettings"),

        custom: document.getElementById("customSettings")

    };

    function renderDisplayMethods(providerName){

        const container = document.getElementById("displayMethodContainer");

        container.innerHTML = "";

        const methods = displayMethods[providerName] ?? [];

        methods.forEach(method => {

            const label = document.createElement("label");

            label.className = "radio-option";

            label.innerHTML = `
                <input
                    type="radio"
                    name="survey_display_method"
                    value="${method}"
                    ${method === currentDisplayMethod ? "checked" : ""}
                >

                <span>${method.charAt(0).toUpperCase() + method.slice(1)}</span>
            `;

            container.appendChild(label);

        });

    }

    function updateUI(){

        Object.values(sections).forEach(section => {

            if(section){

                section.style.display = "none";

            }

        });

        if(sections[provider.value]){

            sections[provider.value].style.display = "block";

        }

        const info = providers[provider.value] ?? {

            title: "Unknown",

            text: ""

        };

        description.innerHTML =
            "<strong>" +
            info.title +
            "</strong><br>" +
            info.text;

        renderDisplayMethods(provider.value);

    }

    provider.addEventListener("change", updateUI);

    updateUI();

    // ----------------------------
    // Survey Frequency Logic
   // ----------------------------

    const frequencyRadios =
        document.querySelectorAll(
            "input[name='survey_frequency']"
        );

    const daysGroup =
        document.getElementById(
            "frequencyDaysGroup"
        );

    const visitsGroup =
        document.getElementById(
            "frequencyVisitsGroup"
        );

    function updateFrequencyUI() {

        const selected =
            document.querySelector(
                "input[name='survey_frequency']:checked"
            )?.value;

        daysGroup.style.display =
            selected === "days"
                ? "block"
                : "none";

        visitsGroup.style.display =
            selected === "visits"
                ? "block"
                : "none";

    }

    frequencyRadios.forEach(radio => {

        radio.addEventListener(
            "change",
            updateFrequencyUI
        );

    });

    updateFrequencyUI();

});
