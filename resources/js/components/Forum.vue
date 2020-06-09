<template>
  <v-container fluid class="grey lighten-5">
    <v-row>
      <v-col cols="12" sm="6" md="8">
        <v-card class="pa-1" tile>
          <question v-for="question in questions" :key="question.index" :question=question class="mb-5">
          </question>
        </v-card>
      </v-col>
      <v-col cols="6" md="4">
        <v-card class="pa-2" outlined tile>
          CATEGORIES
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Question from './Question';

export default {
  components: {
    Question
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