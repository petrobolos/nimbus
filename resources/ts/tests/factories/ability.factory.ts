/* eslint-disable import/no-extraneous-dependencies */
import { Factory } from 'fishery';
import * as Faker from 'faker';
import AbilityEffectsInterface from '../../interfaces/ability-effects.interface';

import AbilityInterface from '../../interfaces/ability.interface';

// TODO: Move this to its own factory.
const effects: AbilityEffectsInterface = {
  recover_hp: Faker.datatype.boolean() ? Faker.datatype.number(100) : null,
  recover_sp: Faker.datatype.boolean() ? Faker.datatype.number(100) : null,
  paralysis: Faker.datatype.boolean() ? Faker.datatype.number(100) : null,
  ohko: Faker.datatype.boolean() ? Faker.datatype.number(100) : null,
  crit_chance: Faker.datatype.boolean() ? Faker.datatype.number(100) : null,
  hp_drain: Faker.datatype.boolean() ? true : null,
  pure: Faker.datatype.boolean() ? true : null,
};

export default Factory.define<AbilityInterface>(({ sequence }) => ({
  id: sequence,
  name: Faker.random.words(2),
  code: Faker.random.word(),
  cost: Faker.datatype.number(100),
  type: Faker.datatype.boolean() ? 'physical' : 'special',
  description: Faker.lorem.sentences(2),
  effects: effects,
}));
