import {App} from "vue";

export default {
    install: (app: App) => {
        app.config.globalProperties.$back = () => {
            return window.history.back();
        }
    }
}
