@extends(isset($layout) && $layout == 'raw' ? 'layouts.raw' : 'layouts.app')

@section('content')
<div class="container article">
    <pre>
.--------------------------------------------------------------------.
| ██████╗ ██████╗  ██████╗      ██╗███████╗ ██████╗████████╗███████╗ |
| ██╔══██╗██╔══██╗██╔═══██╗     ██║██╔════╝██╔════╝╚══██╔══╝██╔════╝ |
| ██████╔╝██████╔╝██║   ██║     ██║█████╗  ██║        ██║   ███████╗ |
| ██╔═══╝ ██╔══██╗██║   ██║██   ██║██╔══╝  ██║        ██║   ╚════██║ |
| ██║     ██║  ██║╚██████╔╝╚█████╔╝███████╗╚██████╗   ██║   ███████║ |
| ╚═╝     ╚═╝  ╚═╝ ╚═════╝  ╚════╝ ╚══════╝ ╚═════╝   ╚═╝   ╚══════╝ |
'--------------------------------------------------------------------'

</pre>

    <p>Explore my projects below, where I combine creativity with technology. Each project reflects my journey in software development, data science, and beyond. Dive in to see my work in action!</p>

    <div class="projects-container">
        <a href="{{ route('articles.show', ['slug' => 'std']) }}" class="project-card">
            <div class="project-raw-wrapper">
                <iframe src="/raw/std-prewiew" class="project-raw"></iframe>
            </div>
        </a>
        <a href="{{ route('articles.show', ['slug' => 'wdb']) }}" class="project-card">
            <div class="project-raw-wrapper">

                <iframe src="/raw/wdb" class="project-raw"></iframe>
            </div>
        </a>
        <a href="{{ route('skills.audit') }}" class="project-card">
            <div class="project-raw-wrapper">
                <iframe src="/raw/skills-audit" class="project-raw"></iframe>
            </div>
        </a>

    </div>

</div>

@endsection