import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators';
import GameInterface from '../interfaces/game.interface';
import FighterInterface from '../interfaces/fighter.interface';
import PlayerInterface from '../interfaces/player.interface';
import StateInterface from '../interfaces/state.interface';
import { FighterUpdate } from '../types/fighter-update.type';

@Module({ name: 'GameModule' })
export default class GameModule extends VuexModule {
  public game!: GameInterface;

  public activeFighter!: number;

  public activeOpponent!: number;

  public imageUrl!: string;

  get getGameId(): number {
    return this.game.id;
  }

  get getImageUrl(): string {
    return this.imageUrl;
  }

  get getActiveFighter(): FighterInterface {
    return GameModule.getFighter(this.game.firstPlayer, this.activeFighter);
  }

  get getActiveOpponent(): FighterInterface {
    return GameModule.getFighter(this.game.secondPlayer, this.activeOpponent);
  }

  get getGameType(): string {
    if (this.game.against_ai) {
      return 'Single Player';
    }

    if (this.game.ranked) {
      return 'Ranked Multiplayer';
    }

    return 'Multiplayer';
  }

  @Mutation
  public UPDATE_GAME(game: GameInterface): void {
    this.game = game;
  }

  @Mutation
  public SET_ACTIVE_FIGHTER(fighter: FighterInterface): void {
    this.activeFighter = fighter.id;
  }

  @Mutation
  public SET_ACTIVE_OPPONENT(fighter: FighterInterface): void {
    this.activeOpponent = fighter.id;
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
    if (this.getActiveFighter[payload.attribute] !== undefined) {
      this.getActiveFighter[payload.attribute] = payload.value;
    }
  }

  @Mutation
  public UPDATE_ACTIVE_OPPONENT(payload: FighterUpdate): void {
    if (this.getActiveOpponent[payload.attribute] !== undefined) {
      this.getActiveOpponent[payload.attribute] = payload.value;
    }
  }

  @Mutation
  public UPDATE_OPPONENT_IMAGE(url: string): void {
    this.imageUrl = url;
  }

  @Action
  public initialize(game: GameInterface): void {
    if (this.game === undefined) {
      this.resetGame(game);
      this.setActiveFighter(game.firstPlayer.firstFighter);
      this.setOppositeFighter(game.secondPlayer.firstFighter);
    }
  }

  @Action
  public resetGame(game: GameInterface): void {
    this.context.commit('UPDATE_GAME', game);
  }

  @Action
  public setActiveFighter(fighter: FighterInterface): void {
    this.context.commit('SET_ACTIVE_FIGHTER', fighter);
  }

  @Action
  public setOppositeFighter(fighter: FighterInterface): void {
    this.context.commit('SET_ACTIVE_OPPONENT', fighter);
    this.updateActiveOpponentImage(null);
  }

  @Action
  public updateActiveFighter(attribute: string, value: number): void {
    this.context.commit('SET_ACTIVE_FIGHTER', { attribute, value });
  }

  @Action
  public updateActiveOpponent(attribute: string, value: number): void {
    this.context.commit('SET_ACTIVE_OPPONENT', { attribute, value });
  }

  @Action
  public updateActiveOpponentImage(ability: null|string): void {
    const fighter = this.getActiveFighter.code;
    const action = ability ?? fighter;

    const url = `/images/fighters/${fighter}/${action}.gif`;

    this.context.commit('UPDATE_OPPONENT_IMAGE', url);
  }

  @Action
  public updateState(state: StateInterface): void {
    this.context.commit('UPDATE_STATE', state);
  }

  @Action
  public updateStateHash(stateHash: string): void {
    this.context.commit('UPDATE_STATE_HASH', stateHash);
  }

  /**
   * Convert a given fighter ID into a fighter object based upon a given player.
   *
   * @param {PlayerInterface} player
   * @param {Number} fighterId
   * @protected
   * @return {FighterInterface}
   */
  protected static getFighter(player: PlayerInterface, fighterId: number): FighterInterface {
    if (player.secondFighter?.id === fighterId) {
      return player.secondFighter;
    }

    if (player.thirdFighter?.id === fighterId) {
      return player.thirdFighter;
    }

    return player.firstFighter;
  }
}
