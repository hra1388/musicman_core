<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Interaction;

class InteractionModelTest extends TestCase
{
    public function testInteractionModelProperties(): void
    {
        $interaction = new Interaction();
        $interaction->user_id = 10;
        $interaction->entity_type = 'track';
        $interaction->entity_id = '123456';
        $interaction->interaction_type = 'like';
        $interaction->interaction_value = '1';
        $interaction->created_at = 1700000000;

        $this->assertEquals(10, $interaction->user_id);
        $this->assertEquals('track', $interaction->entity_type);
        $this->assertEquals('123456', $interaction->entity_id);
        $this->assertEquals('like', $interaction->interaction_type);
        $this->assertEquals('1', $interaction->interaction_value);
        $this->assertEquals(1700000000, $interaction->created_at);
    }
}
