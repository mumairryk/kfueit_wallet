/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */


    //********** Academic Session to Enrollments Start *********//

$(document).on('change','.radioButtonSelect',function() {

    $.each($("input[name='singleBox']:checked"), function() {
        var data_val = $(this).attr('data-id');
        var data_attr = $(this).attr('data-attr');
        jQuery('#data_filter').val(data_val);
    });
});


function manage_courses_task(fun_name)
{
    var base_path = $("#url").val();
    var action_url = base_path+"/academics/"+fun_name;
    document.getElementById('frmMngEnrol').action=action_url;
    jQuery('#frmMngEnrol').submit();
}


$('.radioButtonSelect_update').change(function (e) {
    $.each($("input[name='singleBox']:checked"), function() {
        var data_val = $(this).attr('data-id');
        var data_attr = $(this).attr('data-attr');
        jQuery('#academic_session_title').val(data_attr);
        jQuery('#course_filter').val(data_val);
        jQuery('#academic_session_id').val(data_val);

        jQuery('#course_id').val(data_val);
    });
});

//********** Academic Session to Enrollments End *********//


$('.singleSelectBox').change(function (e) {
    var checked = [];
    $.each($("input[name='singleBox[]']:checked"), function(){
        var data_val  = $(this).attr('data-id');
        checked.push(data_val);
        jQuery('#course_filter').val(checked);

    });
    if (checked.length==0){
        jQuery('#course_filter').val('');
    }else{

    }
});


     function manage_enrollment_courses(fun_name)
     {
         var base_path = $("#url").val();
         var action_url = base_path+"/academics/"+fun_name;
         document.getElementById('frmMngEnrol').action=action_url;
         jQuery('#frmMngEnrol').submit();
     }


function course_filter(course_id, type)
{
    var courseid=jQuery('#course_filter').val();
    jQuery('#course_filter').val(course_id+':'+courseid);
}

