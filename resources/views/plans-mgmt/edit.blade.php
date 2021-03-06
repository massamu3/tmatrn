@extends('plans-mgmt.base')

@section('action-content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Update</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('plan-management.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('plan_id') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">plan</label>
              <div class="col-md-6">
                <select class="form-control" name="plan_id">
                  @foreach ($plans as $plan)
                  <option value="{{$plan->id}}">{{$plan->name}}</option>
                  @endforeach
                </select>
                @if ($errors->has('plan_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('plan_id') }}</strong>
                </span>
                @endif
              </div>
            </div>



            <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Staff Name: </label>
              <div class="col-md-6">
                <select class="form-control" name="employee_id">
                  @foreach ($employees as $employee)
                  <option value="{{$employee->id}}">{{$employee->name_all}}</option>
                  @endforeach
                </select>
                @if ($errors->has('employee_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('employee_id') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <!-- employee_id program_id  startdate progmod pcost  -->

            <div class="form-group{{ $errors->has('program_id') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">Programs</label>
              <div class="col-md-6">
                <select class="form-control" name="program_id">
                  @foreach ($programs as $program)
                  <option value="{{$program->id}}">{{$program->name}}</option>
                  @endforeach
                </select>
                @if ($errors->has('program_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('program_id') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
              <label for="startdate" class="col-md-4 control-label">Time Period</label>
              <div class="col-md-6">
                {{ Form::select('startdate', ['2017 2018','2018 2019','2019 2020', '2020 2021', '2021 2022', '2022 2023', '2023 2024', '204 2025']) }}
                @if ($errors->has('startdate'))
                <span class="help-block">
                  <strong>{{ $errors->first('startdate') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('progmod') ? ' has-error' : '' }}">
              <label for="progmod" class="col-md-4 control-label">Program span</label>

              <div class="col-md-6">
                {{ Form::select('progmod', ['Long course' => 'Long course','Short Course' => 'Short Course']) }}
                @if ($errors->has('progmod'))
                <span class="help-block">
                  <strong>{{ $errors->first('progmod') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('pcost') ? ' has-error' : '' }}">
              <label for="pcost" class="col-md-4 control-label">Associated Cost</label>
              <div class="col-md-6">
                <input id="pcost" type="text" class="form-control" name="pcost" value="{{ old('pcost') }}" required>

                @if ($errors->has('pcost'))
                <span class="help-block">
                  <strong>{{ $errors->first('pcost') }}</strong>
                </span>
                @endif
              </div>
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


