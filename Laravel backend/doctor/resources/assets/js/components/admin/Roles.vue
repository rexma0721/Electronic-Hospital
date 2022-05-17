<template>
    <div class="row">
      <div class="s12 col">
        <div v-if="showAlert">
          <alert :type="alertType">{{ alertText }}</alert>
        </div>
      </div>
      <div class="col s12 mr-top-10">
        <div class="card-panel">
          <div class="row box-title">
            <div class="col s12">
              <h5 class="content-headline">Roles</h5>

            </div>
            <div class="col s12 m8">
              <transition name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated bounceOutRight">
                <button class="btn btn-default pull-right" @click="create()" v-show="showAdd">New</button>
              </transition>
            </div>
            <div class="col s12 m4">
              <form class="form-inline" @submit.prevent="searchInput">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                    <input type="text" v-model="searchQuery" class="form-control" id="searchInputRole" placeholder="Search" @keyup.delete="searchChanges">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <table class="responsive-table bordered">
                <thead>
                  <tr>
                    <th v-for="(cols,index) in gridColumns" @click="sortBy(cols)">
                      {{ cols | capitalize }}
                      <span class="arrow"
                        :class="sortOrder.field == cols ? sortOrder.order : 'asc'"
                        v-if="escapeSort.indexOf(cols) < 0"></span>
                    </th>
                  </tr>
                </thead>
                <tbody  v-if="componentData.length">
                  <tr v-for="runningData in componentData">
                    <!-- <th scope="row" v-text="runningData.id"></th> -->
                    <td v-text="runningData.name"></td>
                    <td v-text="runningData.label"></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-floating btn-flat" @click="show(runningData)">
                          <i class="material-icons warning-text">mode_edit</i>
                        </button>
                        <button type="button" class="bt btn-floating btn-flat" @click="removeConfirm(runningData)">
                          <i class="material-icons error-text">delete</i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- PAGINATION -->
          <div class="row">
            <div class="s12 col">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li v-show="pagination.total_pages > 0 && pagination.current_page != 1">
                  <a href="javascript:void(0);" aria-label="Previous" @click="all(1)">
                    <i class="material-icons">first_page</i>
                  </a>
                </li>
                <!-- PREVIOUS PAGE -->
                <li>
                  <a href="javascript:void(0);" aria-label="Previous" @click="prevPage()"><i class="material-icons">chevron_left</i></a>
                </li>

                <li v-for="n in pagination.total_pages"
                  :class="{'active':pagination.current_page==n}"
                  v-show="n >= pagination.current_page && n <= paginationList">
                  <a href="javascript:void(0);" @click="all(n)">{{ n }}</a>
                </li>
                <li>
                  <a href="javascript:void(0);" @click="nextPage()">
                    <i class="material-icons">chevron_right</i>
                  </a>
                </li>
                <li v-show="pagination.total_pages > 0 && pagination.total_pages != pagination.current_page">
                  <a href="javascript:void(0);" aria-label="Previous" @click="all(pagination.total_pages)">
                    <i class="material-icons">last_page</i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Structure -->
      <div id="componentDataModal" class="modal modal-fixed-footer medium">
        <div class="modal-content">
          <div class="col s12">
            <h5>{{ pupupMod | capitalize}} Role</h5>
          </div>
          <form @submit.prevent="isNotValidateForm" name="callback" class="col s12">
            <div class="input-field">
              <input type="text" id="role-name" name="role-name" v-model="singleObj.name">
              <label for="role-name">Name</label>
            </div>
            <div class="input-field">
              <input type="text" id="label-text" name="role-label" v-model="singleObj.label">
              <label for="role-label">Label</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
          <a href="#!" class="btn-flat" :disabled="isNotValidateForm" @click="update()" v-if="pupupMod=='edit'">Edit</a>
          <a href="#!" class="btn-flat" :disabled="isNotValidateForm" @click="store()" v-else>Add</a>
        </div>
      </div>
    </div>
</template>
<script>
import { tableData } from '../../mixins/tableMixin';

export default {
    mixins: [tableData],
    data() {
        return {

            singleObj: { id: Number, name: String, label: String },
            pupupMod: 'add',
            showAdd: false,
            gridColumns: ['name', 'label', 'action'],
            escapeSort: ['action'],
            sortOrder: { field: 'name', order: 'asc' }
        };
    },
    mounted() {
        this.all();
        this.showAdd = true;
        let vm = this;
        $('#componentDataModal').modal({
            dismissible: false,
            ready: function(modal, trigger) {
                // Callback for Modal open. Modal and trigger parameters available.
            },
            complete: function() { vm.resetSingleObj(); } // Callback for Modal close
        });
    },
    methods: {
        resetSingleObj() {
            this.singleObj = { id: '', name: '', label: '' };
        },
        all(page = 1) {
            this.resetAlert();
            let uri = `/admin/roles?page=${page}&sort=${this.sortOrder.field}&order=${this.sortOrder.order}`;
            axios.get(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        this.componentData = res.data;
                        this.pagination = res.paginator;
                    }
                })
                .catch(error => this.alertHandler('info', `No ${this.headline} to list!`, true));
        },
        show(obj) {
            this.pupupMod = 'edit';
            this.resetAlert();
            this.singleObj = obj;
            $('#componentDataModal').modal('open');
        },
        remove(obj) {
            this.resetAlert();
            var index = this.componentData.indexOf(obj);
            this.componentData.splice(index, 1);
            let uri = `/admin/roles/${obj.id}`;
            axios.delete(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        // Handling alert
                        this.alertHandler('success', res.message, true);
                    } else {
                        this.alertHandler('error', res.message, true);
                    }
                })
                .catch((error) => { console.log(error) });
        },
        update() {
            let uri = `/admin/roles/${this.singleObj.id}`;
            axios.put(uri, this.singleObj).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        // Handling alert
                        this.alertHandler('success', res.message, true);
                    } else {
                        this.alertHandler('error', res.message, true);
                    }
                    $('#componentDataModal').modal('close');
                })
                .catch((error) => { console.log(error) });
        },
        create() {
            this.resetSingleObj();
            this.resetAlert();
            this.pupupMod = 'add';
            $('#componentDataModal').modal('open');
        },
        store() {
            // this.categories.push(this.singleObj);
            axios.post('/admin/roles', this.singleObj).then((response) => {
                    let res = response.data;
                    if (res.status_code == 201) {
                        this.resetSingleObj(); // reset store input form
                        this.all(); // fetch updated list
                        $('#componentDataModal').modal('close'); // Hide modal
                        // Handling alert
                        this.alertHandler('success', res.message, true);
                    } else {
                        this.alertHandler('error', res.message, true);
                    }
                })
                .catch((error) => { console.log(error) });
        },


        searchInput() {
            let searchQuery = this.searchQuery;
            let uri = `/admin/roles?searchQuery=${searchQuery}&sort=${this.sortOrder.field}&order=${this.sortOrder.order}`;
            axios.get(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        this.componentData = res.data;
                        this.pagination = res.paginator;
                    }
                })
                .catch((error) => { console.log(error) });
        },
    },
    computed: {
        isNotValidateForm() {
            if (this.singleObj.name == '') {
                return true;
            }
            return false;
        }
    }
}
</script>
