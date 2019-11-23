<template>
  <div>
    <form @submit.prevent="editarNota(nota)" v-if="modoEditar">
      <h3>Editar Pupilo</h3>
      <input type="text" class="form-control mb-2" 
        placeholder="Nombre del pupilo" v-model="nota.nombre">
        <input type="text" class="form-control mb-2" 
        placeholder="Enfermedad" v-model="nota.enfermedad">
        <input type="text" class="form-control mb-2" 
        placeholder="Direccion" v-model="nota.direccion">
      <input type="text" class="form-control mb-2" 
        placeholder="Telefono" v-model="nota.telefono">
        <input type="text" class="form-control mb-2" 
        placeholder="Precauciones" v-model="nota.precauciones">
      <button class="btn btn-warning" type="submit">Editar</button>
      <button class="btn btn-danger" type="submit" 
        @click="cancelarEdicion">Cancelar</button>
    </form>
    <form @submit.prevent="agregar" v-else>
      <h3>Agregar Pupilo</h3>
      <input type="text" class="form-control mb-2" 
        placeholder="Nombre del pupilo" v-model="nota.nombre">
        <input type="text" class="form-control mb-2" 
        placeholder="Enfermedad" v-model="nota.enfermedad">
        <input type="text" class="form-control mb-2" 
        placeholder="Direccion" v-model="nota.direccion">
      <input type="text" class="form-control mb-2" 
        placeholder="Telefono" v-model="nota.telefono">
        <input type="text" class="form-control mb-2" 
        placeholder="Precauciones" v-model="nota.precauciones">
      <button class="btn btn-primary" type="submit">Agregar</button>
    </form>
    <hr>
    <h3>Lista de Pupilos:</h3>
    <ul class="list-group">
         <li class="list-group-item" 
            v-for="(item, index) in notas" :key="index" >
          <span class="badge badge-primary float-right">
            {{item.updated_at}}
          </span>
          <p>{{item.nombre}}</p>
          <p>{{item.enfermedad}}</p>
          <p>{{item.direccion}}</p>
          <p>{{item.telefono}}</p>
          <p>{{item.precauciones}}</p>
          <p>
            <button class="btn btn-warning btn-sm" 
                @click="editarFormulario(item)">Editar</button>
            <button class="btn btn-danger btn-sm" 
                @click="eliminarNota(item, index)">Eliminar</button>
          </p>
        </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notas: [],
      modoEditar: false,
      nota: {nombre: '', enfermedad: '', direccion: '', telefono: '', precauciones: ''}
    }
  },
  created(){
    axios.get('/notas').then(res=>{
      this.notas = res.data;
    })
  },
  methods:{
    agregar(){
      if(this.nota.nombre.trim() === '' || this.nota.enfermedad.trim() === ''
      || this.nota.direccion.trim() === ''|| this.nota.telefono.trim() === ''
      || this.nota.precauciones.trim() === ''){
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      const notaNueva = this.nota;
      this.nota = {nombre: '', enfermedad: '', direccion: '', telefono: '', precauciones: ''};    
      axios.post('/notas', notaNueva)
        .then((res) =>{
          const notaServidor = res.data;
          this.notas.push(notaServidor);
        })
    },
    editarFormulario(item){
      this.nota.nombre = item.nombre;
      this.nota.enfermedad = item.enfermedad;
      this.nota.direccion = item.direccion;
      this.nota.telefono = item.telefono;
      this.nota.precauciones = item.precauciones;
      this.nota.id = item.id;
      this.modoEditar = true;
    },
    editarNota(nota){
      const params = {nombre: nota.nombre, enfermedad: nota.enfermedad, direccion: nota.direccion,
      telefono: nota.telefono, precauciones: nota.precauciones };
      axios.put(`/notas/${nota.id}`, params)
        .then(res=>{
          this.modoEditar = false;
          const index = this.notas.findIndex(item => item.id === nota.id);
          this.notas[index] = res.data; 
        })
    },
    eliminarNota(nota, index){
      const confirmacion = confirm(`Eliminar nota ${nota.nombre}`);
      if(confirmacion){
        axios.delete(`/notas/${nota.id}`)
          .then(()=>{
            this.notas.splice(index, 1);
          })
      }
    },
    cancelarEdicion(){
      this.modoEditar = false;
      this.nota = {nombre: '', enfermedad: '', direccion: '', telefono: '', precauciones: ''};
    }
  }
}
</script>
  