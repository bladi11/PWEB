<template>
  <b-container fluid>
    <b-modal id="modal-1" ref="modal-1" title="Componente Para Cifrado">
        <h2 class="font-italic">Bienvenido, Encriptado de Texto</h2>
      <template #modal-footer="{}">
        <b-button variant="danger" @click="closeModal('save')"
          >Ingresar</b-button
        >
      </template>
    </b-modal>

    <b-modal id="modal-3" ref="modal-3" title="Desactivar especialidad">
      <h6 class="my-4">
        ¿Desea Eliminar el Carro: {{ form.nombre }} ?
      </h6>
      <template #modal-footer="{}">
        <b-button
          type="submit"
          variant="primary"
          @click="eliminarRegistro()
                  $bvModal.hide('modal-3')"
          >Eliminar</b-button
        >
        <b-button variant="danger" @click="$bvModal.hide('modal-3')"
          >Cancelar</b-button
        >
      </template>
    </b-modal>
    <b-modal id="modal-4" ref="modal-4" title="Activar especialidad">
      <h6 class="my-4">
        ¿Desea activar el usuario: {{ form.user }} ?
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
    <b-modal id="modal-5" ref="modal-5" title="X">
    </b-modal>
    <b-row>
      <b-col md="12">
        <iq-card>
          <template class="dropdown-menu">
            <form class="px-4 py-3" id="formCifrar">
                <div class="form-group">
                <label for="textoIn">Ingresa el Texto a Encriptar</label>
                <input type="text" class="form-control" id="textoIn" placeholder="Texto" v-model.trim="formCifrar.textoIn" @change="cifrarTxt()">
                </div>
                <div class="form-group" id="cifrado" v-show="formCifrar.textoIn !== ''">
                <label for="cifradoMd5">MD5: </label>
                <input type="text" class="form-control" id="cifradoMd5" readonly v-model.trim="formCifrar.txtMd5">

                <label for="cifradoSha512">SHA512: </label>
                <input type="text" class="form-control" id="cifradoSha512" readonly v-model.trim="formCifrar.txtSha512">

                <label for="Bcrypt">Bcrypt: </label>
                <input type="text" class="form-control" id="Bcrypt" readonly v-model.trim="formCifrar.txtBcrypt">

                <label for="cifradoRsa">RSA: </label>
                <input type="text" class="form-control" id="cifradoRsa" readonly v-model.trim="formCifrar.txtRsa">
                <br>
                <div class="mx-auto" style="width: 200px;">
                <b-button variant="primary" @click="cifrarTxt()">Encriptar</b-button>
                <b-button variant="primary" @click="resetValues()">Limpiar</b-button>
                </div>
                </div>
            </form>
            <div class="dropdown-divider"></div>
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
import CryptoJS from 'crypto-js'
import bcrypt from 'bcryptjs'
import RSA from 'node-rsa'

export default {
  name: 'inicio',
  components: {
  },
  setup () {
    return { $v: useVuelidate() }
  },
  beforeMount () {
    this.getDatos()
  },
  mounted () {
    xray.index()
    axios.get(apiUrl + '/type/get').then((response) => {
      this.typeOptions = response.data
    })
    this.getDatos()
    this.$refs['modal-1'].show()
  },
  data () {
    return {
      from: 0,
      to: 0,
      total: 0,
      perPage: 5,
      search: '',
      form: {
        id: 0,
        marca: '',
        tipo: '',
        placa: '',
        estado: ''
      },
      formCifrar: { // establece el valor inicial del texto --------------------
        textoIn: '',
        txtMd5: '',
        txtSha512: '',
        txtBcrypt: '',
        txtRsa: ''
      },
      apiBase: laravelUrl + '/carro/getAll',
      datosPost: null,
      mostrarTxt: false,
      typeOptions: [],
      options: [
        { value: '1', nombre: 'MERCA' },
        { value: '2', nombre: 'TIPO' },
        { value: '3', nombre: 'PLACA' },
        { value: '4', nombre: 'ESTADO' }
      ],
      columna: { value: '1', nombre: 'MARCA' },
      fields: [
        {
          name: '__slot:actions',
          title: 'Acciones',
          titleClass: '',
          dataClass: 'text-muted'
          // width: "15%",
        },
        {
          name: 'marca',
          sortField: 'marca',
          title: 'MARCA',
          dataClass: 'list-item-heading'
        },
        {
          name: 'tipo',
          sortField: 'tipo',
          title: 'TIPO',
          dataClass: 'list-item-heading'
        },
        {
          name: 'placa',
          sortField: 'placa',
          title: 'PLACA',
          dataClass: 'list-item-heading'
        },
        {
          name: 'estado',
          sortField: 'estado',
          title: 'ESTADO',
          dataClass: 'list-item-heading'
        }
      ]
    }
  },
  validations () {
    return {
      form: {
        marca: { required },
        tipo: { required },
        placa: { required },
        estado: { required }
      }
    }
  },
  methods: {
    eliminarRegistro () {
      axios.delete(laravelUrl + '/carro/delete/' + this.form.id).then((response) => {
        this.getDatos()
      })
    },
    getDatos () {
      axios.get(laravelUrl + '/carro/getAll').then((response) => {
        this.datosPost = response.data
        console.log(this.datosPost)
      })
    },
    accionEdit (accion, datos) {
      if (accion === 1) {
        // ACTUALIZAR
        this.form.id = datos.id
        this.form.marca = datos.marca
        this.form.tipo = datos.tipo
        this.form.placa = datos.placa
        this.form.estado = datos.estado
      } else if (accion === 2) {
        this.form.id = datos.id
        this.form.marca = datos.marca
        this.form.tipo = datos.tipo
        this.form.placa = datos.placa
        this.form.estado = datos.estado
      }
    },
    openModal (modal, action) {
      switch (modal) {
        case 'save': {
          this.$v.$reset()
          this.form.id = 0
          this.form.marca = ''
          this.form.tipo = ''
          this.form.placa = ''
          this.form.estado = ''
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
          this.form.marca = ''
          this.form.tipo = ''
          this.form.placa = ''
          this.form.estado = ''
          break
        }
        case 'update': {
          this.$v.$reset()
          this.$refs['modal-2'].hide()
          this.form.id = 0
          this.form.marca = ''
          this.form.tipo = ''
          this.form.placa = ''
          this.form.estado = ''
          break
        }
      }
    },
    resetValues () {
      this.formCifrar.textoIn = ''
      this.formCifrar.txtMd5 = ''
      this.formCifrar.txtSha512 = ''
      this.formCifrar.txtBcrypt = ''
      this.formCifrar.txtRsa = ''
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
      this.form.userType = data.tipo_usuario
    },
    /* Guardar */
    onSave () {
      const me = this
      // this.$refs["modalSave"].hide();
      axios.post(laravelUrl + '/carro/create', {
        marca: me.form.marca,
        tipo: me.form.tipo,
        placa: me.form.placa,
        estado: me.form.estado
      })
        .then((response) => {
          me.getDatos()
          me.closeModal('save')
        })
        .catch((error) => {
          // this.errorMessage = error.message;
          console.error('Error!', error)
        })
    },
    /* Actualizar */
    onUpdate () {
      const me = this
      axios.put(laravelUrl + '/carro/update/' + me.form.id, {
        marca: me.form.marca,
        tipo: me.form.tipo,
        placa: me.form.placa,
        estado: me.form.estado
      })
        .then((response) => {
          this.getDatos()
          me.closeModal('update')
        })
        .catch((error) => {
          // this.errorMessage = error.message;
          console.error('Error!', error)
        })
    },
    onState () {
      let me = this
      if (this.form.state === 1) {
        axios
          .put(apiUrl + '/user/deactivate', {
            id: this.form.id
          })
          .then((response) => {
            me.$refs.vuetable.refresh()
            me.$refs['modal-3'].hide()
          })
          .catch((error) => {
            // this.errorMessage = error.message;
            console.error('There was an error!', error)
          })
      } else {
        axios
          .put(apiUrl + '/user/activate', {
            id: this.form.id
          })
          .then((response) => {
            me.$refs.vuetable.refresh()
            me.$refs['modal-4'].hide()
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
      this.$refs['modal-5'].show()
      this.$refs['modal-5'].title = mensaje
    },
    cifrarTxt () {
      // Aquí puedes realizar cualquier lógica de cifrado si es necesario.
      // Por ahora, simplemente estoy cambiando el texto a "Nuevo Texto".
      this.formCifrar.txtMd5 = CryptoJS.MD5(this.formCifrar.textoIn)
      this.formCifrar.txtSha512 = CryptoJS.SHA256(this.formCifrar.textoIn)
      bcrypt.hash(this.formCifrar.textoIn, 10, (err, hash) => {
        if (err) {
          console.error('Error al generar hash bcrypt:', err)
        } else {
          this.formCifrar.txtBcrypt = hash
        }
      })
      const key = new RSA({ b: 512 })
      this.formCifrar.txtRsa = key.encrypt(this.formCifrar.textoIn, 'base64')
    }
  }
}
</script>
