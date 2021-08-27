<template>
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-align-left">
            <div class="fw-bold">{{ ability.name }}</div>
            {{ ability.description }}
        </div>
        <span class="badge bg-primary rounded-pill">{{ freeOrValue(ability.cost) }}</span>
        <button type="button" @click="use(ability)">Use</button>
    </li>
</template>

<script lang="ts">
import { Component, Mixins, Prop } from 'vue-property-decorator';
import { EventBus } from '../../../bus';

import AbilityInterface from '../../../interfaces/ability.interface';
import GameMixin from '../../../mixins/game.mixin';


@Component
export default class GameAbilityComponent extends Mixins<GameMixin>(GameMixin) {
    @Prop({required: true, type: Object}) private ability!: AbilityInterface;

    constructor() {
        super();
    }

    public use(ability: AbilityInterface): void {
        EventBus.$emit('ability-event', ability);
    }
}
</script>
