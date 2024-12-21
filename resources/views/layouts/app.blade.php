<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DPO') }}</title>

    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


    <div class="side-bar">
        <pre>
╔───&gt; <a href="{{ route('home') }}">dpo</a>
│
│ ╔═┼─&gt; <a href="{{ route('skills.audit') }}">skills audit</a>
│ ║ │
│ │ ├─&gt; <a href="{{ route('job.opening') }}">job opening</a>
│ │ │
│ │ ├─&gt; <a href="https://boards.greenhouse.io/similarweb/jobs/6199035">Job</a>
╚─╣ │
  │ ├─&gt; <a href="{{ route('projects') }}">projects</a>
  │ │
  │ ├─&gt; <a href="{{ route('gutenberg') }}">karaoke</a>
  │ │
  ╠─┼─&gt; <a href="{{ route('spektralsatz') }}">spektralsatz</a>
  │ │
  │ └─&gt; <a href="https://boards.greenhouse.io/similarweb/jobs/6199035">Job</a>
╔─╣
│ │ ┌─&gt; <a href="https://www.linkedin.com/in/benjamin-w%C3%BCrmli-b08b2227a/"><i
            class="fa fa-linkedin-square"
            aria-hidden="true"
        ></i> LinkedIn</a>
│ ║ │
│ ╚═┼─&gt; <a href="https://github.com/BR4GR"><i
            class="fa fa-github"
            aria-hidden="true"
        ></i> Hub</a>
│   ║
│   └─&gt; <a href="https://spaces.technik.fhnw.ch/spaces/digitales-portfolio">Spaces</a>
│
╚═──═╗───══╣
     ┴
</pre>
    </div>


    <!-- Main Content -->
    <div class="content-container">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">

    </script>
</body>

</html>