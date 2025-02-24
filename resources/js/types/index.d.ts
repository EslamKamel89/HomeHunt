import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;

    // notifications?: Nofiication[];
    notifications_count?: number | null;
    // unread_notifications: Notification[];
    unread_notifications_count: number | null;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    flash: {
        success: string | null;
        error: string | null;
    };
};
