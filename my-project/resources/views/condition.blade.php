<x-navbar />
<h1>This is Condition page {{$name}}</h1>
<h4>You are came from url: {{URL::previous()}}</h4>

<br>
<br>
<h1>if else with @ condition</h1>
@if($name=="Jubayer")
<p>This man developed this app</p>
@else
<p>This man is a user, pass Jubayer as a paramer</p>
@endif

