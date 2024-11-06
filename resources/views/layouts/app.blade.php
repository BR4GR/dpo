<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>{{ config('app.name', 'DPO') }}</title>
    <link
        rel="stylesheet"
        href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}"
    >
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
</head>

<body>
<div class="top-bar">
<pre>
  ╔═══════╗   ╔════════════════════════<!--                                   -->══════════╗
╔──╣<span> <a href="{{ route('home') }}">dpo</a></span> ╠═─<span id="textElement">─</span>══╣       Benjamin <a href="https://github.com/BR4GR">BR4GER</a>         ║
│ ╚═══════╝   ╚════════════════════════<!--                                   -->══════════╝
│
╚════════════════════════════════════════════════════════════════════╣ visitor@pdo-site:<i class="fa fa-linux"></i>~/pdo/<span class="terminal-prompt"><span
            id="command-input"
            contenteditable="true"
            class="command-input"
        ></span>
  </span>
</pre>
</div>


<!-- Sidebar -->
<div class="side-bar">
<pre>
╔───&gt; <a href="{{ route('home') }}">dpo</a>
│
│ ╔═┼─&gt; <a href="{{ route('skills.audit') }}">skills audit</a>
│ ║ │
│ │ ├─&gt; <a href="{{ route('spektralsatz') }}">spektralsatz</a>
│ │ │
│ │ ├─&gt; <a href="{{ route('skills.audit') }}">skills audit</a>
╚─╣ │
  │ ├─&gt; <a href="#1987">🚚</a>
  │ │
  │ ├─&gt; <a href="#1988">🍀</a>
  │ │
  ╠─┼─&gt; <a href="#1989">📝</a>
  │ │
  │ └─&gt; <a href="#1990">💵</a>
╔─╣
│ │ ┌─&gt; <a href="#1994">📦</a>
│ ║ │
│ ╚═┼─&gt; <a href="https://github.com/BR4GR"><i
            class="fa fa-github"
            aria-hidden="true"
        ></i></a>
│   ║
│   └─&gt; <a href="https://spaces.technik.fhnw.ch/spaces/digitales-portfolio">Spaces</a>
│
╚═──═╗───══╣
     ┴
</pre>
</div>


<!-- Main Content -->
{{--<div class="content-container">--}}
{{--    @yield('content')--}}
{{--</div>--}}

<script>
    window.addEventListener('scroll', function () {
        const goToTopBtn = document.getElementById('go-to-top');
        if (window.scrollY > 200) {
            goToTopBtn.classList.add('show');
        } else {
            goToTopBtn.classList.remove('show');
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>

<script src="{{ asset('js/app.js') }}"></script>

{{--<script--}}
{{--    type="text/javascript"--}}
{{--    async--}}
{{--    src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"--}}
{{-->--}}
</script>
</body>

</html>
