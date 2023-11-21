import axios from "axios";

export const events = {
    state: () => {
        return {
            events: ''
        }
    },
    mutations: {
        getEvents(state, payload) {
            state.events=payload;
        },
        getLevels(state, payload) {
            state.levels = payload;
        },
        getType(state, payload) {
            state.typeOfEvent = payload;
        },
        getScales(state, payload) {
            state.scales = payload;
        },
        educInst(state, payload) {
            state.educInst = payload;
        },
    },
    actions: {
        async getEvents({commit}) {
            await axios.get('http://localhost:8876/api/v1/events')
                .then(resp=>commit('getEvents', resp.data))
        },
        async getLevels({commit}) {
            try {
                await axios.get('http://localhost:8876/api/v1/levels')
                    .then(resp => resp.data)
                    .then(resp => commit('getLevels', resp));
            } catch (e) {
                console.log(e);
            }
        },
        async getType({commit}) {
            try {
                await axios.get('http://localhost:8876/api/v1/eventType')
                    .then(resp => resp.data)
                    .then(resp => commit('getType', resp));
            } catch (e) {
                console.log(e);
            }
        },
        async getScales({commit}) {
            try {
                await axios.get('http://localhost:8876/api/v1/scales')
                    .then(resp => resp.data)
                    .then(resp => commit('getScales', resp.data));
            } catch (e) {
                console.log(e);
            }
        },
        async educInst({commit}) {
            try {
                await axios.get('http://localhost:8876/api/v1/educInst')
                    .then(resp => resp.data)
                    .then(resp => commit('educInst', resp));
            } catch (e) {
                console.log(e);
            }
        },
        async createEvent({commit}, payload){
            try{
                await axios.post('http://localhost:8876/api/v1/events', payload)
            }catch (e) {
                console.log(e);
            }
        },
        async addParticipant({commit}, payload){
            try{
                await axios.post('http://localhost:8876/api/v1/participant', payload)
            }catch (e) {
                console.log(e);
            }
        }
    }
}