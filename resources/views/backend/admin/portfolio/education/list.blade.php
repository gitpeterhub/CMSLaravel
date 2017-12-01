@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Users</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/customize-datatable.css')}}">
<style type="text/css">
    #imagePreview {
        width: 150px;
        height: 150px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-bottom: 10px;
    }
</style>
  
@endsection
@section('contents')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Education
        <small>Education List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li class="active">Eucation List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
         @if(Session::has('message'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong id="site-message">
                  <p>{{Session::get('message')}}</p>
                </strong>
            </div>
            {{Session::forget('message')}}
          @endif
          <a class="btn btn-success pull-right" href="{{url('admin/portfolio/education/create')}}">
            Add Degree</a>
      <!-- Datatable row starts -->
        <div class="row">
            <div class="col-md-12">
                <table border="1" cellpadding="1" cellspacing="1" id="education" class="table table-bordered table-hover" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>DEGREE</th>
                        <th>MAJOR</th>
                        <th>GRADUATION YEAR</th>
                        <th>BOARD/UNIVERSITY</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>DEGREE</th>
                        <th>MAJOR</th>
                        <th>BOARD/UNIVERSITY</th>
                        <th>ACTION</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Datatable row ends -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./Content Wrapper-->
  @endsection

@section('scripts')

<script>
  $('.treeview').siblings().removeClass('active');
  $('.portfolio').addClass('active');
  $('.education').siblings().removeClass('active');
  $('.education').addClass('active');  
  </script>
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- script for datatable plugin -->
<script type="text/javascript">
                    $(document).ready(function () {
                         
                        $('#education').DataTable({
                            "columns": [
                                {"data": "id"},
                                {"data": "degree"},
                                {"data": "major"},
                                {"data": "graduation_year"},
                                {"data": "board_or_university"},
                                {"data": "action"}
                            ],

                            "columnDefs": [ {
                                  "targets": [ 5 ],
                                  "orderable": false
                                },

                                ],
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                     "url": "{{url('admin/portfolio/education/list')}}",
                                     "dataType": "json",
                                     "type": "POST",
                                     "data":{ _token: "{{csrf_token()}}"}
                                   },
                        });

                    });
   </script>
  

@endsection
