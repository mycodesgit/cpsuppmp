<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>CPSU PPMP | 404 Error Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.css') }}">
    <!-- Logo for demo purposes -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

    <style>
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #5f6f81;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 100%;
            /*z-index: -1;*/
        }
        .terminal-window {
            text-align: left;
            width: 37.5rem;
            height: 22.5rem;
            border-radius: .625rem;
            margin: auto;
            position: relative;
        }

        .terminal-window header {
            background: #E0E8F0;
            height: 1.875rem;
            border-radius: .5rem .5rem 0 0;
            padding-left: .625rem;
        }

        .terminal-window header .button {
            width: .75rem;
            height: .75rem;
            margin: .625rem .25rem 0 0;
            display: inline-block;
            border-radius: .5rem;
        }

        .terminal-window header .button.green {
            background: #3BB662;
        }

        .terminal-window header .button.yellow {
            background: #E5C30F;
        }

        .terminal-window header .button.red {
            background: #E75448;
        }

        .terminal-window section.terminal {
            color: white;
            font-family: Menlo, Monaco, "Consolas", "Courier New", "Courier";
            font-size: 11pt;
            background: #30353A;
            padding: .625rem;
            box-sizing: border-box;
            position: absolute;
            width: 100%;
            top: 1.875rem;
            bottom: 0;
            overflow: auto;
            border-radius: 0 0 .5rem .5rem;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div id="particles-js"></div>
    <div class="terminal-window login-box">
        <header>
            <div class="button red"></div>
            <div class="button yellow"></div>
            <div class="button green"></div>
        </header>
        <section class="terminal">
            <div class="history"></div>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <span>&nbsp;===================================================================</span>
                <span style="font-size: 20pt; text-align: center;">404 | not found</span>
                <span>&nbsp;===================================================================</span>
            </div>

            <span class="typed-cursor"></span><br>
            <span style="color: green">$</span>&nbsp;<span class="prompt">Look like you're lost. The page you are looking for is not avaible!!</span><br>
            <span style="color: green">$</span>&nbsp;<span id="typewriter-text"></span><br>
            <div class="footer-modal" style="padding-top: 80px">
                <a href="./" class="btn btn-outline-primary">Back</a>
            </div>
        </section>
    </div>

    <script src="{{ asset('particles/particles.js') }}"></script>
    <script src="{{ asset('particles/app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <script>
        AOS.init({
            easing: 'ease-in-out-sine',
            duration: 1000
        });
        const textElement = document.getElementById("typewriter-text");
        const textToType = "Please click the 'Back' button.";
        const typingSpeed = 50; // Adjust this value to change the typing speed (in milliseconds).
        const delayBetweenText = 2000; // Adjust this value to set the delay between text resets (in milliseconds).

        let charIndex = 0;
        let isTyping = true;

        function typeNextCharacter() {
            if (isTyping) {
                if (charIndex < textToType.length) {
                    textElement.innerHTML += textToType.charAt(charIndex);
                    charIndex++;
                    setTimeout(typeNextCharacter, typingSpeed);
                } else {
                    isTyping = false;
                    setTimeout(resetTypewriter, delayBetweenText);
                }
            }
        }

        function resetTypewriter() {
            textElement.innerHTML = "";
            charIndex = 0;
            isTyping = true;
            typeNextCharacter();
        }

        typeNextCharacter();
    </script>
</body>
</html>