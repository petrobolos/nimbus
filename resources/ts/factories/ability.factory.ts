/* eslint-disable import/no-extraneous-dependencies */
import { Factory } from 'fishery';
import * as Faker from 'faker';

import AbilityInterface from '../interfaces/ability.interface';

export default Factory.define<AbilityInterface>(({ sequence }) => ({
  id: sequence,
  name: Faker.random.words(2),
  code: Faker.random.word(),
  cost: Faker.datatype.number(100),
  type: Faker.datatype.boolean() ? 'physical' : 'special',
  description: Faker.lorem.sentences(2),
}));
