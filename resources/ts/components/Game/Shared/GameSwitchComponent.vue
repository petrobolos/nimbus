<template>
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
            <div class="fw-bold">{{  fighter.name }}</div>
            HP Remaining<br />
            SP Remaining
        </div>
        <span class="badge bg-primary rounded-pill">{{  fighter.current_hp }}</span>
        <span class="badge bg-danger rounded-pill">{{  fighter.current_sp }}</span>
        <button type="button" @click="switchTo(fighter)">Switch</button>
    </li>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

import { EventBus } from '../../../bus';
import FighterInterface from '../../../interfaces/fighter.interface';

@Component
export default class GameSwitchComponent extends Vue {
    @Prop({ required: true, type: Object }) private fighter!: FighterInterface;

    public switchTo(fighter: FighterInterface): void {
        EventBus.$emit('switch-event', fighter);
    }
}
</script>
