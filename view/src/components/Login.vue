<template>
  <div>
    <div class="sidenav">
      <div class="login-main-text">
        <h2>Inicio de Sesión</h2>
        <p>Demo mantenedor usuarios</p>
      </div>
    </div>
    <div class="main">
      <div class="col-sm-8">
        <div class="login-form">
          <b-form @submit="onSubmit">
            <b-form-group
              id="input-group-1"
              label="Usuario"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="username"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Contraseña" label-for="input-2">
              <b-form-input
                id="input-2"
                v-model="password"
                type="password"
                required
              ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="success" class="w-100 mt-3">Iniciar sesión</b-button>
          </b-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import querystring from 'querystring'
  export default {
    props:['isLogged'],
    data() {
      return {
        username: '',
        password: '',
      }
    },
    methods: {
      async onSubmit(event) {
        event.preventDefault()
        let obj = {
          username: this.username,
          password: this.password
        }
        try {
          let resultFecth = await axios.post('http://localhost:83/demo_mantenedores/controllers/usuarios/usuario_login.php', querystring.stringify(obj))
          console.log(resultFecth)
          const {result, msg, datosUsuario} = resultFecth.data
          if(result){
            this.$emit('childLogged', true)
            localStorage.setItem("datosUsuario", JSON.stringify(datosUsuario));
          }else{
            alert(`Error al iniciar sesión: ${msg}`)
          }
        } catch (error) {
          alert(`Error al iniciar sesión: ${error}`)
        }
      },
    }
  }
</script>
<style scoped>
body {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%; 
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 30%;
        margin-left: 50%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>