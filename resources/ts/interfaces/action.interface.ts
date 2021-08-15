export default interface ActionInterface extends Record<string, number|string> {
  actor: number;
  id: number;
  type: string;
};
