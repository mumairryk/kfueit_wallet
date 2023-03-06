<!-- Sidebar content -->
			<div class="sidebar-content">
				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>
							<div class="media-body">
								<div class="media-title font-weight-semibold">{{auth()->user()->name}}</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;KFUEIT RYK
								</div>
							</div>
							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
                </div>
                <!-- /user menu -->
                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <!-- Main -->
                        <li class="nav-item-header">
                            <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                            <i class="icon-menu" title="Main"></i>
                        </li>
                        <li class="nav-item nav-item-submenu @yield('user_main_layout_select')">
                            <a href="#" class="nav-link "><i class="fas fa-users"></i> <span>User Manage</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item">
                                    <a href="{{route('users.index') }}" target=""
                                       class="nav-link @yield('user_sub_manu_layout_select')"> <i
                                            class="fas fa-dot-circle"></i> Users List </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu @yield('wallet_layout_select')">
                            <a href="#" class="nav-link "><i class="icon-copy"></i>
                                <span>Wallet Management</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item">
                                    <a href="{{route('getdata') }}" target=""
                                       class="nav-link @yield('user_layout_select')"> <i
                                            class="fas fa-dot-circle"></i> Transaction History </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('debit.history') }}" target=""
                                       class="nav-link @yield('user_layout_select')"> <i
                                            class="fas fa-dot-circle"></i> Debit History </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('credit.history') }}" target=""
                                       class="nav-link @yield('user_layout_select')"> <i
                                            class="fas fa-dot-circle"></i> Credit History </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('pending.challah') }}" target=""
                                       class="nav-link @yield('user_layout_select')"> <i
                                            class="fas fa-dot-circle"></i> Pending Transaction </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /main navigation -->
            </div>
<!-- /sidebar content -->
