<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ModalController extends Controller
{

    private array $modals = [
        1 => 'getDeleteModal'
    ];

    /**
     * Returns a modal by id
     * AdditionalId is optional and can be used to pass additional data to the modal (e.g. the id of a payout)
     * @param int $modalId
     * @param int|null $additionalId
     * @return JsonResponse
     * @method POST
     * @route /modal/{modalId}/{additionalId?}
     */
    public function getModal(int $modalId, int $additionalId = null)
    {
        if (!isset($this->modals[$modalId])) {
            $modal = new stdClass();
            $modal->title = __('common.error');
            $modal->body = __('common.ressource_not_found');
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
            $modal->title = __('common.error');
            $modal->body = __('common.no_permission');
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
            $modal->title = __('common.error');
            $modal->body = __('common.something_went_wrong');
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
        $modal->title = __('common.delete');
        $modal->body = '<p class="text-muted">' . __('common.deletion_confirmation') . '</p>';

        return $modal;
    }
}
