<script>
import axios from "axios";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

export default {
  name: 'ShowStudent',
  components:{
    DataTable,
    Column,
  },
  props: {
    currentStudent: Number,
  },
  data() {
    return {
      data: ''
    }
  },
  async created() {
    this.data = await axios.get(`http://localhost:8876/api/v1/students/${this.currentStudent}`)
        .then(resp => resp.data)
        .then(console.log(this.data))
  }
}
</script>
<template>
  <div  class="showStudent">
    <div>
      <h2>№ зачетной книжки: {{ data.value }}</h2>
      <h2>Группа: {{data.groups[0].name}}</h2>
      <h2>Учебное заведение: {{data.groups[0].EI}}</h2>
      <h2>Дата зачисления: {{data.groups[0].ed}}</h2>
    </div>
    <div>
      <h2>Баллы студента</h2>
      <DataTable :value="data.balls" stripedRows showGridlines tableStyle="min-width: 20rem">
        <Column field="value" header="Шифр" headerStyle="justify-content:center; vertical-align:middle"
                bodyStyle="text-align:center; vertical-align:middle"></Column>
        <Column field="date" header="Дата" headerStyle="justify-content:center; vertical-align:middle"
                bodyStyle="text-align:center; vertical-align: middle"></Column>
        <Column field="type" header="Тип" headerStyle="justify-content:center; vertical-align:middle"
                bodyStyle="text-align:center; vertical-align: middle"></Column>
      </DataTable>
    </div>
  </div>

</template>
<style>
.showStudent {
  display: flex;
  gap:20px
}
</style>