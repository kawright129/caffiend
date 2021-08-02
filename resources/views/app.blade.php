<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <script src="https://kit.fontawesome.com/c17eef7690.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <link rel="stylesheet" href="{{ mix('css/caffiend.css') }}">

    <title>{{env('APP_NAME')}}</title>
</head>
<body>
    <div id="app">
        <a id="toggleDarkMode" class="p-1" href="#" title="Toggle Dark Mode" ><i class="far fa-lightbulb"></i></a>
        <router-view></router-view>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

<script>
    //Dark mode toggle - Saves to local storage
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.querySelector("#toggleDarkMode");
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: light)");

        const currentTheme = localStorage.getItem("theme");
        if (currentTheme == "dark") {
            document.body.classList.toggle("dark-theme");
        } else if (currentTheme == "light") {
            document.body.classList.toggle("light-theme");
        }

        btn.addEventListener("click", function () {
            if (prefersDarkScheme.matches) {
                document.body.classList.toggle("light-theme");
                var theme = document.body.classList.contains("light-theme")
                ? "light"
                : "dark";
            } else {
                document.body.classList.toggle("dark-theme");
                var theme = document.body.classList.contains("dark-theme")
                ? "dark"
                : "light";
            }
            localStorage.setItem("theme", theme);
        });
    })
    
</script>
</html>