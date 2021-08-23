<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <span><strong>{{ getGameType }} | No: {{ getGameId }} </strong></span>
                </div>
                <img :src="getImageUrl" :alt="getActiveOpponent.name" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ getActiveOpponent.name }}</h5>
                    <p class="card-text">{{ getActiveOpponent.description }}</p>
                </div>
            </div>
            <game-stats-component />
            <game-abilities-component />
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
import { Action, Getter } from 'vuex-class';
import { Component, Prop, Vue } from 'vue-property-decorator';
import { getModule } from 'vuex-module-decorators';

import { DemoInformation } from '../../types/demo/demo-information.type';
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
    @Prop({ required: true, type: Object }) private readonly initialGame!: GameInterface;
    @Prop({ required: false, type: Object }) private readonly demoInformation!: DemoInformation;

    @Action private initialize!: (game: GameInterface) => void;
    @Action private switchOpponentFighter!: (fighter: FighterInterface) => void;

    @Getter private getGameId!: () => number;
    @Getter private getGameType!: () => string;
    @Getter private getImageUrl!: () => string;
    @Getter private getActiveFighter!: () => FighterInterface;
    @Getter private getActiveOpponent!: () => FighterInterface;

    private gameStore: GameModule;

    constructor() {
        super();
        this.gameStore = getModule(GameModule, this.$store);
        this.initialize(this.initialGame);
    }


    //
    // public created(): void {
    //     this.gameStore = getModule(GameModule, this.$store);
    //     this.initialize(this.initialGame);
    // }

    // public test(): void {
    //     const opponent = this.gameStore.getDummyOpponent;
    //     this.switchOpponentFighter(opponent);
    // }

    public mounted(): void {
        // window.setInterval(this.heartbeat, 30000);
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
