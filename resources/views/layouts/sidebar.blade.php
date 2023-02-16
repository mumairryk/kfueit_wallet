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
                            <i class="icon-menu" title="Main"></i></li>
                        @if(Auth::user()->hasRole('Super Admin'))
                            <li class="nav-item nav-item-submenu @yield('users_layout_select')">
                                <a href="#" class="nav-link "><i class="fas fa-users"></i> <span>Users Management</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    @can('permission.list')
                                        <li class="nav-item"><a href="{{route('permission.list')}}"
                                                                class="nav-link @yield('permission_layout_select')"> <i
                                                    class="fas fa-lock"></i> Permissions</a></li>
                                    @endcan
                                    @can('role.list')
                                        <li class="nav-item"><a href="{{route('role.list')}}"
                                                                class="nav-link @yield('role_layout_select')"> <i
                                                    class="fas fa-suitcase-rolling"></i> Roles</a></li>
                                    @endcan
                                    @can('users.list')
                                        <li class="nav-item"><a href="{{route('users.list')}}"
                                                                class="nav-link @yield('user_layout_select')"> <i
                                                    class="fas fa-user"></i> Users</a></li>
                                    @endcan
                                    @can('route_web.list')
                                        <li class="nav-item"><a href="{{route('route_web.list')}}"
                                                                class="nav-link @yield('route_web_layout_select')"> <i
                                                    class="fas fa-route"></i> Web Routes</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item nav-item-submenu @yield('academics_layout_select')">
                            <a href="#" class="nav-link "><i class="icon-copy"></i> <span>Academic</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                @if(Auth::user()->hasRole(['Super Admin','Registrar']))
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link "><i class="icon-copy"></i> <span>Master Data</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                        @can('building.list')
                                            <li class="nav-item"><a href="{{route('building.list')}}" class="nav-link @yield('building_layout_select')"><i class="icon-circle"></i> Buildings</a></li>
                                        @endcan
                                        @can('external_institutions.list')
                                                <li class="nav-item"><a href="{{route('external_institutions.list')}}" class="nav-link @yield('external_institution_layout_select')"><i class="icon-circle"></i> External Institutions</a></li>
                                        @endcan
                                            @can('program.list')
                                            <li class="nav-item"><a href="{{route('program.list')}}"
                                                                    class="nav-link @yield('program_layout_select')"><i
                                                        class="icon-circle"></i> Programs</a></li>
                                        @endcan
                                        @can('academic_status.list')
                                            <li class="nav-item"><a href="{{route('academic_status.list')}}"
                                                                    class="nav-link @yield('academic_status_layout_select')"><i
                                                        class="icon-circle"></i> Academic Status</a></li>
                                        @endcan

                                        @can('semester.type')
                                            <li class="nav-item"><a href="{{route('semester.type')}}"
                                                                    class="nav-link @yield('semester_layout_select')"><i
                                                        class="icon-circle"></i> Semester Type</a></li>
                                        @endcan
                                        @can('section.list')
                                            <li class="nav-item"><a href="{{route('section.list')}}"
                                                                    class="nav-link @yield('section_layout_select')"><i
                                                        class="icon-circle"></i> Section</a></li>
                                        @endcan

                                        @can('department.list')
                                            <li class="nav-item"><a href="{{route('department.list')}}"
                                                                    class="nav-link @yield('department_layout_select')"><i
                                                        class="icon-circle"></i> Departments</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole(['Super Admin','Finance']))
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link "><i class="icon-coin-dollar"></i>
                                            <span>Finance</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                            @can('fee_plan.list')
                                                <li class="nav-item"><a href="{{route('fee_plan.list')}}"
                                                                        class="nav-link @yield('fee_layout_select')"><i
                                                            class="icon-circle"></i> Fee Plan</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endif
                                    @can('plan_of_study.list')
                                        <li class="nav-item"><a href="{{route('plan_of_study.list')}}"
                                                                class="nav-link @yield('pos_layout_select')"> Plan of
                                                Studies</a></li>
                                    @endcan
                                    @can('academic.session')
                                        <li class="nav-item"><a href="{{route('academic.session')}}"
                                                                class="nav-link @yield('academic_layout_select')">
                                                Academic
                                                Session</a></li>
                                    @endcan

                                    @can('teacher.list')
                                        <li class="nav-item"><a href="{{route('teacher.list')}}"
                                                                class="nav-link @yield('teacher_layout_select')">
                                                Teachers</a></li>
                                    @endcan
                                    @can('template.course.list')
                                        <li class="nav-item"><a href="{{route('template.course.list')}}"
                                                                class="nav-link @yield('templatecourse_layout_select')">
                                                Template Courses</a></li>
                                    @endcan
                                @can('student.list')
                                    <li class="nav-item"><a href="{{route('student.list')}}"
                                                            class="nav-link @yield('student_layout_select')">
                                            Students</a></li>
                                @endcan
                                @can('student_advising.list')
                                    <li class="nav-item"><a href="{{route('student_advising.list')}}"
                                                            class="nav-link @yield('student_advising_layout_select')">
                                            Students Advising</a></li>
                                @endcan
                                @if(Auth::user()->hasRole(['Super Admin','Director Academics']))
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link "><i class="icon-file-eye"></i> <span>Academics Reports</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                            @can('reports.academics.students_course_attendance')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.academics.students_course_attendance')}}"
                                                        class="nav-link @yield('report_students_course_attendance_select')"><i
                                                            class="icon-circle"></i> Students Course Attendance</a></li>
                                            @endcan
                                            @can('reports.academics.course_attendance_summery')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.academics.course_attendance_summery')}}"
                                                        class="nav-link @yield('report_academics_course_attendance_summery')"><i
                                                            class="icon-circle"></i> Course Attendance Summery</a></li>
                                            @endcan
                                            @can('reports.academics.course_activity_report')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.academics.course_activity_report')}}"
                                                        class="nav-link @yield('report_academics_course_activity')"><i
                                                            class="icon-circle"></i> Courses Activity</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endif
                                @if(Auth::user()->hasRole(['Super Admin','Examination Coordinator']))
                                    <li class="nav-item nav-item-submenu @yield('exams_reports_layout_select')">
                                        <a href="#" class="nav-link "><i class="icon-file-eye"></i> <span>Examinations Reports</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                            @can('reports.exams.students_list')
                                                <li class="nav-item"><a href="{{route('reports.exams.students_list')}}"
                                                                        class="nav-link @yield('report_exams_students_list')"><i
                                                            class="icon-circle"></i> Students List</a></li>
                                            @endcan
                                            @can('reports.exams.student_status_semester_wise')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.exams.student_status_semester_wise')}}"
                                                        class="nav-link @yield('report_exams_students_status_semester_wise')"><i
                                                            class="icon-circle"></i> Semester Wise Report</a></li>
                                            @endcan
                                            @can('reports.exams.student_results')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.exams.student_results')}}"
                                                        class="nav-link @yield('report_exams_students_result_status')"><i
                                                            class="icon-circle"></i> Result Status</a></li>
                                            @endcan
                                            @can('reports.exams.semester_wise_summary_report')
                                                <li class="nav-item"><a
                                                        href="{{route('reports.exams.semester_wise_summary_report')}}"
                                                        class="nav-link @yield('report_exams_semester_wise_summary_report')"><i
                                                            class="icon-circle"></i> Semester Wise Summary</a></li>
                                                @endcan
                                                @can('reports.exams.enrollments_academic_session_wise')
                                                    <li class="nav-item"><a
                                                            href="{{route('reports.exams.enrollments_academic_session_wise')}}"
                                                            class="nav-link @yield('report_exams_enrollments_academic_session_wise')"><i
                                                                class="icon-circle"></i> Enrollments Depart Wise</a>
                                                    </li>
                                                @endcan
                                                @can('reports.exams.generateTranscript')
                                                    <li class="nav-item"><a
                                                            href="{{route('reports.exams.generateTranscript')}}"
                                                            class="nav-link @yield('report_exams_generate_transcript')"><i
                                                                class="icon-circle"></i> Generate Transcript</a>
                                                    </li>
                                                @endcan
                                                <li class="nav-item nav-item-submenu @yield('exams_certificates_layout_select')">
                                                    <a href="#" class="nav-link "><i class="icon-file-pdf"></i> <span>Certificates</span></a>
                                                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                                        @can('academics.exams.certificates.provisional_certificate')
                                                            <li class="nav-item"><a
                                                                    href="{{route('academics.exams.certificates.provisional_certificate')}}"
                                                                    class="nav-link @yield('academics_exams_certificates_provisional_certificate')"><i
                                                                        class="icon-circle"></i> Provisional</a></li>
                                                        @endcan
                                                    @can('academics.exams.certificates.cgpa_equivalence_certificate')
                                                    <li class="nav-item"><a
                                                            href="{{route('academics.exams.certificates.cgpa_equivalence_certificate')}}"
                                                            class="nav-link @yield('academics_exams_cgpa_equivalence_certificate')"><i
                                                                class="icon-circle"></i> CGPA Equivalence</a></li>
                                                @endcan
                                                @can('academics.exams.certificates.distinction_certificate')
                                                    <li class="nav-item"><a
                                                            href="{{route('academics.exams.certificates.distinction_certificate')}}"
                                                            class="nav-link @yield('academics_exams_distinction_certificate')"><i
                                                                class="icon-circle"></i> Distinction</a></li>
                                                @endcan
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                @endif
                                    @can('academic.students.attendance.dashboard')
                                        <li class="nav-item"><a
                                                href="{{route('academic.students.attendance.dashboard')}}"
                                                class="nav-link @yield('attendance_layout_select')">
                                                Students Attendance</a></li>
                                    @endcan
                            </ul>
                        </li>
                        @if(Auth::user()->hasRole(['Super Admin','Timetable Attendance Admin','Timetable Attendance Assistant QEC']))
                        <li class="nav-item nav-item-submenu @yield('timetable_layout_select')">
                            <a href="#" class="nav-link "><i class="fa fa-clock"></i> <span>Timetable</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                @can('timetable.lecture_attendance')
                                    <li class="nav-item"><a href="{{route('timetable.lecture_attendance')}}"
                                                            class="nav-link @yield('timetable_lecture_attendance_layout_select')">
                                            <i class="fas fa-clock"></i> Lectures Attendance</a></li>
                                @endcan
                                @can('timetable.qec_lecture_attendance')
                                    <li class="nav-item"><a href="{{route('timetable.qec_lecture_attendance')}}"
                                                            class="nav-link @yield('timetable_qec_lecture_attendance_layout_select')">
                                            <i class="fas fa-clock"></i> QEC Lectures Attendance</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole(['Super Admin','Manage Surveys']))
                            <li class="nav-item nav-item-submenu @yield('survey_layout_select')">
                                <a href="#" class="nav-link "><i class="fa fa-poll"></i> <span>Surveys</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    @can('surveys.survey.list')
                                        <li class="nav-item"><a href="{{route('surveys.survey.list')}}"
                                                                class="nav-link @yield('survey_list_layout_select')">
                                                <i class="fas fa-circle-notch"></i> Surveys List</a></li>
                                    @endcan
                                    @can('surveys.notification.list')
                                        <li class="nav-item"><a href="{{route('surveys.notification.list')}}"
                                                                class="nav-link @yield('survey_notification_list_layout_select')">
                                                <i class="fas fa-circle-notch"></i> Notifications</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole(['Super Admin','Notifications','Notification_Noticeboard']))
                            <li class="nav-item nav-item-submenu @yield('notification_layout_select')">
                                <a href="#" class="nav-link "><i class="icon-notification2"></i>
                                    <span>Notifications</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    @can('notifications.noticeBoard.list')
                                        <li class="nav-item">
                                            <a href="{{route('notifications.noticeBoard.list')}}"
                                               class="nav-link @yield('notification_notice_board_list_layout_select')">
                                                <i class="icon-circle"></i> Notice Board</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /main navigation -->
            </div>
<!-- /sidebar content -->
