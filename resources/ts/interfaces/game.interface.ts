import { PlayerInterface } from "./player.interface";

export interface GameInterface
{
    against_ai: boolean;
    created_at: string;
    firstPlayer: PlayerInterface;
    id: number;
    player_1: number;
    player_2: number;
    ranked: boolean;
    secondPlayer: PlayerInterface;
    status: string;
    time_elapsed: number;
    updated_at: string;
}
