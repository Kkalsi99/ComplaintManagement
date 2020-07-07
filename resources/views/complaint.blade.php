@extends('layouts.app')
@if(isset(auth()->user()->phone))

@section('content')
    @if(auth()->user()->role=='User')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Complaint') }}<a href="/home" class="btn btn-primary mb-2 " style="float:right;">All Complaints</a></div>

                    <div class="card-body">
                        <form method="POST" action="/complaint">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Location/Department') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>

                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Category" class="col-md-4 col-form-label text-md-right">{{ __('Complaint Category') }}</label>

                                <div class="col-md-6">
                                    <script type="application/javascript">
                                        let complaint = {
                                            'Computer Centre': ["Hardware","Networking","Software","Related to Website"],
                                            'Construction Cell': ["Construction","Electricity","General"]
                                        }
                                        function makeSubmenu(value) {
                                            if(value.length==0) document.getElementById("type").innerHTML = "<option></option>";
                                            else {
                                                let comOptions = "";
                                                for(comType in complaint[value]) {
                                                    comOptions+="<option value="+complaint[value][comType]+">"+complaint[value][comType]+"</option>";

                                                }
                                                document.getElementById("type").innerHTML = comOptions;
                                            }
                                        }

                                        function resetSelection() {
                                            document.getElementById("category").selectedIndex = 0;
                                            document.getElementById("type").selectedIndex = 0;
                                        }
                                    </script>
                                    <select id="category" type="text" class="form-control @error('category') is-invalid @enderror" onchange="makeSubmenu(this.value)" name="category" value="{{ old('category') }}" required autocomplete="category" autofocus>
                                        <option value="" disabled selected>Complaint Category</option>
                                        <option value="Computer Centre">Computer Centre</option>
                                        <option value="Construction Cell">Construction Cell</option>
                                    </select>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Complaint Type') }}</label>

                                <div class="col-md-6">

                                    <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>

                                        <option value="" disabled selected>Select Complaint Category first</option>


                                    </select>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Complaint') }}</label>

                                <div class="col-md-6">
                                    <textarea id="message" type="text" class="form-control @error('type') is-invalid @enderror"  name="body" required></textarea>

                                    @error('message')
                                    <div class="text-danger text-xs" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    @if(session('sent'))
                                        <p class="alert-success">{{session('sent')}}</p>
                                    @endif
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register Complaint') }}
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <script type="text/javascript">
            window.location.href= "home";
        </script>
    @endif
@endsection
    @else
        <script type="text/javascript">
            window.location.href= "update";
        </script>

@endif
