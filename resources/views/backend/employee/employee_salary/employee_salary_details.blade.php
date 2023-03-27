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
                <h3 class="box-title">Employee Salary Details</h3>
                <h4><strong>Employee Name</strong> {{ $details->name }}</h4>
                <h4><strong>Employee Id No</strong> {{ $details->id_no }}</h4>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th width ="5%">SL</th>
                            <th>Previous Salary</th>
                            <th>Inctement Salary</th>
                            <th>Present Salary</th>
                            <th>Effected Salary</th>
                            </tr>
                      </thead>
                      <tbody>
                        @foreach ($salary_log as $key => $log)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $log->previous_salary }}</td>
                            <td>{{ $log->increment_salary }}</td>
                            <td>{{ $log->present_salary }}</td>
                            <td>{{date('d-m-Y',strtotime($log->effected_salary)) }}</td>
                            
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