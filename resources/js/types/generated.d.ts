declare namespace App.Enums {
    export type AppStatus = "submitted" | "accepted" | "rejected";
    export type PriceType = "monthly" | "yearly";
}
declare namespace App.Http.Requests {
    export type GetSubmitAppRequest = {
        is_paid: boolean;
    };
    export type PostChoosePlanRequest = {
        is_paid: boolean;
        price_type: App.Enums.PriceType | null;
    };
    export type PostMagicLoginRequest = {
        email: string;
    };
    export type PostSignUpRequest = {
        url: string;
        email: string;
        is_paid: boolean;
        price_type: App.Enums.PriceType | null;
    };
    export type PostSubmitAppRequest = {
        url: string;
        logo: any;
        title: string;
        sentence: string;
        description: string;
        is_paid: boolean;
    };
    export type PutUpdateAppRequest = {
        logo: any | null;
        title: string;
        sentence: string;
        description: string;
    };
}
declare namespace App.Resources {
    export type AppResource = {
        id: string;
        status: App.Enums.AppStatus;
        url: string;
        title: string;
        sentence: string;
        description: string;
        is_paid: boolean;
        logo_url: string;
        user: App.Resources.UserResource | null;
        created_at: string | null;
    };
    export type UserResource = {
        email: string;
    };
}
