<x-navbar anyParam="Contact" />
<h1>This is contact page</h1>

<h4>You are came from url: {{URL::previous()}}</h4>

<ul>
    <li>
        <a href="{{URL::to('/')}}">Home : {{URL::to('/')}}</a>
    </li>
    <li>
        <a href="{{URL::to('/resume')}}">Resume : {{URL::to('/resume')}}</a>
    </li>
    <li>
        <a href="{{URL::to('/contact')}}">Contact : {{URL::to('/contact')}}</a>
    </li>
    <li>
        <a href="{{URL::to('/dashboard')}}">Dashboard : {{URL::to('/dashboard')}}</a>
    </li>
    <li>
        <a href="{{URL::to('/user/jubayer')}}">User - Jubayer : {{URL::to('/user/jubayer')}}</a>
    </li>
    <li>
        <a href="{{URL::to('/any-paramer')}}">My - controller : {{URL::to('/any-paramer')}}</a>
    </li>
</ul>