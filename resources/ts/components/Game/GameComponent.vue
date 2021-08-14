<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <span>{{ gameType }}: <strong>Game {{ this.game.id }}</strong></span>
                </div>
                <img :src="currentImage" :alt="this.opponent !== null ? this.opponent.name : 'Opponent'" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ this.opponent !== null ? this.opponent.name : 'Opponent' }}</h5>
                    <p class="card-text">{{ this.opponent !== null ? this.opponent.description : 'Description' }}</p>
                </div>
            </div>
            <game-stats-component></game-stats-component>
            <button @click="testSend()">Test</button>
            <game-abilities-component></game-abilities-component>
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
import { Component, Prop, Vue } from 'vue-property-decorator';
import Axios from 'axios';

/**
 * Vue Components
 */
import GameChatComponent from './Shared/GameChatComponent.vue';
import GameAbilitiesComponent from './Shared/GameAbilitiesComponent.vue';
import GameStatsComponent from './Shared/GameStatsComponent.vue';

/**
 * TypeScript interfaces
 */
import { GameInterface } from '../../interfaces/game.interface';
import { FighterInterface } from '../../interfaces/fighter.interface';
import { StateInterface } from '../../interfaces/state.interface';

@Component({
    components: {
        'game-abilities-component': GameAbilitiesComponent,
        'game-chat-component': GameChatComponent,
        'game-stats-component': GameStatsComponent,
    }
})
export default class GameComponent extends Vue {
    @Prop({ required: true }) readonly game!: GameInterface;

    private static readonly GAME_SP: string = 'VS AI';
    private static readonly GAME_RANKED: string = 'Ranked Multiplayer';
    private static readonly GAME_MP: string = 'Multiplayer;'

    private fighter : FighterInterface | null = null;
    private opponent : FighterInterface | null = null;
    private state : StateInterface | null = null;
    private stateHash: string = '';
    private currentImage : string = '';

    mounted() {
        this.fighter = this.game.firstPlayer.firstFighter;
        this.opponent = this.game.secondPlayer.firstFighter;
        this.state = this.game.state;
        this.state.history = [{
            actor: 1,
            id: 1,
            type: 'ability',
        }];
        this.stateHash = this.game.state_hash;
        this.currentImage = this.buildImageUrl(this.opponent.code);
    }

    get gameType(): string {
        if (this.game.against_ai) {
            return GameComponent.GAME_SP;
        }

        if (this.game.ranked) {
            return GameComponent.GAME_RANKED;
        }

        return GameComponent.GAME_MP;
    }

    public testSend(): void {
        Axios.put('/demo/sync', {
            state: this.state,
            stateHash: this.stateHash,
            gameId: this.game.id,
        }).then((response: any) => {
            console.log(response);
        }).catch((e: any) => {
            console.error(e);
        });
    }

    /**
     * Set the current fighter based on a numerical ID.
     *
     * @param {Number} fighterId
     * @protected
     * @return void
     */
    protected setCurrentFighter(fighterId: number): void {
        let fighter : FighterInterface | null;

        switch (fighterId) {
            case 2:
                fighter = this.game.firstPlayer.secondFighter;
                break;
            case 3:
                fighter = this.game.firstPlayer.thirdFighter;
                break;
            default:
                fighter = this.game.firstPlayer.firstFighter;
                break;
        }

        if (fighter) {
            this.fighter = fighter;
        }
    }

    /**
     * Build an image URL.
     *
     * @param {String} character
     * @param {String|null} ability
     * @protected
     * @return string
     */
    protected buildImageUrl(character: string, ability: string | null = null): string {
        const action = ability ?? character;

        return `/images/fighters/${character}/${action}.gif`;
    }
}
</script>
