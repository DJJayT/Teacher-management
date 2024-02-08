<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AssessmentObstacle;
use App\Models\AssessmentType;
use App\Models\Gender;
use App\Models\JobTitle;
use App\Models\Provider;
use App\Models\SalaryGrade;
use App\Models\StatusType;
use App\Models\Teacher;
use App\Models\TeacherTraining;
use App\Models\Training;
use App\Models\User;
use App\Responses\ModalResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ModalController extends Controller
{

    private array $modals = [
        1 => 'getDeleteModal',
        2 => 'getTeacherEditModal',
        3 => 'getTeacherCreateModal',
        4 => 'getUserCreateModal',
        5 => 'getUserEditModal',
        6 => 'getCreateTrainingModal',
        7 => 'getTrainingEditModal',
        8 => 'getTeacherTrainingEditModal',
        9 => 'getTeacherTrainingCreateModal',
    ];

    /**
     * Returns a modal by id
     * AdditionalId is optional and can be used to pass additional data to the modal (e.g. the id of a payout)
     * @param int $modalId
     * @param int|null $additionalId
     * @return JsonResponse
     * @method POST
     * @route /getModal/{modalId}/{additionalId?}
     */
    public function getModal(int $modalId, int $additionalId = null)
    {
        if (!isset($this->modals[$modalId])) {
            $modal = new ModalResponse();
            $modal->title = __('Server Error');
            $modal->body = __('Modal not found');
            $modal->successHide = true;
            return response()->json(['modal' => $modal]);
        }

        return response()->json(['modal' => $this->{$this->modals[$modalId]}($additionalId)]);
    }

    /**
     * Checks user permission and sets stdClass modal
     * @param string $permission
     * @param $modal
     * @return bool
     */
    private function can(string $permission, &$modal): bool
    {
        $hasPermission = Auth::user()->can($permission);
        if (!$hasPermission) {
            $modal->title = __('Server Error');
            $modal->body = __('You don\'t have the permission to do this');
            $modal->successHide = true;
            return false;
        }

        return $hasPermission;
    }

    /**
     * Checks if the object exists and sets stdClass modal if not
     * @param $object
     * @param $modal
     * @return bool
     */
    private function checkIfSomethingFound($object, &$modal)
    {
        if (!$object) {
            $modal->title = __('Internal Server Error');
            $modal->body = __('Something went wrong');
            $modal->successHide = true;
            return false;
        }
        return true;
    }

    /**
     * Returns the delete modal
     * Can be used for all delete modals
     * Submit button has to get his action through js
     * @return ModalResponse
     * @modalId 1
     */
    private function getDeleteModal(): ModalResponse
    {
        $modal = new ModalResponse();
        $modal->title = __('Delete');
        $modal->body = '<p class="text-muted">' . __('Are you sure you want to delete this?') . '</p>';

        return $modal;
    }

    /**
     * Returns the teacher edit modal
     * @param int $teacherId
     * @return ModalResponse
     * @modalId 2
     */
    private function getTeacherEditModal(int $teacherId): ModalResponse
    {
        $teacher = Teacher::find($teacherId);

        $route = route('teacher.edit', ['id' => $teacherId]);

        $modal = new ModalResponse();
        $modal->title = __('Edit Teacher');
        $modal->body = view('teacherOverview.teacherForm', [
            'teacher' => $teacher,
            'route' => $route,
            'genders' => Gender::all(),
            'jobTitles' => JobTitle::all(),
            'statuses' => StatusType::all(),
            'salaryGrades' => SalaryGrade::all(),
            'assessmentTypes' => AssessmentType::all(),
            'assessmentObstacles' => AssessmentObstacle::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the teacher-create-modal
     * @return ModalResponse
     * @modalId 3
     */
    private function getTeacherCreateModal(): ModalResponse
    {
        $route = route('teacher.create');

        $modal = new ModalResponse();
        $modal->title = __('Create Teacher');
        $modal->body = view('teacherOverview.teacherForm', [
            'route' => $route,
            'genders' => Gender::all(),
            'jobTitles' => JobTitle::all(),
            'statuses' => StatusType::all(),
            'salaryGrades' => SalaryGrade::all(),
            'assessmentTypes' => AssessmentType::all(),
            'assessmentObstacles' => AssessmentObstacle::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the user-create-modal
     * @return ModalResponse
     * @modalId 4
     */
    private function getUserCreateModal(): ModalResponse
    {
        $modal = new ModalResponse();
        if(!$this->can('user.create', $modal)) {
            return $modal;
        }

        $route = route('user.create');

        $modal->title = __('Create new user');
        $modal->body = view('userManagement.userForm', [
            'route' => $route,
            'roles' => Role::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the user-edit-modal
     * @param int $userId
     * @return ModalResponse
     * @modalId 5
     */
    private function getUserEditModal(int $userId): ModalResponse
    {
        $modal = new ModalResponse();
        if(!$this->can('user.edit', $modal)) {
            return $modal;
        }

        $user = User::find($userId);

        if(!$this->checkIfSomethingFound($user, $modal)) {
            return $modal;
        }

        $route = route('user.edit', ['id' => $userId]);

        $modal->title = __('Edit user');
        $modal->body = view('userManagement.userForm', [
            'user' => $user,
            'route' => $route,
            'roles' => Role::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the create training modal
     * @return ModalResponse
     * @modalId 6
     */
    private function getCreateTrainingModal(): ModalResponse
    {
        $modal = new ModalResponse();
        $route = route('training.create');

        $modal->title = __('Create training');
        $modal->body = view('allTrainings.trainingForm', [
            'route' => $route,
            'areas' => Area::all(),
            'providers' => Provider::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the edit training modal
     * @param int $trainingId
     * @return ModalResponse
     * @modalId 7
     */
    private function getTrainingEditModal(int $trainingId): ModalResponse
    {
        $training = Training::find($trainingId);

        $route = route('training.edit', ['id' => $trainingId]);

        $modal = new ModalResponse();
        $modal->title = __('Edit Training');
        $modal->body = view('allTrainings.trainingForm', [
            'training' => $training,
            'route' => $route,
            'areas' => Area::all(),
            'providers' => Provider::all(),
        ])->render();

        return $modal;
    }

    /**
     * Returns the edit teacher training modal
     * @param int $trainingId
     * @return ModalResponse
     * @modalId 8
     */
    private function getTeacherTrainingEditModal(int $trainingId): ModalResponse
    {
        $teacherTraining = TeacherTraining::find($trainingId);

        $route = route('teacher.training.edit', ['id' => $teacherTraining->teacher_id,'trainingId' => $trainingId]);

        $modal = new ModalResponse();
        $modal->title = __('Edit Training');
        $modal->body = view('teacherTrainings.teacherTrainingsForm', [
            'teacherTraining' => $teacherTraining,
            'trainings' => Training::all(),
            'route' => $route
        ])->render();

        return $modal;
    }

    private function getTeacherTrainingCreateModal(int $teacherId): ModalResponse
    {
        $route = route('teacher.training.create', ['id' => $teacherId]);

        $modal = new ModalResponse();
        $modal->title = __('Create Training');
        $modal->body = view('teacherTrainings.teacherTrainingsForm', [
            'route' => $route,
            'trainings' => Training::all(),
        ])->render();

        return $modal;
    }

}
