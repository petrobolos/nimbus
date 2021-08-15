export default interface AbilityInterface extends Record<string, number|string> {
  id: number,
  code: string,
  name: string,
  type: string,
  description: string,
};
