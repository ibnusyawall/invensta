<template>
  <div>
      <Navbar/>
            <template >

            </template>
            <router-view></router-view>
      <Sidebar/>
  </div>
</template>

<script>
import Navbar from './../Layouts/NavBar.vue'
import Sidebar from './../Layouts/SideBar.vue'

export default {
    data() {
        return {

        }
    },
    components: {
        Navbar,
        Sidebar
    }
}
</script>

