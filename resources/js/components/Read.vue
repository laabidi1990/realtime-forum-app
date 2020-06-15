<template>
    <div v-if="question">
        <edit-question v-if="editing" :question='question'></edit-question>
        <show-question v-else :question='question'></show-question>
        <replies :replies='question.replies' :slug='question.slug'></replies>
        <new-reply :slug='question.slug'></new-reply>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';
import Replies from './reply/replies';
import NewReply from './reply/NewReply';

export default {
    components: {
        ShowQuestion,
        EditQuestion,
        Replies,
        NewReply,
    },
    data() {
        return {
            question: null,
            editing: false,
        }
    },
    created() {
        this.getQuestions();
        this.listen();
    },
    methods: {
        getQuestions() {
            axios.get(`/api/questions/${this.$route.params.slug}`)
            .then(res => {
                this.question = res.data.data;
            })
            .catch(err => console.log(err.response.data));
        },
        listen() {
            EventBus.$on('startEditing', () => {
                this.editing = true;
            }),
            EventBus.$on('cancelEditing', () => {
                this.editing = false;
            }),
            EventBus.$on('editFinished', () => {
                this.editing = false;
            })
        }
    },
}
</script>

<style>

</style>