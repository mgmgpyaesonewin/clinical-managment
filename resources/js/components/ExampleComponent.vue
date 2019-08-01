<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <router-link to="/foo">Foo</router-link>
                    <router-link to="/bar">Bar</router-link>
                    <router-view></router-view>
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.$router.history)
            console.log('Component mounted.')
        }
    }
</script>
