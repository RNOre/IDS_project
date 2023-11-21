import axios from "axios";

export const rules = {
    state: () => {
        return {
            rules: [
                {
                    id: 0,
                    OParam: '',
                    SParam: '',
                    TParam: ''
                },
                {
                    id: 0,
                    OParam: '',
                    SParam: '',
                    TParam: ''
                },
            ]
        }
    },
    mutations: {
        setOARChartData(state, payload) {
            state.OARChartData.labels = payload;
        },
        setRODChartData(state, payload) {
            state.RODChartData = payload;
        },
        setNIRChartData(state, payload) {
            state.students = payload;
        },
        setDataSets(state, payload) {
            state.OARChartData.datasets = payload;
        }
    },
    actions: {
        setOARChartData({commit}, payload) {
            commit('setOARChartData', payload);
        }
    },
    getters: {
        getStudentsDataSets(state) {
            return state.OARChartData.datasets;
        }
    }
}