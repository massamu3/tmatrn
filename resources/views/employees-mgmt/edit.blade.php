@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee-management.update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name_all') ? ' has-error' : '' }}">
                            <label for="name_all" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="name_all" type="text" class="form-control" name="name_all" value="{{ old('name_all') }}" required autofocus>

                                @if ($errors->has('name_all'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_all') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        



                        <div class="form-group{{ $errors->has('chequeno') ? ' has-error' : '' }}">
                            <label for="chequeno" class="col-md-4 control-label">chequeno</label>

                            <div class="col-md-6">
                                <input id="chequeno" type="text" class="form-control" name="chequeno" value="{{ old('chequeno') }}" required>

                                @if ($errors->has('chequeno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('chequeno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">sex</label>

                            <div class="col-md-6">
                                <input id="sex" type="text" class="form-control" name="sex" value="{{ old('sex') }}" required>

                                @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Birthday</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('birthdate') }}" name="birthdate" class="form-control pull-right" id="birthDate" required>
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Hired Date</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('date_hired') }}" name="date_hired" class="form-control pull-right" id="hiredDate" required>
                                </div>
                            </div>
                        </div>


                     <div class="form-group">
                           <label class="col-md-4 control-label">Designation</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('designation') }}" name="designation" class="form-control pull-right" id="hiredDate" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_id">
                                    @foreach ($statuss as $status)
                                        <option value="{{$status_id->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                                 @if ($errors->has('status_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                     <div class="form-group{{ $errors->has('schemeservice_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">schemeservice</label>
                            <div class="col-md-6">
                                <select class="form-control" name="schemeservice_id">
                                    @foreach ($schemeservices as $schemeservice)
                                        <option value="{{$schemeservice->id}}">{{$schemeservice->name}}</option>
                                    @endforeach
                                </select>
                                 @if ($errors->has('schemeservice_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('schemeservice_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">Station</label>
                            <div class="col-md-6">
                                <select class="form-control js-station" name="station_id">
                                    <option value="-1">Please select your station</option>
                                    @foreach ($stations as $station)
                                        <option value="{{$station->id}}">{{$station->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Division</label>
                            <div class="col-md-6">
                                <select class="form-control js-divisions" name="division_id">
                                    <option value="-1">Please select Division</option>
                                    {{--  @foreach ($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach  --}}
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Sections</label>
                            <div class="col-md-6">
                                <select class="form-control js-sections" name="section_id">
                                    <option value="-1">Please select your section</option>
                                    {{--  @foreach ($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach  --}}
                                </select>
                            </div>
                        </div>

           

                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label" >Picture</label>
                            <div class="col-md-6">
                                <input type="file" id="picture" name="picture" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
