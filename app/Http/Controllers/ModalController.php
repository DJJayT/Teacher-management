<?php

namespace App\Http\Controllers;

use App\Models\AssessmentObstacle;
use App\Models\AssessmentType;
use App\Models\Gender;
use App\Models\JobTitle;
use App\Models\SalaryGrade;
use App\Models\StatusType;
use App\Models\Teacher;
use App\Responses\ModalResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ModalController extends Controller
{

    private array $modals = [
        1 => 'getDeleteModal',
        2 => 'getTeacherEditModal'
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

    private function getTeacherEditModal($teacherId): ModalResponse
    {
        $teacher = Teacher::find($teacherId);

        $route = '';

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
}