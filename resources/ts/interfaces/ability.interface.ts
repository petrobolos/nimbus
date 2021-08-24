export default interface AbilityInterface extends Record<string, number|string> {
  id: number,
  code: string,
  cost: number,
  name: string,
  type: string,
  description: string,
};
