@php
    $curr_route = request()->route()->getName();

    $conActive = in_array($curr_route, ['consolidateRead', 'consolidateGen_reports']) ? 'active' : '';
    $conform2Active = in_array($curr_route, ['consolidateForm2Read', 'consolidateGenform2_reports']) ? 'active' : '';
@endphp


<h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
    Reports Menu
</h5>
<div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="{{ route('consolidateRead') }}" class="list-group-item {{ $conActive }}">Form 1</a>
        <a href="{{ route('consolidateForm2Read') }}" class="list-group-item {{ $conform2Active }}">Form 2</a>
    </ul>
</div>
