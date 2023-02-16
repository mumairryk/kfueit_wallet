
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
								<div class="media-title font-weight-semibold">Admin User</div>
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
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="index.html" class="nav-link">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>

						<li class="nav-item nav-item-submenu @yield('academics_layout_select')">
							<a href="#" class="nav-link "><i class="icon-copy"></i> <span>Academic</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
{{--                                <li class="nav-item"><a href="{{route('building.list')}}" class="nav-link @yield('building_layout_select')">Manage Buildings</a></li>--}}
{{--                                <li class="nav-item"><a href="{{route('external_institutions.list')}}" class="nav-link @yield('external_institution_layout_select')">Manage External Institutions</a></li>--}}
                                <li class="nav-item"><a href="{{route('plan_of_study.list')}}" class="nav-link @yield('pos_layout_select')">Manage Plan of Studies</a></li>
{{--                                <li class="nav-item"><a href="{{route('program.list')}}" class="nav-link @yield('program_layout_select')">Manage Programs</a></li>--}}
{{--                                <li class="nav-item"><a href="{{route('fee_plan.list')}}" class="nav-link @yield('fee_layout_select')">Manage Fee Plan</a></li>--}}
                                <li class="nav-item"><a href="{{route('academic.session')}}" class="nav-link @yield('academic_layout_select')">Manage Academic Session</a></li>
{{--                                <li class="nav-item"><a href="{{route('academic_status.list')}}" class="nav-link @yield('academic_status_layout_select')">Manage Academic Status</a></li>--}}
{{--                                <li class="nav-item"><a href="{{route('semester.type')}}" class="nav-link @yield('semester_layout_select')">Manage Semester Type</a></li>--}}
{{--                                <li class="nav-item"><a href="{{route('teacher.list')}}" class="nav-link @yield('teacher_layout_select')">Manage Teachers</a></li>--}}
                                <li class="nav-item"><a href="{{route('template.course.list')}}" class="nav-link @yield('templatecourse_layout_select')">Manage Template Courses</a></li>
                                <li class="nav-item"><a href="{{route('student.list')}}" class="nav-link @yield('student_layout_select')">Manage Students</a></li>
								<li class="nav-item"><a href="{{route('course.list')}}" class="nav-link @yield('course_layout_select')">Manage Courses</a></li>
{{--								<li class="nav-item"><a href="{{route('section.list')}}" class="nav-link @yield('section_layout_select')">Manage Section</a></li>--}}
{{--                                <li class="nav-item"><a href="{{route('department.list')}}" class="nav-link @yield('department_layout_select')">Manage Departments</a></li>--}}
							</ul>
						</li>








					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

