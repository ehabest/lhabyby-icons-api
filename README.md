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

The API's published icon list currently contains **522 icons +**, according to the existing project documentation. The live API list is the best source for checking current availability.

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
    <tr><td><code>500px</code></td><td><img src="https://l.habyby.net/images/social/svg/500px-logo-transparent.svg" width="30" alt="500px"></td><td><code>ableton</code></td><td><img src="https://l.habyby.net/images/social/svg/ableton-logo-transparent.svg" width="30" alt="ableton"></td><td><code>account</code></td><td><img src="https://l.habyby.net/images/social/svg/account-logo-transparent.svg" width="30" alt="account"></td><td><code>activitypub</code></td><td><img src="https://l.habyby.net/images/social/svg/activitypub-logo-transparent.svg" width="30" alt="activitypub"></td></tr>
    <tr><td><code>actix</code></td><td><img src="https://l.habyby.net/images/social/svg/actix-logo-transparent.svg" width="30" alt="actix"></td><td><code>adminltr</code></td><td><img src="https://l.habyby.net/images/social/svg/adminltr-logo-transparent.svg" width="30" alt="adminltr"></td><td><code>adobe-acrobat</code></td><td><img src="https://l.habyby.net/images/social/svg/adobe-acrobat-logo-transparent.svg" width="30" alt="adobe-acrobat"></td><td><code>adobe-audition</code></td><td><img src="https://l.habyby.net/images/social/svg/adobe-audition-logo-transparent.svg" width="30" alt="adobe-audition"></td></tr>
    <tr><td><code>adonis</code></td><td><img src="https://l.habyby.net/images/social/svg/adonis-logo-transparent.svg" width="30" alt="adonis"></td><td><code>after-effects</code></td><td><img src="https://l.habyby.net/images/social/svg/after-effects-logo-transparent.svg" width="30" alt="after-effects"></td><td><code>agentic</code></td><td><img src="https://l.habyby.net/images/social/svg/agentic-logo-transparent.svg" width="30" alt="agentic"></td><td><code>ai</code></td><td><img src="https://l.habyby.net/images/social/svg/ai-logo-transparent.svg" width="30" alt="ai"></td></tr>
    <tr><td><code>ajax</code></td><td><img src="https://l.habyby.net/images/social/svg/ajax-logo-transparent.svg" width="30" alt="ajax"></td><td><code>alpinejs</code></td><td><img src="https://l.habyby.net/images/social/svg/alpinejs-logo-transparent.svg" width="30" alt="alpinejs"></td><td><code>anaconda</code></td><td><img src="https://l.habyby.net/images/social/svg/anaconda-logo-transparent.svg" width="30" alt="anaconda"></td><td><code>android</code></td><td><img src="https://l.habyby.net/images/social/svg/android-logo-transparent.svg" width="30" alt="android"></td></tr>
    <tr><td><code>android-studio</code></td><td><img src="https://l.habyby.net/images/social/svg/android-studio-logo-transparent.svg" width="30" alt="android-studio"></td><td><code>angular</code></td><td><img src="https://l.habyby.net/images/social/svg/angular-logo-transparent.svg" width="30" alt="angular"></td><td><code>ansible</code></td><td><img src="https://l.habyby.net/images/social/svg/ansible-logo-transparent.svg" width="30" alt="ansible"></td><td><code>apache</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-logo-transparent.svg" width="30" alt="apache"></td></tr>
    <tr><td><code>apache-cassandra</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-cassandra-logo-transparent.svg" width="30" alt="apache-cassandra"></td><td><code>apache-hadoop</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-hadoop-logo-transparent.svg" width="30" alt="apache-hadoop"></td><td><code>apache-jmeter</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-jmeter-logo-transparent.svg" width="30" alt="apache-jmeter"></td><td><code>apache-kafka</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-kafka-logo-transparent.svg" width="30" alt="apache-kafka"></td></tr>
    <tr><td><code>apache-maven</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-maven-logo-transparent.svg" width="30" alt="apache-maven"></td><td><code>apache-spark</code></td><td><img src="https://l.habyby.net/images/social/svg/apache-spark-logo-transparent.svg" width="30" alt="apache-spark"></td><td><code>api</code></td><td><img src="https://l.habyby.net/images/social/svg/api-logo-transparent.svg" width="30" alt="api"></td><td><code>apollo</code></td><td><img src="https://l.habyby.net/images/social/svg/apollo-logo-transparent.svg" width="30" alt="apollo"></td></tr>
    <tr><td><code>appletv</code></td><td><img src="https://l.habyby.net/images/social/svg/appletv-logo-transparent.svg" width="30" alt="appletv"></td><td><code>appwrite</code></td><td><img src="https://l.habyby.net/images/social/svg/appwrite-logo-transparent.svg" width="30" alt="appwrite"></td><td><code>arch</code></td><td><img src="https://l.habyby.net/images/social/svg/arch-logo-transparent.svg" width="30" alt="arch"></td><td><code>arduino</code></td><td><img src="https://l.habyby.net/images/social/svg/arduino-logo-transparent.svg" width="30" alt="arduino"></td></tr>
    <tr><td><code>argo-cd</code></td><td><img src="https://l.habyby.net/images/social/svg/argo-cd-logo-transparent.svg" width="30" alt="argo-cd"></td><td><code>askfm</code></td><td><img src="https://l.habyby.net/images/social/svg/askfm-logo-transparent.svg" width="30" alt="askfm"></td><td><code>aspnet</code></td><td><img src="https://l.habyby.net/images/social/svg/aspnet-logo-transparent.svg" width="30" alt="aspnet"></td><td><code>assembly</code></td><td><img src="https://l.habyby.net/images/social/svg/assembly-logo-transparent.svg" width="30" alt="assembly"></td></tr>
    <tr><td><code>astro</code></td><td><img src="https://l.habyby.net/images/social/svg/astro-logo-transparent.svg" width="30" alt="astro"></td><td><code>atom</code></td><td><img src="https://l.habyby.net/images/social/svg/atom-logo-transparent.svg" width="30" alt="atom"></td><td><code>attachment</code></td><td><img src="https://l.habyby.net/images/social/svg/attachment-logo-transparent.svg" width="30" alt="attachment"></td><td><code>audio</code></td><td><img src="https://l.habyby.net/images/social/svg/audio-logo-transparent.svg" width="30" alt="audio"></td></tr>
    <tr><td><code>auth</code></td><td><img src="https://l.habyby.net/images/social/svg/auth-logo-transparent.svg" width="30" alt="auth"></td><td><code>auth-rbac</code></td><td><img src="https://l.habyby.net/images/social/svg/auth-rbac-logo-transparent.svg" width="30" alt="auth-rbac"></td><td><code>autocad</code></td><td><img src="https://l.habyby.net/images/social/svg/autocad-logo-transparent.svg" width="30" alt="autocad"></td><td><code>automation</code></td><td><img src="https://l.habyby.net/images/social/svg/automation-logo-transparent.svg" width="30" alt="automation"></td></tr>
    <tr><td><code>aws</code></td><td><img src="https://l.habyby.net/images/social/svg/aws-logo-transparent.svg" width="30" alt="aws"></td><td><code>azul-system</code></td><td><img src="https://l.habyby.net/images/social/svg/azul-system-logo-transparent.svg" width="30" alt="azul-system"></td><td><code>azure</code></td><td><img src="https://l.habyby.net/images/social/svg/azure-logo-transparent.svg" width="30" alt="azure"></td><td><code>babel</code></td><td><img src="https://l.habyby.net/images/social/svg/babel-logo-transparent.svg" width="30" alt="babel"></td></tr>
    <tr><td><code>backend</code></td><td><img src="https://l.habyby.net/images/social/svg/backend-logo-transparent.svg" width="30" alt="backend"></td><td><code>badoo</code></td><td><img src="https://l.habyby.net/images/social/svg/badoo-logo-transparent.svg" width="30" alt="badoo"></td><td><code>baidu-tieba</code></td><td><img src="https://l.habyby.net/images/social/svg/baidu-tieba-logo-transparent.svg" width="30" alt="baidu-tieba"></td><td><code>bash</code></td><td><img src="https://l.habyby.net/images/social/svg/bash-logo-transparent.svg" width="30" alt="bash"></td></tr>
    <tr><td><code>behance</code></td><td><img src="https://l.habyby.net/images/social/svg/behance-logo-transparent.svg" width="30" alt="behance"></td><td><code>bereal</code></td><td><img src="https://l.habyby.net/images/social/svg/bereal-logo-transparent.svg" width="30" alt="bereal"></td><td><code>bevy</code></td><td><img src="https://l.habyby.net/images/social/svg/bevy-logo-transparent.svg" width="30" alt="bevy"></td><td><code>bitbucket</code></td><td><img src="https://l.habyby.net/images/social/svg/bitbucket-logo-transparent.svg" width="30" alt="bitbucket"></td></tr>
    <tr><td><code>blade</code></td><td><img src="https://l.habyby.net/images/social/svg/blade-logo-transparent.svg" width="30" alt="blade"></td><td><code>blender</code></td><td><img src="https://l.habyby.net/images/social/svg/blender-logo-transparent.svg" width="30" alt="blender"></td><td><code>blog</code></td><td><img src="https://l.habyby.net/images/social/svg/blog-logo-transparent.svg" width="30" alt="blog"></td><td><code>blogger</code></td><td><img src="https://l.habyby.net/images/social/svg/blogger-logo-transparent.svg" width="30" alt="blogger"></td></tr>
    <tr><td><code>bookcrossing</code></td><td><img src="https://l.habyby.net/images/social/svg/bookcrossing-logo-transparent.svg" width="30" alt="bookcrossing"></td><td><code>bookmark</code></td><td><img src="https://l.habyby.net/images/social/svg/bookmark-logo-transparent.svg" width="30" alt="bookmark"></td><td><code>bootstrap</code></td><td><img src="https://l.habyby.net/images/social/svg/bootstrap-logo-transparent.svg" width="30" alt="bootstrap"></td><td><code>bot</code></td><td><img src="https://l.habyby.net/images/social/svg/bot-logo-transparent.svg" width="30" alt="bot"></td></tr>
    <tr><td><code>bsd</code></td><td><img src="https://l.habyby.net/images/social/svg/bsd-logo-transparent.svg" width="30" alt="bsd"></td><td><code>bubbly</code></td><td><img src="https://l.habyby.net/images/social/svg/bubbly-logo-transparent.svg" width="30" alt="bubbly"></td><td><code>bun</code></td><td><img src="https://l.habyby.net/images/social/svg/bun-logo-transparent.svg" width="30" alt="bun"></td><td><code>c</code></td><td><img src="https://l.habyby.net/images/social/svg/c-logo-transparent.svg" width="30" alt="c"></td></tr>
    <tr><td><code>cache</code></td><td><img src="https://l.habyby.net/images/social/svg/cache-logo-transparent.svg" width="30" alt="cache"></td><td><code>caffeine</code></td><td><img src="https://l.habyby.net/images/social/svg/caffeine-logo-transparent.svg" width="30" alt="caffeine"></td><td><code>canva</code></td><td><img src="https://l.habyby.net/images/social/svg/canva-logo-transparent.svg" width="30" alt="canva"></td><td><code>caringbridge</code></td><td><img src="https://l.habyby.net/images/social/svg/caringbridge-logo-transparent.svg" width="30" alt="caringbridge"></td></tr>
    <tr><td><code>celery</code></td><td><img src="https://l.habyby.net/images/social/svg/celery-logo-transparent.svg" width="30" alt="celery"></td><td><code>chatbot</code></td><td><img src="https://l.habyby.net/images/social/svg/chatbot-logo-transparent.svg" width="30" alt="chatbot"></td><td><code>chrome</code></td><td><img src="https://l.habyby.net/images/social/svg/chrome-logo-transparent.svg" width="30" alt="chrome"></td><td><code>ci-cd</code></td><td><img src="https://l.habyby.net/images/social/svg/ci-cd-logo-transparent.svg" width="30" alt="ci-cd"></td></tr>
    <tr><td><code>clarity</code></td><td><img src="https://l.habyby.net/images/social/svg/clarity-logo-transparent.svg" width="30" alt="clarity"></td><td><code>claude-ai</code></td><td><img src="https://l.habyby.net/images/social/svg/claude-ai-logo-transparent.svg" width="30" alt="claude-ai"></td><td><code>cli</code></td><td><img src="https://l.habyby.net/images/social/svg/cli-logo-transparent.svg" width="30" alt="cli"></td><td><code>clion</code></td><td><img src="https://l.habyby.net/images/social/svg/clion-logo-transparent.svg" width="30" alt="clion"></td></tr>
    <tr><td><code>cln</code></td><td><img src="https://l.habyby.net/images/social/svg/cln-logo-transparent.svg" width="30" alt="cln"></td><td><code>clojure</code></td><td><img src="https://l.habyby.net/images/social/svg/clojure-logo-transparent.svg" width="30" alt="clojure"></td><td><code>cloud</code></td><td><img src="https://l.habyby.net/images/social/svg/cloud-logo-transparent.svg" width="30" alt="cloud"></td><td><code>cloudflare</code></td><td><img src="https://l.habyby.net/images/social/svg/cloudflare-logo-transparent.svg" width="30" alt="cloudflare"></td></tr>
    <tr><td><code>cloudflare-workers</code></td><td><img src="https://l.habyby.net/images/social/svg/cloudflare-workers-logo-transparent.svg" width="30" alt="cloudflare-workers"></td><td><code>clubhouse</code></td><td><img src="https://l.habyby.net/images/social/svg/clubhouse-logo-transparent.svg" width="30" alt="clubhouse"></td><td><code>cmake</code></td><td><img src="https://l.habyby.net/images/social/svg/cmake-logo-transparent.svg" width="30" alt="cmake"></td><td><code>cms</code></td><td><img src="https://l.habyby.net/images/social/svg/cms-logo-transparent.svg" width="30" alt="cms"></td></tr>
    <tr><td><code>code</code></td><td><img src="https://l.habyby.net/images/social/svg/code-logo-transparent.svg" width="30" alt="code"></td><td><code>codepen</code></td><td><img src="https://l.habyby.net/images/social/svg/codepen-logo-transparent.svg" width="30" alt="codepen"></td><td><code>coffeescript</code></td><td><img src="https://l.habyby.net/images/social/svg/coffeescript-logo-transparent.svg" width="30" alt="coffeescript"></td><td><code>comment</code></td><td><img src="https://l.habyby.net/images/social/svg/comment-logo-transparent.svg" width="30" alt="comment"></td></tr>
    <tr><td><code>computer-vision</code></td><td><img src="https://l.habyby.net/images/social/svg/computer-vision-logo-transparent.svg" width="30" alt="computer-vision"></td><td><code>couchsurfing</code></td><td><img src="https://l.habyby.net/images/social/svg/couchsurfing-logo-transparent.svg" width="30" alt="couchsurfing"></td><td><code>cpp</code></td><td><img src="https://l.habyby.net/images/social/svg/cpp-logo-transparent.svg" width="30" alt="cpp"></td><td><code>cross-browser-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/cross-browser-testing-logo-transparent.svg" width="30" alt="cross-browser-testing"></td></tr>
    <tr><td><code>crunchyroll</code></td><td><img src="https://l.habyby.net/images/social/svg/crunchyroll-logo-transparent.svg" width="30" alt="crunchyroll"></td><td><code>crystal</code></td><td><img src="https://l.habyby.net/images/social/svg/crystal-logo-transparent.svg" width="30" alt="crystal"></td><td><code>crystal-reports</code></td><td><img src="https://l.habyby.net/images/social/svg/crystal-reports-logo-transparent.svg" width="30" alt="crystal-reports"></td><td><code>csharp</code></td><td><img src="https://l.habyby.net/images/social/svg/csharp-logo-transparent.svg" width="30" alt="csharp"></td></tr>
    <tr><td><code>css3</code></td><td><img src="https://l.habyby.net/images/social/svg/css3-logo-transparent.svg" width="30" alt="css3"></td><td><code>cursor</code></td><td><img src="https://l.habyby.net/images/social/svg/cursor-logo-transparent.svg" width="30" alt="cursor"></td><td><code>custom</code></td><td><img src="https://l.habyby.net/images/social/svg/custom-logo-transparent.svg" width="30" alt="custom"></td><td><code>cv</code></td><td><img src="https://l.habyby.net/images/social/svg/cv-logo-transparent.svg" width="30" alt="cv"></td></tr>
    <tr><td><code>cv-ehab</code></td><td><img src="https://l.habyby.net/images/social/svg/cv-ehab-logo-transparent.svg" width="30" alt="cv-ehab"></td><td><code>cyber-security</code></td><td><img src="https://l.habyby.net/images/social/svg/cyber-security-logo-transparent.svg" width="30" alt="cyber-security"></td><td><code>cypress</code></td><td><img src="https://l.habyby.net/images/social/svg/cypress-logo-transparent.svg" width="30" alt="cypress"></td><td><code>d3</code></td><td><img src="https://l.habyby.net/images/social/svg/d3-logo-transparent.svg" width="30" alt="d3"></td></tr>
    <tr><td><code>dailymotion</code></td><td><img src="https://l.habyby.net/images/social/svg/dailymotion-logo-transparent.svg" width="30" alt="dailymotion"></td><td><code>dart</code></td><td><img src="https://l.habyby.net/images/social/svg/dart-logo-transparent.svg" width="30" alt="dart"></td><td><code>data-analysis</code></td><td><img src="https://l.habyby.net/images/social/svg/data-analysis-logo-transparent.svg" width="30" alt="data-analysis"></td><td><code>data-mining</code></td><td><img src="https://l.habyby.net/images/social/svg/data-mining-logo-transparent.svg" width="30" alt="data-mining"></td></tr>
    <tr><td><code>data-modeling</code></td><td><img src="https://l.habyby.net/images/social/svg/data-modeling-logo-transparent.svg" width="30" alt="data-modeling"></td><td><code>databases-hosting</code></td><td><img src="https://l.habyby.net/images/social/svg/databases-hosting-logo-transparent.svg" width="30" alt="databases-hosting"></td><td><code>debian</code></td><td><img src="https://l.habyby.net/images/social/svg/debian-logo-transparent.svg" width="30" alt="debian"></td><td><code>deep-learning</code></td><td><img src="https://l.habyby.net/images/social/svg/deep-learning-logo-transparent.svg" width="30" alt="deep-learning"></td></tr>
    <tr><td><code>default</code></td><td><img src="https://l.habyby.net/images/social/svg/default-logo-transparent.svg" width="30" alt="default"></td><td><code>default2</code></td><td><img src="https://l.habyby.net/images/social/svg/default2-logo-transparent.svg" width="30" alt="default2"></td><td><code>default3</code></td><td><img src="https://l.habyby.net/images/social/svg/default3-logo-transparent.svg" width="30" alt="default3"></td><td><code>default4</code></td><td><img src="https://l.habyby.net/images/social/svg/default4-logo-transparent.svg" width="30" alt="default4"></td></tr>
    <tr><td><code>default5</code></td><td><img src="https://l.habyby.net/images/social/svg/default5-logo-transparent.svg" width="30" alt="default5"></td><td><code>default6</code></td><td><img src="https://l.habyby.net/images/social/svg/default6-logo-transparent.svg" width="30" alt="default6"></td><td><code>deno</code></td><td><img src="https://l.habyby.net/images/social/svg/deno-logo-transparent.svg" width="30" alt="deno"></td><td><code>design-multimedia</code></td><td><img src="https://l.habyby.net/images/social/svg/design-multimedia-logo-transparent.svg" width="30" alt="design-multimedia"></td></tr>
    <tr><td><code>design-system</code></td><td><img src="https://l.habyby.net/images/social/svg/design-system-logo-transparent.svg" width="30" alt="design-system"></td><td><code>deviantart</code></td><td><img src="https://l.habyby.net/images/social/svg/deviantart-logo-transparent.svg" width="30" alt="deviantart"></td><td><code>devops</code></td><td><img src="https://l.habyby.net/images/social/svg/devops-logo-transparent.svg" width="30" alt="devops"></td><td><code>devto</code></td><td><img src="https://l.habyby.net/images/social/svg/devto-logo-transparent.svg" width="30" alt="devto"></td></tr>
    <tr><td><code>dibbble</code></td><td><img src="https://l.habyby.net/images/social/svg/dibbble-logo-transparent.svg" width="30" alt="dibbble"></td><td><code>discord</code></td><td><img src="https://l.habyby.net/images/social/svg/discord-logo-transparent.svg" width="30" alt="discord"></td><td><code>discordjs</code></td><td><img src="https://l.habyby.net/images/social/svg/discordjs-logo-transparent.svg" width="30" alt="discordjs"></td><td><code>django</code></td><td><img src="https://l.habyby.net/images/social/svg/django-logo-transparent.svg" width="30" alt="django"></td></tr>
    <tr><td><code>docker</code></td><td><img src="https://l.habyby.net/images/social/svg/docker-logo-transparent.svg" width="30" alt="docker"></td><td><code>docusaurus</code></td><td><img src="https://l.habyby.net/images/social/svg/docusaurus-logo-transparent.svg" width="30" alt="docusaurus"></td><td><code>dotnet</code></td><td><img src="https://l.habyby.net/images/social/svg/dotnet-logo-transparent.svg" width="30" alt="dotnet"></td><td><code>douban</code></td><td><img src="https://l.habyby.net/images/social/svg/douban-logo-transparent.svg" width="30" alt="douban"></td></tr>
    <tr><td><code>download</code></td><td><img src="https://l.habyby.net/images/social/svg/download-logo-transparent.svg" width="30" alt="download"></td><td><code>dreamwidth</code></td><td><img src="https://l.habyby.net/images/social/svg/dreamwidth-logo-transparent.svg" width="30" alt="dreamwidth"></td><td><code>dropbox</code></td><td><img src="https://l.habyby.net/images/social/svg/dropbox-logo-transparent.svg" width="30" alt="dropbox"></td><td><code>dynamodb</code></td><td><img src="https://l.habyby.net/images/social/svg/dynamodb-logo-transparent.svg" width="30" alt="dynamodb"></td></tr>
    <tr><td><code>eclipse</code></td><td><img src="https://l.habyby.net/images/social/svg/eclipse-logo-transparent.svg" width="30" alt="eclipse"></td><td><code>edge</code></td><td><img src="https://l.habyby.net/images/social/svg/edge-logo-transparent.svg" width="30" alt="edge"></td><td><code>edge-computing</code></td><td><img src="https://l.habyby.net/images/social/svg/edge-computing-logo-transparent.svg" width="30" alt="edge-computing"></td><td><code>elastic</code></td><td><img src="https://l.habyby.net/images/social/svg/elastic-logo-transparent.svg" width="30" alt="elastic"></td></tr>
    <tr><td><code>elasticsearch</code></td><td><img src="https://l.habyby.net/images/social/svg/elasticsearch-logo-transparent.svg" width="30" alt="elasticsearch"></td><td><code>electron</code></td><td><img src="https://l.habyby.net/images/social/svg/electron-logo-transparent.svg" width="30" alt="electron"></td><td><code>elixir</code></td><td><img src="https://l.habyby.net/images/social/svg/elixir-logo-transparent.svg" width="30" alt="elixir"></td><td><code>ello</code></td><td><img src="https://l.habyby.net/images/social/svg/ello-logo-transparent.svg" width="30" alt="ello"></td></tr>
    <tr><td><code>elpha</code></td><td><img src="https://l.habyby.net/images/social/svg/elpha-logo-transparent.svg" width="30" alt="elpha"></td><td><code>elysiajs</code></td><td><img src="https://l.habyby.net/images/social/svg/elysiajs-logo-transparent.svg" width="30" alt="elysiajs"></td><td><code>emacs</code></td><td><img src="https://l.habyby.net/images/social/svg/emacs-logo-transparent.svg" width="30" alt="emacs"></td><td><code>email</code></td><td><img src="https://l.habyby.net/images/social/svg/email-logo-transparent.svg" width="30" alt="email"></td></tr>
    <tr><td><code>ember</code></td><td><img src="https://l.habyby.net/images/social/svg/ember-logo-transparent.svg" width="30" alt="ember"></td><td><code>emotion</code></td><td><img src="https://l.habyby.net/images/social/svg/emotion-logo-transparent.svg" width="30" alt="emotion"></td><td><code>excel</code></td><td><img src="https://l.habyby.net/images/social/svg/excel-logo-transparent.svg" width="30" alt="excel"></td><td><code>expressjs</code></td><td><img src="https://l.habyby.net/images/social/svg/expressjs-logo-transparent.svg" width="30" alt="expressjs"></td></tr>
    <tr><td><code>facebook</code></td><td><img src="https://l.habyby.net/images/social/svg/facebook-logo-transparent.svg" width="30" alt="facebook"></td><td><code>fastapi</code></td><td><img src="https://l.habyby.net/images/social/svg/fastapi-logo-transparent.svg" width="30" alt="fastapi"></td><td><code>favorite</code></td><td><img src="https://l.habyby.net/images/social/svg/favorite-logo-transparent.svg" width="30" alt="favorite"></td><td><code>favorites</code></td><td><img src="https://l.habyby.net/images/social/svg/favorites-logo-transparent.svg" width="30" alt="favorites"></td></tr>
    <tr><td><code>fediverse</code></td><td><img src="https://l.habyby.net/images/social/svg/fediverse-logo-transparent.svg" width="30" alt="fediverse"></td><td><code>figma</code></td><td><img src="https://l.habyby.net/images/social/svg/figma-logo-transparent.svg" width="30" alt="figma"></td><td><code>filmaffinity</code></td><td><img src="https://l.habyby.net/images/social/svg/filmaffinity-logo-transparent.svg" width="30" alt="filmaffinity"></td><td><code>filmora</code></td><td><img src="https://l.habyby.net/images/social/svg/filmora-logo-transparent.svg" width="30" alt="filmora"></td></tr>
    <tr><td><code>firebase</code></td><td><img src="https://l.habyby.net/images/social/svg/firebase-logo-transparent.svg" width="30" alt="firebase"></td><td><code>firefox</code></td><td><img src="https://l.habyby.net/images/social/svg/firefox-logo-transparent.svg" width="30" alt="firefox"></td><td><code>fiverr</code></td><td><img src="https://l.habyby.net/images/social/svg/fiverr-logo-transparent.svg" width="30" alt="fiverr"></td><td><code>flask</code></td><td><img src="https://l.habyby.net/images/social/svg/flask-logo-transparent.svg" width="30" alt="flask"></td></tr>
    <tr><td><code>flickr</code></td><td><img src="https://l.habyby.net/images/social/svg/flickr-logo-transparent.svg" width="30" alt="flickr"></td><td><code>flip</code></td><td><img src="https://l.habyby.net/images/social/svg/flip-logo-transparent.svg" width="30" alt="flip"></td><td><code>flutter</code></td><td><img src="https://l.habyby.net/images/social/svg/flutter-logo-transparent.svg" width="30" alt="flutter"></td><td><code>forth</code></td><td><img src="https://l.habyby.net/images/social/svg/forth-logo-transparent.svg" width="30" alt="forth"></td></tr>
    <tr><td><code>fortran</code></td><td><img src="https://l.habyby.net/images/social/svg/fortran-logo-transparent.svg" width="30" alt="fortran"></td><td><code>foursquare</code></td><td><img src="https://l.habyby.net/images/social/svg/foursquare-logo-transparent.svg" width="30" alt="foursquare"></td><td><code>frameworks-optimization</code></td><td><img src="https://l.habyby.net/images/social/svg/frameworks-optimization-logo-transparent.svg" width="30" alt="frameworks-optimization"></td><td><code>frontend</code></td><td><img src="https://l.habyby.net/images/social/svg/frontend-logo-transparent.svg" width="30" alt="frontend"></td></tr>
    <tr><td><code>functional-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/functional-testing-logo-transparent.svg" width="30" alt="functional-testing"></td><td><code>gab</code></td><td><img src="https://l.habyby.net/images/social/svg/gab-logo-transparent.svg" width="30" alt="gab"></td><td><code>gaia-online</code></td><td><img src="https://l.habyby.net/images/social/svg/gaia-online-logo-transparent.svg" width="30" alt="gaia-online"></td><td><code>gamemakerstudio</code></td><td><img src="https://l.habyby.net/images/social/svg/gamemakerstudio-logo-transparent.svg" width="30" alt="gamemakerstudio"></td></tr>
    <tr><td><code>gatsbyjs</code></td><td><img src="https://l.habyby.net/images/social/svg/gatsbyjs-logo-transparent.svg" width="30" alt="gatsbyjs"></td><td><code>gdscript</code></td><td><img src="https://l.habyby.net/images/social/svg/gdscript-logo-transparent.svg" width="30" alt="gdscript"></td><td><code>gherkin</code></td><td><img src="https://l.habyby.net/images/social/svg/gherkin-logo-transparent.svg" width="30" alt="gherkin"></td><td><code>giphy</code></td><td><img src="https://l.habyby.net/images/social/svg/giphy-logo-transparent.svg" width="30" alt="giphy"></td></tr>
    <tr><td><code>git</code></td><td><img src="https://l.habyby.net/images/social/svg/git-logo-transparent.svg" width="30" alt="git"></td><td><code>github</code></td><td><img src="https://l.habyby.net/images/social/svg/github-logo-transparent.svg" width="30" alt="github"></td><td><code>githubactions</code></td><td><img src="https://l.habyby.net/images/social/svg/githubactions-logo-transparent.svg" width="30" alt="githubactions"></td><td><code>gitlab</code></td><td><img src="https://l.habyby.net/images/social/svg/gitlab-logo-transparent.svg" width="30" alt="gitlab"></td></tr>
    <tr><td><code>gmail</code></td><td><img src="https://l.habyby.net/images/social/svg/gmail-logo-transparent.svg" width="30" alt="gmail"></td><td><code>go</code></td><td><img src="https://l.habyby.net/images/social/svg/go-logo-transparent.svg" width="30" alt="go"></td><td><code>godot</code></td><td><img src="https://l.habyby.net/images/social/svg/godot-logo-transparent.svg" width="30" alt="godot"></td><td><code>goodreads</code></td><td><img src="https://l.habyby.net/images/social/svg/goodreads-logo-transparent.svg" width="30" alt="goodreads"></td></tr>
    <tr><td><code>google-ads</code></td><td><img src="https://l.habyby.net/images/social/svg/google-ads-logo-transparent.svg" width="30" alt="google-ads"></td><td><code>google-analytics</code></td><td><img src="https://l.habyby.net/images/social/svg/google-analytics-logo-transparent.svg" width="30" alt="google-analytics"></td><td><code>google-cloud</code></td><td><img src="https://l.habyby.net/images/social/svg/google-cloud-logo-transparent.svg" width="30" alt="google-cloud"></td><td><code>google-colab</code></td><td><img src="https://l.habyby.net/images/social/svg/google-colab-logo-transparent.svg" width="30" alt="google-colab"></td></tr>
    <tr><td><code>gradio</code></td><td><img src="https://l.habyby.net/images/social/svg/gradio-logo-transparent.svg" width="30" alt="gradio"></td><td><code>gradle</code></td><td><img src="https://l.habyby.net/images/social/svg/gradle-logo-transparent.svg" width="30" alt="gradle"></td><td><code>grafana</code></td><td><img src="https://l.habyby.net/images/social/svg/grafana-logo-transparent.svg" width="30" alt="grafana"></td><td><code>graphql</code></td><td><img src="https://l.habyby.net/images/social/svg/graphql-logo-transparent.svg" width="30" alt="graphql"></td></tr>
    <tr><td><code>gtk</code></td><td><img src="https://l.habyby.net/images/social/svg/gtk-logo-transparent.svg" width="30" alt="gtk"></td><td><code>gulp</code></td><td><img src="https://l.habyby.net/images/social/svg/gulp-logo-transparent.svg" width="30" alt="gulp"></td><td><code>habyby</code></td><td><img src="https://l.habyby.net/images/social/svg/habyby-logo-transparent.svg" width="30" alt="habyby"></td><td><code>hangout</code></td><td><img src="https://l.habyby.net/images/social/svg/hangout-logo-transparent.svg" width="30" alt="hangout"></td></tr>
    <tr><td><code>haskell</code></td><td><img src="https://l.habyby.net/images/social/svg/haskell-logo-transparent.svg" width="30" alt="haskell"></td><td><code>haxe</code></td><td><img src="https://l.habyby.net/images/social/svg/haxe-logo-transparent.svg" width="30" alt="haxe"></td><td><code>haxeflixel</code></td><td><img src="https://l.habyby.net/images/social/svg/haxeflixel-logo-transparent.svg" width="30" alt="haxeflixel"></td><td><code>hcl</code></td><td><img src="https://l.habyby.net/images/social/svg/hcl-logo-transparent.svg" width="30" alt="hcl"></td></tr>
    <tr><td><code>heroku</code></td><td><img src="https://l.habyby.net/images/social/svg/heroku-logo-transparent.svg" width="30" alt="heroku"></td><td><code>hibernate</code></td><td><img src="https://l.habyby.net/images/social/svg/hibernate-logo-transparent.svg" width="30" alt="hibernate"></td><td><code>high-priority</code></td><td><img src="https://l.habyby.net/images/social/svg/high-priority-logo-transparent.svg" width="30" alt="high-priority"></td><td><code>houseparty</code></td><td><img src="https://l.habyby.net/images/social/svg/houseparty-logo-transparent.svg" width="30" alt="houseparty"></td></tr>
    <tr><td><code>html5</code></td><td><img src="https://l.habyby.net/images/social/svg/html5-logo-transparent.svg" width="30" alt="html5"></td><td><code>htmx</code></td><td><img src="https://l.habyby.net/images/social/svg/htmx-logo-transparent.svg" width="30" alt="htmx"></td><td><code>huawei</code></td><td><img src="https://l.habyby.net/images/social/svg/huawei-logo-transparent.svg" width="30" alt="huawei"></td><td><code>hugging-face</code></td><td><img src="https://l.habyby.net/images/social/svg/hugging-face-logo-transparent.svg" width="30" alt="hugging-face"></td></tr>
    <tr><td><code>illustrator</code></td><td><img src="https://l.habyby.net/images/social/svg/illustrator-logo-transparent.svg" width="30" alt="illustrator"></td><td><code>image-processing</code></td><td><img src="https://l.habyby.net/images/social/svg/image-processing-logo-transparent.svg" width="30" alt="image-processing"></td><td><code>imdb</code></td><td><img src="https://l.habyby.net/images/social/svg/imdb-logo-transparent.svg" width="30" alt="imdb"></td><td><code>imgur</code></td><td><img src="https://l.habyby.net/images/social/svg/imgur-logo-transparent.svg" width="30" alt="imgur"></td></tr>
    <tr><td><code>influenster</code></td><td><img src="https://l.habyby.net/images/social/svg/influenster-logo-transparent.svg" width="30" alt="influenster"></td><td><code>insomnia</code></td><td><img src="https://l.habyby.net/images/social/svg/insomnia-logo-transparent.svg" width="30" alt="insomnia"></td><td><code>instagram</code></td><td><img src="https://l.habyby.net/images/social/svg/instagram-logo-transparent.svg" width="30" alt="instagram"></td><td><code>intellij-idea</code></td><td><img src="https://l.habyby.net/images/social/svg/intellij-idea-logo-transparent.svg" width="30" alt="intellij-idea"></td></tr>
    <tr><td><code>internations</code></td><td><img src="https://l.habyby.net/images/social/svg/internations-logo-transparent.svg" width="30" alt="internations"></td><td><code>ios</code></td><td><img src="https://l.habyby.net/images/social/svg/ios-logo-transparent.svg" width="30" alt="ios"></td><td><code>iot</code></td><td><img src="https://l.habyby.net/images/social/svg/iot-logo-transparent.svg" width="30" alt="iot"></td><td><code>ipfs</code></td><td><img src="https://l.habyby.net/images/social/svg/ipfs-logo-transparent.svg" width="30" alt="ipfs"></td></tr>
    <tr><td><code>italki</code></td><td><img src="https://l.habyby.net/images/social/svg/italki-logo-transparent.svg" width="30" alt="italki"></td><td><code>java</code></td><td><img src="https://l.habyby.net/images/social/svg/java-logo-transparent.svg" width="30" alt="java"></td><td><code>javascript</code></td><td><img src="https://l.habyby.net/images/social/svg/javascript-logo-transparent.svg" width="30" alt="javascript"></td><td><code>jenkins</code></td><td><img src="https://l.habyby.net/images/social/svg/jenkins-logo-transparent.svg" width="30" alt="jenkins"></td></tr>
    <tr><td><code>jest</code></td><td><img src="https://l.habyby.net/images/social/svg/jest-logo-transparent.svg" width="30" alt="jest"></td><td><code>jira</code></td><td><img src="https://l.habyby.net/images/social/svg/jira-logo-transparent.svg" width="30" alt="jira"></td><td><code>jquery</code></td><td><img src="https://l.habyby.net/images/social/svg/jquery-logo-transparent.svg" width="30" alt="jquery"></td><td><code>json</code></td><td><img src="https://l.habyby.net/images/social/svg/json-logo-transparent.svg" width="30" alt="json"></td></tr>
    <tr><td><code>jupyter</code></td><td><img src="https://l.habyby.net/images/social/svg/jupyter-logo-transparent.svg" width="30" alt="jupyter"></td><td><code>jwt</code></td><td><img src="https://l.habyby.net/images/social/svg/jwt-logo-transparent.svg" width="30" alt="jwt"></td><td><code>kaggle</code></td><td><img src="https://l.habyby.net/images/social/svg/kaggle-logo-transparent.svg" width="30" alt="kaggle"></td><td><code>kali-linux</code></td><td><img src="https://l.habyby.net/images/social/svg/kali-linux-logo-transparent.svg" width="30" alt="kali-linux"></td></tr>
    <tr><td><code>kivy</code></td><td><img src="https://l.habyby.net/images/social/svg/kivy-logo-transparent.svg" width="30" alt="kivy"></td><td><code>ko-fi</code></td><td><img src="https://l.habyby.net/images/social/svg/ko-fi-logo-transparent.svg" width="30" alt="ko-fi"></td><td><code>kotlin</code></td><td><img src="https://l.habyby.net/images/social/svg/kotlin-logo-transparent.svg" width="30" alt="kotlin"></td><td><code>ktor</code></td><td><img src="https://l.habyby.net/images/social/svg/ktor-logo-transparent.svg" width="30" alt="ktor"></td></tr>
    <tr><td><code>kuaishou</code></td><td><img src="https://l.habyby.net/images/social/svg/kuaishou-logo-transparent.svg" width="30" alt="kuaishou"></td><td><code>kubernetes</code></td><td><img src="https://l.habyby.net/images/social/svg/kubernetes-logo-transparent.svg" width="30" alt="kubernetes"></td><td><code>langchain</code></td><td><img src="https://l.habyby.net/images/social/svg/langchain-logo-transparent.svg" width="30" alt="langchain"></td><td><code>laravel</code></td><td><img src="https://l.habyby.net/images/social/svg/laravel-logo-transparent.svg" width="30" alt="laravel"></td></tr>
    <tr><td><code>latex</code></td><td><img src="https://l.habyby.net/images/social/svg/latex-logo-transparent.svg" width="30" alt="latex"></td><td><code>leaflet</code></td><td><img src="https://l.habyby.net/images/social/svg/leaflet-logo-transparent.svg" width="30" alt="leaflet"></td><td><code>leetcode</code></td><td><img src="https://l.habyby.net/images/social/svg/leetcode-logo-transparent.svg" width="30" alt="leetcode"></td><td><code>less</code></td><td><img src="https://l.habyby.net/images/social/svg/less-logo-transparent.svg" width="30" alt="less"></td></tr>
    <tr><td><code>lhabyby</code></td><td><img src="https://l.habyby.net/images/social/svg/Lhabyby-logo-transparent.svg" width="30" alt="lhabyby"></td><td><code>li-fi-composer</code></td><td><img src="https://l.habyby.net/images/social/svg/li-fi-composer-logo-transparent.svg" width="30" alt="li-fi-composer"></td><td><code>librarything</code></td><td><img src="https://l.habyby.net/images/social/svg/librarything-logo-transparent.svg" width="30" alt="librarything"></td><td><code>lightgbm</code></td><td><img src="https://l.habyby.net/images/social/svg/lightgbm-logo-transparent.svg" width="30" alt="lightgbm"></td></tr>
    <tr><td><code>likee</code></td><td><img src="https://l.habyby.net/images/social/svg/likee-logo-transparent.svg" width="30" alt="likee"></td><td><code>line</code></td><td><img src="https://l.habyby.net/images/social/svg/line-logo-transparent.svg" width="30" alt="line"></td><td><code>linkedin</code></td><td><img src="https://l.habyby.net/images/social/svg/linkedin-logo-transparent.svg" width="30" alt="linkedin"></td><td><code>linktree</code></td><td><img src="https://l.habyby.net/images/social/svg/linktree-logo-transparent.svg" width="30" alt="linktree"></td></tr>
    <tr><td><code>linux</code></td><td><img src="https://l.habyby.net/images/social/svg/linux-logo-transparent.svg" width="30" alt="linux"></td><td><code>linux-mint</code></td><td><img src="https://l.habyby.net/images/social/svg/linux-mint-logo-transparent.svg" width="30" alt="linux-mint"></td><td><code>lit</code></td><td><img src="https://l.habyby.net/images/social/svg/lit-logo-transparent.svg" width="30" alt="lit"></td><td><code>litert</code></td><td><img src="https://l.habyby.net/images/social/svg/Litert-logo-transparent.svg" width="30" alt="litert"></td></tr>
    <tr><td><code>livejournal</code></td><td><img src="https://l.habyby.net/images/social/svg/livejournal-logo-transparent.svg" width="30" alt="livejournal"></td><td><code>llm</code></td><td><img src="https://l.habyby.net/images/social/svg/llm-logo-transparent.svg" width="30" alt="llm"></td><td><code>logo-design</code></td><td><img src="https://l.habyby.net/images/social/svg/logo-design-logo-transparent.svg" width="30" alt="logo-design"></td><td><code>lua</code></td><td><img src="https://l.habyby.net/images/social/svg/lua-logo-transparent.svg" width="30" alt="lua"></td></tr>
    <tr><td><code>machine-learning</code></td><td><img src="https://l.habyby.net/images/social/svg/machine-learning-logo-transparent.svg" width="30" alt="machine-learning"></td><td><code>markdown</code></td><td><img src="https://l.habyby.net/images/social/svg/markdown-logo-transparent.svg" width="30" alt="markdown"></td><td><code>mastodon</code></td><td><img src="https://l.habyby.net/images/social/svg/mastodon-logo-transparent.svg" width="30" alt="mastodon"></td><td><code>matlab</code></td><td><img src="https://l.habyby.net/images/social/svg/matlab-logo-transparent.svg" width="30" alt="matlab"></td></tr>
    <tr><td><code>matplotlib</code></td><td><img src="https://l.habyby.net/images/social/svg/matplotlib-logo-transparent.svg" width="30" alt="matplotlib"></td><td><code>mcp</code></td><td><img src="https://l.habyby.net/images/social/svg/mcp-logo-transparent.svg" width="30" alt="mcp"></td><td><code>medium</code></td><td><img src="https://l.habyby.net/images/social/svg/medium-logo-transparent.svg" width="30" alt="medium"></td><td><code>meetme</code></td><td><img src="https://l.habyby.net/images/social/svg/meetme-logo-transparent.svg" width="30" alt="meetme"></td></tr>
    <tr><td><code>meetup</code></td><td><img src="https://l.habyby.net/images/social/svg/meetup-logo-transparent.svg" width="30" alt="meetup"></td><td><code>messenger</code></td><td><img src="https://l.habyby.net/images/social/svg/messenger-logo-transparent.svg" width="30" alt="messenger"></td><td><code>mewe</code></td><td><img src="https://l.habyby.net/images/social/svg/mewe-logo-transparent.svg" width="30" alt="mewe"></td><td><code>microservices</code></td><td><img src="https://l.habyby.net/images/social/svg/microservices-logo-transparent.svg" width="30" alt="microservices"></td></tr>
    <tr><td><code>microsoft-office</code></td><td><img src="https://l.habyby.net/images/social/svg/microsoft-office-logo-transparent.svg" width="30" alt="microsoft-office"></td><td><code>misskey</code></td><td><img src="https://l.habyby.net/images/social/svg/misskey-logo-transparent.svg" width="30" alt="misskey"></td><td><code>mix</code></td><td><img src="https://l.habyby.net/images/social/svg/mix-logo-transparent.svg" width="30" alt="mix"></td><td><code>mixi</code></td><td><img src="https://l.habyby.net/images/social/svg/mixi-logo-transparent.svg" width="30" alt="mixi"></td></tr>
    <tr><td><code>mocospace</code></td><td><img src="https://l.habyby.net/images/social/svg/mocospace-logo-transparent.svg" width="30" alt="mocospace"></td><td><code>mongodb</code></td><td><img src="https://l.habyby.net/images/social/svg/mongodb-logo-transparent.svg" width="30" alt="mongodb"></td><td><code>monitoring</code></td><td><img src="https://l.habyby.net/images/social/svg/monitoring-logo-transparent.svg" width="30" alt="monitoring"></td><td><code>mui</code></td><td><img src="https://l.habyby.net/images/social/svg/mui-logo-transparent.svg" width="30" alt="mui"></td></tr>
    <tr><td><code>mute</code></td><td><img src="https://l.habyby.net/images/social/svg/mute-logo-transparent.svg" width="30" alt="mute"></td><td><code>myheritage</code></td><td><img src="https://l.habyby.net/images/social/svg/myheritage-logo-transparent.svg" width="30" alt="myheritage"></td><td><code>myspace</code></td><td><img src="https://l.habyby.net/images/social/svg/myspace-logo-transparent.svg" width="30" alt="myspace"></td><td><code>mysql</code></td><td><img src="https://l.habyby.net/images/social/svg/mysql-logo-transparent.svg" width="30" alt="mysql"></td></tr>
    <tr><td><code>n8n</code></td><td><img src="https://l.habyby.net/images/social/svg/n8n-logo-transparent.svg" width="30" alt="n8n"></td><td><code>natural-language</code></td><td><img src="https://l.habyby.net/images/social/svg/natural-language-logo-transparent.svg" width="30" alt="natural-language"></td><td><code>neovim</code></td><td><img src="https://l.habyby.net/images/social/svg/neovim-logo-transparent.svg" width="30" alt="neovim"></td><td><code>nestjs</code></td><td><img src="https://l.habyby.net/images/social/svg/nestjs-logo-transparent.svg" width="30" alt="nestjs"></td></tr>
    <tr><td><code>netflix</code></td><td><img src="https://l.habyby.net/images/social/svg/netflix-logo-transparent.svg" width="30" alt="netflix"></td><td><code>netlify</code></td><td><img src="https://l.habyby.net/images/social/svg/netlify-logo-transparent.svg" width="30" alt="netlify"></td><td><code>nextdoor</code></td><td><img src="https://l.habyby.net/images/social/svg/nextdoor-logo-transparent.svg" width="30" alt="nextdoor"></td><td><code>nextjs</code></td><td><img src="https://l.habyby.net/images/social/svg/nextjs-logo-transparent.svg" width="30" alt="nextjs"></td></tr>
    <tr><td><code>nginx</code></td><td><img src="https://l.habyby.net/images/social/svg/nginx-logo-transparent.svg" width="30" alt="nginx"></td><td><code>nim</code></td><td><img src="https://l.habyby.net/images/social/svg/nim-logo-transparent.svg" width="30" alt="nim"></td><td><code>nix</code></td><td><img src="https://l.habyby.net/images/social/svg/nix-logo-transparent.svg" width="30" alt="nix"></td><td><code>nlp</code></td><td><img src="https://l.habyby.net/images/social/svg/nlp-logo-transparent.svg" width="30" alt="nlp"></td></tr>
    <tr><td><code>nodejs</code></td><td><img src="https://l.habyby.net/images/social/svg/nodejs-logo-transparent.svg" width="30" alt="nodejs"></td><td><code>notification</code></td><td><img src="https://l.habyby.net/images/social/svg/notification-logo-transparent.svg" width="30" alt="notification"></td><td><code>notion</code></td><td><img src="https://l.habyby.net/images/social/svg/notion-logo-transparent.svg" width="30" alt="notion"></td><td><code>npmjs</code></td><td><img src="https://l.habyby.net/images/social/svg/npmjs-logo-transparent.svg" width="30" alt="npmjs"></td></tr>
    <tr><td><code>numpy</code></td><td><img src="https://l.habyby.net/images/social/svg/numpy-logo-transparent.svg" width="30" alt="numpy"></td><td><code>nuxtjs</code></td><td><img src="https://l.habyby.net/images/social/svg/nuxtjs-logo-transparent.svg" width="30" alt="nuxtjs"></td><td><code>obsidian</code></td><td><img src="https://l.habyby.net/images/social/svg/obsidian-logo-transparent.svg" width="30" alt="obsidian"></td><td><code>ocaml</code></td><td><img src="https://l.habyby.net/images/social/svg/ocaml-logo-transparent.svg" width="30" alt="ocaml"></td></tr>
    <tr><td><code>ocr</code></td><td><img src="https://l.habyby.net/images/social/svg/ocr-logo-transparent.svg" width="30" alt="ocr"></td><td><code>octave</code></td><td><img src="https://l.habyby.net/images/social/svg/octave-logo-transparent.svg" width="30" alt="octave"></td><td><code>ollama</code></td><td><img src="https://l.habyby.net/images/social/svg/ollama-logo-transparent.svg" width="30" alt="ollama"></td><td><code>opencv</code></td><td><img src="https://l.habyby.net/images/social/svg/opencv-logo-transparent.svg" width="30" alt="opencv"></td></tr>
    <tr><td><code>opendiary</code></td><td><img src="https://l.habyby.net/images/social/svg/opendiary-logo-transparent.svg" width="30" alt="opendiary"></td><td><code>openshift</code></td><td><img src="https://l.habyby.net/images/social/svg/openshift-logo-transparent.svg" width="30" alt="openshift"></td><td><code>openstack</code></td><td><img src="https://l.habyby.net/images/social/svg/openstack-logo-transparent.svg" width="30" alt="openstack"></td><td><code>opera</code></td><td><img src="https://l.habyby.net/images/social/svg/opera-logo-transparent.svg" width="30" alt="opera"></td></tr>
    <tr><td><code>orcid</code></td><td><img src="https://l.habyby.net/images/social/svg/orcid-logo-transparent.svg" width="30" alt="orcid"></td><td><code>p5js</code></td><td><img src="https://l.habyby.net/images/social/svg/p5js-logo-transparent.svg" width="30" alt="p5js"></td><td><code>pandas</code></td><td><img src="https://l.habyby.net/images/social/svg/pandas-logo-transparent.svg" width="30" alt="pandas"></td><td><code>patreon</code></td><td><img src="https://l.habyby.net/images/social/svg/patreon-logo-transparent.svg" width="30" alt="patreon"></td></tr>
    <tr><td><code>pdf</code></td><td><img src="https://l.habyby.net/images/social/svg/pdf-logo-transparent.svg" width="30" alt="pdf"></td><td><code>peanut</code></td><td><img src="https://l.habyby.net/images/social/svg/peanut-logo-transparent.svg" width="30" alt="peanut"></td><td><code>performance-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/performance-testing-logo-transparent.svg" width="30" alt="performance-testing"></td><td><code>periscope</code></td><td><img src="https://l.habyby.net/images/social/svg/periscope-logo-transparent.svg" width="30" alt="periscope"></td></tr>
    <tr><td><code>perl</code></td><td><img src="https://l.habyby.net/images/social/svg/perl-logo-transparent.svg" width="30" alt="perl"></td><td><code>phone</code></td><td><img src="https://l.habyby.net/images/social/svg/phone-logo-transparent.svg" width="30" alt="phone"></td><td><code>photoshop</code></td><td><img src="https://l.habyby.net/images/social/svg/photoshop-logo-transparent.svg" width="30" alt="photoshop"></td><td><code>php</code></td><td><img src="https://l.habyby.net/images/social/svg/php-logo-transparent.svg" width="30" alt="php"></td></tr>
    <tr><td><code>phpmyadmin</code></td><td><img src="https://l.habyby.net/images/social/svg/phpmyadmin-logo-transparent.svg" width="30" alt="phpmyadmin"></td><td><code>phpstorm</code></td><td><img src="https://l.habyby.net/images/social/svg/phpstorm-logo-transparent.svg" width="30" alt="phpstorm"></td><td><code>pinia</code></td><td><img src="https://l.habyby.net/images/social/svg/pinia-logo-transparent.svg" width="30" alt="pinia"></td><td><code>pinterest</code></td><td><img src="https://l.habyby.net/images/social/svg/pinterest-logo-transparent.svg" width="30" alt="pinterest"></td></tr>
    <tr><td><code>pkl</code></td><td><img src="https://l.habyby.net/images/social/svg/pkl-logo-transparent.svg" width="30" alt="pkl"></td><td><code>plan9</code></td><td><img src="https://l.habyby.net/images/social/svg/plan9-logo-transparent.svg" width="30" alt="plan9"></td><td><code>planetscale</code></td><td><img src="https://l.habyby.net/images/social/svg/planetscale-logo-transparent.svg" width="30" alt="planetscale"></td><td><code>play</code></td><td><img src="https://l.habyby.net/images/social/svg/play-logo-transparent.svg" width="30" alt="play"></td></tr>
    <tr><td><code>playwright</code></td><td><img src="https://l.habyby.net/images/social/svg/playwright-logo-transparent.svg" width="30" alt="playwright"></td><td><code>pnpm</code></td><td><img src="https://l.habyby.net/images/social/svg/pnpm-logo-transparent.svg" width="30" alt="pnpm"></td><td><code>popbase</code></td><td><img src="https://l.habyby.net/images/social/svg/popbase-logo-transparent.svg" width="30" alt="popbase"></td><td><code>portfolio</code></td><td><img src="https://l.habyby.net/images/social/svg/portfolio-logo-transparent.svg" width="30" alt="portfolio"></td></tr>
    <tr><td><code>postgresql</code></td><td><img src="https://l.habyby.net/images/social/svg/postgresql-logo-transparent.svg" width="30" alt="postgresql"></td><td><code>postman</code></td><td><img src="https://l.habyby.net/images/social/svg/postman-logo-transparent.svg" width="30" alt="postman"></td><td><code>power-bi</code></td><td><img src="https://l.habyby.net/images/social/svg/power-bi-logo-transparent.svg" width="30" alt="power-bi"></td><td><code>powerpoint</code></td><td><img src="https://l.habyby.net/images/social/svg/powerpoint-logo-transparent.svg" width="30" alt="powerpoint"></td></tr>
    <tr><td><code>powershell</code></td><td><img src="https://l.habyby.net/images/social/svg/powershell-logo-transparent.svg" width="30" alt="powershell"></td><td><code>pr</code></td><td><img src="https://l.habyby.net/images/social/svg/pr-logo-transparent.svg" width="30" alt="pr"></td><td><code>primevideo</code></td><td><img src="https://l.habyby.net/images/social/svg/primevideo-logo-transparent.svg" width="30" alt="primevideo"></td><td><code>prioritization</code></td><td><img src="https://l.habyby.net/images/social/svg/prioritization-logo-transparent.svg" width="30" alt="prioritization"></td></tr>
    <tr><td><code>prisma</code></td><td><img src="https://l.habyby.net/images/social/svg/prisma-logo-transparent.svg" width="30" alt="prisma"></td><td><code>processing</code></td><td><img src="https://l.habyby.net/images/social/svg/processing-logo-transparent.svg" width="30" alt="processing"></td><td><code>prometheus</code></td><td><img src="https://l.habyby.net/images/social/svg/prometheus-logo-transparent.svg" width="30" alt="prometheus"></td><td><code>pug</code></td><td><img src="https://l.habyby.net/images/social/svg/pug-logo-transparent.svg" width="30" alt="pug"></td></tr>
    <tr><td><code>pwa</code></td><td><img src="https://l.habyby.net/images/social/svg/pwa-logo-transparent.svg" width="30" alt="pwa"></td><td><code>pycharm</code></td><td><img src="https://l.habyby.net/images/social/svg/pycharm-logo-transparent.svg" width="30" alt="pycharm"></td><td><code>pytest</code></td><td><img src="https://l.habyby.net/images/social/svg/pytest-logo-transparent.svg" width="30" alt="pytest"></td><td><code>python</code></td><td><img src="https://l.habyby.net/images/social/svg/python-logo-transparent.svg" width="30" alt="python"></td></tr>
    <tr><td><code>pytorch</code></td><td><img src="https://l.habyby.net/images/social/svg/pytorch-logo-transparent.svg" width="30" alt="pytorch"></td><td><code>qq</code></td><td><img src="https://l.habyby.net/images/social/svg/qq-logo-transparent.svg" width="30" alt="qq"></td><td><code>qrcode</code></td><td><img src="https://l.habyby.net/images/social/svg/qrcode-logo-transparent.svg" width="30" alt="qrcode"></td><td><code>qt</code></td><td><img src="https://l.habyby.net/images/social/svg/qt-logo-transparent.svg" width="30" alt="qt"></td></tr>
    <tr><td><code>query</code></td><td><img src="https://l.habyby.net/images/social/svg/query-logo-transparent.svg" width="30" alt="query"></td><td><code>quora</code></td><td><img src="https://l.habyby.net/images/social/svg/quora-logo-transparent.svg" width="30" alt="quora"></td><td><code>qzone</code></td><td><img src="https://l.habyby.net/images/social/svg/qzone-logo-transparent.svg" width="30" alt="qzone"></td><td><code>r</code></td><td><img src="https://l.habyby.net/images/social/svg/r-logo-transparent.svg" width="30" alt="r"></td></tr>
    <tr><td><code>rabbitmq</code></td><td><img src="https://l.habyby.net/images/social/svg/rabbitmq-logo-transparent.svg" width="30" alt="rabbitmq"></td><td><code>rag</code></td><td><img src="https://l.habyby.net/images/social/svg/rag-logo-transparent.svg" width="30" alt="rag"></td><td><code>rails</code></td><td><img src="https://l.habyby.net/images/social/svg/rails-logo-transparent.svg" width="30" alt="rails"></td><td><code>raspberrypi</code></td><td><img src="https://l.habyby.net/images/social/svg/raspberrypi-logo-transparent.svg" width="30" alt="raspberrypi"></td></tr>
    <tr><td><code>ravelry</code></td><td><img src="https://l.habyby.net/images/social/svg/ravelry-logo-transparent.svg" width="30" alt="ravelry"></td><td><code>react</code></td><td><img src="https://l.habyby.net/images/social/svg/react-logo-transparent.svg" width="30" alt="react"></td><td><code>reactivex</code></td><td><img src="https://l.habyby.net/images/social/svg/reactivex-logo-transparent.svg" width="30" alt="reactivex"></td><td><code>reddit</code></td><td><img src="https://l.habyby.net/images/social/svg/reddit-logo-transparent.svg" width="30" alt="reddit"></td></tr>
    <tr><td><code>redhat</code></td><td><img src="https://l.habyby.net/images/social/svg/redhat-logo-transparent.svg" width="30" alt="redhat"></td><td><code>redis</code></td><td><img src="https://l.habyby.net/images/social/svg/redis-logo-transparent.svg" width="30" alt="redis"></td><td><code>redux</code></td><td><img src="https://l.habyby.net/images/social/svg/redux-logo-transparent.svg" width="30" alt="redux"></td><td><code>regex</code></td><td><img src="https://l.habyby.net/images/social/svg/regex-logo-transparent.svg" width="30" alt="regex"></td></tr>
    <tr><td><code>remix</code></td><td><img src="https://l.habyby.net/images/social/svg/remix-logo-transparent.svg" width="30" alt="remix"></td><td><code>renren</code></td><td><img src="https://l.habyby.net/images/social/svg/renren-logo-transparent.svg" width="30" alt="renren"></td><td><code>replit</code></td><td><img src="https://l.habyby.net/images/social/svg/replit-logo-transparent.svg" width="30" alt="replit"></td><td><code>researchgate</code></td><td><img src="https://l.habyby.net/images/social/svg/researchgate-logo-transparent.svg" width="30" alt="researchgate"></td></tr>
    <tr><td><code>responsive-design</code></td><td><img src="https://l.habyby.net/images/social/svg/responsive-design-logo-transparent.svg" width="30" alt="responsive-design"></td><td><code>rest-api</code></td><td><img src="https://l.habyby.net/images/social/svg/rest-api-logo-transparent.svg" width="30" alt="rest-api"></td><td><code>rider</code></td><td><img src="https://l.habyby.net/images/social/svg/rider-logo-transparent.svg" width="30" alt="rider"></td><td><code>roadmap</code></td><td><img src="https://l.habyby.net/images/social/svg/roadmap-logo-transparent.svg" width="30" alt="roadmap"></td></tr>
    <tr><td><code>robloxstudio</code></td><td><img src="https://l.habyby.net/images/social/svg/robloxstudio-logo-transparent.svg" width="30" alt="robloxstudio"></td><td><code>rocket</code></td><td><img src="https://l.habyby.net/images/social/svg/rocket-logo-transparent.svg" width="30" alt="rocket"></td><td><code>rollupjs</code></td><td><img src="https://l.habyby.net/images/social/svg/rollupjs-logo-transparent.svg" width="30" alt="rollupjs"></td><td><code>ros</code></td><td><img src="https://l.habyby.net/images/social/svg/ros-logo-transparent.svg" width="30" alt="ros"></td></tr>
    <tr><td><code>rss</code></td><td><img src="https://l.habyby.net/images/social/svg/rss-logo-transparent.svg" width="30" alt="rss"></td><td><code>ruby</code></td><td><img src="https://l.habyby.net/images/social/svg/ruby-logo-transparent.svg" width="30" alt="ruby"></td><td><code>rumble</code></td><td><img src="https://l.habyby.net/images/social/svg/rumble-logo-transparent.svg" width="30" alt="rumble"></td><td><code>rust</code></td><td><img src="https://l.habyby.net/images/social/svg/rust-logo-transparent.svg" width="30" alt="rust"></td></tr>
    <tr><td><code>safari</code></td><td><img src="https://l.habyby.net/images/social/svg/safari-logo-transparent.svg" width="30" alt="safari"></td><td><code>sap</code></td><td><img src="https://l.habyby.net/images/social/svg/sap-logo-transparent.svg" width="30" alt="sap"></td><td><code>sass</code></td><td><img src="https://l.habyby.net/images/social/svg/sass-logo-transparent.svg" width="30" alt="sass"></td><td><code>save</code></td><td><img src="https://l.habyby.net/images/social/svg/save-logo-transparent.svg" width="30" alt="save"></td></tr>
    <tr><td><code>scala</code></td><td><img src="https://l.habyby.net/images/social/svg/scala-logo-transparent.svg" width="30" alt="scala"></td><td><code>scalability</code></td><td><img src="https://l.habyby.net/images/social/svg/scalability-logo-transparent.svg" width="30" alt="scalability"></td><td><code>scikit-learn</code></td><td><img src="https://l.habyby.net/images/social/svg/scikit-learn-logo-transparent.svg" width="30" alt="scikit-learn"></td><td><code>scss</code></td><td><img src="https://l.habyby.net/images/social/svg/scss-logo-transparent.svg" width="30" alt="scss"></td></tr>
    <tr><td><code>seaborn</code></td><td><img src="https://l.habyby.net/images/social/svg/Seaborn-logo-transparent.svg" width="30" alt="seaborn"></td><td><code>security</code></td><td><img src="https://l.habyby.net/images/social/svg/security-logo-transparent.svg" width="30" alt="security"></td><td><code>selenium</code></td><td><img src="https://l.habyby.net/images/social/svg/selenium-logo-transparent.svg" width="30" alt="selenium"></td><td><code>sentry</code></td><td><img src="https://l.habyby.net/images/social/svg/sentry-logo-transparent.svg" width="30" alt="sentry"></td></tr>
    <tr><td><code>sequelize</code></td><td><img src="https://l.habyby.net/images/social/svg/sequelize-logo-transparent.svg" width="30" alt="sequelize"></td><td><code>server</code></td><td><img src="https://l.habyby.net/images/social/svg/server-logo-transparent.svg" width="30" alt="server"></td><td><code>shahid</code></td><td><img src="https://l.habyby.net/images/social/svg/shahid-logo-transparent.svg" width="30" alt="shahid"></td><td><code>sharechat</code></td><td><img src="https://l.habyby.net/images/social/svg/sharechat-logo-transparent.svg" width="30" alt="sharechat"></td></tr>
    <tr><td><code>shell</code></td><td><img src="https://l.habyby.net/images/social/svg/shell-logo-transparent.svg" width="30" alt="shell"></td><td><code>shopify</code></td><td><img src="https://l.habyby.net/images/social/svg/shopify-logo-transparent.svg" width="30" alt="shopify"></td><td><code>silent-notification</code></td><td><img src="https://l.habyby.net/images/social/svg/silent-notification-logo-transparent.svg" width="30" alt="silent-notification"></td><td><code>sketch</code></td><td><img src="https://l.habyby.net/images/social/svg/sketch-logo-transparent.svg" width="30" alt="sketch"></td></tr>
    <tr><td><code>sketchfab</code></td><td><img src="https://l.habyby.net/images/social/svg/sketchfab-logo-transparent.svg" width="30" alt="sketchfab"></td><td><code>sketchup</code></td><td><img src="https://l.habyby.net/images/social/svg/sketchup-logo-transparent.svg" width="30" alt="sketchup"></td><td><code>skype</code></td><td><img src="https://l.habyby.net/images/social/svg/skype-logo-transparent.svg" width="30" alt="skype"></td><td><code>snapchat</code></td><td><img src="https://l.habyby.net/images/social/svg/snapchat-logo-transparent.svg" width="30" alt="snapchat"></td></tr>
    <tr><td><code>social-media-seo</code></td><td><img src="https://l.habyby.net/images/social/svg/social-media-seo-logo-transparent.svg" width="30" alt="social-media-seo"></td><td><code>social-media-sharing</code></td><td><img src="https://l.habyby.net/images/social/svg/social-media-sharing-logo-transparent.svg" width="30" alt="social-media-sharing"></td><td><code>solidity</code></td><td><img src="https://l.habyby.net/images/social/svg/solidity-logo-transparent.svg" width="30" alt="solidity"></td><td><code>solidjs</code></td><td><img src="https://l.habyby.net/images/social/svg/solidjs-logo-transparent.svg" width="30" alt="solidjs"></td></tr>
    <tr><td><code>soundcloud</code></td><td><img src="https://l.habyby.net/images/social/svg/soundcloud-logo-transparent.svg" width="30" alt="soundcloud"></td><td><code>spotify</code></td><td><img src="https://l.habyby.net/images/social/svg/spotify-logo-transparent.svg" width="30" alt="spotify"></td><td><code>spreely</code></td><td><img src="https://l.habyby.net/images/social/svg/spreely-logo-transparent.svg" width="30" alt="spreely"></td><td><code>spring</code></td><td><img src="https://l.habyby.net/images/social/svg/spring-logo-transparent.svg" width="30" alt="spring"></td></tr>
    <tr><td><code>sql</code></td><td><img src="https://l.habyby.net/images/social/svg/sql-logo-transparent.svg" width="30" alt="sql"></td><td><code>sqlite</code></td><td><img src="https://l.habyby.net/images/social/svg/sqlite-logo-transparent.svg" width="30" alt="sqlite"></td><td><code>stackoverflow</code></td><td><img src="https://l.habyby.net/images/social/svg/stackoverflow-logo-transparent.svg" width="30" alt="stackoverflow"></td><td><code>steam</code></td><td><img src="https://l.habyby.net/images/social/svg/steam-logo-transparent.svg" width="30" alt="steam"></td></tr>
    <tr><td><code>steemit</code></td><td><img src="https://l.habyby.net/images/social/svg/steemit-logo-transparent.svg" width="30" alt="steemit"></td><td><code>streamlit</code></td><td><img src="https://l.habyby.net/images/social/svg/streamlit-logo-transparent.svg" width="30" alt="streamlit"></td><td><code>styled-components</code></td><td><img src="https://l.habyby.net/images/social/svg/styled-components-logo-transparent.svg" width="30" alt="styled-components"></td><td><code>sublime</code></td><td><img src="https://l.habyby.net/images/social/svg/sublime-logo-transparent.svg" width="30" alt="sublime"></td></tr>
    <tr><td><code>supabase</code></td><td><img src="https://l.habyby.net/images/social/svg/supabase-logo-transparent.svg" width="30" alt="supabase"></td><td><code>svelte</code></td><td><img src="https://l.habyby.net/images/social/svg/svelte-logo-transparent.svg" width="30" alt="svelte"></td><td><code>svg</code></td><td><img src="https://l.habyby.net/images/social/svg/svg-logo-transparent.svg" width="30" alt="svg"></td><td><code>swagger</code></td><td><img src="https://l.habyby.net/images/social/svg/swagger-logo-transparent.svg" width="30" alt="swagger"></td></tr>
    <tr><td><code>swift</code></td><td><img src="https://l.habyby.net/images/social/svg/swift-logo-transparent.svg" width="30" alt="swift"></td><td><code>symfony</code></td><td><img src="https://l.habyby.net/images/social/svg/symfony-logo-transparent.svg" width="30" alt="symfony"></td><td><code>tagged</code></td><td><img src="https://l.habyby.net/images/social/svg/tagged-logo-transparent.svg" width="30" alt="tagged"></td><td><code>tailwind</code></td><td><img src="https://l.habyby.net/images/social/svg/tailwind-logo-transparent.svg" width="30" alt="tailwind"></td></tr>
    <tr><td><code>taringa</code></td><td><img src="https://l.habyby.net/images/social/svg/taringa-logo-transparent.svg" width="30" alt="taringa"></td><td><code>tauri</code></td><td><img src="https://l.habyby.net/images/social/svg/tauri-logo-transparent.svg" width="30" alt="tauri"></td><td><code>teams</code></td><td><img src="https://l.habyby.net/images/social/svg/teams-logo-transparent.svg" width="30" alt="teams"></td><td><code>telegram</code></td><td><img src="https://l.habyby.net/images/social/svg/telegram-logo-transparent.svg" width="30" alt="telegram"></td></tr>
    <tr><td><code>tensorflow</code></td><td><img src="https://l.habyby.net/images/social/svg/tensorflow-logo-transparent.svg" width="30" alt="tensorflow"></td><td><code>terraform</code></td><td><img src="https://l.habyby.net/images/social/svg/terraform-logo-transparent.svg" width="30" alt="terraform"></td><td><code>testing</code></td><td><img src="https://l.habyby.net/images/social/svg/testing-logo-transparent.svg" width="30" alt="testing"></td><td><code>the-dots</code></td><td><img src="https://l.habyby.net/images/social/svg/the-dots-logo-transparent.svg" width="30" alt="the-dots"></td></tr>
    <tr><td><code>threejs</code></td><td><img src="https://l.habyby.net/images/social/svg/threejs-logo-transparent.svg" width="30" alt="threejs"></td><td><code>tiktok</code></td><td><img src="https://l.habyby.net/images/social/svg/tiktok-logo-transparent.svg" width="30" alt="tiktok"></td><td><code>tinder</code></td><td><img src="https://l.habyby.net/images/social/svg/tinder-logo-transparent.svg" width="30" alt="tinder"></td><td><code>tout</code></td><td><img src="https://l.habyby.net/images/social/svg/tout-logo-transparent.svg" width="30" alt="tout"></td></tr>
    <tr><td><code>tribe</code></td><td><img src="https://l.habyby.net/images/social/svg/tribe-logo-transparent.svg" width="30" alt="tribe"></td><td><code>triller</code></td><td><img src="https://l.habyby.net/images/social/svg/triller-logo-transparent.svg" width="30" alt="triller"></td><td><code>tumblr</code></td><td><img src="https://l.habyby.net/images/social/svg/tumblr-logo-transparent.svg" width="30" alt="tumblr"></td><td><code>twitch</code></td><td><img src="https://l.habyby.net/images/social/svg/twitch-logo-transparent.svg" width="30" alt="twitch"></td></tr>
    <tr><td><code>twitter</code></td><td><img src="https://l.habyby.net/images/social/svg/twitter-logo-transparent.svg" width="30" alt="twitter"></td><td><code>typescript</code></td><td><img src="https://l.habyby.net/images/social/svg/typescript-logo-transparent.svg" width="30" alt="typescript"></td><td><code>ubuntu</code></td><td><img src="https://l.habyby.net/images/social/svg/ubuntu-logo-transparent.svg" width="30" alt="ubuntu"></td><td><code>ui-ux-design</code></td><td><img src="https://l.habyby.net/images/social/svg/ui-ux-design-logo-transparent.svg" width="30" alt="ui-ux-design"></td></tr>
    <tr><td><code>unity</code></td><td><img src="https://l.habyby.net/images/social/svg/unity-logo-transparent.svg" width="30" alt="unity"></td><td><code>unreal</code></td><td><img src="https://l.habyby.net/images/social/svg/unreal-logo-transparent.svg" width="30" alt="unreal"></td><td><code>upload</code></td><td><img src="https://l.habyby.net/images/social/svg/upload-logo-transparent.svg" width="30" alt="upload"></td><td><code>user-acceptance-testing</code></td><td><img src="https://l.habyby.net/images/social/svg/user-acceptance-testing-logo-transparent.svg" width="30" alt="user-acceptance-testing"></td></tr>
    <tr><td><code>v</code></td><td><img src="https://l.habyby.net/images/social/svg/v-logo-transparent.svg" width="30" alt="v"></td><td><code>vala</code></td><td><img src="https://l.habyby.net/images/social/svg/vala-logo-transparent.svg" width="30" alt="vala"></td><td><code>valence</code></td><td><img src="https://l.habyby.net/images/social/svg/valence-logo-transparent.svg" width="30" alt="valence"></td><td><code>vercel</code></td><td><img src="https://l.habyby.net/images/social/svg/vercel-logo-transparent.svg" width="30" alt="vercel"></td></tr>
    <tr><td><code>vero</code></td><td><img src="https://l.habyby.net/images/social/svg/vero-logo-transparent.svg" width="30" alt="vero"></td><td><code>viadeo</code></td><td><img src="https://l.habyby.net/images/social/svg/viadeo-logo-transparent.svg" width="30" alt="viadeo"></td><td><code>viber</code></td><td><img src="https://l.habyby.net/images/social/svg/viber-logo-transparent.svg" width="30" alt="viber"></td><td><code>video</code></td><td><img src="https://l.habyby.net/images/social/svg/video-logo-transparent.svg" width="30" alt="video"></td></tr>
    <tr><td><code>videocv</code></td><td><img src="https://l.habyby.net/images/social/svg/videocv-logo-transparent.svg" width="30" alt="videocv"></td><td><code>viem</code></td><td><img src="https://l.habyby.net/images/social/svg/viem-logo-transparent.svg" width="30" alt="viem"></td><td><code>vim</code></td><td><img src="https://l.habyby.net/images/social/svg/vim-logo-transparent.svg" width="30" alt="vim"></td><td><code>vimeo</code></td><td><img src="https://l.habyby.net/images/social/svg/vimeo-logo-transparent.svg" width="30" alt="vimeo"></td></tr>
    <tr><td><code>visualization</code></td><td><img src="https://l.habyby.net/images/social/svg/visualization-logo-transparent.svg" width="30" alt="visualization"></td><td><code>vite</code></td><td><img src="https://l.habyby.net/images/social/svg/vite-logo-transparent.svg" width="30" alt="vite"></td><td><code>vk</code></td><td><img src="https://l.habyby.net/images/social/svg/vk-logo-transparent.svg" width="30" alt="vk"></td><td><code>vscode</code></td><td><img src="https://l.habyby.net/images/social/svg/vscode-logo-transparent.svg" width="30" alt="vscode"></td></tr>
    <tr><td><code>vscodium</code></td><td><img src="https://l.habyby.net/images/social/svg/vscodium-logo-transparent.svg" width="30" alt="vscodium"></td><td><code>vuejs</code></td><td><img src="https://l.habyby.net/images/social/svg/vuejs-logo-transparent.svg" width="30" alt="vuejs"></td><td><code>vuetify</code></td><td><img src="https://l.habyby.net/images/social/svg/vuetify-logo-transparent.svg" width="30" alt="vuetify"></td><td><code>wamp</code></td><td><img src="https://l.habyby.net/images/social/svg/wamp-logo-transparent.svg" width="30" alt="wamp"></td></tr>
    <tr><td><code>wasm</code></td><td><img src="https://l.habyby.net/images/social/svg/wasm-logo-transparent.svg" width="30" alt="wasm"></td><td><code>wattpad</code></td><td><img src="https://l.habyby.net/images/social/svg/wattpad-logo-transparent.svg" width="30" alt="wattpad"></td><td><code>web-hosting</code></td><td><img src="https://l.habyby.net/images/social/svg/web-hosting-logo-transparent.svg" width="30" alt="web-hosting"></td><td><code>webaudio</code></td><td><img src="https://l.habyby.net/images/social/svg/webaudio-logo-transparent.svg" width="30" alt="webaudio"></td></tr>
    <tr><td><code>webflow</code></td><td><img src="https://l.habyby.net/images/social/svg/webflow-logo-transparent.svg" width="30" alt="webflow"></td><td><code>webgpu</code></td><td><img src="https://l.habyby.net/images/social/svg/webgpu-logo-transparent.svg" width="30" alt="webgpu"></td><td><code>webllm</code></td><td><img src="https://l.habyby.net/images/social/svg/webllm-logo-transparent.svg" width="30" alt="webllm"></td><td><code>webpack</code></td><td><img src="https://l.habyby.net/images/social/svg/webpack-logo-transparent.svg" width="30" alt="webpack"></td></tr>
    <tr><td><code>webstorm</code></td><td><img src="https://l.habyby.net/images/social/svg/webstorm-logo-transparent.svg" width="30" alt="webstorm"></td><td><code>wechat</code></td><td><img src="https://l.habyby.net/images/social/svg/wechat-logo-transparent.svg" width="30" alt="wechat"></td><td><code>weheartit</code></td><td><img src="https://l.habyby.net/images/social/svg/weheartit-logo-transparent.svg" width="30" alt="weheartit"></td><td><code>weibo</code></td><td><img src="https://l.habyby.net/images/social/svg/weibo-logo-transparent.svg" width="30" alt="weibo"></td></tr>
    <tr><td><code>whatsapp</code></td><td><img src="https://l.habyby.net/images/social/svg/whatsapp-logo-transparent.svg" width="30" alt="whatsapp"></td><td><code>windicss</code></td><td><img src="https://l.habyby.net/images/social/svg/windicss-logo-transparent.svg" width="30" alt="windicss"></td><td><code>windows</code></td><td><img src="https://l.habyby.net/images/social/svg/windows-logo-transparent.svg" width="30" alt="windows"></td><td><code>wix</code></td><td><img src="https://l.habyby.net/images/social/svg/wix-logo-transparent.svg" width="30" alt="wix"></td></tr>
    <tr><td><code>word</code></td><td><img src="https://l.habyby.net/images/social/svg/word-logo-transparent.svg" width="30" alt="word"></td><td><code>wordpress</code></td><td><img src="https://l.habyby.net/images/social/svg/wordpress-logo-transparent.svg" width="30" alt="wordpress"></td><td><code>workflows</code></td><td><img src="https://l.habyby.net/images/social/svg/workflows-logo-transparent.svg" width="30" alt="workflows"></td><td><code>wt-social</code></td><td><img src="https://l.habyby.net/images/social/svg/wt-social-logo-transparent.svg" width="30" alt="wt-social"></td></tr>
    <tr><td><code>x</code></td><td><img src="https://l.habyby.net/images/social/svg/x-logo-transparent.svg" width="30" alt="x"></td><td><code>xampp</code></td><td><img src="https://l.habyby.net/images/social/svg/xampp-logo-transparent.svg" width="30" alt="xampp"></td><td><code>xcode</code></td><td><img src="https://l.habyby.net/images/social/svg/xcode-logo-transparent.svg" width="30" alt="xcode"></td><td><code>xd</code></td><td><img src="https://l.habyby.net/images/social/svg/xd-logo-transparent.svg" width="30" alt="xd"></td></tr>
    <tr><td><code>xgboost</code></td><td><img src="https://l.habyby.net/images/social/svg/xgboost-logo-transparent.svg" width="30" alt="xgboost"></td><td><code>xing</code></td><td><img src="https://l.habyby.net/images/social/svg/xing-logo-transparent.svg" width="30" alt="xing"></td><td><code>xml</code></td><td><img src="https://l.habyby.net/images/social/svg/xml-logo-transparent.svg" width="30" alt="xml"></td><td><code>yahoo</code></td><td><img src="https://l.habyby.net/images/social/svg/yahoo-logo-transparent.svg" width="30" alt="yahoo"></td></tr>
    <tr><td><code>yarn</code></td><td><img src="https://l.habyby.net/images/social/svg/yarn-logo-transparent.svg" width="30" alt="yarn"></td><td><code>yew</code></td><td><img src="https://l.habyby.net/images/social/svg/yew-logo-transparent.svg" width="30" alt="yew"></td><td><code>youtube</code></td><td><img src="https://l.habyby.net/images/social/svg/youtube-logo-transparent.svg" width="30" alt="youtube"></td><td><code>yubo</code></td><td><img src="https://l.habyby.net/images/social/svg/yubo-logo-transparent.svg" width="30" alt="yubo"></td></tr>
    <tr><td><code>yy</code></td><td><img src="https://l.habyby.net/images/social/svg/yy-logo-transparent.svg" width="30" alt="yy"></td><td><code>zig</code></td><td><img src="https://l.habyby.net/images/social/svg/zig-logo-transparent.svg" width="30" alt="zig"></td><td></td><td></td><td></td><td></td></tr>
  </tbody>
</table>
<!-- LOGOS_TABLE_END -->

## About

LHabyby Icons API is a developer resource for retrieving supported SVG logos through a simple web API.

Created by **Eng. Ihab Elkady**.

Website: [https://ihab.habyby.net/](https://ihab.habyby.net/)

---

**Trademark notice:** Third-party logos and brand names belong to their respective owners. Their use may be subject to each owner's trademark and usage requirements.
