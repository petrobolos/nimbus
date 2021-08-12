import { FighterInterface } from "./fighter.interface";
import { UserInterface } from "./user.interface";

export interface PlayerInterface {
    current_fighter: number;
    fighter_id_1: number;
    fighter_id_2: number | null;
    fighter_id_3: number | null;
    firstFighter: FighterInterface;
    id: number;
    secondFighter: FighterInterface | null;
    thirdFighter: FighterInterface | null;
    user: UserInterface | null;
    user_id: number | null;
}
