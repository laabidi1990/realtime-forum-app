<template>
<div>
   <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="updateReply" v-if="editing">
        <v-textarea :counter="5" v-model="body" :rules="bodyRules" label="Edit Reply Here" outlined required>
        </v-textarea>

        <!-- <vue-simplemde v-model="description" ref="markdownEditor" /> -->

        <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
            Save
        </v-btn>
        <v-btn color="secondary" @click="cancel">
            Cancel
        </v-btn>
    </v-form>
    <v-card class="my-5" v-else>

        <v-card-text>
            {{ reply.reply }}
        </v-card-text>

        <v-card-actions>
            <v-list-item class="grow">

                <v-list-item-content class="mt-3">
                    {{ reply.replier }}
                </v-list-item-content>

                
                <v-row align="center" justify="center" v-if="authUser(reply.replier_id)">
                <v-btn class="mr-3 text-danger" color="transparent" @click="deleteReply()" small>
                    <v-icon class="mr-1">mdi-delete</v-icon>
                </v-btn>
                <v-btn class="text-warning" color="transparent" @click="editReply()" small>
                    <v-icon class="mr-1">mdi-update</v-icon>
                </v-btn>
                </v-row>

                <v-row align="center" justify="end">
                    <like :reply=reply></like>
                </v-row>
            </v-list-item>
        </v-card-actions>
        
    </v-card>
</div>
 
</template>

<script>
import Like from '../like/Like';

export default {
    components: {
        Like
    },
    props: [
        'reply',
        'index',
    ],
    data() {
        return {
            editing: false,
            body: this.reply.reply,
            beforeEditCache: null,
            bodyRules: [
                v => !!v || 'This field cannot be empty',
                v => (v && v.length >= 5) || 'Title must have at least 5 characters',
            ],
            valid: true,
        }
    },
    methods: {
        authUser(id) {
            return User.id() === id
        },
        editReply() {
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        deleteReply() {
            if (confirm('Are you sure!')) {
                axios.delete(`/api/questions/${this.reply.question_slug}/replies/${this.reply.id}`)
                    .then(res => { 
                        EventBus.$emit('deletedReply', this.index)
                    })
                    .catch(err => console.log(err.response.data))
            }
        },
        updateReply() {
            axios.patch(`/api/questions/${this.reply.question_slug}/replies/${this.reply.id}`, {body: this.body})
                .then(res => { 
                    this.body = res.data.reply
                    this.editing = false;
                    EventBus.$emit('editedReply', this.index, res.data)
                })
                .catch(err => console.log(err.response.data));
        },
        cancel() {
            this.editing = false;
            this.body = this.beforeEditCache;
        }
    }
}
</script>

<style>

</style>