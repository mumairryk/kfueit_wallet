<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Academics\Entities\Course;
use Modules\Academics\Entities\Department;
use Modules\Academics\Entities\Faculty;
use Modules\Academics\Entities\GradeBook;
use Modules\Academics\Entities\GradebookRecord;
use Modules\Academics\Entities\Teacher;
use Modules\Academics\Entities\TemplateCourse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use DB;

class CourseService
{
    protected $session;
    protected $instance;
    protected $course_id;
    public function __construct($course_id = null)
    {
        $this->course_id = $course_id;
    }
    public function process_academic_session_request_data($request)
    {
        if ($request->get('data_filter') !== NULL) {
            set_academic_session_id($request->get('data_filter'));
            $data['academicsession_id'] = academic_session_id_active();
            $data['limit_rows'] = 0;
        } else {
            $data['academicsession_id'] = $request->get('academicsession');
            $data['limit_rows'] = 0;
        }
        $data['faculty'] = Faculty::all();
        $data['departments'] = Department::all();
        $data['teachers'] = Teacher::all();
        return $data;
    }

    public function CourseData(Request $request)
    {
        return $courses = $this->getCourseData($request);
    }

    public function getCourseData(Request $request)
    {
        //   DB::enableQueryLog();
        $academicsession_id = $request->academicsession_id;
        $limit_rows = $request->limit_rows;

        $query = DB::table('courses');
        if ($request->get('course_code') !== NULL) {
            $course_code = $request->course_code;
            $query = $query->where('templatecourses.templatecourse_code', $course_code);
        }
        if ($request->get('course_id') !== NULL) {
            $course_id = $request->course_id;
            $query = $query->where('courses.course_id', $course_id);
        }
        /*
            if($request->get('section_id')!==NULL) {
                $section_id = $request->section_id;
                $query = $query->where('sections.section_id', $section_id);
            }
    */
        if ($request->get('faculty') !== NULL) {
            $faculty_id = $request->faculty;
            $query = $query->where('faculty.faculty_id', $faculty_id);
        }

        if ($request->get('department') !== NULL) {
            $department_id = $request->department;
            $query = $query->where('departments.department_id', $department_id);
        }
        /*
        if($request->get('teacher')!==NULL) {
            $teacher_id = $request->teacher;
            $query = $query->where('teachers.teacher_id', $teacher_id);
        } */

        if ($limit_rows > 0) {
            $query = $query->limit($limit_rows);
        }

        if (Auth::user()->hasRole('hod')) {
            $query = $query->whereIn('templatecourses.deptID', Auth::user()->department_id);
        } else if (Auth::user()->hasRole('Instructor')) {
            $query = $query->leftJoin('course_additional_teacher_allocation', 'course_additional_teacher_allocation.courseid', '=', 'courses.course_id');
            $query = $query->leftJoin('teachers', 'teachers.teacher_id', '=', 'course_additional_teacher_allocation.teacherid');
            $query = $query->where('teachers.userid', Auth::user()->username);
        }
        $query = $query->leftJoin('enrollments', 'courses.course_id', '=', 'enrollments.courseid');
        $query = $query->leftJoin('templatecourses', 'templatecourses.templatecourse_id', '=', 'courses.templateCourseID');
        //$query = $query->leftJoin('course_additional_teacher_allocation', 'course_additional_teacher_allocation.courseid', '=', 'courses.course_id');
        //$query = $query->leftJoin('teachers', 'teachers.teacher_id', '=', 'course_additional_teacher_allocation.teacherid');
        //$query = $query->leftJoin('titles', 'titles.title_id', '=', 'teachers.teacher_title');
        //$query = $query->leftJoin('departments', 'departments.department_id', '=', 'teachers.deptID');
        //$query = $query->leftJoin('faculty', 'faculty.faculty_id', '=', 'departments.fact_id');
        $query = $query->leftJoin('gradebooks', function($join) {
            $join->on('gradebooks.courseID', '=', 'courses.course_id');
            $join->on('gradebooks.submitted_status', '=', DB::raw(1));
        });
        $query = $query->where('courses.academicSessionID', $academicsession_id);
        $query = $query->groupBy(['courses.course_id']);
        if (Auth::user()->username=='umair')
        {
            $query = $query->limit(20);
        }
        $query = $query->select(DB::raw("templatecourses.templatecourse_isLab, COUNT(enrollments.courseid) as enrolled_students,
         fn_course_section_allocation_by_name(courses.course_id)as associated_sections,
         fn_get_course_teacher_names(courses.course_id)as teacher_name"), 'courses.course_id',
            'courses.course_title', 'templatecourses.templatecourse_code', 'templatecourses.templatecourse_creditHours',
            'templatecourses.templatecourse_id', 'gradebooks.receipt_acknowledged_status', 'gradebooks.approved_status', 'gradebooks.verified_status', 'gradebooks.submitted_status', 'courses.uuid');
        $courses = $query->get();
        return (new DatatableService())->make_dataTable_courses($courses);
    }

    public function filter_data()
    {
        $academic_session_id = academic_session_id_active();
        $filter_data = DB::table('courses')
            ->join('templatecourses', 'templatecourses.templatecourse_id', '=', 'courses.templateCourseID')
            ->join('course_section_allocation', 'course_section_allocation.courseid', '=', 'courses.course_id')
            ->join('sections', 'sections.section_id', '=', 'course_section_allocation.sectionid')
            ->where(['courses.academicSessionID' => $academic_session_id])
            ->select('courses.course_id', 'courses.course_title', 'sections.section_id', 'sections.section_title', 'templatecourses.templatecourse_code')
            ->get();
        return $filter_data;
    }

    public function getRegisterStudent(Request $request)
    {
        $academicsession_id = $request->academicsession_id;
        $records = DB::table('students_course_registrations')->where('academic_session_id', $academicsession_id)->get();
        return Datatables::of($records)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                return '<form name="actform"><input type="checkbox" id="student_id' . $row->student_id . '"  name="student_id" class="manual_entry_cb" value="' . $row->student_id . '" />' . $row->student_id . '</form>';
            })
            ->addColumn('is_repeat', function ($row) {
                return $row->is_repeat == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';
            })
            ->addColumn('batch_advisor_action', function ($row) {
                return $row->batch_advisor_action == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';
            })
            ->addColumn('hod_action', function ($row) {
                return $row->hod_action == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';
            })
            ->addColumn('action', function ($row) {
                $edit = "route('student.edit','$row->id')";
                $delete = "route('student.delete','$row->id')";

                $actionBtn = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right">';
                $actionBtn .= '<a href="#" class="dropdown-item"><i class="icon-file-pdf"></i>Edit</a>';
                $actionBtn .= '<a href="#" class="dropdown-item" id="delete"><i class="icon-file-excel"></i>delete</a>';
                $actionBtn .= '</div></div></div>';

                return $actionBtn;
            })
            ->rawColumns(['action', 'checkbox', 'is_repeat', 'batch_advisor_action', 'hod_action'])
            ->make(true);
    }

    public function getEnrolledStudent($courseUUID)
    {
        return $students = DB::table('enrollments')
            ->leftjoin('students', 'students.student_id', '=', 'enrollments.studentid')
            ->join('courses', 'courses.course_id', '=', 'enrollments.courseid')
            ->select(DB::raw("CONCAT_WS(' ',student_firstname,student_middlename,student_lastname)as full_name,enrollment_id,courseid,studentid,academic_status.academic_status_label, regNumber, personal_email, student_id, student_firstname,gender"))
            ->join('academic_status', 'academic_status.academic_status_id', '=', 'enrollments.enrollment_status')
            ->where(['courses.uuid' => $courseUUID])
            ->get();
    }

    public function template_courses()
    {
        $templatecourses = TemplateCourse::with('department')->get();
        return (new DatatableService())->template_courses($templatecourses);
    }

    public function read_course($request)
    {
        $course_data = Course::where(['uuid' => $request->data_filter])->first();
        if (is_null($course_data)) {
            return null;
        }
        $course_id = $course_data->course_id;
        $data['id'] = $course_id;
        /*
        $data['courseDetailc']= Course::leftjoin('templatecourses','templatecourses.templatecourse_id','=','courses.templateCourseID')
                                ->leftjoin('course_section_allocation','course_section_allocation.courseid','=','courses.course_id')
                                ->leftjoin('sections','sections.section_id', '=','course_section_allocation.sectionid')
                                ->select(DB::raw("if(templatecourses.templatecourse_isLab=1, 'Yes', 'No')as is_lab"), 'courses.*', 'templatecourses.templatecourse_code', 'templatecourses.templatecourse_catalogDescription','templatecourses.templatecourse_creditHours', 'sections.section_title')
                                ->where(['courses.course_id'=>$course_id])
                                ->get();
        */
        $data['courseDetail'] = course_detail($course_id);
        return $data;
    }

    public function gradebook_students($request)
    {
        $data['students'] = GradeBook::with('student')->where('course_id', 1)->get();
    }

    public function update_course_title($request)
    {
        $row_id = $request->id;
        $row_title = $request->title;
        $model = Course::find($row_id);
        $model->course_title = $row_title;
        $model->updated_at = Carbon::now();
        if ($model->save()) {
            $is_updated = 1;
            $msg = "Course title update successfully";
        } else {
            $is_updated = 0;
            $msg = "Fail to update record";
        }
        $response = ['is_update', $is_updated, 'msg' => $msg];
        return $response;
    }
    public function update_template_course_description($request)
    {
        $row_id = $request->id;
        $row_description = $request->description;
        $model = TemplateCourse::find($row_id);
        $model->templatecourse_catalogDescription = $row_description;
        $model->updated_at = Carbon::now();
        if ($model->save()) {
            $is_updated = 1;
            $msg = "Course description update successfully";
        } else {
            $is_updated = 0;
            $msg = "Fail to update record";
        }
        $response = ['is_update', $is_updated, 'msg' => $msg];
        return $response;
    }

    public function course_teacher_data($course_id = null)
    {
        return $teachers = Course::with('teachers', 'templatecourse')->having('course_id', $course_id)->first();
    }

    public function updateSemesterMarks($request)
    {
        $marks_column = '';
        $row_id = $request->id;
        $row_val = $request->input_val;
        $semester_term = $request->semester_term;
        $gradebook_record = GradebookRecord::findOrFail($row_id);
        if ($semester_term == 1)
            $marks_column = 'midtermMarks';
        elseif ($semester_term == 2)
            $marks_column = 'sessionalMarks';
        elseif ($semester_term == 3)
            $marks_column = 'endSemesterExam';
        $gradebook_record->$marks_column = $row_val;
        if ($gradebook_record->save()) {
            $check = 1;
            $msg = "Updated Successfully";
        } else {
            $msg = "Fail to update marks";
            $check = 0;
        }
        $result = [
            'check' => $check,
            'msg' => $msg
        ];
        return $result;
    }

    public function get_department_teacher($request)
    {
        $value = $request->get('value');
        $group_by = $request->get('group_by');
        $dependent = $request->get('dependent');
        $populate_select = $request->get('populate_select');
        $output = '';
        $result = DB::table('faculty_department_teacher')
            ->select('faculty_id', 'faculty_title', 'department_id', 'department_title', 'fact_id', 'teacher_id', 'teacher_name', 'userid')
            ->where($dependent, $value)
            ->groupBy($group_by)
            ->get();
        $select_title = ucfirst(explode('_', $populate_select)[0]);
        if (isset($result[0])) {
            $output = '<option value=""> Select ' . $select_title . '</option>';
            foreach ($result as $list) {
                $output .= '<option value="' . $list->$group_by . '">' . $list->$populate_select . '</option>';
            }
        }
        return $output;
    }

    public function gradebook_status($courses_data)
    {
        foreach($courses_data as $course)
        {
            if($course->gradebook_status==0)
            {
                echo "zero";
            }
        }
    }


}
