<template>
    <div class="row">
        <!-- Left component -->
        <game-abilities-component />

        <!-- Centre component -->
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    <span><strong>{{ getGameType }} | No: {{ getGameId }} </strong></span>
                </div>
                <img :src="getImageUrl" :alt="getActiveOpponent.name" class="img-fluid card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ getActiveOpponent.name }}</h5>
                    <game-stat-bar-component />
                </div>
            </div>
            <game-stats-component />
        </div>

        <!-- Right component -->
        <aside class="col-md-3">
            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-warning btn-block" type="button">Report Issue</button>
                <button class="btn btn-danger btn-block" type="button">Disconnect</button>
            </div>
            <game-chat-component />
        </aside>
    </div>
</template>

<script lang="ts">
import Loading, { LoaderComponent } from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { Component, Prop, Vue } from 'vue-property-decorator';
import { Action, Getter } from 'vuex-class';
import { getModule } from 'vuex-module-decorators';

import { EventBus } from '../../bus';
import AbilityInterface from '../../interfaces/ability.interface';
import FighterInterface from '../../interfaces/fighter.interface';
import GameInterface from '../../interfaces/game.interface';
import GameModule from '../../modules/game.module';
import { DemoInformation } from '../../types/demo/demo-information.type';
import GameAbilitiesComponent from './Shared/GameAbilitiesComponent.vue';
import GameChatComponent from './Shared/GameChatComponent.vue';
import GameStatBarComponent from './Shared/GameStatBarComponent.vue';
import GameStatsComponent from './Shared/GameStatsComponent.vue';

Vue.use(Loading);

@Component({
    components: {
        'game-abilities-component': GameAbilitiesComponent,
        'game-chat-component': GameChatComponent,
        'game-stat-bar-component': GameStatBarComponent,
        'game-stats-component': GameStatsComponent,
    }
})
export default class GameComponent extends Vue {
    @Prop({ required: true, type: Object }) private readonly initialGame!: GameInterface;
    @Prop({ required: false, type: Object }) private readonly demoInformation!: DemoInformation;

    @Action private initialize!: (game: GameInterface) => void;
    @Action private switchOpponentFighter!: (fighter: FighterInterface) => void;
    @Action private syncDemo!: () => unknown;

    @Getter private getGameId!: () => number;
    @Getter private getGameType!: () => string;
    @Getter private getImageUrl!: () => string;
    @Getter private getActiveFighter!: () => FighterInterface;
    @Getter private getActiveOpponent!: () => FighterInterface;

    private gameStore: GameModule;
    private loader: null | LoaderComponent = null;
    private isLoading: boolean = true;

    constructor() {
        super();

        this.loading(true);
        this.gameStore = getModule(GameModule, this.$store);
        this.initialize(this.initialGame);

        this.registerEventListeners();
        this.stopLoading();
    }


    /**
     * Register any event listeners on the component.
     *
     * @returns void
     * @protected
     */
    protected registerEventListeners(): void {
        EventBus.$on('switch-event', this.act);
        EventBus.$on('ability-event', this.act);
    }

    /**
     * Start the loading sequence.
     *
     * @param {Boolean} initial
     * @returns void
     * @protected
     */
    protected loading(initial: boolean = false): void {
        this.isLoading = true;

        this.loader = this.$loading.show({
            transition: 'bounce',
            opacity: initial ? 1 : 0.6,
            loader: 'dots',
            isFullPage: true,
            enforceFocus:true,
            canCancel: false,
        });
    }

    /**
     * Stop the loading sequence.

     * @returns void
     * @protected
     */
    protected stopLoading(): void {
        this.isLoading = false;

        this.loader?.hide();
        this.loader = null;
    }

    /**
     * Fires an action to the server.
     *
     * @param {AbilityInterface | FighterInterface} model
     * @returns {Promise<void>}
     * @protected
     */
    protected async act(model: AbilityInterface | FighterInterface): Promise<void> {
        console.log(model);
    }

    /**
     * Synchronises game state.
     *
     * @returns {Promise<void>}
     * @protected
     */
    protected async sync(): Promise<void> {
        this.loading();

        await this.syncDemo();
    }
}
</script>

<style lang="css">
.bounce-enter-active {
    animation: bounce-in .5s;
}

.bounce-leave-active {
    animation: bounce-in .5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(1);
    }
}
</style>
