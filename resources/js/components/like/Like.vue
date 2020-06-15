<template>
    <div>
        <v-btn icon @click="like" >
            <v-icon :color="color">mdi-heart</v-icon>
        </v-btn>
        <span>{{ count }}</span>
    </div>
</template>

<script>
export default {
    props: [
        'reply'
    ],
    data() {
        return {
            count: this.reply.likes_count,
            liked: this.reply.liked,
        }
    },
    computed: {
        color() {
            return this.liked ? 'red' : 'red lighten-4'
        }
    },
    methods: {
        like() {
            if(User.loggedIn()) {
                this.liked ? this.unlike() : this.likeIt() ;
            }
        },
        unlike() {
            axios.delete(`/api/replies/${this.reply.id}/dislike`)
            .then( res => {
                this.liked = res.data.liked;
                this.count--;
            })
        },
        likeIt() {
            axios.post(`/api/replies/${this.reply.id}/like`)
            .then( res => {
                this.liked = res.data.liked;
                this.count++;
            })
        }

    }
}
</script>

<style scoped>
    v-icon {
        cursor: pointer;
    }
</style>