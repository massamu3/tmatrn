@extends('plans-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('plan-management.store') }}" enctype="multipart/form-data">
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
                            <label class="col-md-4 control-label">Program </label>
                            <div class="col-md-6">
                                {!! Form::select('program_id', $programs, ['class'=>'form-control']) !!}
                                @if ($errors->has('program_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('program_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('academic_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Program Name </label>
                            <div class="col-md-6">
                                {!! Form::select('academic_id', $academics, ['class'=>'form-control']) !!}
                                @if ($errors->has('academic_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('academic_id') }}</strong>
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



                        <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
                            <label for="startdate" class="col-md-4 control-label">Financial Year</label>
                            <div class="col-md-6">
                                {{ Form::select('startdate',
                                ['2017/2018' => '2017/2018',
                                '2018/2019' => '2018/2019',
                                '2019/2020' => '2019/2020',
                                '2020/2021' => '2020/2021',
                                '2021/2022' => '2021/2022',
                                '2022/2023' => '2022/2023',
                                '2023/2024' => '2023/2024',
                                '2024/2025' => '2024/2025'
                                ]) }}                                  
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('progmod') ? ' has-error' : '' }}">
                          <label for="progmod" class="col-md-4 control-label">Program Type</label>

                          <div class="col-md-6">
                              {{ Form::select('progmod', ['Long Course' => 'Long Course','Short Course' => 'Short Course']) }}
                              @if ($errors->has('progmod'))
                              <span class="help-block">
                                <strong>{{ $errors->first('progmod') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('ifattend') ? ' has-error' : '' }}">
                      <label for="ifattend" class="col-md-4 control-label">Confirm if has attended</label>

                      <div class="col-md-6">
                         Attended:    {{ Form::radio('ifattend', 'Attended') }}<br>Not attended: {{ Form::radio('ifattend', 'Not attended') }}
                         <span class="help-block">
                            <strong>{{ $errors->first('ifattend') }}</strong>
                        </span>

                    </div>
                </div>


                <div class="form-group{{ $errors->has('pcost') ? ' has-error' : '' }}">
                    <label for="pcost" class="col-md-4 control-label">pcost</label>

                    <div class="col-md-6">
                        <input id="pcost" type="text" class="form-control" name="pcost" value="{{ old('pcost') }}" required>

                        @if ($errors->has('pcost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pcost') }}</strong>
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
