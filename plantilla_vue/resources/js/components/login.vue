<template>
    <b-container fluid>
        <div class="logincenter">
            <div class="row logincenter">
        
                <div class="col-md-4 col-sm-12" style="padding-top: 15px; padding-bottom: 15px;">
                    <div class="card">
                        <div class="card-body" style="padding: 40px;">
                        <h5 class="card-title" style="text-align: center;">LOGIN</h5>
                        <form>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input v-model="formlogin.codi" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input v-model="formlogin.contrasenya" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            
                            <button type="submit" class="btn boto-primari">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
                    
        </div>

    </b-container>
</template>

<script>
import Vuex from 'vuex';

export default {

    data() {
        return {
            formlogin: {
                codi: "",
                contrasenya:"",
            },
        };
    },
    methods:{
        Login(){
            
            
        }
    }
}

</script>