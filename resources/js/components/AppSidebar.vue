<template>
  <v-card class="mx-auto" max-width="300" tile>
    <v-list shaped>
      <v-subheader class="font-weight-bold">Categories</v-subheader>
      <v-list-item-group v-model="item" color="primary">
        <v-list-item v-for="(item, i) in items" :key="i">
          <v-list-item-content>
            <v-list-item-title v-text="item.category"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
        item: null,
        items: [],
    }),
    created() {
        axios.get('/api/categories')
        .then(res => {
            this.items = res.data.data;
        });
    },
  }
</script>

<style>

</style>