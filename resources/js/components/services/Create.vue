<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-9 col-xl-7">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
          <h4 class="float-left pt-2">Nuevo Servicio</h4>
          <div class="card-header-actions mr-1">
            <a class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="create">
              <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
              <i class="fas fa-check" v-else></i>
              <span class="ml-1">Guardar</span>
            </a>
          </div>
        </div>
        <div class="card-body px-0">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': errors.name}" v-model="service.name" placeholder="Nombre">
            <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
          </div>
          <div class="form-group">
            <label>Descripción</label>
            <input type="text" class="form-control" :class="{'is-invalid': errors.description}" v-model="service.description" placeholder="">
            <div class="invalid-feedback" v-if="errors.email">{{errors.description[0]}}</div>
          </div>
          <div class="form-group">
            <label>Valor [%]</label>
            <input type="text" class="form-control" :class="{'is-invalid': errors.value}" v-model="service.value">
            <div class="invalid-feedback" v-if="errors.password">{{errors.value[0]}}</div>
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
      submiting: false
    }
  },
  mounted () {
    
  },
  methods: {
    create () {
      if (!this.submiting) {
        this.submiting = true
        axios.post(`/api/services/store`, this.service)
        .then(response => {
          this.$toasted.global.error('Created service!')
          location.href = '/services'
        })
        .catch(error => {
          this.errors = error.response.data.errors
          this.submiting = false
        })
      }
    }
  }
}
</script>
