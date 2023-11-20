<template>
  <b-container fluid>
    <b-modal id="modal-1" ref="modal-1" size="xl" title="Bienvenido al modal de ingreso de posts">
      <form>
        <div class="col-md-12 mb-3">
          <label for="titulo">Título</label>
          <input
            required
            type="text"
            class="form-control"
            id="titulo"
            v-model.trim="$v.form.titulo.$model"
            :state="!$v.form.titulo.$error"
            placeholder="Ingresar titulo"
        >
        </div>
        <div class="col-md-12 mb-3">
          <label for="descripcion">Descripción</label>
          <input
            required
            class="form-control"
            id="descripcion"
            v-model.trim="$v.form.descripcion.$model"
            :state="!$v.form.descripcion.$error"
            placeholder="Ingresar descripcion"
          >
        </div>
      </form>
      <template #modal-footer="{}">
        <b-button  variant="primary" @click="onSave()"
          >Guardar</b-button
        >
        <b-button variant="danger" @click="closeModal('save')"
          >Cancelar</b-button
        >
      </template>
    </b-modal>
    <b-modal id="modal-2" ref="modal-2" title="Editar post">
      <form>
        <div class="col-md-12 mb-3">
          <label for="user">Titulo</label>
          <input
            required
            type="text"
            class="form-control"
            id="user"
            v-model.trim="$v.form.titulo.$model"
            :state="!$v.form.titulo.$error"
            placeholder="Ingresar titulo"
          >
        </div>
        <div class="col-md-12 mb-3">
          <label for="descripcion">Descripción</label>
          <input
            required
            type="text"
            class="form-control"
            id="descripcion"
            v-model.trim="$v.form.descripcion.$model"
            :state="!$v.form.descripcion.$error"
            placeholder="Ingresar descripcion"
          >
          <div class="valid-feedback">
            Looks good!
          </div>
          <div class="invalid-feedback">Example invalid feedback text</div>
        </div>
      </form>
      <template #modal-footer="{}">
        <b-button  variant="primary" @click="onValidate('update')"
          >Guardar</b-button
        >
        <b-button variant="danger" @click="closeModal('update')"
          >Cancelar</b-button
        >
      </template>
    </b-modal>
    <b-modal id="modal-3" ref="modal-3" title="Desactivar post">
      <h6 class="my-4">
        ¿Desea desactivar el post: {{ form.titulo }} ?
      </h6>
      <template #modal-footer="{}">
        <b-button
          type="submit"
          variant="primary"
          @click="onState()
                  $bvModal.hide('modal-3')"
          >Desactivar</b-button
        >
        <b-button variant="danger" @click="$bvModal.hide('modal-3')"
          >Cancelar</b-button
        >
      </template>
    </b-modal>
    <b-modal id="modal-4" ref="modal-4" title="Activar post">
      <h6 class="my-4">
        ¿Desea activar el post: {{ form.titulo }} ?
      </h6>
      <template #modal-footer="{}">
        <b-button
          type="submit"
          variant="primary"
          @click="onState()
                  $bvModal.hide('modal-4')"
          >Activar</b-button
        >
        <b-button variant="danger" @click="$bvModal.hide('modal-4')"
          >Cancelar</b-button
        >
      </template>
    </b-modal>
    <b-row>
      <b-col md="12">
        <iq-card>
            <template v-slot:headerTitle>
              <h4 class="card-title mt-3">Alumnos</h4>
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
            <b-button variant="primary"  v-b-modal.modal-1>AGREGAR NUEVO</b-button>
          </template>
          <template v-slot:body>
            <table >
                <thead>
                    <th>
                        Acciones
                    </th>
                    <th>
                        Titulo
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Completado
                    </th>
                </thead>
                <tbody>
                    <tr v-for="datos in datosPosts" :key="datos.id">
                        <td>
                            <template v-if="datos.completed === 'COMPLETADO'">
                                <button class="btn btn-danger" @click="postEstado(1, datos)">
                                    ANULAR POST
                                </button>
                            </template>
                            <template v-else>
                                <button class="btn btn-success" @click="postEstado(2, datos)">
                                    COMPLETAR POST
                                </button>
                            </template>
                            <template>
                                <button class="btn btn-dark" @click="eliminarRegistro(datos)">
                                    ELIMINAR POST
                                </button>
                            </template>
                        </td>
                        <td v-text="datos.title"></td>
                        <td v-text="datos.description"></td>
                        <td v-text="datos.completed"></td>
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
  name: 'Alumnos',
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
        titulo: '',
        descripcion: '',
        state: 1
      },
      apiBase: laravelUrl + '/posts/getTodos',
      typeOptions: [],
      options: [
        { value: '1', nombre: 'Título' },
        { value: '2', nombre: 'Descripción' },
        { value: '3', nombre: 'Completado' }
      ],
      columna: { value: '1', nombre: 'Titulo' },
      fields: [
        {
          name: '__slot:actions',
          title: 'Acciones',
          titleClass: '',
          dataClass: 'text-muted'
          // width: "15%",
        },
        {
          name: 'title',
          sortField: 'title',
          title: 'Titulo',
          dataClass: 'list-item-heading'
        },
        {
          name: 'description',
          sortField: 'description',
          title: 'Descripcion',
          dataClass: 'list-item-heading'
        },
        {
          name: 'completed',
          sortField: 'completed',
          title: 'Estado',
          dataClass: 'list-item-heading'
        },
        {
          name: '__slot:estado',
          title: 'Estado',
          titleClass: '',
          dataClass: 'text-muted',
          width: '25%'
        }
      ]
    }
  },
  validations () {
    return {
      form: {
        titulo: { required },
        descripcion: { required }
      }
    }
  },
  methods: {
    eliminarRegistro (datos) {
      axios.delete(laravelUrl + '/posts/' + datos.id).then((response) => {
        console.log('Eliminado correctamente')
        this.getDatos()
      })
    },
    getDatos () {
      axios.get(laravelUrl + '/posts/getTodos').then((response) => {
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
    openModal (modal, action) {
      switch (modal) {
        case 'save': {
          this.$v.$reset()
          this.form.id = 0
          this.form.titulo = ''
          this.form.descripcion = ''
          this.form.state = 1
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
          this.form.titulo = ''
          this.form.descripcion = ''
          this.form.state = 1
          break
        }
        case 'update': {
          this.$v.$reset()
          this.$refs['modal-2'].hide()
          this.form.id = 0
          this.form.titulo = ''
          this.form.descripcion = ''
          this.form.state = 1
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
          this.onUpdate()
        }
      }
    },
    setData (data) {
      this.form.user = data.user
      this.form.state = data.estado
      this.form.id = data.id
    },
    /* Guardar */
    onSave () {
      const me = this
      axios.post(laravelUrl + '/posts/', {
        titulo: me.form.titulo,
        descripcion: me.form.descripcion })
        .then((response) => {
          me.getDatos()
          me.closeModal('save')
        })
        .catch((error) => {
          // this.errorMessage = error.message;
          console.error('Error!', error)
        })
    },
    /* Guardar */
    onUpdate () {
      const me = this
      axios.put(apiUrl + '/user/update', {
        form: me.form })
        .then((response) => {
          me.closeModal('update')
        })
        .catch((error) => {
          // this.errorMessage = error.message;
          console.error('Error!', error)
        })
    },
    onState () {
      let me = this
      console.log(this.form.id)
      if (this.form.state === 'COMPLETADO') {
        axios
          .put(laravelUrl + '/posts/desactivar/' + this.form.id, {
            id: this.form.id
          })
          .then((response) => {
            me.$refs['modal-3'].hide()
            this.getDatos()
          })
          .catch((error) => {
            // this.errorMessage = error.message;
            console.error('There was an error!', error)
          })
      } else {
        axios
          .put(laravelUrl + '/posts/activar/' + this.form.id, {
            id: this.form.id
          })
          .then((response) => {
            me.$refs['modal-4'].hide()
            this.getDatos()
          })
          .catch((error) => {
            // this.errorMessage = error.message;
            console.error('There was an error!', error)
          })
      }
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
