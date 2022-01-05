<template>
  <div>
      <template >
      </template>
      <router-view :brand="brand" :user="get_user" :token="token"></router-view>
  </div>
</template>

<script>
    import { mapState, mapGetters } from 'vuex'
    export default {
        computed: {
            ...mapState({
                brand: state => state.brand,
                user: state => state.auth.user,
                token: state => state.auth.token
            }),
            ...mapGetters(['get_user'])
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
