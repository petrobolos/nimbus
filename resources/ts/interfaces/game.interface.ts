import { PlayerInterface } from './player.interface';
import { StateInterface } from './state.interface';

export interface GameInterface {
  against_ai: boolean;
  created_at: string;
  firstPlayer: PlayerInterface;
  id: number;
  player_1: number;
  player_2: number;
  ranked: boolean;
  secondPlayer: PlayerInterface;
  state: StateInterface;
  state_hash: string;
  status: string;
  time_elapsed: number;
  updated_at: string;
}
