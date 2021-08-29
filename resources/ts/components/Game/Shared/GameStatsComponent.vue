<template>
    <div class="table-responsive text-center">
        <table class="table table-striped table-sm table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Bonus HP</th>
                <th scope="col">Bonus SP</th>
                <th scope="col">Attack</th>
                <th scope="col">Defense</th>
                <th scope="col">Speed</th>
                <th scope="col">Special</th>
                <th scope="col">Spirit</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">You</th>
                <td :class="compareStyling(getActiveFighter.hp, getActiveOpponent.hp)">{{ getActiveFighter.hp }}</td>
                <td :class="compareStyling(getActiveFighter.sp, getActiveOpponent.sp)">{{ getActiveFighter.sp }}</td>
                <td :class="compareStyling(getActiveFighter.attack, getActiveOpponent.attack)">{{ getActiveFighter.attack }}</td>
                <td :class="compareStyling(getActiveFighter.defense, getActiveOpponent.defense)">{{ getActiveFighter.defense }}</td>
                <td :class="compareStyling(getActiveFighter.speed, getActiveOpponent.speed)">{{ getActiveFighter.speed }}</td>
                <td :class="compareStyling(getActiveFighter.special, getActiveOpponent.special)">{{ getActiveFighter.special }}</td>
                <td :class="compareStyling(getActiveFighter.spirit, getActiveOpponent.spirit)">{{ getActiveFighter.spirit }}</td>
            </tr>
            <tr>
                <th scope="row">Opponent</th>
                <td>{{ getActiveOpponent.hp }}</td>
                <td>{{ getActiveOpponent.sp }}</td>
                <td>{{ getActiveOpponent.attack }}</td>
                <td>{{ getActiveOpponent.defense }}</td>
                <td>{{ getActiveOpponent.speed }}</td>
                <td>{{ getActiveOpponent.special }}</td>
                <td>{{ getActiveOpponent.spirit }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Getter } from 'vuex-class';
import { getModule } from 'vuex-module-decorators';

import FighterInterface from '../../../interfaces/fighter.interface';
import GameModule from '../../../modules/game.module';

@Component
export default class GameStatsComponent extends Vue {
    @Getter private getActiveFighter!: () => FighterInterface;
    @Getter private getActiveOpponent!: () => FighterInterface;

    private store!: GameModule;

    constructor() {
        super();
        this.store = getModule(GameModule, this.$store);
    }

    /**
     * Add specific styling depending on how you and your opponent's stats match up.
     *
     * @param {number} ownAttribute
     * @param {number} enemyAttribute
     * @returns {string}
     * @protected
     */
    protected compareStyling(ownAttribute: number, enemyAttribute: number): string {
        const sharedClasses = 'text-uppercase';

        if (ownAttribute > enemyAttribute) {
            return sharedClasses + 'table-success';
        }

        if (ownAttribute < enemyAttribute) {
            return sharedClasses + 'table-danger';
        }

        return sharedClasses;
    }
}
</script>
