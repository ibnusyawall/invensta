<template>
    <div>
        <Dashboard>
            <template v-slot:section-header>
                <h1>Selamat siang!</h1>
            </template>
            <template v-slot:content>
                <p>Hello World!</p>
                <pre>{{ user }}</pre>
            </template>
        </Dashboard>
    </div>
</template>

<script>
import Dashboard from './Dashboard'
export default {
    props: ['user'],
    data() {
        return {

        }
    },
    components: {
        Dashboard
    }
}
</script>
