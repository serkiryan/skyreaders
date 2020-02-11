<template>
  <div>
    <h5 class="bg-success text-white p-2">Список читателей и прочитанных книг</h5>
    <form id="export" @submit="exportTo" :action="route" method="post" target="_blank">
    <input type="hidden" name="_token" :value="csrf">
    С: <datepicker v-model="from" name="from"></datepicker>
    По: <datepicker  v-model="to" name="to"></datepicker>
    <button v-on:click="routeTo('xls')" class="btn btn-sm btn-success">Сформировать XLS</button>
    <button v-on:click="routeTo('pdf')" class="btn btn-sm btn-success" target="_blank">Сформировать PDF</button>
    </form>
    <p v-if="errors.length">
    <b>Пожалуйста исправьте указанные ошибки:</b>
    <ul>
      <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
    </ul>
    </p>
  </div>
</template>

<script>
import axios from 'axios';
import route from '../route';
import Datepicker from 'vuejs-datepicker';
    export default {
      components: {
        Datepicker
      },
      data(){
        return{
          errors: '',
          from: '',
          to: '',
          route: '/',
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
      },
      methods: {
        routeTo(f){
          this.route = route(f);
          this.exportTo();
          
        },
        exportTo(e){
          if (this.from && this.to) {
            return true;
          }

          this.errors = [];

          if (!this.from) {
            this.errors.push('Требуется указать начальную дату.');
          }
          if (!this.to) {
            this.errors.push('Требуется указать конечную дату.');
          }
          e.preventDefault();
        }
      },
      mounted() {
      }
    }
</script>
