<?php

namespace Database\Factories;

use App\Enums\GameLogic\PartyMember as PartyMemberEnum;
use App\Models\GameLogic\PartyMember;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'party_member_1_id' => PartyMember::factory()->create(),
            'party_member_2_id' => PartyMember::factory()->create(),
            'party_member_3_id' => PartyMember::factory()->create(),
            'current_party_member_id' => PartyMemberEnum::default(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate that the current player should be a CPU-controlled character.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cpu(): Factory
    {
        return $this->state(fn () => [
            'user_id' => null,
        ]);
    }
}
