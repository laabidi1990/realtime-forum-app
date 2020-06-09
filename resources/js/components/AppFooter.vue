<template>
  <v-footer color="primary lighten-1" padless>
    <v-row justify="center" no-gutters>

      <v-btn v-for="link in links" :key="link" color="white" text rounded class="my-2">
        {{ link }}
      </v-btn>

      <v-col class="py-4 text-center white--text" cols="12">
        {{ new Date().getFullYear() }} — <strong>Realtime-Forum</strong>
      </v-col>
      
    </v-row>
  </v-footer>
</template>

<script>
  export default {
    data: () => ({
      links: [
        'Home',
        'About Us', 
        'Contact Us',
      ],
    }),
  }
</script>