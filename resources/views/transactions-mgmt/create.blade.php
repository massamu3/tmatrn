@extends('transactions-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction-management.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Employee</label>
                            <div class="col-md-6">
                                {!! Form::select('employee_id', $employees, ['class'=>'form-control']) !!}
                                @if ($errors->has('employee_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('program_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Program Name</label>
                            <div class="col-md-6">
                                {!! Form::select('program_id', $programs, ['class'=>'form-control']) !!}
                                @if ($errors->has('program_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('program_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Institution</label>
                            <div class="col-md-6">
                                {!! Form::select('school_id', $schools, ['class'=>'form-control']) !!}
                                @if ($errors->has('school_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('school_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>






                <div class="form-group{{ $errors->has('progmode') ? ' has-error' : '' }}">
                  <label for="progmode" class="col-md-4 control-label">Status</label>

                  <div class="col-md-6">
                      {{ Form::select('status2', ['Progressing Well' => 'Progressing Well','Fail' => 'Fail', 'postponed' => 'postponed']) }}
                      @if ($errors->has('status2'))
                      <span class="help-block">
                        <strong>{{ $errors->first('progmode') }}</strong>
                    </span>
                    @endif
                </div>
            </div>


                <div class="form-group{{ $errors->has('lasttrnperiod') ? ' has-error' : '' }}">
                    <label for="lasttrnperiod" class="col-md-4 control-label">Last Trainied period</label>

                    <div class="col-md-6">
                        {{ Form::selectRange('lasttrnperiod', 2000, 2018)}}
                        <!--        {{Form::number('lasttrnperiod', 'value',['min'=>2000,'max'=>2018])}} -->

                    </div>
                </div>






                   <div class="form-group">
                            <label class="col-md-4 control-label">Program start date</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('startdate') }}" name="startdate" class="form-control pull-right" id="birthDate" required>
                                </div>
                            </div>
                        </div>




           <div class="form-group">
                    <label class="col-md-4 control-label">End Program Date-yes</label>
                    <div class="col-md-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" value="{{ old('enddate') }}" name="enddate" class="form-control pull-right" id="hiredDate" required>
                        </div>
                    </div>
                </div>
   






                <div class="form-group{{ $errors->has('progmode') ? ' has-error' : '' }}">
                  <label for="progmode" class="col-md-4 control-label">progmode</label>

                  <div class="col-md-6">
                      {{ Form::select('progmode', ['Long course' => 'Long course','Short Course' => 'Short Course']) }}
                      @if ($errors->has('progmode'))
                      <span class="help-block">
                        <strong>{{ $errors->first('progmode') }}</strong>
                    </span>
                    @endif
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
