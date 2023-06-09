@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

 <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		 

		<!-- Main content -->
		<section class="content">
		  <div class="row">

		
<div class="col-12">
<div class="box bb-3 border-warning">
				  <div class="box-header">
					<h4 class="box-title">Manage <strong>Employee Attendance Report</strong></h4>
				  </div>

				  <div class="box-body">
				
		<form method="get" action="{{ route('report.attendance.get') }} " target="_blank">
			@csrf


			<div class="row">



<div class="col-md-4">

 		 <div class="form-group">
		<h5>Employee Name <span class="text-danger"> </span></h5>
		<div class="controls">
	 <select name="employee_id" id="employee_id" required="" class="form-control">
			<option value="" selected="" disabled="">Select Employee</option>
			 @foreach($employees as $employee)
 <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
		 	@endforeach 
		</select>
	  </div>		 
	  </div>
	  
 			</div> <!-- End Col md 3 -->   

             <div class="col-md-4">
                <div class="form-group">
                    <h5>Date <span class="text-danger">*</span></h5>
                    <div class="controls">
                 <input type="date" name="date" class="form-control" required="" > 
                  </div>		 
                  </div>
            </div><!-- End Col md 4 -->
        
            <div class="col-md-4" style="padding-top: 25px;">
                <input type="submit" class="btn btn-rounded btn-primary" value="Search" >	  
 			</div> <!-- End Col md 4 --> 

                </div><!-- End Row -->



 <!--  ////////////////// Mark Entry table /////////////  -->
		</form> 	       
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  </div>
  </div>


<script type="text/javascript">
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
	var assign_subject_id = $('#assign_subject_id').val();
    var exam_type_id = $('#exam_type_id').val();

     $.ajax({
      url: "{{ route('student.marks.getstudents')}}",
      type: "GET",
      data: {'year_id':year_id,'class_id':class_id},
      success: function (data) {
        $('#marks-entry').removeClass('d-none');
        var html = '';
        $.each( data, function(key, v){
          html +=
          '<tr>'+
          '<td>'+v.student.id_no+'<input type="hidden" name="id_no[]" value="'+v.student.id_no+'"><input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
          '<td>'+v.student.name+'</td>'+
          '<td>'+v.student.fname+'</td>'+
          '<td>'+v.student.gender+'</td>'+
          '<td><input type="text" class="form-control form-control-sm" name="marks[]" ></td>'+
          '</tr>';
        });
        html = $('#marks-entry-tr').html(html);
      }
    });
  });

</script>

<!-========================-  Load class by subject ====================== -->
{{-- get student subject --}}
<script type="text/javascript">
  $(function(){
    $(document).on('change','#class_id',function(){
      var class_id = $('#class_id').val();
      $.ajax({
        url:"{{ route('marks.getsubject') }}",
        type:"GET",
        data:{class_id:class_id},
        success:function(data){
          var html = '<option value="">Select Subject</option>';
          $.each( data, function(key, v) {
            html += '<option value="'+v.id+'">'+v.school_subject.name+'</option>';
          });
          $('#assign_subject_id').html(html);
        }
      });
    });
  });
</script>
<!-========================-End  Load class by subject ====================== -->


@endsection
