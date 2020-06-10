<template>
  <v-container class="grey lighten-5">
    <v-row>
      <v-col cols="4" md="3" sm="6">
          <app-sidebar>
          </app-sidebar>
      </v-col>
      <v-col cols="12" md="9" sm="6">
        <v-card class="pa-1" tile>
          <question v-for="question in questions" :key="question.index" :question=question class="mb-5">
          </question>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Question from './Question';
import AppSidebar from './AppSidebar';

export default {
  components: {
    Question,
    AppSidebar,
  },
  data() {
        return {
            questions: {},
        }
  },
  created() {
        axios.get('/api/questions')
        .then(res => {
            this.questions = res.data.data
        })
        .catch(err => console.log(err.response.data));
  }
}
</script>

<style>

</style>