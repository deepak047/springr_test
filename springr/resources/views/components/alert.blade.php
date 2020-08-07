<div>
@if(session()->has('message'))
{{$slot}}
<div class="py-4 px-2 bg-green-400"> 
{{session()->get('message')}}
</div>
@elseif(session('error'))
<div class="py-4 px-2 bg-red-200"> 
{{session('error')}}
</div>
@endif

@if ($errors->any())
    <div class="py-4 px-2 bg-red-200">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>