@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="width:60vw">
                    <div class="card-header flex justify"><H2>Dashboard <a href="/home" class="btn btn-primary mb-2 " style="float:right;">Resolve Complaints</a> </H2>

                    </div>




                    <div class="card-body d-flex  flex-column flex-shrink-0">


                            <table>
                                <tr>
                                    <th>Complaint id</th>
                                    <th>Complaint type</th>
                                    <th>Registered at</th>
                                    <th>Complaint status</th>
                                    <th>Resolved On</th>
                                    <th>Reason for unable to resolve</th>
                                </tr>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>{{$complaint->id}}</td>
                                        <td>{{$complaint->type}}</td>
                                        <td>{{$complaint->created_at}}</td>
                                        <td>{{$complaint->status}}</td>
                                        <td >@if($complaint->status=='Resolved'){{$complaint->updated_at}}
                                            @else {{'----'}}
                                            @endif
                                        </td>
                                        <td style="width:400px; word-wrap:break-word">{{$complaint->reason_for_not_resolvable}}</td>
                                    </tr>@endforeach
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

