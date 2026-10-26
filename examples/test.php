<?php
/*
 * LHabyby Icons API Tester
 * Tests: HTML, CSS, JavaScript, JSON, PHP, and multiple icons.
 */
$apiBase = 'https://l.habyby.net/logo.php';
$defaultName = 'github';

$name = strtolower(trim((string)($_GET['name'] ?? $defaultName)));

if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $name)) {
    $name = $defaultName;
}

$jsonUrl = $apiBase . '?name=' . rawurlencode($name) . '&format=json';
$svgUrl = $apiBase . '?name=' . rawurlencode($name) . '&format=svg';
$urlEndpoint = $apiBase . '?name=' . rawurlencode($name) . '&format=url';
$htmlEndpoint = $apiBase . '?name=' . rawurlencode($name) . '&format=html';

/**
 * Escape output for HTML.
 */
function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Check whether a value is an HTTP(S) URL.
 */
function isHttpUrl(string $value): bool
{
    return (bool) filter_var($value, FILTER_VALIDATE_URL)
        && in_array(
            strtolower((string) parse_url($value, PHP_URL_SCHEME)),
            ['http', 'https'],
            true
        );
}

/**
 * Find a logo URL in a single-logo JSON response.
 */
function findImageUrl(array $data): string
{
    foreach (['url', 'image', 'image_url', 'svg'] as $key) {
        if (isset($data[$key]) && is_string($data[$key]) && isHttpUrl($data[$key])) {
            return $data[$key];
        }
    }

    return '';
}

/**
 * Fetch JSON from the API using PHP.
 */
function fetchApiJson(string $url): array
{
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 8,
            'ignore_errors' => true,
            'header' => "Accept: application/json\r\n"
        ]
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        return [
            'error' => 'PHP could not connect to the API. Check outbound HTTPS access and PHP URL wrappers.'
        ];
    }

    $data = json_decode($response, true);

    if (!is_array($data)) {
        return [
            'error' => 'The API response was not valid JSON.'
        ];
    }

    return $data;
}

// Server-side PHP example: retrieve the selected logo's JSON.
$phpJson = fetchApiJson($jsonUrl);
$phpImageUrl = findImageUrl($phpJson);

$phpJsonText = json_encode(
    $phpJson,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

if ($phpJsonText === false) {
    $phpJsonText = '{}';
}

// HTML example.
$htmlExample = '<img src="' . $svgUrl . '" alt="' . $name . ' logo" width="64" height="64">';

// CSS example.
$cssExample = '.api-logo {' . "\n"
    . '    width: 64px;' . "\n"
    . '    height: 64px;' . "\n"
    . '    background-image: url("' . $svgUrl . '");' . "\n"
    . '    background-repeat: no-repeat;' . "\n"
    . '    background-position: center;' . "\n"
    . '    background-size: contain;' . "\n"
    . '}';

$jsExample = <<<'JS'
const apiUrl = 'API_JSON_URL';

fetch(apiUrl)
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const img = document.getElementById('myLogo');
        img.src = data.url;
        img.alt = data.title + ' logo';
    })
    .catch(console.error);
JS;

$jsExample = str_replace('API_JSON_URL', $jsonUrl, $jsExample);

$phpExample = <<<'PHP'
<?php
$apiUrl = 'API_JSON_URL';

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if (!empty($data['url'])) {
    echo '<img src="'
        . htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8')
        . '" alt="'
        . htmlspecialchars($data['title'] ?? 'Logo', ENT_QUOTES, 'UTF-8')
        . '" width="64" height="64">';
}
?>
PHP;

$phpExample = str_replace('API_JSON_URL', $jsonUrl, $phpExample);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="robots" content="index,follow"/>
<meta name="keywords" content="LHabyby Icons API Tester, icons API, social media icons, SVG logos, HTML, CSS, JavaScript, JSON, PHP, Habyby, LHabyby"/>
<meta name="RATING" content="GENERAL"/>
<meta http-equiv="Content-Language" content="en"/>

<title>LHabyby Icons API Tester</title>
<meta name="description" content="Test the LHabyby Icons API using HTML, CSS, JavaScript, JSON and PHP."/>


<link rel="shortcut icon" href="https://l.habyby.net/images/favicon/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="https://l.habyby.net/images/favicon/favicon.ico" type="image/x-icon"/>
<link rel="icon" type="image/png" sizes="32x32" href="https://l.habyby.net/images/favicon-32x32.png?v=2"/>
<link rel="icon" type="image/png" sizes="16x16" href="https://l.habyby.net/images/favicon/favicon-16x16.png?v=2"/>
<link rel="apple-touch-icon" sizes="180x180" href="https://l.habyby.net/images/favicon/apple-touch-icon.png?v=2"/>

<link rel="mask-icon" href="https://l.habyby.net/images/favicon/safari-pinned-tab.svg?v=2" color="#5bbad5"/>
<meta name="msapplication-TileColor" content="#603cba"/>
<meta name="theme-color" content="#000000"/>

<meta property="og:site_name" content="LHabyby"/>
<meta property="og:title" content="LHabyby Icons API Tester"/>
<meta property="og:description" content="Test the LHabyby Icons API using HTML, CSS, JavaScript, JSON and PHP."/>
<meta property="og:url" content="https://ihab.habyby.net/test.php"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="https://l.habyby.net/images/favicon/og-image-black.jpg?v=2"/>
<meta property="og:image:width" content="612"/>
<meta property="og:image:height" content="375"/>

<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:domain" content="ihab.habyby.net"/>
<meta name="twitter:site" content="@HabybyNet"/>
<meta name="twitter:title" content="LHabyby Icons API Tester"/>
<meta name="twitter:description" content="Test the LHabyby Icons API using HTML, CSS, JavaScript, JSON and PHP."/>
<meta name="twitter:image" content="https://l.habyby.net/images/favicon/og-image-black.jpg?v=2"/>

<meta itemprop="name" content="LHabyby Icons API Tester"/>
<meta itemprop="description" content="Test the LHabyby Icons API using HTML, CSS, JavaScript, JSON and PHP."/>
<meta itemprop="image" content="https://l.habyby.net/images/favicon/og-image-black.jpg?v=2"/>
<meta itemprop="thumbnailUrl" content="https://l.habyby.net/images/favicon/og-image-black.jpg?v=2"/>
<meta itemprop="pageType" content="website"/>
<link rel="stylesheet" href="css/style.css"/>
 
</head>

<body>

<div class="container">

    <header>
        <h1><a href="https://l.habyby.net">LHabyby</a> Icons API Tester</h1>
        <p>Test and use social media SVG logos with HTML, CSS, JavaScript, JSON, and PHP.</p>
        <p>
            API:
            <a href="https://l.habyby.net/logo.php" target="_blank" rel="noopener noreferrer">
                https://l.habyby.net/logo.php
            </a>
        </p>
    </header>

    <!-- 1. SINGLE ICON SELECTOR -->
    <section class="card" id="single-icon">
        <h2>1. Test a Single Icon</h2>
        <p>Enter a logo name to load its examples. For example: <span class="inline-code">github</span>.</p>

        <form method="get" action="">
            <div class="form-row">
                <input
                    type="text"
                    name="name"
                    value="<?= h($name) ?>"
                    placeholder="Enter a logo name, e.g. github"
                    aria-label="Single logo name"
                    required
                >
                <button type="submit">Load Icon</button>
            </div>
        </form>

        <h3>Selected Logo: <?= h($name) ?></h3>
        <div class="logo-preview">
            <img
                src="<?= h($svgUrl) ?>"
                alt="<?= h($name) ?> logo"
                width="64"
                height="64"
            >
        </div>
        <p><strong>SVG URL:</strong> <a href="<?= h($svgUrl) ?>" target="_blank" rel="noopener noreferrer"><?= h($svgUrl) ?></a></p>
    </section>

    <!-- 2. HTML -->
    <section class="card" id="html-example">
        <h2>2. HTML Example</h2>
        <p>Use a regular HTML image tag to display the logo on your page.</p>

        <div class="preview-row">
            <img src="<?= h($svgUrl) ?>" alt="<?= h($name) ?> logo" width="64" height="64">
            <span>Live HTML preview</span>
        </div>

        <h3>Code</h3>
        <pre><code><?= h($htmlExample) ?></code></pre>
    </section>

    <!-- 3. CSS -->
    <section class="card" id="css-example">
        <h2>3. CSS Example</h2>
        <p>Use the SVG as a CSS background image.</p>

        <div class="preview-row">
            <div
                class="api-logo"
                role="img"
                aria-label="<?= h($name) ?> logo"
                style="background-image: url('<?= h($svgUrl) ?>');"
            ></div>
            <span>Live CSS background preview</span>
        </div>

        <h3>CSS Code</h3>
        <pre><code><?= h($cssExample) ?></code></pre>

        <p class="muted">Add an HTML element with <span class="inline-code">class="api-logo"</span> to use this CSS.</p>
    </section>

    <!-- 4. JAVASCRIPT -->
    <section class="card" id="javascript-example">
        <h2>4. JavaScript Example</h2>
        <p>Fetch the JSON response and use its <span class="inline-code">url</span> field to display the image.</p>

        <div class="preview-row">
            <img id="jsLogoPreview" src="<?= h($svgUrl) ?>" alt="<?= h($name) ?> logo" width="64" height="64">
            <span id="jsLogoStatus" class="muted">The logo is shown using the API SVG URL.</span>
        </div>

        <button type="button" id="runJsExample">Run JavaScript Test</button>

        <h3>Code</h3>
        <pre><code><?= h($jsExample) ?></code></pre>
    </section>

    <!-- 5. JSON -->
    <section class="card" id="json-example">
        <h2>5. JSON Example</h2>
        <p>The API returns JSON data containing the logo title, image URL, HTML markup, and related API links.</p>

        <div class="preview-row">
            <?php if ($phpImageUrl !== ''): ?>
                <img
                    src="<?= h($phpImageUrl) ?>"
                    alt="<?= h((string)($phpJson['title'] ?? $name)) ?> logo"
                    width="64"
                    height="64"
                >
                <span>Logo URL extracted from the JSON response.</span>
            <?php else: ?>
                <span class="muted">The server-side JSON request could not provide a preview. You can still open the JSON API link below.</span>
            <?php endif; ?>
        </div>

        <p><strong>JSON endpoint:</strong> <a href="<?= h($jsonUrl) ?>" target="_blank" rel="noopener noreferrer"><?= h($jsonUrl) ?></a></p>

        <h3>JSON Response (server-side request)</h3>
        <pre><code><?= h($phpJsonText) ?></code></pre>

        <h3>How to use the JSON URL in JavaScript</h3>
        <pre><code>fetch('<?= h($jsonUrl) ?>')
    .then(response => response.json())
    .then(data => {
        document.getElementById('myLogo').src = data.url;
    });</code></pre>

        <p class="muted">The JSON endpoint returns data. To show an image, use the returned <span class="inline-code">url</span> value as an image source.</p>
    </section>

    <!-- 6. PHP -->
    <section class="card" id="php-example">
        <h2>6. PHP Example</h2>
        <p>PHP can request the API from your server, decode the JSON, and write an HTML image tag.</p>

        <div class="preview-row">
            <?php if ($phpImageUrl !== ''): ?>
                <img
                    src="<?= h($phpImageUrl) ?>"
                    alt="<?= h((string)($phpJson['title'] ?? $name)) ?> logo"
                    width="64"
                    height="64"
                >
                <span>Logo preview using the server-side PHP request.</span>
            <?php else: ?>
                <span class="muted"><?= h((string)($phpJson['error'] ?? 'No logo URL was returned.')) ?></span>
            <?php endif; ?>
        </div>

        <h3>PHP Code</h3>
        <pre><code><?= h($phpExample) ?></code></pre>

        <p class="muted">This PHP example runs on the server where you install it. The server must allow outbound HTTPS requests and have PHP URL wrappers enabled.</p>
    </section>

    <!-- 7. MULTIPLE ICONS TESTER -->
    <section class="card" id="multiple-icons">
        <h2>7. Multiple Icons in One Request</h2>
        <p>Enter several logo names separated by commas. The runner makes one JSON API request and displays every returned logo.</p>

        <form id="multiIconsForm">
            <div class="form-row">
                <input
                    type="text"
                    id="multiIconsNames"
                    value="github,facebook,instagram"
                    placeholder="github,facebook,instagram"
                    aria-label="Multiple icon names"
                    required
                >
                <button type="submit" id="multiIconsButton">Run Multiple Icons Test</button>
            </div>
        </form>

        <p class="muted">Example: <span class="inline-code">github,facebook,instagram</span>. Use commas to separate names.</p>

        <div class="status" id="multiIconsStatus" role="status" aria-live="polite">
            Loading the default multiple-icons example...
        </div>

        <h3>Returned Images</h3>
        <div class="multi-icons-grid" id="multiIconsPreview"></div>

        <h3>API Request URL</h3>
        <p><a id="multiIconsApiLink" href="https://l.habyby.net/logo.php?name=github,facebook,instagram&format=json" target="_blank" rel="noopener noreferrer">Open multiple-icons JSON</a></p>

        <h3>JSON Response</h3>
        <pre class="multi-output" id="multiIconsJson">The JSON response will appear here.</pre>

        <h3>JavaScript Example</h3>
        <pre><code>const names = 'github,facebook,instagram';

const apiUrl =
    'https://l.habyby.net/logo.php?name=' +
    encodeURIComponent(names) +
    '&amp;format=json';

fetch(apiUrl)
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('icons');
        container.replaceChildren();

        data.icons.forEach(icon => {
            const img = document.createElement('img');
            img.src = icon.url;
            img.alt = icon.title;
            img.width = 64;
            img.height = 64;
            container.appendChild(img);
        });
    })
    .catch(console.error);</code></pre>

        <p class="muted">The JavaScript example above expects your page to contain an element with <span class="inline-code">id="icons"</span>. The interactive runner on this page already includes its own preview container.</p>

        <h3>PHP Example</h3>
        <pre><code>&lt;?php
$names = 'github,facebook,instagram';

$apiUrl = 'https://l.habyby.net/logo.php?name='
    . rawurlencode($names)
    . '&amp;format=json';

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if (isset($data['icons']) &amp;&amp; is_array($data['icons'])) {
    foreach ($data['icons'] as $icon) {
        if (empty($icon['url'])) {
            continue;
        }

        echo '&lt;img src="'
            . htmlspecialchars($icon['url'], ENT_QUOTES, 'UTF-8')
            . '" alt="'
            . htmlspecialchars($icon['title'] ?? 'Logo', ENT_QUOTES, 'UTF-8')
            . '" width="64" height="64"&gt;';
    }
}
?&gt;</code></pre>

        <p class="muted">The multiple-icons response is expected to contain an <span class="inline-code">icons</span> array and, when applicable, a <span class="inline-code">not_found</span> array.</p>
    </section>

    <!-- 8. DIRECT API LINKS -->
    <section class="card" id="direct-links">
        <h2>8. Direct API Links</h2>
        <p>Open the links below to see the different response formats for the selected logo.</p>

        <div class="link-list">
            <a href="<?= h($jsonUrl) ?>" target="_blank" rel="noopener noreferrer">
                <strong>JSON</strong><br>
                <?= h($jsonUrl) ?>
            </a>

            <a href="<?= h($svgUrl) ?>" target="_blank" rel="noopener noreferrer">
                <strong>SVG Image</strong><br>
                <?= h($svgUrl) ?>
            </a>

            <a href="<?= h($urlEndpoint) ?>" target="_blank" rel="noopener noreferrer">
                <strong>Image URL</strong><br>
                <?= h($urlEndpoint) ?>
            </a>

            <a href="<?= h($htmlEndpoint) ?>" target="_blank" rel="noopener noreferrer">
                <strong>HTML Image Markup</strong><br>
                <?= h($htmlEndpoint) ?>
            </a>

            <a href="https://l.habyby.net/logo.php?format=list" target="_blank" rel="noopener noreferrer">
                <strong>List Available Icons (JSON)</strong><br>
                https://l.habyby.net/logo.php?format=list
            </a>

            <a href="https://l.habyby.net/logo.php?name=github,facebook,instagram&format=json" target="_blank" rel="noopener noreferrer">
                <strong>Multiple Icons (JSON)</strong><br>
                https://l.habyby.net/logo.php?name=github,facebook,instagram&format=json
            </a>
        </div>
    </section>

    <footer>
        <a href="https://l.habyby.net">LHabyby</a> Icons API Tester · SVG logo examples for developers
    </footer>

</div>

<script>
"use strict";

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
</script>

</body>
</html>
