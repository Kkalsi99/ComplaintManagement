@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header flex justify"><H2>Dashboard @if(auth::user()->role=='User')<a href="/complaint" class="btn btn-primary mb-2 " style="float:right;">New Complaint</a>@endif</H2>

                </div>




                <div class="card-body d-flex  flex-column flex-shrink-0">

                    @foreach($complaints as $complaint)
                            <div class="card my-3 " style="">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Complaint {{auth::user()->role}}</h5>
                                    <p class="card-text">Type : {{$complaint->type}}</p>
                                    <p class="card-text">Content : {{$complaint->body}}</p>
                                    <p class="card-text ">Registered at : {{$complaint->created_at}}</p>
                                    @if($complaint->status=='Done')
                                        <p class="card-text">Completed on : {{$complaint->updated_at}}</p>
                                        <a href="#" class="btn btn-success mb-2">{{$complaint->status}}</a>
                                        @else
                                            @if(auth::user()->role!='User')<form method="POST" action="/complaint/resolve">
                                            @csrf
                                            <input name="id" value="{{$complaint->id}}" hidden>

                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Resolve') }}
                                                    </button>
                                                </form>


                                                @else
                                                    <a href="#" class="btn btn-primary mb-2">{{$complaint->status}}</a>
                                            @endif
                                        @endif


                                </div>
                            </div>

                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
