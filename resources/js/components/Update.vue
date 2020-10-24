<template>
    <div>
        <form  method="GET" @submit.prevent='loadUsers'>
            <label for="token">
                Introduzca su Token
               <textarea name="token" id="" cols="30" rows="10" v-model='token'></textarea>
                <b>Si no tiene un token <a href="/users/login">Inicie sesión</a></b>
            </label><br><br>
            <button type="submit">Listar usuarios a actualizar</button>
        </form>

        <form  method="POST" v-if="users" @submit.prevent="updateUser">
            <label selected="selected" >Seleccione el usuario para actualizar sus datos</label>
            <select name="userId" v-model="userId" @change.prevent="loadUserData">

                   <option v-for="user in users" :value="user.id">
                    {{ user.name  }}  {{ user.last_name  }} ( {{ user.id }} )
                    </option>


            </select>
            <section>
                <label for="name" v-if="userData">
                    Nombre:
                    <input type="text" name="name" v-model="fields.name" :placeholder="userData.name">
                </label><br><br>
                <label for="last_name">
                    Apellido:
                    <input type="text" name="last_name" v-model="fields.last_name" :placeholder="userData.last_name">
                </label><br><br>
                <label for="email">
                    Correo electrónico
                    <input type="email" name="email" v-model="fields.email" :placeholder="userData.email">
                </label>

                <button type="submit">Actualizar</button>
            </section>
        <b>Rellene solo el campo que quiere actualizar</b>
        </form>

        <div v-if="apiResponse">
            <h1>Respuesta api</h1>
            <pre v-text="apiResponse"></pre>
        </div>


    </div>

</template>


<script>
    export default {
        data(){
            return{
                fields:{},
                userId:null,
                token:null,
                apiResponse:null,
                users:null,
                errors:null,
                userData:{}
            }
        },
        methods:{
             loadUsers(){
                axios.get('/api/users/',{
                    headers: {'Authorization': 'Bearer '+ this.token}
                })
               .then((response)=>{
                   this.apiResponse=response.data;
                   this.users=response.data.data;
                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                   this.errors=error.response.data;
                   console.log(this.errors);
                });
            },loadUserData(){
                axios.get('/api/users/'+this.userId,{
                    headers: {'Authorization': 'Bearer '+ this.token}
                })
               .then((response)=>{
                   this.fields={};
                   this.apiResponse=response.data;
                   this.userData=response.data.data[0];

                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                   this.errors=error.response.data;
                   console.log(this.errors);
                });
            },updateUser(){
                axios.patch('/api/users/'+this.userId,this.fields,{
                    headers: {'Authorization': 'Bearer '+ this.token}
                })
               .then((response)=>{
                   this.apiResponse=response.data;
                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                   this.errors=error.response.data;
                   console.log(this.errors);
                });
            }
        }

    }
</script>

