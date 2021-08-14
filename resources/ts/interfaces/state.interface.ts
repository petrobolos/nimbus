import { ActionInterface } from './action.interface';

export interface StateInterface {
  currentPlayer: number;
  history: ActionInterface[];
}
