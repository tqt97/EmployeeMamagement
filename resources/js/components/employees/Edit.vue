<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update employee</h1>
            <router-link
                :to="{ name: 'EmployeesIndex' }"
                class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            >
                Back
            </router-link>
        </div>
        <div class="card shadow mb-4">
            <div class="col-md-12">
                <div class="card-body">
                    <form @submit.prevent="updateEmployee">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <label class="col-form-label">First name</label>
                                <input
                                    id="first_name"
                                    v-model="form.first_name"
                                    type="text"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label"
                                    >Middle name</label
                                >
                                <input
                                    id="middle_name"
                                    v-model="form.middle_name"
                                    type="text"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Last name</label>
                                <input
                                    id="last_name"
                                    v-model="form.last_name"
                                    type="text"
                                    class="form-control"
                                    required
                                />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <label class="col-form-label">Address</label>
                                <input
                                    id="address"
                                    v-model="form.address"
                                    type="text"
                                    class="form-control"
                                    required
                                />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <label class="col-form-label">Country</label>
                                <select
                                    class="form-control"
                                    name="country"
                                    v-model="form.country_id"
                                    @change="getStates()"
                                >
                                    <option
                                        v-for="country in countries"
                                        :key="country.id"
                                        :value="country.id"
                                    >
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">State</label>
                                <select
                                    class="form-control"
                                    name="state"
                                    v-model="form.state_id"
                                    @change="getCities()"
                                >
                                    <option
                                        v-for="state in states"
                                        :key="state.id"
                                        :value="state.id"
                                    >
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">City</label>
                                <select
                                    class="form-control"
                                    name="city"
                                    v-model="form.city_id"
                                >
                                    <option
                                        v-for="city in cities"
                                        :key="city.id"
                                        :value="city.id"
                                    >
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <label class="col-form-label">Department</label>
                                <select
                                    class="form-control"
                                    name="department"
                                    v-model="form.department_id"
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
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label class="col-form-label">Zip Code</label>
                                <input
                                    id="zip_code"
                                    v-model="form.zip_code"
                                    type="text"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Birth date</label>
                                <datepicker
                                    input-class="form-control"
                                    v-model="form.birthday"
                                ></datepicker>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Date hired</label>
                                <datepicker
                                    input-class="form-control"
                                    v-model="form.date_hired"
                                ></datepicker>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";

export default {
    components: {
        Datepicker,
    },
    data() {
        return {
            form: {
                first_name: "",
                middle_name: "",
                last_name: "",
                address: "",
                country_id: "",
                state_id: "",
                city_id: "",
                department_id: "",
                zip_code: "",
                birthday: null,
                date_hired: null,
            },
            countries: [],
            states: [],
            cities: [],
            departments: [],
        };
    },
    created() {
        this.getEmployee();
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        getEmployee() {
            axios
                .get("/api/employees/" + this.$route.params.id)
                .then((response) => {
                    this.form = response.data.data;
                    this.getStates();
                    this.getCities();
                });
        },
        getCountries() {
            axios
                .get("/api/employees/countries")
                .then((response) => {
                    this.countries = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getStates() {
            axios
                .get("/api/employees/" + this.form.country_id + "/states")
                .then((response) => {
                    this.states = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCities() {
            axios
                .get("/api/employees/" + this.form.state_id + "/cities")
                .then((response) => {
                    this.cities = response.data;
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
        updateEmployee() {
            axios
                .put("/api/employees/" + this.$route.params.id, {
                    first_name: this.form.first_name,
                    middle_name: this.form.middle_name,
                    last_name: this.form.last_name,
                    address: this.form.address,
                    country_id: this.form.country_id,
                    state_id: this.form.state_id,
                    city_id: this.form.city_id,
                    department_id: this.form.department_id,
                    zip_code: this.form.zip_code,
                    birthday: this.format_date(this.form.birthday),
                    date_hired: this.format_date(this.form.date_hired),
                })
                .then((response) => {
                    this.$router.push({ name: "EmployeesIndex" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format("YYYYMMDD");
            }
        },
    },
};
</script>
