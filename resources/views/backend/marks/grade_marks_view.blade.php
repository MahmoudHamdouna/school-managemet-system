@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
        <div class="row">
           <div class="col-12">
             <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Grade Marks List</h3>
                <a href="{{ route('marks.grade.add') }}" style="float : right" class="btn btn-rounded btn-success mb-5">Add Grade Marks</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th width ="5%">SL</th>
                            <th>Grade Name</th>
                            <th>Grade Point</th>
                            <th>Start Marks</th>
                            <th>End Marks</th>
                            <th>Point Range</th>
                            <th>Remarks</th>
                            
                            <th width = "15%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($allData as $key => $vaule)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $vaule->grade_name }}</td>
                            <td>{{ number_format((float)$vaule->grade_point,2) }}</td>
                            <td>{{ $vaule->start_marks }}</td>
                            <td>{{ $vaule->end_marks }}</td>
                            <td>{{ $vaule->start_point }} - {{ $vaule->end_point }}</td>
                            <td>{{ $vaule->remarks }}</td>
                            <td>
                                <a href="{{ route('marks.grade.edit',$vaule->id) }}" class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
                   
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection