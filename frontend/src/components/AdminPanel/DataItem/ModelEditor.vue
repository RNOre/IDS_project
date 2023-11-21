<script>
import {ref} from "vue";
import OrganizationChart from "primevue/organizationchart";
import Dialog from "primevue/dialog";
import Rules from "../ReportItem/Rules.vue";
import Score from "../ReportItem/Score.vue";

export default {
  name: 'ModelEditor',
  components: {
    OrganizationChart,
    Dialog,
    Rules,
    Score,
  },
  data() {
    return {
      data: ref({

            label: 'Метод Мамдани',
            id: 'Mamdani',
            children: [
              {
                label: 'Общий академический рейтинг',
                id: 'OAR',
              },
              {
                label: 'Рейтинг общественной деятельности',
                id: 'ROD'
              },
              {
                label: 'Научно исследовательский рейтинг',
                id: 'NIR'
              },
            ]
          }
      ),
      scoreModal: false,
      rulesModal: false,
      resultModal: false,
    }
  },
  methods: {
    openModal(modalType) {
      switch (modalType) {
        case 'Mamdani':
          this.rulesModal = true;
          break;
        case 'OAR':
          this.scoreModal = true;
          break;
        case 'Result':
          this.resultModal = true;
          break;
      }
    }
  }
}
</script>
<template>
  <div class="card">
    <OrganizationChart :value="data">
      <template #default="slotProps">
          <span class="treeItem"
                @click=openModal(slotProps.node.id)

          >{{ slotProps.node.label }}</span>
      </template>
    </OrganizationChart>
    <Dialog v-model:visible="scoreModal" @close="scoreModal=false" modal header="Редактор переменных"
            :style="{ width: '75vw' }">
      <Score/>
    </Dialog>
    <Dialog v-model:visible="rulesModal" @close="rulesModal=false" modal header="Редактор правил"
            :style="{ width: '95vw' }">
      <Rules/>
    </Dialog>
    <Dialog v-model:visible="resultModal" @close="resultModal=false" modal header="Резултат" :style="{ width: '75vw' }">
      <Result/>
    </Dialog>
  </div>
</template>
<style scoped>
.card {
  margin: 50px
}

.card tr {
  height: 0;
}
</style>