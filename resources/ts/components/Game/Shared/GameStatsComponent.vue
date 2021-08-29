<template>
    <div class="table-responsive text-center">
        <table class="table table-sm table-bordered align-middle">
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
            <tbody class="table-striped">
            <tr>
                <th scope="row">You</th>
                <td>{{ getActiveFighter.hp }}</td>
                <td>{{ getActiveFighter.sp }}</td>
                <td>{{ getActiveFighter.attack }}</td>
                <td>{{ getActiveFighter.defense }}</td>
                <td>{{ getActiveFighter.speed }}</td>
                <td>{{ getActiveFighter.special }}</td>
                <td>{{ getActiveFighter.spirit }}</td>
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
}
</script>
