<template>
    <div v-if="question">
        <edit-question v-if="editing" :question=question></edit-question>
        <show-question v-else :question=question></show-question>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion';
import EditQuestion from './EditQuestion';

export default {
    components: {
        ShowQuestion,
        EditQuestion,
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
            })
        }
    },
}
</script>

<style>

</style>