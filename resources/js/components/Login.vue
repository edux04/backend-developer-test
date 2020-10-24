<template>
    <div>

        <form  method="POST" @submit.prevent='submit'>
            <label for="email">
                Correo electrónico
                <input type="email" name="email" v-model='fields.email'>
            </label><br><br>
            <label for="password">
                Contraseña
                <input type="password" name="password" v-model='fields.password'>
            </label><br><br>

            <button type="submit">Entrar</button>
        </form>
        <b>Si no tienes una cuenta, <a href="/users/register">Crea una</a></b><br>
         <b>¿Olvidaste tu contraseña?, <a href="/password/email">Recuperala!</a></b>
        <section v-if="apiResponse">
            <div v-if="!apiResponse.error">
                <br><br>
                <b> Copia el token de la respuesta, lo necesitaras para probar el resto de endpoints</b>

                <textarea cols="20" rows="10" v-model="token"></textarea>
            </div>
            <h1>Respuesta api</h1>
            <pre v-text="apiResponse"></pre>
        </section>

    </div>

</template>


<script>
    export default {
        data(){
            return{
                fields:{},
                token:null,
                apiResponse:null
            }
        },
        methods:{
            submit(){
                axios.post('http://127.0.0.1:8000/api/login',this.fields)
               .then((response)=>{
                   this.fields={};
                   this.apiResponse=response.data;
                   this.token=response.data.access_token;
                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                });
            }
        }

    }
</script>

