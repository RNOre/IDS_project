import axios from "axios";
import {andRules, defuzzification, determineSample, fuzzification} from "../../service/fuzzy/fuzzy.js";

export const score = {
    state: () => {
        return {
            OARChartData: {
                labels: ["50", "100", "150", "200", "250", "300", "350", "400"],
                datasets: {
                    low: [100, 100, 0],
                    middle: [, 0, 100, 0],
                    height: [, , 0, 100, 100, 100, 100, 100],
                },
                param: {
                    min: 100,
                    mid: 150,
                    max: 200
                }
            },
            RODChartData: {
                labels: '',
                datasets: ''
            },
            NIRChartData: {
                labels: '',
                datasets: ''
            },
            studentsScore: []
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
        },
        setStudentsScore(state, payload) {
            // console.log(payload);
            let maxO = 0;
            let maxS = 0;
            let maxT = 0;
            payload.forEach(student =>
                maxO = Math.max(maxO, student[0].value)
            );
            payload.forEach(student =>
                maxS = Math.max(maxO, student[1].value)
            );
            payload.forEach(student =>
                maxT = Math.max(maxO, student[2].value)
            );
            // console.log(maxO)
            payload.forEach(student =>
                // console.log(getValue(maxO, student[0].value))
                student.result = getResult(student[0].value / maxO * 100, student[1].value / maxS * 100, student[2].value / maxT * 100)
            );
            // console.log(payload);
            state.studentsScore = payload.sort(compare);
        },
    },
    actions: {
        setOARChartData({commit}, payload) {
            commit('setOARChartData', payload);
        },
        setDataSets({commit}, payload) {
            commit('setDataSets', payload)
        },
        async getStudentsScores({commit}) {
            await axios.get('http://localhost:8876/api/v1/test')
                .then(resp => commit('setStudentsScore', resp.data))
        }
    },
    getters: {
        getStudentsDataSets(state) {
            return state.OARChartData.datasets;
        }
    }
}

const getResult = (olimpValue, studyValue, testValue) => {
    console.log(olimpValue, studyValue, testValue);
    let OMin = '';
    let OMid = '';
    let OMax = '';
    let SMin = '';
    let SMid = '';
    let SMax = '';
    let TMin = '';
    let TMid = '';
    let TMax = '';
    let low = {temp: 0, conclusion: 0};
    let middle = {temp: 0, conclusion: 0};
    let height = {temp: 0, conclusion: 0};
    let sample1 = '';
    let sample2 = '';
    let sample3 = '';
    let reward = '';
    // [this.OMin, this.OMid, this.OMax] = fuzzification(this.olimpValue, this.OARDataParam.min, this.OARDataParam.mid, this.OARDataParam.max);
    [OMin, OMid, OMax] = fuzzification(olimpValue, 30, 45, 60);
    [SMin, SMid, SMax] = fuzzification(studyValue, 30, 45, 60);
    [TMin, TMid, TMax] = fuzzification(testValue, 30, 45, 60);

    //o-p1 s-p2 t-p3

    andRules(OMin, SMin, TMin, low);
    andRules(OMin, SMin, TMid, low);
    andRules(OMin, SMin, TMax, low);
    andRules(OMin, SMid, TMin, low);
    andRules(OMin, SMid, TMid, middle);
    andRules(OMin, SMid, TMax, middle);
    andRules(OMin, SMax, TMin, low);
    andRules(OMin, SMax, TMid, middle);
    andRules(OMin, SMax, TMax, middle);

    andRules(OMid, SMin, TMin, low);
    andRules(OMid, SMin, TMid, middle);
    andRules(OMid, SMin, TMax, middle);
    andRules(OMid, SMid, TMin, middle);
    andRules(OMid, SMid, TMid, middle);
    andRules(OMid, SMid, TMax, middle);
    andRules(OMid, SMax, TMin, middle);
    andRules(OMid, SMax, TMid, middle);
    andRules(OMid, SMax, TMax, height);

    andRules(OMax, SMin, TMin, low);
    andRules(OMax, SMin, TMid, middle);
    andRules(OMax, SMin, TMax, middle);
    andRules(OMax, SMid, TMin, middle);
    andRules(OMax, SMid, TMid, middle);
    andRules(OMax, SMid, TMax, height);
    andRules(OMax, SMax, TMin, middle);
    andRules(OMax, SMax, TMid, height);
    andRules(OMax, SMax, TMax, height);


    [sample1, sample2, sample3] = determineSample(0, 30, 60, 100);

    reward = defuzzification(
        low.conclusion,
        middle.conclusion,
        height.conclusion,
        sample1,
        sample2,
        sample3
    );
    return reward;
}
const getValue = (max, value) => {
    // console.log(max);
    return value / max * 100
};

const compare = (a, b) => {
    if (a.result > b.result) {
        return -1;
    }
    if (a.result < b.result) {
        return 1
    }
    return 0;
}