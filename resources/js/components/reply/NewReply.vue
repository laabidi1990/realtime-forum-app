<template>
   <v-container>
        <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="addReply">

            <v-textarea v-model="body" :counter="5" :rules="rules.bodyRules" label="Reply Here" outlined required>
            </v-textarea>

            <!-- <vue-simplemde v-model="description" ref="markdownEditor" /> -->

            <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
                Reply
            </v-btn>

        </v-form>
   </v-container>

</template>

<script>
  export default {
      props: [
          'slug'
      ],
    data() {
        return {
            body: null,
            rules: {        
                bodyRules: [
                    v => !!v || 'This field cannot be empty',
                    v => (v && v.length >= 5) || 'Title must have at least 5 characters',
                ],
            },
            valid: true,
        }
    },
    created() {
        // axios.get('/api/categories')
        // .then(res => {
        //     this.categories = res.data.data;
        // });
    },
    methods: {
      addReply () { 
        this.$refs.form.validate();
        axios.post(`/api/questions/${this.slug}/replies`, {body: this.body})
        .then(res => {
            console.log(res.data);
            EventBus.$emit('newReply', res.data);
            this.$refs.form.reset();
            window.scrollTo(0,0);
        })
        .catch(err => console.log(err.response.data))
      
      },
    },
  }
</script>