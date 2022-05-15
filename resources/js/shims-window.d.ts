import { AxiosInstance } from 'axios';
import { Config, InputParams, Router } from 'ziggy-js';

declare global {
    interface Window {
        _: Lodash,
        axios: AxiosInstance
    }

    function route(): Router;
    function route(name: string, params?: InputParams, absolute?: boolean, customZiggy?: Config): string;
}
