<?php
header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');

header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, X-Auth-Token, Origin');
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="icon" type="image/png" href="/vendor/swaggervel/images/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/vendor/swaggervel/images/favicon-16x16.png" sizes="16x16"/>
    <link href='/vendor/swaggervel/css/typography.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/vendor/swaggervel/css/reset.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/vendor/swaggervel/css/screen.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/vendor/swaggervel/css/reset.css' media='print' rel='stylesheet' type='text/css'/>
    <link href='/vendor/swaggervel/css/print.css' media='print' rel='stylesheet' type='text/css'/>
    <script src='/vendor/swaggervel/lib/jquery-1.8.0.min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/jquery.slideto.min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/jquery.wiggle.min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/jquery.ba-bbq.min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/handlebars-2.0.0.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/underscore-min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/backbone-min.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/swagger-ui.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/highlight.7.3.pack.js' type='text/javascript'></script>
    <script src='/vendor/swaggervel/lib/marked.js' type='text/javascript'></script>

    <script src='/vendor/swaggervel/lib/swagger-oauth.js' type='text/javascript'></script>

    <style type="text/css">
        span.post-operation {
            text-transform: uppercase;
            text-decoration: none;
            color: white;
            display: inline-block;
            width: 50px;
            font-size: 0.8em;
            text-align: center;
            padding: 6px 0 4px;
            -moz-border-radius: 2px;
            background-color: #10A54A;
            -webkit-border-radius: 2px;
            -o-border-radius: 2px;
            -ms-border-radius: 2px;
            -khtml-border-radius: 2px;
            border-radius: 2px;
        }

        span.explore-button {
            text-transform: capitalize;
            text-decoration: none;
            font-weight: bold;
            padding: 6px 8px;
            font-size: 0.9em;
            color: white;
            background-color: #547f00;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            -o-border-radius: 4px;
            -ms-border-radius: 4px;
            -khtml-border-radius: 4px;
            border-radius: 4px;
            display: inline;
        }

    </style>

    <script type="text/javascript">

        function log() {
            if ('console' in window) {
                console.log.apply(console, arguments);
            }
        }

        $(function () {
            var url = window.location.search.match(/url=([^&]+)/);
            if (url && url.length > 1) {
                url = decodeURIComponent(url[1]);
            } else {
                url = "{!! $urlToDocs !!}";
            }

// Pre load translate...
            if (window.SwaggerTranslator) {
                window.SwaggerTranslator.translate();
            }
            window.swaggerUi = new SwaggerUi({
                url: url,
                dom_id: "swagger-ui-container",
                supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                onComplete: function (swaggerApi, swaggerUi) {

                    log("Loaded SwaggerUI");
                    @if (isset($requestHeaders))
                    @foreach($requestHeaders as $requestKey => $requestValue)
                    window.authorizations.add("{!!$requestKey!!}", new ApiKeyAuthorization("{!!$requestKey!!}", "{!!$requestValue!!}", "header"));
                    @endforeach
                            @endif

                    if (typeof initOAuth == "function") {
                        initOAuth({
                            clientId: "{!! $clientId !!}" || "my-client-id",
                            clientSecret: "{!! $clientSecret !!}" || "_",
                            realm: "{!! $realm !!}" || "_",
                            appName: "{!! $appName !!}"
                            || "_",
                            scopeSeparator: ","
                        });

                        window.oAuthRedirectUrl = "{{ url('vendor/swaggervel/o2c.html') }}";
                        $('#clientId').html("{!! $clientId !!}" || "my-client-id");
                        $('#redirectUrl').html(window.oAuthRedirectUrl);
                    }

                    if (window.SwaggerTranslator) {
                        window.SwaggerTranslator.translate();
                    }

                    $('pre code').each(function (i, e) {
                        hljs.highlightBlock(e)
                    });

                    addApiKeyAuthorization();
                },
                onFailure: function (data) {
                    log("Unable to Load SwaggerUI");
                },
                docExpansion: "none",
                apisSorter: "alpha",
                showRequestHeaders: false
            });

            function addApiKeyAuthorization() {
                var key = encodeURIComponent($('#input_apiKey')[0].value);
                if (key && key.trim() != "") {
// set authorization header for jwt auth
                    window.swaggerUi.api.clientAuthorizations.add(
                            "key", new SwaggerClient.ApiKeyAuthorization("Authorization", "Bearer " + key, "header"
                            ));
                }
            }

            $('#input_apiKey').change(addApiKeyAuthorization);

            $('#init-oauth').click(function () {
                if (typeof initOAuth == "function") {
                    initOAuth({
                        clientId: $('#input_clientId').val() || "my-client-id",
                        clientSecret: $('#input_clientSecret').val() || "_",
                        realm: $('#input_realm').val() || "_",
                        appName: $('#input_appName').val() || "_",
                        scopeSeparator: ","
                    });
                }
            });

            window.swaggerUi.load();

        });
    </script>
</head>

<body class="swagger-section">
<div id='header'>
    <div class="swagger-ui-wrap">
        <a id="logo" href="http://swagger.io">swagger</a>
        <form id='api_selector'>
            <div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl"
                                      type="text"/></div>
            <div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
            <div class='input'><a id="explore" href="#" data-sw-translate>Explore</a></div>
        </form>
    </div>
</div>

<div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</body>
</html>