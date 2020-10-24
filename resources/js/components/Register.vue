<template>
    <div>

        <form  method="POST" @submit.prevent='submit'>
            <label for="name">
                Nombre:
                <input type="text" name="name" v-model='fields.name'>
            </label><br><br>
            <label for="last_name">
                Apellido:
                <input type="text" name="last_name" v-model='fields.last_name'>
            </label><br><br>
            <label for="email">
                Correo electrónico
                <input type="email" name="email" v-model='fields.email'>
            </label><br><br>
            <label for="password">
                Contraseña
                <input type="password" name="password" v-model='fields.password'>
            </label><br><br>
            <label for="password_confirmation">
            Repita la contraseña
                <input type="password" name="password_confirmation" v-model='fields.password_confirmation'>
            </label><br><br>
            <button type="submit">Registrar</button>
        </form>
        <div v-if="apiResponse">
             <b><a href="/users/login">Inicie sesión</a></b>
             <br>
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
                apiResponse:null
            }
        },
        methods:{
            submit(){
                axios.post('/api/register',this.fields)
               .then((response)=>{
                   this.fields={};
                   this.apiResponse=response.data;
                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                });
            }
        },

    }
</script>

