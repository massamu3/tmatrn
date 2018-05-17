@extends('academiclevels-mgmt.base')
@section('action-content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Training: Academiclevel and Qualification</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('academiclevel-management.create') }}">Add new Record</a>
        </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('academiclevel-management.search') }}">
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

                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Names</th>


                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sex: activate to sort column ascending">Academic Level</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="school: activate to sort column ascending">Program </th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status2: activate to sort column ascending">Time frame</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="gpa: activate to sort column ascending">Collage GPA</th>


                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="qualification: activate to sort column ascending">Qualification</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="remarks: activate to sort column ascending">Remarks</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($academiclevels as $academiclevel)
              <tr role="row" class="odd">
                <td class="hidden-xs">{{$academiclevel->employees->id }}</td>
                <td class="hidden-xs">{{$academiclevel->academics->name }}</td>
                <td class="hidden-xs">{{$academiclevel->programs->name }}</td>
                <td class="hidden-xs">{{$academiclevel->timeperiod}}</td>
                <td class="hidden-xs">{{$academiclevel->gpa}}</td>
                <td class="hidden-xs">{{$academiclevel->qualification}}</td>

                <td>



                  <!--     id  employee_id academic_id program_id  timeperiod   -->

                  <form class="row" method="POST" action="{{ route('academiclevel-management.destroy', ['id' => $academiclevel->id]) }}" onsubmit = "return confirm('Are you sure?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('academiclevel-management.edit', ['id' => $academiclevel->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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

                             <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Names</th>


                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sex: activate to sort column ascending">Academic Level</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="school: activate to sort column ascending">Program </th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="status2: activate to sort column ascending">Time frame</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="gpa: activate to sort column ascending">Collage GPA</th>


                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="qualification: activate to sort column ascending">Qualification</th>

                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="remarks: activate to sort column ascending">Remarks</th>



                            <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>

                          </tr>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($academiclevels)}} of {{count($academiclevels)}} entries</div>
                  </div>
                  <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                      {{ $academiclevels->links() }}
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