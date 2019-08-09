<template>
    <div>
        <div id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
        <div class="row justify-content-center">
            <div class="col-4 mt-5 ">
                 <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="index.html">
                        <h3 class="box-title m-b-20 text-center">Login</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" v-model="user.email" type="email" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" v-model="user.password"  type="password" required="" placeholder="Pasword">
                            </div>
                        </div>
                        <div class="form-group text-center p-b-10">
                            <div class="col-xs-12">
                                <button @click.prevent="login" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
           
        </div>
    </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            user:{
                email:'',
                password:'',
            }
        }
    },
    methods:{
        login(){
            axios.post('auth/login/',this.user)
            .then((res)=>{
                // console.log(res.data);
                this.$toasted.show('Success! ')
                this.$store.dispatch('saveUser',res.data);
                this.$router.push(this.$route.query.redirect || '/patients')
            })
            .catch(err=>{
                // console.log(err.response.data.error)
                 this.$toasted.show(`${err.response.data.error}`,{
                     type:'error'
                 })
            })
        }
    }
}
</script>