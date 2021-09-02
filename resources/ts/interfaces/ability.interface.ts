import AbilityEffectsInterface from './ability-effects.interface';

export default interface AbilityInterface extends Record<string, number|string|AbilityEffectsInterface> {
  id: number,
  code: string,
  cost: number,
  name: string,
  type: string,
  description: string,
  effects: AbilityEffectsInterface,
};
