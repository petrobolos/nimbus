<template>
    <div>
        <!-- HP -->
        <div class="progress">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                :style="getActiveOpponent.current_hp !== 0 ? (getActiveOpponent.total_hp / getActiveOpponent.current_hp) * 100 : 0"
                role="progressbar"
                :aria-valuenow="getActiveOpponent.current_hp"
                :aria-valuemax="getActiveOpponent.total_hp"
                aria-valuemin="0">
                HP: {{ getActiveOpponent.current_hp !== 0 ? (getActiveOpponent.total_hp / getActiveOpponent.current_hp) * 100 : 0 }}
            </div>
        </div>

        <!-- SP -->
        <div class="progress">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                :style="getActiveOpponent.current_sp !== 0 ? (getActiveOpponent.total_sp / getActiveOpponent.current_sp) * 100 : 0"
                role="progressbar"
                :aria-valuenow="getActiveOpponent.current_sp"
                :aria-valuemax="getActiveOpponent.total_sp"
                aria-valuemin="0">
                SP: {{ getActiveOpponent.current_sp !== 0 ? (getActiveOpponent.total_sp / getActiveOpponent.current_sp) * 100 : 0 }}
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Getter } from 'vuex-class';
import { getModule } from 'vuex-module-decorators';

import FighterInterface from '../../../interfaces/fighter.interface';
import GameModule from '../../../modules/game.module';

@Component
export default class GameStatBarComponent extends Vue {
    @Getter private getActiveOpponent!: () => FighterInterface;

    private store!: GameModule;

    constructor() {
        super();
        this.store = getModule(GameModule, this.$store);
    }
}
</script>
