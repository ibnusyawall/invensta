<template>
  <div>
      <template >
{{ user }}
      </template>
      <router-view></router-view>
  </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapGetters(['isLoggedIn','user'])
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
