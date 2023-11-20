<template>
    <b-container fluid>
      <b-modal id="modal-1" ref="modal-1" size="xl" title="Agregar Nuevo Vehiculo">
        <form>
          <div class="col-md-12 mb-3">
            <label for="Nit">Nit</label>
            <input
              required
              type="text"
              class="form-control"
              id="Nit"
              v-model.trim="$v.form.Nit.$model"
              :state="!$v.form.Nit.$error"
              placeholder="Ingresar Nit"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Cui">CUI </label>
            <input
              required
              class="form-control"
              id="Cui"
              v-model.trim="$v.form.Cui.$model"
              :state="!$v.form.Cui.$error"
              placeholder="Ingresar CUI"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Propietario">Nombre Propietario </label>
            <input
              required
              class="form-control"
              id="Propietario"
              v-model.trim="$v.form.Propietario.$model"
              :state="!$v.form.Propietario.$error"
              placeholder="Ingresar Nombre del Propietario"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Placa">Numero Placa </label>
            <input
              required
              class="form-control"
              id="Placa"
              v-model.trim="$v.form.Placa.$model"
              :state="!$v.form.Placa.$error"
              placeholder="Ingresar Numero Placa"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Marca">Marca </label>
            <input
              required
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
          <div class="col-md-12 mb-3">
            <label for="Anio">Año </label>
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
            <label for="Cilindros">Cilindros </label>
            <input
              required
              class="form-control"
              id="Cilindros"
              v-model.trim="$v.form.Cilindros.$model"
              :state="!$v.form.Cilindros.$error"
              placeholder="Ingresar el numero de Cilindros"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Asientos">Asientos </label>
            <input
              required
              class="form-control"
              id="Asientos"
              v-model.trim="$v.form.Asientos.$model"
              :state="!$v.form.Asientos.$error"
              placeholder="Ingresar el numero de Asientos"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Chasis">Chasis </label>
            <input
              required
              class="form-control"
              id="Chasis"
              v-model.trim="$v.form.Chasis.$model"
              :state="!$v.form.Chasis.$error"
              placeholder="Ingresar Chasis"
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
            <label for="Nit">Nit</label>
            <input
              required
              type="text"
              class="form-control"
              id="Nit"
              v-model.trim="$v.form.Nit.$model"
              :state="!$v.form.Nit.$error"
              placeholder="Ingresar Nit"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Cui">CUI</label>
            <input
              required
              type="text"
              class="form-control"
              id="Cui"
              v-model.trim="$v.form.Cui.$model"
              :state="!$v.form.Cui.$error"
              placeholder="Ingresar CUI"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Propietario">Propietario</label>
            <input
              required
              type="text"
              class="form-control"
              id="Propietario"
              v-model.trim="$v.form.Propietario.$model"
              :state="!$v.form.Propietario.$error"
              placeholder="Ingresar Propietario"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Placa">Placa </label>
            <input
              required
              class="form-control"
              id="Placa"
              v-model.trim="$v.form.Placa.$model"
              :state="!$v.form.Placa.$error"
              placeholder="Ingresar Placa"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Marca">Marca </label>
            <input
              required
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
          <div class="col-md-12 mb-3">
            <label for="Anio">Año </label>
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
            <label for="Cilindros">Cilindros </label>
            <input
              required
              class="form-control"
              id="Cilindros"
              v-model.trim="$v.form.Cilindros.$model"
              :state="!$v.form.Cilindros.$error"
              placeholder="Ingresar Cilindros"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Asientos">Asientos </label>
            <input
              required
              class="form-control"
              id="Asientos"
              v-model.trim="$v.form.Asientos.$model"
              :state="!$v.form.Asientos.$error"
              placeholder="Ingresar Asientos"
            >
          </div>
          <div class="col-md-12 mb-3">
            <label for="Chasis">Chasis </label>
            <input
              required
              class="form-control"
              id="Chasis"
              v-model.trim="$v.form.Chasis.$model"
              :state="!$v.form.Chasis.$error"
              placeholder="Ingresar Chasis"
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
          ¿Desea eliminar este Vehiculo?
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
                <h4 class="card-title mt-3">Vehiculos</h4>
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
                        :text="columna.nit"
                        variant="outline-dark"
                        class="mr-1 float-md-left btn-group"
                        size="xs"
                      >
                        <b-dropdown-item
                          v-for="(search, index) in options"
                          :key="index"
                          @click="changeTypeSearch(search)"
                          >{{ search.nit }}</b-dropdown-item
                        >
                      </b-dropdown>
                    </div>
                  </div>
                </div>
              </template>
              <template v-slot:headerAction>
              <b-button variant="primary"  v-b-modal.modal-1>Agregar Nuevo Vehiculo</b-button>
            </template>
            <template v-slot:body>
              <table>
                  <thead>
                      <th>
                        Nit
                    </th>
                    <th>
                        CUI
                    </th>
                    <th>
                        Propietario
                    </th>
                    <th>
                        Placa
                    </th>
                    <th>
                        Marca
                    </th>
                    <th>
                        Modelo
                    </th>
                    <th>
                        Color
                    </th>
                    <th>
                        Año
                    </th>
                    <th>
                        Cilindros
                    </th>
                    <th>
                        Asientos
                    </th>
                    <th>
                        Chasis
                    </th>
                  </thead>
                  <tbody>
                    <tr v-for="datos in datosPosts" :key="datos.id">
                          <td><template><button class="btn btn-success" v-b-modal.modal-2 @click="openModal('update',datos.id)">Editar</button></template><template><button class="btn btn-danger"  v-b-modal.modal-5 @click="openModal('delete',datos.id)">Eliminar</button></template></td>
                          <td v-text="datos.Nit"></td>
                          <td v-text="datos.Cui"></td>
                          <td v-text="datos.Propietario"></td>
                          <td v-text="datos.Placa"></td>
                          <td v-text="datos.Marca"></td>
                          <td v-text="datos.Modelo"></td>
                          <td v-text="datos.Color"></td>
                          <td v-text="datos.Anio"></td>
                          <td v-text="datos.Cilindros"></td>
                          <td v-text="datos.Asientos"></td>
                          <td v-text="datos.Chasis"></td>
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
  name: 'Vehiculo',
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
        Nit: '',
        Cui: '',
        Propietario: '',
        Placa: '',
        Marca: '',
        Modelo: '',
        Color: '',
        Anio: '',
        Cilindros: '',
        Asientos: '',
        Chasis: ''
      },
      apiBase: laravelUrl + '/vehiculo/getAll',
      typeOptions: [],
      options: [
        { value: '1', nit: 'Nit' },
        { value: '2', nit: 'Cui' },
        { value: '3', nit: 'Propietario' },
        { value: '4', nit: 'Placa' },
        { value: '5', nit: 'Marca' },
        { value: '6', nit: 'Modelo' },
        { value: '7', nit: 'Color' },
        { value: '8', nit: 'Anio' },
        { value: '9', nit: 'Cilindros' },
        { value: '10', nit: 'Asientos' },
        { value: '11', nit: 'Chasis' }
      ],
      columna: { value: '1', nit: 'Nit' },
      fields: [
        {
          name: 'Nit',
          sortField: 'Nit',
          title: 'Titulo',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Cui',
          sortField: 'Cui',
          title: 'Descripcion',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Propietario',
          sortField: 'Propietario',
          title: 'Estado',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Placa',
          sortField: 'Placa',
          title: 'Descripcion1',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Marca',
          sortField: 'Marca',
          title: 'Descripcion2',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Modelo',
          sortField: 'Modelo',
          title: 'Descripcion3',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Color',
          sortField: 'Color',
          title: 'Descripcion4',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Anio',
          sortField: 'Anio',
          title: 'Descripcion5',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Cilindros',
          sortField: 'Cilindros',
          title: 'Descripcion6',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Asientos',
          sortField: 'Asientos',
          title: 'Descripcion7',
          dataClass: 'list-item-heading'
        },
        {
          name: 'Chasis',
          sortField: 'Chasis',
          title: 'Descripcion8',
          dataClass: 'list-item-heading'
        }
      ]
    }
  },
  validations () {
    return {
      form: {
        Nit: { required },
        Cui: { required },
        Propietario: { required },
        Placa: { required },
        Marca: { required },
        Modelo: { required },
        Color: { required },
        Anio: { required },
        Cilindros: { required },
        Asientos: { required },
        Chasis: { required }
      }
    }
  },
  methods: {
    eliminarRegistro (datos) {
      axios.delete(laravelUrl + '/vehiculo/getAll/' + datos.id).then((response) => {
        console.log('Eliminado correctamente')
        this.getDatos()
      })
    },
    getDatos () {
      axios.get(laravelUrl + '/vehiculo/getAll').then((response) => {
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
            this.form.Nit = dataid.Nit
            this.form.Cui = dataid.Cui
            this.form.Propietario = dataid.Propietario
            this.form.Placa = dataid.Placa
            this.form.Marca = dataid.Marca
            this.form.Modelo = dataid.Modelo
            this.form.Color = dataid.Color
            this.form.Anio = dataid.Anio
            this.form.Cilindros = dataid.Cilindros
            this.form.Asientos = dataid.Asientos
            this.form.Chasis = dataid.Chasis
          }
          this.$refs['modal-2'].show()
          break
        }
        case 'delete': {
          const dataidDel = this.datosPosts.find(dato => dato.id === id)
          if (dataidDel) {
            this.form.id = dataidDel.id
            this.form.Nit = dataidDel.Nit
            this.form.Cui = dataidDel.Cui
            this.form.Propietario = dataidDel.Propietario
            this.form.Placa = dataidDel.Placa
            this.form.Marca = dataidDel.Marca
            this.form.Modelo = dataidDel.Modelo
            this.form.Color = dataidDel.Color
            this.form.Anio = dataidDel.Anio
            this.form.Cilindros = dataidDel.Cilindros
            this.form.Asientos = dataidDel.Asientos
            this.form.Chasis = dataidDel.Chasis
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
          this.form.Nit = ''
          this.form.Cui = ''
          this.form.Propietario = ''
          this.form.Placa = ''
          this.form.Marca = ''
          this.form.Modelo = ''
          this.form.Color = ''
          this.form.Anio = ''
          this.form.Cilindros = ''
          this.form.Asientos = ''
          this.form.Chasis = ''
          break
        }
        case 'update': {
          this.$v.$reset()
          this.$refs['modal-2'].hide()
          this.form.id = 0
          this.form.Nit = ''
          this.form.Cui = ''
          this.form.Propietario = ''
          this.form.Placa = ''
          this.form.Marca = ''
          this.form.Modelo = ''
          this.form.Color = ''
          this.form.Anio = ''
          this.form.Cilindros = ''
          this.form.Asientos = ''
          this.form.Chasis = ''
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
      this.form.Nit = data.Nit
      this.form.Cui = data.Cui
      this.form.Propietario = data.Propietario
      this.form.Placa = data.Placa
      this.form.Marca = data.Marca
      this.form.Modelo = data.Modelo
      this.form.Color = data.Color
      this.form.Anio = data.Anio
      this.form.Cilindros = data.Cilindros
      this.form.Asientos = data.Asientos
      this.form.Chasis = data.Chasis
    },
    /* Guardar */
    onSave () {
      const me = this
      axios.post(laravelUrl + '/vehiculo/create', {
        Nit: me.form.Nit,
        Cui: me.form.Cui,
        Propietario: me.form.Propietario,
        Placa: me.form.Placa,
        Marca: me.form.Marca,
        Modelo: me.form.Modelo,
        Color: me.form.Color,
        Anio: me.form.Anio,
        Cilindros: me.form.Cilindros,
        Asientos: me.form.Asientos,
        Chasis: me.form.Chasis })
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
      axios.put(laravelUrl + '/vehiculo/update/' + this.form.id, {
        Nit: me.form.Nit,
        Cui: me.form.Cui,
        Propietario: me.form.Propietario,
        Placa: me.form.Placa,
        Marca: me.form.Marca,
        Modelo: me.form.Modelo,
        Color: me.form.Color,
        Anio: me.form.Anio,
        Cilindros: me.form.Cilindros,
        Asientos: me.form.Asientos,
        Chasis: me.form.Chasis
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
      axios.delete(laravelUrl + '/vehiculo/delete/' + this.form.id)
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
