/* eslint-disable import/no-extraneous-dependencies */
import { Factory } from 'fishery';
import slugify from 'slugify';
import * as Faker from 'faker';

import FighterInterface from '../../interfaces/fighter.interface';

const name = Faker.company.companyName();
export default Factory.define<FighterInterface>(({ sequence }) => ({
  // TODO: Add in the ability to generate multiple abilities.
  abilities: [],
  attack: Faker.datatype.number(100),
  code: slugify(name),
  current_hp: 100,
  current_sp: 100,
  defense: Faker.datatype.number(100),
  description: Faker.lorem.sentences(5),
  hp: Faker.datatype.number(100),
  sp: Faker.datatype.number(100),
  id: sequence,
  is_boss: Faker.datatype.boolean(),
  is_paralyzed: Faker.datatype.boolean(),
  name: name,
  special: Faker.datatype.number(100),
  speed: Faker.datatype.number(100),
  spirit: Faker.datatype.number(100),
  uuid: Faker.datatype.uuid(),
}));
