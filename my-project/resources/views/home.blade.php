<x-navbar anyParam="Home" />
<h1>This is my first laravel project</h1>
<h4>You are came from url: {{URL::previous()}}</h4>
<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        <a href="/resume">Resume</a>
    </li>
    <li>
        <a href="/contact">Contact</a>
    </li>
    <li>
        <a href="/dashboard">Dashboard</a>
    </li>
    <li>
        <a href="/user/jubayer">User - Jubayer</a>
    </li>
    <li>
        <a href="/controller/any-paramer">My - controller</a>
    </li>
    <li>
        <a href="/condition/paramer">Condition</a>
    </li>
</ul>