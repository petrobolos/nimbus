import StateInterface from '../state.interface';

export default interface DemoSyncInterface extends Record<string, string|StateInterface[]> {
  state: StateInterface[];
  stateHash: string;
}
