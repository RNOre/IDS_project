<script>
import TreeTable from "primevue/treetable";
import Column from "primevue/column";
import {getData} from "../../../service/journalService.js";
import AddParticipant from "./AddParticipant.vue";
import Dialog from "primevue/dialog";
import axios from "axios";

export default {
  name: 'JournalItem',
  components: {
    AddParticipant,
    TreeTable,
    Column,
    Dialog
  },
  data() {
    return {
      nodes: null,
      participant: false,
      currentEvent:''
    }
  },
  methods: {
    onNodeSelect(node) {
      if (Number(node.key)) {
        console.log(node.data.id);
        this.currentEvent=node.data.id;
        this.participant = true;
        // this.participant = true;
      } else {
        console.log(node.data.id);
        // this.currentEvent=node.data.id;
        // this.participant = true;
      }
    },
    async getData() {
      const data = await axios.get('http://localhost:8876/api/v1/journal')
          .then(resp => resp.data);

      let journalData = [];
      let children = [];


      for (let i = 0; i < data.length; i++) {

        for (let j = 0; j < data[i].studentList.length; j++) {
          const childrenItem = {
            key: `${i}-${j}`,
            data: {
              name: data[i].studentList[j].value,
              icon: 'убрать из участия'
            }
          }
          children.push(childrenItem);
        }

        // console.log(children)

        const journalItem = {
          'key': i,
          data: {
            name: data[i].name,
            id: data[i].id,
            icon: 'добавить участника',
          },
          children,
          command: () => {
            console.log('click');
            this.participant = true;
          }
        }
        journalData.push(journalItem);
        children = [];
      }
      // console.log(journalData);
      return journalData;
    },
    test() {
      this.getData();
    }
  },
  mounted() {
    // Promise.resolve([
    //   {
    //     key: '0',
    //     data: {
    //       name: 'Научная конференция',
    //       icon: 'добавить участника',
    //       command: () => {
    //         console.log('l;kasd')
    //       },
    //     },
    //
    //     children: [
    //       {
    //         key: '0-0',
    //         data: {
    //           name: '423535',
    //           icon: 'убрать из участия'
    //         },
    //
    //       },
    //       {
    //         key: '0-1',
    //         data: {
    //           name: '694358',
    //           icon: 'убрать из участия'
    //         }
    //       },
    //       {
    //         key: '0-2',
    //         data: {
    //           name: '239472',
    //           icon: 'убрать из участия'
    //         }
    //       }
    //     ]
    //   },
    //   {
    //     key: '1',
    //     data: {
    //       name: 'Олимпиада',
    //       icon: 'добавить участника',
    //       command: () => {
    //         console.log('l;kasd')
    //       },
    //     },
    //
    //     children: [
    //       {
    //         key: '1-0',
    //         data: {
    //           name: '543823',
    //           icon: 'убрать из участия'
    //         },
    //       },
    //       {
    //         key: '1-1',
    //         data: {
    //           name: '463534',
    //           icon: 'убрать из участия'
    //         }
    //       },
    //
    //     ]
    //   },
    // ])
    //     .then((data) => this.nodes = data)
    // }
    Promise.resolve(getData())
        .then((data) => this.nodes = data)
  }
}
</script>
<template>
  <div class="journal">
    <div class="card">
      <TreeTable :value="nodes" selectionMode="single" @nodeSelect="onNodeSelect">
        <Column field="name" header="Название мероприятия" :expander="true"></Column>
        <Column field="icon" header=" "></Column>
        <!--        <Column headerStyle="width: 10rem">-->
        <!--          <template #body>-->
        <!--            <div class="flex flex-wrap gap-2">-->
        <!--              <Button type="button" icon="pi pi-search" rounded/>-->
        <!--              <Button type="button" icon="pi pi-pencil" rounded severity="success"/>-->
        <!--            </div>-->
        <!--          </template>-->
        <!--        </Column>-->
      </TreeTable>
    </div>
  </div>
  <Button label="добавить участника" @click="participant=true"/>
  <Dialog v-model:visible="participant" modal header="Дабавление участия"
          :style="{ width: '50vw' }">
    <AddParticipant :eventId="currentEvent"/>
  </Dialog>
</template>
<style scoped>
.journal {
  margin-top: 50px;
}
</style>