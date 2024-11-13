@extends(isset($layout) && $layout == 'raw' ? 'layouts.raw' : 'layouts.app')


@section('content')
<div class="container article">
    <pre>
.-------------------------------------------------------------------------------------------------------------------------------.
|                                                                                                                               |
|          ██╗    ██╗███████╗██╗      ██████╗ ██████╗ ███╗   ███╗███████╗    ████████╗ ██████╗     ███╗   ███╗██╗   ██╗         |
|          ██║    ██║██╔════╝██║     ██╔════╝██╔═══██╗████╗ ████║██╔════╝    ╚══██╔══╝██╔═══██╗    ████╗ ████║╚██╗ ██╔╝         |
|          ██║ █╗ ██║█████╗  ██║     ██║     ██║   ██║██╔████╔██║█████╗         ██║   ██║   ██║    ██╔████╔██║ ╚████╔╝          |
|          ██║███╗██║██╔══╝  ██║     ██║     ██║   ██║██║╚██╔╝██║██╔══╝         ██║   ██║   ██║    ██║╚██╔╝██║  ╚██╔╝           |
|          ╚███╔███╔╝███████╗███████╗╚██████╗╚██████╔╝██║ ╚═╝ ██║███████╗       ██║   ╚██████╔╝    ██║ ╚═╝ ██║   ██║            |
|           ╚══╝╚══╝ ╚══════╝╚══════╝ ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚══════╝       ╚═╝    ╚═════╝     ╚═╝     ╚═╝   ╚═╝            |
|                                                                                                                               |
|  ██████╗ ██╗ ██████╗ ██╗████████╗ █████╗ ██╗         ██████╗  ██████╗ ██████╗ ████████╗███████╗ ██████╗ ██╗     ██╗ ██████╗   |
|  ██╔══██╗██║██╔════╝ ██║╚══██╔══╝██╔══██╗██║         ██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝██╔════╝██╔═══██╗██║     ██║██╔═══██╗  |
|  ██║  ██║██║██║  ███╗██║   ██║   ███████║██║         ██████╔╝██║   ██║██████╔╝   ██║   █████╗  ██║   ██║██║     ██║██║   ██║  |
|  ██║  ██║██║██║   ██║██║   ██║   ██╔══██║██║         ██╔═══╝ ██║   ██║██╔══██╗   ██║   ██╔══╝  ██║   ██║██║     ██║██║   ██║  |
|  ██████╔╝██║╚██████╔╝██║   ██║   ██║  ██║███████╗    ██║     ╚██████╔╝██║  ██║   ██║   ██║     ╚██████╔╝███████╗██║╚██████╔╝  |
|  ╚═════╝ ╚═╝ ╚═════╝ ╚═╝   ╚═╝   ╚═╝  ╚═╝╚══════╝    ╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚═╝      ╚═════╝ ╚══════╝╚═╝ ╚═════╝   |
|                                                                                                                               |
'-------------------------------------------------------------------------------------------------------------------------------'

</pre>

    <p>Hello and welcome to my Digital Portfolio (DPO)! Here, I showcase my journey through my studies, my skills,
        and my professional aspirations. This portfolio is not just a collection of my work, but a reflection of my
        growth, achievements, and goals as I prepare for my career.</p>

    <h2>About Me</h2>
    <p>My name is Benjamin, and I'm currently a student at <a href="https://www.fhnw.ch/en/">FHNW</a>. My passion
        lies in applying technology to
        solve real-world problems, particularly in areas related to data science, visualization, and web
        development. In this portfolio, you can find various projects I've worked on, reflections on my learning,
        and insights into what motivates me.</p>

    <h2>What You Will Find Here</h2>
    <ul>
        <li><strong>Personal Page</strong>: Get to know me better, including my background, my skills, and what
            drives me forward.
        </li>
        <li><strong>Blog</strong>: Here, I reflect on my learning journey. You'll find posts like my skills audit,
            my thoughts on relevant job opportunities, and other reflections on my professional growth.
        </li>
        <li><strong>Projects</strong>: A showcase of the projects I've worked on during my studies. Each project
            includes a brief description and the skills I applied to solve the problems.
        </li>
        <li><strong>CV and Career Interests</strong>: I have included a link to my updated CV and information about
            my career interests, highlighting my preparedness for the professional world.
        </li>
    </ul>

    <h2>Continuous Growth</h2>
    <p>This digital portfolio is a living document—as I learn new skills and complete new projects, I will continue
        to update it to reflect my progress. Feel free to explore, and if you have any questions or want to
        collaborate, don't hesitate to reach out.</p>

    <p>Thanks for visiting my DPO, and I hope you enjoy exploring my work!</p>
</div>
@endsection