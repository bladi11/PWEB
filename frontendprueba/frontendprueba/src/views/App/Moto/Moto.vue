<template>
    <b-container fluid>
      <b-modal id="modal-1" ref="modal-1" size="xl" title="Agregar Nueva Tarea">
        <form>
          <div class="col-md-12 mb-3">
            <label for="Nombre">Nombre</label>
            <input
              required
              type="text"
              class="form-control"
              id="Nombre"
              v-model.trim="$v.form.Nombre.$model"
              :state="!$v.form.Nombre.$error"
              placeholder="Ingresar Nombre"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Descripcion">Descripcion </label>
            <input
              required
              class="form-control"
              id="Descripcion"
              v-model.trim="$v.form.Descripcion.$model"
              :state="!$v.form.Descripcion.$error"
              placeholder="Ingresar Descripcion"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Estado">Estado</label>
            <input
              required
              class="form-control"
              id="Estado"
              v-model.trim="$v.form.Estado.$model"
              :state="!$v.form.Estado.$error"
              placeholder="Ingresar Estado"
            >
          </div>
        </form>
        <template #modal-footer="{}">
          <b-button  variant="primary" @click="onValidate('save')"
            >Guardar</b-button
          >
          <b-button variant="danger" @click="closeModal('save')"
            >Cancelar</b-button
          >
        </template>
      </b-modal>
      <b-modal id="modal-2" ref="modal-2" title="Editar Tarea">
        <form>
          <div class="col-md-12 mb-3">
            <label for="Nombre">Nombre</label>
            <input
              required
              type="text"
              class="form-control"
              id="Nombre"
              v-model.trim="$v.form.Nombre.$model"
              :state="!$v.form.Nombre.$error"
              placeholder="Ingresar Nombre"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Descripcion">Descripcion</label>
            <input
              required
              type="text"
              class="form-control"
              id="Descripcion"
              v-model.trim="$v.form.Descripcion.$model"
              :state="!$v.form.Descripcion.$error"
              placeholder="Ingresar Descripcion"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Estado">Estado</label>
            <input
              required
              type="text"
              class="form-control"
              id="Estado"
              v-model.trim="$v.form.Estado.$model"
              :state="!$v.form.Estado.$error"
              placeholder="Ingresar Estado"
            >
          </div>
        </form>
        <template #modal-footer="{}">
          <b-button  variant="primary" @click="onState()"
            >Guardar</b-button
          >
          <b-button variant="danger" @click="closeModal('update')"
            >Cancelar</b-button
          >
        </template>
      </b-modal>
      <b-modal id="modal-5" ref="modal-5" title="Eliminar Tarea">
        <h6 class="my-4">
          ¿Desea eliminar esta Tarea?
        </h6>
        <template #modal-footer="{}">
          <b-button
            type="submit"
            variant="primary"
            @click="deleteUser()"
            >Eliminar</b-button
          >
          <b-button variant="danger" @click="$bvModal.hide('modal-5')"
            >Cancelar</b-button
          >
        </template>
      </b-modal>
      <b-row>
        <b-col md="12">
          <iq-card>
              <template v-slot:headerTitle>
                <h4 class="card-title mt-3">Tareas</h4>
                <div class="iq-search-bar mt-2">
                  <div class="row">
                    <div class="col-sm">
                      <b-form action="#" class="searchbox">
                          <b-input id="search" placeholder="Buscar..." @input="(val) => searchChange(val)" />
                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                      </b-form>
                    </div>
                    <div class="col-sm">
                      <b-dropdown
                        id="ddown1"
                        :text="columna.nombre"
                        variant="outline-dark"
                        class="mr-1 float-md-left btn-group"
                        size="xs"
                      >
                        <b-dropdown-item
                          v-for="(search, index) in options"
                          :key="index"
                          @click="changeTypeSearch(search)"
                          >{{ search.nombre }}</b-dropdown-item
                        >
                      </b-dropdown>
                    </div>
                  </div>
                </div>
              </template>
              <template v-slot:headerAction>
              <b-button variant="primary"  v-b-modal.modal-1>Agregar Nueva Tarea</b-button>
            </template>
            <template v-slot:body>
              <table class="table">
                  <thead>
                      <th>
                        Nombre
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Estado
                    </th>
                  </thead>
                  <tbody>
                    <tr v-for="datos in datosPosts" :key="datos.id">
                          <td v-text="datos.Nombre"></td>
                          <td v-text="datos.Descripcion"></td>
                          <td v-text="datos.Estado"></td>
                          <td>
                            <template>
                                <button class="btn btn-success" v-b-modal.modal-2 @click="openModal('update',datos.id)">Editar</button>
                            </template>
                            <template>
                                <button class="btn btn-danger"  v-b-modal.modal-5 @click="openModal('delete',datos.id)">Eliminar</button>
                            </template>
                        </td>
                      </tr>
                  </tbody>
              </table>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { xray } from '../../../config/pluginInit'
// import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue'
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import axios from 'axios'
import { apiUrl, laravelUrl } from '../../../config/constant'

export default {
  name: 'Motor',
  components: {
  },
  setup () {
    return { $v: useVuelidate() }
  },
  mounted () {
    xray.index()
    axios.get(apiUrl + '/type/get').then((response) => {
      this.typeOptions = response.data
    })
    this.getDatos()
    console.log('Aqui ya esta montado el componente')
  },
  beforeDestroy () {
    // vacio
    this.mensajeDespedida()
  },
  beforeMount () {
    console.log('Aqui empieza el componente')
  },
  data () {
    return {
      from: 0,
      to: 0,
      total: 0,
      perPage: 5,
      search: '',
      datosPosts: [],
      form: {
        id: 0,
        Nombre: '',
        Descripcion: '',
        Estado: ''
      },
      apiBase: laravelUrl + '/tareas/getAll',
      typeOptions: [],
      options: [
        { value: '1', nombre: 'Nombre' },
        { value: '2', nombre: 'Descripcion' },
        { value: '3', nombre: 'Estado' }
      ],
      columna: { value: '1', nombre: 'Nombre' },
      fields: [
        {
          name: 'Nombre',
          sortField: 'Nombre',
          title: 'Titulo',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Descripcion',
          sortField: 'Descripcion',
          title: 'Descripcion',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Estado',
          sortField: 'Estado',
          title: 'Estado',
          dataClass: 'list-item-heading'
        }
      ]
    }
  },
  validations () {
    return {
      form: {
        Nombre: { required },
        Descripcion: { required },
        Estado: { required }
      }
    }
  },
  methods: {
    eliminarRegistro (datos) {
      axios.delete(laravelUrl + '/tareas/getAll/' + datos.id).then((response) => {
        console.log('Eliminado correctamente')
        this.getDatos()
      })
    },
    getDatos () {
      axios.get(laravelUrl + '/tareas/getAll').then((response) => {
        this.datosPosts = response.data
      })
    },
    postEstado (accion, datos) {
      this.form.titulo = datos.title
      this.form.state = datos.completed
      this.form.id = datos.id
      if (accion === 1) {
        this.mensaje('Esta tarea esta completa')
        this.$refs['modal-3'].show()
      } else if (accion === 2) {
        this.mensaje('Esta tarea esta incompleta')
        this.$refs['modal-4'].show()
      }
    },
    openModal (modal, id) {
      switch (modal) {
        case 'save': {
          this.$v.$reset()
          this.form.id = 0
          this.form.Nombre = ''
          this.form.Descripcion = ''
          this.form.Estado = 1
          break
        }
        case 'update': {
          const dataid = this.datosPosts.find(dato => dato.id === id)
          if (dataid) {
            this.form.id = dataid.id
            this.form.Nombre = dataid.Nombre
            this.form.Descripcion = dataid.Descripcion
            this.form.Estado = dataid.Estado
          }
          this.$refs['modal-2'].show()
          break
        }
        case 'delete': {
          const dataidDel = this.datosPosts.find(dato => dato.id === id)
          if (dataidDel) {
            this.form.id = dataidDel.id
            this.form.Nombre = dataidDel.Nombre
            this.form.Descripcion = dataidDel.Descripcion
            this.form.Estado = dataidDel.Estado
          }
          this.$refs['modal-5'].show()
          break
        }
      }
    },
    closeModal (action) {
      switch (action) {
        case 'save': {
          this.$v.$reset()
          this.$refs['modal-1'].hide()
          this.form.id = 0
          this.form.Nombre = ''
          this.form.Descripcion = ''
          this.form.Estado = ''
          break
        }
        case 'update': {
          this.$v.$reset()
          this.$refs['modal-2'].hide()
          this.form.id = 0
          this.form.Nombre = ''
          this.form.Descripcion = ''
          this.form.Estado = ''
          break
        }
      }
    },
    onValidate (action) {
      this.$v.$touch()
      if (this.$v.$error !== true) {
        if (action === 'save') {
          this.onSave()
        } else if (action === 'update') {
          this.onState()
        }
      }
    },
    setData (data) {
      this.form.Nombre = data.Nombre
      this.form.Descripcion = data.Descripcion
      this.form.Estado = data.Estado
    },
    /* Guardar */
    onSave () {
      const me = this
      axios.post(laravelUrl + '/tareas/create', {
        Nombre: me.form.Nombre,
        Descripcion: me.form.Descripcion,
        Estado: me.form.Estado })
        .then((response) => {
          me.getDatos()
          me.closeModal('save')
        })
        .catch((error) => {
          // this.errorMessage = error.message;
          console.error('Error!', error)
        })
    },
    onState () {
      let me = this
      console.log(this.form.id)
      axios.put(laravelUrl + '/tareas/update/' + this.form.id, {
        Nombre: me.form.Nombre,
        Descripcion: me.form.Descripcion,
        Estado: me.form.Estado
      })
        .then((response) => {
          me.$refs['modal-2'].hide()
          this.getDatos()
        })
        .catch((error) => {
          console.error('There was an error!', error)
        })
    },
    deleteUser () {
      let me = this
      console.log(this.form.id)
      axios.delete(laravelUrl + '/tareas/delete/' + this.form.id)
        .then((response) => {
          me.$refs['modal-5'].hide()
          this.getDatos()
        })
        .catch((error) => {
          console.error('There was an error!', error)
        })
    },
    makeQueryParams (sortOrder, currentPage, perPage) {
      return sortOrder[0]
        ? {
          criterio: sortOrder[0] ? sortOrder[0].sortField : 'createdAt',
          order: sortOrder[0] ? sortOrder[0].direction : 'desc',
          page: currentPage,
          limit: this.perPage,
          search: this.search,
          columna: this.columna.value
        }
        : {
          criterio: sortOrder[0] ? sortOrder[0].sortField : 'createdAt',
          order: sortOrder[0] ? sortOrder[0].direction : 'desc',
          page: currentPage,
          limit: this.perPage,
          search: this.search,
          columna: this.columna.value
        }
    },
    changePageSizes (perPage) {
      this.perPage = perPage
      this.$refs.vuetable.refresh()
    },
    searchChange (val) {
      this.search = val.toLowerCase()
      this.$refs.vuetable.refresh()
    },
    onPaginationData (paginationData) {
      this.from = paginationData.from
      this.to = paginationData.to
      this.total = paginationData.total
      this.lastPage = paginationData.last_page
      this.items = paginationData.data
      this.$refs.pagination.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    changeTypeSearch (columna) {
      this.columna = columna
    },
    mensaje (mensaje) {
      this.form.mensaje = mensaje
    },
    mensajeDespedida () {
      console.log('Antes de irnos del componente manda este mensaje')
    }
  }
}
</script>
