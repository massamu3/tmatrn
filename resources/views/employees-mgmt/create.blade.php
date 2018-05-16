@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new employee</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee-management.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

                                @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                            <label for="middlename" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" required>

                                @if ($errors->has('middlename'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('middlename') }}</strong>
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
                        {{ Form::select('sex', ['Female' => 'Female','Male' => 'Male']) }}
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




                        <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Designation</label>
                            <div class="col-md-6">
                                {!! Form::select('designation_id', $designations, ['class'=>'form-control']) !!}
                                @if ($errors->has('designation_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('designation_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>






                        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">

                                {!! Form::select('status_id', $statuss, ['class'=>'form-control']) !!}

                                @if ($errors->has('status_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('schemeservice') ? ' has-error' : '' }}">
                            <label for="schemeservice" class="col-md-4 control-label">Terms of Service</label>

                            <div class="col-md-6">
                               
                                {{ Form::select('schemeservice', ['Permanent and Penssionable' => 'Permanent and Penssionable','Operational Services' => 'Operational Services']) }}

                                @if ($errors->has('schemeservice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schemeservice') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('station_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Station</label>
                            <div class="col-md-6">
                                {!! Form::select('station_id', $stations, ['class'=>'form-control']) !!}
                                @if ($errors->has('station_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('station_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Divisions</label>
                            <div class="col-md-6">
                                {!! Form::select('division_id', $divisions, ['class'=>'form-control']) !!}
                                @if ($errors->has('division_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('division_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Station</label>
                            <div class="col-md-6">
                                {!! Form::select('division_id', $divisions, ['class'=>'form-control']) !!}
                                @if ($errors->has('division_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('division_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Section</label>
                            <div class="col-md-6">
                                {!! Form::select('section_id', $sections, ['class'=>'form-control']) !!}
                                @if ($errors->has('section_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('section_id') }}</strong>
                                </span>
                                @endif
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
                                    Create
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
