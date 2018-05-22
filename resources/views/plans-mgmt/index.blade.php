@extends('plans-mgmt.base')
@section('action-content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Training: plans</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('plan-management.create') }}">Add new Record</a>
        </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('plan-management.search') }}">
       {{ csrf_field() }}
       @component('layouts.search', ['title' => 'Search'])
       @component('layouts.two-cols-search-row', ['items' => ['First Name', 'division_name'], 
       'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['division_name'] : '']])
       @endcomponent
       @endcomponent
     </form>
     <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">

                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Full Name</th>


                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="program: activate to sort column ascending">Program  </th>


                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="program: activate to sort column ascending">Program Name </th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="startdate: activate to sort column ascending">Financial Year</th>
                

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="startdate: activate to sort column ascending">Financial Year</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="progmod: activate to sort column ascending">Program Type</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="pcost: activate to sort column ascending">Associated Costs</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="pcost: activate to sort column ascending">Has Attended?</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($plans as $plan)
              <tr role="row" class="odd">
                <td class="hidden-xs">{{$plan->employees->name_all }}</td>
                <td class="hidden-xs">{{$plan->programs->name }}</td>
                <td class="hidden-xs">{{$plan->academics->name }}</td>
                <td class="hidden-xs">{{$plan->schools->name }}</td>
                <td class="hidden-xs">{{$plan->startdate}}</td>
                <td class="hidden-xs">{{$plan->progmod}}</td>
                <td class="hidden-xs">{{$plan->ifattend}}</td>
                <td class="hidden-xs">{{$plan->pcost}}</td>


                <td>
                  <form class="row" method="POST" action="{{ route('plan-management.destroy', ['id' => $plan->id]) }}" onsubmit = "return confirm('Are you sure?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('plan-management.edit', ['id' => $plan->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                      Update
                    </a>
                    <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                          <tr role="row">

                            <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Full Name</th>


                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="program: activate to sort column ascending">Program  </th>

                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="program: activate to sort column ascending">Program Name </th>
                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="startdate: activate to sort column ascending">Financial Year</th>

                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="progmod: activate to sort column ascending">Program Type</th>

                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="pcost: activate to sort column ascending">Associated Costs</th>

                            <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="pcost: activate to sort column ascending">Has Attended?</th>

                            <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                          </tr>

                        </tr>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-5">
                  <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($plans)}} of {{count($plans)}} entries</div>
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    {{ $plans->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    @endsection