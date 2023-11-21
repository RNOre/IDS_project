<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Dialog from "primevue/dialog";
import {mapState} from "vuex";
import {andRules, defuzzification, determineSample, fuzzification} from "../../../service/fuzzy/fuzzy.js";

export default {
  name: 'ScoreItem',
  components: {
    DataTable,
    Column,
    Dialog,
  },
  data() {
    return {
      OMin: '',
      OMid: '',
      OMax: '',
      SMin: '',
      SMid: '',
      SMax: '',
      TMin: '',
      TMid: '',
      TMax: '',
      low: {temp: 0, conclusion: 0},
      middle: {temp: 0, conclusion: 0},
      height: {temp: 0, conclusion: 0},
      sample1: '',
      sample2: '',
      sample3: '',
      reward: '',
      studentData: [
        {
          id: 1,
          value: 694358,
          OAR: 32,
          ROD: 42,
          NIR: 51,
          result: 23
        },
        {
          id: 1,
          value: 423535,
          OAR: 62,
          ROD: 22,
          NIR: 2,
          result: 12
        }
      ]
    }
  },
  methods: {
    print() {
      window.print();
    },
    getResult(olimpValue, studyValue, testValue) {
      // console.log(OARDataParam.min, OARDataParam.mid, OARDataParam.max);
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
    },
  },
  computed: {
    ...mapState({
      scoreData: state => state.score.studentsScore,
    })
  },
  created() {
    this.$store.dispatch('getStudentsScores')
  }
}
</script>
<template>
  <div class="score">
    <h1 @click="console.log(scoreData)">Список студентов</h1>
    <Button label="Печать" class="printBtn" @click="print"/>
    <DataTable :value="scoreData" stripedRows tableStyle="min-width: 50rem">
      <Column field="value" header="№ зач. книжки" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align:middle"></Column>
      <Column field="0.value" header="Учебная деятельность" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align: middle"></Column>
      <Column field="1.value" header="Культурно-спортивная" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align: middle"></Column>
      <Column field="2.value" header="Научно-исследовательская деятельность" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align: middle"></Column>
      <Column field="result" header="Рейтинг" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align: middle"></Column>
    </DataTable>
  </div>
</template>
<style scoped>
.title {
  text-align: center;
  display: none;
}

.score {
  margin-top: 50px;
}

@media print {
  body {
    font-size: 28px;
  }

  .title {
    display: block
  }

  .printBtn {
    display: none
  }

  td{
    font-size:40px;
  }
}

</style>