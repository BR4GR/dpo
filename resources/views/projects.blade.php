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

    <p>Explore my projects below, where I combine creativity with technology. Each project reflects my journey in web development, data science, and beyond. Dive in to see my work in action!</p>

    <div class="projects-container">
        <a href="{{ route('projects') }}" class="project-card">
            <iframe src="/raw/projects" class="project-raw"></iframe>
        </a>
        <a href="https://github.com/BR4GR/wdb_Web-Daten-beschaffung" class="project-card">
            <iframe src="https://github.com/BR4GR/wdb_Web-Daten-beschaffung" class="project-raw"></iframe>
        </a>
        <a href="{{ route('skills.audit') }}" class="project-card">
            <div class="project-raw-wrapper">
                <iframe src="/raw/skills-audit" class="project-raw"></iframe>
            </div>
        </a>

    </div>

</div>

@endsection