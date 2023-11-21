<script>
import Chart from 'primevue/chart';
import InputText from 'primevue/inputtext';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import {mapState} from "vuex";

export default {
  name: 'Score',
  components: {
    Chart,
    InputText,
    TabView,
    TabPanel,
  },
  computed: {
    ...mapState({
      OARLabels: state => state.score.OARChartData.labels,
      OARDataSets: state=>state.score.OARChartData.datasets
    }),
    getDataSets() {
      return this.$store.getters.getStudentsDataSets
    }
  },
  data() {
    return {
      low: '',
      middle: '',
      height: '',
      rangeOfValues: '',
      leftRangeOfValue: 0,
      rightRangeOfValue: 0,
      steps: '',
      OARChartData: {
        datasets: [
          {
            label: 'Низкий',
            // data: [100, 100, 0],
            fill: false,
            borderColor: "#DAA7C5",
            tension: 0.4
          },
          {
            label: 'Средний',
            // data: [, 0, 100, 0],
            fill: false,
            borderColor: "#FDB152",
            tension: 0.4
          },
          {
            label: 'Высокий',
              // data: [, , 0, 100, 100, 100, 100, 100],
            fill: false,
            borderColor: "#959B6D",
            tension: 0.4
          }
        ]
      },
      chartOptions: {
        maintainAspectRatio: false,
        aspectRatio: 0.6,
        plugins: {
          legend: {
            labels: {
              color: "black"
            }
          }
        },
        scales: {
          x: {
            ticks: {
              color: "black"
            },
            grid: {
              color: "#8D8D8D"
            }
          },
          y: {
            ticks: {
              color: "black"
            },
            grid: {
              color: "#8D8D8D"
            }
          }
        }
      },
    }
  },
  created() {
    this.OARChartData.labels = this.OARLabels;
    this.OARChartData.datasets[0].data=this.OARDataSets.low;
    this.OARChartData.datasets[1].data=this.OARDataSets.middle;
    this.OARChartData.datasets[2].data=this.OARDataSets.height;
  },
  methods: {
    changeRangeOfValues() {
      [this.leftRangeOfValue, this.rightRangeOfValue] = this.rangeOfValues.split(/[ ,]+/);
      const stepDif = Number(this.rightRangeOfValue - this.leftRangeOfValue) / Number(this.steps);
      console.log(stepDif);
      let labels = [];
      for (let i = 0; i <= this.steps; i++) {
        labels.push(Number(this.leftRangeOfValue) + Number(stepDif * i));
      }
      this.OARChartData.labels = labels;
      this.$store.dispatch("setOARChartData", labels)
    },
    changeParam() {
      const datasets={
        low:this.low.split(/[ ,]+/),
        middle:this.middle.split(/[ ,]+/),
        height: this.height.split(/[ ,]+/)
      }
      this.$store.dispatch('setDataSets', datasets);
      this.OARChartData.datasets[0].data=this.OARDataSets.low;
      this.OARChartData.datasets[1].data=this.OARDataSets.middle;
      this.OARChartData.datasets[2].data=this.OARDataSets.height;
      console.log(this.OARDataSets);
    }
  },
}
</script>
<template>
  <div class="card flex justify-content-center">
    <TabView>
      <TabPanel header="Общий академический рейтинг">
        <div class="card">
          <Chart type="line" :data="OARChartData" :options="chartOptions" class="h-50rem w-50"/>
          <div>
            <form class="inputFormGroup">
              <span class="p-float-label">
              <InputText id="value" v-model="rangeOfValues" type="text" :class="{ 'p-invalid': errorMessage }"
                         @change="changeRangeOfValues"
                         aria-describedby="text-error"/>
              <label for="value">Диапазон значений</label>
              </span>
              <span class="p-float-label">
                <InputText id="value" v-model="steps" type="text" :class="{ 'p-invalid': errorMessage }"
                           @change="changeRangeOfValues"
                           aria-describedby="text-error"/>
                <label for="value">Количество шагов*</label>
      </span>
            </form>
            <form class="inputFormGroup">
                  <span class="p-float-label">
                <InputText id="value" v-model="low" type="text" :class="{ 'p-invalid': errorMessage }"
                           @change="changeParam"
                           aria-describedby="text-error"/>
                <label for="value">Низкий</label>
      </span>
              <span class="p-float-label">
                <InputText id="value" v-model="middle" type="text" :class="{ 'p-invalid': errorMessage }"
                           @change="changeParam"
                           aria-describedby="text-error"/>
                <label for="value">Средний</label>
      </span>
              <span class="p-float-label">
                <InputText id="value" v-model="height" type="text" :class="{ 'p-invalid': errorMessage }"
                           @change="changeParam"
                           aria-describedby="text-error"/>
                <label for="value">Высокий</label>
      </span>
            </form>
          </div>
        </div>
      </TabPanel>
      <TabPanel header="Рейтинг общей деятельности">
        авы
      </TabPanel>
      <TabPanel header="Научно исследовательский рейтинг">
        авфы
      </TabPanel>
    </TabView>
  </div>
</template>
<style>
.card {
  display: flex;
  flex-direction: row;
  gap: 20px
}

.inputScoreGroup span {
  margin-bottom: 30px;
}
</style>