<?php

namespace Modules\Project\Utils;

use App\User;
use App\Utils\Util;
use Illuminate\Http\Response;
use Modules\Project\Entities\Project;
use Modules\Project\Notifications\NewProjectAssignedNotification;
use Modules\Project\Notifications\NewTaskAssignedNotification;
use Notification;

class ProjectUtil extends Util
{
    /**
     * generate task id
     *
     * @param  $business_id,  $project_id
     */
    public function generateTaskId($business_id, $project_id): string
    {
        $project = Project::withCount('tasks')
            ->where('business_id', $business_id)
            ->findOrfail($project_id);

        $task_id_prefix = ! empty($project->settings['task_id_prefix']) ? $project->settings['task_id_prefix'] : '#';

        return $task_id_prefix.($project->tasks_count + 1);
    }

    /**
     * check if the user is project lead.
     */
    public function isProjectLead($user_id, $project_id): bool
    {
        $project = Project::where('lead_id', $user_id)
            ->find($project_id);

        return ! empty($project);
    }

    /**
     * check if the user is project member.
     */
    public function isProjectMember($user_id, $project_id): bool
    {
        $project = Project::with(['members' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])
            ->find($project_id);

        return ! empty($project->members);
    }

    /**
     * send notification about project.
     * to users
     */
    public function notifyUsersAboutAssignedProject($members, $project): Response
    {
        if (! empty($members)) {
            $notifiable_users = User::find($members);
            Notification::send($notifiable_users, new NewProjectAssignedNotification($project));
        }
    }

    /**
     * send notification about task.
     * to users
     */
    public function notifyUsersAboutAssignedTask($members, $task): Response
    {
        if (! empty($members)) {
            $notifiable_users = User::find($members);
            Notification::send($notifiable_users, new NewTaskAssignedNotification($task));
        }
    }

    /**
     * check if member can crud.
     * task
     */
    public function canMemberCrudTask($business_id, $user_id, $project_id): bool
    {
        $project = $this->getProject($business_id, $project_id);

        $is_member = $this->isProjectMember($user_id, $project_id);

        $can_crud_task = false;
        if ($is_member && (isset($project->settings['members_crud_task']) && $project->settings['members_crud_task'])) {
            $can_crud_task = true;
        }

        return $can_crud_task;
    }

    /**
     * check if member can crud.
     * docs & notes
     */
    public function canMemberCrudNotes($business_id, $user_id, $project_id): bool
    {
        $project = $this->getProject($business_id, $project_id);

        $is_member = $this->isProjectMember($user_id, $project_id);

        $can_crud_docus_note = false;
        if ($is_member && (isset($project->settings['members_crud_note']) && $project->settings['members_crud_note'])) {
            $can_crud_docus_note = true;
        }

        return $can_crud_docus_note;
    }

    /**
     * check if member can crud.
     * rime log
     */
    public function canMemberCrudTimelog($business_id, $user_id, $project_id): bool
    {
        $project = $this->getProject($business_id, $project_id);

        $is_member = $this->isProjectMember($user_id, $project_id);

        $can_crud_timelog = false;
        if ($is_member && (isset($project->settings['members_crud_timelog']) && $project->settings['members_crud_timelog'])) {
            $can_crud_timelog = true;
        }

        return $can_crud_timelog;
    }

    /**
     * return project
     */
    public function getProject($business_id, $project_id): object
    {
        $project = Project::where('business_id', $business_id)
            ->find($project_id);

        return $project;
    }
}
