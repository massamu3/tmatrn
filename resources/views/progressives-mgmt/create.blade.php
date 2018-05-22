    @extends('progressives-mgmt.base')

    @section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('progressive-management.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('transaction_id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Select time frame</label>
                                <div class="col-md-6">
                                    {!! Form::select('transaction_id', $transactions, ['class'=>'form-control']) !!}
                                    @if ($errors->has('transaction_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transaction_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




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




                            <div class="form-group{{ $errors->has('doc_type') ? ' has-error' : '' }}">
                              <label for="doc_type" class="col-md-4 control-label">Document Type</label>

                              <div class="col-md-6">
                                {{ Form::select('doc_type', ['Certificate' => 'Certificate','Progressive Report' => 'Progressive Report']) }}
                                @if ($errors->has('doc_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doc_type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <!--  id  transaction_id  employee_id doc_type    attach_doc  remarks flag -->
                        <div class="form-group">
                            <label for="ripositori" class="col-md-4 control-label" >Attach from here </label>
                            <div class="col-md-6">
                                <input type="file" id="attach_doc" name="attach_doc" required >
                            </div>
                        </div>


                        
                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            <label for="remarks" class="col-md-4 control-label">remarks</label>

                            <div class="col-md-6">
                                <input id="remarks" type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" required>

                                @if ($errors->has('remarks'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('remarks') }}</strong>
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
