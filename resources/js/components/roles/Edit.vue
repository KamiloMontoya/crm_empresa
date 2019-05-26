<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-12 col-xl-9">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
          <h4 class="float-left pt-2">Editar Rol</h4>
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
        <div class="card-header px-0 bg-transparent">
          <strong>General</strong><br>
          <small class="text-muted">Actualizar nombre y permisos del rol</small>
        </div>
        <div class="card-body px-0">
          <div class="row" v-if="!loading">
            <div class="form-group col-sm-9">
              <label>Nombre del rol</label>
              <input type="text" class="form-control" :class="{'is-invalid': errors.display_name}" v-model="role.display_name" placeholder="Admin" autofocus>
              <div class="invalid-feedback" v-if="errors.display_name">{{errors.display_name[0]}}</div>
            </div>
            <div class="form-group col-sm-3">
              <label>Rol ID</label>
              <input type="text" class="form-control" v-model="role.id" readonly>
            </div>
            <div class="form-group col-sm-12">
              <label>Identificador</label>
              <input type="text" class="form-control" :class="{'is-invalid': errors.name}" v-model="role.name" placeholder="admin" readonly>
              <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
            </div>
          </div>
          <content-placeholders v-else>
            <content-placeholders-heading/>
          </content-placeholders>
        </div>
        <div class="card-header px-0 bg-transparent">
          <strong>Permisos</strong><br>
          <small class="text-muted">Habilite o deshabilite permisos para acceder a modulos de la aplicación.</small>
          <div class="card-header-actions">
            <div class="float-left mr-2 d-sm-down-none">
              <small class="text-muted">{{role.permissions.length}} of {{permissionsCount}}</small>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-info" role="progressbar" :style="`width: ${role.permissions.length*100/permissionsCount}%`" :aria-valuenow="role.permissions.length*100/permissionsCount" aria-valuemin="0" :aria-valuemax="this.permissionsCount"></div>
              </div>
            </div>
            <a class="card-header-action btn-minimize" href="#" data-toggle="collapse" data-target="#collapsePermissions" aria-expanded="true">
              <i class="icon-arrow-up"></i>
            </a>
          </div>
        </div>
        <div class="card-body collapse" id="collapsePermissions">
          <form class="form-horizontal">
            <div class="form-group row" v-for="module in role.modulesPermissions">
              <label class="col-md-3"><strong>{{module.display_name}}</strong></label>
              <div class="col-md-9">
                <div class="clearfix" v-for="permission in module.permissions">
                  <span>{{permission.display_name}}</span>
                  <label class="switch switch-pill switch-outline-success-alt float-right">
                    <input class="switch-input" type="checkbox" v-model="permission.allow">
                    <span class="switch-slider"></span>
                  </label>
                  <hr>
                </div>
              </div>
            </div>
          </form>
        </div>
        <content-placeholders class="card-body" v-if="loading">
          <content-placeholders-heading :img="true"/>
        </content-placeholders>
        <div class="card-header px-0 bg-transparent">
          <strong>Usuarios</strong><br>
          <small class="text-muted">Esta es la lista de usuarios con este rol.</small>
          <div class="card-header-actions">
            <small class="text-muted mr-1 d-sm-down-none">{{role.users.length}}</small>
            <a class="card-header-action btn-minimize" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true">
              <i class="icon-arrow-up"></i>
            </a>
          </div>
        </div>
        <div class="card-body collapse" id="collapseUsers">
          <ul class="list-unstyled">
            <a :href="`/users/${user.id}/edit`" v-for="user in role.users">
            <li class="media border-bottom border-light pb-2 mb-2">
              <div class="avatar float-left mr-3">
                <img class="img-avatar" :src="user.avatar_url">
              </div>
              <div class="media-body">
                <div>{{user.name}}</div>
                <div class="small text-muted">
                  {{user.email}}
                </div>
              </div>
            </li>
            </a>
          </ul>
        </div>
        <content-placeholders class="card-body" v-if="loading">
          <content-placeholders-heading :img="true"/>
        </content-placeholders>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      role: {
        permissions: [],
        users: []
      },
      permissionsCount: 0,
      errors: {},
      loading: true,
      submiting: false,
      submitingDestroy: false
    }
  },
  mounted () {
    this.getPermissionsCount()
    this.getRole()
  },
  methods: {
    getRole() {
      this.loading = true
      let str = window.location.pathname
      let res = str.split("/")
      axios.get(`/api/roles/getRoleModulesPermissions/${res[2]}`)
      .then(response => {
        this.role = response.data
      })
      .catch(error => {
        this.$toasted.global.error('Rol no existe!')
        location.href = '/roles'
      })
      .then(() => {
        this.loading = false
      })
    },
    update () {
      if (!this.submiting) {
        this.submiting = true
        axios.put(`/api/roles/update/${this.role.id}`, this.role)
        .then(response => {
          this.$toasted.global.error('Rol actualizado correctamente!')
          location.href = '/roles'
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
          title: "Esta seguro?",
          text: "Una vez eliminado este rol, no podrá recuperarlo!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete(`/api/roles/${this.role.id}`)
            .then(response => {
              this.$toasted.global.error('Rol eliminado!')
              location.href = '/roles'
            })
            .catch(error => {
              this.errors = error.response.data.errors
            })
          }
          this.submitingDestroy = false
        })
      }
    },
    getPermissionsCount() {
      axios.get(`/api/permissions/count`)
      .then(response => {
        this.permissionsCount = response.data
      })
    }
  },
  watch: {
    'role.display_name': function (val) {
      this.role.name = val.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');
    }
  }
}
</script>
