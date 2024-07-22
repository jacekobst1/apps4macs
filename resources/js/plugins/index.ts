/**
 * plugins/index.ts
 *
 * Automatically included in `./resources/js/app.ts`
 */

// Plugins

// Icons
import {addIcons, OhVueIcon} from "oh-vue-icons";
import {CoPlus, OiInfo} from "oh-vue-icons/icons";

// Types
import type {App} from 'vue'

export function registerIcons(app: App) {
    addIcons(CoPlus, OiInfo);

    app.component("v-icon", OhVueIcon);
}
