<template>
  <v-container class="mt-5">
      <div v-for="(reply, index) in replies" :key="index" >
            <reply :reply=reply :index=index></reply>
      </div>
  </v-container>
</template>

<script>
import Reply from './Reply';

export default {
    components: {
        'reply': Reply
    },
    props: [
        'replies',
        'slug',
    ],
    data() {
        return {
            newReplies: this.replies,
        }
    },
    created() {
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on('newReply', (reply) => {
                this.newReplies.unshift(reply)
            })

            EventBus.$on('deletedReply', (index) => {
                this.newReplies.splice(index, 1)
            })

            EventBus.$on('editedReply', (index, reply) => {
                this.newReplies.splice(index, 1, reply)
            })

            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                    this.newReplies.forEach(reply => {
                        if (reply.id === e.id) {
                            this.newReplies.splice(reply, 1);
                        }
                    });
                });

            Echo.channel('NewReply')
                .listen('NewReplyEvent', (e) => {
                   this.newReplies.unshift(e.reply)
                });

            
        },
    }
}
</script>

<style>

</style>