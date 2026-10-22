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

---
## Supported Icons

The Habyby Icons API currently provides **186 icons**. Replace `{icon}` with any supported icon name to request its data.

**Get the complete list:** [View all supported icons in JSON](https://l.habyby.net/logo.php?format=list)

| Icon | Preview | Icon | Preview | Icon | Preview | Icon | Preview |
|---|---|---|---|---|---|---|---|
| `500px` | <img src="https://l.habyby.net/images/social/svg/500px-logo-transparent.svg" width="30" alt="500px"> | `adminltr` | <img src="https://l.habyby.net/images/social/svg/adminltr-logo-transparent.svg" width="30" alt="adminltr"> | `adobe-acrobat` | <img src="https://l.habyby.net/images/social/svg/adobe-acrobat-logo-transparent.svg" width="30" alt="adobe-acrobat"> | `ajax` | <img src="https://l.habyby.net/images/social/svg/ajax-logo-transparent.svg" width="30" alt="ajax"> |
| `android-studio` | <img src="https://l.habyby.net/images/social/svg/android-studio-logo-transparent.svg" width="30" alt="android-studio"> | `angular` | <img src="https://l.habyby.net/images/social/svg/angular-logo-transparent.svg" width="30" alt="angular"> | `appletv` | <img src="https://l.habyby.net/images/social/svg/appletv-logo-transparent.svg" width="30" alt="appletv"> | `aspnet` | <img src="https://l.habyby.net/images/social/svg/aspnet-logo-transparent.svg" width="30" alt="aspnet"> |
| `aws` | <img src="https://l.habyby.net/images/social/svg/aws-logo-transparent.svg" width="30" alt="aws"> | `azure` | <img src="https://l.habyby.net/images/social/svg/azure-logo-transparent.svg" width="30" alt="azure"> | `behance` | <img src="https://l.habyby.net/images/social/svg/behance-logo-transparent.svg" width="30" alt="behance"> | `blogger` | <img src="https://l.habyby.net/images/social/svg/blogger-logo-transparent.svg" width="30" alt="blogger"> |
| `bookcrossing` | <img src="https://l.habyby.net/images/social/svg/bookcrossing-logo-transparent.svg" width="30" alt="bookcrossing"> | `bootstrap` | <img src="https://l.habyby.net/images/social/svg/bootstrap-logo-transparent.svg" width="30" alt="bootstrap"> | `cloudflare` | <img src="https://l.habyby.net/images/social/svg/cloudflare-logo-transparent.svg" width="30" alt="cloudflare"> | `cms` | <img src="https://l.habyby.net/images/social/svg/cms-logo-transparent.svg" width="30" alt="cms"> |
| `cpp` | <img src="https://l.habyby.net/images/social/svg/cpp-logo-transparent.svg" width="30" alt="cpp"> | `cross-browser-testing` | <img src="https://l.habyby.net/images/social/svg/cross-browser-testing-logo-transparent.svg" width="30" alt="cross-browser-testing"> | `csharp` | <img src="https://l.habyby.net/images/social/svg/csharp-logo-transparent.svg" width="30" alt="csharp"> | `css3` | <img src="https://l.habyby.net/images/social/svg/css3-logo-transparent.svg" width="30" alt="css3"> |
| `cv` | <img src="https://l.habyby.net/images/social/svg/cv-logo-transparent.svg" width="30" alt="cv"> | `cv-ehab` | <img src="https://l.habyby.net/images/social/svg/cv-ehab-logo-transparent.svg" width="30" alt="cv-ehab"> | `dart` | <img src="https://l.habyby.net/images/social/svg/dart-logo-transparent.svg" width="30" alt="dart"> | `databases-hosting` | <img src="https://l.habyby.net/images/social/svg/databases-hosting-logo-transparent.svg" width="30" alt="databases-hosting"> |
| `default` | <img src="https://l.habyby.net/images/social/svg/default-logo-transparent.svg" width="30" alt="default"> | `default2` | <img src="https://l.habyby.net/images/social/svg/default2-logo-transparent.svg" width="30" alt="default2"> | `default3` | <img src="https://l.habyby.net/images/social/svg/default3-logo-transparent.svg" width="30" alt="default3"> | `default4` | <img src="https://l.habyby.net/images/social/svg/default4-logo-transparent.svg" width="30" alt="default4"> |
| `default5` | <img src="https://l.habyby.net/images/social/svg/default5-logo-transparent.svg" width="30" alt="default5"> | `default6` | <img src="https://l.habyby.net/images/social/svg/default6-logo-transparent.svg" width="30" alt="default6"> | `design-multimedia` | <img src="https://l.habyby.net/images/social/svg/design-multimedia-logo-transparent.svg" width="30" alt="design-multimedia"> | `deviantart` | <img src="https://l.habyby.net/images/social/svg/deviantart-logo-transparent.svg" width="30" alt="deviantart"> |
| `dibbble` | <img src="https://l.habyby.net/images/social/svg/dibbble-logo-transparent.svg" width="30" alt="dibbble"> | `discord` | <img src="https://l.habyby.net/images/social/svg/discord-logo-transparent.svg" width="30" alt="discord"> | `docker` | <img src="https://l.habyby.net/images/social/svg/docker-logo-transparent.svg" width="30" alt="docker"> | `douban` | <img src="https://l.habyby.net/images/social/svg/douban-logo-transparent.svg" width="30" alt="douban"> |
| `dreamwidth` | <img src="https://l.habyby.net/images/social/svg/dreamwidth-logo-transparent.svg" width="30" alt="dreamwidth"> | `dropbox` | <img src="https://l.habyby.net/images/social/svg/dropbox-logo-transparent.svg" width="30" alt="dropbox"> | `ello` | <img src="https://l.habyby.net/images/social/svg/ello-logo-transparent.svg" width="30" alt="ello"> | `elpha` | <img src="https://l.habyby.net/images/social/svg/elpha-logo-transparent.svg" width="30" alt="elpha"> |
| `email` | <img src="https://l.habyby.net/images/social/svg/email-logo-transparent.svg" width="30" alt="email"> | `excel` | <img src="https://l.habyby.net/images/social/svg/excel-logo-transparent.svg" width="30" alt="excel"> | `facebook` | <img src="https://l.habyby.net/images/social/svg/facebook-logo-transparent.svg" width="30" alt="facebook"> | `figma` | <img src="https://l.habyby.net/images/social/svg/figma-logo-transparent.svg" width="30" alt="figma"> |
| `filmaffinity` | <img src="https://l.habyby.net/images/social/svg/filmaffinity-logo-transparent.svg" width="30" alt="filmaffinity"> | `filmora` | <img src="https://l.habyby.net/images/social/svg/filmora-logo-transparent.svg" width="30" alt="filmora"> | `fiverr` | <img src="https://l.habyby.net/images/social/svg/fiverr-logo-transparent.svg" width="30" alt="fiverr"> | `flickr` | <img src="https://l.habyby.net/images/social/svg/flickr-logo-transparent.svg" width="30" alt="flickr"> |
| `flip` | <img src="https://l.habyby.net/images/social/svg/flip-logo-transparent.svg" width="30" alt="flip"> | `flutter` | <img src="https://l.habyby.net/images/social/svg/flutter-logo-transparent.svg" width="30" alt="flutter"> | `foursquare` | <img src="https://l.habyby.net/images/social/svg/foursquare-logo-transparent.svg" width="30" alt="foursquare"> | `frameworks-optimization` | <img src="https://l.habyby.net/images/social/svg/frameworks-optimization-logo-transparent.svg" width="30" alt="frameworks-optimization"> |
| `functional-testing` | <img src="https://l.habyby.net/images/social/svg/functional-testing-logo-transparent.svg" width="30" alt="functional-testing"> | `gab` | <img src="https://l.habyby.net/images/social/svg/gab-logo-transparent.svg" width="30" alt="gab"> | `gaia-online` | <img src="https://l.habyby.net/images/social/svg/gaia-online-logo-transparent.svg" width="30" alt="gaia-online"> | `giphy` | <img src="https://l.habyby.net/images/social/svg/giphy-logo-transparent.svg" width="30" alt="giphy"> |
| `git` | <img src="https://l.habyby.net/images/social/svg/git-logo-transparent.svg" width="30" alt="git"> | `github` | <img src="https://l.habyby.net/images/social/svg/github-logo-transparent.svg" width="30" alt="github"> | `gmail` | <img src="https://l.habyby.net/images/social/svg/gmail-logo-transparent.svg" width="30" alt="gmail"> | `goodreads` | <img src="https://l.habyby.net/images/social/svg/goodreads-logo-transparent.svg" width="30" alt="goodreads"> |
| `google-ads` | <img src="https://l.habyby.net/images/social/svg/google-ads-logo-transparent.svg" width="30" alt="google-ads"> | `google-analytics` | <img src="https://l.habyby.net/images/social/svg/google-analytics-logo-transparent.svg" width="30" alt="google-analytics"> | `habyby` | <img src="https://l.habyby.net/images/social/svg/habyby-logo-transparent.svg" width="30" alt="habyby"> | `html5` | <img src="https://l.habyby.net/images/social/svg/html5-logo-transparent.svg" width="30" alt="html5"> |
| `illustrator` | <img src="https://l.habyby.net/images/social/svg/illustrator-logo-transparent.svg" width="30" alt="illustrator"> | `imdb` | <img src="https://l.habyby.net/images/social/svg/imdb-logo-transparent.svg" width="30" alt="imdb"> | `imgur` | <img src="https://l.habyby.net/images/social/svg/imgur-logo-transparent.svg" width="30" alt="imgur"> | `instagram` | <img src="https://l.habyby.net/images/social/svg/instagram-logo-transparent.svg" width="30" alt="instagram"> |
| `internations` | <img src="https://l.habyby.net/images/social/svg/internations-logo-transparent.svg" width="30" alt="internations"> | `italki` | <img src="https://l.habyby.net/images/social/svg/italki-logo-transparent.svg" width="30" alt="italki"> | `java` | <img src="https://l.habyby.net/images/social/svg/java-logo-transparent.svg" width="30" alt="java"> | `javascript` | <img src="https://l.habyby.net/images/social/svg/javascript-logo-transparent.svg" width="30" alt="javascript"> |
| `jquery` | <img src="https://l.habyby.net/images/social/svg/jquery-logo-transparent.svg" width="30" alt="jquery"> | `json` | <img src="https://l.habyby.net/images/social/svg/json-logo-transparent.svg" width="30" alt="json"> | `ko-fi` | <img src="https://l.habyby.net/images/social/svg/ko-fi-logo-transparent.svg" width="30" alt="ko-fi"> | `kotlin` | <img src="https://l.habyby.net/images/social/svg/kotlin-logo-transparent.svg" width="30" alt="kotlin"> |
| `kuaishou` | <img src="https://l.habyby.net/images/social/svg/kuaishou-logo-transparent.svg" width="30" alt="kuaishou"> | `librarything` | <img src="https://l.habyby.net/images/social/svg/librarything-logo-transparent.svg" width="30" alt="librarything"> | `likee` | <img src="https://l.habyby.net/images/social/svg/likee-logo-transparent.svg" width="30" alt="likee"> | `line` | <img src="https://l.habyby.net/images/social/svg/line-logo-transparent.svg" width="30" alt="line"> |
| `linkedin` | <img src="https://l.habyby.net/images/social/svg/linkedin-logo-transparent.svg" width="30" alt="linkedin"> | `linktree` | <img src="https://l.habyby.net/images/social/svg/linktree-logo-transparent.svg" width="30" alt="linktree"> | `linux` | <img src="https://l.habyby.net/images/social/svg/linux-logo-transparent.svg" width="30" alt="linux"> | `livejournal` | <img src="https://l.habyby.net/images/social/svg/livejournal-logo-transparent.svg" width="30" alt="livejournal"> |
| `logo-design` | <img src="https://l.habyby.net/images/social/svg/logo-design-logo-transparent.svg" width="30" alt="logo-design"> | `medium` | <img src="https://l.habyby.net/images/social/svg/medium-logo-transparent.svg" width="30" alt="medium"> | `meetme` | <img src="https://l.habyby.net/images/social/svg/meetme-logo-transparent.svg" width="30" alt="meetme"> | `meetup` | <img src="https://l.habyby.net/images/social/svg/meetup-logo-transparent.svg" width="30" alt="meetup"> |
| `messenger` | <img src="https://l.habyby.net/images/social/svg/messenger-logo-transparent.svg" width="30" alt="messenger"> | `mewe` | <img src="https://l.habyby.net/images/social/svg/mewe-logo-transparent.svg" width="30" alt="mewe"> | `microsoft-office` | <img src="https://l.habyby.net/images/social/svg/microsoft-office-logo-transparent.svg" width="30" alt="microsoft-office"> | `mix` | <img src="https://l.habyby.net/images/social/svg/mix-logo-transparent.svg" width="30" alt="mix"> |
| `mixi` | <img src="https://l.habyby.net/images/social/svg/mixi-logo-transparent.svg" width="30" alt="mixi"> | `mocospace` | <img src="https://l.habyby.net/images/social/svg/mocospace-logo-transparent.svg" width="30" alt="mocospace"> | `myheritage` | <img src="https://l.habyby.net/images/social/svg/myheritage-logo-transparent.svg" width="30" alt="myheritage"> | `myspace` | <img src="https://l.habyby.net/images/social/svg/myspace-logo-transparent.svg" width="30" alt="myspace"> |
| `mysql` | <img src="https://l.habyby.net/images/social/svg/mysql-logo-transparent.svg" width="30" alt="mysql"> | `netflix` | <img src="https://l.habyby.net/images/social/svg/netflix-logo-transparent.svg" width="30" alt="netflix"> | `nextdoor` | <img src="https://l.habyby.net/images/social/svg/nextdoor-logo-transparent.svg" width="30" alt="nextdoor"> | `nextjs` | <img src="https://l.habyby.net/images/social/svg/nextjs-logo-transparent.svg" width="30" alt="nextjs"> |
| `nodejs` | <img src="https://l.habyby.net/images/social/svg/nodejs-logo-transparent.svg" width="30" alt="nodejs"> | `opendiary` | <img src="https://l.habyby.net/images/social/svg/opendiary-logo-transparent.svg" width="30" alt="opendiary"> | `patreon` | <img src="https://l.habyby.net/images/social/svg/patreon-logo-transparent.svg" width="30" alt="patreon"> | `pdf` | <img src="https://l.habyby.net/images/social/svg/pdf-logo-transparent.svg" width="30" alt="pdf"> |
| `peanut` | <img src="https://l.habyby.net/images/social/svg/peanut-logo-transparent.svg" width="30" alt="peanut"> | `performance-testing` | <img src="https://l.habyby.net/images/social/svg/performance-testing-logo-transparent.svg" width="30" alt="performance-testing"> | `phone` | <img src="https://l.habyby.net/images/social/svg/phone-logo-transparent.svg" width="30" alt="phone"> | `photoshop` | <img src="https://l.habyby.net/images/social/svg/photoshop-logo-transparent.svg" width="30" alt="photoshop"> |
| `php` | <img src="https://l.habyby.net/images/social/svg/php-logo-transparent.svg" width="30" alt="php"> | `pinterest` | <img src="https://l.habyby.net/images/social/svg/pinterest-logo-transparent.svg" width="30" alt="pinterest"> | `portfolio` | <img src="https://l.habyby.net/images/social/svg/portfolio-logo-transparent.svg" width="30" alt="portfolio"> | `powerpoint` | <img src="https://l.habyby.net/images/social/svg/powerpoint-logo-transparent.svg" width="30" alt="powerpoint"> |
| `primevideo` | <img src="https://l.habyby.net/images/social/svg/primevideo-logo-transparent.svg" width="30" alt="primevideo"> | `python` | <img src="https://l.habyby.net/images/social/svg/python-logo-transparent.svg" width="30" alt="python"> | `qq` | <img src="https://l.habyby.net/images/social/svg/qq-logo-transparent.svg" width="30" alt="qq"> | `quora` | <img src="https://l.habyby.net/images/social/svg/quora-logo-transparent.svg" width="30" alt="quora"> |
| `qzone` | <img src="https://l.habyby.net/images/social/svg/qzone-logo-transparent.svg" width="30" alt="qzone"> | `ravelry` | <img src="https://l.habyby.net/images/social/svg/ravelry-logo-transparent.svg" width="30" alt="ravelry"> | `react` | <img src="https://l.habyby.net/images/social/svg/react-logo-transparent.svg" width="30" alt="react"> | `reddit` | <img src="https://l.habyby.net/images/social/svg/reddit-logo-transparent.svg" width="30" alt="reddit"> |
| `redux` | <img src="https://l.habyby.net/images/social/svg/redux-logo-transparent.svg" width="30" alt="redux"> | `renren` | <img src="https://l.habyby.net/images/social/svg/renren-logo-transparent.svg" width="30" alt="renren"> | `responsive-design` | <img src="https://l.habyby.net/images/social/svg/responsive-design-logo-transparent.svg" width="30" alt="responsive-design"> | `rss` | <img src="https://l.habyby.net/images/social/svg/rss-logo-transparent.svg" width="30" alt="rss"> |
| `rumble` | <img src="https://l.habyby.net/images/social/svg/rumble-logo-transparent.svg" width="30" alt="rumble"> | `sass` | <img src="https://l.habyby.net/images/social/svg/sass-logo-transparent.svg" width="30" alt="sass"> | `shahid` | <img src="https://l.habyby.net/images/social/svg/shahid-logo-transparent.svg" width="30" alt="shahid"> | `sharechat` | <img src="https://l.habyby.net/images/social/svg/sharechat-logo-transparent.svg" width="30" alt="sharechat"> |
| `shopify` | <img src="https://l.habyby.net/images/social/svg/shopify-logo-transparent.svg" width="30" alt="shopify"> | `sketchfab` | <img src="https://l.habyby.net/images/social/svg/sketchfab-logo-transparent.svg" width="30" alt="sketchfab"> | `skype` | <img src="https://l.habyby.net/images/social/svg/skype-logo-transparent.svg" width="30" alt="skype"> | `snapchat` | <img src="https://l.habyby.net/images/social/svg/snapchat-logo-transparent.svg" width="30" alt="snapchat"> |
| `social-media-seo` | <img src="https://l.habyby.net/images/social/svg/social-media-seo-logo-transparent.svg" width="30" alt="social-media-seo"> | `social-media-sharing` | <img src="https://l.habyby.net/images/social/svg/social-media-sharing-logo-transparent.svg" width="30" alt="social-media-sharing"> | `soundcloud` | <img src="https://l.habyby.net/images/social/svg/soundcloud-logo-transparent.svg" width="30" alt="soundcloud"> | `spotify` | <img src="https://l.habyby.net/images/social/svg/spotify-logo-transparent.svg" width="30" alt="spotify"> |
| `spreely` | <img src="https://l.habyby.net/images/social/svg/spreely-logo-transparent.svg" width="30" alt="spreely"> | `stackoverflow` | <img src="https://l.habyby.net/images/social/svg/stackoverflow-logo-transparent.svg" width="30" alt="stackoverflow"> | `steam` | <img src="https://l.habyby.net/images/social/svg/steam-logo-transparent.svg" width="30" alt="steam"> | `steemit` | <img src="https://l.habyby.net/images/social/svg/steemit-logo-transparent.svg" width="30" alt="steemit"> |
| `swift` | <img src="https://l.habyby.net/images/social/svg/swift-logo-transparent.svg" width="30" alt="swift"> | `tagged` | <img src="https://l.habyby.net/images/social/svg/tagged-logo-transparent.svg" width="30" alt="tagged"> | `tailwind` | <img src="https://l.habyby.net/images/social/svg/tailwind-logo-transparent.svg" width="30" alt="tailwind"> | `taringa` | <img src="https://l.habyby.net/images/social/svg/taringa-logo-transparent.svg" width="30" alt="taringa"> |
| `teams` | <img src="https://l.habyby.net/images/social/svg/teams-logo-transparent.svg" width="30" alt="teams"> | `telegram` | <img src="https://l.habyby.net/images/social/svg/telegram-logo-transparent.svg" width="30" alt="telegram"> | `testing` | <img src="https://l.habyby.net/images/social/svg/testing-logo-transparent.svg" width="30" alt="testing"> | `the-dots` | <img src="https://l.habyby.net/images/social/svg/the-dots-logo-transparent.svg" width="30" alt="the-dots"> |
| `tiktok` | <img src="https://l.habyby.net/images/social/svg/tiktok-logo-transparent.svg" width="30" alt="tiktok"> | `tinder` | <img src="https://l.habyby.net/images/social/svg/tinder-logo-transparent.svg" width="30" alt="tinder"> | `tribe` | <img src="https://l.habyby.net/images/social/svg/tribe-logo-transparent.svg" width="30" alt="tribe"> | `triller` | <img src="https://l.habyby.net/images/social/svg/triller-logo-transparent.svg" width="30" alt="triller"> |
| `tumblr` | <img src="https://l.habyby.net/images/social/svg/tumblr-logo-transparent.svg" width="30" alt="tumblr"> | `twitch` | <img src="https://l.habyby.net/images/social/svg/twitch-logo-transparent.svg" width="30" alt="twitch"> | `typescript` | <img src="https://l.habyby.net/images/social/svg/typescript-logo-transparent.svg" width="30" alt="typescript"> | `ui-ux-design` | <img src="https://l.habyby.net/images/social/svg/ui-ux-design-logo-transparent.svg" width="30" alt="ui-ux-design"> |
| `user-acceptance-testing` | <img src="https://l.habyby.net/images/social/svg/user-acceptance-testing-logo-transparent.svg" width="30" alt="user-acceptance-testing"> | `valence` | <img src="https://l.habyby.net/images/social/svg/valence-logo-transparent.svg" width="30" alt="valence"> | `vero` | <img src="https://l.habyby.net/images/social/svg/vero-logo-transparent.svg" width="30" alt="vero"> | `viadeo` | <img src="https://l.habyby.net/images/social/svg/viadeo-logo-transparent.svg" width="30" alt="viadeo"> |
| `viber` | <img src="https://l.habyby.net/images/social/svg/viber-logo-transparent.svg" width="30" alt="viber"> | `video` | <img src="https://l.habyby.net/images/social/svg/video-logo-transparent.svg" width="30" alt="video"> | `videocv` | <img src="https://l.habyby.net/images/social/svg/videocv-logo-transparent.svg" width="30" alt="videocv"> | `vimeo` | <img src="https://l.habyby.net/images/social/svg/vimeo-logo-transparent.svg" width="30" alt="vimeo"> |
| `vk` | <img src="https://l.habyby.net/images/social/svg/vk-logo-transparent.svg" width="30" alt="vk"> | `vscode` | <img src="https://l.habyby.net/images/social/svg/vscode-logo-transparent.svg" width="30" alt="vscode"> | `vuejs` | <img src="https://l.habyby.net/images/social/svg/vuejs-logo-transparent.svg" width="30" alt="vuejs"> | `wamp` | <img src="https://l.habyby.net/images/social/svg/wamp-logo-transparent.svg" width="30" alt="wamp"> |
| `wattpad` | <img src="https://l.habyby.net/images/social/svg/wattpad-logo-transparent.svg" width="30" alt="wattpad"> | `web-hosting` | <img src="https://l.habyby.net/images/social/svg/web-hosting-logo-transparent.svg" width="30" alt="web-hosting"> | `wechat` | <img src="https://l.habyby.net/images/social/svg/wechat-logo-transparent.svg" width="30" alt="wechat"> | `weheartit` | <img src="https://l.habyby.net/images/social/svg/weheartit-logo-transparent.svg" width="30" alt="weheartit"> |
| `weibo` | <img src="https://l.habyby.net/images/social/svg/weibo-logo-transparent.svg" width="30" alt="weibo"> | `whatsapp` | <img src="https://l.habyby.net/images/social/svg/whatsapp-logo-transparent.svg" width="30" alt="whatsapp"> | `wix` | <img src="https://l.habyby.net/images/social/svg/wix-logo-transparent.svg" width="30" alt="wix"> | `word` | <img src="https://l.habyby.net/images/social/svg/word-logo-transparent.svg" width="30" alt="word"> |
| `wordpress` | <img src="https://l.habyby.net/images/social/svg/wordpress-logo-transparent.svg" width="30" alt="wordpress"> | `wt-social` | <img src="https://l.habyby.net/images/social/svg/wt-social-logo-transparent.svg" width="30" alt="wt-social"> | `x` | <img src="https://l.habyby.net/images/social/svg/x-logo-transparent.svg" width="30" alt="x"> | `xcode` | <img src="https://l.habyby.net/images/social/svg/xcode-logo-transparent.svg" width="30" alt="xcode"> |
| `xing` | <img src="https://l.habyby.net/images/social/svg/xing-logo-transparent.svg" width="30" alt="xing"> | `xml` | <img src="https://l.habyby.net/images/social/svg/xml-logo-transparent.svg" width="30" alt="xml"> | `yahoo` | <img src="https://l.habyby.net/images/social/svg/yahoo-logo-transparent.svg" width="30" alt="yahoo"> | `youtube` | <img src="https://l.habyby.net/images/social/svg/youtube-logo-transparent.svg" width="30" alt="youtube"> |
| `yubo` | <img src="https://l.habyby.net/images/social/svg/yubo-logo-transparent.svg" width="30" alt="yubo"> | `yy` | <img src="https://l.habyby.net/images/social/svg/yy-logo-transparent.svg" width="30" alt="yy"> | | | | |
