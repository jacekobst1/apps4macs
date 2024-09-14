interface Config {
    appName: string;
    contactMail: string;
    analyticsUrl: string;
}

const config: Config = {
    appName: import.meta.env.VITE_APP_NAME,
    contactMail: import.meta.env.VITE_CONTACT_MAIL,
    analyticsUrl: import.meta.env.VITE_ANALYTICS_URL,
};

export default config;
