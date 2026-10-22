# LHabyby Icons API

A simple way for developers to access social media logos through the LHabyby Icons API.

Use the API in your HTML, CSS, JavaScript, and PHP projects, or inspect its response using JSON.

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

**Try the API:** [Open the LHabyby Icons API Tester](https://ihab.habyby.net/test.php)

The tester demonstrates how to use the API with:

- HTML image elements
- CSS background images
- JavaScript Fetch API
- JSON responses
- PHP server-side requests

## API Endpoint

```text
https://l.habyby.net/logo.php
```

### Request examples

**Get an API response**

```text
https://l.habyby.net/logo.php?name=github
```

**Request SVG output**

```text
https://l.habyby.net/logo.php?name=github&format=svg
```

**Request JSON output**

```text
https://l.habyby.net/logo.php?name=github&format=json
```

**Request URL format**

```text
https://l.habyby.net/logo.php?name=github&format=url
```

Replace `github` with another supported logo name.

## HTML Example

Display a logo directly in your webpage:

```html
<img
  src="https://l.habyby.net/logo.php?name=github&format=svg"
  alt="GitHub logo"
  width="100"
  height="100"
>
```

## CSS Example

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

## JavaScript Example

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
  })
  .catch(error => {
    console.error("API request failed:", error);
  });
```

To display an image from JavaScript, extract the image URL using the field provided by the API's actual JSON response, then assign that URL to an image element's `src`.

## PHP Example

Request the JSON endpoint from a PHP server:

```php
<?php

$apiUrl =
    'https://l.habyby.net/logo.php?name=github&format=json';

$response = file_get_contents($apiUrl);

if ($response !== false) {
    $data = json_decode($response, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        print_r($data);
    } else {
        echo 'Invalid JSON response.';
    }
} else {
    echo 'API request failed.';
}
```

This example requires `allow_url_fopen` to be enabled. You can use cURL as an alternative.

## Project Links

| Resource | Link |
|---|---|
| LHabyby Website | https://l.habyby.net/ |
| API Endpoint | https://l.habyby.net/logo.php |
| Interactive Tester | https://ihab.habyby.net/test.php |
| GitHub Repository | https://github.com/ehabest/lhabyby-icons-api |

## About

LHabyby Icons API is a developer resource for accessing supported social media logos through a simple web API.

Created by **Eng. Ihab Elkady**.

Website: https://ihab.habyby.net/

---

**Note:** Available logos and supported response formats depend on the live API. Third-party logos may be subject to their respective owners' trademarks and usage requirements.
