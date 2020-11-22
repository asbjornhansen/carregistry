<template>
    <div>
        <p>Brands and associated models: </p>
        <ul>
            <li v-for="brand in this.brands">
                <span class="has-text-weight-bold">{{ brand.name }}</span>
                <a v-on:click="deleteBrand(brand.id)" class="mdi mdi-trash-can-outline has-text-danger"></a>
                <ul>
                    <li v-for="model in brand.vehicle_models">
                        {{ model.name }} -
                        {{ model.number_of_seats }} -
                        {{ model.fuel_type }} -
                        <a v-on:click="deleteVehicleModel(brand.id, model.id)" class="mdi mdi-trash-can-outline has-text-danger"></a>
                    </li>
                </ul>
            </li>
            <div>
                <p v-on:click="displayNewBrand = true" class="mdi mdi-plus-circle has-text-success">Add a new brand</p>
                <span v-if="displayNewBrand">
                    <input class="input" name="name" type="text" v-model="newBrandName">
                    <submit v-bind:class="{ 'is-loading': this.newBrandLoading }" v-on:click="this.saveNewBrand" class="button is-success">Save brand</submit>
                </span>
            </div>
            <div>
                <p v-on:click="displayNewModel = true" class="mdi mdi-plus-circle has-text-success">Add a new model</p>
                <span v-if="displayNewModel">
                    <label>
                        Brand
                        <select class="select" v-model="newModelBrandId">
                            <option v-for="brand in this.brands" :value="brand.id">{{ brand.name }}</option>
                        </select>
                    </label>
                    <label>
                        Name
                        <input class="input" type="text" v-model="newModelName">
                    </label>
                    <label>
                        Number of seats
                        <input class="input" type="number" v-model="newModelSeats">
                    </label>
                    <label>
                        Fuel type
                        <select class="select" v-model="newModelFuelType">
                            <option value="Gasoline">Gasoline</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </label>
                    <submit v-bind:class="{ 'is-loading': this.newModelLoading }" v-on:click="this.saveNewModel" class="button is-success">Save model</submit>
                </span>
            </div>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            brands: null,
            displayNewBrand: false,
            displayNewModel: false,
            newBrandLoading: false,
            newModelLoading: false,
            newBrandName: null,
            newModelBrandId: null,
            newModelName: null,
            newModelSeats: null,
            newModelFuelType: null,
        }
    },
    name: "Brands",
    methods: {
        saveNewBrand() {
            this.newBrandLoading = true;
            const data = {
                'name': this.newBrandName
            };

            axios.post('api/v1/brands/', data)
                .then(response => {
                    this.newBrandLoading = false;
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.newBrandLoading = false;
                    this.getBrands();
                });
        },
        saveNewModel() {
            this.newModelLoading = true;
            const data = {
                'brand_id': this.newModelBrandId,
                'name': this.newModelName,
                'number_of_seats': this.newModelSeats,
                'fuel_type': this.newModelFuelType
            };

            axios.post('api/v1/models/', data)
                .then(response => {
                    this.newModelLoading = false;
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.newModelLoading = false;
                    this.getBrands();
                });
        },
        deleteBrand(brandId) {
            axios.delete('api/v1/brands/' + brandId)
                .then(response => {
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.getBrands();
                });
        },
        deleteVehicleModel(brandId, ModelId) {
            axios.delete('api/v1/models/' + ModelId)
                .then(response => {
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.getBrands();
                });
        },
        getBrands() {
            axios.get('api/v1/brands')
                .then(response => {
                    this.brands = response.data
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    mounted () {
        this.getBrands();
    }
}
</script>

<style scoped>

</style>
