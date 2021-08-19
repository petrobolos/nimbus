<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <span><strong>{{ store.getGameType }} | No: {{ store.getGameId }} </strong></span>
                </div>
                <img :src="store.getImageUrl" :alt="store.getActiveOpponent.name" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ store.getActiveOpponent.name }}</h5>
                    <p class="card-text">{{ store.getActiveOpponent.description }}</p>
                </div>
            </div>
            <game-stats-component :player="store.getActiveFighter" :opponent="store.getActiveOpponent" />
            <button @click="test">Test</button>
            <game-abilities-component :player="store.getActiveFighter" />
        </div>

        <aside class="col-md-4">
            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-warning btn-block" type="button">Report Issue</button>
                <button class="btn btn-danger btn-block" type="button">Disconnect</button>
            </div>
            <game-chat-component></game-chat-component>
        </aside>
    </div>
</template>

<script lang="ts">
import { Action } from 'vuex-class';
import { Component, Prop, Vue } from 'vue-property-decorator';
import { getModule } from 'vuex-module-decorators';

import FighterInterface from '../../interfaces/fighter.interface';
import GameAbilitiesComponent from './Shared/GameAbilitiesComponent.vue';
import GameChatComponent from './Shared/GameChatComponent.vue';
import GameInterface from '../../interfaces/game.interface';
import GameModule from '../../modules/game.module';
import GameStatsComponent from './Shared/GameStatsComponent.vue';

@Component({
    components: {
        'game-abilities-component': GameAbilitiesComponent,
        'game-chat-component': GameChatComponent,
        'game-stats-component': GameStatsComponent,
    }
})
export default class GameComponent extends Vue {
    @Prop({ required: true }) readonly initialGame!: GameInterface;
    @Prop({ required: false }) readonly demoInformation!: unknown;

    public store!: GameModule;

    @Action
    public initialize!: (game: GameInterface) => void;

    @Action
    public switchOpponentFighter!: (fighter: FighterInterface) => void;

    public created(): void {
        this.startGame();
    }

    public test(): void {
        const opponent = this.store.getDummyOpponent;
        this.switchOpponentFighter(opponent);
    }

    public mounted(): void {

        //this.currentImage = this.buildImageUrl(this.opponent.code);

        // window.setInterval(this.heartbeat, 30000);
    }

    public startGame(): void {
        // Configures initial centralised state.
        this.store = getModule(GameModule, this.$store);
        this.initialize(this.initialGame);
    }

    // public testSend(): void {
    //     Axios.put('/demo/sync', {
    //         state: this.state,
    //         stateHash: this.stateHash,
    //         gameId: this.game.id,
    //     }).then((response: any) => {
    //         console.log(response);
    //     }).catch((e: any) => {
    //         console.error(e);
    //     });
    // }
    //
    // public heartbeat(): void {
    //     Axios.post('/demo/heartbeat', {
    //         gameId: this.game.id,
    //         heartbeat: 'heartbeat_demo',
    //     }).then((response: any) => {
    //         console.log(response);
    //     }).catch((e: any) => {
    //        console.error(e);
    //     });
    // }
}
</script>
