<script>
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import {mapState} from "vuex";
import {format} from "date-fns";

export default {
  name: 'AddEvent',
  components: {
    InputText,
    Dropdown,
    Calendar
  },
  props: {},
  methods: {
    addEvent() {
      const body = {
        name: this.name,
        // enrollmentDate: format(new Date(this.enrollmentDate), 'yyyy-MM-dd'),
        // student_group_id: this.studentGroupId.code,
        // averageBall: this.averageBall
        educ_inst_id: this.edInstId.id,
        level_id: this.levelId.id
      };
      this.$store.dispatch('createEvent', body);
      this.$emit('close');
    }
  },
  data() {
    return {
      name: '',
      studentGroupId: '',
      enrollmentDate: '',
      averageBall: '',
      eventId: '',
      typeId: '',
      edInstId: '',
      levelId: ''
      // typeOfEvent:''
    }
  },
  computed: {
    ...mapState({
      levelGroup: state => state.events.levels,
      typeOfEvent: state => state.events.typeOfEvent,
      educInst: state => state.events.educInst,
    })
  },
  created() {
    this.$store.dispatch('getGroups');
    this.$store.dispatch('getLevels');
    this.$store.dispatch('getType');
    this.$store.dispatch('educInst');
  }
}
</script>
<template>
  <div class="card flex justify-content-center addStudent">
    <form class="flex flex-column gap-2 p-5">
            <span class="p-float-label">
                <InputText id="value" v-model="name" type="text" :class="{ 'p-invalid': errorMessage }"
                           aria-describedby="text-error"/>
                <label for="value">Название мероприятия</label>
            </span>
      <div class="p-float-label">
        <Dropdown v-model="levelId" :options="levelGroup" optionLabel="name"
                  placeholder="Выберете уровень" class="w-full md:w-14rem"/>
        <label for="dd-city">Уровень мероприятия</label>
      </div>
      <div class="p-float-label">
        <Dropdown v-model="typeId" :options="typeOfEvent" optionLabel="name"
                  placeholder="Выберете уровень" class="w-full md:w-14rem"/>
        <label for="dd-city">Тип мероприятия</label>
      </div>
      <div class="p-float-label">
        <Dropdown v-model="edInstId" :options="educInst" optionLabel="name"
                  placeholder="Выберете место" class="w-full md:w-14rem"/>
        <label for="dd-city">Место проведения</label>
      </div>
      <Button label="Добавить" @click="addEvent"/>
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