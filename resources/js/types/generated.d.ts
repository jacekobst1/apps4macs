declare namespace App.Http.Requests {
    export type GetSubmitRequest = {
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
    export type PostSubmitRequest = {
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
    };
}
