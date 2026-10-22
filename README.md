# LHabyby Icons API

A simple way for developers to access social media and technology logos through the LHabyby Icons API.

Use the API in HTML, CSS, JavaScript, PHP, or JSON to retrieve and display SVG logos in your projects.

<p align="center">
  <a href="https://l.habyby.net/logo.php?name=github&format=svg">
    <img src="https://l.habyby.net/logo.php?name=github&format=svg" alt="GitHub logo provided by LHabyby Icons API" width="90" height="90">
  </a>
</p>

<p align="center">
  <a href="https://l.habyby.net/">LHabyby Website</a> ·
  <a href="https://l.habyby.net/logo.php">API Endpoint</a> ·
  <a href="https://ihab.habyby.net/test.php">Live API Tester</a>
</p>

## Live Demo

**[Try the LHabyby Icons API Tester](https://ihab.habyby.net/test.php)**

The interactive tester demonstrates:

- HTML image elements
- CSS background images
- JavaScript Fetch API
- JSON responses
- PHP server-side requests
- Multiple icons in a single JSON request

## API Endpoint

```text
https://l.habyby.net/logo.php
```

### Single Icon Requests

**Get JSON data**

```text
https://l.habyby.net/logo.php?name=github&format=json
```

**Get the SVG image**

```text
https://l.habyby.net/logo.php?name=github&format=svg
```

**Get the image URL**

```text
https://l.habyby.net/logo.php?name=github&format=url
```

Replace `github` with any supported icon name.

### Multiple Icons JSON Request

Request several icons using **one API URL**, with icon names separated by commas.

**Example:**

[Open Multiple Icons JSON Request](https://l.habyby.net/logo.php?name=github,facebook,instagram,yahoo&format=json)

```text
https://l.habyby.net/logo.php?name=github,facebook,instagram,yahoo&format=json
```

This requests GitHub, Facebook, Instagram, and Yahoo in a single request.

**How it works:**

1. Separate icon names with commas.
2. Add `format=json` to request JSON data.
3. Read the returned `icons` array.
4. Use each icon's `url` to display its SVG image.
5. Check `not_found` for names the API could not find, if that field is returned.

The response structure for multiple icons is different from the single-icon response. A multiple-icon response uses an `icons` array rather than a single `url` field.

### JavaScript Example: Display Multiple Icons

This example requests four icons and displays the returned images on your webpage.

```html
<div id="icons"></div>

<script>
const names = "github,facebook,instagram,yahoo";

const apiUrl =
  "https://l.habyby.net/logo.php?name=" +
  names +
  "&format=json";

fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error("HTTP " + response.status);
    }

    return response.json();
  })
  .then(data => {
    const container = document.getElementById("icons");
    container.replaceChildren();

    if (!Array.isArray(data.icons)) {
      throw new Error("The API did not return an icons array.");
    }

    data.icons.forEach(icon => {
      const img = document.createElement("img");

      img.src = icon.url;
      img.alt = icon.title + " logo";
      img.width = 64;
      img.height = 64;
      img.style.margin = "8px";

      container.appendChild(img);
    });

    if (Array.isArray(data.not_found) && data.not_found.length) {
      console.warn("Icons not found:", data.not_found);
    }
  })
  .catch(error => {
    console.error("API request failed:", error);
  });
</script>
```

**Result:** Each icon returned in the `icons` array is displayed as an image. You can change the names in the `names` variable to request other supported icons.

### PHP Example: Display Multiple Icons

PHP can request the same JSON endpoint from your server and generate HTML image elements.

```php
<?php

$names = 'github,facebook,instagram,yahoo';

$apiUrl = 'https://l.habyby.net/logo.php?name='
    . $names
    . '&format=json';

$response = file_get_contents($apiUrl);

if ($response !== false) {
    $data = json_decode($response, true);

    if (
        json_last_error() === JSON_ERROR_NONE
        && isset($data['icons'])
        && is_array($data['icons'])
    ) {
        foreach ($data['icons'] as $icon) {
            if (empty($icon['url'])) {
                continue;
            }

            echo '<img src="'
                . htmlspecialchars(
                    $icon['url'],
                    ENT_QUOTES,
                    'UTF-8'
                )
                . '" alt="'
                . htmlspecialchars(
                    $icon['title'] ?? 'Logo',
                    ENT_QUOTES,
                    'UTF-8'
                )
                . '" width="64" height="64" style="margin:8px;">';
        }

        if (!empty($data['not_found'])) {
            echo '<p>Icons not found: '
                . htmlspecialchars(
                    implode(', ', $data['not_found']),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . '</p>';
        }
    } else {
        echo 'Invalid JSON response or unexpected API format.';
    }
} else {
    echo 'API request failed.';
}
```

This example requires `allow_url_fopen` to be enabled. Alternatively, use PHP cURL. The PHP example assumes the multiple-icon JSON response contains an `icons` array.

## HTML Example

Display a single logo directly in your webpage:

```html
<img
  src="https://l.habyby.net/logo.php?name=github&format=svg"
  alt="GitHub logo"
  width="100"
  height="100"
>
```

## CSS Example

Use a logo as a CSS background image:

```css
.github-logo {
  width: 100px;
  height: 100px;
  background-image: url("https://l.habyby.net/logo.php?name=github&format=svg");
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
}
```

Add the corresponding HTML element:

```html
<div class="github-logo" role="img" aria-label="GitHub logo"></div>
```

## JavaScript Example: Single Icon

Fetch the JSON response and inspect the returned data:

```javascript
const apiUrl =
  "https://l.habyby.net/logo.php?name=github&format=json";

fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error("HTTP " + response.status);
    }

    return response.json();
  })
  .then(data => {
    console.log(data);

    const img = document.createElement("img");
    img.src = data.url;
    img.alt = (data.title || "GitHub") + " logo";
    img.width = 100;
    img.height = 100;

    document.body.appendChild(img);
  })
  .catch(error => {
    console.error("API request failed:", error);
  });
```

## PHP Example: Single Icon

```php
<?php

$apiUrl =
    'https://l.habyby.net/logo.php?name=github&format=json';

$response = file_get_contents($apiUrl);

if ($response !== false) {
    $data = json_decode($response, true);

    if (
        json_last_error() === JSON_ERROR_NONE
        && !empty($data['url'])
    ) {
        echo '<img src="'
            . htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8')
            . '" alt="'
            . htmlspecialchars($data['title'] ?? 'GitHub', ENT_QUOTES, 'UTF-8')
            . '" width="100" height="100">';
    } else {
        echo 'Invalid JSON response or missing image URL.';
    }
} else {
    echo 'API request failed.';
}
```

This example requires `allow_url_fopen` to be enabled. You can use cURL as an alternative.

## List Available Icons

Retrieve the API's list of supported icons:

[View all supported icons in JSON](https://l.habyby.net/logo.php?format=list)

Replace the icon name in the request URL with a supported name from the list.

## Project Links

| Resource | Link |
|---|---|
| LHabyby Website | [l.habyby.net](https://l.habyby.net/) |
| API Endpoint | [logo.php](https://l.habyby.net/logo.php) |
| Interactive Tester | [Open API Tester](https://ihab.habyby.net/test.php) |
| Supported Icons | [View JSON List](https://l.habyby.net/logo.php?format=list) |
| Multiple Icons JSON | [Try Multiple Icons](https://l.habyby.net/logo.php?name=github,facebook,instagram,yahoo&format=json) |
| GitHub Repository | [lhabyby-icons-api](https://github.com/ehabest/lhabyby-icons-api) |

## Supported Icons

The API's published icon list currently contains **186 icons**, according to the existing project documentation. The live API list is the best source for checking current availability.

[**View all supported icons in JSON →**](https://l.habyby.net/logo.php?format=list)

The API includes social media brands, developer tools, programming technologies, design tools, and other icon categories. Availability may change over time.

## About

LHabyby Icons API is a developer resource for retrieving supported SVG logos through a simple web API.

Created by **Eng. Ihab Elkady**.

Website: [https://ihab.habyby.net/](https://ihab.habyby.net/)

---

**Trademark notice:** Third-party logos and brand names belong to their respective owners. Their use may be subject to each owner's trademark and usage requirements.
