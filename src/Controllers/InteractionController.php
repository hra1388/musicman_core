<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Repositories\InteractionRepository;
use App\Models\Interaction;

class InteractionController
{
    private InteractionRepository $interactionRepo;

    public function __construct()
    {
        $this->interactionRepo = new InteractionRepository();
    }

    public function record(Request $request): void
    {
        $userId = (int)$request->getParam('user_id');
        $entityType = (string)$request->getParam('entity_type');
        $entityId = (string)$request->getParam('entity_id');
        $type = (string)$request->getParam('type'); // like, follow, play, note
        $value = $request->getParam('value');

        if (!$userId || !$entityType || !$entityId || !$type) {
            Response::error('Missing required interaction parameters', 400);
        }

        $interaction = new Interaction();
        $interaction->user_id = $userId;
        $interaction->entity_type = $entityType;
        $interaction->entity_id = $entityId;
        $interaction->interaction_type = $type;
        $interaction->interaction_value = is_array($value) ? json_encode($value) : (string)$value;
        $interaction->created_at = time();

        $id = $this->interactionRepo->recordInteraction($interaction);
        Response::json(['success' => true, 'id' => $id, 'message' => 'Interaction recorded']);
    }

    public function remove(Request $request): void
    {
        $userId = (int)$request->getParam('user_id');
        $entityType = (string)$request->getParam('entity_type');
        $entityId = (string)$request->getParam('entity_id');
        $type = (string)$request->getParam('type');

        if (!$userId || !$entityType || !$entityId || !$type) {
            Response::error('Missing required parameters', 400);
        }

        $removed = $this->interactionRepo->removeInteraction($userId, $entityType, $entityId, $type);
        Response::json(['success' => true, 'removed' => $removed]);
    }

    public function list(Request $request): void
    {
        $userId = (int)$request->getParam('user_id');
        $type = (string)$request->getParam('type');
        $entityType = $request->getParam('entity_type');

        if (!$userId || !$type) {
            Response::error('Missing user_id or type', 400);
        }

        $items = $this->interactionRepo->getUserInteractions($userId, $type, $entityType);
        Response::json(['success' => true, 'count' => count($items), 'items' => $items]);
    }
}
