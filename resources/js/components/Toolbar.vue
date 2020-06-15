
<template>
  <v-card color="grey lighten-4" flat height="100px">
    <v-toolbar dense>
      <v-toolbar-title>Realtime Forum</v-toolbar-title>

      <v-spacer></v-spacer>
        <notifications></notifications>
        <router-link v-for="item in items" :key="item.title" :to="item.to" v-show="item.show">
            <v-btn class="ma-5" tile outlined color="indigo">{{ item.title }}</v-btn>
        </router-link>

    </v-toolbar>
  </v-card>
      
</template>

<script>
import Notifications from './notifications/Notifications'

  export default {
    components: {
      Notifications
    },
    data() {
      return {
        items: [
          { to: '/forum', title: 'Forum', show: true },
          { to: '/ask-question', title: 'Ask-Question', show: User.loggedIn() },
          { to: '/category', title: 'Category', show: User.loggedIn() },
          { to: '/login', title: 'Login', show: !User.loggedIn() },
          { to: '/logout', title: 'Logout', show: User.loggedIn() },
        ]
      }
    },
    created() {
      EventBus.$on('logout', () => {
        User.logOut();
        window.location = '/forum';
      })
    }
  }
</script>

<style>

</style>
