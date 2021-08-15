import ActionInterface from './action.interface';

export default interface StateInterface extends Record<string, number|ActionInterface[]> {
  currentPlayer: number;
  history: ActionInterface[];
}
