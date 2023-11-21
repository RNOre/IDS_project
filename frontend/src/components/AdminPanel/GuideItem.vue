<script>
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import {mapState} from "vuex";
import Divider from "primevue/divider";

export default {


  name: 'GuideItem',
  components: {
    TabView,
    TabPanel,
    Divider
  },
  data() {
    return {
      items: [
        {label: 'Dashboard', icon: 'pi pi-home'},
        {label: 'Transactions', icon: 'pi pi-chart-line'},
        {label: 'Products', icon: 'pi pi-list'},
        {label: 'Messages', icon: 'pi pi-inbox'}
      ]
    }
  },
  created() {
    this.$store.dispatch('getGroups');
    this.$store.dispatch('getType');
    this.$store.dispatch('educInst');
  },
  computed: {
    ...mapState({
      groupData: state => state.students.groups,
      typeOfEvent: state => state.events.typeOfEvent,
      educInst: state => state.events.educInst,
    })
  },
  methods:{
    test(){
      console.log(this.educInst);
    }
  }
}
</script>
<template>
  <div>
    <TabView>
      <TabPanel header="Группы">
        <div v-for="item in groupData" :key="item.id">
          <div class="item">
            <div>
              {{ item.name }}
            </div>
            <Button icon="pi pi-pencil" severity="warning" text rounded aria-label="test"
            />
            <Button icon="pi pi-trash" severity="danger" text rounded aria-label="test"
            />
          </div>

          <Divider/>
        </div>
        <div class="plus">
          <Button icon="pi pi-plus"  severity="success"  rounded aria-label="test"  />
        </div>
      </TabPanel>
      <TabPanel header="Вид индивидуального достижения">
        <div v-for="item in typeOfEvent" :key="item.id">
          <div class="item">
            <div>
              {{ item.name }}
            </div>
            <Button icon="pi pi-pencil" severity="warning" text rounded aria-label="test"
            />
            <Button icon="pi pi-trash" severity="danger" text rounded aria-label="test" @click="test"
            />
          </div>
          <Divider/>
        </div>
        <div class="plus">
          <Button icon="pi pi-plus"  severity="success"  rounded aria-label="test"  />
        </div>
      </TabPanel>
      <TabPanel header="Место проведения" @click="test">
        <div v-for="item in educInst" :key="item.id">
          <div class="item">
            <div>
              {{ item.name }}
            </div>
            <Button icon="pi pi-pencil" severity="warning" text rounded aria-label="test"
            />
            <Button icon="pi pi-trash" severity="danger" text rounded aria-label="test"
            />
          </div>

          <Divider/>
        </div>
        <div class="plus">
          <Button icon="pi pi-plus"  severity="success"  rounded aria-label="test"  />
        </div>
      </TabPanel>
    </TabView>
  </div>
</template>
<style scoped>
.item {
  display: flex;
  justify-content:space-around;
  align-items:center
}
.plus{
  display:flex;
  justify-content:center;
  align-items:center;
}
</style>