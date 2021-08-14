export interface FighterInterface {
  abilities: Record<string, unknown>;
  attack: number;
  code: string;
  defense: number;
  description: string;
  hp: number;
  id: number;
  is_boss: boolean;
  name: string;
  special: number;
  speed: number;
  spirit: number;
}
