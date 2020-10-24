<template>
    <div>
        <label for="action">Seleccione la opción a realizar</label>
        <select name="action" v-model="action">
            <option value="email" selected='selected'>
                Enviar correo para resetear contraseña
            </option>
            <option value="reset">
                Resetear contraseña (Necesita enviar el email con la primera opcion y copiar el token para utilizar esta opcion en la api).
            </option>
        </select>
        <br>
        <br>

        <form  method="POST" @submit.prevent='submit' v-if="action=='email'">
            <label for="email">
                Correo electrónico
                <input type="email" name="email" v-model='fields.email'>
            </label><br><br>

            <button type="submit">Resetear</button>
        </form>

        <form  method="POST" @submit.prevent='submit' v-if="action=='reset'">


            <label for="email">
                Correo electrónico
                <input type="email" name="email" v-model='fields.email'>
            </label><br><br>
             <label for="token">
                Token (Enviado al correo electrónico)
                <textarea name="token" cols="30" rows="10" v-model='fields.token'></textarea>
            </label><br><br>
             <label for="email">
                Nueva contraseña
                <input type="password" name="password" v-model='fields.password'>
            </label><br><br>
             <label for="email">
               Confirmar contraseña
                <input type="password" name="email" v-model='fields.password_confirmation'>
            </label><br><br>


            <button type="submit">Guardar</button>
        </form>

        <b v-if="!apiResponse && action=='email'">***** ATENCION ***** Para probar esta opción debe configurar su mailtrap o su testing server en el archivo .env</b>

        <div v-if="apiResponse">
            <b v-if="!errors && action=='email'">se envio un correo al mailtrap configurado en .env</b>
             <b v-if="!errors && action=='reset'">Pruebe su nueva contraseña, <a href="/users/login">Inicie sesión</a></b>
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
                action:'email',
                errors:true,
                apiResponse:null
            }
        },
        methods:{
            submit(){
                axios.post('/api/password/'+this.action,this.fields)
               .then((response)=>{
                   this.fields={};
                   this.apiResponse=response.data;
                   this.errors=(response.data.error) ? true : false;
                })
                .catch(error=>{
                   this.apiResponse=error.response.data;
                   this.errors=true;
                });
            }
        },

    }
</script>

