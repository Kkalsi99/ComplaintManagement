@extends('layouts.app')
@if(isset(auth()->user()->phone))

@section('content')
<div class="container" style="justify-content: normal">
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="width:60vw">
                <div class="card-header flex justify"><H2>Dashboard @if(auth::user()->role=='User')<a href="/complaint" class="btn btn-primary mb-2 " style="float:right;">New Complaint</a>@elseif(auth::user()->role!='Computer Centre'||auth::user()->role!='Construction Cell')<a href="/home/table" class="btn btn-primary mb-2 " style="float:right;">Complaint Table</a>@endif</H2>

                </div>




                <div class="card-body d-flex  flex-column flex-shrink-0">

                    @if(auth::user()->role!='Computer Centre' && auth::user()->role!='Construction Cell')
                        @foreach($complaints as $complaint)
                            <div class="card my-3 " style="">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{auth::user()->role}} Complaint </h5>
                                    <p class="card-text">Type : {{$complaint->type}}</p>
                                    <p class="card-text">Location : {{$complaint->location}}</p>
                                    <p class="card-text">Content : {{$complaint->body}}</p>
                                    <p class="card-text ">Registered at : {{$complaint->created_at}}</p>
                                    <p class="card-text ">Status : {{$complaint->status}}</p>
                                    @if($complaint->status=='Unable to resolve')<p class="card-text ">Reason : {{$complaint->reason_for_not_resolvable}}</p>@endif

{{--                                    checking status--}}
                                    @if($complaint->status=='Resolved')
{{--                                        Resolved complaints--}}
                                        <p class="card-text">Completed on : {{$complaint->updated_at}}</p>
                                        <button type="submit" class="btn btn-success">{{$complaint->status}}</button>

                                        @else
{{--                                        Resolving the complaints--}}
                                            @if(auth::user()->role!='User')
{{--                                                Change status--}}
                                            <form method="POST" action="/complaint/resolve" style="display: inline">
                                            @csrf
                                            <input name="id" value="{{$complaint->id}}" hidden>

                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Resolve') }}
                                                    </button>
                                                </form>
{{--                                    not able resolve--}}
                                        @if($complaint->status=='Processing'||$complaint->status=='Unable to resolve')
                                                <button type="button" onclick="openReason({{$complaint->id}})" class="btn btn-danger" style="float:right;">
                                                    Unable to resolve
                                                </button>
                                                <form method="POST" action="/complaint/reason">
                                                    @csrf
                                                <!-- Reason with js --><input name="id" value="{{$complaint->id}}" hidden>
                                                        <div id="{{$complaint->id}}" style="display:none;">
                                                           <br> <label for="reason">Enter Reason </label><br>
                                                            <textarea class="form-control @error('reason') is-invalid @enderror" name="reason"  placeholder="Please Enter Your Reason Here" style="width: 55.5vw;height: 100px;" required></textarea>
                                                            @error('reason')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                            <br><button type="submit" class="btn btn-dark">
                                                                {{ __('Submit Reason') }}
                                                            </button>
                                                            <button type="button" onclick="closeReason({{$complaint->id}})" class="btn btn-light" style="float:right;">
                                                               Close Dialog Box
                                                            </button>
                                                        </div>
                                                </form>

                                                <script type="application/javascript">
                                                    function openReason(id) {
                                                        document.getElementById(id).style.display = "inline-block";
                                                    }
                                                    function closeReason(id) {
                                                        document.getElementById(id).style.display= "none";

                                                    }


                                                </script>
                                            @endif


                                                @elseif($complaint->status=='Processing')
                                            <button type="submit" class="btn btn-primary">{{$complaint->status}}</button>
                                                @else
                                            <button type="submit" class="btn btn-danger">{{$complaint->status}}</button>
                                            @endif
                                        @endif


                                </div>
                            </div>

                        @endforeach

                    @else

                        <script type="text/javascript">
                            window.location.href= "home/table";
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@else
    <script type="text/javascript">
        window.location.href= "update";
    </script>@endif
