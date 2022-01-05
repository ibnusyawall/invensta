<template>
  <div>
      <template >
      </template>
      <router-view :brand="brand"></router-view>
  </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        computed: {
            ...mapState({
                brand: state => state.brand
            }),
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
