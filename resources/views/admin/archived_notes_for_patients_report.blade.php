@extends('admin.layouts.mainlayout')
@section('title') <title>Arhived Notes For Patients  Report </title>
<style>
  #example1_wrapper {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-left: 20px;
}
  </style>
@endsection





@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <div class="dash-wrap">
        <div class="dashborad-header">
            <a id="menu-bar" href="#"><i class="fa fa-bars"></i></a>
            <h2>Archived Notes For Patient</h2>
            <a class="small-logo-mobile" href="#"><img src="assets/images/mobile-logo.png" alt=""></a>
            <div class="user-menu">
              
                    
            <div class="profile"> 
                  <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="{{ URL::asset('admin/images/user.png')}}" alt=""> 
                      <span>
                      @if(!empty(session('admin')['name']))
                        {{session('admin')['name']}}  
                      @endif
                      </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <!-- <a class="dropdown-item" href="{{url('user-details/'.session('admin')['id'])}}">My Profile</a>
                      <a class="dropdown-item" href="#">Setting</a> -->
                      <a class="dropdown-item" href="{{url('admin/profile')}}">Profile</a>
                      <a class="dropdown-item" href="{{url('admin/changepassword')}}">Change Password</a>

                      <a class="dropdown-item" href="{{url('admin/logout')}}">Logout</a>
                    </div>
                  </div>
                  <p class="online"><span></span>Online</p>
                </div>
                
            </div>
          </div>

          <div class="pharma-register">
              <h2>Search Results</h2>
          </div>

          <div class="reports-breadcrum m-0">

          <nav class="dash-breadcrumb" aria-label="breadcrumb" style="width:100%">
          <div class="row">
            <div class="col-md-7">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><img src="assets/images/icon-home.png" alt="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forms</li>
                <li class="breadcrumb-item active" aria-current="page">General Forms</li>
              </ol>
            </div>

            <div class="col-md-5 text-right">
            <a href="{{url('admin/notes_for_patients_report')}}" class="btn btn-primary" style="margin-bottom: 1%;float:right"> All Records</a>
                        
            </div>
          </div>    
         

            
            </nav>

          </div>
       
       

       
       
             



         <!-- Main content -->
         <section class="content" style="background-color: #ffffff;margin-top:10px;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0px 3px 20px rgb(0 0 0 / 6%);
    -webkit-box-shadow: 0px 3px 20px rgb(0 0 0 / 6%);">
          <div class="row">
          @if(Session::has('msg'))
              {!!  Session::get("msg") !!}
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-12">


            <div class="alertmessage"> </div>
              <div class="box" style="margin-top:15px">
              
                <div class="box-body pre-wrp-in table-responsive">
                
                @if(isset($all_not_for_patient))
                  <table id="example1" class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Pharmacy</th>
                        <th>Date Time</th>
                        <th>Patient Name</th>
                        <th>DOB</th>
                        <th>Note For Patient</th>
                        <th>Send Note As Text Message</th>
                        <th style="width: 60px;" >Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($all_not_for_patient as $value)
                      <tr id="row_{{$value->id}}">
                        <td></td>
                        <!-- <td><input type="checkbox" class="checkbox" data-id="{{$value->id}}" website-id="{{$value->website_id}}"></td> -->
                        <td>{{ucfirst($value->pharmacy)}}</td>
                        <td>{{date("j/n/Y, h:i A",strtotime($value->created_at))}}</td>
                        <td>{{ucfirst($value->first_name).' '.ucfirst($value->last_name)}}</a></td>
                        <td>{{date("j/n/Y",strtotime($value->dob))}}</td>
                        <td>{{$value->notes_for_patients}}</td>
                        <td>@if($value->notes_as_text=='1') True @else False @endif</td>
                        <td>
                          <!-- <a href="javascript:void(0)" onclick="view_info('Note For Patients Overview','{{$value->website_id}}','{{$value->id}}','noteForPatients_info')" title="View info" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Info</a>
                          &nbsp;&nbsp; -->
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_record('{{$value->website_id}}','{{$value->id}}');" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        <a href="javascript:void(0);" title="soft delete" onclick="soft_delete_record('{{$value->website_id}}','{{$value->id}}');" ><i class="fa fa-trash text-success"></i>&nbsp;&nbsp;
                        
                        <!-- <a href="{{url('admin/edit_note_for_patient/'.$value->website_id.'/'.$value->id)}}" title="edit"><i class="fa fa-edit text-success"></i></a></td> -->
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else
                  <h5 class="box-title text-danger">There is no data.</h3>
                  @endif


                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->


@endsection


@section('customjs')


    <script type="text/javascript">
    



      function delete_record(website_id,rowId)
      {
          if(confirm('Do you want  to  delete this?'))
          {     
            $.ajax({
                  type: "POST",
                  url: "{{url('admin/delete_note_for_patient')}}",
                  data: {'row_id':rowId,website_id:website_id,"_token":"{{ csrf_token() }}"},
                  success: function(result){
                      console.log(result);
                      alert(result);
                      if(result=='200'){
                        $('#row_'+rowId).remove();
                        $('.alertmessage').html('<span class="alert alert-success">Row deleted...</span>');
                      }
                      else{ 
                        $('.alertmessage').html('<span class="alert alert-danger">Somthing event wrong!...</span>'); 
                        }
                  }
              });
          }
      }

      function soft_delete_record(website_id,rowId)
      {
          if(confirm('Do you want  to unarchive this?'))
          {     
              $.ajax({
                  type: "POST",
                  url: "{{url('admin/soft_unarchive_note_for_patient')}}",
                  data: {archivetypeid:0,'row_id':rowId,website_id:website_id,"_token":"{{ csrf_token() }}"},
                  success: function(result){
                      console.log(result);
                      if(result=='200'){
                        $('#row_'+rowId).remove();
                        $('.alertmessage').html('<span class="alert alert-success">Row unarchived...</span>');
                      }
                      else{ 
                        $('.alertmessage').html('<span class="alert alert-danger">Somthing event wrong!...</span>'); 
                        }
                  }
              });
          }
      }
      

    </script>
@endsection