
<template>
  <router-link :to="question.path" tag="v-card">
  <v-card class="mx-auto" color="#51B0FF" dark max-width="auto">
 
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

        <v-row align="center" justify="end">
          <v-icon class="mr-2 pt-1">mdi-message</v-icon>
          <span class="subheading mr-2"><strong>{{ question.replies_count}}</strong></span>
        </v-row>
      </v-list-item>
    </v-card-actions>

  </v-card>
  </router-link>
</template>

<script>
export default {
    props: [
        'question',
    ]
}
</script>

<style>
    small {
        margin-left: 3em;
    }
</style>