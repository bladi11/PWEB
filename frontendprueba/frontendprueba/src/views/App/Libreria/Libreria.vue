<template>
    <b-container fluid>
      <b-modal id="modal-1" ref="modal-1" size="xl" title="Agregar Nuevo Producto">
        <form>
          <div class="col-md-12 mb-3">
            <label for="Marca">Marca</label>
            <input
              required
              type="text"
              class="form-control"
              id="Marca"
              v-model.trim="$v.form.Marca.$model"
              :state="!$v.form.Marca.$error"
              placeholder="Ingresar Marca"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Modelo">Modelo </label>
            <input
              required
              class="form-control"
              id="Modelo"
              v-model.trim="$v.form.Modelo.$model"
              :state="!$v.form.Modelo.$error"
              placeholder="Ingresar Modelo"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Anio">Año</label>
            <input
              required
              class="form-control"
              id="Anio"
              v-model.trim="$v.form.Anio.$model"
              :state="!$v.form.Anio.$error"
              placeholder="Ingresar Año"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Motor">Motor</label>
            <input
              required
              class="form-control"
              id="Motor"
              v-model.trim="$v.form.Motor.$model"
              :state="!$v.form.Motor.$error"
              placeholder="Ingresar Motor"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Color">Color </label>
            <input
              required
              class="form-control"
              id="Color"
              v-model.trim="$v.form.Color.$model"
              :state="!$v.form.Color.$error"
              placeholder="Ingresar Color"
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
      <b-modal id="modal-2" ref="modal-2" title="Editar Vehiculo">
        <form>
          <div class="col-md-12 mb-3">
            <label for="Marca">Marca</label>
            <input
              required
              type="text"
              class="form-control"
              id="Marca"
              v-model.trim="$v.form.Marca.$model"
              :state="!$v.form.Marca.$error"
              placeholder="Ingresar Marca"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Modelo">Modelo</label>
            <input
              required
              type="text"
              class="form-control"
              id="Modelo"
              v-model.trim="$v.form.Modelo.$model"
              :state="!$v.form.Modelo.$error"
              placeholder="Ingresar Modelo"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Anio">Año</label>
            <input
              required
              type="text"
              class="form-control"
              id="Anio"
              v-model.trim="$v.form.Anio.$model"
              :state="!$v.form.Anio.$error"
              placeholder="Ingresar Anio"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Motor">Motor </label>
            <input
              required
              class="form-control"
              id="Motor"
              v-model.trim="$v.form.Motor.$model"
              :state="!$v.form.Motor.$error"
              placeholder="Ingresar Motor"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Color">Color </label>
            <input
              required
              class="form-control"
              id="Color"
              v-model.trim="$v.form.Color.$model"
              :state="!$v.form.Color.$error"
              placeholder="Ingresar Color"
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
      <b-modal id="modal-5" ref="modal-5" title="Eliminar Vehiculo">
        <h6 class="my-4">
          ¿Desea eliminar esta Moto?
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
                <h4 class="card-title mt-3">Motos</h4>
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
                        :text="columna.marca"
                        variant="outline-dark"
                        class="mr-1 float-md-left btn-group"
                        size="xs"
                      >
                        <b-dropdown-item
                          v-for="(search, index) in options"
                          :key="index"
                          @click="changeTypeSearch(search)"
                          >{{ search.marca }}</b-dropdown-item
                        >
                      </b-dropdown>
                    </div>
                  </div>
                </div>
              </template>
              <template v-slot:headerAction>
              <b-button variant="primary"  v-b-modal.modal-1>Agregar Nueva Moto</b-button>
            </template>
            <template v-slot:body>
              <table class="table">
                  <thead>
                      <th>
                        Marca
                    </th>
                    <th>
                        Modelo
                    </th>
                    <th>
                        Año
                    </th>
                    <th>
                        Motor
                    </th>
                    <th>
                        Color
                    </th>
                  </thead>
                  <tbody>
                    <tr v-for="datos in datosPosts" :key="datos.id">
                          <td v-text="datos.Marca"></td>
                          <td v-text="datos.Modelo"></td>
                          <td v-text="datos.Anio"></td>
                          <td v-text="datos.Motor"></td>
                          <td v-text="datos.Color"></td>
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
        Marca: '',
        Modelo: '',
        Anio: '',
        Motor: '',
        Color: ''
      },
      apiBase: laravelUrl + '/motos/getAll',
      typeOptions: [],
      options: [
        { value: '1', marca: 'Marca' },
        { value: '2', marca: 'Modelo' },
        { value: '3', marca: 'Anio' },
        { value: '4', marca: 'Motor' },
        { value: '5', marca: 'Color' }
      ],
      columna: { value: '1', marca: 'Marca' },
      fields: [
        {
          name: 'Marca',
          sortField: 'Marca',
          title: 'Titulo',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Modelo',
          sortField: 'Modelo',
          title: 'Descripcion',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Anio',
          sortField: 'Anio',
          title: 'Estado',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Motor',
          sortField: 'Motor',
          title: 'Descripcion1',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Color',
          sortField: 'Color',
          title: 'Descripcion2',
          dataClass: 'list-item-heading'
        }
      ]
    }
  },
  validations () {
    return {
      form: {
        Marca: { required },
        Modelo: { required },
        Anio: { required },
        Motor: { required },
        Color: { required }
      }
    }
  },
  methods: {
    eliminarRegistro (datos) {
      axios.delete(laravelUrl + '/motos/getAll/' + datos.id).then((response) => {
        console.log('Eliminado correctamente')
        this.getDatos()
      })
    },
    getDatos () {
      axios.get(laravelUrl + '/motos/getAll').then((response) => {
        this.datosPosts = response.data
      })
    },
    postEstado (accion, datos) {
      this.form.titulo = datos.title
      this.form.state = datos.completed
      this.form.id = datos.id
      if (accion === 1) {
        this.mensaje('Este post esta completo')
        this.$refs['modal-3'].show()
      } else if (accion === 2) {
        this.mensaje('Este post esta incompleto')
        this.$refs['modal-4'].show()
      }
    },
    openModal (modal, id) {
      switch (modal) {
        case 'save': {
          this.$v.$reset()
          this.form.id = 0
          this.form.titulo = ''
          this.form.descripcion = ''
          this.form.state = 1
          break
        }
        case 'update': {
          const dataid = this.datosPosts.find(dato => dato.id === id)
          if (dataid) {
            this.form.id = dataid.id
            this.form.Marca = dataid.Marca
            this.form.Modelo = dataid.Modelo
            this.form.Anio = dataid.Anio
            this.form.Motor = dataid.Motor
            this.form.Color = dataid.Color
          }
          this.$refs['modal-2'].show()
          break
        }
        case 'delete': {
          const dataidDel = this.datosPosts.find(dato => dato.id === id)
          if (dataidDel) {
            this.form.id = dataidDel.id
            this.form.Marca = dataidDel.Marca
            this.form.Modelo = dataidDel.Modelo
            this.form.Anio = dataidDel.Anio
            this.form.Motor = dataidDel.Motor
            this.form.Color = dataidDel.Color
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
          this.form.Marca = ''
          this.form.Modelo = ''
          this.form.Anio = ''
          this.form.Motor = ''
          this.form.Color = ''
          break
        }
        case 'update': {
          this.$v.$reset()
          this.$refs['modal-2'].hide()
          this.form.id = 0
          this.form.Marca = ''
          this.form.Modelo = ''
          this.form.Anio = ''
          this.form.Motor = ''
          this.form.Color = ''
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
      this.form.Marca = data.Marca
      this.form.Modelo = data.Modelo
      this.form.Anio = data.Anio
      this.form.Motor = data.Motor
      this.form.Color = data.Color
    },
    /* Guardar */
    onSave () {
      const me = this
      axios.post(laravelUrl + '/motos/create', {
        Marca: me.form.Marca,
        Modelo: me.form.Modelo,
        Anio: me.form.Anio,
        Motor: me.form.Motor,
        Color: me.form.Color })
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
      axios.put(laravelUrl + '/motos/update/' + this.form.id, {
        Marca: me.form.Marca,
        Modelo: me.form.Modelo,
        Anio: me.form.Anio,
        Motor: me.form.Motor,
        Color: me.form.Color
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
      axios.delete(laravelUrl + '/motos/delete/' + this.form.id)
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