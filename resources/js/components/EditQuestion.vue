<template>
   <v-container>
        <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="editQuestion">
            <v-text-field class="mb-3" v-model="form.title" :counter="5" :rules="rules.titleRules" label="Title" required>
            </v-text-field>

            <v-textarea class="mb-3" v-model="form.body" :counter="10" :rules="rules.descriptionRules" label="Description" outlined required>
            </v-textarea>

            <!-- <vue-simplemde v-model="description" ref="markdownEditor" /> -->

            <v-select class="mb-5" v-model="form.category_id" item-value="id" item-text="category" :items="categories" :rules="[v => !!v || 'Category is required']" label="Categories" required>
            </v-select>

            <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
                Save
            </v-btn>

            <v-btn color="error" class="mr-4" type="reset" @click="cancel">
                Cancel
            </v-btn>
        </v-form>
   </v-container>

</template>

<script>
  export default {
    props: [
        'question',
    ],

    data() {
        return {
            form: {
                title: null,
                body: null,
                category_id: null,
            },
            rules: {
                titleRules: [
                    v => !!v || 'Title is required',
                    v => (v && v.length >= 5) || 'Title must have at least 5 characters',
                ],
                     
                descriptionRules: [
                    v => !!v || 'Description is required',
                    v => (v && v.length >= 10) || 'Title must have at least 10 characters',
                ],
            },
            valid: true,
            categories: [], 
        }
    },

    mounted() {
        this.form = this.question; 
    },

    created() {
        axios.get('/api/categories')
        .then(res => {
            this.categories = res.data.data;
        });
    },
    methods: {
      editQuestion () { 
        this.$refs.form.validate();
        axios.patch(`/api/questions/${this.question.slug}`, this.form)
        .then(res => {
            EventBus.$emit('editFinished');
            this.$router.push(`/questions/${res.data.slug}`);
        })
        .catch(err => console.log(err.response.data))
      },

      cancel() {
          EventBus.$emit('cancelEditing');
      },
    },
  }
</script>