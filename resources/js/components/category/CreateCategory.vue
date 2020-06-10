<template>
<v-container>
    <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="toggleCreateSave(form.slug)">
        <v-text-field class="mb-3" v-model="form.category" :counter="5" :rules="rules.categoryRules" label="name" required>
        </v-text-field>
        <v-btn :disabled="!valid" :color="colorClass" class="mr-4" type="submit">
            {{ buttonName }}
        </v-btn>
        <v-btn v-if="editingCat" @click="cancelEdit(form.slug)">Cancel</v-btn>
    </v-form>
    
    <v-card max-width="600" class="mx-auto mt-5">
        <v-toolbar color="light-blue" dark>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>
        <v-list v-for="(category, index) in categories" :key="index">
            <v-list-item>
                <v-list-item-content class="ml-5">
                    <v-list-item-title>{{ category.category }}</v-list-item-title>
                </v-list-item-content>

                <v-list-item-action class="d-flex flex-row">
                    <v-btn icon @click="beforEditCategory(index)">
                        <v-icon color="orange lighten-1">mdi-pencil</v-icon>
                    </v-btn>
                        <v-btn icon @click="deleteCategory(category.slug, index)">
                        <v-icon color="red lighten-1">mdi-delete</v-icon>
                    </v-btn>
                </v-list-item-action>
            </v-list-item>

            <v-divider></v-divider>
        </v-list>
    </v-card>

</v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                category: null,
            },
            rules: {
                categoryRules: [
                    v => !!v || 'Category is required',
                    v => (v && v.length >= 5) || 'Category must have at least 5 characters',
                ],
            },
            valid: true,
            categories: {},
            editingCat: false,
        }
    },
    computed: {
        buttonName() {
            return (!this.editingCat) ? 'Create' : 'Save';
        },

        colorClass() {
            return (!this.editingCat) ? 'success' : 'info';
        },
    },

    created() {
        axios.get('/api/categories')
        .then(res => {
            this.categories = res.data.data;
        });
    },

    methods: {
        toggleCreateSave(slug) {
            if (!this.editingCat) {
                this.createCategory();
            } else {
                this.editCategory(slug)
            }
        },

        createCategory () { 
            this.$refs.form.validate();
            axios.post('/api/categories', this.form)
            .then(res => {
                console.log(res.data);
                this.categories.unshift(res.data)
                this.$refs.form.reset();
            })
            .catch(err => console.log(err.response.data))
        },

        cancelEdit(slug) {
            axios.get(`/api/categories/${slug}`)
            .then(res => {
                this.categories.unshift(res.data)
                this.$refs.form.reset()
                this.editingCat = false
            })          
        },
   
        beforEditCategory(index) {
            this.editingCat = true;
            this.form = this.categories[index];
            this.categories.splice(index,1) 
        },

        editCategory(slug) {
            axios.put(`/api/categories/${slug}`, this.form)
            .then(res => {
                this.categories.unshift(res.data)
                this.$refs.form.reset()
                this.editingCat = false
            })
            .catch(err => console.log(err.response.data))
        },

        deleteCategory(slug, index) {
            if (confirm('Are you sure!')) {
                axios.delete(`/api/categories/${slug}`)
                .then(res => {
                    console.log(res.data)
                    this.categories.splice(index,1)
                })
                .catch(err => console.log(err.reponse.data))
            }
        }
    }
}

</script>

<style>

</style>