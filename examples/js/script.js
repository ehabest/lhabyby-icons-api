(function () {
    const button = document.getElementById("runJsExample");
    const image = document.getElementById("jsLogoPreview");
    const status = document.getElementById("jsLogoStatus");

    const apiUrl = <?= json_encode($jsonUrl, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

    button.addEventListener("click", async function () {
        button.disabled = true;
        status.textContent = "Requesting logo JSON...";

        try {
            const response = await fetch(apiUrl, {
                headers: { Accept: "application/json" }
            });

            if (!response.ok) {
                throw new Error("HTTP " + response.status);
            }

            const data = await response.json();

            if (typeof data.url !== "string" || !data.url) {
                throw new Error(data.error || "No logo URL was returned.");
            }

            image.src = data.url;
            image.alt = (data.title || "Logo") + " logo";
            status.textContent = "Success: the image URL was read from the JSON response.";
        } catch (error) {
            status.textContent = "JavaScript test failed: " + error.message;
        } finally {
            button.disabled = false;
        }
    });
})();

/* Multiple-icons API runner */
(function () {
    const form = document.getElementById("multiIconsForm");
    const input = document.getElementById("multiIconsNames");
    const button = document.getElementById("multiIconsButton");
    const preview = document.getElementById("multiIconsPreview");
    const status = document.getElementById("multiIconsStatus");
    const output = document.getElementById("multiIconsJson");
    const apiLink = document.getElementById("multiIconsApiLink");

    const apiBase = "https://l.habyby.net/logo.php";

    function buildApiUrl(names) {
    const cleanNames = names
        .split(",")
        .map(name => name.trim())
        .filter(Boolean)
        .join(",");

    return apiBase + "?name=" +
        cleanNames + "&format=json";
	}	

    async function runMultipleIcons(names) {
        const apiUrl = buildApiUrl(names);

        apiLink.href = apiUrl;
        apiLink.textContent = apiUrl;

        preview.replaceChildren();
        output.textContent = "Loading JSON response...";
        status.textContent = "Requesting multiple icons from the API...";

        button.disabled = true;
        button.textContent = "Loading...";

        try {
            const response = await fetch(apiUrl, {
                headers: { Accept: "application/json" }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || "HTTP " + response.status);
            }

            output.textContent = JSON.stringify(data, null, 2);

            if (!Array.isArray(data.icons)) {
                throw new Error(
                    data.error ||
                    "The API did not return an icons array. Check the multiple-icons response format in logo.php."
                );
            }

            let displayed = 0;

            data.icons.forEach(function (icon) {
                if (
                    !icon ||
                    typeof icon.title !== "string" ||
                    typeof icon.url !== "string"
                ) {
                    return;
                }

                const card = document.createElement("div");
                card.className = "multi-icon-card";

                const img = document.createElement("img");
                img.src = icon.url;
                img.alt = icon.title + " logo";
                img.width = 64;
                img.height = 64;
                img.loading = "lazy";

                img.addEventListener("error", function () {
                    img.alt = icon.title + " logo could not be loaded";
                });

                const title = document.createElement("strong");
                title.textContent = icon.title;

                const link = document.createElement("a");
                link.href = icon.url;
                link.target = "_blank";
                link.rel = "noopener noreferrer";
                link.textContent = "Open SVG";

                card.appendChild(img);
                card.appendChild(title);
                card.appendChild(link);
                preview.appendChild(card);

                displayed++;
            });

            let message = displayed + " icon(s) displayed.";

            if (Array.isArray(data.not_found) && data.not_found.length > 0) {
                message += " Not found: " + data.not_found.join(", ") + ".";
            }

            if (displayed === 0 && (!data.not_found || !data.not_found.length)) {
                message += " The API returned no displayable icons.";
            }

            status.textContent = message;
        } catch (error) {
            output.textContent = "Unable to load multiple icons.\n" + error.message;
            status.textContent = "Test failed: " + error.message;
        } finally {
            button.disabled = false;
            button.textContent = "Run Multiple Icons Test";
        }
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const names = input.value.trim();

        if (!names) {
            status.textContent = "Enter one or more icon names separated by commas.";
            return;
        }

        runMultipleIcons(names);
    });

    // Automatically run the default example when the page loads.
    runMultipleIcons(input.value.trim());
})();
