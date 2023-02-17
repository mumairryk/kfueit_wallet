<?php

namespace App\Services;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class DatatableService
{

    public function make_dataTable_courses($courses)
    {

        $row_counter = 0;
        $gradebook_status = '';
        return Datatables::of($courses)
            ->addIndexColumn()
            ->addColumn('radioButton', function ($row) {
                return '<label class="custom-control custom-control-info custom-radio ">
                    <input type="radio" id="course_id' . $row->course_id . '"  name="singleBox" value="' . $row->uuid . '" class="custom-control-input radioButtonSelect" data-id="' . $row->uuid . '"/>
                    <span class="custom-control-label">' . $row->course_id . '</span>
                </label>';
            })
            ->addColumn('templatecourse_isLab', function ($row) {
                return $row->templatecourse_isLab == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';

            })
            ->addColumn('enrolled_students_count', function ($row) {
                return '<span class="badge badge-pill bg-brown ml-auto">' . $row->enrolled_students . '</span>';
            })
//            <span class="badge badge-pill bg-warning mr-2">54</span>
            ->addColumn('custom_gradebook_status', function ($row) {
                if ($row->receipt_acknowledged_status == 1)
                    return '<span class="badge badge-success">Acknowledged</span>';
                else if ($row->approved_status == 1)
                    return '<span class="badge badge-primary">Approved</span>';
                else if ($row->verified_status == 1)
                    return '<span class="badge badge-info">Verified</span>';
                else if ($row->submitted_status == 1)
                    return '<span class="badge badge-warning">Submitted</span>';
                else
                    return '<span class="badge badge-danger">Not Submitted</span>';
            })
            ->addColumn('course_title', function ($row) {
                return "<a href='/academics/courses/readCourse?data_filter=$row->uuid' target='_blank'>$row->course_title</a>";
            })
            ->setRowClass(function ($row) {
                return $row->course_id % 2 == 0 ? 'alert-success' : 'alert-light';
            })

//            ->addColumn('action', function($row){
//
//                $actionBtn = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right">';
//                $actionBtn .= '<a href="#" class="dropdown-item" target="_blank"><i class="icon-file-pdf"></i>Students</a>';
//                $actionBtn .= '<a href="#" class="dropdown-item" target="_blank"><i class="icon-file-pdf"></i>Sessional Marks</a>';
//                $actionBtn .= '<a href="#" class="dropdown-item" id="delete"><i class="icon-file-excel"></i>delete</a>';
//                $actionBtn .= '</div></div></div>';
//
//                return $actionBtn;
//            })
            ->rawColumns(['course_title','radioButton', 'templatecourse_isLab', 'custom_gradebook_status', 'enrolled_students_count'])
            ->make(true);
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

    public function template_courses($templatecourses)
    {
        return Datatables::of($templatecourses)
            ->addIndexColumn()
            ->addColumn('radioButton', function ($row) {
                return '<label class="custom-control custom-control-info custom-radio ">
                    <input type="radio" id="templatecourse_id' . $row->templatecourse_id . '"  name="templatecourse_id" class="manual_entry_cb" value="' . $row->templatecourse_id . '" />
                    <span class="custom-control-label">' . $row->templatecourse_id . '</span>
                </label>';
            })
            ->addColumn('catalogDescription', function ($row) {
                return '<textarea rows="4" cols="50" id="templatecourse_catalogDescription_' . $row->templatecourse_id . '"  name="templatecourse_catalogDescription" class="form-control catalog_description" data="' . $row->templatecourse_id . '" data-attr="' . $row->templatecourse_catalogDescription . '" />' . $row->templatecourse_catalogDescription . '</textarea>';
            })
            ->addColumn('templatecourse_isElective', function ($row) {
                return $row->templatecourse_isElective == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';
            })
            ->addColumn('templatecourse_isLab', function ($row) {
                return $row->templatecourse_isLab == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-info">No</span>';
            })
            ->setRowClass(function ($row) {
                return $row->templatecourse_id % 2 == 0 ? 'alert-success' : 'alert-light';
            })
            ->addColumn('action', function ($row) {

                $actionBtn = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right">';
                $actionBtn .= '<a href="#" class="dropdown-item" target="_blank"><i class="icon-file-pdf"></i>Edit</a>';
                $actionBtn .= '<a href="#" class="dropdown-item" id="delete"><i class="icon-file-excel"></i>delete</a>';
                $actionBtn .= '</div></div></div>';

                return $actionBtn;
            })
            ->rawColumns(['action', 'radioButton', 'templatecourse_isLab', 'catalogDescription', 'templatecourse_isElective'])
            ->make(true);
    }

}
