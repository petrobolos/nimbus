<template>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-around">
        <section>
            <h5>Abilities:</h5>
            <ol class="list-group list-group-numbered">
                <game-ability-component v-for="ability in getAbilities" :key="ability.id" :ability="ability" />
            </ol>
        </section>
        <section>
            <h5>Switch:</h5>
            <ol class="list-group list-group-numbered">
                <!-- First -->
                <game-switch-component :fighter="getPlayerFirstFighter" />

                <!-- Second -->
                <game-switch-component :fighter="getPlayerSecondFighter" />

                <!-- Third -->
                <game-switch-component :fighter="getPlayerThirdFighter" />
            </ol>
        </section>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Getter } from 'vuex-class';
import { getModule } from 'vuex-module-decorators';

import GameAbilityComponent from './GameAbilityComponent.vue';
import GameSwitchComponent from './GameSwitchComponent.vue';
import GameModule from '../../../modules/game.module';
import FighterInterface from '../../../interfaces/fighter.interface';
import AbilityInterface from '../../../interfaces/ability.interface';

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
