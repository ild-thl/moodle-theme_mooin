document.addEventListener("DOMContentLoaded", function () {
    if (window.location.href.indexOf("admin/settings.php?section=themesettingmooin4") > -1) {

        console.log("Custom palette script loaded");
        //Get all elements für the custom-palette
        const paletteSelector = document.querySelector("#id_s_theme_mooin4_colorpalette");
        const colorPickers = document.querySelectorAll(".admin_colourpicker.clearfix");
        const primaryLightInput = document.querySelector("#id_s_theme_mooin4_primarylight");
        const opacitySlider = document.querySelector("#id_s_theme_mooin4_primarylight_opacity");
        const infoBox = document.querySelector("#custom-palette-info");

        // If any of the required elements are missing, log an error and stop further execution
        if (!paletteSelector || !primaryLightInput || !opacitySlider) {
            console.error("Fehler: Ein erforderliches Element fehlt.");
            return;
        }

        // This function controls the visibility of the color pickers and info box
        function updateVisibility() {
            // Check if the selected value of the palette selector is "custom"
            const isCustom = paletteSelector.value === "custom";

            // Show or hide all needed elements
            colorPickers.forEach(picker => {
                let row = picker.closest(".form-item.row") || picker.closest(".form-group");
                if (row && picker !== primaryLightInput.closest(".admin_colourpicker.clearfix")) {
                    row.style.display = isCustom ? "flex" : "none";
                }
            });

            primaryLightInput.closest(".form-item.row")?.style.setProperty("display", isCustom ? "flex" : "none");
            opacitySlider.closest(".form-item.row")?.style.setProperty("display", isCustom ? "flex" : "none");

            if (infoBox) {
                infoBox.style.display = isCustom ? "block" : "none";
            }
        }

        // Updates the CSS variable and Moodle form value for the primary light color
        function updatePrimaryLight() {
            // Get the current color and opacity value from primary light
            let primaryColor = primaryLightInput.value;
            let opacity = parseInt(opacitySlider.value, 10) || 100;

            // If the HEX string includes 8 characters, remove the last two characters
            if (primaryColor.length === 9) {
                primaryColor = primaryColor.substring(0, 7);
            }

            // Convert the opacity percentage (0–100) to a HEX alpha value (00–FF)
            const opacityHex = Math.round(opacity * 255 / 100).toString(16).padStart(2, "0");

            // Update the CSS variable "--primary-light" with the new color and opacity
            document.documentElement.style.setProperty("--primary-light", primaryColor + opacityHex);

            //Update the Moodle form fields in the frontend to persist the new values
            setMoodleFormValue("theme_mooin4_primarylight", primaryColor);
            setMoodleFormValue("theme_mooin4_primarylight_opacity", opacity);
        }

        //shows new values in frontend form
        function setMoodleFormValue(id, value) {
            const input = document.querySelector(`#id_s_${id}`);
            if (input) input.value = value;
        }

        opacitySlider.addEventListener("input", updatePrimaryLight);
        primaryLightInput.addEventListener("input", updatePrimaryLight);
        paletteSelector.addEventListener("change", updateVisibility);

        // Initiale Einstellungen beim Laden
        updateVisibility();
        updatePrimaryLight();

    }
});