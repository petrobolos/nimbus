import PlayerInterface from './player.interface';
import StateInterface from './state.interface';

export default interface GameInterface extends Record<string, unknown>{
  against_ai: boolean;
  created_at: string;
  game_type: string;
  id: number;
  player_1: number;
  player_2: number;
  players: PlayerInterface[];
  ranked: boolean;
  state: StateInterface;
  state_hash: string;
  status: string;
  time_elapsed: number;
  updated_at: string;
  uuid: string;
};
