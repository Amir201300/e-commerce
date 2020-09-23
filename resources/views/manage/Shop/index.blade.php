@extends('layouts.manage')

@section('title')
{{trans('main.Shop')}}
@endsection

@section('content')
    
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">{{trans('main.settings')}}</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">{{trans('main.home')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{trans('main.Shop')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-30">
                                    <h4 class="card-title">{{trans('main.Shop')}}</h4>
                                    <div class="ml-auto">
                                        <div class="btn-group">
                                            <button  class="btn btn-dark " data-toggle="modal" onclick="addFunction()">
                                                {{trans('main.AddNewShop')}}
                                            </button>
                                            &nbsp;
                                            <button  class="btn btn-danger " data-toggle="modal" onclick="deleteFunction(0,2)">
                                                {{trans('main.deleteSpecified')}}
                                            </button>

                                        </div>
                                        
                                    </div>
                                    
                                </div>
                      
                                <div class="table-responsive" style="overflow: hidden;">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="sorting_asc" tabindex="0" aria-controls="file_export" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" : activate to sort column descending" style="width: 0px;"> </th>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.icon')}}</th>
                                                <th>{{trans('main.name_ar')}}</th>
                                                <th>{{trans('main.name_en')}}</th>
                                                <th>{{trans('main.status')}}</th>
                                                <th>{{trans('main.type')}}</th>
                                                <th>{{trans('main.chooseProduct')}}</th>
                                                <th>{{trans('main.options')}}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                  
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('manage.Shop.form')

            @include('manage.Shop.show')
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div> 
</div>    

@endsection

@section('script')
<script>
        $(document).ready(function(){
            $('#showmenu').click(function() {
                $('.menuFilter').toggle("slide");
            });
        });
    </script>
<script src="/manage/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="/manage/dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    @include('manage.Shop.script')
    @include('manage.Shop.DaysScript')
    @include('manage.Shop.FaScript')

@endsection
