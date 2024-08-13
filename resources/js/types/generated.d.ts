declare namespace App.Enums {
    export type AppStatus = "submitted" | "accepted" | "rejected";
}
declare namespace App.Http.Requests {
    export type GetSubmitAppRequest = {
        is_paid: boolean;
    };
    export type PostMagicLoginRequest = {
        email: string;
    };
    export type PostSignUpRequest = {
        url: string;
        email: string;
        is_paid: boolean;
    };
    export type PostSubmitAppRequest = {
        url: string;
        logo: any;
        title: string;
        sentence: string;
        description: string;
        is_paid: boolean;
    };
}
declare namespace App.Resources {
    export type AppResource = {
        id: string;
        url: string;
        title: string;
        sentence: string;
        description: string;
        logo_url: string;
        user: App.Resources.UserResource | null;
        created_at: string | null;
    };
    export type UserResource = {
        email: string;
    };
}
