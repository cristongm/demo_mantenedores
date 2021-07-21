<template>
  <div id="app" :key="key">
    <Login v-if="!isLogged" @childLogged="obtenerLogged"/>
    <Menu v-if="isLogged" @childLogged="obtenerLogged"/>
  </div>
</template>

<script>
import Login from './components/Login.vue'
import Menu from './components/Menu.vue'
export default {
  name: 'App',
  components: {
    Login,
    Menu
  },
  data(){
    return{
      key: 0,
      isLogged: false,
    }
  },
  methods: {
      checkLogged(){
        let datosUsuario = localStorage.getItem("datosUsuario")
        this.isLogged = datosUsuario != null
      },
      obtenerLogged(isLogged){
        this.isLogged = isLogged
        this.key += 1
      }
  },
  mounted(){
    this.checkLogged()
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
