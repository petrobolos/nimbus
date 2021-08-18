import AbilityInterface from './ability.interface';

export default interface FighterInterface extends Record<string, unknown> {
  abilities: AbilityInterface[];
  attack: number;
  code: string;
  current_hp: number,
  current_sp: number,
  defense: number;
  description: string;
  hp: number;
  sp: number;
  id: number;
  is_boss: boolean;
  is_paralyzed: boolean,
  name: string;
  special: number;
  speed: number;
  spirit: number;
  uuid: string;
}
