<script>
import Sidebar from 'primevue/sidebar';
import {ref} from "vue";

export default {
  name: 'App',
  components:
      {Sidebar,},
  methods:{
    routeHandle(title){
      this.currentPage=title
      this.visible=false;
    },
    logout() {
      this.$router.push('/');
    },
  },
  data() {
    return {
      visible: ref(false),
      currentPage:'',
      linkData: [
        // {
        //   title: 'Главное меню',
        //   link: '/adminPanel'
        // },
        {
          title: 'Мероприятия',
          link: '/events'
        },
        {
          title: 'Студенты',
          link: '/students'
        },
        {
          title: 'Журнал',
          link: '/journal'
        },
        {
          title: 'Рейтинг',
          link: '/score'
        },
        {
          title: 'Редактор модели',
          link: '/model'
        },
        {
          title: 'Справка',
          link: '/helpPanel'
        },
        {
          title: 'Справочник',
          link: '/guide'
        },
      ]
    }
  },
}
</script>
<template>
  <div>
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary header">
      <div class="container-fluid">
        <Button icon="pi pi-align-justify" @click="visible = true"/>
        <h1 style="color: slateblue">{{ currentPage }}</h1>
        <div class="userIcon">
          <i class="pi pi-user userIcon" style="color: slateblue; font-size: 2rem" @click="logout"></i>
        </div>
      </div>
    </nav>
    <Sidebar v-model:visible="visible">
      <router-link v-for="linkItem in linkData" :to="linkItem.link" :key="linkItem.title">
        <h2 class="linkItem" @click="routeHandle(linkItem.title)" >{{linkItem.title}}</h2>
      </router-link>
    </Sidebar>
  </div>
  <div class="body">
    <router-view></router-view>
  </div>

</template>

<style scoped>
.header {
  background-color: white;
  padding: 15px;
  margin-bottom: 50px;
}
.body{
  padding: 10px 100px;
  background-color: white;
  border-radius: 12px;
  width:80%;
  margin: auto;
}
.linkItem{
  color:slateblue
}
.userIcon :hover{
  cursor:pointer;
}
</style>
