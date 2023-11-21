<script>

import Column from "primevue/column";
import Dialog from "primevue/dialog";
import Toast from "primevue/toast";
import ConfirmDialog from "primevue/confirmdialog";
import {mapState} from "vuex";
import {useToast} from "primevue/usetoast";
import {ref} from "vue";
import {useConfirm} from "primevue/useconfirm";
import AddStudent from "./AddStudent.vue";
import ShowStudent from "./ShowStudent.vue";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import {FilterMatchMode} from "primevue/api";
import AddEvent from "./AddEvent.vue";

export default {
  name: 'EventsItem',
  components: {
    AddEvent,
    AddStudent,
    ShowStudent,
    DataTable,
    Column,
    Dialog,
    Toast,
    ConfirmDialog,
    InputText
  },
  data() {
    return {
      showStudentVisible: false,
      addStudentVisible: false,
      currentStudent: 0,
      messages: [],
      filters:{
        global:{value: null, matchMode:FilterMatchMode.CONTAINS},
        value:{value: null, matchMode: FilterMatchMode.STARTS_WITH}
      },
      toast: useToast(),
      items: ref([
        {
          label: 'EditStudent',
          icon: 'pi pi-pencil',
          severity: "danger",
          command: () => {
            this.showStudent(this.currentStudent);
          }
        },
        {
          label: 'DeleteStudent',
          icon: 'pi pi-trash',
          command: () => {
            this.deleteStudent(this.currentStudent);
          }
        },
        {
          label: 'ShowStudent',
          icon: 'pi pi-info-circle',
          command: () => {
            this.showStudent(this.currentStudent);
          }
        },
      ]),
      confirm: useConfirm(),
    }
  },
  computed: {
    ...mapState({
      eventData: state => state.events.events,
    })
  },
  created() {
    this.$store.dispatch('getEvents');
  },
  methods: {
    showStudent(id) {
      this.currentStudent = id;
      this.showStudentVisible = true;
    },
    deleteStudent(id) {
      this.confirm.require({
        message: `Вы уверены, что хотите удалить студента с id: ${id}?`,
        header: 'Удаление студента',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        accept: () => {
          this.$toast.add({
            severity: 'error',
            summary: `Удаление студента`,
            detail: `Студент с id:${id} удален`,
            life: 3000
          });
          this.$store.dispatch('deleteStudent', id);
        },
        reject: () => {
        }
      });


    },
    setCurrentStudent(data) {
      this.currentStudent = data.id
    }
  }
}
</script>
<template>
  <div class="student">
    <Toast/>
    <ConfirmDialog></ConfirmDialog>
    <h1>Добавление/Редактирование/Просмотр данных</h1>
    <DataTable v-model:filters="filters" :value="eventData" stripedRows tableStyle="min-width: 50rem">
      <template #header>
        <div class="header">
          <div class="flex justify-content-end">
          <span class="p-input-icon-left">
            <i class="pi pi-search"/>
            <InputText v-model="filters['global'].value" placeholder="Название мероприятия"/>
          </span>
          </div>
          <Button class="addStudentBtn" label="Добавить мероприятие" @click="addStudentVisible=true"/>
        </div>
      </template>
      <Column field="name" header="Название" headerStyle="justify-content:center; vertical-align:middle"
              bodyStyle="text-align:center; vertical-align:middle"></Column>
      <Column style="min-width: 1rem" bodyStyle="text-align:center">
        <template #body="{data}">
          <!--                <SpeedDial @click="setCurrentStudent(data)" :model="items" buttonClass="p-button-outlined"-->
          <!--                           showIcon="pi pi-bars"-->
          <!--                           :radius="70" type="circle" hideIcon="pi pi-times"/>-->
          <Button icon="pi pi-pencil" severity="warning" text rounded aria-label="test"
                  @click="showStudent(data.id)"/>
          <Button icon="pi pi-trash" severity="danger" text rounded aria-label="test"
                  @click="deleteStudent(data.id)"/>
          <Button icon="pi pi-info" text rounded aria-label="test" @click="showStudent(data.id)"/>
        </template>
      </Column>
    </DataTable>
    <Dialog v-model:visible="showStudentVisible" modal header="Подробная информация о студенте"
            :style="{ width: '50vw' }">
      <ShowStudent :currentStudent="currentStudent"/>
    </Dialog>
    <Dialog v-model:visible="addStudentVisible" @close="addStudentVisible=false" modal header="Добавление мероприятия"
            :style="{ width: '50vw' }">
      <AddEvent :currentStudent="currentStudent"/>
    </Dialog>
  </div>
</template>
<style scoped>
.student {
  margin-top: 50px;
}
.header{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
</style>