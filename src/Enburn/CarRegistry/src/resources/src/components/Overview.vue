<template>
    <div>
        <div id="edit">
            <div class="buttons">
                <p v-on:click="toggleForm" class="button is-success has-text-weight-bold"> <span class="mdi mdi-plus-circle"></span>/<span class="mdi mdi-pencil"></span> New or edit vehicle</p>
            </div>
            <div v-if="this.showForm">
                <label class="label">
                    Brand
                    <div class="select">
                        <select class="select" v-model="newBrand">
                            <option v-for="brand in this.brands" :value="brand">{{ brand.name }}</option>
                        </select>
                    </div>
                </label>
                <label class="label">
                    Plate number
                    <input class="input" type="text" v-model="newPlateNumber">
                </label>
                <label class="label" v-if="this.newBrand !== null">
                    Model
                    <div class="select">
                        <select v-model="newModel">
                            <option v-for="model in this.newBrand.vehicle_models" :value="model.name">{{ model.name }}</option>
                        </select>
                    </div>
                </label>
                <label class="label">
                    Year
                    <input class="input" type="date" v-model="newYear">
                </label>
                <label class="label">
                    Mileage
                    <input class="input" type="number" v-model="NewMileage">
                </label>
                <label class="label">
                    Date registered
                    <input class="input" type="date" v-model="newRegisteredAt">
                </label>
                <button v-on:click="newVehicle" class="button is-success">Save vehicle</button>
                <button v-on:click="clear" v-if="this.vehicleId" class="button is-danger">Stop editing {{ this.newPlateNumber}}</button>
            </div>
        </div>

        <hr>
        <p>Filters</p>
        <label class="label">
            Brand name
            <input class="input" v-model="filterBrandName" type="text">
        </label>
        <label class="label">
            Model name
            <input class="input" v-model="filterModelName" type="text">
        </label>
        <a v-on:click="getVehicles" class="button is-info">Set filters</a>
        <hr>

        <table class="table">
            <thead>
            <tr>
                <th>Brand</th>
                <th>Registration number</th>
                <th>Model</th>
                <th>Year</th>
                <th>Mileage</th>
                <th>Registation date</th>
                <th>Is veteran</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(vehicle, index) in this.vehicles">
                <td>{{ vehicle.brand !== null ? vehicle.brand.name : 'Wut' }}</td>
                <td>{{ vehicle.plate_number }}</td>
                <td>{{ vehicle.model }}</td>
                <td>{{ vehicle.year }}</td>
                <td>{{ vehicle.mileage }}</td>
                <td>{{ vehicle.registered_at }}</td>
                <td>{{ vehicle.veteran_status }}</td>
                <td v-on:click="editVehicle(index)"><a href="#edit" class="mdi mdi-pencil has-text-info"></a></td>
                <td v-on:click="deleteVehicle(vehicle.id)"><a class="mdi mdi-trash-can-outline has-text-danger"></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            vehicles: null,
            brands: null,
            models: [],
            availableModels: null,

            filterBrandName: '',
            filterModelName: '',

            vehicleId: null,
            newBrand: null,
            newPlateNumber: null,
            newModel: null,
            newYear: null,
            NewMileage: null,
            newRegisteredAt: null,

            showForm: false,
        }
    },
    name: "Vehicles",
    computed: {
        hasVeteranStatus() {
            let oldDate = new Date(this.newYear);
            let todayDate = new Date();
            let thisYear = todayDate.getFullYear();
            let thatYear = oldDate.getFullYear();

            return thisYear - thatYear > 30
        },
    },
    methods: {
        editVehicle(index) {
            const vehicle = this.vehicles[index];

            this.vehicleId = vehicle.id;
            this.newPlateNumber = vehicle.plate_number;
            this.newBrand = vehicle.brand;
            this.newModel = vehicle.model;
            this.newYear = vehicle.year;
            this.NewMileage = vehicle.mileage;
            this.newRegisteredAt = vehicle.registered_at;
            this.showForm = true;
        },
        deleteVehicle(vehicleId) {
            axios.delete('api/v1/vehicles/' + vehicleId)
                .then(response => {
                    this.getVehicles();
                })
                .catch(error => {
                    console.error(error);
                    this.getVehicles();
                });
        },
        newVehicle() {
            const data = {
                'id': this.vehicleId,
                'brand_id': this.newBrand.id,
                'plate_number': this.newPlateNumber,
                'model': this.newModel,
                'year': this.newYear,
                'mileage': this.NewMileage,
                'registered_at': this.newRegisteredAt,
                'veteran_status': this.hasVeteranStatus,
            }

            if (this.vehicleId === null) {
                delete data.id;
            }

            axios.post('api/v1/vehicles', data)
                .then(response => {
                    this.getVehicles();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        toggleForm() {
            this.showForm = !this.showForm;
        },
        getVehicles() {
            axios.get('api/v1/vehicles?filterBrandName=' + this.filterBrandName + '&filterModelName=' + this.filterModelName)
                .then(response => {
                    this.vehicles = response.data

                })
                .catch(error => {
                    console.error(error);
                });
        },
        getBrands() {
            axios.get('api/v1/brands')
                .then(response => {
                    this.brands = response.data

                    response.data.forEach(brand => {
                        brand.vehicle_models.forEach(model => {
                            if (model !== null) {
                                this.models.push(model);
                            }
                        });
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        },
        clear() {
            this.vehicleId = null;
            this.newPlateNumber = null;
            this.newBrand = null;
            this.newModel = null;
            this.newYear = null;
            this.NewMileage = null;
            this.newRegisteredAt = null;
        },
    },
    mounted () {
        this.getVehicles();
        this.getBrands();
    }
}

</script>

<style scoped>

</style>
