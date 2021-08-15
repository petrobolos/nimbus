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
    if (this.getActiveFighter(this.activeFighter)[payload.attribute] !== undefined) {
      this.getActiveFighter(this.activeFighter)[payload.attribute] = payload.value;
    }
  }

  @Mutation
  public UPDATE_ACTIVE_OPPONENT(payload: FighterUpdate): void {
    if (this.getActiveOpponent(this.activeOpponent)[payload.attribute] !== undefined) {
      this.getActiveOpponent(this.activeOpponent)[payload.attribute] = payload.value;
    }
  }

  @Action
  public initialize(game: GameInterface): void {
    if (this.game === undefined) {
      this.context.commit('UPDATE_GAME', game);
      this.context.commit('SET_ACTIVE_FIGHTER', game.firstPlayer.firstFighter);
      this.context.commit('SET_ACTIVE_OPPONENT', game.secondPlayer.firstFighter);
    }
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
  public updateState(state: StateInterface): void {
    this.context.commit('UPDATE_STATE', state);
  }

  @Action
  public updateStateHash(stateHash: string): void {
    this.context.commit('UPDATE_STATE_HASH', stateHash);
  }

  /**
   * Get the current fighter used by the player.
   *
   * @param {Number} fighterId
   * @protected
   * @return {FighterInterface}
   */
  protected getActiveFighter(fighterId: number): FighterInterface {
    return GameModule.getFighter(this.game.firstPlayer, fighterId);
  }

  /**
   * Retrieve the current fighter used by the opponent.
   *
   * @param {Number} fighterId
   * @protected
   * @return {FighterInterface}
   */
  protected getActiveOpponent(fighterId: number): FighterInterface {
    return GameModule.getFighter(this.game.secondPlayer, fighterId);
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
