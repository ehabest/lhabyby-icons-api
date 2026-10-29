# LHabyby Icons API

A simple way for developers to access social media and technology logos through the LHabyby Icons API.

Use the API in HTML, CSS, JavaScript, PHP, or JSON to retrieve and display SVG logos in your projects.

<p align="center">
  <a href="https://l.habyby.net/logo?name=github&format=svg">
    <img src="https://l.habyby.net/logo?name=github&format=svg" alt="GitHub logo provided by LHabyby Icons API" width="90" height="90">
  </a>
</p>

<p align="center">
  <a href="https://l.habyby.net/">LHabyby Website</a> ·
  <a href="https://l.habyby.net/logo">API Endpoint</a> ·
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
https://l.habyby.net/logo
```

### Single Icon Requests

**Get JSON data**

```text
https://l.habyby.net/logo?name=github&format=json
```

**Get the SVG image**

```text
https://l.habyby.net/logo?name=github&format=svg
```

**Get the image URL**

```text
https://l.habyby.net/logo?name=github&format=url
```

Replace `github` with any supported icon name.

### Multiple Icons JSON Request

Request several icons using **one API URL**, with icon names separated by commas.

**Example:**

[Open Multiple Icons JSON Request](https://l.habyby.net/logo?name=github,facebook,instagram,yahoo&format=json)

```text
https://l.habyby.net/logo?name=github,facebook,instagram,yahoo&format=json
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
  "https://l.habyby.net/logo?name=" +
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

$apiUrl = 'https://l.habyby.net/logo?name='
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
  src="https://l.habyby.net/logo?name=github&format=svg"
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
  background-image: url("https://l.habyby.net/logo?name=github&format=svg");
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
  "https://l.habyby.net/logo?name=github&format=json";

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
    'https://l.habyby.net/logo?name=github&format=json';

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

[View all supported icons in JSON](https://l.habyby.net/logo?format=list)

Replace the icon name in the request URL with a supported name from the list.

## Project Links

| Resource | Link |
|---|---|
| LHabyby Website | [l.habyby.net](https://l.habyby.net/) |
| API Endpoint | [logo](https://l.habyby.net/logo) |
| Interactive Tester | [Open API Tester](https://ihab.habyby.net/test.php) |
| Supported Icons | [View JSON List](https://l.habyby.net/logo?format=list) |
| Multiple Icons JSON | [Try Multiple Icons](https://l.habyby.net/logo?name=github,facebook,instagram,yahoo&format=json) |
| GitHub Repository | [lhabyby-icons-api](https://github.com/ehabest/lhabyby-icons-api) |

## Supported Icons

The API's published icon list currently contains **220 icons +**, according to the existing project documentation. The live API list is the best source for checking current availability.

[**View all supported icons in JSON →**](https://l.habyby.net/logo?format=list)

The API includes social media brands, developer tools, programming technologies, design tools, and other icon categories. Availability may change over time.

<!-- LOGOS_TABLE_START -->
<table>
  <thead>
    <tr>
      <th>Icon</th><th>Preview</th>
      <th>Icon</th><th>Preview</th>
      <th>Icon</th><th>Preview</th>
      <th>Icon</th><th>Preview</th>
    </tr>
  </thead>
  <tbody>
    <tr><td><code>500px</code></td><td><img src="https://l.habyby.net/images/social/svg/500px-logo-transparent.svg" width="30" alt="500px"></td><td><code>adminltr</code></td><td><img src="https://l.habyby.net/images/social/svg/adminltr-logo-transparent.svg" width="30" alt="adminltr"></td><td><code>adobe-acrobat</code></td><td><img src="https://l.habyby.net/images/social/svg/adobe-acrobat-logo-transparent.svg" width="30" alt="adobe-acrobat"></td><td><code>ajax</code></td><td><img src="https://l.habyby.net/images/social/svg/ajax-logo-transparent.svg" width="30" alt="ajax"></td></tr>
    <tr><td><code>android-studio</code></td><td><img src="https://l.habyby.net/images/social/svg/android-studio-logo-transparent.svg" width="30" alt="android-studio"></td><td><code>angular</code></td><td><img src="https://l.habyby.net/images/social/svg/angular-logo-transparent.svg" width="30" alt="angular"></td><td><code>appletv</code></td><td><img src="https://l.habyby.net/images/social/svg/appletv-logo-transparent.svg" width="30" alt="appletv"></td><td><code>askfm</code></td><td><img src="https://l.habyby.net/images/social/svg/askfm-logo-transparent.svg" width="30" alt="askfm"></td></tr>
    <tr><td><code>aspnet</code></td><td><img src="https://l.habyby.net/images/social/svg/aspnet-logo-transparent.svg" width="30" alt="aspnet"></td><td><code>aws</code></td><td><img src="https://l.habyby.net/images/social/svg/aws-logo-transparent.svg" width="30" alt="aws"></td><td><code>azure</code></td><td><img src="https://l.habyby.net/images/social/svg/azure-logo-transparent.svg" width="30" alt="azure"></td><td><code>badoo</code></td><td><img src="https://l.habyby.net/images/social/svg/badoo-logo-transparent.svg" width="30" alt="badoo"></td></tr>
    <tr><td><code>baidu-tieba</code></td><td><img src="https://l.habyby.net/images/social/svg/baidu-tieba-logo-transparent.svg" width="30" alt="baidu-tieba"></td><td><code>behance</code></td><td><img src="https://l.habyby.net/images/social/svg/behance-logo-transparent.svg" width="30" alt="behance"></td><td><code>bereal</code></td><td><img src="https://l.habyby.net/images/social/svg/bereal-logo-transparent.svg" width="30" alt="bereal"></td><td><code>blogger</code></td><td><img src="https://l.habyby.net/images/social/svg/blogger-logo-transparent.svg" width="30" alt="blogger"></td></tr>
    <tr><td><code>bookcrossing</code></td><td><img src="https://l.habyby.net/images/social/svg/bookcrossing-logo-transparent.svg" width="30" alt="bookcrossing"></td><td><code>bootstrap</code></td><td><img src="https://l.habyby.net/images/social/svg/bootstrap-logo-transparent.svg" width="30" alt="bootstrap"></td><td><code>bubbly</code></td><td><img src="https://l.habyby.net/images/social/svg/bubbly-logo-transparent.svg" width="30" alt="bubbly"></td><td><code>caffeine</code></td><td><img src="https://l.habyby.net/images/social/svg/caffeine-logo-transparent.svg" width="30" alt="caffeine"></td></tr>
    <tr><td><code>caringbridge</code></td><td><img src="https://l.habyby.net/images/social/svg/caringbridge-logo-transparent.svg" width="30" alt="caringbridge"></td><td><code>cloudflare</code></td><td><img src="https://l.habyby.net/images/social/svg/cloudflare-logo-transparent.svg" width="30" alt="cloudflare"></td><td><code>clubhouse</code></td><td><img src="https://l.habyby.net/images/social/svg/clubhouse-logo-transparent.svg" width="30" alt="clubhouse"></td><td><code>cms</code></td><td><img src="https://l.habyby.net/images/social/svg/cms-logo-transparent.svg" width="30" alt="cms"></td></tr>
    <tr><td><code>couchsurfing</code></td><td><img src="https://l.habyby.net/images/social/svg/couchsurfing-logo-transparent.svg" width="30" alt="couchsurfing"></td><td><code>cpp</code></td><td><img src="https://l.habyby.net/images/social/svg/cpp-logo-transparent.svg" width="30" alt="cpp"></td><td><code>cross-browser-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/cross-browser-testing-logo-transparent.svg" width="30" alt="cross-browser-testing"></td><td><code>crunchyroll</code></td><td><img src="https://l.habyby.net/images/social/svg/crunchyroll-logo-transparent.svg" width="30" alt="crunchyroll"></td></tr>
    <tr><td><code>csharp</code></td><td><img src="https://l.habyby.net/images/social/svg/csharp-logo-transparent.svg" width="30" alt="csharp"></td><td><code>css3</code></td><td><img src="https://l.habyby.net/images/social/svg/css3-logo-transparent.svg" width="30" alt="css3"></td><td><code>custom</code></td><td><img src="https://l.habyby.net/images/social/svg/custom-logo-transparent.svg" width="30" alt="custom"></td><td><code>cv</code></td><td><img src="https://l.habyby.net/images/social/svg/cv-logo-transparent.svg" width="30" alt="cv"></td></tr>
    <tr><td><code>cv-ehab</code></td><td><img src="https://l.habyby.net/images/social/svg/cv-ehab-logo-transparent.svg" width="30" alt="cv-ehab"></td><td><code>dailymotion</code></td><td><img src="https://l.habyby.net/images/social/svg/dailymotion-logo-transparent.svg" width="30" alt="dailymotion"></td><td><code>dart</code></td><td><img src="https://l.habyby.net/images/social/svg/dart-logo-transparent.svg" width="30" alt="dart"></td><td><code>databases-hosting</code></td><td><img src="https://l.habyby.net/images/social/svg/databases-hosting-logo-transparent.svg" width="30" alt="databases-hosting"></td></tr>
    <tr><td><code>default</code></td><td><img src="https://l.habyby.net/images/social/svg/default-logo-transparent.svg" width="30" alt="default"></td><td><code>default2</code></td><td><img src="https://l.habyby.net/images/social/svg/default2-logo-transparent.svg" width="30" alt="default2"></td><td><code>default3</code></td><td><img src="https://l.habyby.net/images/social/svg/default3-logo-transparent.svg" width="30" alt="default3"></td><td><code>default4</code></td><td><img src="https://l.habyby.net/images/social/svg/default4-logo-transparent.svg" width="30" alt="default4"></td></tr>
    <tr><td><code>default5</code></td><td><img src="https://l.habyby.net/images/social/svg/default5-logo-transparent.svg" width="30" alt="default5"></td><td><code>default6</code></td><td><img src="https://l.habyby.net/images/social/svg/default6-logo-transparent.svg" width="30" alt="default6"></td><td><code>design-multimedia</code></td><td><img src="https://l.habyby.net/images/social/svg/design-multimedia-logo-transparent.svg" width="30" alt="design-multimedia"></td><td><code>deviantart</code></td><td><img src="https://l.habyby.net/images/social/svg/deviantart-logo-transparent.svg" width="30" alt="deviantart"></td></tr>
    <tr><td><code>dibbble</code></td><td><img src="https://l.habyby.net/images/social/svg/dibbble-logo-transparent.svg" width="30" alt="dibbble"></td><td><code>discord</code></td><td><img src="https://l.habyby.net/images/social/svg/discord-logo-transparent.svg" width="30" alt="discord"></td><td><code>django</code></td><td><img src="https://l.habyby.net/images/social/svg/django-logo-transparent.svg" width="30" alt="django"></td><td><code>docker</code></td><td><img src="https://l.habyby.net/images/social/svg/docker-logo-transparent.svg" width="30" alt="docker"></td></tr>
    <tr><td><code>douban</code></td><td><img src="https://l.habyby.net/images/social/svg/douban-logo-transparent.svg" width="30" alt="douban"></td><td><code>dreamwidth</code></td><td><img src="https://l.habyby.net/images/social/svg/dreamwidth-logo-transparent.svg" width="30" alt="dreamwidth"></td><td><code>dropbox</code></td><td><img src="https://l.habyby.net/images/social/svg/dropbox-logo-transparent.svg" width="30" alt="dropbox"></td><td><code>ello</code></td><td><img src="https://l.habyby.net/images/social/svg/ello-logo-transparent.svg" width="30" alt="ello"></td></tr>
    <tr><td><code>elpha</code></td><td><img src="https://l.habyby.net/images/social/svg/elpha-logo-transparent.svg" width="30" alt="elpha"></td><td><code>email</code></td><td><img src="https://l.habyby.net/images/social/svg/email-logo-transparent.svg" width="30" alt="email"></td><td><code>excel</code></td><td><img src="https://l.habyby.net/images/social/svg/excel-logo-transparent.svg" width="30" alt="excel"></td><td><code>facebook</code></td><td><img src="https://l.habyby.net/images/social/svg/facebook-logo-transparent.svg" width="30" alt="facebook"></td></tr>
    <tr><td><code>figma</code></td><td><img src="https://l.habyby.net/images/social/svg/figma-logo-transparent.svg" width="30" alt="figma"></td><td><code>filmaffinity</code></td><td><img src="https://l.habyby.net/images/social/svg/filmaffinity-logo-transparent.svg" width="30" alt="filmaffinity"></td><td><code>filmora</code></td><td><img src="https://l.habyby.net/images/social/svg/filmora-logo-transparent.svg" width="30" alt="filmora"></td><td><code>firebase</code></td><td><img src="https://l.habyby.net/images/social/svg/firebase-logo-transparent.svg" width="30" alt="firebase"></td></tr>
    <tr><td><code>fiverr</code></td><td><img src="https://l.habyby.net/images/social/svg/fiverr-logo-transparent.svg" width="30" alt="fiverr"></td><td><code>flickr</code></td><td><img src="https://l.habyby.net/images/social/svg/flickr-logo-transparent.svg" width="30" alt="flickr"></td><td><code>flip</code></td><td><img src="https://l.habyby.net/images/social/svg/flip-logo-transparent.svg" width="30" alt="flip"></td><td><code>flutter</code></td><td><img src="https://l.habyby.net/images/social/svg/flutter-logo-transparent.svg" width="30" alt="flutter"></td></tr>
    <tr><td><code>foursquare</code></td><td><img src="https://l.habyby.net/images/social/svg/foursquare-logo-transparent.svg" width="30" alt="foursquare"></td><td><code>frameworks-optimization</code></td><td><img src="https://l.habyby.net/images/social/svg/frameworks-optimization-logo-transparent.svg" width="30" alt="frameworks-optimization"></td><td><code>functional-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/functional-testing-logo-transparent.svg" width="30" alt="functional-testing"></td><td><code>gab</code></td><td><img src="https://l.habyby.net/images/social/svg/gab-logo-transparent.svg" width="30" alt="gab"></td></tr>
    <tr><td><code>gaia-online</code></td><td><img src="https://l.habyby.net/images/social/svg/gaia-online-logo-transparent.svg" width="30" alt="gaia-online"></td><td><code>giphy</code></td><td><img src="https://l.habyby.net/images/social/svg/giphy-logo-transparent.svg" width="30" alt="giphy"></td><td><code>git</code></td><td><img src="https://l.habyby.net/images/social/svg/git-logo-transparent.svg" width="30" alt="git"></td><td><code>github</code></td><td><img src="https://l.habyby.net/images/social/svg/github-logo-transparent.svg" width="30" alt="github"></td></tr>
    <tr><td><code>gmail</code></td><td><img src="https://l.habyby.net/images/social/svg/gmail-logo-transparent.svg" width="30" alt="gmail"></td><td><code>goodreads</code></td><td><img src="https://l.habyby.net/images/social/svg/goodreads-logo-transparent.svg" width="30" alt="goodreads"></td><td><code>google-ads</code></td><td><img src="https://l.habyby.net/images/social/svg/google-ads-logo-transparent.svg" width="30" alt="google-ads"></td><td><code>google-analytics</code></td><td><img src="https://l.habyby.net/images/social/svg/google-analytics-logo-transparent.svg" width="30" alt="google-analytics"></td></tr>
    <tr><td><code>habyby</code></td><td><img src="https://l.habyby.net/images/social/svg/habyby-logo-transparent.svg" width="30" alt="habyby"></td><td><code>hangout</code></td><td><img src="https://l.habyby.net/images/social/svg/hangout-logo-transparent.svg" width="30" alt="hangout"></td><td><code>houseparty</code></td><td><img src="https://l.habyby.net/images/social/svg/houseparty-logo-transparent.svg" width="30" alt="houseparty"></td><td><code>html5</code></td><td><img src="https://l.habyby.net/images/social/svg/html5-logo-transparent.svg" width="30" alt="html5"></td></tr>
    <tr><td><code>illustrator</code></td><td><img src="https://l.habyby.net/images/social/svg/illustrator-logo-transparent.svg" width="30" alt="illustrator"></td><td><code>imdb</code></td><td><img src="https://l.habyby.net/images/social/svg/imdb-logo-transparent.svg" width="30" alt="imdb"></td><td><code>imgur</code></td><td><img src="https://l.habyby.net/images/social/svg/imgur-logo-transparent.svg" width="30" alt="imgur"></td><td><code>influenster</code></td><td><img src="https://l.habyby.net/images/social/svg/influenster-logo-transparent.svg" width="30" alt="influenster"></td></tr>
    <tr><td><code>instagram</code></td><td><img src="https://l.habyby.net/images/social/svg/instagram-logo-transparent.svg" width="30" alt="instagram"></td><td><code>internations</code></td><td><img src="https://l.habyby.net/images/social/svg/internations-logo-transparent.svg" width="30" alt="internations"></td><td><code>italki</code></td><td><img src="https://l.habyby.net/images/social/svg/italki-logo-transparent.svg" width="30" alt="italki"></td><td><code>java</code></td><td><img src="https://l.habyby.net/images/social/svg/java-logo-transparent.svg" width="30" alt="java"></td></tr>
    <tr><td><code>javascript</code></td><td><img src="https://l.habyby.net/images/social/svg/javascript-logo-transparent.svg" width="30" alt="javascript"></td><td><code>jira</code></td><td><img src="https://l.habyby.net/images/social/svg/jira-logo-transparent.svg" width="30" alt="jira"></td><td><code>jquery</code></td><td><img src="https://l.habyby.net/images/social/svg/jquery-logo-transparent.svg" width="30" alt="jquery"></td><td><code>json</code></td><td><img src="https://l.habyby.net/images/social/svg/json-logo-transparent.svg" width="30" alt="json"></td></tr>
    <tr><td><code>ko-fi</code></td><td><img src="https://l.habyby.net/images/social/svg/ko-fi-logo-transparent.svg" width="30" alt="ko-fi"></td><td><code>kotlin</code></td><td><img src="https://l.habyby.net/images/social/svg/kotlin-logo-transparent.svg" width="30" alt="kotlin"></td><td><code>kuaishou</code></td><td><img src="https://l.habyby.net/images/social/svg/kuaishou-logo-transparent.svg" width="30" alt="kuaishou"></td><td><code>kubernetes</code></td><td><img src="https://l.habyby.net/images/social/svg/kubernetes-logo-transparent.svg" width="30" alt="kubernetes"></td></tr>
    <tr><td><code>laravel</code></td><td><img src="https://l.habyby.net/images/social/svg/laravel-logo-transparent.svg" width="30" alt="laravel"></td><td><code>lhabyby</code></td><td><img src="https://l.habyby.net/images/social/svg/Lhabyby-logo-transparent.svg" width="30" alt="lhabyby"></td><td><code>librarything</code></td><td><img src="https://l.habyby.net/images/social/svg/librarything-logo-transparent.svg" width="30" alt="librarything"></td><td><code>likee</code></td><td><img src="https://l.habyby.net/images/social/svg/likee-logo-transparent.svg" width="30" alt="likee"></td></tr>
    <tr><td><code>line</code></td><td><img src="https://l.habyby.net/images/social/svg/line-logo-transparent.svg" width="30" alt="line"></td><td><code>linkedin</code></td><td><img src="https://l.habyby.net/images/social/svg/linkedin-logo-transparent.svg" width="30" alt="linkedin"></td><td><code>linktree</code></td><td><img src="https://l.habyby.net/images/social/svg/linktree-logo-transparent.svg" width="30" alt="linktree"></td><td><code>linux</code></td><td><img src="https://l.habyby.net/images/social/svg/linux-logo-transparent.svg" width="30" alt="linux"></td></tr>
    <tr><td><code>livejournal</code></td><td><img src="https://l.habyby.net/images/social/svg/livejournal-logo-transparent.svg" width="30" alt="livejournal"></td><td><code>logo-design</code></td><td><img src="https://l.habyby.net/images/social/svg/logo-design-logo-transparent.svg" width="30" alt="logo-design"></td><td><code>medium</code></td><td><img src="https://l.habyby.net/images/social/svg/medium-logo-transparent.svg" width="30" alt="medium"></td><td><code>meetme</code></td><td><img src="https://l.habyby.net/images/social/svg/meetme-logo-transparent.svg" width="30" alt="meetme"></td></tr>
    <tr><td><code>meetup</code></td><td><img src="https://l.habyby.net/images/social/svg/meetup-logo-transparent.svg" width="30" alt="meetup"></td><td><code>messenger</code></td><td><img src="https://l.habyby.net/images/social/svg/messenger-logo-transparent.svg" width="30" alt="messenger"></td><td><code>mewe</code></td><td><img src="https://l.habyby.net/images/social/svg/mewe-logo-transparent.svg" width="30" alt="mewe"></td><td><code>microsoft-office</code></td><td><img src="https://l.habyby.net/images/social/svg/microsoft-office-logo-transparent.svg" width="30" alt="microsoft-office"></td></tr>
    <tr><td><code>mix</code></td><td><img src="https://l.habyby.net/images/social/svg/mix-logo-transparent.svg" width="30" alt="mix"></td><td><code>mixi</code></td><td><img src="https://l.habyby.net/images/social/svg/mixi-logo-transparent.svg" width="30" alt="mixi"></td><td><code>mocospace</code></td><td><img src="https://l.habyby.net/images/social/svg/mocospace-logo-transparent.svg" width="30" alt="mocospace"></td><td><code>mongodb</code></td><td><img src="https://l.habyby.net/images/social/svg/mongodb-logo-transparent.svg" width="30" alt="mongodb"></td></tr>
    <tr><td><code>myheritage</code></td><td><img src="https://l.habyby.net/images/social/svg/myheritage-logo-transparent.svg" width="30" alt="myheritage"></td><td><code>myspace</code></td><td><img src="https://l.habyby.net/images/social/svg/myspace-logo-transparent.svg" width="30" alt="myspace"></td><td><code>mysql</code></td><td><img src="https://l.habyby.net/images/social/svg/mysql-logo-transparent.svg" width="30" alt="mysql"></td><td><code>netflix</code></td><td><img src="https://l.habyby.net/images/social/svg/netflix-logo-transparent.svg" width="30" alt="netflix"></td></tr>
    <tr><td><code>netlify</code></td><td><img src="https://l.habyby.net/images/social/svg/netlify-logo-transparent.svg" width="30" alt="netlify"></td><td><code>nextdoor</code></td><td><img src="https://l.habyby.net/images/social/svg/nextdoor-logo-transparent.svg" width="30" alt="nextdoor"></td><td><code>nextjs</code></td><td><img src="https://l.habyby.net/images/social/svg/nextjs-logo-transparent.svg" width="30" alt="nextjs"></td><td><code>nodejs</code></td><td><img src="https://l.habyby.net/images/social/svg/nodejs-logo-transparent.svg" width="30" alt="nodejs"></td></tr>
    <tr><td><code>opendiary</code></td><td><img src="https://l.habyby.net/images/social/svg/opendiary-logo-transparent.svg" width="30" alt="opendiary"></td><td><code>patreon</code></td><td><img src="https://l.habyby.net/images/social/svg/patreon-logo-transparent.svg" width="30" alt="patreon"></td><td><code>pdf</code></td><td><img src="https://l.habyby.net/images/social/svg/pdf-logo-transparent.svg" width="30" alt="pdf"></td><td><code>peanut</code></td><td><img src="https://l.habyby.net/images/social/svg/peanut-logo-transparent.svg" width="30" alt="peanut"></td></tr>
    <tr><td><code>performance-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/performance-testing-logo-transparent.svg" width="30" alt="performance-testing"></td><td><code>periscope</code></td><td><img src="https://l.habyby.net/images/social/svg/periscope-logo-transparent.svg" width="30" alt="periscope"></td><td><code>phone</code></td><td><img src="https://l.habyby.net/images/social/svg/phone-logo-transparent.svg" width="30" alt="phone"></td><td><code>photoshop</code></td><td><img src="https://l.habyby.net/images/social/svg/photoshop-logo-transparent.svg" width="30" alt="photoshop"></td></tr>
    <tr><td><code>php</code></td><td><img src="https://l.habyby.net/images/social/svg/php-logo-transparent.svg" width="30" alt="php"></td><td><code>phpmyadmin</code></td><td><img src="https://l.habyby.net/images/social/svg/phpmyadmin-logo-transparent.svg" width="30" alt="phpmyadmin"></td><td><code>pinterest</code></td><td><img src="https://l.habyby.net/images/social/svg/pinterest-logo-transparent.svg" width="30" alt="pinterest"></td><td><code>popbase</code></td><td><img src="https://l.habyby.net/images/social/svg/popbase-logo-transparent.svg" width="30" alt="popbase"></td></tr>
    <tr><td><code>portfolio</code></td><td><img src="https://l.habyby.net/images/social/svg/portfolio-logo-transparent.svg" width="30" alt="portfolio"></td><td><code>postgreesql</code></td><td><img src="https://l.habyby.net/images/social/svg/postgreesql-logo-transparent.svg" width="30" alt="postgreesql"></td><td><code>postman</code></td><td><img src="https://l.habyby.net/images/social/svg/postman-logo-transparent.svg" width="30" alt="postman"></td><td><code>powerpoint</code></td><td><img src="https://l.habyby.net/images/social/svg/powerpoint-logo-transparent.svg" width="30" alt="powerpoint"></td></tr>
    <tr><td><code>primevideo</code></td><td><img src="https://l.habyby.net/images/social/svg/primevideo-logo-transparent.svg" width="30" alt="primevideo"></td><td><code>python</code></td><td><img src="https://l.habyby.net/images/social/svg/python-logo-transparent.svg" width="30" alt="python"></td><td><code>qq</code></td><td><img src="https://l.habyby.net/images/social/svg/qq-logo-transparent.svg" width="30" alt="qq"></td><td><code>quora</code></td><td><img src="https://l.habyby.net/images/social/svg/quora-logo-transparent.svg" width="30" alt="quora"></td></tr>
    <tr><td><code>qzone</code></td><td><img src="https://l.habyby.net/images/social/svg/qzone-logo-transparent.svg" width="30" alt="qzone"></td><td><code>ravelry</code></td><td><img src="https://l.habyby.net/images/social/svg/ravelry-logo-transparent.svg" width="30" alt="ravelry"></td><td><code>react</code></td><td><img src="https://l.habyby.net/images/social/svg/react-logo-transparent.svg" width="30" alt="react"></td><td><code>reddit</code></td><td><img src="https://l.habyby.net/images/social/svg/reddit-logo-transparent.svg" width="30" alt="reddit"></td></tr>
    <tr><td><code>redis</code></td><td><img src="https://l.habyby.net/images/social/svg/redis-logo-transparent.svg" width="30" alt="redis"></td><td><code>redux</code></td><td><img src="https://l.habyby.net/images/social/svg/redux-logo-transparent.svg" width="30" alt="redux"></td><td><code>renren</code></td><td><img src="https://l.habyby.net/images/social/svg/renren-logo-transparent.svg" width="30" alt="renren"></td><td><code>responsive-design</code></td><td><img src="https://l.habyby.net/images/social/svg/responsive-design-logo-transparent.svg" width="30" alt="responsive-design"></td></tr>
    <tr><td><code>rss</code></td><td><img src="https://l.habyby.net/images/social/svg/rss-logo-transparent.svg" width="30" alt="rss"></td><td><code>rumble</code></td><td><img src="https://l.habyby.net/images/social/svg/rumble-logo-transparent.svg" width="30" alt="rumble"></td><td><code>sass</code></td><td><img src="https://l.habyby.net/images/social/svg/sass-logo-transparent.svg" width="30" alt="sass"></td><td><code>selenium</code></td><td><img src="https://l.habyby.net/images/social/svg/selenium-logo-transparent.svg" width="30" alt="selenium"></td></tr>
    <tr><td><code>shahid</code></td><td><img src="https://l.habyby.net/images/social/svg/shahid-logo-transparent.svg" width="30" alt="shahid"></td><td><code>sharechat</code></td><td><img src="https://l.habyby.net/images/social/svg/sharechat-logo-transparent.svg" width="30" alt="sharechat"></td><td><code>shopify</code></td><td><img src="https://l.habyby.net/images/social/svg/shopify-logo-transparent.svg" width="30" alt="shopify"></td><td><code>sketchfab</code></td><td><img src="https://l.habyby.net/images/social/svg/sketchfab-logo-transparent.svg" width="30" alt="sketchfab"></td></tr>
    <tr><td><code>skype</code></td><td><img src="https://l.habyby.net/images/social/svg/skype-logo-transparent.svg" width="30" alt="skype"></td><td><code>snapchat</code></td><td><img src="https://l.habyby.net/images/social/svg/snapchat-logo-transparent.svg" width="30" alt="snapchat"></td><td><code>social-media-seo</code></td><td><img src="https://l.habyby.net/images/social/svg/social-media-seo-logo-transparent.svg" width="30" alt="social-media-seo"></td><td><code>social-media-sharing</code></td><td><img src="https://l.habyby.net/images/social/svg/social-media-sharing-logo-transparent.svg" width="30" alt="social-media-sharing"></td></tr>
    <tr><td><code>soundcloud</code></td><td><img src="https://l.habyby.net/images/social/svg/soundcloud-logo-transparent.svg" width="30" alt="soundcloud"></td><td><code>spotify</code></td><td><img src="https://l.habyby.net/images/social/svg/spotify-logo-transparent.svg" width="30" alt="spotify"></td><td><code>spreely</code></td><td><img src="https://l.habyby.net/images/social/svg/spreely-logo-transparent.svg" width="30" alt="spreely"></td><td><code>spring</code></td><td><img src="https://l.habyby.net/images/social/svg/spring-logo-transparent.svg" width="30" alt="spring"></td></tr>
    <tr><td><code>stackoverflow</code></td><td><img src="https://l.habyby.net/images/social/svg/stackoverflow-logo-transparent.svg" width="30" alt="stackoverflow"></td><td><code>steam</code></td><td><img src="https://l.habyby.net/images/social/svg/steam-logo-transparent.svg" width="30" alt="steam"></td><td><code>steemit</code></td><td><img src="https://l.habyby.net/images/social/svg/steemit-logo-transparent.svg" width="30" alt="steemit"></td><td><code>swift</code></td><td><img src="https://l.habyby.net/images/social/svg/swift-logo-transparent.svg" width="30" alt="swift"></td></tr>
    <tr><td><code>tagged</code></td><td><img src="https://l.habyby.net/images/social/svg/tagged-logo-transparent.svg" width="30" alt="tagged"></td><td><code>tailwind</code></td><td><img src="https://l.habyby.net/images/social/svg/tailwind-logo-transparent.svg" width="30" alt="tailwind"></td><td><code>taringa</code></td><td><img src="https://l.habyby.net/images/social/svg/taringa-logo-transparent.svg" width="30" alt="taringa"></td><td><code>teams</code></td><td><img src="https://l.habyby.net/images/social/svg/teams-logo-transparent.svg" width="30" alt="teams"></td></tr>
    <tr><td><code>telegram</code></td><td><img src="https://l.habyby.net/images/social/svg/telegram-logo-transparent.svg" width="30" alt="telegram"></td><td><code>testing</code></td><td><img src="https://l.habyby.net/images/social/svg/testing-logo-transparent.svg" width="30" alt="testing"></td><td><code>the-dots</code></td><td><img src="https://l.habyby.net/images/social/svg/the-dots-logo-transparent.svg" width="30" alt="the-dots"></td><td><code>tiktok</code></td><td><img src="https://l.habyby.net/images/social/svg/tiktok-logo-transparent.svg" width="30" alt="tiktok"></td></tr>
    <tr><td><code>tinder</code></td><td><img src="https://l.habyby.net/images/social/svg/tinder-logo-transparent.svg" width="30" alt="tinder"></td><td><code>tout</code></td><td><img src="https://l.habyby.net/images/social/svg/tout-logo-transparent.svg" width="30" alt="tout"></td><td><code>tribe</code></td><td><img src="https://l.habyby.net/images/social/svg/tribe-logo-transparent.svg" width="30" alt="tribe"></td><td><code>triller</code></td><td><img src="https://l.habyby.net/images/social/svg/triller-logo-transparent.svg" width="30" alt="triller"></td></tr>
    <tr><td><code>tumblr</code></td><td><img src="https://l.habyby.net/images/social/svg/tumblr-logo-transparent.svg" width="30" alt="tumblr"></td><td><code>twitch</code></td><td><img src="https://l.habyby.net/images/social/svg/twitch-logo-transparent.svg" width="30" alt="twitch"></td><td><code>twitter</code></td><td><img src="https://l.habyby.net/images/social/svg/twitter-logo-transparent.svg" width="30" alt="twitter"></td><td><code>typescript</code></td><td><img src="https://l.habyby.net/images/social/svg/typescript-logo-transparent.svg" width="30" alt="typescript"></td></tr>
    <tr><td><code>ui-ux-design</code></td><td><img src="https://l.habyby.net/images/social/svg/ui-ux-design-logo-transparent.svg" width="30" alt="ui-ux-design"></td><td><code>user-acceptance-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/user-acceptance-testing-logo-transparent.svg" width="30" alt="user-acceptance-testing"></td><td><code>valence</code></td><td><img src="https://l.habyby.net/images/social/svg/valence-logo-transparent.svg" width="30" alt="valence"></td><td><code>vercel</code></td><td><img src="https://l.habyby.net/images/social/svg/vercel-logo-transparent.svg" width="30" alt="vercel"></td></tr>
    <tr><td><code>vero</code></td><td><img src="https://l.habyby.net/images/social/svg/vero-logo-transparent.svg" width="30" alt="vero"></td><td><code>viadeo</code></td><td><img src="https://l.habyby.net/images/social/svg/viadeo-logo-transparent.svg" width="30" alt="viadeo"></td><td><code>viber</code></td><td><img src="https://l.habyby.net/images/social/svg/viber-logo-transparent.svg" width="30" alt="viber"></td><td><code>video</code></td><td><img src="https://l.habyby.net/images/social/svg/video-logo-transparent.svg" width="30" alt="video"></td></tr>
    <tr><td><code>videocv</code></td><td><img src="https://l.habyby.net/images/social/svg/videocv-logo-transparent.svg" width="30" alt="videocv"></td><td><code>vimeo</code></td><td><img src="https://l.habyby.net/images/social/svg/vimeo-logo-transparent.svg" width="30" alt="vimeo"></td><td><code>vk</code></td><td><img src="https://l.habyby.net/images/social/svg/vk-logo-transparent.svg" width="30" alt="vk"></td><td><code>vscode</code></td><td><img src="https://l.habyby.net/images/social/svg/vscode-logo-transparent.svg" width="30" alt="vscode"></td></tr>
    <tr><td><code>vuejs</code></td><td><img src="https://l.habyby.net/images/social/svg/vuejs-logo-transparent.svg" width="30" alt="vuejs"></td><td><code>wamp</code></td><td><img src="https://l.habyby.net/images/social/svg/wamp-logo-transparent.svg" width="30" alt="wamp"></td><td><code>wattpad</code></td><td><img src="https://l.habyby.net/images/social/svg/wattpad-logo-transparent.svg" width="30" alt="wattpad"></td><td><code>web-hosting</code></td><td><img src="https://l.habyby.net/images/social/svg/web-hosting-logo-transparent.svg" width="30" alt="web-hosting"></td></tr>
    <tr><td><code>wechat</code></td><td><img src="https://l.habyby.net/images/social/svg/wechat-logo-transparent.svg" width="30" alt="wechat"></td><td><code>weheartit</code></td><td><img src="https://l.habyby.net/images/social/svg/weheartit-logo-transparent.svg" width="30" alt="weheartit"></td><td><code>weibo</code></td><td><img src="https://l.habyby.net/images/social/svg/weibo-logo-transparent.svg" width="30" alt="weibo"></td><td><code>whatsapp</code></td><td><img src="https://l.habyby.net/images/social/svg/whatsapp-logo-transparent.svg" width="30" alt="whatsapp"></td></tr>
    <tr><td><code>wix</code></td><td><img src="https://l.habyby.net/images/social/svg/wix-logo-transparent.svg" width="30" alt="wix"></td><td><code>word</code></td><td><img src="https://l.habyby.net/images/social/svg/word-logo-transparent.svg" width="30" alt="word"></td><td><code>wordpress</code></td><td><img src="https://l.habyby.net/images/social/svg/wordpress-logo-transparent.svg" width="30" alt="wordpress"></td><td><code>wt-social</code></td><td><img src="https://l.habyby.net/images/social/svg/wt-social-logo-transparent.svg" width="30" alt="wt-social"></td></tr>
    <tr><td><code>x</code></td><td><img src="https://l.habyby.net/images/social/svg/x-logo-transparent.svg" width="30" alt="x"></td><td><code>xcode</code></td><td><img src="https://l.habyby.net/images/social/svg/xcode-logo-transparent.svg" width="30" alt="xcode"></td><td><code>xing</code></td><td><img src="https://l.habyby.net/images/social/svg/xing-logo-transparent.svg" width="30" alt="xing"></td><td><code>xml</code></td><td><img src="https://l.habyby.net/images/social/svg/xml-logo-transparent.svg" width="30" alt="xml"></td></tr>
    <tr><td><code>yahoo</code></td><td><img src="https://l.habyby.net/images/social/svg/yahoo-logo-transparent.svg" width="30" alt="yahoo"></td><td><code>youtube</code></td><td><img src="https://l.habyby.net/images/social/svg/youtube-logo-transparent.svg" width="30" alt="youtube"></td><td><code>yubo</code></td><td><img src="https://l.habyby.net/images/social/svg/yubo-logo-transparent.svg" width="30" alt="yubo"></td><td><code>yy</code></td><td><img src="https://l.habyby.net/images/social/svg/yy-logo-transparent.svg" width="30" alt="yy"></td></tr>
  </tbody>
</table>
<!-- LOGOS_TABLE_END -->

## About

LHabyby Icons API is a developer resource for retrieving supported SVG logos through a simple web API.

Created by **Eng. Ihab Elkady**.

Website: [https://ihab.habyby.net/](https://ihab.habyby.net/)

---

**Trademark notice:** Third-party logos and brand names belong to their respective owners. Their use may be subject to each owner's trademark and usage requirements.
