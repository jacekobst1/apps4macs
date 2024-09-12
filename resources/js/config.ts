interface Config {
    appName: string;
    contactMail: string;
}

const config: Config = {
    appName: import.meta.env.VITE_APP_NAME,
    contactMail: import.meta.env.VITE_CONTACT_MAIL,
};

export default config;
