<template>
    <v-container fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">

              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Please Login to Proceed</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>

              <v-card-text>
                
                <v-form @submit.prevent="login">
                    <v-text-field label="Email" prepend-icon="mdi-email" type="email" v-model="form.email" required>
                    </v-text-field>

                    <v-text-field label="Password" prepend-icon="mdi-lock" type="password" v-model="form.password" required> 
                    </v-text-field>

                    <div class="d-flex justify-content-between">
                      <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="primary" type="submit">Login</v-btn>
                      </v-card-actions>
                    
                        <v-card-actions>
                          <router-link to="/signup">
                            <v-btn color="info">SignUp</v-btn>
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
                  email: null,
                  password: null,
              }
          }
      },
      created() {
        if (User.loggedIn()) {
            this.$router.push({name: 'forum'});
        }
      },
      methods: {
          login() {
              User.login(this.form);
              window.location = '/forum';
          }
      }
  }
</script>

<style>

</style>