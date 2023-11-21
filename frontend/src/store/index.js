import {createStore} from "vuex";
import {students} from "./moduls/studentModule.js";
import {events} from "./moduls/eventModules.js";
import {score} from "./moduls/scoreModule.js";

export const store = createStore({
    modules: {
        students,
        events,
        score,
    }
})