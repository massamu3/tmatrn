@extends('transactions-mgmt.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update program</div>
                <div class="panel-body">
<!--Form start -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction-management.update', ['id' => $transaction->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name_all') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">program Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name_all" value="{{ $employees->name_all }}" required autofocus>

                                @if ($errors->has('name_all'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_all') }}</strong>
                                    </span>
                                @endif
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
                    <!-- Form end-->

                    <!-- <form class="form-horizontal" role="form" method="POST" action="{{ route('transaction-management.update', ['id' => $transaction->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }}




                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Employee</label>
                          <div class="col-md-6">
                              <select class="form-control" name="employee_id">
                                  @foreach ($employees as $employee)
                                  <option value="{{$employee->id}}">{{$employee->name}}</option>
                                  @endforeach
                              </select>
                              @if ($errors->has('employee_id'))
                              <span class="help-block">
                                <strong>{{ $errors->first('name_all') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

       


                <div class="form-group{{ $errors->has('status2') ? ' has-error' : '' }}">
                    <label for="status2" class="col-md-4 control-label">status2</label>

                    <div class="col-md-6">
                        <input id="status2" type="text" class="form-control" name="status2" value="{{ old('status2') }}" required>

                        @if ($errors->has('status2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status2') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('lasttrnperiod') ? ' has-error' : '' }}">
                    <label for="lasttrnperiod" class="col-md-4 control-label">lasttrnperiod</label>

                    <div class="col-md-6">
                        <input id="lasttrnperiod" type="text" class="form-control" name="lasttrnperiod" value="{{ old('lasttrnperiod') }}" required>

                        @if ($errors->has('lasttrnperiod'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lasttrnperiod') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Program start Date  </label>
                    <div class="col-md-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" value="{{ old('startdate') }}" name="startdate" class="form-control pull-right" id="startdate" required>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label">Program End Date</label>
                    <div class="col-md-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" value="{{ old('enddate') }}" name="enddate" class="form-control pull-right" id="enddate" required>
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('progmode') ? ' has-error' : '' }}">
                    <label for="progmode" class="col-md-4 control-label">progmode</label>

                    <div class="col-md-6">
                        <input id="progmode" type="text" class="form-control" name="progmode" value="{{ old('progmode') }}" required>

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
                                Save
                            </button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
</div>
</div>
@endsection
 -->