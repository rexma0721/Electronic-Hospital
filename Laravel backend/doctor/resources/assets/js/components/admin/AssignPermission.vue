<template>
    <div class="row" id='assign-role-permission-vue'>
        <div class="col m4 s12">
            <ul class="collection with-header">
                <li class="collection-header"><h5>Roles</h5></li>
                <li href="javascript:void(0);"
                    :class="{ active: role==selectedRole, 'collection-item': true }"
                    v-for="role in roleList"
                    @click="getRolePermissions(role)">
                    <span class="primary-text"><strong>{{ role.name  | capitalize }}</strong></span></br>
                    <span class="secondary-text">{{ role.label }}</span>
                </li>
            </ul>
        </div>
        <div class="col m4 s12" v-if="selectedRole.length != 0">
            <ul class="collection with-header" v-if="selectedRolePermissions.length!=0">
                <li class="collection-header"><h5>Role Permissions :{{selectedRole.name | capitalize }}</h5></li>
                <li href="javascript:void(0);" class="collection-item"
                    v-for="rolePermission in selectedRolePermissions"
                    @click="detach(rolePermission)">
                    <span class="primary-text"><i class="material-icons left">remove_circle</i><strong>{{ rolePermission.label  | capitalize }}</strong></span></br>
                </li>
            </ul>
            <ul class="collection with-header" v-else>
                <li class="collection-header"><h5>Aha! No permission assigned yet!</h5></li>
            </ul>
        </div>
        <div class="col m4 s12" v-else>
            <ul class="collection with-header">
                <li class="collection-header"><h5>Select Role to assign permission!</h5></li>
            </ul>
        </div>
        <div class="col m4 s12">
            <ul class="collection with-header">
                <li class="collection-header"><h5>Permissions</h5></li>
                <li href="javascript:void(0);" class="collection-item"
                    v-for="permission in filteredPermissions"
                    @click="attach(permission)">
                    <span class="primary-text"><i class="material-icons left">add</i><strong>{{ permission.label  | capitalize }}</strong></span></br>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
Array.prototype.diff = function(a) {
    return this.filter(function(i) { return a.indexOf(i) < 0; });
};
export default {
    data() {
        return {
            permissionsList: [],
            roleList: [],
            selectedRole: [],
            selectedRolePermissions: []
        };
    },
    mounted() {
        this.permissions();
        this.roles();
    },
    methods: {
        permissions() {
            let uri = `/admin/permissions/all`;
            axios.get(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        this.permissionsList = res.data;
                    }
                })
                .catch((error) => { console.log(error) });
        },
        roles() {
            let uri = `/admin/roles/all`;
            axios.get(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        this.roleList = res.data;
                    }
                })
                .catch((error) => { console.log(error) });
        },
        getRolePermissions(role) {
            this.selectedRole = role;
            let uri = `/admin/role/${this.selectedRole.id}/permissions`;
            axios.get(uri).then((response) => {
                    let res = response.data;
                    if (res.status_code == 200) {
                        this.selectedRolePermissions = res.data;
                    }
                })
                .catch((error) => { console.log(error) });
        },
        detach(permission) {
            if (this.selectedRole.length != 0) {
                let roleSelected = this.selectedRole;
                let uri = '/admin/detachPermission';
                axios.post(uri, { permissionID: permission.id, roleID: roleSelected.id }).then((response) => {
                        let res = response.data;
                        if (res.status_code == 200) {
                            this.selectedRolePermissions = res.data;
                        }
                    })
                    .catch((error) => { console.log(error) });
            }
        },
        attach(permission) {
            if (this.selectedRole.length != 0) {
                let roleSelected = this.selectedRole;
                let uri = '/admin/assignPermission';
                axios.post(uri, { permissionID: permission.id, roleID: roleSelected.id }).then((response) => {
                        let res = response.data;
                        if (res.status_code == 200) {
                            this.selectedRolePermissions = res.data;
                        }
                    })
                    .catch((error) => { console.log(error) });
            }
        }
    },
    computed: {
        filteredPermissions() {
            let a = this.permissionsList;
            let b = this.selectedRolePermissions;
            var onlyInA = a.filter(function(current) {
                return b.filter(function(current_b) {
                    return current_b.id == current.id
                }).length == 0
            });

            var onlyInB = b.filter(function(current) {
                return a.filter(function(current_a) {
                    return current_a.id == current.id
                }).length == 0
            });
            return onlyInA.concat(onlyInB);
        }
    },
    filters: {
        capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        }
    }
}
</script>
