<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employee management</h1>
            <router-link
                :to="{ name: 'EmployeesCreate' }"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            >
                Create a new
            </router-link>
        </div>
        <div class="card shadow mb-4">
            <div v-if="showMessage">
                <div class="alert alert-success">
                    {{ message }}
                </div>
            </div>
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <input
                                        type="search"
                                        class="form-control mb-2"
                                        v-model.lazy="search"
                                    />
                                </div>
                                <div class="col">
                                    <select
                                        class="form-control mb-2"
                                        name="department"
                                        v-model="selectedDepartment"
                                    >
                                        <option
                                            v-for="department in departments"
                                            :key="department.id"
                                            :value="department.id"
                                        >
                                            {{ department.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last name</th>
                                <th>First name</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="employee in employees"
                                :key="employee.id"
                            >
                                <td>{{ employee.id }}</td>
                                <td>{{ employee.first_name }}</td>
                                <td>{{ employee.last_name }}</td>
                                <td>{{ employee.address }}</td>
                                <td>{{ employee.country.name }}</td>
                                <td>{{ employee.department.name }}</td>
                                <td>
                                    <router-link
                                        class="btn btn-primary"
                                        :to="{
                                            name: 'EmployeesEdit',
                                            params: { id: employee.id },
                                        }"
                                    >
                                        Edit
                                    </router-link>
                                    <button
                                        class="btn btn-danger"
                                        @click="deleteEmployee(employee.id)"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            message: "",
            search: null,
            selectedDepartment: null,
            departments: [],
        };
    },
    watch: {
        search() {
            this.getEmployees();
        },
        selectedDepartment() {
            this.getEmployees();
        },
    },
    created() {
        this.getEmployees();
        this.getDepartments();
    },
    methods: {
        getEmployees() {
            axios
                .get("/api/employees", {
                    params: {
                        search: this.search,
                        department_id: this.selectedDepartment,
                    },
                })
                .then((response) => {
                    this.employees = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getDepartments() {
            axios
                .get("/api/employees/departments")
                .then((response) => {
                    this.departments = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        deleteEmployee(id) {
            axios
                .delete(`/api/employees/${id}`)
                .then((response) => {
                    // console.log(response);
                    this.showMessage = true;
                    this.message = response.data;
                    this.getEmployees();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
