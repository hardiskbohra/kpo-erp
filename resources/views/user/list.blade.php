@extends('layout/master')
@section('title', 'user-listing')
@section('page-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-analytics.css"> --}}
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}

    {{-- <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"> --}}


@endsection

@section('content')
      <!-- BEGIN: Content-->
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-filter px-1">
                        <form>
                            <div class="row border rounded py-2 mb-2">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-verified">Verified</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-verified">
                                            <option value="">Any</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-role">Role</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-role">
                                            <option value="">Any</option>
                                            <option value="User">User</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-status">Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-status">
                                            <option value="">Any</option>
                                            <option value="Active">Active</option>
                                            <option value="Close">Close</option>
                                            <option value="Banned">Banned</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                    <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>username</th>
                                                    <th>name</th>
                                                    <th>last activity</th>
                                                    <th>verified</th>
                                                    <th>role</th>
                                                    <th>status</th>
                                                    <th>edit</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                               {{-- {{ dd($user->role->id);}} --}}
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td><a href="./html/ltr/vertical-menu-template/page-users-view.html">{{$user->name}}</a>
                                                    </td>
                                                    <td>{{$user->name}}</td>
                                                    <td>30/04/2019</td>
                                                    <td>No</td>
                                                    <td><center>{{empty($user->role) ? '-' : $user->role->name}}</center></td>
                                                    <td><span class="badge badge-light-success">Active</span></td>
                                                    <td>
                                                        <a href="{{route('users.edit',$user->id)}}"><i class="bx bx-edit-alt"></i></a>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{route('users.destroy',$user->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="badge badge-light-danger" style="border: none">delete</i></button>
                                                        </form>
                                                    </td>

                                                </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('jqcdn')

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="./app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="./app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script> --}}
    <!-- END: Page Vendor JS-->

    {{-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></scri    pt> --}}

    {{-- <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="./app-assets/css/pages/page-users.css">

    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
@endsection
