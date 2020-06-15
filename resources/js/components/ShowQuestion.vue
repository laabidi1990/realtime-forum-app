<template>
  <v-card class="mx-auto" color="#51B0FF" dark max-width="85%">
    <v-card-title>
      <div class=" d-flex flex-column">
          <div>
            <v-icon large left>
                mdi-calendar-question
            </v-icon>
            <span class="headline font-weight-normal">
                {{ question.title }}
            </span>
          </div>
          <small class="text-muted">Asked {{ question.creation_date }}</small>
      </div>
    </v-card-title>

    <v-card-text class="title font-weight-light mx-5 my-1">
      {{ question.body }}
    </v-card-text>

    <v-card-actions>
      <v-list-item class="grow">
        <v-list-item-avatar color="grey darken-3">
          <v-img class="elevation-6" src=""></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title class="text-muted">{{ question.writer }}</v-list-item-title>
        </v-list-item-content>

        
        <v-row align="center" justify="center" v-if="authUser">
          <v-btn class="mr-3 text-danger" color="transparent" @click="deleteQuestion">
            <v-icon class="mr-1">mdi-delete</v-icon>
          </v-btn>
          <v-btn class="text-warning" color="transparent" @click="edit">
            <v-icon class="mr-1">mdi-update</v-icon>
          </v-btn>
        </v-row>

        <v-row align="center" justify="end">
            <v-icon class="mr-2 pt-1">mdi-message</v-icon>
            <span class="subheading mr-2"><strong>{{ question.replies_count}}</strong></span>
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
    data() {
      return {
        question: this.question,
        beforeEditCache: {
          cachedTitle: this.question.title,
          cachedBody: this.question.body,
        }
      }
    },
    computed: {
      authUser() {
        return User.id() === this.question.user_id
      }
    },
    created() {
      this.listen()
    },
    methods: {
      deleteQuestion() {
        if (this.authUser) {
          if (confirm('Are you sure!')) {
              axios.delete(`/api/questions/${this.question.slug}`)
                .then(res => { 
                  this.$router.push('/forum');
              })
          }
        }
      },
      edit() {
        EventBus.$emit('startEditing');
      },
      listen() {
        EventBus.$on('cancelEditing', () => {
          this.question.title = this.beforeEditCache.cachedTitle
          this.question.body = this.beforeEditCache.cachedBody
        })
      }
    },
}
</script>

<style>

</style>