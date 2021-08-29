<template>
    <aside class="col-3">
        <h4>Abilities:</h4>
        <game-ability-component v-for="ability in getAbilities" :key="ability.id" :ability="ability" />
        <hr />

        <h4>Switch:</h4>
        <game-switch-component :fighter="getPlayerFirstFighter" />
        <game-switch-component :fighter="getPlayerSecondFighter" />
        <game-switch-component :fighter="getPlayerThirdFighter" />
    </aside>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Getter } from 'vuex-class';
import { getModule } from 'vuex-module-decorators';

import AbilityInterface from '../../../interfaces/ability.interface';
import FighterInterface from '../../../interfaces/fighter.interface';
import GameModule from '../../../modules/game.module';
import GameAbilityComponent from './GameAbilityComponent.vue';
import GameSwitchComponent from './GameSwitchComponent.vue';

@Component({
    components: {
        GameAbilityComponent,
        GameSwitchComponent,
    }
})
export default class GameAbilitiesComponent extends Vue {
    @Getter protected getActiveFighter!: () => FighterInterface;
    @Getter protected getPlayerFirstFighter!: () => FighterInterface | null;
    @Getter protected getPlayerSecondFighter!: () => FighterInterface | null;
    @Getter protected getPlayerThirdFighter!: () => FighterInterface | null;
    @Getter protected getAbilities!: () => AbilityInterface[];

    private store!: GameModule;

    constructor() {
        super();
        this.store = getModule(GameModule, this.$store);
    }
}
</script>
