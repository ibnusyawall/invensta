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

                        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="isError">
                            {{ errors[0] }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" v-on:click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header"><h4>Login</h4></div>

                            <div class="card-body">
                                <form @submit.prevent="login">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <ValidationProvider rules="required|min:4" v-slot="{ errors }">
                                            <input aria-describedby="emailHelpBlock" v-model="form.username" id="username" type="text" :class="errors.length ? 'form-control is-invalid' : 'form-control'" tabindex="1" placeholder="masukan username" autofocus>
                                            <div class="invalid-feedback">
                                                {{ errors[0] }}
                                            </div>
                                        </ValidationProvider>
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
                                       <ValidationProvider rules="required|min:4" v-slot="{ errors }">
                                           <input aria-describedby="passwordHelpBlock" v-model="form.password" id="password" type="password" :class="errors.length ? 'form-control is-invalid' : 'form-control'" tabindex="2" placeholder="Your account password">
                                           <div class="invalid-feedback">
                                                {{ errors[0] }}
                                           </div>
                                       </ValidationProvider>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" :disabled="!form.username || !form.password">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            <router-link to="/pegawai/login">Masuk sebagai Pegawai</router-link>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; {{ brand }} {{ year }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { ValidationProvider } from 'vee-validate'
    import { mapActions, mapState, mapGetters } from 'vuex'
    export default {
        props: ['brand'],
        data() {
            return {
               form: {
                   username: '',
                   password: ''
               },
               year: new Date().getFullYear()
            }
        },
        computed: {
            ...mapState({
                example: state => state.auth.example,
                errors: state => state.auth.errors,
                isError: state => state.auth.isError
            }),
            ...mapGetters(['get_state', 'user'])
        },
        methods: {
            async login() {
                await this.$store.dispatch('login', this.form)
            },
            close() {
                this.$store.dispatch('close')
            }
        },
        components: {
            ValidationProvider
        }
    }
</script>
