<template>
    <div>

        <form  method="GET" @submit.prevent='submit'>
            <label for="token">
                Introduzca su Token
               <textarea name="token" cols="30" rows="10" v-model='token'></textarea>
                <b>Si no tiene un token <a href="/users/login">Inicie sesión</a></b>
            </label><br><br>
            <b>*Busqueda personalizada*</b>
            <br>
            <label for="user_id">
                Introduzca el id del usuario que quiere buscar
               <input name="user_id" v-model='userId'>
              <p> Si no conoces su id  listalos todos.  </p>  <b>(En caso de dejar este input vacio, se listaran TODOS los usuarios)</b>
            </label><br><br>
            <b>Si lo que quieres es eliminar un usuario, listados primero y tendras la opcion</b>
            <br>
            <br>
            <button type="submit">Listar</button>
        </form>

        <div v-if="apiResponse && !errors">
             <hr>
            <h2>Respuesta formateada</h2>

            <ul v-if="users">
                <li v-for="(user, index) in users" >
                    {{ user.name  }}  {{ user.last_name  }} ( {{ user.email }} )
                    <button  @click.prevent="deleteUser(user.id,user.name,index)" :value="user.id">Eliminar</button>
                </li>

            </ul>

        </div>

            <section v-if="apiResponse">
                 <hr>
                <h2>Respuesta de la api</h2>
                <pre v-text="apiResponse"></pre>
            </section>






    </div>

</template>


<script>

    export default {
        data(){
            return{
                fields:{},
                errors:null,
                apiResponse:null,
                token:null,
                userId:"",
                users:null,
                preActualId:null,
                actualId:null
            }
        },
        methods:{
            submit(){
                axios.get('/api/users/'+this.userId,{
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
            },
            deleteUser(userId,userName,index){
                if(confirm("¿Estas seguro de eliminar a "+userName+" ("+userId+") ?" )){
                    axios.delete('/api/users/'+userId,{
                        headers: {'Authorization': 'Bearer '+ this.token}
                    })
                .then((response)=>{
                    this.apiResponse=response.data;
                    if(!this.apiResponse.error){
                        this.users.splice(index, 1);
                    }

                    })
                    .catch(error=>{
                    this.apiResponse=error.response;
                    this.errors=error.response;
                    console.log(this.errors);
                    });
                }
            }
        }

    }
</script>



