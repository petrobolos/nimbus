<template>
    <div class="col d-flex align-items-start">
        <div class="btn-group-vertical me-3 gap-1">
            <button class="btn btn-sm btn-primary me-3">Use</button>
            <button class="btn btn-sm btn-secondary me-3">Info</button>
        </div>
        <div>
            <div class="d-flex align-content-between">
                <h4 class="fw-bold mb-0">
                    <abbr :title="''">Title</abbr>
                </h4>
            </div>
            <span class="badge bg-danger rounded-pill">Cost</span>
            <p>Short text</p>
        </div>
    </div>
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
