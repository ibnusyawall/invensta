<template>
  <div>
    <div class="container-fluid">
      <Navbar/>
      <Sidebar/>
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <slot name="section-header"/>
              </div>
              <div class="section-body">
                  <slot name="content"/>
              </div>
          </section>
      </div>
      <Footer/>
    </div>
  </div>
</template>

<script>
import Navbar from './../Layouts/NavBar.vue'
import Sidebar from './../Layouts/SideBar.vue'
import Footer from './../Layouts/Footer.vue'

export default {
    data() {
        return {

        }
    },
    components: {
        Navbar,
        Sidebar,
        Footer
    }
}
</script>

