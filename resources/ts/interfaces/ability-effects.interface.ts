export default interface AbilityEffectsInterface extends Record<string, null|number|boolean> {
  recover_hp: number|null,
  recover_sp: number|null,
  paralysis: number|null,
  ohko: number|null,
  crit_chance: number|null,
  hp_drain: boolean|null,
  pure: boolean|null,
};
