import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            currentTask: null,
            projectsList: null
        }
    },
    mutations: {
        editedTask: function (state, task) {
            state.currentTask = task
        },
        projectsList: function (state, list) {
            state.projectsList = list
        }
    },
    getters: {
        editedTask: function (state) {
            return state.currentTask
        },
        projectsList: function (state) {
            return state.projectsList
        }
    }
})

export default store
