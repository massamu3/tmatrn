@extends('academiclevels-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Academic Level</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('academiclevel-management.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Select employees</label>
                            <div class="col-md-6">
              <!--               {!! Form::select('lastname', 'firstname', 'middlename', 'id',  $employees, ['class'=>'form-control']) !!}
                @if ($errors->has('employee_id')) -->

                {!! Form::select('employee_id', $employees, ['class'=>'form-control']) !!}


                <span class="help-block">
                    <strong>{{ $errors->first('employee_id') }}</strong>
                </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('program_id') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">program</label>
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
            <label class="col-md-4 control-label">academic</label>
            <div class="col-md-6">
                {!! Form::select('academic_id', $academics, ['class'=>'form-control']) !!}
                @if ($errors->has('academic_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('academic_id') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('timeperiod') ? ' has-error' : '' }}">
            <label for="timeperiod" class="col-md-4 control-label">Time Period</label>
            <div class="col-md-6">
                {{ Form::select('timeperiod', ['1985 1986','1986 1987','1987 1988','1988 1989','1989 1990','1990 1991','1991 1992','1992 993','1993 1994','1994 1995','1995 1996','1996 1997','1997 1998','1998 1999','1999 2000','2000 2001','2001 2002','2002 2003','2003 2004','2004 2005','2005 2006','2006 2007','2007 2008','2008 2009','2009 2010','2010 2011','2011 2012','2012 2013','2013 2014','2014 2015','2015 2016','2016 2017','2017 2018','2018 2019','2019 2020']) }}
                @if ($errors->has('timeperiod'))
                <span class="help-block">
                    <strong>{{ $errors->first('timeperiod') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('gpa') ? ' has-error' : '' }}">
          <label for="gpa" class="col-md-4 control-label">Collage GPA</label>

          <div class="col-md-6">
            <input id="gpa" type="text" class="form-control" name="gpa" value="{{ old('gpa') }}" required>

            @if ($errors->has('gpa'))
            <span class="help-block">
              <strong>{{ $errors->first('gpa') }}</strong>
          </span>
          @endif
      </div>
  </div>

  <div class="form-group{{ $errors->has('qualification') ? ' has-error' : '' }}">
      <label for="qualification" class="col-md-4 control-label">Qualification</label>

      <div class="col-md-6">
        <input id="qualification" type="text" class="form-control" name="qualification" value="{{ old('qualification') }}" required>

        @if ($errors->has('qualification'))
        <span class="help-block">
          <strong>{{ $errors->first('qualification') }}</strong>
      </span>
      @endif
  </div>
</div>


<div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
  <label for="remarks" class="col-md-4 control-label">Remarks</label>

  <div class="col-md-6">
    <input id="remarks" type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" required>

    @if ($errors->has('remarks'))
    <span class="help-block">
      <strong>{{ $errors->first('qualification') }}</strong>
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