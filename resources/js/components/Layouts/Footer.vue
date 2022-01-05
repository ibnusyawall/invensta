<template>
    <div>
        <!-- Bottom Nav Bar -->
      <footer class="footer fixed-bottom p-0 text-center pb-2">
         <div id="buttonGroup" class="btn-group selectors" role="group" aria-label="Basic example">
            <router-link to="/dashboard" class="btn btn-light button-active">
               <div class="selector-holder text-center">
                  <i class="material-icons">home</i>
                  <span class="d-block">Home</span>
               </div>
            </router-link>
            <router-link to="/test" class="btn btn-light button-inactive">
               <div class="selector-holder text-center ">
                  <i class="material-icons">view_list</i>
                  <span class="d-block">Test</span>
               </div>
            </router-link>
            <button id="create" type="button" class="btn btn-light button-inactive">
               <div class="selector-holder text-center">
                  <i class="material-icons">create</i>
                  <span class="d-block">Create</span>
               </div>
            </button>
            <button id="account" type="button" class="btn btn-light button-inactive">
               <div class="selector-holder text-center">
                  <i class="material-icons">account_circle</i>
                  <span class="d-block">Account</span>
               </div>
            </button>
         </div>
      </footer>
    </div>
</template>

<script>
</script>
