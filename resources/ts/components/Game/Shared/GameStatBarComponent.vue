<template>
    <div>
        <!-- HP -->
        <div class="progress">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                role="progressbar"
                :style="generateProgressBarStyle(getActiveOpponent.current_hp, getActiveOpponent.total_hp)"
                :aria-valuenow="getActiveOpponent.current_hp"
                :aria-valuemax="getActiveOpponent.total_hp"
                aria-valuemin="0">
                HP: {{ generateProgressBarPercentage(getActiveOpponent.current_hp, getActiveOpponent.total_hp) }}
            </div>
        </div>

        <!-- SP -->
        <div class="progress">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                role="progressbar"
                :style="generateProgressBarStyle(getActiveOpponent.current_sp, getActiveOpponent.total_sp)"
                :aria-valuenow="getActiveOpponent.current_sp"
                :aria-valuemax="getActiveOpponent.total_sp"
                aria-valuemin="0">
                SP: {{ generateProgressBarPercentage(getActiveOpponent.current_sp, getActiveOpponent.total_sp) }}
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

    /**
     * Generate progress bar percentage.
     *
     * @param {number} current
     * @param {number} total
     * @returns {string}
     */
    public generateProgressBarPercentage(current: number, total: number): string {
        if (current === 0) {
            return '0%';
        }

        return Math.round((total / current) * 100) + '%';
    }

    /**
     * Generate progress bar with CSS.
     *
     * @param {number} current
     * @param {number} total
     * @returns {string}
     */
    public generateProgressBarStyle(current: number, total: number): string {
        return 'width: ' + this.generateProgressBarPercentage(current, total);
    }
}
</script>
