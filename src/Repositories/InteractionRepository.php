<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Interaction;
use App\Models\Activity;
use PDO;

class InteractionRepository
{
    public function recordInteraction(Interaction $interaction): int
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO user_interactions (user_id, entity_type, entity_id, interaction_type, interaction_value, created_at)
            VALUES (:user_id, :entity_type, :entity_id, :interaction_type, :interaction_value, :created_at)
            ON DUPLICATE KEY UPDATE interaction_value = VALUES(interaction_value), created_at = VALUES(created_at)
        ");
        $stmt->execute([
            ':user_id' => $interaction->user_id,
            ':entity_type' => $interaction->entity_type,
            ':entity_id' => $interaction->entity_id,
            ':interaction_type' => $interaction->interaction_type,
            ':interaction_value' => $interaction->interaction_value,
            ':created_at' => $interaction->created_at ?: time(),
        ]);

        $id = (int)$db->lastInsertId();

        // Also record unified activity
        $this->recordActivity($interaction->user_id, "{$interaction->interaction_type}_{$interaction->entity_type}", $interaction->entity_type, $interaction->entity_id, $interaction->interaction_value);

        return $id;
    }

    public function removeInteraction(int $userId, string $entityType, string $entityId, string $interactionType): bool
    {
        $stmt = Database::prepare("
            DELETE FROM user_interactions
            WHERE user_id = :user_id AND entity_type = :entity_type AND entity_id = :entity_id AND interaction_type = :interaction_type
        ");
        $stmt->execute([
            ':user_id' => $userId,
            ':entity_type' => $entityType,
            ':entity_id' => $entityId,
            ':interaction_type' => $interactionType,
        ]);
        return $stmt->rowCount() > 0;
    }

    public function getUserInteractions(int $userId, string $interactionType, ?string $entityType = null, int $limit = 50, int $offset = 0): array
    {
        $sql = "SELECT * FROM user_interactions WHERE user_id = :user_id AND interaction_type = :interaction_type";
        $binds = [':user_id' => $userId, ':interaction_type' => $interactionType];

        if ($entityType !== null) {
            $sql .= " AND entity_type = :entity_type";
            $binds[':entity_type'] = $entityType;
        }

        $sql .= " ORDER BY created_at DESC LIMIT :lim OFFSET :off";

        $stmt = Database::getConnection()->prepare($sql);
        foreach ($binds as $k => $v) {
            $stmt->bindValue($k, $v);
        }
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function recordActivity(int $userId, string $action, string $entityType, string $entityId, ?string $payload = null): int
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO user_activities (user_id, action, entity_type, entity_id, payload, created_at)
            VALUES (:user_id, :action, :entity_type, :entity_id, :payload, :created_at)
        ");
        $now = time();
        $stmt->execute([
            ':user_id' => $userId,
            ':action' => $action,
            ':entity_type' => $entityType,
            ':entity_id' => $entityId,
            ':payload' => $payload,
            ':created_at' => $now,
        ]);
        return (int)$db->lastInsertId();
    }
}
