<template>
  <v-card class="mx-auto" color="#51B0FF" dark max-width="1200">
    <v-card-title>
      <div class=" d-flex flex-column">
          <div>
            <v-icon large left>
                mdi-calendar-question
            </v-icon>
            <span class="title font-weight-normal">
                {{ question.title }}
            </span>
          </div>
          <small class="text-muted">Asked {{ question.creation_date }}</small>
      </div>
    </v-card-title>

    <v-card-text class="headline font-weight-light">
      {{ question.body }}
    </v-card-text>

    <v-card-actions>
      <v-list-item class="grow">
        <v-list-item-avatar color="grey darken-3">
          <v-img class="elevation-6" src=""></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>{{ question.writer }}</v-list-item-title>
        </v-list-item-content>

        
        <v-row align="center" justify="center" v-if="authUser">
          <v-btn class="mr-3 text-danger" color="transparent" @click="deleteQuestion">
            <v-icon class="mr-1" large>mdi-delete</v-icon>
          </v-btn>
          <v-btn class="text-warning" color="transparent" @click="edit">
            <v-icon class="mr-1" large>mdi-update</v-icon>
          </v-btn>
        </v-row>

        <v-row align="center" justify="end">
          <v-icon class="mr-1">mdi-reply</v-icon>
          <span class="subheading mr-2">256</span>
        </v-row>
      </v-list-item>
    </v-card-actions>

  </v-card>
</template>

<script>
export default {
    props: [
        'question',
    ],
    computed: {
      authUser() {
        return User.id() === this.question.user_id
      }
    },
    methods: {
      deleteQuestion() {
        if (this.authUser) {
          if (confirm('Are you sure!')) {
              axios.delete(`/api/questions/${this.question.slug}`)
                .then(res => { 
                  console.log(res.data.data);
                  this.$router.push('/forum')
              })
          }
        }
      },
      edit() {
        EventBus.$emit('startEditing');
      }
    },
}
</script>

<style>

</style>