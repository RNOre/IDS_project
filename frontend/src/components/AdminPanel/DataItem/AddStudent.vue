<script>
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import {mapState} from "vuex";
import {format} from "date-fns";
import useVuelidate from "@vuelidate/core";
import {required, email, helpers, numeric, minLength, maxLength} from '@vuelidate/validators'

export default {
  setup () {
    return { v$: useVuelidate() }
  },
  name: 'AddStudent',
  components: {
    InputText,
    Dropdown,
    Calendar
  },
  props: {},
  methods: {
    addStudent() {
      let body = {
        value: this.value,
        enrollmentDate: format(new Date(this.enrollmentDate), 'yyyy-MM-dd'),
        student_group_id: this.studentGroupId.code,
        averageBall: this.averageBall,
      };
      if (this.dDate) {
        body = {...body, deductionData: format(new Date(this.dDate), 'yyyy-MM-dd')}
      }
      this.$store.dispatch('createStudent', body);
      this.$emit('close');
    },
    setValue ($event) {
      // do some silly transformation
      this.v$.value.$touch()
    },
    setBall($event) {
      // do some silly transformation
      this.v$.averageBall.$touch()
    }
  },
  data() {
    return {
      value: '',
      studentGroupId: '',
      enrollmentDate: '',
      dDate: '',
      averageBall: '',
      error:''
    }
  },
  validations () {
    return{
      value: { required:helpers.withMessage('Поле номер зач. книжки должны быть заполнены', required),
        numeric :helpers.withMessage('Поле номер зач. книжки должно быть чилом',numeric ),
        minLength:helpers.withMessage('Поле номер зач. книжки должно состоять из 6 цифр', minLength(6)),
        maxLength:helpers.withMessage('Поле номер зач. книжки должно состоять из 6 цифр', maxLength(6)) },
      studentGroupId: { required:helpers.withMessage('number', required), },
      enrollmentDate: { required },
      // dDate: { required },
      averageBall: { required:helpers.withMessage('Поле ср. балл студента должны быть заполнены', required),
      numeric :helpers.withMessage('Поле ср. балл студента должно быть чилом',numeric )},
    }
  },
  computed: {
    ...mapState({
      groupData: state => state.students.groups,
      valueData: state => state.students.values,
    })
  },
  created() {
    this.$store.dispatch('getGroups');
  }
}
</script>
<template>
  <div class="card flex justify-content-center addStudent">
    <form class="flex flex-column gap-2 p-5">
      <p v-for="error of v$.$errors" :key="error.$uid" class="error">
        {{ error.$message }}
      </p>
            <span class="p-float-label">
                <InputText id="value" v-model="value" type="text" :class="{ 'p-invalid': errorMessage }"
                           aria-describedby="text-error"  @input="setValue"/>
                <label for="value">Номер зач. книжки</label>
            </span>
      <span class="p-float-label">
                <InputText id="value" v-model="averageBall" type="text" :class="{ 'p-invalid': errorMessage }"
                           aria-describedby="text-error" @input="setBall"/>
                <label for="value">Средний балл студента</label>
            </span>
      <div class="p-float-label">
        <Dropdown v-model="studentGroupId" :options="groupData" optionLabel="name"
                  placeholder="Выберете группу" class="w-full md:w-14rem"/>
        <label for="dd-city">Выберете группу</label>
      </div>
      <div class="p-float-label">
        <Calendar v-model="enrollmentDate" inputId="birth_date"/>
        <label for="birth_date">Дата зачисления</label>
      </div>
      <div class="p-float-label">
        <Calendar v-model="dDate" inputId="birth_date"/>
        <label for="birth_date">*Дата отчисления</label>
      </div>
      <Button label="Добавить" @click="addStudent"/>
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
.error{
  color:red;
}
</style>