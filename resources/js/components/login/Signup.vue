<template>
    <v-container fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">

              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Create a new Account</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>

              <v-card-text>

                <v-form @submit.prevent="register">
                    <v-text-field label="Name *" prepend-icon="mdi-account" type="text" v-model="form.name" required>
                    </v-text-field>
                     <small class="red--text badge" v-if="errors.name">{{errors.name[0]}}</small>

                    <v-text-field label="Email *" prepend-icon="mdi-email" type="email" v-model="form.email" required>
                    </v-text-field>
                    <small class="red--text badge" v-if="errors.email">{{errors.email[0]}}</small>

                    <v-text-field label="Password *" prepend-icon="mdi-lock" type="password" v-model="form.password" required> 
                    </v-text-field>
                    <small class="red--text badge" v-if="errors.password">{{errors.password[0]}}</small>

                    <v-text-field label="Confirm Password *" prepend-icon="mdi-lock" type="password" v-model="form.password_confirmation" required> 
                    </v-text-field>

                    <div class="d-flex justify-content-between">
                      <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="primary" type="submit">Register</v-btn>
                      </v-card-actions>
                  
                      <v-card-actions>
                        <router-link to="/login">
                          <v-btn color="info">Login</v-btn>
                        </router-link>
                      </v-card-actions>
                    </div>

                </v-form>
              </v-card-text>

            </v-card>
          </v-col>
        </v-row>
    </v-container>
</template>

<script>
  export default {
      data() {
          return {
              form: {
                  name: null,
                  email: null,
                  password: null,
                  password_confirmation: null,
              },
              errors: {}
          }
      },
      created() {
        if (User.loggedIn()) {
            this.$router.push({name: 'forum'});
        }
      },
      methods: {
        register() {
        axios.post('/api/auth/signup', this.form)
        .then( res => {
            User.responseAfterLogin(res);
            this.form = {};
            this.$router.push({name: 'forum'});
        })
        .catch( err => {
            this.errors = err.response.data.errors;
            console.log(this.errors);
        })
    }
      }
  }
</script>

<style scoped>

  small {
    display: block;
    margin: -10px 0px 15px 30px;
    text-align: left;
  }

</style>