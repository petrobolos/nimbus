import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators';
import GameInterface from '../interfaces/game.interface';
import FighterInterface from '../interfaces/fighter.interface';
import PlayerInterface from '../interfaces/player.interface';
import StateInterface from '../interfaces/state.interface';
import { FighterUpdate } from '../types/fighter-update.type';
import AbilityInterface from '../interfaces/ability.interface';

@Module({
  name: 'GameModule',
  namespaced: false,
})
export default class GameModule extends VuexModule {
  private game!: GameInterface

  private activeFighter!: FighterInterface;

  private activeOpponent!: FighterInterface;

  private imageUrl: string = '';

  public get getGame(): GameInterface {
    return this.game;
  }

  public get getPlayer(): PlayerInterface {
    return this.game.players[0];
  }

  public get getOpponent(): PlayerInterface {
    return this.game.players[1];
  }

  public get getActiveFighter(): FighterInterface {
    return this.activeFighter;
  }

  public get getActiveOpponent(): FighterInterface {
    return this.activeOpponent;
  }

  // This is just for testing.
  public get getDummyOpponent(): FighterInterface {
    if (this.getOpponent.secondFighter !== null) {
      return this.getOpponent.secondFighter;
    }

    return this.getOpponent.firstFighter;
  }

  public get getGameId(): number {
    return this.game.id;
  }

  public get getImageUrl(): string {
    return this.imageUrl;
  }

  public get getGameType(): string {
    return this.game.game_type;
  }

  @Mutation
  public UPDATE_GAME(game: GameInterface): void {
    this.game = game;
  }

  @Mutation
  public SET_ACTIVE_FIGHTER(fighter: FighterInterface): void {
    this.activeFighter = fighter;
  }

  @Mutation
  public SET_ACTIVE_OPPONENT(fighter: FighterInterface): void {
    this.activeOpponent = fighter;
  }

  @Mutation
  public SET_PLAYER_FIRST_FIGHTER(fighter: FighterInterface): void {
    this.game.players[0].firstFighter = fighter;
  }

  @Mutation
  public SET_PLAYER_SECOND_FIGHTER(fighter: FighterInterface): void {
    this.game.players[0].secondFighter = fighter;
  }

  @Mutation
  public SET_PLAYER_THIRD_FIGHTER(fighter: FighterInterface): void {
    this.game.players[0].thirdFighter = fighter;
  }

  @Mutation
  public SET_OPPONENT_FIRST_FIGHTER(fighter: FighterInterface): void {
    this.game.players[1].firstFighter = fighter;
  }

  @Mutation
  public SET_OPPONENT_SECOND_FIGHTER(fighter: FighterInterface): void {
    this.game.players[1].secondFighter = fighter;
  }

  @Mutation
  public SET_OPPONENT_THIRD_FIGHTER(fighter: FighterInterface): void {
    this.game.players[1].thirdFighter = fighter;
  }

  @Mutation
  public UPDATE_STATE(state: StateInterface): void {
    this.game.state = state;
  }

  @Mutation
  public UPDATE_STATE_HASH(stateHash: string): void {
    this.game.state_hash = stateHash;
  }

  @Mutation
  public UPDATE_ACTIVE_FIGHTER(payload: FighterUpdate): void {
    if (this.activeFighter[payload.attribute] !== undefined) {
      this.activeFighter[payload.attribute] = payload.value;
    }
  }

  @Mutation
  public UPDATE_ACTIVE_OPPONENT(payload: FighterUpdate): void {
    if (this.activeOpponent[payload.attribute] !== undefined) {
      this.activeOpponent[payload.attribute] = payload.value;
    }
  }

  @Mutation
  public UPDATE_OPPONENT_IMAGE(url: string): void {
    this.imageUrl = url;
  }

  @Action({ rawError: true })
  public switchPlayerFighter(fighter: FighterInterface): void {
    const fighterStorage: FighterInterface = this.getActiveFighter;

    if (this.getPlayer.firstFighter.id === fighter.id) {
      this.context.commit('SET_PLAYER_FIRST_FIGHTER', fighterStorage);
    } else if (this.getPlayer.secondFighter?.id === fighter.id) {
      this.context.commit('SET_PLAYER_SECOND_FIGHTER', fighterStorage);
    } else if (this.getPlayer.thirdFighter?.id === fighter.id) {
      this.context.commit('SET_PLAYER_THIRD_FIGHTER', fighterStorage);
    }

    this.context.commit('SET_ACTIVE_FIGHTER', fighter);
  }

  @Action({ rawError: true })
  public switchOpponentFighter(fighter: FighterInterface): void {
    const opponentStorage: FighterInterface = this.getActiveOpponent;

    if (this.getOpponent.firstFighter.id === fighter.id) {
      this.context.commit('SET_OPPONENT_FIRST_FIGHTER', opponentStorage);
    } else if (this.getOpponent.secondFighter?.id === fighter.id) {
      this.context.commit('SET_OPPONENT_SECOND_FIGHTER', opponentStorage);
    } else if (this.getOpponent.thirdFighter?.id === fighter.id) {
      this.context.commit('SET_OPPONENT_THIRD_FIGHTER', opponentStorage);
    }

    this.context.commit('SET_ACTIVE_OPPONENT', fighter);

    // Fire off other actions after committing final state.
    this.switchOpponentImage(fighter, null);
  }

  @Action({ rawError: true })
  public switchOpponentImage(opponent: FighterInterface, ability: AbilityInterface|null): void {
    const action = ability ? ability?.code : opponent.code;
    const url = `/images/fighters/${opponent.code}/${action}.gif`;

    this.context.commit('UPDATE_OPPONENT_IMAGE', url);
  }

  @Action
  public initialize(game: GameInterface): void {
    if (this.game === undefined) {
      this.resetGame(game);

      this.context.commit('SET_ACTIVE_FIGHTER', this.getPlayer.firstFighter);
      this.context.commit('SET_ACTIVE_OPPONENT', this.getOpponent.firstFighter);

      this.switchOpponentImage(this.getOpponent.firstFighter, null);
    }
  }

  @Action
  public resetGame(game: GameInterface): void {
    this.context.commit('UPDATE_GAME', game);
  }
}
