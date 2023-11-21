<script>
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import {mapState} from "vuex";
import {format} from "date-fns";

export default {
  name: 'AddParticipant',
  components: {
    InputText,
    Dropdown,
    Calendar
  },
  props: {
    eventId: String
  },
  methods: {
    addEvent() {
      const body = {
        value: this.value,
        enrollmentDate: format(new Date(this.enrollmentDate), 'yyyy-MM-dd'),
        student_group_id: this.studentGroupId.code,
        averageBall: this.averageBall
      };
      this.$store.dispatch('createStudent', body);
      this.$emit('close');
    },
    addParticipant() {
      const body = {
        student_id: this.studentId.code,
        date: format(new Date(this.date), 'yyyy-MM-dd'),
        category: this.category,
        type_indiv_achiv_id: this.typeId.id,
        event_id: this.eventId,
        scale_id:this.scaleId.code
      };
      this.$store.dispatch('addParticipant', body);
      this.$emit('close');
    }
  },
  data() {
    return {
      name: '',
      studentGroupId: '',
      date: '',
      averageBall: '',
      category: '',
      typeId: '',
      scaleId: '',
      studentId: ''
    }
  },
  computed: {
    ...mapState({
      groupData: state => state.students.groups,
      studentValues: state => state.students.values,
      scalesData: state => state.events.scales,
      typeOfEvent: state => state.events.typeOfEvent,
    })
  },
  created() {
    this.$store.dispatch('getGroups');
    this.$store.dispatch('getValues');
    this.$store.dispatch('getType');
    this.$store.dispatch('getScales');
    console.log(this.studentValues)
  }
}
</script>
<template>
  <div className="card flex justify-content-center addStudent">
    <form class="flex flex-column gap-2 p-5">
      <!--            <span class="p-float-label">-->
      <!--                <InputText id="value" v-model="studentId" type="text" :class="{ 'p-invalid': errorMessage }"-->
      <!--                           aria-describedby="text-error"/>-->
      <!--                <label for="value">Номер зач. книжки</label>-->
      <!--            </span>-->
      <div class="p-float-label">
        <Dropdown v-model="studentId" :options="studentValues" optionLabel="name"
                  placeholder="Выберете студента" class="w-full md:w-14rem"/>
        <label for="dd-city">№ зачетной книжки студента</label>
      </div>
      <span class="p-float-label">
                      <InputText id="value" v-model="category" type="text" :class="{ 'p-invalid': errorMessage }"
                                 aria-describedby="text-error"/>
                      <label for="value">Категория</label>
                  </span>
      <div class="p-float-label">
        <Dropdown v-model="typeId" :options="typeOfEvent" optionLabel="name"
                  placeholder="Выберете вид" class="w-full md:w-14rem"/>
        <label for="dd-city">Вид индивидуального достижения </label>
      </div>
      <div class="p-float-label">
        <Dropdown v-model="scaleId" :options="scalesData" optionLabel="name"
                  placeholder="Выберете шкалу" class="w-full md:w-14rem"/>
        <label for="dd-city">Количество баллов</label>
      </div>
      <div class="p-float-label">
        <Calendar v-model="date" inputId="birth_date"/>
        <label for="birth_date">Дата участия</label>
      </div>
      <Button label="Добавить" @click="addParticipant"/>
    </form>
    <Toast/>
  </div>
</template>
<style>
.addStudent form {
  display: flex;
  flex-direction: row;
  gap: 30px
}
</style>