<template>
<div>
  <toolbar></toolbar>
  <router-view></router-view>
  <app-footer></app-footer>
</div>

</template>

<script>
import toolbar from './Toolbar';
import AppFooter from './AppFooter';
import login from './login/Login';

export default {
    components: {
        toolbar,
        AppFooter,
        login
    }
}
</script>

<style>
 
</style>