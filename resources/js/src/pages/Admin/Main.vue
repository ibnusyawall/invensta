<template>
  <div class="row">
    <div class="col">
      <h1>
        <span>Selamat Datang di Halaman Admin</span>
      </h1>
      {{ user }} {{ brand }}
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex"
  export default {
    data() {
      return {
           //
     }
    },
    computed: {
      ...mapState({
        brand: state => state.brand,
        user: state => state.user
      }),
    },
  }
   </script>
   <style>
   </style>
