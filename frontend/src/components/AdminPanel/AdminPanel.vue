<template>
  <div class="adminPanel">
      <router-link v-for="item in linkData" :key="item.index" :to="item.link">
        <div class='wrapper' >
          <h1>{{ item.title }}</h1>
          <p>{{ item.description }}</p>
        </div>
      </router-link>
  </div>
</template>

<script>
export default {
  name: 'AdminPanel',
  data() {
    return {
      linkData: [
        // {
        //   title: 'Главное меню',
        //   description:'Навигация приложения',
        //   link: '/adminPanel'
        // },
        {
          title: 'Мероприятия',
          description:'Изменение информации о мероприятиях',
          link: '/events'
        },
        {
          title: 'Студенты',
          description:'Изменение информации о студентах',
          link: '/students'
        },
        {
          title: 'Журнал',
          description:'Ведение сведений об участии студентов в мероприятиях',
          link: '/journal'
        },
        {
          title: 'Рейтинг',
          description:'Список студентов',
          link: '/score'
        },
        {
          title: 'Редактор модели',
          description:'Изменение работы метода',
          link: '/model'
        },
        {
          title: 'Справка',
          description:'Справка приложения',
          link: '/helpPanel'
        },
        {
          title: 'Справочник',
          description:'Изменение справочных данных',
          link: '/guide'
        },
      ]
    }
  }
}
</script>

<style>
.adminPanel{
  padding: 50px;
  display:flex;
  gap:60px;
  justify-content: space-around;
  flex-wrap:wrap;
}
.title {
  text-align: center;
}

.title h1 {
  font-weight: bold;
  font-size: 32px;
  margin: 50px 0;
}

.itemList {
  display: flex;
  justify-content: space-around;
  margin-top: 200px;
}

.wrapper {
  width: 200px;
  height: 200px;
  background-color: white;
  box-shadow: 7px 7px 14px 0px grey;
  text-decoration: none;
  color: black;
  padding: 20px;
  border-radius: 5px;
  transition: 0.5s;
}

.wrapper:hover {
  cursor: pointer;
  scale: 1.2;
  box-shadow: 15px 15px 14px 0px grey;
  border: 1px solid #f3f3f3;
}

.wrapper h1 {
  font-weight: bold;
  font-size: 24px;
}

.wrapper p {
  font-size: 16px;
  margin-top: 20px;
  color: grey;
}
a:hover{
  text-decoration: none;
}
</style>