@extends('layouts.app')
@if(isset(auth()->user()->phone))
@section('content')
    <div class="container d-flex " style="margin-left: 1vw ">
    <div class="container" style="max-width: 18vw; padding: 0px 10px 0px 0px; background-color: #ffffff;border: solid 1px #ebebeb;">
        <div  style="margin-left: 0vw; border: #1b1e21 2px;"><div class="card-header" style="width: 18vw; margin-left: 0vw;margin-bottom: 1vw" ><h2 class="justify-content-center">Search By</h2></div>
            <form method="POST" action="/home/table" style="margin-left: 1vw;">
                @csrf

                <label>Complaint Id</label>

                &nbsp;<br><input class="form-control" name="id" style="display: inline; " placeholder="Enter Complaint Id" value="{{ old('id') }}">@if(Auth()->user()->role=='Fi')

                    <hr>
                    <label>Complaint Status</label><select class="form-control" name="type" style=" display: inline">
                        <option value="">Select Complaint Type</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Networking">Networking</option>
                        <option value="Website">Related to Website</option>
                    </select>@endif<br>

                <hr>
                <label>Complaint Status</label>
                <select class="form-control" name="status"  style="display: inline; ">

                    <option value="">Select Complaint Status</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Processing">Processing</option>
                    <option value="Unable to resolve">Unable to Resolve</option>
                </select>
                <hr>
                <label>Location</label>
                <input class="form-control" name="location" style=" display: inline" placeholder="Enter Location">
                <hr>
                <h4>Registeration Date</h4>
                <label> From:</label><br>
                <input class="form-control" name="created_startDate" type="date" style="display: inline ;">
                <label>To:</label>
                <br>
                <input class="form-control " name="created_endDate" type="date" style="display: inline;">
                <hr>
                <h4>Processing Date</h4>
                <label>From:</label>
                <input class="form-control" name="updated_startDate" type="date" style="display: inline;">
                <label>To:</label>
                <input class="form-control" name="updated_endDate" type="date" style="display: inline;">

                <div class="mt-2"><button type="submit" class="btn btn-primary" style=" margin-top:1vh;display: flex;justify-content: center;">
                        {{ __('Search') }}
                    </button></div>
            </form>
            <br></div></div>
    <div class="container" style="margin-left: 0vw ;">
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="width:78vw">
                    <div class="card-header flex justify"><H2>Dashboard @if(auth::user()->role!='User'&&auth::user()->role!='Fi') <a href="/home" class="btn btn-primary mb-2 " style="float:right;">Resolve Complaints</a> @endif</H2>

                    </div>




                    <div class="card-body " >

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Complaint id</th>
                                    <th>Registered by</th>
                                    <th>Complaint type @if(Auth()->user()->role=='Fi')(Technician)@endif</th>
                                    <th>Location</th>
                                    <th>Registered at</th>
                                    <th>Complaint status</th>
                                    <th>Processed On</th>
                                    <th>Reason for unable to resolve</th>
                                </tr>
                            </thead>
                                @foreach($complaints as $complaint)
                                    <tbody>
                                    <tr>
                                        <td>{{$complaint->id}}</td>
                                        <td>{{$techName=App\User::where('id',$complaint->user_id)->get()->pluck('name')->first()}}</td>
                                        <td>{{$complaint->type}}@if(Auth()->user()->role=='Fi')({{$techName=App\User::where('role',$complaint->type)->get()->pluck('name')->first()}})@endif</td>
                                        <td>{{$complaint->location}}</td>
                                        <td>{{$complaint->created_at}}</td>
                                        <td>{{$complaint->status}}</td>
                                        <td >@if($complaint->status!='Processing'){{$complaint->updated_at}}
                                            @else {{'----'}}
                                            @endif
                                        </td>
                                        <td style="width:300px; word-wrap:break-word">@if($complaint->status=='Unable to resolve'){{$complaint->reason_for_not_resolvable}}
                                            @else {{'----'}}
                                            @endif</td>
                                    </tr>@endforeach
                                    </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@else
    <script type="text/javascript">
        window.location.href= "update";
    </script>

@endif

