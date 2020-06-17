<template>
   <v-container>
        <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="createQuestion">
            <v-text-field class="mb-3" v-model="form.title" :counter="5" :rules="rules.titleRules" label="Title" required>
            </v-text-field>

            <v-textarea class="mb-3" v-model="form.body" :counter="20" :rules="rules.descriptionRules" label="Description" outlined required>
            </v-textarea>

            <!-- <vue-simplemde v-model="description" ref="markdownEditor" /> -->

            <v-select class="mb-5" v-model="form.category_id" item-value="id" item-text="category" :items="categories" :rules="[v => !!v || 'Category is required']" label="Categories" required>
            </v-select>

            <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
                Create
            </v-btn>

            <v-btn color="error" class="mr-4" type="reset" @click="reset">
                Reset
            </v-btn>
        </v-form>
   </v-container>

</template>

<script>
  export default {
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
                    v => !!v || 'Descritpion is required',
                    v => (v && v.length >= 20) || 'Title must have at least 10 characters',
                ],
            },
            valid: true,
            categories: [],
        }
    },
    created() {
        axios.get('/api/categories')
        .then(res => {
            this.categories = res.data.data;
        });
    },
    methods: {
      createQuestion () { 
        this.$refs.form.validate();
        axios.post('/api/questions', this.form)
        .then(res => {
            this.$router.push(res.data.path);
            this.$refs.form.reset();
        })
        .catch(err => console.log(err.response.data))
      
      },
      reset() {
          this.$refs.form.reset();
      },
    },
  }
</script>