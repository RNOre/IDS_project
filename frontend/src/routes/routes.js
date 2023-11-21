import AuthPage from "../components/AuthPage.vue";
import AdminPanel from "../components/AdminPanel/AdminPanel.vue";
import {createRouter, createWebHistory} from "vue-router";
import ReportItem from "../components/AdminPanel/ReportItem/ReportItem.vue";
import StudentsItem from "../components/AdminPanel/DataItem/StudentsItem.vue";
import ModelEditor from "../components/AdminPanel/DataItem/ModelEditor.vue";
import ScoreItem from "../components/AdminPanel/DataItem/ScoreItem.vue";
import EventsItem from "../components/AdminPanel/DataItem/EventsItem.vue";
import JournalItem from "../components/AdminPanel/DataItem/JournalItem.vue";
import TestItem from "../components/AdminPanel/ReportItem/testItem.vue";
import GuideItem from "../components/AdminPanel/GuideItem.vue";


const routes = [
    {path: '/', component: AuthPage},
    {path: '/adminPanel', component: AdminPanel},
    {path: '/students', component: StudentsItem},
    {path: '/events', component: EventsItem},
    {path: '/journal', component: JournalItem},
    {path: '/score', component: ScoreItem},
    {path: '/model', component: ModelEditor},
    {path: '/helpPanel', component: ReportItem},
    {path: '/test', component: TestItem},
    {path: '/guide', component: GuideItem},
]

export const router = createRouter({
    routes,
    history: createWebHistory()
})