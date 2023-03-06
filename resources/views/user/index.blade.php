@extends('layouts.master')
@section('page_title', 'Users')
@section('page-title','Users')
@section('breadcrumb','Users')
@section('user_main_layout_select', 'nav-item-open nav-item-expanded')
@section('user_main_layout_select', 'active')
@section('user_sub_manu_layout_select', 'active')
{{--@can('user.create')--}}
@section('top_buttons')
@stop
{{--@endcan--}}
@section('content')
    <div class="card border-success">
        <div class="card-header border-bottom-success alpha-success text-success-800 header-elements-inline">
            <h3 class="card-title"><i class="fas fa-chalkboard-teacher mr-2 fa-2x"></i> Users</h3>
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
                    <th>Created At</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody>

                @if($users->isNotEmpty())
                    @foreach($users as $user)

                        @if ($loop->iteration % 2 == 0)
                            <tr class="alert-success">
                        @else
                            <tr class="alert-light">
                                @endif
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffforHumans()}}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('assign.card', ['uuid'=>$user->uuid])}}"
                                                   class="dropdown-item"><i class="icon-pencil7"></i> Assign </a>
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
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/demo_pages/datatables_extension_buttons_html5.js"></script>
@endsection
