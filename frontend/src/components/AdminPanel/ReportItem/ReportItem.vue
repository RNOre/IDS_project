<script>
import {ref} from 'vue';
import Chart from 'primevue/chart';
import InputText from 'primevue/inputtext';
import {andRules, defuzzification, determineSample, fuzzification} from "../../../service/fuzzy/fuzzy.js";
import Score from "./Score.vue";
import Dialog from 'primevue/dialog';
import OrganizationChart from "primevue/organizationchart";
import {mapState} from "vuex";
import Rules from "./Rules.vue";
import Result from "./Result.vue";

export default {
  name: 'ReportItem',
  components: {},
}
</script>
<template>
  <div class="report">
    <h2>Назначение программной системы</h2>
    <p>ПИС предназначена для автоиатизации оценки индивидуальных достижений студентов университета.</p>
    <br/>
    <p>
      Основной задачей разработанного проммного средства является хранение и обработка информации о студентах, мероприятиях
       (уровень, категории участия), успеваемости, индивидуальных баллах, итоговом балле индивидуальных достижений.
      <br/>
      Программное средство предоставляет слудующую информацию:
    </p>
    <ul>
      <li>отчеты по рейтингу обучающихся;</li>
      <li>графическую интерпритацию полученных результатов;</li>
      <li>рекомендации по поощрению обучающихся.</li>
    </ul>
    <p>ПИС «ИДС» позволяет:</p>
    <ul>
      <li>обеспечить автоматизацию процесса оценки индивидуальных
        достижений студентов;</li>
      <li>повысить время обработки заявок от студентов;</li>
      <li>повысить эффективность анализа индивидуальных достижений.</li>
    </ul>
    <br/>
    <h2>Условия выполнения программной системы</h2>
    <p>Для успешной работы программной системы необходимо наличие
      следующей минимальной конфигурации аппаратного и программного
      обеспечения:</p>
    <ul>
      <li>процессор Core2Duo выше;</li>
      <li>тактовая частота процессора 2,5Ггц и выше;</li>
      <li>свободное пространство на жёстком диске не менее 300 Гб плюс
        размер файла базы данных;</li>
      <li>мышь, клавиатура.</li>
    </ul>
  </div>

</template>
<style scoped>
 .report{
   padding:50px;
   text-align: justify;
 }
</style>