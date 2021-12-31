<template>
    <div>
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            {{ brand }}
                        </div>
                        <!--<div v-if="error.status" class="alert alert-danger">
                            {{ iziToast('') }}
                        </div>-->

                        <div class="card card-primary">
                            <div class="card-header"><h4>Login</h4></div>

                            <div class="card-body">
                                <form @submit.prevent="login">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input aria-describedby="emailHelpBlock" id="username" type="text" class="form-control" tabindex="1" placeholder="masukan username" autofocus>

                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                               <a href="" class="text-small">
                                                   Forgot Password?
                                               </a>
                                            </div>
                                       </div>
                                       <input aria-describedby="passwordHelpBlock" id="password" type="password" class="form-control" tabindex="2" placeholder="Your account password">

                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" >
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mt-5 text-muted text-center">
                            Don't have an account?
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; {{ brand }} 2021
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
               brand: 'INVENSTA',
               form: {
                   username: null,
                   password: null
               },
               errors: null
            }
        },
        beforeMount() {
            this.check()
        },

        methods: {
            login() {
                this.$store.dispatch('login', this.form)
                    .then()
            },
            check() {
                axios.get('/api/user')
                    .then(res => {
                        console.log(res?.data)
                    }).catch(e => console.log(e?.response.status))
            },
        }
    }
</script>
