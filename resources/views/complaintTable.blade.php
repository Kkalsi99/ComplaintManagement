@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="width:60vw">
                    <div class="card-header flex justify"><H2>Dashboard <a href="/home" class="btn btn-primary mb-2 " style="float:right;">Resolve Complaints</a> </H2>

                    </div>




                    <div class="card-body d-flex  flex-column flex-shrink-0">

                        <form method="POST" action="/home/table">
                            @csrf
                            <input class="form-control" name="id" style="display: inline; width: 23%;" placeholder="Enter Id" value="{{ old('id') }}">@if(Auth()->user()->role=='Afi')
                            <select class="form-control" name="type" style=" width: 23%;;display: inline">
                                <option value="">Select Complaint Type</option>
                                <option value="Software">Software</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Networking">Networking</option>
                                <option value="Website">Related to Website</option>
                            </select>@endif
                            <select class="form-control" name="status"  style="display: inline; width: 23%;">

                                <option value="">Select Complaint Status</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Processing">Processing</option>
                                <option value="Unable to resolve">Unable to Resolved</option>
                            </select>
                            <input class="form-control" name="location" style=" width: 23%;;display: inline" placeholder="Enter Location">
                            <br>


                            <label>Registered From:</label>
                            <input class="form-control w-25" name="created_startDate" type="date" style="display: inline">
                            <label>  To:</label>
                            <input class="form-control w-25" name="created_endDate" type="date" style="display: inline">
                            <br>

                                <label>Processed </label>
                            <label> &nbsp;From:</label>
                            <input class="form-control w-25" name="updated_startDate" type="date" style="display: inline">
                            <label>  To:</label>
                            <input class="form-control w-25" name="updated_endDate" type="date" style="display: inline">

                            <div class="mt-1"><button type="submit" class="btn btn-primary" style="display: flex;justify-content: center;width: 30vw">
                                {{ __('Search') }}
                                </button></div>
                        </form>
                        <hr>
                            <table>
                                <tr>
                                    <th>Complaint id</th>
                                    <th>Complaint type</th>
                                    <th>Location</th>
                                    <th>Registered at</th>
                                    <th>Complaint status</th>
                                    <th>Resolved On</th>
                                    <th>Reason for unable to resolve</th>
                                </tr>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>{{$complaint->id}}</td>
                                        <td>{{$complaint->type}}</td>
                                        <td>{{$complaint->location}}</td>
                                        <td>{{$complaint->created_at}}</td>
                                        <td>{{$complaint->status}}</td>
                                        <td >@if($complaint->status=='Resolved'){{$complaint->updated_at}}
                                            @else {{'----'}}
                                            @endif
                                        </td>
                                        <td style="width:300px; word-wrap:break-word">@if($complaint->status=='Unable to resolve'){{$complaint->reason_for_not_resolvable}}
                                            @else {{'----'}}
                                            @endif</td>
                                    </tr>@endforeach
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

