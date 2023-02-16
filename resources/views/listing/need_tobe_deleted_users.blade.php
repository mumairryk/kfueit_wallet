@extends('layouts.master')
@section('page_title', 'Users')
@section('users_layout_select', 'nav-item-open nav-item-expanded')
@section('user_layout_select', 'active')
@section('top_buttons')
    <a href="{{route('user.create')}}" class="btn  btn-success btn-labeled btn-labeled-left" data-toggle="tooltip" title="Add New User"><b><i class="icon-plus-circle2 "></i></b><span>Create User</span></a>
@stop
@section('content')
    <div class="card border-success">
        <div class="card-header border-bottom-success alpha-success text-success-800 header-elements-inline">
            <h3 class="card-title"><i class="fas fa-chalkboard-teacher mr-2 fa-2x"></i>Users</h3>
            <div class="header-elements">

            </div>
        </div>

        <div class="card-body">
            <table class="table datatable-button-html5-columns table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Name</th>
                    <th>User Id</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created At</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody>

                @if($users->isNotEmpty())
                    @foreach($users as $user)

                        <tr>

                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>

                            <td>

                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>

                            <td>{{$user->created_at->diffforHumans()}}</td>

                            <td class="text-center">
                                                            <div class="list-icons">
                                                                <div class="dropdown">
                                                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a href="{{route('user.role', $user->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> Role</a>
                                                                        <a href="{{route('test.role', $user->id)}}" class="dropdown-item"><i class="icon-pencil7"></i> Test Role</a>
                                                                        <a href="{{route('teacher.delete', $user->id)}}" id="delete" class="dropdown-item" ><i class="icon-trash"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                        </tr>

                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('custom_js')
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/demo_pages/datatables_extension_buttons_html5.js"></script>
@endsection
