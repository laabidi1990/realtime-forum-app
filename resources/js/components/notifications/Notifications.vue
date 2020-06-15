<template>
  <div class="text-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-tab class="mr-5">
            <v-btn icon class="ml-5 pt-2" color="red" v-bind="attrs" v-on="on">
                <v-icon>mdi-bell</v-icon>
            </v-btn>
            <v-badge color="red" :content="unreadCount">
            </v-badge>
        </v-tab>
      </template>
      <v-list class="px-5">
        <v-list-item v-for="(item, index) in unread" :key="item.id">
          <router-link :to="item.path">
            <v-list-item-title @click="markRead(item)">{{ item.question }}</v-list-item-title>
          </router-link>
        </v-list-item>
        <v-list-item v-for="(item, index) in read" :key="item.id">
            <v-list-item-title>{{ item.question }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
  export default {
    data: () => ({
      read: {},
      unread: {},
      unreadCount: 0,  
    }),
    created() {
        if (User.loggedIn()) {
            this.getNotifications()
        }
    },
    computed: {
 
    },
    methods: {
        getNotifications() {
            axios.post('/api/notifications')
            .then(res => {
                this.read = res.data.read;
                this.unread = res.data.unread;
                this.unreadCount = res.data.unread.length;
            })
            .catch(err => console.log(err.response.data));
        },
        markRead(notification) {
          axios.post(`/api/notifications/mark-read`, {id: notification.id})
          .then(res => {
            this.unread.splice(notification, 1);
            this.read.push(notification);
            this.unreadCount--;
          })
        }
    }
  }
</script>

<style scoped>

</style>