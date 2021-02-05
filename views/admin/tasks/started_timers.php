<?php

$total_timers = count($startedTimers);
if($total_timers == 0){
    echo '<li class="text-center inline-block full-width">'._l('no_timers_found').'</li>';
}
$i = 0;
foreach($startedTimers as $timer){
    $data = '';
        $data .= '<li class="timer"><a href="'.admin_url('tasks/view/'.$timer['task_id']).'" class="_timer font-medium" onclick="init_task_modal('.$timer['task_id'].');return false;">'.get_task_subject_by_id($timer['task_id']).'</a>';
        $data .= '<span class="text-muted">' . _l('timer_top_started', _dt($timer['start_time'],true)) . '</span><br /><span class="text-success">'._l('task_total_logged_time') .' '. seconds_to_time_format($this->tasks_model->calc_task_total_time($timer['task_id'],' AND staff_id='.get_staff_user_id())).'</span>';
        $data .= '<p class="mtop10"><a href="#" class="label label-danger" data-toggle="popover" data-html="true" data-trigger="manual" data-title="'._l("note").'" data-container="body" data-template="<div class=\'popover popover-top-timer-note\' role=\'tooltip\'><div class=\'arrow\'></div><h3 class=\'popover-title\'></h3><div class=\'popover-content\'></div></div>" data-content="'.htmlspecialchars(render_textarea("timesheet_note")).'<button type=\'button\'  onclick=\'timer_action(this,'.$timer['task_id'].','.$timer['id'].');\' class=\'btn btn-info btn-xs\'>'._l('save').'</button>" onclick="return false;"><i class="fa fa-clock-o"></i> '._l('task_stop_timer').'</a></p>';
        $data .= '</li>';
        if ($i >= 0 && $i != $total_timers - 1) {
            $data .= '<hr />';
        }
    echo $data;
    $i++;
}

if(is_admin()){
   echo '<li>';
   echo '<a href="'.admin_url('staff/timesheets?view=all').'" class="started-timers-button mtop15 text-center text-uppercase"><span class="text-muted">'._l('view_members_timesheets').'</span></a>';
   echo '</li>';
}
