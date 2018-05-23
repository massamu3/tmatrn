@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update employee</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee-management.update', ['id' => $employee->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name_all') ? ' has-error' : '' }}">
                            <label for="name_all" class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-6">
                                <input id="name_all" type="text" class="form-control" name="name_all" value="{{ $employee->name_all }}" required autofocus>
                                @if ($errors->has('name_all'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_all') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> 

                    <div class="form-group{{ $errors->has('chequeno') ? ' has-error' : '' }}">
                            <label for="chequeno" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <input id="chequeno" type="text" class="form-control" name="chequeno" value="{{ $employee->chequeno }}" required>

                                @if ($errors->has('chequeno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('chequeno') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">Cheque No:</label>

                            <div class="col-md-6">
                                <input id="sex" type="text" class="form-control" name="sex" value="{{ $employee->sex }}" required>

                                @if ($errors->has('sex'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
    


                        <div class="form-group">
                            <label class="col-md-4 control-label">BirthDate</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ $employee->birthdate }}" name="birthdate" class="form-control pull-right" id="hiredDate" required>
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
                                    <input type="text" value="{{ $employee->date_hired }}" name="date_hired" class="form-control pull-right" id="hiredDate" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Designation</label>
                            <div class="col-md-6">
                                <select class="form-control" name="designation_id">
                                    @foreach ($designations as $designation)
                                    <option {{$employee->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_id">
                                    @foreach ($statuss as $status)
                                    <option {{$employee->status_id == $status->id ? 'selected' : ''}} value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('schemeservice') ? ' has-error' : '' }}">
                            <label for="schemeservice" class="col-md-4 control-label">schemeservice</label>

                            <div class="col-md-6">
                                <input id="schemeservice" type="text" class="form-control" name="schemeservice" value="{{ $employee->schemeservice }}" required>

                                @if ($errors->has('schemeservice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schemeservice') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">station</label>
                            <div class="col-md-6">
                                <select class="form-control" name="station_id">
                                    @foreach ($stations as $station)
                                    <option {{$employee->station_id == $station->id ? 'selected' : ''}} value="{{$station->id}}">{{$station->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">division</label>
                            <div class="col-md-6">
                                <select class="form-control" name="division_id">
                                    @foreach ($divisions as $division)
                                    <option {{$employee->division_id == $division->id ? 'selected' : ''}} value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">section</label>
                            <div class="col-md-6">
                                <select class="form-control" name="section_id">
                                    @foreach ($sections as $section)
                                    <option {{$employee->section_id == $section->id ? 'selected' : ''}} value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label" >Picture</label>
                            <div class="col-md-6">
                                <img src="../../{{$employee->picture }}" width="50px" height="50px"/>
                                <input type="file" id="picture" name="picture" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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

