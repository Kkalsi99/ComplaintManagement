@if($data['complaint']->status=='Processing')<p> A Complaint :{{$data['complaint']->body}}
    About {{$data['complaint']->location}}
    has been launched and sent to
    Technician {{$data['technician']->name}}
    by {{auth()->user()->name}}</p>

@else <p> A Complaint :{{$data['complaint']->body}}
    About {{$data['complaint']->location}}
    has been resolved by
    Technician {{auth()->user()->name}}
    </p>@endif


