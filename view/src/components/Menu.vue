<template>
    <div>
        <b-button v-b-toggle.sidebar-variant>Toggle Sidebar</b-button>
        <b-sidebar id="sidebar-variant" :title="`Hola ${nombreCompleto}`" bg-variant="dark" text-variant="light" shadow>
            <div class="px-3 py-2">
            <b-img src="https://picsum.photos/500/500/?image=54" fluid thumbnail></b-img>
            </div>
            <div>
                <b-button variant="danger" class="w-75" @click="cerrarSesion">Cerrar Sesión</b-button>
            </div>
        </b-sidebar>
    </div>
</template>
<script>
//   import axios from 'axios'
//   import querystring from 'querystring'
  export default {
    data() {
      return {
        nombreCompleto: '',
      }
    },
    methods: {
        cargaInicial(){
            let usuario = localStorage.getItem("datosUsuario")
            this.nombreCompleto = JSON.parse(usuario)[0].nombre
        },
        cerrarSesion(){
            this.$emit('childLogged', false)
            localStorage.removeItem("datosUsuario")
        }
    },
    mounted(){
        this.cargaInicial()
    }
  }
</script>