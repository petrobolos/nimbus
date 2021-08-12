export interface UserInterface {
    banned_until: string | null;
    is_banned: boolean;
    is_muted: boolean;
    last_signed_in: string;
    muted_until: string | null;
    preferred_locale: string;
    role: string[],
    username: string;
}
