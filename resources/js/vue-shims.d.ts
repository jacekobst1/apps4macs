// noinspection ES6UnusedImports
import {ComponentCustomProperties} from "vue";

declare module "@vue/runtime-core" {
    interface ComponentCustomProperties {
        $back: () => void;
    }
}
