<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-9 col-xl-7">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
          <h4 class="float-left pt-2">Editar Servicio</h4>
          <div class="card-header-actions mr-1">
            <a class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="update">
              <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
              <i class="fas fa-check" v-else></i>
              <span class="ml-1">Guardar</span>
            </a>
            <a class="card-header-action ml-1" href="#" :disabled="submitingDestroy" @click.prevent="destroy">
              <i class="fas fa-spinner fa-spin" v-if="submitingDestroy"></i>
              <i class="far fa-trash-alt" v-else></i>
              <span class="d-md-down-none ml-1">Eliminar</span>
            </a>
          </div>
        </div>
        <div class="card-body px-0">
          <div class="row" v-if="!loading">
            <div class="form-group col-md-9">
              <label>Nombre</label>
              <input type="text" class="form-control" :class="{'is-invalid': errors.name}" v-model="service.name" placeholder="">
              <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
            </div>
            <div class="form-group col-md-3">
              <label>ID</label>
              <input class="form-control" type="text" v-model="service.id" readonly>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" :class="{'is-invalid': errors.description}" v-model="service.description" placeholder="john@modulr.io">
                <div class="invalid-feedback" v-if="errors.description">{{errors.description[0]}}</div>
              </div>
              <div class="form-group">
                <label>Valor [%]</label>
                <input type="text" class="form-control" :class="{'is-invalid': errors.value}" v-model="service.value">
                <div class="invalid-feedback" v-if="errors.value">{{errors.value[0]}}</div>
              </div>
              
            </div>
          </div>
          <div class="row" v-else>
            <div class="col-md-12">
              <content-placeholders>
                <content-placeholders-text/>
              </content-placeholders>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      service: {},
      errors: {},
      loading: true,
      submiting: false,
      submitingDestroy: false
    }
  },
  mounted () {
    this.getService()
  },
  methods: {
    getService() {
      this.loading = true
      let str = window.location.pathname
      let res = str.split("/")
      axios.get(`/api/services/getServiceData/${res[2]}`)
      .then(response => {
        this.service = response.data
      })
      .catch(error => {
        this.$toasted.global.error('Service does not exist!')
        location.href = '/services'
      })
      .then(() => {
        this.loading = false
      })
    },
    
    update () {
      if (!this.submiting) {
        this.submiting = true
        axios.put(`/api/services/update/${this.service.id}`, this.service)
        .then(response => {
          this.$toasted.global.error('Updated service!')
          location.href = '/services'
        })
        .catch(error => {
          this.errors = error.response.data.errors
          this.submiting = false
        })
      }
    },
    destroy () {
      if (!this.submitingDestroy) {
        this.submitingDestroy = true
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Service!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete(`/api/services/${this.service.id}`)
            .then(response => {
              this.$toasted.global.error('Deleted service!')
              location.href = '/services'
            })
            .catch(error => {
              this.errors = error.response.data.errors
            })
          }
          this.submitingDestroy = false
        })
      }
    }
  }
}
</script>
