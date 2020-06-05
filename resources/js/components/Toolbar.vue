
<template>
  <v-card color="grey lighten-4" flat height="100px" tile>
    <v-toolbar dense>
      <v-toolbar-title>Realtime Forum</v-toolbar-title>

      <v-spacer></v-spacer>

        <router-link to="/">
            <v-btn class="ma-5" tile color="indigo" dark>Forum</v-btn>
        </router-link>
        <router-link to="/">
          <v-btn class="ma-2" tile outlined color="indigo">Ask a Question</v-btn>
        </router-link>
        <router-link to="/login">
            <v-btn class="ma-5" tile outlined color="indigo">Login</v-btn>
        </router-link>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

    </v-toolbar>
  </v-card>
      
</template>

<script>
  export default {

  }
</script>
